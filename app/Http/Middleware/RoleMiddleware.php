<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Periksa apakah peran pengguna sesuai dengan yang diizinkan
        if (!$request->user()->hasAnyRole($roles) || $request->user()->is_active == 0) {
            abort(403, 'Unauthorized Or User Inactive');
        }

        return $next($request);
    }
}