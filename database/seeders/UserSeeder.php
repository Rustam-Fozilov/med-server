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
            'name' => 'rustam',
            'phone' => '+998977672097',
            'email' => 'rustam@app.com',
            'password' => bcrypt('1w3r5y7i9'),
        ])->assignRole(RoleType::SUPER_ADMIN, RoleType::DOCTOR, RoleType::MODERATOR);
    }
}
