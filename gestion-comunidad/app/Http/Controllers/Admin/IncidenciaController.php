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

    public function destroy(Incidencia $incidencia)
    {
        $incidencia->delete();
        return redirect()->route('admin.incidencias.index')
            ->with('success', 'Incidencia eliminada correctamente.');
    }
}
