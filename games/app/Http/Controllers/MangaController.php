<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manga;
use App\Models\Editorial;
use App\Models\Autor;
use App\Models\Genero;
use Illuminate\Support\Facades\Auth;

class MangaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['show', 'index']);
        $this->middleware('admin')->only(['create', 'store', 'edit', 'update', 'destroy']);
    }
    public function index() {
        $mangas = Manga::with(['autores', 'editorial', 'generos']);
        
        if (Auth::check()) {
            $mangas = $mangas->with(['usuariosConEstado' => function($query) {
                $query->where('user_id', Auth::id());
            }]);
        }

        $mangas = $mangas->get();

        return view('mangas.index', compact('mangas'));
    }
    
    public function show(Manga $manga) {
        return view('mangas.show', compact('manga'));
    }
    
    public function create()
    {
        $editoriales = Editorial::all();
        $autores = Autor::all();
        $generos = Genero::all();
        
        return view('mangas.create', compact('editoriales', 'autores', 'generos'));
    }
    
    public function store(Request $request) {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'fecha_publicacion' => 'required|date',
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
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'fecha_publicacion' => 'required|date',
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
