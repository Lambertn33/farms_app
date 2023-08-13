<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, String $role): Response
    {
        if (!Auth::user()->has_confirmed_password) {
            return response()->json(['error' => 'You have not changed your password yet'], 400);
        }
        if (Auth::user()->role !== $role) {
            return response()->json(['error' => 'Unauthorized'], 400);
        }
        return $next($request);
    }
}
