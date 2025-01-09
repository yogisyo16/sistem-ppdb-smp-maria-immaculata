<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class UserAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$role)
    {
        if (!Auth::check()) {// This isnt necessary, it should be part of your 'auth' middleware
            return $next($request);
        }

        if (array_intersect(Auth::user()->role, ['admin', 'inti', 'keuangan', 'wawancara', 'seragam'])) {
            return $next($request);
        }

        if(in_array('siswa', Auth::user()->role)) {
            return $next($request);
        }

        if (in_array('admin', Auth::user()->role)) {
            return $next($request);
        }

        if (in_array('inti', Auth::user()->role)) {
            return $next($request);
        }

        if (in_array('keuangan', Auth::user()->role)) {
            return $next($request);
        }

        if (in_array('wawancara', Auth::user()->role)) {
            return $next($request);
        }

        if (in_array('seragam', Auth::user()->role)) {
            return $next($request);
        }
        // && in_array(Auth::user()->role, $role)
        return response('Forbidden', 403);
    }
}
