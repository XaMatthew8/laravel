<?php

namespace Database\Seeders;

use App\Models\Autor;
use App\Models\Manga;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MangaAutorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $manga = Manga::first(); // Asegúrate de que haya al menos un manga
        $autores = Autor::all(); // Asegúrate de que haya autores en la base de datos

        // Asignamos autores al manga
        $manga->autores()->attach($autores->pluck('id')->toArray());
    }
}
