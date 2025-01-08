<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class CnpjService
{
    /**
     * Fetch data from the CNPJ API.
     *
     * @param string $cnpj
     * @return array|null
     */
    public function fetchCnpjData(string $cnpj): ?array
    {
        $cnpj = preg_replace('/\D/', '', $cnpj); // Remove any non-numeric characters

        if (strlen($cnpj) !== 14) {
            return null; // Invalid CNPJ length
        }

        try {
            // Replace the URL with your actual CNPJ API endpoint
            $response = Http::get("https://api.example.com/cnpj/{$cnpj}");

            if ($response->successful()) {
                return $response->json();
            }

            return null;
        } catch (\Exception $e) {
            // Log the exception if needed
            return null;
        }
    }
}
