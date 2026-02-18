<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReciboController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Hardcoded data for design verification
        $recibos = [
            (object)[
                'id' => 1024,
                'fecha_emision' => Carbon::parse('2026-03-01'),
                'inmueble' => (object)['tipo' => 'piso', 'piso' => '1', 'puerta' => 'A'],
                'propietario' => (object)['nombre' => 'Juan', 'apellidos' => 'Pérez', 'cargo_comunidad' => 'Presidente'],
                'concepto' => 'Cuota Marzo 2026',
                'monto' => 50.00,
                'estado' => 'pagado',
            ],
            (object)[
                'id' => 1025,
                'fecha_emision' => Carbon::parse('2026-03-01'),
                'inmueble' => (object)['tipo' => 'piso', 'piso' => '2', 'puerta' => 'B'],
                'propietario' => (object)['nombre' => 'Ana', 'apellidos' => 'García', 'cargo_comunidad' => null],
                'concepto' => 'Cuota Marzo 2026',
                'monto' => 50.00,
                'estado' => 'pendiente',
            ],
            (object)[
                'id' => 1023,
                'fecha_emision' => Carbon::parse('2026-02-01'),
                'inmueble' => (object)['tipo' => 'local', 'piso' => 'Bajo', 'puerta' => 'Dcha'],
                'propietario' => (object)['nombre' => 'Carlos', 'apellidos' => 'Ruiz', 'cargo_comunidad' => null],
                'concepto' => 'Derrama Pintura',
                'monto' => 120.50,
                'estado' => 'pendiente',
            ],
            (object)[
                'id' => 1020,
                'fecha_emision' => Carbon::parse('2026-01-01'),
                'inmueble' => (object)['tipo' => 'piso', 'piso' => '3', 'puerta' => 'C'],
                'propietario' => (object)['nombre' => 'Elena', 'apellidos' => 'Morales', 'cargo_comunidad' => 'Secretario'],
                'concepto' => 'Cuota Enero 2026',
                'monto' => 50.00,
                'estado' => 'pagado',
            ],
        ];

        return view('admin.recibos.index', compact('recibos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
