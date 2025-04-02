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
            'titulo' => $this->faker->sentence(3),
            'descripcion' => $this->faker->paragraph(),
            'fecha_publicacion' => $this->faker->date(),
            'editorial_id' => Editorial::factory(),
            'rating' => $this->faker->randomFloat(2, 0, 10),
            'imagen_portada' => 'https://picsum.photos/seed/' . $this->faker->unique()->word . '/300/400'
        ];
    }
}
