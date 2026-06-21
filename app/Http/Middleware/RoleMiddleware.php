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
        
        // Cek apakah role user ada di dalam list role yang diizinkan
        if($userRole === 'member'){
            return redirect()->route('welcome')->with('error', 'Anda tidak memiliki akses ke halaman ini!');
        }

        // Kalo role user ada di dalam list role yang diizinkan, lanjut ke request
        return $next($request);
    }
}
