<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\RecipeIngredient;
use App\Models\Recipe;
use App\Models\Ingredient;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RecipeIngredient>
 */
class RecipeIngredientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = RecipeIngredient::class;
    
    public function definition(): array
    {
        return [
            'recipe_id' => Recipe::factory(),
            'ingredient_id' => Ingredient::factory(),
            'amount' => $this->faker->randomFloat(2, 0, 100),
            'unit' => $this->faker->randomElement(['ml', 'g', 'oz', 'cup']),
        ];
    }
}
