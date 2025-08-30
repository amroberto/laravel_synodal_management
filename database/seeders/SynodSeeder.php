<?php

namespace Database\Seeders;

use App\Models\Synod;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SynodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Verifica se já existe um registro
        if (Synod::exists()) {
            return; // Sai se a tabela não estiver vazia
        }

        Synod::create([
            'corporate_name' => 'Sinodo Teste',
            'trade_name' => 'Sinodo Teste',
            'cnpj' => '12345678000190',
            'phone' => '(11) 1234-5678',
            'cellphone' => '(11) 91234-5678',
            'cep' => '01234-567',
            'address' => 'Rua Principal',
            'number' => '100',
            'complement' => 'Bloco A',
            'district' => 'Centro',
            'city' => 'São Paulo',
            'state' => 'SP',
            'website' => 'https://sinodoteste.org',
            'email' => 'contato@sinodoteste.org',
            'logo' => null,
        ]);
    }
}
