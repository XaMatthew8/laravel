<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reseña extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'manga_id', 'puntuacion', 'comentario'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function manga()
    {
        return $this->belongsTo(Manga::class, 'manga_id');
    }
}
