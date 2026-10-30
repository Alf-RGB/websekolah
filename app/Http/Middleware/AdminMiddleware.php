<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Pastikan user sudah login (menggunakan guard default 'web')
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu untuk mengakses halaman Admin.');
        }

        $user = Auth::user();

        // 2. Cek Role: Izinkan 'admin' DAN 'super_admin' 
        // (Best Practice: Super Admin adalah level tertinggi, jadi harus bisa akses semua fitur admin)
        if (!in_array($user->role, ['admin', 'super_admin'])) {
            // Jika yang login adalah Guru atau role lain, tolak akses dan kembalikan ke login
            return redirect('/login')->with('error', 'Anda tidak memiliki izin untuk mengakses halaman Admin.');
        }

        /* 
         * CATATAN PENTING:
         * Jika kamu BENAR-BENAR (dengan sengaja) ingin membatasi Super Admin 
         * agar HANYA bisa mengelola User dan TIDAK BOLEH menyentuh konten, 
         * hapus komentar (//) pada 3 baris di bawah ini, dan hapus blok 'in_array' di atas.
         * 
         * if ($user->role === 'super_admin') {
         *     return redirect('/admin/users')->with('error', 'Super Admin hanya diarahkan ke manajemen User.');
         * }
         */

        return $next($request);
    }
}