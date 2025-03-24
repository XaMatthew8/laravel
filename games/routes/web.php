<?php

use App\Http\Controllers\MangaController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AutorController;
use App\Http\Controllers\EditorialController;
use App\Http\Controllers\GeneroController;
use App\Http\Controllers\ResenaController;

Route::resource('mangas', MangaController::class);
Route::resource('authors', AutorController::class);
Route::resource('editorials', EditorialController::class);
Route::resource('generos', GeneroController::class);
Route::resource('Resenas', ResenaController::class)->only(['store', 'destroy']);

// Rutas adicionales
Route::get('/mangas/{manga}/resenas', [ResenaController::class, 'index'])->name('mangas.resenas.index');
Route::get('/authors/{author}/mangas', [AutorController::class, 'mangas'])->name('autors.mangas');
Route::get('/gditorials/{editorial}/mangas', [EditorialController::class, 'mangas'])->name('editorials.mangas');
Route::get('/generos/{genero}/mangas', [GeneroController::class, 'mangas'])->name('generos.mangas');
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
