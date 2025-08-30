<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Enums\UserTypeEnum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Lista todos os usuários.
     */
    public function index()
    {
        Log::info('UserController::index chamado');
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        Log::info('UserController::create chamado');
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8',
            'user_type' => ['required', 'in:' . implode(',', array_column(UserTypeEnum::cases(), 'value'))],
            'active' => 'required|boolean',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'user_type' => $validated['user_type'],
            'active' => $validated['active'],
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Usuário criado com sucesso!');
    }

    public function edit(User $user)
    {
        Log::info('UserController::edit chamado', ['user_id' => $user->id]);
        return view('admin.users.edit', [
            'user' => $user ,  'userTypes' => UserTypeEnum::cases()
        ]);
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'user_type' => 'required|in:' . implode(',', UserTypeEnum::getValues()),
            'is_active' => ['required', 'boolean'],
        ]);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'user_type' => $validated['user_type'],
            'is_active' => $validated['is_active'],
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Usuário atualizado com sucesso.');
    }

    public function toggleActive(User $user)
    {
        $user->is_active = !$user->is_active;
        $user->save();

        return redirect()->route('admin.users.index')->with('success', $user->active ? 'Usuário ativado com sucesso!' : 'Usuário desativado com sucesso!');
    }
}
