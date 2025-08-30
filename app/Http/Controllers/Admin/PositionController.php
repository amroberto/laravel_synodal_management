<?php

namespace App\Http\Controllers\Admin;

use App\Models\Position;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $positions = Position::all();
        return view('admin.positions.index', compact('positions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.positions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Position::create($request->all());

        return redirect()->route('admin.positions.index')
            ->with('success', 'Cargo criado com sucesso!');
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
    public function edit(string $id)
    {
        $position = Position::find($id);
        return view('admin.positions.edit', compact('position'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $position = Position::find($id);
        if (is_null($position)) {
            return redirect()->route('admin.positions.index')
                ->with('error', 'Cargo não encontrado.');
        }

        $position->update($request->all());

        return redirect()->route('admin.positions.index')
            ->with('success', 'Cargo atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $position = Position::find($id);
        if (is_null($position)) {
            return redirect()->route('admin.positions.index')
                ->with('error', 'Cargo não encontrado.');
        }

        $position->delete();

        return redirect()->route('admin.positions.index')
            ->with('success', 'Cargo deletado com sucesso!');
    }
}
