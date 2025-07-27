<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\user_repice_notes;
use App\Models\users;
use App\Models\repices;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\user_repice_notes>
 */
class user_repice_notesFactory extends Factory
{
    protected $model = user_repice_notes::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        
        return [
            'user_id' => users::factory(),
            'repice_id' => repices::factory(),
            'note' => $this->faker->sentence(),
        ];
    }
}
