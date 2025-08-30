<?php

namespace App\Http\Controllers\Auth;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Auth\LoginRequest;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        try {
            Log::info('Tentativa de login para email: ' . $request->email);
            $credentials = $request->only('email', 'password');
            Log::info('Credenciais recebidas: ' . json_encode(['email' => $credentials['email'], 'password' => '***']));

            if (!Auth::attempt($credentials)) {
                Log::warning('Falha na autenticação para email: ' . $request->email);
                return redirect()->route('login')->with('error', 'Credenciais inválidas.');
            }

            $request->session()->regenerate();
            $user = Auth::user();
            $userType = $user->user_type->value;
            Log::info('Login bem-sucedido para usuário ID: ' . $user->id . ', user_type: ' . $userType);

            switch ($userType) {
                case 'admin':
                    Log::info('Redirecionando para admin.dashboard para usuário ID: ' . $user->id);
                    return redirect()->route('admin.dashboard');
                case 'user':
                    Log::info('Redirecionando para user.dashboard para usuário ID: ' . $user->id);
                    return redirect()->route('user.dashboard');
                case 'reader':
                    Log::info('Redirecionando para home para usuário ID: ' . $user->id);
                    return redirect()->route('dashboard');
                default:
                    Log::warning('Nenhum user_type específico correspondido para usuário ID: ' . $user->id . ', voltando para home');
                    return redirect()->route('dashboard');
            }
        } catch (\Exception $e) {
            Log::error('Erro ao realizar login: ' . $e->getMessage() . ' | Email: ' . $request->email);
            return redirect()->route('login')->with('error', 'Erro ao realizar login: ' . $e->getMessage());
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        try {
        $userId = Auth::id();
        Log::info('Tentativa de logout para usuário ID: ' . ($userId ?? 'convidado'));
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        Log::info('Logout bem-sucedido para usuário ID: ' . ($userId ?? 'convidado'));
        return redirect()->route('home')->with('success', 'Logout realizado com sucesso.');
        } catch (\Exception $e) {
            Log::error('Erro ao realizar logout: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Erro ao realizar logout.');
        }
    }
}
