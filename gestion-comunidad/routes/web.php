<?php
use Illuminate\Http\Request;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InmuebleController;
use App\Http\Controllers\ReciboController;
use App\Http\Controllers\IncidenciaController;
use App\Http\Controllers\NoticiaController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\VecinoController;
use App\Models\Evento;
use Carbon\Carbon;

// Helper to build calendar data for a given year/month
function buildCalendarData(int $year, int $month): array
{
    $date = Carbon::createFromDate($year, $month, 1);
    $monthNames = [
        1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril',
        5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto',
        9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre',
    ];

    // 0=Mon, 1=Tue ... 6=Sun (ISO weekday - 1)
    $startDayOfWeek = $date->dayOfWeekIso - 1;
    $daysInMonth = $date->daysInMonth;

    $now = Carbon::now();
    $today = ($now->year === $year && $now->month === $month) ? $now->day : null;

    // Fetch events for this month
    $startOfMonth = $date->copy()->startOfMonth();
    $endOfMonth = $date->copy()->endOfMonth();

    $eventos = Evento::where(function ($q) use ($startOfMonth, $endOfMonth) {
        $q->whereBetween('fecha_inicio', [$startOfMonth, $endOfMonth])
          ->orWhereBetween('fecha_fin', [$startOfMonth, $endOfMonth])
          ->orWhere(function ($q2) use ($startOfMonth, $endOfMonth) {
              $q2->where('fecha_inicio', '<=', $startOfMonth)
                 ->where('fecha_fin', '>=', $endOfMonth);
          });
    })->orderBy('fecha_inicio')->get();

    // Build per-day event flags and event list
    $eventDays = [];
    $eventList = [];

    foreach ($eventos as $evento) {
        $eStart = Carbon::parse($evento->fecha_inicio);
        $eEnd = Carbon::parse($evento->fecha_fin);

        // Mark each day the event spans within this month
        $dayFrom = max(1, $eStart->month === $month ? $eStart->day : 1);
        $dayTo = min($daysInMonth, $eEnd->month === $month ? $eEnd->day : $daysInMonth);

        for ($d = $dayFrom; $d <= $dayTo; $d++) {
            $eventDays[$d] = true;
        }

        $eventList[] = [
            'id' => $evento->id,
            'titulo' => $evento->titulo,
            'tipo' => $evento->tipo,
            'fecha_inicio' => $eStart->format('d M'),
            'fecha_fin' => $eEnd->format('d M'),
            'hora' => $eStart->format('H:i'),
            'multiday' => $eStart->toDateString() !== $eEnd->toDateString(),
        ];
    }

    return [
        'year' => $year,
        'month' => $month,
        'monthName' => $monthNames[$month],
        'daysInMonth' => $daysInMonth,
        'startDayOfWeek' => $startDayOfWeek,
        'today' => $today,
        'eventDays' => $eventDays,
        'events' => $eventList,
    ];
}

Route::middleware('auth')->group(function () {
    // Home page
    Route::get('/', function () {
        $ultimasNoticias = \App\Models\Noticia::with('autor')
            ->orderBy('fecha_publicacion', 'desc')
            ->take(2)
            ->get();

        $now = Carbon::now();
        $calendarData = buildCalendarData($now->year, $now->month);

        $ultimasIncidencias = \App\Models\Incidencia::with('creador')
            ->whereIn('estado', ['pendiente', 'en_proceso'])
            ->orderBy('fecha_creacion', 'desc')
            ->take(3)
            ->get();

        return view('inicio', compact('ultimasNoticias', 'calendarData', 'ultimasIncidencias'));
    })->name('inicio');

    // Calendar API (AJAX month navigation)
    Route::get('/api/calendar/{year}/{month}', function (int $year, int $month) {
        if ($month < 1 || $month > 12 || $year < 2020 || $year > 2100) {
            return response()->json(['error' => 'Fecha no válida'], 400);
        }
        return response()->json(buildCalendarData($year, $month));
    })->name('api.calendar');

    // Vecinos list
    Route::get('/vecinos', [VecinoController::class, 'index'])->name('vecinos.index');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Resource routes for community management
    Route::resource('inmuebles', InmuebleController::class);
    Route::resource('recibos', ReciboController::class);
    Route::resource('incidencias', IncidenciaController::class);
    Route::post('incidencias/{incidencia}/comentarios', [IncidenciaController::class, 'addComment'])->name('incidencias.comentarios.store');
    Route::post('incidencias/{incidencia}/estado', [IncidenciaController::class, 'updateEstado'])->name('incidencias.estado.update');
    Route::resource('noticias', NoticiaController::class);
    Route::resource('eventos', EventoController::class);
});

Route::get('/inicio', function () {
    return redirect('/');
});

Route::get('/dashboard', function () {
    return redirect('/');
})->name('dashboard');

require __DIR__.'/auth.php';
