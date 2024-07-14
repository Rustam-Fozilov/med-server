<?php

namespace Database\Seeders;

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
        User::factory(10)->create();

        User::query()->create([
            'name' => 'bob',
            'phone' => '+998901234567',
            'email' => 'bob@app.com',
            'password' => bcrypt('1234'),
        ]);
    }
}
