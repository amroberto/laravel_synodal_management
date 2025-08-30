<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Models\State;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cities = City::all();
        return view('admin.cities.index', compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $states = State::all();
        return view('admin.cities.create', compact('states'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'ibge_code' => 'required|string|max:20|unique:cities,ibge_code',
            'state_id' => 'required|exists:states,id',
        ], [
            'name.required' => 'O nome da cidade é obrigatório.',
            'ibge_code.required' => 'O código IBGE é obrigatório.',
            'ibge_code.unique' => 'O código IBGE já está em uso.',
            'state_id.required' => 'O estado é obrigatório.',
            'state_id.exists' => 'O estado selecionado é inválido.',
        ]);

        City::create($request->all());

        return redirect()->route('admin.cities.index')
                         ->with('success', 'Cidade criada com sucesso!');
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
    public function edit(City $city)
    {
        $city = City::find($city->id);
        $states = State::all();

        if(is_null($city)){
            return redirect()->route('admin.cities.index')
                             ->with('error', 'Cidade não encontrada.');
        }
        return view('admin.cities.edit', ['city' => $city, 'states' => $states]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, City $city)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'ibge_code' => 'required|string|max:20|unique:cities,ibge_code,' . $city->id,
            'state_id' => 'required|exists:states,id',
        ], [
            'name.required' => 'O nome da cidade é obrigatório.',
            'ibge_code.required' => 'O código IBGE é obrigatório.',
            'ibge_code.unique' => 'O código IBGE já está em uso.',
            'state_id.required' => 'O estado é obrigatório.',
            'state_id.exists' => 'O estado selecionado é inválido.',
        ]); 

        $city->update($data);

        return redirect()->route('admin.cities.index')
                         ->with('success', 'Cidade atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $city = City::find($id);

        if (!$city) {
            return redirect()->route('admin.cities.index')
                             ->with('error', 'Cidade não encontrada.');
        }

        $city->delete();

        return redirect()->route('admin.cities.index')
                         ->with('success', 'Cidade deletada com sucesso!');
    }
}
