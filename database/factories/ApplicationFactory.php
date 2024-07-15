<?php

namespace Database\Factories;

use App\Http\Enums\StatusType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Application>
 */
class ApplicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 1,
            'doctor_id' => 1,
            'date' => fake()->date('Y-m-d'),
            'time' => fake()->time('H:i:s'),
            'status' => StatusType::PENDING,
        ];
    }
}
