<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manga extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo', 'descripcion', 'fecha_publicacion', 'editorial_id'
    ];

    public function editorial()
    {
        return $this->belongsTo(Editorial::class);
    }

    public function generos()
    {
        return $this->belongsToMany(Genero::class, 'manga_genero');
    }

    public function autores()
    {
        return $this->belongsToMany(Autor::class, 'manga_autor');
    }

    public function reseñas()
    {
        return $this->hasMany(Reseña::class);
    }
}