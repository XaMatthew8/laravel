<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manga;


class MangaController extends Controller
{
    public function index(){
        $manga = Manga::all();
        return view('mangas.index', compact('mangas'));
    }
}
