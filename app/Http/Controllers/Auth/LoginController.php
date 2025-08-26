<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Where to redirect users after login.
     *
     * @return string
     */
    protected function redirectTo()
    {
        $user = Auth::user();

        // Verifica se o usuário está ativo
        if (!$user->is_active) {
            Auth::logout(); // Desloga o usuário se não estiver ativo
            return '/login'; // Redireciona para oログイン
        }

        // Redireciona com base no papel de administrador
        if ($user->is_admin) {
            return '/admin/dashboard';
        }

        return '/user/dashboard';
    }
}
