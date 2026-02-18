<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Inmueble;
use App\Models\Noticia;
use App\Models\Incidencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Unified admin dashboard.
     */
    public function dashboard(Request $request)
    {
        $query = User::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nombre', 'like', "%{$search}%")
                  ->orWhere('apellidos', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->filled('rol')) {
            $query->where('rol_sistema', $request->rol);
        }

        $users = $query->orderBy('nombre')->paginate(10);
        $noticias = Noticia::with('autor')->orderBy('fecha_publicacion', 'desc')->get();
        $incidencias = Incidencia::with('creador')->orderBy('fecha_creacion', 'desc')->take(5)->get();

        return view('admin.dashboard', compact('users', 'noticias', 'incidencias'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::query();

        // Filtro por búsqueda
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nombre', 'like', "%{$search}%")
                  ->orWhere('apellidos', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Filtro por rol
        if ($request->filled('rol')) {
            $query->where('rol_sistema', $request->rol);
        }

        $users = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => ['required', 'string', 'max:100'],
            'apellidos' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'telefono' => ['nullable', 'string', 'max:15'],
            'rol_sistema' => ['required', Rule::in(['admin', 'vecino'])],
            'cargo_comunidad' => ['nullable', 'string', 'max:100'],
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['fecha_registro'] = now();

        $user = User::create($validated);

        // Redirigir a editar para que pueda agregar inmuebles inmediatamente
        return redirect()->route('admin.users.edit', $user)
            ->with('success', 'Usuario creado correctamente. Ahora puedes asignarle inmuebles.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        // Cargar relaciones
        $user->load(['inmuebles', 'incidencias', 'noticias', 'eventos']);

        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        // Cargar inmuebles del usuario
        $user->load('inmuebles');
        
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'nombre' => ['required', 'string', 'max:100'],
            'apellidos' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'telefono' => ['nullable', 'string', 'max:15'],
            'rol_sistema' => ['required', Rule::in(['admin', 'vecino'])],
            'cargo_comunidad' => ['nullable', 'string', 'max:100'],
        ]);

        // Actualizar contraseña solo si se proporciona
        if ($request->filled('password')) {
            $request->validate([
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
            $validated['password'] = Hash::make($request->password);
        }

        $user->update($validated);

        return redirect()->route('admin.dashboard')
            ->with('success', 'Usuario actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // Evitar que el admin se elimine a sí mismo
        if ($user->id === Auth::id()) {
            return redirect()->route('admin.dashboard')
                ->with('error', 'No puedes eliminar tu propia cuenta desde aquí.');
        }

        $user->delete();

        return redirect()->route('admin.dashboard')
            ->with('success', 'Usuario eliminado correctamente.');
    }

    /**
     * Store a new inmueble for the user.
     */
    public function storeInmueble(Request $request, User $user)
    {
        $validated = $request->validate([
            'tipo' => ['required', Rule::in(['piso', 'local', 'garaje', 'trastero'])],
            'bloque' => ['nullable', 'string', 'max:10'],
            'piso' => ['required', 'string', 'max:10'],
            'puerta' => ['required', 'string', 'max:10'],
        ]);

        // Verificar si el inmueble ya existe
        $existingInmueble = Inmueble::where('tipo', $validated['tipo'])
            ->where('bloque', $validated['bloque'])
            ->where('piso', $validated['piso'])
            ->where('puerta', $validated['puerta'])
            ->first();

        if ($existingInmueble) {
            return redirect()->route('admin.users.edit', $user)
                ->with('error', 'Este inmueble ya existe y está asignado a ' . 
                       $existingInmueble->propietario->nombre . ' ' . 
                       $existingInmueble->propietario->apellidos . '.');
        }

        $validated['propietario_id'] = $user->id;
        Inmueble::create($validated);

        return redirect()->route('admin.users.edit', $user)
            ->with('success', 'Inmueble asignado correctamente.');
    }

    /**
     * Remove an inmueble from the user.
     */
    public function destroyInmueble(User $user, Inmueble $inmueble)
    {
        // Verificar que el inmueble pertenece al usuario
        if ($inmueble->propietario_id !== $user->id) {
            return redirect()->route('admin.users.edit', $user)
                ->with('error', 'Este inmueble no pertenece a este usuario.');
        }

        $inmueble->delete();

        return redirect()->route('admin.users.edit', $user)
            ->with('success', 'Inmueble eliminado correctamente.');
    }
}
