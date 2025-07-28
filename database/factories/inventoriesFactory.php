<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\inventories;
use App\Models\ingredients;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\inventories>
 */
class inventoriesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = inventories::class;
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'ingredient_id' => ingredients::factory(),
            'in_stock' => $this->faker->boolean(),
            'quantity_ml' => $this->faker->randomFloat(2, 0, 100),
        ];
    }
}
