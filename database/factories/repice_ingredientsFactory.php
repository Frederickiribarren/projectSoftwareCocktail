<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\repice_ingredients;
use App\Models\recipe;
use App\Models\ingredients;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\repice_ingredients>
 */
class repice_ingredientsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
     protected $model = repice_ingredients::class;
    public function definition(): array
    {
       
        return [
            'recipe_id' => recipe::factory(),
            'ingredient_id' => ingredients::factory(),
            'amount' => $this->faker->randomFloat(2, 0, 100),
            'unit' => $this->faker->randomElement(['ml', 'g', 'oz', 'cup']),
        ];
    }
}
