<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ocr_jobs;
use App\Models\User;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ocr_jobs>
 */
class ocr_jobsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = ocr_jobs::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'status' => $this->faker->randomElement(['pending', 'processing', 'completed', 'failed']),
            'original_image_path' => $this->faker->imageUrl(),
            'raw_result' => json_encode($this->faker->optional()->text()),
            'error_message' => $this->faker->optional()->sentence(),
        ];
    }
}
