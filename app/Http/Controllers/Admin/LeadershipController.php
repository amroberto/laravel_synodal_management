<?php

namespace App\Http\Controllers\Admin;

use App\Models\Community;
use App\Models\Leadership;
use Illuminate\Http\Request;
use App\Services\ViaCepService;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class LeadershipController extends Controller
{
    protected $viaCepService;

    // Validation rule constants
    private const STRING_MAX_20 = 'nullable|string|max:20';
    private const STRING_MAX_255 = 'nullable|string|max:255';

    public function __construct(ViaCepService $viaCepService)
    {
        // Debug: Verify service resolution
        if (!$viaCepService) {
            Log::error('Service resolution failed', [
                'viaCepService' => $viaCepService ? get_class($viaCepService) : 'null',
            ]);
        }
        $this->viaCepService = $viaCepService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $leaderships = Leadership::all();
        return view('admin.leaderships.index', compact('leaderships'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $communities = Community::all();
        return view('admin.leaderships.create', compact('communities'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'cpf' => 'nullable|string|max:20',
            'community_id' => 'required|integer|exists:communities,id',
            'birthdate' => 'nullable|date',
            'gender' => 'required|string',
            'mobile' => self::STRING_MAX_20,
            'business_phone' => self::STRING_MAX_20,
            'phone' => self::STRING_MAX_20,
            'email' => 'nullable|email|max:255',
            'photo' => 'nullable|jpeg,png|max:2048',
            'cep' => self::STRING_MAX_20,
            'address' => self::STRING_MAX_255,
            'number' => self::STRING_MAX_20,
            'complement' => self::STRING_MAX_255,
            'district' => self::STRING_MAX_255,
            'city' => 'nullable|string',
            'state' => 'nullable|string',
        ], [
            'community_id.exists' => 'A Comunidade Selecionada não Existe, favor verificar!',
            'name.required' => 'O campo Nome é obrigatório.',
            'birthdate.date' => 'O campo Data de Nascimento deve ser uma data válida.',
            'mobile.max' => 'O campo Celular deve ter no máximo 20 caracteres.',
            'business_phone.max' => 'O campo Telefone Comercial deve ter no máximo 20 caracteres.',
            'phone.max' => 'O campo Telefone Residencial deve ter no máximo 20 caracteres.',
            'email.email' => 'O campo Email deve ser um endereço de email válido.',
            'email.max' => 'O campo Email deve ter no máximo 255 caracteres.',
            'photo.max' => 'A foto deve ter no máximo 2MB.',
            'photo.mimes' => 'A foto deve ser um arquivo do tipo: jpeg, png.',
            'cep.max' => 'O campo CEP deve ter no máximo 20 caracteres.',
            'address.max' => 'O campo Endereço deve ter no máximo 255 caracteres.',
            'number.max' => 'O campo Número deve ter no máximo 20 caracteres.',
            'complement.max' => 'O campo Complemento deve ter no máximo 255 caracteres.',
            'district.max' => 'O campo Bairro deve ter no máximo 255 caracteres.',
            'city.max' => 'O campo Cidade deve ter no máximo 100 caracteres.',
            'state.max' => 'O campo Estado deve ter no máximo 100 caracteres.',
        ]);

        Leadership::create([
            'name' => $validated['name'],
            'cpf' => $validated['cpf'] ?? null,
            'community_id' => $validated['community_id'],
            'birthdate' => $validated['birthdate'] ?? null,
            'gender' => $validated['gender'],
            'mobile' => $validated['mobile'] ?? null,
            'business_phone' => $validated['business_phone'] ?? null,
            'phone' => $validated['phone'] ?? null,
            'email' => $validated['email'] ?? null,
            'photo' => $validated['photo'] ?? null,
            'cep' => $validated['cep'] ?? null,
            'address' => $validated['address'] ?? null,
            'number' => $validated['number'] ?? null,
            'complement' => $validated['complement'] ?? null,
            'district' => $validated['district'] ?? null,
            'city' => $validated['city'] ?? null,
            'state' => $validated['state'] ?? null,
        ]);

        return redirect()->route('admin.leaderships.index')->with('success', 'Liderança criada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $leadership = Leadership::findOrFail($id);
        return view('admin.leaderships.show', compact('leadership'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $leadership = Leadership::findOrFail($id);
        return view('admin.leaderships.edit', compact('leadership'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'community_id' => 'required|integer|exists:communities,id',
            'birthdate' => 'nullable|date',
            'gender' => 'required|string',
            'mobile' => self::STRING_MAX_20,
            'business_phone' => self::STRING_MAX_20,
            'phone' => self::STRING_MAX_20,
            'email' => 'nullable|email|max:255',
            'photo' => 'nullable|jpeg,png|max:2048',
            'cep' => self::STRING_MAX_20,
            'address' => self::STRING_MAX_255,
            'number' => self::STRING_MAX_20,
            'complement' => self::STRING_MAX_255,
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
        ], [
            'community_id.exists' => 'A Comunidade Selecionada não Existe, favor verificar!',
            'name.required' => 'O campo Nome é obrigatório.',
            'birthdate.date' => 'O campo Data de Nascimento deve ser uma data válida.',
            'mobile.max' => 'O campo Celular deve ter no máximo 20 caracteres.',
            'business_phone.max' => 'O campo Telefone Comercial deve ter no máximo 20 caracteres.',
            'phone.max' => 'O campo Telefone Residencial deve ter no máximo 20 caracteres.',
            'email.email' => 'O campo Email deve ser um endereço de email válido.',
            'email.max' => 'O campo Email deve ter no máximo 255 caracteres.',
            'photo.max' => 'A foto deve ter no máximo 2MB.',
            'photo.mimes' => 'A foto deve ser um arquivo do tipo: jpeg, png.',
            'cep.max' => 'O campo CEP deve ter no máximo 20 caracteres.',
            'address.max' => 'O campo Endereço deve ter no máximo 255 caracteres.',
            'number.max' => 'O campo Número deve ter no máximo 20 caracteres.',
            'complement.max' => 'O campo Complemento deve ter no máximo 255 caracteres.',
            'city.max' => 'O campo Cidade deve ter no máximo 100 caracteres.',
            'state.max' => 'O campo Estado deve ter no máximo 100 caracteres.',
        ]);

        $leadership = Leadership::findOrFail($id);
        $leadership->update($validated);

        return redirect()->route('admin.leaderships.index')->with('success', 'Liderança atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $leadership = Leadership::findOrFail($id);
        $leadership->delete();

        return redirect()->route('admin.leaderships.index')->with('success', 'Leadership deleted successfully.');
    }
}
