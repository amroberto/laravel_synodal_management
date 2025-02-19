<?php

namespace App\Http\Middleware;

use Closure;
use App\Enums\UserTypeEnum;
use Illuminate\Http\Request;
use Filament\Facades\Filament;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = Filament::auth()->user();
        if($user && !$user->is_admin){
            Filament::auth()->logout();
            session()->invalidate();
            session()->regenerateToken();

            return redirect()->route('filament.app.auth.login');
        }
        
        return $next($request);
    }
}
