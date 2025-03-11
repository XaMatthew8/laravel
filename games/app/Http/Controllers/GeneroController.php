<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genero;

class GeneroController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['show', 'index']);
        $this->middleware('admin')->only(['create', 'store', 'edit', 'update', 'destroy']);
    }

    public function index() {
        return view('generos.index', ['generos' => Genero::all()]);
    }
    
    public function create() {
        return view('generos.create');
    }
    
    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Genero::create($validated);
        return redirect()->route('generos.index');
    }
    
    public function edit(Genero $Genero) {
        return view('generos.edit', compact('Genero'));
    }
    
    public function update(Request $request, Genero $Genero) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        
        $Genero->update($validated);
        return redirect()->route('generos.index');
    }
    
    public function destroy(Genero $Genero) {
        $Genero->delete();
        return redirect()->route('generos.index');
    }
}