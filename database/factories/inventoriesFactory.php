<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\inventories;
use app\Models\ingredients;
use app\Models\users;
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
            'user_id' => users::factory(),
            'ingredient_id' => ingredients::factory(),
            'in_stock' => $this->faker->boolean(),
            'quantity_mi' => $this->faker->randomFloat(2, 0, 100),
        ];
    }
}
