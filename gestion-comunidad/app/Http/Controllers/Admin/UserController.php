<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Inmueble;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
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
            // User Data
            'nombre' => ['required', 'string', 'max:100'],
            'apellidos' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'telefono' => ['nullable', 'string', 'max:15'],
            'rol_sistema' => ['required', Rule::in(['admin', 'vecino'])],
            'cargo_comunidad' => ['nullable', 'string', 'max:100'],
            'iban' => ['nullable', 'string', 'max:34'],
            
            // Mandatory Multiple Properties
            'inmuebles' => ['required', 'array', 'min:1'],
            'inmuebles.*.tipo' => ['required', Rule::in(['piso', 'local', 'garaje', 'trastero'])],
            'inmuebles.*.bloque' => ['nullable', 'string', 'max:10'],
            'inmuebles.*.piso' => ['required', 'string', 'max:10'],
            'inmuebles.*.puerta' => ['required', 'string', 'max:10'],
        ]);

        try {
            return DB::transaction(function () use ($validated) {
                // 1. Create User
                $userData = collect($validated)->except(['inmuebles'])->toArray();
                $userData['password'] = Hash::make($userData['password']);
                $userData['fecha_registro'] = now();
                
                $user = User::create($userData);

                // 2. Create or Link Properties
                foreach ($validated['inmuebles'] as $inmData) {
                    // Find existing property by physical address
                    $inmueble = Inmueble::firstOrCreate([
                        'tipo' => $inmData['tipo'],
                        'bloque' => $inmData['bloque'] ?? null,
                        'piso' => $inmData['piso'],
                        'puerta' => $inmData['puerta'],
                    ]);

                    // Link user to property (attach)
                    $user->inmuebles()->attach($inmueble->id);
                }

                return redirect()->route('admin.users.index')
                    ->with('success', 'Usuario e inmuebles creados correctamente.');
            });
        } catch (\Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
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
            'iban' => ['nullable', 'string', 'max:34'],
        ]);

        // Actualizar contraseña solo si se proporciona
        if ($request->filled('password')) {
            $request->validate([
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
            $validated['password'] = Hash::make($request->password);
        }

        $user->update($validated);

        return redirect()->route('admin.users.index')
            ->with('success', 'Usuario actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // Evitar que el admin se elimine a sí mismo
        if ($user->is(Auth::user())) {
            return redirect()->route('admin.users.index')
                ->with('error', 'No puedes eliminar tu propia cuenta desde aquí.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
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

        // Buscar o crear el inmueble (ubicación física)
        $inmueble = Inmueble::firstOrCreate([
            'tipo' => $validated['tipo'],
            'bloque' => $validated['bloque'] ?? null,
            'piso' => $validated['piso'],
            'puerta' => $validated['puerta'],
        ]);

        // Verificar si el usuario ya tiene este inmueble asignado
        if ($user->inmuebles()->where('inmueble_id', $inmueble->id)->exists()) {
            return redirect()->to(route('admin.users.edit', $user) . '#inmuebles')
                ->with('error', 'Este inmueble ya está asignado a este usuario.');
        }

        // Vincular usuario al inmueble
        $user->inmuebles()->attach($inmueble->id);

        return redirect()->to(route('admin.users.edit', $user) . '#inmuebles')
            ->with('success', 'Inmueble vinculado correctamente.');
    }

    /**
     * Remove an inmueble from the user.
     */
    public function destroyInmueble(User $user, Inmueble $inmueble)
    {
        // Desvincular usuario del inmueble
        $user->inmuebles()->detach($inmueble->id);

        return redirect()->to(route('admin.users.edit', $user) . '#inmuebles')
            ->with('success', 'Inmueble desvinculado correctamente.');
    }
}
