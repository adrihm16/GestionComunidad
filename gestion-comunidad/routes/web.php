<?php
use Illuminate\Http\Request;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SumaController;
use App\Http\Controllers\InmuebleController;
use App\Http\Controllers\ReciboController;
use App\Http\Controllers\IncidenciaController;
use App\Http\Controllers\NoticiaController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\VecinoController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/inicio', function () {
    return view('inicio');
});

Route::get('/suma', [SumaController::class, 'index']);
Route::post('/suma', [SumaController::class, 'calcular']);

Route::get('/vecinos', [VecinoController::class, 'index']);

Route::middleware('auth')->group(function () {
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

require __DIR__.'/auth.php';
