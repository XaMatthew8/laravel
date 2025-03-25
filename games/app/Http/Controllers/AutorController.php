<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Autor;
use App\Http\Middleware\AdminMiddleware;

class AutorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(AdminMiddleware::class)->except(['index', 'show', 'mangas']);
    } 
    
    public function index() {
        $autores = Autor::with(['mangas'])->get();
        return view('autores.index', compact('autores'));
    }
    
    public function show(Autor $autor) {
        $autor->load(['mangas.reseñas']);
        return view('autores.show', compact('autor'));
    }
    
    public function mangas(Autor $autor) {
        $mangas = $autor->mangas()->with(['genero', 'editorial'])->get();
        return view('autores.mangas', compact('autor', 'mangas'));
    }
    
    public function create() {
        return view('autores.create');
    }
    
    public function store(Request $request) {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'biografia' => 'required|string',
        ]);
        
        Autor::create($validated);
        return redirect()->route('autores.index')->with('success', 'Autor creado exitosamente');
    }
    
    public function edit(Autor $autor) {
        return view('autores.edit', compact('autor'));
    }
    
    public function update(Request $request, Autor $autor) {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'biografia' => 'required|string',
        ]);
        
        $autor->update($validated);
        return redirect()->route('autores.index')->with('success', 'Autor actualizado exitosamente');
    }
    
    public function destroy(Autor $autor) {
        $autor->delete();
        return redirect()->route('autores.index')->with('success', 'Autor eliminado exitosamente');
    }
}