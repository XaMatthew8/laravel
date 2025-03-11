<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reseña;

class ResenaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin')->only(['destroy']);
    }
    
    public function store(Request $request) {
        $validated = $request->validate([
            'content' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'manga_id' => 'required|exists:mangas,id',
        ]);
        
        Reseña::create($validated);
        return redirect()->back();
    }
    
    public function destroy(Reseña $resena) {
        $resena->delete();
        return redirect()->back();
    }
}
