<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\repice_ingredients;
use database\factories\repice_ingredientsFactory;

class repiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        repice_ingredients::factory()->count(10)->create();
    }
}
