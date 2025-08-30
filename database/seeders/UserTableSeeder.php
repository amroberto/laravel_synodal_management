<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Administrator',
            'password' => Hash::make('password'),
            'email' => 'admin@email.com',
            'user_type' => 'admin',
            'is_active' => true,
        ]);

        User::factory()->create([
            'name' => 'user',
            'password' => Hash::make('password'),
            'email' => 'user@email.com',
            'user_type' => 'user',
            'is_active' => true,
        ]);

        User::factory()->create([
            'name' => 'reader',
            'password' => Hash::make('password'),
            'email' => 'reader@email.com',
            'user_type' => 'reader',
            'is_active' => true,
        ]);
    }
}
