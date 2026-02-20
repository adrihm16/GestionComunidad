<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Recibo;
use App\Models\Inmueble;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Validation\Rule;

class ReciboController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Recibo::with(['inmueble.propietarios']);

        // Year Filter
        if ($request->filled('anio')) {
            $query->whereYear('fecha_emision', $request->anio);
        }

        // Month Filter
        if ($request->filled('mes')) {
            $query->whereMonth('fecha_emision', $request->mes);
        }

        // Search Filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('concepto', 'like', "%{$search}%")
                  ->orWhereHas('inmueble', function($q2) use ($search) {
                      $q2->where('piso', 'like', "%{$search}%")
                         ->orWhere('puerta', 'like', "%{$search}%")
                         ->orWhereHas('propietarios', function($q3) use ($search) {
                             $q3->where('nombre', 'like', "%{$search}%")
                                ->orWhere('apellidos', 'like', "%{$search}%");
                         });
                  });
            });
        }

        $recibos = $query->orderBy('fecha_emision', 'desc')->simplePaginate(5)->withQueryString();
        $inmuebles = Inmueble::with('propietarios')->get(); // For the create modal

        return view('admin.recibos.index', compact('recibos', 'inmuebles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'inmueble_id' => 'required|exists:inmuebles,id',
            'monto' => 'required|numeric|min:0',
            'fecha_emision' => 'required|date',
            'concepto' => 'required|string|max:100',
        ]);

        $startDate = Carbon::parse($validated['fecha_emision']);
        $year = $startDate->year;
        $startMonth = $startDate->month;

        // Loop from start month to December
        for ($month = $startMonth; $month <= 12; $month++) {
            $emissionDate = Carbon::create($year, $month, $startDate->day);
            
            // Generate concept with month name if needed, or keep static?
            // User asked: "web will create a receipt for each month". 
            // I'll append the month name dynamically to be helpful, 
            // e.g., "Cuota Comunidad - Marzo 2026"
            // But if the concept is just "Derrama", maybe we don't want that.
            // Let's stick to the static concept but maybe add the month if it's "Cuota".
            // To be safe and simple: Use the exact concept provided. 
            // BUT, usually "Cuota Comunidad" implies monthly. 
            // Let's modify the concept to include the month/year to distinguish them.
            
            $monthName = $emissionDate->locale('es')->monthName; // requires locale set app
            $concept = $validated['concepto'] . " - " . ucfirst($monthName) . " " . $year;

            Recibo::create([
                'inmueble_id' => $validated['inmueble_id'],
                'concepto' => $concept,
                'monto' => $validated['monto'],
                'fecha_emision' => $emissionDate,
                'fecha_vencimiento' => $emissionDate->copy()->addDays(20), // Standard 20 days due
                'estado' => 'pendiente',
            ]);
        }

        return redirect()->route('admin.recibos.index')
            ->with('success', 'Recibos generados correctamente hasta final de año.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Recibo $recibo)
    {
        // Handle Status Toggle (if sent specifically)
        if ($request->has('toggle_status')) {
            $recibo->estado = $recibo->estado === 'pagado' ? 'pendiente' : 'pagado';
            if ($recibo->estado === 'pagado') {
                $recibo->fecha_pago = \Illuminate\Support\Carbon::now();
            } else {
                $recibo->fecha_pago = null;
            }
            $recibo->save();
            return back()->with('success', 'Estado del recibo actualizado.');
        }

        // Handle Normal Update (Amount)
        $validated = $request->validate([
            'monto' => 'required|numeric|min:0',
        ]);

        $recibo->update($validated);

        return back()->with('success', 'Recibo actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recibo $recibo)
    {
        $recibo->delete();
        return back()->with('success', 'Recibo eliminado correctamente.');
    }
}
