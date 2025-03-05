<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Autor extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre', 'biografia'
    ];

    public function mangas()
    {
        return $this->belongsToMany(Manga::class, 'manga_autor');
    }
}

