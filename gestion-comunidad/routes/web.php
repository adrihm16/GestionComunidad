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

Route::middleware('auth')->group(function () {
    // Home page
    Route::get('/', function () {
        $ultimasNoticias = \App\Models\Noticia::with('autor')
            ->orderBy('fecha_publicacion', 'desc')
            ->take(2)
            ->get();

        return view('inicio', compact('ultimasNoticias'));
    })->name('inicio');

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
