<?php

namespace App\Services;

class CnpjService
{
    public function consultarCnpj($cnpj)
    {
        // Exemplo usando ReceitaWS (substitua pela sua implementação)
        $url = "https://www.receitaws.com.br/v1/cnpj/{$cnpj}";
        $response = file_get_contents($url); // Ou use Http::get() com Guzzle
        $data = json_decode($response, true);

        if (isset($data['status']) && $data['status'] === 'ERROR') {
            return null;
        }

        return [
            'nome' => $data['nome'] ?? '',
            'fantasia' => $data['fantasia'] ?? '',
            'email' => $data['email'] ?? '',
            'telefone' => $data['telefone'] ?? '',
            'cep' => $data['cep'] ?? '',
            'logradouro' => $data['logradouro'] ?? '',
            'numero' => $data['numero'] ?? '',
            'complemento' => $data['complemento'] ?? '',
            'bairro' => $data['bairro'] ?? '',
        ];
    }
}