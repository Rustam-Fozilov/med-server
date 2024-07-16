<?php

namespace Database\Seeders;

use App\Http\Enums\RoleType;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(10)->create();

        User::query()->create([
            'name' => 'bob',
            'phone' => '+998901234567',
            'email' => 'bob@app.com',
            'password' => bcrypt('1234'),
        ])->assignRole(RoleType::SUPER_ADMIN, RoleType::DOCTOR, RoleType::MODERATOR);
    }
}
