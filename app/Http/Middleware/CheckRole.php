<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string $role 
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        if (Auth::user()->role == $role || Auth::user()->role == 'admin') {
            return $next($request);
        } else {
            return abort(401);
        }
    }
}
