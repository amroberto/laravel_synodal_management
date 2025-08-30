<?php

namespace App\Http\Controllers\Admin;

use App\Models\Synod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class SynodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Synod $synod)
    {
        $synod = Synod::firstOrFail();
        return view('admin.synod.edit', compact('synod'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Synod $synod)
    {
        $synod = Synod::firstOrFail();

        $validated = $request->validate([
            'corporate_name' => 'required|string|max:255',
            'trade_name' => 'required|string|max:255',
            'cnpj' => 'required|string|unique:synods,cnpj,' . $synod->id,
            'phone' => 'nullable|string|max:20',
            'cellphone' => 'nullable|string|max:20',
            'cep' => 'nullable|string|max:10',
            'address' => 'nullable|string|max:255',
            'number' => 'nullable|string|max:10',
            'complement' => 'nullable|string|max:50',
            'district' => 'nullable|string|max:100',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:2',
            'website' => 'nullable|url|max:255',
            'email' => 'nullable|email|max:255',
            'logo' => 'nullable|file|mimes:jpg,png|max:2048',
        ]);

        if ($request->hasFile('logo')) {
            // Deletar logo antiga, se existir
            if ($synod->logo && Storage::disk('public')->exists($synod->logo)) {
                Storage::disk('public')->delete($synod->logo);
            }
            // Salvar nova logo
            $path = $request->file('logo')->store('logos', 'public');
            $validated['logo'] = $path;
            Log::info('Logo uploaded: ' . $path); // Log para depuração
        }

        $synod->update($validated);

        return redirect()->route('admin.dashboard')->with('success', 'Dados do Sínodo atualizados com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
