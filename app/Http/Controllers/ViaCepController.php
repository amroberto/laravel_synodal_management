<?php

namespace App\Http\Controllers;

use App\Services\ViaCepService;
use Illuminate\Http\Request;

class ViaCepController extends Controller
{
    protected $viaCepService;

    public function __construct(ViaCepService $viaCepService)
    {
        $this->viaCepService = $viaCepService;
    }

    public function consultar(Request $request)
    {
        $request->validate([
            'cep' => 'required|string|size:8'
        ]);

        $resultado = $this->viaCepService->consultarCep($request->cep);

        return response()->json($resultado);
    }
}