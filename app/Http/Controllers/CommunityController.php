<?php

namespace App\Http\Controllers;

use App\Services\CnpjService;
use App\Services\ViaCepService;
use App\Models\Community;
use App\Models\State;
use App\Models\City;
use Illuminate\Http\Request;

class CommunityController extends Controller
{
    protected $cnpjService;
    protected $viaCepService;

    /**
     * CommunityController constructor.
     *
     * @param CnpjService $cnpjService
     * @param ViaCepService $viaCepService
     */
    public function __construct(CnpjService $cnpjService, ViaCepService $viaCepService)
    {
        $this->cnpjService = $cnpjService;
        $this->viaCepService = $viaCepService;
    }

    /**
     * Show the form to create a new community.
     *
     * @return \Illuminate\View\View
     */
    /**
     * [Description for create]
     *
     * @return [type]
     * 
     */
    public function create()
    {
        $states = State::all();
        return view('community.create', compact('states'));
    }

    /**
     * [Description for getCities]
     *
     * @param mixed $stateId
     * 
     * @return [type]
     * 
     */
    public function getCities($stateId)
    {
        $cities = City::where('state_id', $stateId)->get();
        return response()->json($cities);
    }

    /**
     * Store a new community in the database.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'cnpj' => 'nullable|string',
            'address' => 'required|string|max:255',
            'zip_code' => 'required|string|max:10',
            'state_id' => 'required|exists:states,id',
            'city_id' => 'required|exists:cities,id',
        ]);

        Community::create($validatedData);

        return redirect()->route('community.index')->with('success', 'Community created successfully!');
    }

    /**
     * Fetch community data using CNPJ and populate address fields.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function fetchCnpjData(Request $request)
    {
        $cnpj = $request->input('cnpj');
        $data = $this->cnpjService->fetchCnpjData($cnpj);

        if (!$data) {
            return response()->json(['error' => 'Invalid CNPJ or data not found'], 404);
        }

        $addressData = $this->viaCepService->consultarCep($data['cep'] ?? '');

        if ($addressData) {
            $state = State::where('uf', $addressData['uf'])->first();
            $city = $state ? City::where('state_id', $state->id)->where('name', $addressData['localidade'])->first() : null;

            return response()->json([
                'address' => $data['logradouro'] ?? $addressData['logradouro'],
                'zip_code' => $data['cep'] ?? '',
                'state_id' => $state->id ?? null,
                'city_id' => $city->id ?? null,
            ]);
        }

        return response()->json(['error' => 'Address data could not be fetched'], 500);
    }
}
