<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Manga;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'admin',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'admin' => 'boolean',
    ];

    public function reseñas()
    {
        return $this->hasMany(Reseña::class, 'user_id');
    }

    public function mangasConEstado()
    {
        return $this->belongsToMany(Manga::class, 'manga_user_states')
                    ->withPivot('state')
                    ->withTimestamps();
    }

    public function mangasLeidos()
    {
        return $this->mangasConEstado()
                    ->wherePivot('state', 'leido')
                    ->with(['autores', 'editorial']);
    }

    public function mangasPendientes()
    {
        return $this->mangasConEstado()
                    ->wherePivot('state', 'pendiente')
                    ->with(['autores', 'editorial']);
    }

    public function mangasLeyendo()
    {
        return $this->mangasConEstado()
                    ->wherePivot('state', 'leyendo')
                    ->with(['autores', 'editorial']);
    }

    public function mangasAbandonados()
    {
        return $this->mangasConEstado()
                    ->wherePivot('state', 'abandonado')
                    ->with(['autores', 'editorial']);
    }

    public function is_admin() {
        return $this->admin === true;
    }
}
