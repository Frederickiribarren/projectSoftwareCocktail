<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\recipe_ingredients;
use database\factories\recipe_ingredientsFactory;

class repice_ingredientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        recipe_ingredients::factory()->count(10)->create();
    }
}
