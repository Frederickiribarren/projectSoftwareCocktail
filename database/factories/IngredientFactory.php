<?php

namespace Database\Factories;

use App\Models\Ingredient;
use Illuminate\Database\Eloquent\Factories\Factory;

class IngredientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ingredient::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->word(),
            'description' => $this->faker->sentence(),
            'alcohol_content' => $this->faker->randomFloat(2, 0, 40),
            'category' => $this->faker->randomElement(['spirits', 'liqueurs', 'mixers', 'garnish', 'other']),
            'unit' => $this->faker->randomElement(['ml', 'oz', 'drops', 'pieces']),
            'is_alcoholic' => $this->faker->boolean(70), // 70% probabilidad de ser alcohólico
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
