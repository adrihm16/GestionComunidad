<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inmueble;
use App\Models\User;

class VecinoController extends Controller
{
    public function index(Request $request)
    {
        $query = Inmueble::with('propietario');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->whereHas('propietario', function ($q) use ($search) {
                $q->where('nombre', 'like', "%{$search}%")
                  ->orWhere('apellidos', 'like', "%{$search}%")
                  ->orWhere('cargo_comunidad', 'like', "%{$search}%");
            });
        }

        $inmuebles = $query->orderBy('piso')->orderBy('puerta')->paginate(10);
        return view('vecinos.index', compact('inmuebles'));
    }

    public function show(User $user)
    {
        // Cargar relaciones del vecino
        $user->load(['inmuebles', 'incidencias' => function($query) {
            $query->latest()->take(5);
        }]);

        return view('vecinos.show', compact('user'));
    }
}
