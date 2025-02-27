<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class CnpjService
{
    public function consultarCnpj($cnpj)
    {
        $cnpj = preg_replace('/\D/', '', $cnpj); // Remove caracteres não numéricos

        $response = Http::get("https://www.receitaws.com.br/v1/cnpj/{$cnpj}");

        if ($response->successful()) {
            return $response->json();
        }

        return null; // 
    }
}
