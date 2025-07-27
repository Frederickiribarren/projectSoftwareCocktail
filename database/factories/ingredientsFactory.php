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
        // Obtener un ID de ingrediente existente o null
        $parentIngredientId = ingredients::inRandomOrder()->first()?->id;
        return [
            'name' => $this->faker->unique()->word(),
            'description' => $this->faker->optional()->sentence(),
            'is_alcoholic' => $this->faker->numberBetween(0, 1),
            'parent_ingredient_id' =>  $parentIngredientId,
            'flavor_profile_tags' => json_encode($this->faker->optional()->words(3, true)),
            'source_api_id' => $this->faker->optional()->uuid(),
        ];
    }
}
