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
        return view('autores.index', ['autores' => Autor::all()]);
    }
    
    public function create() {
        return view('autores.create');
    }
    
    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        
        Autor::create($validated);
        return redirect()->route('autores.index');
    }
    
    public function edit(Autor $autor) {
        return view('autores.edit', compact('autor'));
    }
    
    public function update(Request $request, Autor $autor) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        
        $autor->update($validated);
        return redirect()->route('autores.index');
    }
    
    public function destroy(Autor $autor) {
        $autor->delete();
        return redirect()->route('autores.index');
    }
}