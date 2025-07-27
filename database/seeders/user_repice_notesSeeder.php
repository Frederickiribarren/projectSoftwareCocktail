<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\user_repice_notes;
use database\factories\user_repice_notesFactory;

class user_repice_notesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        user_repice_notes::factory()->count(10)->create();
    }
}
