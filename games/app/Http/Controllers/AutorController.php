<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Autor;

class AutorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['show', 'index']);
        $this->middleware('admin')->only(['create', 'store', 'edit', 'update', 'destroy']);
    } 
    
    public function index() {
        $autores = Autor::with(['mangas'])->get();
        return view('autores.index', compact('autores'));
    }
    
    public function show(Autor $author) {
        $author->load(['mangas.reseñas']);
        return view('autores.show', ['autor' => $author]);
    }
    
    public function create() {
        return view('autores.create');
    }
    
    public function store(Request $request) {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'biografia' => 'required|string',
            'fecha_nacimiento' => 'required|date',
            'nacionalidad' => 'required|string|max:100',
        ]);
        
        Autor::create($validated);
        return redirect()->route('authors.index');
    }
    
    public function edit(Autor $author) {
        return view('autores.edit', ['autor' => $author]);
    }
    
    public function update(Request $request, Autor $author) {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'biografia' => 'required|string',
            'fecha_nacimiento' => 'required|date',
            'nacionalidad' => 'required|string|max:100',
        ]);
        
        $author->update($validated);
        return redirect()->route('authors.index');
    }
    
    public function destroy(Autor $author) {
        $author->delete();
        return redirect()->route('authors.index');
    }
}