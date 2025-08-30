<?php

namespace App\Http\Controllers\Admin;

use App\Models\State;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $states = State::all();
        return view('admin.states.index', compact('states'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.states.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'abbreviation' => 'required|string|max:10',
            'country_id' => 'required|exists:countries,id',
        ]);

        State::create($validated);

        return redirect()->route('admin.states.index')->with('success', __('State created successfully!'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $state = State::find($id);

        if(is_null($state)) {
            return redirect()->route('admin.states.index')->with('error', __('Estado não encontrao!'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $state = State::find($id);

        if(is_null($state)) {
            return redirect()->route('admin.states.index')->with('error', __('Estado não encontrao!'));
        }

        return view('admin.states.edit', compact('state'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $state = State::find($id);

        if(is_null($state)) {
            return redirect()->route('admin.states.index')->with('error', __('Estado não encontrao!'));
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'abbreviation' => 'required|string|max:10',
            'country_id' => 'required|exists:countries,id',
        ]);

        $state->update($validated);

        return redirect()->route('admin.states.index')->with('success', __('State updated successfully!'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $state = State::find($id);

        if(is_null($state)) {
            return redirect()->route('admin.states.index')->with('error', __('Estado não encontrao!'));
        }

        $state->delete();

        return redirect()->route('admin.states.index')->with('success', __('State deleted successfully!'));
    }
}
