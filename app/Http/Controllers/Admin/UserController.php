<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
   /**
     * Lista todos os usuários.
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Exibe o formulário para criar um novo usuário.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Salva um novo usuário.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'is_admin' => 'boolean',
            'is_active' => 'boolean',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => $request->is_admin ?? false,
            'is_active' => $request->is_active ?? true,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Usuário criado com sucesso.');
    }

    /**
     * Exibe os detalhes de um usuário.
     */
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    /**
     * Exibe o formulário para editar um usuário.
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Atualiza um usuário existente.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'is_admin' => 'boolean',
            'is_active' => 'boolean',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
            'is_admin' => $request->is_admin ?? false,
            'is_active' => $request->is_active ?? true,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Usuário atualizado com sucesso.');
    }

    /**
     * Exclui um usuário.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Usuário excluído com sucesso.');
    } 
}
