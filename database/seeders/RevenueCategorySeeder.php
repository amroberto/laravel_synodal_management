<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RevenueCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $revenue_category = [
            [1, 'Contribuição dos membros'],
            [2, 'Ofertas / Coletas'],
            [3, 'Doações'],
            [4, 'Promoções'],
            [5, 'Renda Patrimonial'],
            [6, 'Outras Receitas']
        ];

        foreach ($revenue_category as $category) {
            DB::table('revenue_categories')->insert([
                'id' => $category[0],
                'name' => $category[1],
            ]);
        }
    }
}
