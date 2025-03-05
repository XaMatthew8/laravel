<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Manga;
use App\Models\Reseña;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReseñaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Asignamos un usuario y manga para las reseñas
        $user = User::first(); // Asegúrate de que haya al menos un usuario en la base de datos
        $manga = Manga::first(); // Asegúrate de que haya al menos un manga en la base de datos

        Reseña::factory()->create([
            'user_id' => $user->id,
            'manga_id' => $manga->id,
            'puntuacion' => 5,
            'comentario' => '¡Increíble manga! Me encantó la trama y los personajes.',
        ]);
    }
}
