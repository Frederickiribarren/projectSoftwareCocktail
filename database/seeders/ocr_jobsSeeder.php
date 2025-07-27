<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ocr_jobs;
use database\factories\ocr_jobsFactory;

class ocr_jobsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ocr_jobs::factory()->count(10)->create();
    }
}
