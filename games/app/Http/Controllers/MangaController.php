<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manga;

class MangaController extends Controller
{
    public function index() {
        return view('mangas.index', ['mangas' => Manga::all()]);
    }
    
    public function show(Manga $manga) {
        return view('mangas.show', compact('manga'));
    }
    
    public function create() {
        return view('mangas.create');
    }
    
    public function store(Request $request) {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'autor_id' => 'required|exists:autores,id',
            'editorial_id' => 'required|exists:editoriales,id',
        ]);
        
        Manga::create($validated);
        return redirect()->route('mangas.index');
    }
    
    public function edit(Manga $manga) {
        return view('mangas.edit', compact('manga'));
    }
    
    public function update(Request $request, Manga $manga) {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'autor_id' => 'required|exists:autores,id',
            'editorial_id' => 'required|exists:editoriales,id',
        ]);
        
        $manga->update($validated);
        return redirect()->route('mangas.index');
    }
    
    public function destroy(Manga $manga) {
        $manga->delete();
        return redirect()->route('mangas.index');
    }
}
