<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Manga;
use App\Models\Autor;
use App\Models\Genero;

class MangaSeeder extends Seeder
{
    public function run()
    {
        // Crear 20 mangas
        Manga::factory()
            ->count(20)
            ->create()
            ->each(function ($manga) {
                // Asignar 1-3 autores aleatorios a cada manga
                $manga->autores()->attach(
                    Autor::inRandomOrder()->take(rand(1, 3))->pluck('id')->toArray()
                );
                
                // Asignar 2-4 géneros aleatorios a cada manga
                $manga->generos()->attach(
                    Genero::inRandomOrder()->take(rand(2, 4))->pluck('id')->toArray()
                );
            });
    }
}
