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
        $categories = [
            'Spirits',
            'Liqueurs',
            'Mixers',
            'Juices',
            'Fruits',
            'Herbs',
            'Syrups',
            'Others'
        ];

        $flavorProfiles = [
            'Sweet',
            'Sour',
            'Bitter',
            'Spicy',
            'Fruity',
            'Herbal',
            'Woody',
            'Floral',
            'Citrus',
            'Smoky'
        ];

        // Obtener un ID de ingrediente existente o null
        $parentIngredientId = ingredients::inRandomOrder()->first()?->id;

        // Determinar si es alcohólico basado en la categoría
        $category = $this->faker->randomElement($categories);
        $isAlcoholic = in_array($category, ['Spirits', 'Liqueurs']) ? true : $this->faker->boolean(20);

        return [
            'name' => $this->faker->unique()->word(),
            'description' => $this->faker->sentence(),
            'category' => $category,
            'is_alcoholic' => $isAlcoholic,
            'parent_ingredient_id' => $parentIngredientId,
            'flavor_profile_tags' => json_encode($this->faker->randomElements($flavorProfiles, random_int(1, 3))),
            'source_api_id' => $this->faker->uuid(),
        ];
    }
}
