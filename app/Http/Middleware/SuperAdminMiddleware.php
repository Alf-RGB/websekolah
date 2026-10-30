<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SuperAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah user sudah login DAN role-nya adalah super_admin
        if (!auth()->check() || auth()->user()->role !== 'super_admin') {
            // Jika bukan, lempar ke halaman login atau tampilkan error 403
            return redirect('/login')->with('error', 'Akses ditolak! Hanya Super Admin yang boleh masuk.');
        }

        return $next($request);
    }
}