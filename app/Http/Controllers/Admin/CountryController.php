<?php

namespace App\Http\Controllers\Admin;

use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $countries = Country::all();
        return view('admin.countries.index', compact('countries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.countries.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:10|unique:countries,code',
        ]);

        Country::create($validated);

        return redirect()->route('admin.countries.index')->with('success', __('Country created successfully!'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try{
            $country = Country::findOrFail($id);
            return view('admin.countries.show', compact('country'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('admin.countries.index')->with('error', __('Country not found!'));
        } catch (\Exception $e) {
            return redirect()->route('admin.countries.index')->with('error', __('Erro ao carregar País!'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $country = Country::find($id);

        if(is_null($country)) {
            return redirect()->route('admin.countries.index')->with('error', __('Country not found!'));
        }
        return view('admin.countries.edit', compact('country'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $country = Country::findOrFail($id);

            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'code' => 'required|string|max:10|unique:countries,code,' . $country->id,
            ]);

            $country->update($validated);

            return redirect()->route('admin.countries.index')->with('success', __('Country updated successfully!'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('admin.countries.index')->with('error', __('Country not found!'));
        } catch (\Exception $e) {
            return redirect()->route('admin.countries.index')->with('error', __('Erro ao atualizar País!'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $country = Country::findOrFail($id);
            $country->delete();
            return redirect()->route('admin.countries.index')->with('success', __('Country deleted successfully!'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('admin.countries.index')->with('error', __('Country not found!'));
        } catch (\Exception $e) {
            return redirect()->route('admin.countries.index')->with('error', __('Erro ao deletar País!'));
        }
    }
}
