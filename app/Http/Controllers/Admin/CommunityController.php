<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Models\State;
use App\Models\Community;
use App\Enums\UnityTypeEnum;
use Illuminate\Http\Request;
use App\Services\CnpjService;
use App\Services\ViaCepService;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Address;

class CommunityController extends Controller
{
    protected $viaCepService;
    protected $cnpjService;

    public function __construct(ViaCepService $viaCepService, CnpjService $cnpjService)
    {
        // Debug: Verify service resolution
        if (!$viaCepService || !$cnpjService) {
            Log::error('Service resolution failed', [
                'viaCepService' => get_class($viaCepService ?? null),
                'cnpjService' => get_class($cnpjService ?? null),
            ]);
        }
        $this->viaCepService = $viaCepService;
        $this->cnpjService = $cnpjService;
    }

    public function index()
    {
        $communities = Community::paginate(10);
        return view('admin.communities.index', compact('communities'));
    }

    public function create()
    {
        $unityTypes = UnityTypeEnum::cases();
        $states = State::all();
        return view('admin.communities.create', compact('unityTypes', 'states'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'cnpj' => 'required|string',
            'unity_type' => 'required|string',
            'fantasy_name' => 'nullable|string',
            'phone' => 'nullable|string',
            'mobile' => 'nullable|string',
            'email' => 'nullable|email',
            'website' => 'nullable|url',
            'cep' => 'required|string',
            'address' => 'required|string',
            'number' => 'required|string',
            'complement' => 'nullable|string',
            'district' => 'nullable|string',
            'state' => 'required|string',
            'city' => 'required|string',
        ]);

        $communityData = [
            'cnpj' => $validated['cnpj'],
            'corporate_name' => $validated['corporate_name'],
            'fantasy_name' => $validated['fantasy_name'],
            'unity_type' => $validated['unity_type'],
            'phone' => $validated['phone'],
            'mobile' => $validated['mobile'],
            'email' => $validated['email'],
            'website' => $validated['website'],
            'cep' => $validated['cep'],
            'address' => $validated['address'],
            'number' => $validated['number'],
            'complement' => $validated['complement'],
            'city' => $validated['city'],
            'state' => $validated['state']
        ];

        Community::create($communityData);

        return redirect()->route('admin.communities.index')->with('success', 'Comunidade criada com sucesso.');
    }

    public function edit(Community $community)
    {
        $unityTypes = UnityTypeEnum::cases();
        $states = State::all();
        return view('admin.communities.edit', compact('community', 'unityTypes', 'states'));
    }

    public function update(Request $request, Community $community)
    {
        $validated = $request->validate([
            'cnpj' => 'required|string',
            'unity_type' => 'required|string',
            'fantasy_name' => 'nullable|string',
            'phone' => 'nullable|string',
            'mobile' => 'nullable|string',
            'email' => 'nullable|email',
            'website' => 'nullable|url',
            'cep' => 'required|string',
            'address' => 'required|string',
            'number' => 'required|string',
            'complement' => 'nullable|string',
            'district' => 'nullable|string',
            'state' => 'required|string',
            'city' => 'required|string',
        ]);

        $communityData = [
            'cnpj' => $validated['cnpj'],
            'corporate_name' => $validated['corporate_name'],
            'fantasy_name' => $validated['fantasy_name'],
            'unity_type' => $validated['unity_type'],
            'phone' => $validated['phone'],
            'mobile' => $validated['mobile'],
            'email' => $validated['email'],
            'website' => $validated['website'],
            'cep' => $validated['cep'],
            'address' => $validated['address'],
            'number' => $validated['number'],
            'complement' => $validated['complement'],
            'city' => $validated['city'],
            'state' => $validated['state']
        ];

        $community->update($communityData);

        return redirect()->route('admin.communities.index')->with('success', 'Comunidade atualizada com sucesso.');
    }

    public function destroy(Community $community)
    {
        $community->leaderships()->detach();
        $community->delete();
        return redirect()->route('admin.communities.index')->with('success', 'Comunidade deletada com sucesso!');
    }

    public function getCnpjData(Request $request)
    {
        $cnpj = preg_replace('/\D/', '', $request->query('cnpj'));
        if (strlen($cnpj) !== 14) {
            return response()->json(['error' => 'CNPJ inválido'], 400);
        }

        $service = app(CnpjService::class);
        $dados = $service->consultarCnpj($cnpj);

        if (!$dados) {
            return response()->json(['error' => 'CNPJ não encontrado'], 404);
        }

        $response = [
            'corporate_name' => $dados['nome'] ?? '',
            'fantasy_name' => $dados['fantasia'] ?? '',
            'email' => $dados['email'] ?? '',
            'phone' => $dados['telefone'] ?? '',
            'cep' => $dados['cep'] ?? '',
            'address' => $dados['logradouro'] ?? '',
            'number' => $dados['numero'] ?? '',
            'complement' => $dados['complemento'] ?? '',
            'district' => $dados['bairro'] ?? '',
        ];

        // Consulta o CEP retornado pelo CNPJ
        if (isset($dados['cep'])) {
            $cepFormated = preg_replace('/\D/', '', $dados['cep']);
            $cepService = app(ViaCepService::class);
            $dadosCep = $cepService->consultarCep($cepFormated);

            if ($dadosCep) {
                $city = City::where('name', $dadosCep['localidade'])
                    ->whereHas('state', function ($query) use ($dadosCep) {
                        $query->where('abbreviation', $dadosCep['uf']);
                    })
                    ->first();

                $response['address'] = $dadosCep['logradouro'] ?? $response['address'];
                $response['district'] = $dadosCep['bairro'] ?? $response['district'];
                $response['complement'] = $dadosCep['complemento'] ?? $response['complement'];
                $response['state_id'] = $city ? $city->state_id : null;
                $response['city_id'] = $city ? $city->id : null;
            }
        }

        return response()->json($response);
    }

    public function getCepData(Request $request)
{
    $cep = preg_replace('/\D/', '', $request->query('cep'));
    if (strlen($cep) !== 8) {
        return response()->json(['erro' => true, 'message' => 'CEP inválido'], 400);
    }

    $service = app(ViaCepService::class);
    $dados = $service->consultarCep($cep);

    if (isset($dados['erro']) || !$dados) {
        return response()->json(['erro' => true, 'message' => 'CEP não encontrado'], 404);
    }

    $city = City::where('name', $dados['localidade'])
        ->whereHas('state', function ($query) use ($dados) {
            $query->where('abbreviation', $dados['uf']);
        })
        ->first();

    $response = [
        'logradouro' => $dados['logradouro'] ?? '',
        'bairro' => $dados['bairro'] ?? '',
        'complemento' => $dados['complemento'] ?? '',
        'localidade' => $dados['localidade'] ?? '',
        'uf' => $dados['uf'] ?? '',
        'city_id' => $city ? $city->id : null,
        'state_id' => $city ? $city->state_id : null,
    ];

    return response()->json($response);
}
}
