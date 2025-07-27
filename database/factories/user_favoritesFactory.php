<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\user_favorites;
use App\Models\users;
use App\Models\recipes;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\user_favorites>
 */
class user_favoritesFactory extends Factory
{
    protected $model = user_favorites::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        
        return [
            'user_id' => users::factory(),
            'recipe_id' => recipes::factory(),
        ];
    }
}
