<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PositionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $positions = [
            [1, 'Presidente'],
            [2, 'Vice-Presidente'],
            [3, 'Tesoureiro'],
            [4, 'Vice-tesoureiro'],
            [5, 'Secretário'],
            [6, 'Vice-secretário'],
            [7, 'Conselheiro Sinodal']
        ];

        foreach ($positions as $position) {
            DB::table('positions')->insert([
                'id' => $position[0],
                'name' => $position[1],
            ]);
        }
    }
}
