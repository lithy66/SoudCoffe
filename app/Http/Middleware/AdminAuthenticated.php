<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::gurd('admin')->user()){
            return $next($request);
        }
        if($request->ajax() || $request->wantJson()){
            return response('Unauthorized', 401);
        }else{
            return redirect(route('admin.login'));
        }

    }
}
