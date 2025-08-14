<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Inventory;
use App\Models\Ingredient;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Inventory>
 */
class InventoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Inventory::class;
    
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'ingredient_id' => Ingredient::factory(),
            'in_stock' => $this->faker->boolean(),
            'quantity_ml' => $this->faker->randomFloat(2, 0, 100),
        ];
    }
}
