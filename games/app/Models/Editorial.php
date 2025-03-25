<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Editorial extends Model
{
    use HasFactory;

    protected $table = 'editorials';

    protected $fillable = [
        'nombre'
    ];

    public function mangas()
    {
        return $this->hasMany(Manga::class);
    }
}
