<?php

namespace Database\Factories;

use App\Models\Editorial;
use App\Models\Manga;
use Illuminate\Database\Eloquent\Factories\Factory;

class MangaFactory extends Factory
{
    protected $model = Manga::class;

    public function definition()
    {
        return [
            'titulo' => $this->faker->sentence(),
            'descripcion' => $this->faker->paragraph(),
            'fecha_publicacion' => $this->faker->date(),
            'editorial_id' => Editorial::factory(),
        ];
    }
}
