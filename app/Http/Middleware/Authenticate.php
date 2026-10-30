<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        // Jika request mengharapkan JSON (API), jangan redirect
        if ($request->expectsJson()) {
            return null;
        }

        // ✅ CEK PINTAR: Jika route yang diakses adalah bagian dari portal guru
        if ($request->routeIs('portal.guru.*')) {
            return route('portal.guru.login');
        }

        // Default: arahkan ke halaman login admin
        return route('login');
    }
}