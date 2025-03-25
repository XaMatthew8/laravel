<?php

namespace App\Http\Controllers;

use App\Models\Manga;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MangaStateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        /** @var User $user */
        $user = Auth::user();
        
        $mangasLeidos = $user->mangasLeidos()->get();
        $mangasPendientes = $user->mangasPendientes()->get();
        $mangasLeyendo = $user->mangasLeyendo()->get();
        $mangasAbandonados = $user->mangasAbandonados()->get();

        return view('mangas.estados.index', compact(
            'mangasLeidos',
            'mangasPendientes',
            'mangasLeyendo',
            'mangasAbandonados'
        ));
    }

    public function updateState(Request $request, Manga $manga)
    {
        $request->validate([
            'state' => 'required|in:leido,pendiente,leyendo,abandonado'
        ]);

        /** @var User $user */
        $user = Auth::user();
        
        $user->mangasConEstado()->syncWithoutDetaching([
            $manga->id => ['state' => $request->state]
        ]);

        return back()->with('success', 'Estado del manga actualizado correctamente');
    }

    public function removeState(Manga $manga)
    {
        /** @var User $user */
        $user = Auth::user();
        $user->mangasConEstado()->detach($manga->id);

        return back()->with('success', 'Manga eliminado de tu lista');
    }
} 