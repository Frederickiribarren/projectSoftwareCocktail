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
        
        $source =[
            'system',
            'user_manual',
            'user_ocr',
            'user_ai_generated'
        ];
        return [
            'name' => $this->faker->unique()->word(),
            'instructions' => $this->faker->sentence(),
            'glass_type' => $this->faker->randomElement(['highball', 'lowball', 'martini', 'shot']),
            'garnish' => $this->faker->optional()->word(),
            'image_url' => $this->faker->imageUrl(),
            'user_id' => User::factory(),
            'source' => $this->faker->randomElement($source),
            'is_private' => $this->faker->numberBetween(0, 1),
            'source_api_id' => $this->faker->optional()->uuid(),
        ];
    }
}
