<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ingredient;
<<<<<<< HEAD
use database\factories\ingredientsFactory;
=======
>>>>>>> revision-docente

class ingredientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
<<<<<<< HEAD
    Ingredient::factory()->count(10)->create();
=======
        Ingredient::factory()->count(10)->create();
>>>>>>> revision-docente
    }
}
