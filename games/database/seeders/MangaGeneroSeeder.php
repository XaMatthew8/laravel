<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Manga;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MangaGeneroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $manga = Manga::first(); // Asegúrate de que haya al menos un manga
        $generos = Genero::all(); // Asegúrate de que haya géneros en la base de datos

        // Asignamos géneros al manga
        $manga->generos()->attach($generos->pluck('id')->toArray());
    }
}
