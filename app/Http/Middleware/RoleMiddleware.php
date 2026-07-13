<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Pastiin user udh login dulu
        if(!auth()->check()){
            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu.');        
        }
        // Ambil role user yang sedang akses
        $userRole = auth()->user()->role;
        
        // Cek apakah role user ada di dalam array $roles yang diizinkan (yang didapat dari parameter route)
        if (!in_array($userRole, $roles)) {
            abort(403, 'Forbidden Access');
        }

        // Kalo role user sesuai dengan rules di rute, lanjut ke request
        return $next($request);
    }
}
