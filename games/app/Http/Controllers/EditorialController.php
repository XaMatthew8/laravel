<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Editorial;
use App\Http\Middleware\AdminMiddleware;

class EditorialController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(AdminMiddleware::class)->except(['index', 'show', 'mangas']);
    }

    public function index()
    {
        $editorials = Editorial::with(['mangas'])->get();
        return view('editorials.index', compact('editorials'));
    }

    public function show(Editorial $editorial)
    {
        $editorial->load(['mangas.reseñas']);
        return view('editorials.show', compact('editorial'));
    }

    public function create()
    {
        return view('editorials.create');
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
        return view('editorials.edit', compact('editorial'));
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