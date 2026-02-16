<?php

namespace App\Http\Controllers;

use App\Models\Incidencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IncidenciaController extends Controller
{
    public function index()
    {
        $incidencias = Incidencia::with('creador')->orderBy('fecha_creacion', 'desc')->get();
        return view('incidencias.index', compact('incidencias'));
    }

    public function create()
    {
        return view('incidencias.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:100',
            'descripcion' => 'required|string',
            'prioridad' => 'required|in:baja,media,alta',
            'foto_url' => 'nullable|string|max:255',
        ]);

        $validated['creador_id'] = Auth::id();
        $validated['estado'] = 'pendiente';
        $validated['fecha_creacion'] = now();
        $validated['fecha_actualizacion'] = now();

        Incidencia::create($validated);
        return redirect()->route('incidencias.index')->with('success', 'Incidencia creada correctamente.');
    }

    public function show(Incidencia $incidencia)
    {
        $incidencia->load('creador');
        return view('incidencias.show', compact('incidencia'));
    }

    public function edit(Incidencia $incidencia)
    {
        return view('incidencias.edit', compact('incidencia'));
    }

    public function update(Request $request, Incidencia $incidencia)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:100',
            'descripcion' => 'required|string',
            'estado' => 'required|in:pendiente,en_proceso,resuelta,rechazada',
            'prioridad' => 'required|in:baja,media,alta',
            'foto_url' => 'nullable|string|max:255',
        ]);

        $validated['fecha_actualizacion'] = now();

        $incidencia->update($validated);
        return redirect()->route('incidencias.index')->with('success', 'Incidencia actualizada correctamente.');
    }

    public function destroy(Incidencia $incidencia)
    {
        $incidencia->delete();
        return redirect()->route('incidencias.index')->with('success', 'Incidencia eliminada correctamente.');
    }
}
