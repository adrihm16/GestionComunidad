<?php

namespace App\Http\Controllers;

use App\Models\Inmueble;
use Illuminate\Http\Request;

class InmuebleController extends Controller
{
    public function index()
    {
        $inmuebles = Inmueble::with('propietarios')->get();
        return view('inmuebles.index', compact('inmuebles'));
    }

    public function create()
    {
        return view('inmuebles.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tipo' => 'required|in:piso,local,garaje,trastero',
            'bloque' => 'nullable|string|max:10',
            'piso' => 'required|string|max:10',
            'puerta' => 'required|string|max:10',
            'user_ids' => 'nullable|array',
            'user_ids.*' => 'exists:users,id',
        ]);

        $inmueble = Inmueble::create(collect($validated)->except('user_ids')->toArray());
        
        if (!empty($validated['user_ids'])) {
            $inmueble->propietarios()->attach($validated['user_ids']);
        }
        
        return redirect()->route('inmuebles.index')->with('success', 'Inmueble creado correctamente.');
    }

    public function show(Inmueble $inmueble)
    {
        $inmueble->load('propietarios', 'recibos');
        return view('inmuebles.show', compact('inmueble'));
    }

    public function edit(Inmueble $inmueble)
    {
        return view('inmuebles.edit', compact('inmueble'));
    }

    public function update(Request $request, Inmueble $inmueble)
    {
        $validated = $request->validate([
            'tipo' => 'required|in:piso,local,garaje,trastero',
            'bloque' => 'nullable|string|max:10',
            'piso' => 'required|string|max:10',
            'puerta' => 'required|string|max:10',
            'user_ids' => 'nullable|array',
            'user_ids.*' => 'exists:users,id',
        ]);

        $inmueble->update(collect($validated)->except('user_ids')->toArray());
        
        if ($request->has('user_ids')) {
            $inmueble->propietarios()->sync($validated['user_ids']);
        }

        return redirect()->route('inmuebles.index')->with('success', 'Inmueble actualizado correctamente.');
    }

    public function destroy(Inmueble $inmueble)
    {
        $inmueble->delete();
        return redirect()->route('inmuebles.index')->with('success', 'Inmueble eliminado correctamente.');
    }
}
