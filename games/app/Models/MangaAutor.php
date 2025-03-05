<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MangaAutor extends Model
{
    use HasFactory;

    protected $table = 'manga_autor'; // Nombre de la tabla intermedia

    protected $fillable = [
        'manga_id', 'autor_id'
    ];
}
