<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $states = [
            [11, 'Rondônia', 'RO', 27],
            [12, 'Acre', 'AC', 27],
            [13, 'Amazonas', 'AM', 27],
            [14, 'Roraima', 'RR', 27],
            [15, 'Pará', 'PA', 27],
            [16, 'Amapá', 'AP', 27],
            [17, 'Tocantins', 'TO', 27],
            [21, 'Maranhão', 'MA', 27],
            [22, 'Piauí', 'PI', 27],
            [23, 'Ceará', 'CE', 27],
            [24, 'Rio Grande do Norte', 'RN', 27],
            [25, 'Paraíba', 'PB', 27],
            [26, 'Pernambuco', 'PE', 27],
            [27, 'Alagoas', 'AL', 27],
            [28, 'Sergipe', 'SE', 27],
            [29, 'Bahia', 'BA', 27],
            [31, 'Minas Gerais', 'MG', 27],
            [32, 'Espírito Santo', 'ES', 27],
            [33, 'Rio de Janeiro', 'RJ', 27],
            [35, 'São Paulo', 'SP', 27],
            [41, 'Paraná', 'PR', 27],
            [42, 'Santa Catarina', 'SC', 27],
            [43, 'Rio Grande do Sul', 'RS', 27],
            [50, 'Mato Grosso do Sul', 'MS', 27],
            [51, 'Mato Grosso', 'MT', 27],
            [52, 'Goiás', 'GO', 27],
            [53, 'Distrito Federal', 'DF', 27]
        ];

        foreach ($states as $state) {
            DB::table('states')->insert([
                'id' => $state[0],
                'name' => $state[1],
                'abbreviation' => $state[2],
                'country_id' => $state[3],
            ]);
        }
    }
}
