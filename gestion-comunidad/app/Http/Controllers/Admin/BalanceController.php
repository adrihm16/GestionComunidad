<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gasto;
use App\Models\Recibo;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BalanceController extends Controller
{
    public function index(Request $request)
    {
        $year = $request->get('year', now()->year);
        $month = $request->get('month'); // Opcional

        // IBAN de la comunidad
        $iban = Setting::get('iban');

        // Base query para INGRESOS
        $queryIngresos = Recibo::where('estado', 'pagado')
            ->where(function($query) use ($year, $month) {
                // Filtro por año (obligatorio)
                $query->where(function($q) use ($year) {
                    $q->whereYear('fecha_pago', $year)
                      ->orWhere(function($sq) use ($year) {
                          $sq->whereNull('fecha_pago')->whereYear('updated_at', $year);
                      });
                });

                // Filtro por mes (opcional)
                if ($month) {
                    $query->where(function($q) use ($month) {
                        $q->whereMonth('fecha_pago', $month)
                          ->orWhere(function($sq) use ($month) {
                              $sq->whereNull('fecha_pago')->whereMonth('updated_at', $month);
                          });
                    });
                }
            });

        $totalIngresos = (clone $queryIngresos)->sum('monto');

        // Base query para GASTOS
        $queryGastos = Gasto::whereYear('fecha', $year);
        if ($month) {
            $queryGastos->whereMonth('fecha', $month);
        }

        $totalGastos = (clone $queryGastos)->sum('monto');

        $balanceNeto = $totalIngresos - $totalGastos;

        // Lista de gastos filtrada
        $gastos = $queryGastos->with('registradoPor')
            ->orderBy('fecha', 'desc')
            ->get();

        // Lista de ingresos filtrada
        $ingresos = $queryIngresos->with('inmueble.propietarios')
            ->orderBy('fecha_pago', 'desc')
            ->orderBy('updated_at', 'desc')
            ->get();
        
        // Años disponibles
        $years = collect(range(now()->year, 2024))->toArray();

        // Meses para el selector
        $meses = [
            '1' => 'Enero', '2' => 'Febrero', '3' => 'Marzo', '4' => 'Abril',
            '5' => 'Mayo', '6' => 'Junio', '7' => 'Julio', '8' => 'Agosto',
            '9' => 'Septiembre', '10' => 'Octubre', '11' => 'Noviembre', '12' => 'Diciembre'
        ];

        return view('admin.balance.index', compact(
            'totalIngresos',
            'totalGastos',
            'balanceNeto',
            'gastos',
            'ingresos',
            'year',
            'month',
            'years',
            'meses',
            'iban'
        ));
    }

    /**
     * Store or update a community setting.
     */
    public function updateSetting(Request $request)
    {
        $request->validate([
            'key' => 'required|string',
            'value' => 'nullable|string'
        ]);

        Setting::set($request->key, $request->value);

        return back()->with('success', 'Información actualizada correctamente');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'concepto'    => 'required|string|max:150',
            'monto'       => 'required|numeric|min:0.01',
            'categoria'   => 'required|in:mantenimiento,limpieza,suministros,obras,otro',
            'fecha'       => 'required|date',
            'descripcion' => 'nullable|string|max:1000',
            'adjunto'     => 'nullable|file|mimes:pdf,jpg,jpeg,png,webp|max:5120',
        ]);

        $adjuntoUrl = null;
        if ($request->hasFile('adjunto')) {
            $path = $request->file('adjunto')->store('gastos', 'public');
            $adjuntoUrl = '/storage/' . $path;
        }

        Gasto::create([
            'concepto'        => $validated['concepto'],
            'monto'           => $validated['monto'],
            'categoria'       => $validated['categoria'],
            'fecha'           => $validated['fecha'],
            'descripcion'     => $validated['descripcion'] ?? null,
            'adjunto_url'     => $adjuntoUrl,
            'registrado_por'  => Auth::id(),
        ]);

        return redirect()->route('admin.balance.index')
            ->with('success', 'Gasto registrado correctamente.');
    }

    public function destroy(Gasto $gasto)
    {
        if ($gasto->adjunto_url) {
            $path = str_replace('/storage/', '', $gasto->adjunto_url);
            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
        }

        $gasto->delete();

        return redirect()->route('admin.balance.index')
            ->with('success', 'Gasto eliminado correctamente.');
    }
}
