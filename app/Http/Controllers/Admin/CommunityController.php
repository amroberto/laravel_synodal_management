<?php

namespace App\Http\Controllers\Admin;

use App\Models\Community;
use App\Enums\UnityTypeEnum;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommunityController extends Controller
{
    private const NULLABLE_STRING_MAX_20 = 'nullable|string|max:20';
    private const NULLABLE_STRING_MAX_255 = 'nullable|string|max:255';

    public function index()
    {
        $communities = Community::with('leaderships')->paginate(10);
        return view('admin.communities.index', compact('communities'));
    }

    public function create()
    {
        $unityTypes = UnityTypeEnum::cases();
        return view('admin.communities.create', compact('unityTypes'));
    }

    public function store(Request $request)
    {
        $rules = [
            'cnpj' => self::NULLABLE_STRING_MAX_20,
            'corporate_name' => 'required|string|max:255',
            'fantasy_name' => self::NULLABLE_STRING_MAX_255,
            'unity_type' => ['nullable', 'string'],
            'phone' => self::NULLABLE_STRING_MAX_20,
            'mobile' => self::NULLABLE_STRING_MAX_20,
            'email' => 'nullable|email|max:255',
            'website' => self::NULLABLE_STRING_MAX_255,
            'cep' => self::NULLABLE_STRING_MAX_20,
            'address' => self::NULLABLE_STRING_MAX_255,
            'number' => self::NULLABLE_STRING_MAX_20,
            'complement' => self::NULLABLE_STRING_MAX_255,
            'district' => self::NULLABLE_STRING_MAX_255,
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'leaderships' => 'nullable|array',
            'leaderships.*.leadership_id' => 'nullable|exists:leaderships,id',
            'leaderships.*.position_id' => 'nullable|exists:positions,id',
        ];

        $messages = [
            'corporate_name.required' => 'O campo Razão Social é obrigatório.',
            'corporate_name.max' => 'O campo Razão Social deve ter no máximo 255 caracteres.',
            'fantasy_name.max' => 'O campo Nome Fantasia deve ter no máximo 255 caracteres.',
            'unity_type.in' => 'O tipo de unidade selecionado é inválido.',
            'email.email' => 'O campo E-mail deve ser um endereço de e-mail válido.',
            'email.max' => 'O campo E-mail deve ter no máximo 255 caracteres.',
            'address.max' => 'O campo Endereço deve ter no máximo 255 caracteres.',
            'number.max' => 'O campo Número deve ter no máximo 20 caracteres.',
            'complement.max' => 'O campo Complemento deve ter no máximo 255 caracteres.',
            'district.max' => 'O campo Bairro deve ter no máximo 255 caracteres.',
            'city.max' => 'O campo Cidade deve ter no máximo 100 caracteres.',
            'state.max' => 'O campo Estado deve ter no máximo 100 caracteres.',
            'leaderships.*.leadership_id.exists' => 'A liderança selecionada é inválida.',
            'leaderships.*.position_id.exists' => 'A posição selecionada é inválida.',
        ];

        $validated = $request->validate($rules, $messages);

        $community = Community::create([
            'cnpj' => $validated['cnpj'] ?? null,
            'corporate_name' => $validated['corporate_name'],
            'fantasy_name' => $validated['fantasy_name'] ?? null,
            'unity_type' => $validated['unity_type'] ?? null,
            'phone' => $validated['phone'] ?? null,
            'mobile' => $validated['mobile'] ?? null,
            'email' => $validated['email'] ?? null,
            'website' => $validated['website'] ?? null,
            'cep' => $validated['cep'] ?? null,
            'address' => $validated['address'] ?? null,
            'number' => $validated['number'] ?? null,
            'complement' => $validated['complement'] ?? null,
            'district' => $validated['district'] ?? null,
            'city' => $validated['city'] ?? null,
            'state' => $validated['state'] ?? null,
        ]);

        if (isset($validated['leaderships'])) {
            foreach ($validated['leaderships'] as $index => $leadershipData) {
                if (!empty($leadershipData['leadership_id']) && !empty($leadershipData['position_id'])) {
                    $community->leaderships()->attach($leadershipData['leadership_id'], [
                        'position_id' => $leadershipData['position_id'],
                    ]);
                }
            }
        }

        return redirect()->route('admin.communities.edit', $community->id)
            ->with('success', 'Comunidade criada com sucesso! Agora adicione lideranças.');
    }

    public function edit(Community $community)
    {
        $unityTypes = UnityTypeEnum::cases();
        $community = Community::with(['leaderships' => function ($query) {
            $query->with('pivot.position');
        }])->findOrFail($community->id);
        return view('admin.communities.edit', compact('community', 'unityTypes'));
    }

    public function update(Request $request, Community $community)
    {
        $rules = [
            'cnpj' => self::NULLABLE_STRING_MAX_20,
            'corporate_name' => 'required|string|max:255',
            'fantasy_name' => self::NULLABLE_STRING_MAX_255,
            'unity_type' => ['nullable', 'string', 'max:255', 'in:' . implode(',', UnityTypeEnum::getValues())],
            'phone' => self::NULLABLE_STRING_MAX_20,
            'mobile' => self::NULLABLE_STRING_MAX_20,
            'email' => 'nullable|email|max:255',
            'website' => self::NULLABLE_STRING_MAX_255,
            'cep' => self::NULLABLE_STRING_MAX_20,
            'address' => self::NULLABLE_STRING_MAX_255,
            'number' => self::NULLABLE_STRING_MAX_20,
            'complement' => self::NULLABLE_STRING_MAX_255,
            'district' => self::NULLABLE_STRING_MAX_255,
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'leaderships' => 'nullable|array',
            'leaderships.*.leadership_id' => 'nullable|exists:leaderships,id',
            'leaderships.*.position_id' => 'nullable|exists:positions,id',
        ];

        $messages = [
            'corporate_name.required' => 'O campo Razão Social é obrigatório.',
            'corporate_name.max' => 'O campo Razão Social deve ter no máximo 255 caracteres.',
            'fantasy_name.max' => 'O campo Nome Fantasia deve ter no máximo 255 caracteres.',
            'unity_type.in' => 'O tipo de unidade selecionado é inválido.',
            'email.email' => 'O campo E-mail deve ser um endereço de e-mail válido.',
            'email.max' => 'O campo E-mail deve ter no máximo 255 caracteres.',
            'address.max' => 'O campo Endereço deve ter no máximo 255 caracteres.',
            'number.max' => 'O campo Número deve ter no máximo 20 caracteres.',
            'complement.max' => 'O campo Complemento deve ter no máximo 255 caracteres.',
            'district.max' => 'O campo Bairro deve ter no máximo 255 caracteres.',
            'city.max' => 'O campo Cidade deve ter no máximo 100 caracteres.',
            'state.max' => 'O campo Estado deve ter no máximo 100 caracteres.',
            'leaderships.*.leadership_id.exists' => 'A liderança selecionada é inválida.',
            'leaderships.*.position_id.exists' => 'A posição selecionada é inválida.',
        ];

        $validated = $request->validate($rules, $messages);

        $community->update([
            'cnpj' => $validated['cnpj'] ?? null,
            'corporate_name' => $validated['corporate_name'],
            'fantasy_name' => $validated['fantasy_name'] ?? null,
            'unity_type' => $validated['unity_type'] ?? null,
            'phone' => $validated['phone'] ?? null,
            'mobile' => $validated['mobile'] ?? null,
            'email' => $validated['email'] ?? null,
            'website' => $validated['website'] ?? null,
            'cep' => $validated['cep'] ?? null,
            'address' => $validated['address'] ?? null,
            'number' => $validated['number'] ?? null,
            'complement' => $validated['complement'] ?? null,
            'district' => $validated['district'] ?? null,
            'city' => $validated['city'] ?? null,
            'state' => $validated['state'] ?? null,
        ]);

        if (isset($validated['leaderships'])) {
            $community->leaderships()->detach();
            foreach ($validated['leaderships'] as $index => $leadershipData) {
                if (!empty($leadershipData['leadership_id']) && !empty($leadershipData['position_id'])) {
                    $community->leaderships()->attach($leadershipData['leadership_id'], [
                        'position_id' => $leadershipData['position_id'],
                    ]);
                }
            }
        } else {
            $community->leaderships()->detach();
        }

        return redirect()->route('admin.communities.edit', $community->id)
            ->with('success', 'Comunidade atualizada com sucesso!');
    }

    public function destroy(Community $community)
    {
        $community->leaderships()->detach();
        $community->delete();
        return redirect()->route('admin.communities.index')->with('success', 'Comunidade deletada com sucesso!');
    }
}
