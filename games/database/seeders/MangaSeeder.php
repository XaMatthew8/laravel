<?php

namespace Database\Seeders;

use App\Models\Manga;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MangaSeeder extends Seeder
{
    public function run(): void
    {
        // Obtener alguna editorial para asignar a los mangas
        $editorial = Editorial::first(); // Asegúrate de que haya al menos una editorial en la base de datos

        Manga::factory()->create([
            'titulo' => 'One Piece',
            'descripcion' => 'Un manga de aventura y piratas.',
            'fecha_publicacion' => '1997-07-22',
            'editorial_id' => $editorial->id,
        ]);

        Manga::factory()->create([
            'titulo' => 'Naruto',
            'descripcion' => 'Un joven ninja busca reconocimiento mientras se enfrenta a numerosos enemigos.',
            'fecha_publicacion' => '1999-09-21',
            'editorial_id' => $editorial->id,
        ]);
    }
}
