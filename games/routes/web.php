<?php

use App\Http\Controllers\MangaController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AutorController;
use App\Http\Controllers\EditorialController;
use App\Http\Controllers\GeneroController;
use App\Http\Controllers\ResenaController;
use App\Http\Controllers\MangaStateController;

// Rutas públicas
Route::get('/', function () {
    return view('welcome');
});

// Rutas de mangas
Route::resource('mangas', MangaController::class);
Route::get('/mangas', [MangaController::class, 'index'])->name('mangas.index');
Route::get('/mangas/{manga}', [MangaController::class, 'show'])->name('mangas.show');

// Rutas públicas adicionales
Route::get('/autores/{autor}/mangas', [AutorController::class, 'mangas'])->name('autores.mangas');
Route::get('/editorials/{editorial}/mangas', [EditorialController::class, 'mangas'])->name('editorials.mangas');
Route::get('/generos/{genero}/mangas', [GeneroController::class, 'mangas'])->name('generos.mangas');

// Rutas que requieren autenticación
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rutas de estados de manga para usuarios normales
    Route::post('/mangas/{manga}/state', [MangaStateController::class, 'store'])->name('manga.state.store');
    Route::put('/mangas/{manga}/state', [MangaStateController::class, 'update'])->name('manga.state.update');
    Route::delete('/mangas/{manga}/state', [MangaStateController::class, 'destroy'])->name('manga.state.remove');
    Route::get('/mis-mangas', [MangaStateController::class, 'index'])->name('manga.state.index');

    // Rutas de reseñas (requieren autenticación)
    Route::resource('resenas', ResenaController::class)->only(['store', 'destroy']);
    Route::get('/mangas/{manga}/resenas', [ResenaController::class, 'index'])->name('mangas.resenas.index');

    // Rutas adicionales para manga
    Route::get('/mangas/estados', [MangaController::class, 'estados'])->name('mangas.estados');

    // Nueva ruta para cambiar el estado del manga
    Route::post('/mangas/{manga}/cambiar-estado', [MangaController::class, 'cambiarEstado'])->name('mangas.cambiar-estado');
    
    // Nueva ruta para eliminar el estado del manga
    Route::delete('/mangas/{manga}/eliminar-estado', [MangaController::class, 'eliminarEstado'])->name('mangas.eliminar-estado');

    // Rutas de administración de recursos
    Route::resource('generos', GeneroController::class)->except(['show']);
});

// Rutas de administración de recursos (protegidas por middleware en sus respectivos controladores)
Route::resource('autores', AutorController::class)->parameters(['autores' => 'autor']);
Route::resource('editorials', EditorialController::class);

require __DIR__.'/auth.php';
