<?php

namespace Database\Seeders;

use App\Http\Enums\RoleType;
use App\Models\Doctor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 5; $i++) {
            Doctor::query()->create([
                'user_id' => $i,
                'specialization' => fake()->jobTitle,
                'experience' => '1 yil',
                'birth_year' => fake()->year,
                'work_start_time' => fake()->time('H:i'),
                'work_end_time' => fake()->time('H:i'),
            ])->user->assignRole(RoleType::DOCTOR);
        }
    }
}
