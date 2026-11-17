<?php

namespace App\Http\Middleware;

use App\Models\Admin;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UpdateLastSeen
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
        if (auth()->check())
        {
            $userId = auth()->id();

            Cache::put(
                "user_online_{$userId}",
                true,
                now()->addMinutes(5)
            );

            Cache::remeber("last_seen_update_{$userId}", 180, function () use ($userId){
                Admin::where('id', $userId)->update(['last_seen_at' => now()]);
                return true;
            });
        }
        return $next($request);
    }
}
