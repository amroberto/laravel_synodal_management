<?php

namespace App\Http\Middleware;

use Closure;
use App\Enums\UserTypeEnum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
      Log::info('CheckAdminAccess Middleware', [
        'user_authenticated' => Auth::check(),
        'user_type' => Auth::check() ? Auth::user()->user_type : null,
        'request_url' => $request->url(),
    ]);

    if (Auth::check() && Auth::user()->user_type === UserTypeEnum::ADMIN) {
        return $next($request);
    }

    Log::warning('Unauthorized access attempt', [
        'user_id' => Auth::check() ? Auth::user()->id : null,
        'user_type' => Auth::check() ? Auth::user()->user_type : null,
    ]);

    return redirect('/dashboard')->with('error', 'Acesso não autorizado.');
    }
}
