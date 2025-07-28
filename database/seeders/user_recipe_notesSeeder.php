<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\user_recipe_notes;
use database\factories\user_recipe_notesFactory;

class user_recipe_notesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        user_recipe_notes::factory()->count(10)->create();
    }
}
