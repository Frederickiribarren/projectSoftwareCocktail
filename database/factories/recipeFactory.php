<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\recipe;
use App\Models\User;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\recipe>
 */
class recipeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = recipe::class;
    public function definition(): array
    {
        $isFromApi = $this->faker->boolean(30); // 30% de probabilidad de ser de una API
        
        return [
            'name' => $this->faker->unique()->word(),
            'instructions' => $this->faker->sentence(),
            'glass_type' => $this->faker->randomElement(['martini', 'highball', 'rocks', 'shot']),
            'garnish' => $this->faker->optional()->word(),
            'image_url' => $this->faker->imageUrl(),
            'user_id' => $isFromApi ? null : User::factory(),
            'source' => $isFromApi ? 'system' : $this->faker->randomElement(['user_manual', 'user_ocr', 'user_ai_generated']),
            'is_private' => $this->faker->boolean(),
            'source_api_id' => $isFromApi ? 1 : null,  // 1 = TheCocktailDB, null = entrada manual
        ];
    }
}
