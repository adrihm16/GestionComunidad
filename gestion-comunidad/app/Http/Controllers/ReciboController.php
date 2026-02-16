<?php

namespace App\Http\Controllers;

use App\Models\Recibo;
use Illuminate\Http\Request;

class ReciboController extends Controller
{
    public function index()
    {
        $recibos = Recibo::with('inmueble.propietario')->get();
        return view('recibos.index', compact('recibos'));
    }

    public function create()
    {
        return view('recibos.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'inmueble_id' => 'required|exists:inmuebles,id',
            'concepto' => 'required|string|max:100',
            'monto' => 'required|numeric|min:0',
            'fecha_emision' => 'required|date',
            'fecha_vencimiento' => 'required|date|after_or_equal:fecha_emision',
            'fecha_pago' => 'nullable|date',
            'estado' => 'required|in:pendiente,pagado,vencido',
            'url_factura_pdf' => 'nullable|string|max:255',
        ]);

        Recibo::create($validated);
        return redirect()->route('recibos.index')->with('success', 'Recibo creado correctamente.');
    }

    public function show(Recibo $recibo)
    {
        $recibo->load('inmueble.propietario');
        return view('recibos.show', compact('recibo'));
    }

    public function edit(Recibo $recibo)
    {
        return view('recibos.edit', compact('recibo'));
    }

    public function update(Request $request, Recibo $recibo)
    {
        $validated = $request->validate([
            'inmueble_id' => 'required|exists:inmuebles,id',
            'concepto' => 'required|string|max:100',
            'monto' => 'required|numeric|min:0',
            'fecha_emision' => 'required|date',
            'fecha_vencimiento' => 'required|date|after_or_equal:fecha_emision',
            'fecha_pago' => 'nullable|date',
            'estado' => 'required|in:pendiente,pagado,vencido',
            'url_factura_pdf' => 'nullable|string|max:255',
        ]);

        $recibo->update($validated);
        return redirect()->route('recibos.index')->with('success', 'Recibo actualizado correctamente.');
    }

    public function destroy(Recibo $recibo)
    {
        $recibo->delete();
        return redirect()->route('recibos.index')->with('success', 'Recibo eliminado correctamente.');
    }
}
