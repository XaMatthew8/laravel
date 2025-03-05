<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Editorial;
use App\Models\Genero;
use App\Models\Autor;
use App\Models\Manga;
use App\Models\Reseña;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        Editorial::factory(5)->create();
        Genero::factory(5)->create();
        Autor::factory(5)->create();
        Manga::factory(10)->create();
        Reseña::factory(10)->create();

        // Crear relaciones entre mangas, géneros y autores
        Manga::all()->each(function ($manga) {
            $manga->generos()->attach(Genero::inRandomOrder()->take(3)->pluck('id'));
            $manga->autores()->attach(Autor::inRandomOrder()->take(2)->pluck('id'));
        });
    }
}
