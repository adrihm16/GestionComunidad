<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Incidencia;
use Illuminate\Http\Request;

class IncidenciaController extends Controller
{
    public function index()
    {
        $incidencias = Incidencia::with('creador')
            ->orderBy('fecha_creacion', 'desc')
            ->paginate(15);
        return view('admin.incidencias.index', compact('incidencias'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:100',
            'descripcion' => 'required|string',
            'prioridad' => 'required|in:baja,media,alta',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $fotoUrl = null;
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('incidencias', 'public');
            $fotoUrl = '/storage/' . $path;
        }

        Incidencia::create([
            'creador_id' => auth()->id(),
            'titulo' => $validated['titulo'],
            'descripcion' => $validated['descripcion'],
            'prioridad' => $validated['prioridad'],
            'foto_url' => $fotoUrl,
            'estado' => 'pendiente',
            'fecha_creacion' => now(),
            'fecha_actualizacion' => now(),
        ]);

        return redirect()->route('admin.dashboard')
            ->with('success', 'Incidencia reportada correctamente.');
    }

    public function update(Request $request, Incidencia $incidencia)
    {
        $validated = $request->validate([
            'estado' => 'required|in:pendiente,en_proceso,resuelta,rechazada',
        ]);

        $incidencia->update([
            'estado' => $validated['estado'],
            'fecha_actualizacion' => now(),
        ]);

        return redirect()->route('admin.dashboard')
            ->with('success', 'Estado de incidencia actualizado.');
    }

    public function destroy(Incidencia $incidencia)
    {
        $incidencia->delete();
        return redirect()->route('admin.incidencias.index')
            ->with('success', 'Incidencia eliminada correctamente.');
    }
}
