<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->is_active) {
            return $next($request);
        }

        Log::warning('Acesso negado no middleware IsActive', ['user_id' => Auth::id()]);
        Auth::logout();
        return redirect('/login')->with('error', __('Sua conta está inativa.'));
    }
}
