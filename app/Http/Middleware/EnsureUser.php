<?php

namespace App\Http\Middleware;

use Closure;
use App\Enums\UserTypeEnum;
use Illuminate\Http\Request;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUser
{
    public function handle(Request $request, Closure $next): Response
    {
return $next($request);
    }
}
