<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RevenueSubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $revenue_sub_category = [
            [1, 'Contribuições recebidas no mês', 1],
            [2, 'Ofertas destinadas à Comunidade/Paróquia', 2],
            [3, 'Oferta Local', 2],
            [4, 'Doações por Ofício', 3],
            [5, 'Doações expontâneas', 3],
            [6, 'Almoços, jantares', 4],
            [7, 'Festas', 4],
            [8, 'Rifas', 4],
            [9, 'Alugueis', 5],
            [10, 'Arrendamentos', 5],
            [11, 'Receitas financeiras', 6]
        ];

        foreach ($revenue_sub_category as $category) {
            DB::table('revenue_sub_categories')->insert([
                'id' => $category[0],
                'name' => $category[1],
                'revenue_category_id' => $category[2]
            ]);
        }
    }
}
