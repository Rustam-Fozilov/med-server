<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Doctor>
 */
class DoctorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => rand(1, 10),
            'specialization' => fake()->jobTitle,
            'experience' => fake()->company,
            'birth_year' => fake()->year,
            'work_start_time' => fake()->time,
            'work_end_time' => fake()->time,
        ];
    }
}
