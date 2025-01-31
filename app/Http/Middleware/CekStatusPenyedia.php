<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CekStatusPenyedia
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $status): Response
    {
        if (auth()->check() && auth()->user()->role === 'penyedia') {
            // Cek apakah status penyedia sesuai dengan parameter middleware
            if (auth()->user()->penyedia->status == $status) {
                return $next($request);
            }
        }

        // Jika tidak memenuhi syarat, arahkan ke halaman lain atau tolak akses
        abort(403, 'Anda tidak memiliki akses ke halaman ini.');
    }
}
