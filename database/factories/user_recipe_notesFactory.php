<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\user_recipe_notes;
use App\Models\User;
use App\Models\recipe;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\user_recipe_notes>
 */
class user_recipe_notesFactory extends Factory
{
    protected $model = user_recipe_notes::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        
        return [
            'user_id' => user::factory(),
            'recipe_id' => recipe::factory(),
            'note' => $this->faker->sentence(),
        ];
    }
}
