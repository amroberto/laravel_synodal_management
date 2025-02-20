<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $groups = [
            [1, 'LELUT'],
            [2, 'OASE'],
            [3, 'Juventude Evangélica']
        ];

        foreach ($groups as $group) {
            DB::table('groups')->insert([
                'id' => $group[0],
                'name' => $group[1],
            ]);
        }
    }
}
