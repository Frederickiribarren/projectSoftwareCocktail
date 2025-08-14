<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DefaultCategorySeeder extends Seeder
{
    public function run()
    {
        DB::table('ingredient_categories')->insertOrIgnore([
            [
                'name' => 'Sin Categorizar',
                'description' => 'Categoría por defecto para ingredientes importados',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
