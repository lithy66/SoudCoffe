<?php

namespace App\Http\Middleware;

use App\Models\AdminSession;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class TrackAdminSession
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->guard('admin')->check())
        {
            $admin = auth()->guard('admin')->user();
            if (!Cache::has('session_updated_' . $admin->id))
            {
                AdminSession::where('admin_id', $admin->id)
                    ->where('token', session()->getId())
                    ->update(['last_activity' => now()]);
                Cache::put('session_updated_' . $admin->id, true, now()->addMinutes(2));
            }
            Cache::put('admin_online_' . $admin->id, true, now()->addMinutes(5));
        }
        return $next($request);
    }
}
