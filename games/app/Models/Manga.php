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
        return $this->hasMany(Reseña::class, 'manga_id');
    }

    public function usuariosConEstado()
    {
        return $this->belongsToMany(User::class, 'manga_user_states')
                    ->withPivot('state')
                    ->withTimestamps();
    }

    public function usuariosLeyendo()
    {
        return $this->usuariosConEstado()->wherePivot('state', 'leyendo');
    }

    public function usuariosLeido()
    {
        return $this->usuariosConEstado()->wherePivot('state', 'leido');
    }

    public function usuariosPendiente()
    {
        return $this->usuariosConEstado()->wherePivot('state', 'pendiente');
    }

    public function usuariosAbandonado()
    {
        return $this->usuariosConEstado()->wherePivot('state', 'abandonado');
    }
}