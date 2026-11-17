<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class UpdateUserOnlineStatus
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return Response
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check())
        {
            $expiresAt = now()->addMinute(5);
            Cache::put('user-is-online-' . auth('admin')->id(), true, $expiresAt);
        }
        return $next($request);
    }
}
