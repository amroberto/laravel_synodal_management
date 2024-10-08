<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ViaCepService
{
    public function consultarCep($cep)
    {
        $response = Http::get("https://viacep.com.br/ws/{$cep}/json/");

        if ($response->successful()) {
            return $response->json();
        }

        return null; // Ou lance uma exceção, dependendo da sua estratégia de tratamento de erros
    }
}
