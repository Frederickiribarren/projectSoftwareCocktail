<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this-> call([
            ingredientsSeeder::class,
            inventoriesSeeder::class,
            usersSeeder::class,
            recipeSeeder::class,
            recipe_ingredientsSeeder::class,
            ocr_jobsSeeder::class,
            user_repice_notesSeeder::class,
            user_favoritesSeeder::class,
        ]);
    }
    // para ejecutar los seeders completos comando php artisan db:seed
    // para ejecutar un seeder en especifico comando php artisan db:seed --class="Database\Seeders\NombreDelSeeder"
    // para ejecutar un seeder en especifico con un nombre corto comando php artisan db:seed --class=NombreDelSeeder  
}
