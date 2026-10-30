<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        
        // 1. Daftarkan Semua Middleware Aliases
        $middleware->alias([
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
            'super_admin' => \App\Http\Middleware\SuperAdminMiddleware::class,
            'guru.active' => \App\Http\Middleware\CheckActiveGuru::class,
        ]);

        // 2. Tambahkan TrackVisitor ke grup middleware 'web'
        $middleware->web(append: [
            \App\Http\Middleware\TrackVisitor::class,
        ]);

        // 3. PERBAIKAN REDIRECT GUEST (Multi-Auth Login)
        $middleware->redirectGuestsTo(function ($request) {
            if ($request->routeIs('portal.guru.*')) {
                return route('portal.guru.login');
            }
            return route('login');
        });

    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*'),
        );
    })->create();