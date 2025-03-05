<?php

namespace Database\Seeders;

use App\Models\Genero;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GeneroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Genero::factory()->create(['nombre' => 'Aventura']);
        Genero::factory()->create(['nombre' => 'Acción']);
        Genero::factory()->create(['nombre' => 'Comedia']);
        Genero::factory()->create(['nombre' => 'Drama']);
    }
}
