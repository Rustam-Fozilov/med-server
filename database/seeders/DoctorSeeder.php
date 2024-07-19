<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
            $doctorNew = $user->doctor()->create([
                'user_id' => $user->id,
                'birth_year' => $doctor->birth_year,
                'specialization' => $doctor->specialization,
            ]);
            $doctorNew->images()->create([
                'url' => $doctor->image ? env('APP_URL') . '/storage/doctors/' . $doctor->image :
                    ($doctor->user->gender === 'male' ? env('APP_URL') . '/storage/doctors/' . "male-sample.png" : env('APP_URL') . '/storage/doctors/' . "female-sample.png"),
            ]);
        }
    }
}
