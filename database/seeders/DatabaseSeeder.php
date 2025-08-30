<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\GroupSeeder;
use Database\Seeders\CountrySeeder;
use Database\Seeders\CityTableSeeder;
use Database\Seeders\UserTableSeeder;
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

        $this->call([
            UserTableSeeder::class,
            SynodSeeder::class,
            CountrySeeder::class,
            StateTableSeeder::class,
            CityTableSeeder::class,
            PositionTableSeeder::class,
            RevenueCategorySeeder::class,
            GroupSeeder::class,
            RevenueSubCategorySeeder::class,
        ]);
    }
}
