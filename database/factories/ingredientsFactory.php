<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Ingredient;

class ingredientsFactory extends Factory
{
    protected $model = Ingredient::class;

    protected static $categories = ['spirits', 'liqueurs', 'juices', 'mixers', 'others'];
    protected static $brands = ['Premium', 'Standard', 'House', 'Generic', 'Artesanal', 'Local'];
    protected static $units = ['unit', 'ml', 'bottle', 'can'];
    protected static $flavors = [
        'Dulce', 'Ácido', 'Amargo', 'Salado', 'Umami', 'Frutal', 'Cítrico',
        'Herbáceo', 'Especiado', 'Floral', 'Ahumado', 'Terroso', 'Tropical'
    ];

    public function definition(): array
    {
<<<<<<< HEAD
        $randomFlavors = $this->faker->randomElements(self::$flavors, $this->faker->numberBetween(1, 4));
        
        return [
            'name' => $this->faker->unique()->words($this->faker->numberBetween(2, 4), true),
            'category' => $this->faker->randomElement(self::$categories),
            'brand' => $this->faker->randomElement(self::$brands) . ' ' . $this->faker->company(),
            'unit' => $this->faker->randomElement(self::$units),
            'description' => $this->faker->sentence($this->faker->numberBetween(10, 20)),
            'is_alcoholic' => $this->faker->boolean(70),
            'flavor_profile_tags' => json_encode($randomFlavors), // Convertir a JSON
            'source_api_id' => $this->faker->unique()->numberBetween(1000, 9999),
            'parent_ingredient_id' => null,
=======
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
>>>>>>> revision-docente
        ];
    }
}
