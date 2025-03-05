<?php

namespace Database\Factories;

use App\Models\Manga;
use App\Models\Reseña;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReseñaFactory extends Factory
{
    protected $model = Reseña::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'manga_id' => Manga::factory(),
            'puntuacion' => $this->faker->numberBetween(1, 5),
            'comentario' => $this->faker->paragraph(),
        ];
    }
}
