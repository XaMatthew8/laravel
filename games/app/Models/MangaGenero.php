<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MangaGenero extends Model
{
    use HasFactory;

    protected $table = 'manga_genero'; // Nombre de la tabla intermedia

    protected $fillable = [
        'manga_id', 'genero_id'
    ];
}
