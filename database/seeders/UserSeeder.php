<?php

namespace Database\Seeders;

use App\Http\Enums\GenderType;
use App\Http\Enums\RoleType;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
//        User::factory(10)->create();

        User::query()->create([
            'name' => 'bob',
            'phone' => '+998901234567',
            'email' => 'bob@app.com',
            'password' => bcrypt('12345678'),
        ])->assignRole(RoleType::SUPER_ADMIN, RoleType::DOCTOR, RoleType::MODERATOR);


        $user = User::query()->create([
            'name' => 'Kalandarova Lola Nurullayevna',
            'gender' => GenderType::FEMALE,
            'password' => bcrypt('12345678'),
        ])->assignRole(RoleType::SUPER_ADMIN, RoleType::DOCTOR, RoleType::MODERATOR);
        $user->doctor()->create([
            'user_id' => $user->id,
            'birth_year' => 1969,
            'specialization' => 'Direktor'
        ]);

        $user = User::query()->create([
            'name' => 'Akkiyev Muxiddin Isomiddinovich ',
            'phone' => '+998998016393',
            'gender' => GenderType::MALE,
            'password' => bcrypt('12345678'),
        ])->assignRole(RoleType::SUPER_ADMIN, RoleType::DOCTOR, RoleType::MODERATOR);
        $user->doctor()->create([
            'user_id' => $user->id,
            'birth_year' => 1988,
            'specialization' => "Direktor o'rinbosari"
        ]);
    }
}
