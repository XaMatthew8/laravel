<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genero;
use App\Http\Middleware\AdminMiddleware;

class GeneroController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(AdminMiddleware::class)->except(['index', 'show', 'mangas']);
    }

    public function index() {
        $generos = Genero::withCount('mangas')->get();
        return view('generos.index', compact('generos'));
    }
    
    public function create() {
        return view('generos.create');
    }
    
    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Genero::create($validated);
        return redirect()->route('generos.index')->with('success', 'Género creado correctamente');
    }
    
    public function edit(Genero $genero) {
        return view('generos.edit', compact('genero'));
    }
    
    public function update(Request $request, Genero $genero) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        
        $genero->update($validated);
        return redirect()->route('generos.index')->with('success', 'Género actualizado correctamente');
    }
    
    public function destroy(Genero $genero) {
        $genero->delete();
        return redirect()->route('generos.index')->with('success', 'Género eliminado correctamente');
    }

    public function mangas(Genero $genero)
    {
        $mangas = $genero->mangas()->with(['autores', 'editorial'])->get();
        return view('generos.mangas', compact('genero', 'mangas'));
    }
}