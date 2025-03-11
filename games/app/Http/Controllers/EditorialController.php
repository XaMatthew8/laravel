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

    public function index() {
        return view('editoriales.index', ['editoriales' => Editorial::all()]);
    }
    
    public function create() {
        return view('editoriales.create');
    }
    
    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        
        Editorial::create($validated);
        return redirect()->route('editoriales.index');
    }
    
    public function edit(Editorial $editorial) {
        return view('editoriales.edit', compact('editorial'));
    }
    
    public function update(Request $request, Editorial $editorial) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        
        $editorial->update($validated);
        return redirect()->route('editoriales.index');
    }
    
    public function destroy(Editorial $editorial) {
        $editorial->delete();
        return redirect()->route('editoriales.index');
    }
}