<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CnpjService;

class CnpjController extends Controller
{
    protected $cnpjService;

    public function __construct(CnpjService $cnpjService)
    {
        $this->cnpjService = $cnpjService;
    }

    public function consultar(Request $request)
    {
        $cnpj = $request->input('cnpj');

        if (!$cnpj) {
            return response()->json(['error' => 'CNPJ não informado'], 400);
        }

        $dados = $this->cnpjService->consultarCnpj($cnpj);

        if (empty($dados)) {
            return response()->json(['error' => 'CNPJ não encontrado ou inválido'], 404);
        }

        return response()->json($dados);
    }
}
