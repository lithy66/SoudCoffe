<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ForcePasswordChange
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
        $admin = auth('admin')->user();

        if ($admin && $admin->must_change_password
            && !$request->routeIs('admin.password.*', 'admin.two-factor.*', 'admin.account.logout')) {
            return redirect()->route('admin.password.change');
        }

        return $next($request);
    }
}
