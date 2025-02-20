<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\GroupSeeder;
use Database\Seeders\CountrySeeder;
use Database\Seeders\CityTableSeeder;
use Database\Seeders\StateTableSeeder;
use Database\Seeders\PositionTableSeeder;
use Database\Seeders\RevenueCategorySeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Administrator',
            'password' => bcrypt('password'),
            'email' => 'admin@admin.com',
            'is_admin' => true,
            'is_active' => true,
        ]);

        User::factory()->create([
            'name' => 'user',
            'password' => bcrypt('password'),
            'email' => 'user@user.com',
            'is_admin' => false,
            'is_active' => true,
        ]);

        $this->call([
            CountrySeeder::class,
            StateTableSeeder::class,
            CityTableSeeder::class,
            PositionTableSeeder::class,
            RevenueCategorySeeder::class,
            GroupSeeder::class,
        ]);
    }
}
