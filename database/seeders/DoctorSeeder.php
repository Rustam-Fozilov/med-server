<?php

namespace Database\Seeders;

use App\Http\Enums\RoleType;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = file_get_contents('database/dump/doctors.json');
        $doctors = json_decode($json);

        foreach ($doctors as $doctor) {
            $user = User::query()->create([
                'name' => $doctor->user->name,
                'phone' => $doctor->user->phone,
                'gender' => $doctor->user->gender,
                'password' => Hash::make($doctor->user->password),
            ])->assignRole($doctor->roles);
            $user->doctor()->create([
                'user_id' => $user->id,
                'birth_year' => $doctor->birth_year,
                'specialization' => $doctor->specialization,
            ]);
        }
    }
}
