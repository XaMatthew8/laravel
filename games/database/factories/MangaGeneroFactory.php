<?php

namespace Database\Factories;

use App\Models\Genero;
use App\Models\Manga;
use Illuminate\Database\Eloquent\Factories\Factory;

class MangaGeneroFactory extends Factory
{
    protected $model = Manga::class;

    public function definition()
    {
        return [
            'manga_id' => Manga::factory(),
            'genero_id' => Genero::factory(),
        ];
    }
}
