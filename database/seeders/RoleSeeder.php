<?php

namespace Database\Seeders;

use App\Http\Enums\RoleType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::query()->create([
            'name' => RoleType::SUPER_ADMIN,
        ]);
        Role::query()->create([
            'name' => RoleType::MODERATOR,
        ]);
        Role::query()->create([
            'name' => RoleType::DOCTOR,
        ]);
        Role::query()->create([
            'name' => RoleType::USER,
        ]);
    }
}
