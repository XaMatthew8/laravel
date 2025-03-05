<?php

namespace Database\Factories;

use App\Models\Autor;
use App\Models\Manga;
use Illuminate\Database\Eloquent\Factories\Factory;

class MangaAutorFactory extends Factory
{
    protected $model = Manga::class;

    public function definition()
    {
        return [
            'manga_id' => Manga::factory(),
            'autor_id' => Autor::factory(),
        ];
    }
}
