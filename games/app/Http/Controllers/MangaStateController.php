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

    public function update(Request $request, Manga $manga)
    {
        $request->validate([
            'state' => 'required|in:leido,leyendo,pendiente,abandonado'
        ]);

        /** @var User $user */
        $user = Auth::user();
        $currentState = $user->mangasConEstado()->where('manga_id', $manga->id)->first();

        if ($currentState) {
            if ($currentState->pivot->state === $request->state) {
                // Si el estado es el mismo, lo eliminamos
                $user->mangasConEstado()->detach($manga->id);
            } else {
                // Si el estado es diferente, lo actualizamos
                $user->mangasConEstado()->updateExistingPivot($manga->id, [
                    'state' => $request->state
                ]);
            }
        } else {
            // Si no existe un estado, lo creamos
            $user->mangasConEstado()->attach($manga->id, [
                'state' => $request->state
            ]);
        }

        return back()->with('success', 'Estado actualizado correctamente');
    }

    public function removeState(Manga $manga)
    {
        /** @var User $user */
        $user = Auth::user();
        $user->mangasConEstado()->detach($manga->id);

        return back()->with('success', 'Manga eliminado de tu lista');
    }
} 