<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ingredients;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ingredients>
 */
class ingredientsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = ingredients::class;
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->word(),
            'description' => $this->faker->optional()->sentence(),
            'is_alcohol' => $this->faker->tinyint(1, 0),
            'parent_ingredient_id' => $this->faker->optional()->randomDigitNotNull(),
            'flavor_profile_tags' => $this->faker->optional()->words(3, true),
            'source_api_id' => $this->faker->optional()->uuid(),
        ];
    }
}
