<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SourceApiSeeder extends Seeder
{
    public function run()
    {
        $apis = [
            [
                'id' => 1,
                'name' => 'TheCocktailDB',
                'url' => 'https://www.thecocktaildb.com/api/json/v2/',
                'api_key' => '961249867',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'Manual Entry',
                'url' => null,
                'api_key' => null,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('source_apis')->insert($apis);
    }
}
