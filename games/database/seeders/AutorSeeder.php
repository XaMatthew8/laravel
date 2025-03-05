<?php

namespace Database\Seeders;

use App\Models\Autor;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AutorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Autor::factory()->create([
            'nombre' => 'Eiichiro Oda',
            'biografia' => 'Creador de One Piece.',
        ]);

        Autor::factory()->create([
            'nombre' => 'Masashi Kishimoto',
            'biografia' => 'Creador de Naruto.',
        ]);
    }
}
