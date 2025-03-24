<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Editorial;

class EditorialController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['show', 'index']);
        $this->middleware('admin')->only(['create', 'store', 'edit', 'update', 'destroy']);
    }

    public function index()
    {
        $editoriales = Editorial::with(['mangas'])->get();
        return view('editoriales.index', compact('editoriales'));
    }

    public function show(Editorial $editorial)
    {
        $editorial->load(['mangas.reseñas']);
        return view('editoriales.show', compact('editorial'));
    }

    public function create()
    {
        return view('editoriales.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'fecha_fundacion' => 'required|date',
            'pais_origen' => 'required|string|max:100',
        ]);

        Editorial::create($validated);
        return redirect()->route('editorials.index');
    }

    public function edit(Editorial $editorial)
    {
        return view('editoriales.edit', compact('editorial'));
    }

    public function update(Request $request, Editorial $editorial)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'fecha_fundacion' => 'required|date',
            'pais_origen' => 'required|string|max:100',
        ]);

        $editorial->update($validated);
        return redirect()->route('editorials.index');
    }

    public function destroy(Editorial $editorial)
    {
        $editorial->delete();
        return redirect()->route('editorials.index');
    }
}