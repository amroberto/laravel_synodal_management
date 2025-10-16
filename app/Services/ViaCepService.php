<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ViaCepService
{
    public function consultarCep($cep)
    {
        // Remove caracteres não numéricos
        $cep = preg_replace('/\D/', '', $cep);
        
        // Valida se o CEP tem 8 dígitos
        if (strlen($cep) !== 8 || !is_numeric($cep)) {
            Log::warning('CEP inválido fornecido: ' . $cep);
            return ['erro' => true, 'message' => 'CEP inválido. Deve conter 8 dígitos numéricos.'];
        }

        try {
            $response = Http::get("https://viacep.com.br/ws/{$cep}/json/");
            if ($response->successful()) {
                $data = $response->json();
                if (isset($data['erro']) && $data['erro']) {
                    Log::warning('CEP não encontrado: ' . $cep);
                    return ['erro' => true, 'message' => 'CEP não encontrado.'];
                }
                Log::info('CEP consultado com sucesso: ' . $cep, $data);
                return $data;
            }
            Log::error('Erro ao consultar ViaCEP: Status ' . $response->status());
            return ['erro' => true, 'message' => 'Erro ao consultar o CEP: ' . $response->status()];
        } catch (\Exception $e) {
            Log::error('Erro ao consultar ViaCEP: ' . $e->getMessage(), ['cep' => $cep]);
            return ['erro' => true, 'message' => 'Erro ao consultar o CEP.'];
        }
    }
}