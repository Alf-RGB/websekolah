<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Visitor;

class TrackVisitor
{
    public function handle(Request $request, Closure $next)
    {
        // Jangan track halaman admin, login, portal guru, API, dan asset
        $excludePaths = [
            'admin/*',
            'login',
            'logout',
            'portal/*',
            'api/*',
            'sanctum/*',
            'storage/*',
            'build/*',
            '_ignition/*',
            'telescope/*',
        ];

        foreach ($excludePaths as $path) {
            if ($request->is($path)) {
                return $next($request);
            }
        }

        // Jangan track bot/crawler (opsional tapi recommended)
        $userAgent = $request->userAgent() ?? '';
        $bots = ['bot', 'crawl', 'spider', 'slurp', 'facebook', 'twitter', 'linkedin', 'whatsapp'];
        foreach ($bots as $bot) {
            if (stripos($userAgent, $bot) !== false) {
                return $next($request);
            }
        }

        // Track hanya 1x per IP per hari (opsional, hemat database)
        $today = now()->toDateString();
        $existingVisitor = Visitor::where('ip_address', $request->ip())
            ->whereDate('visited_at', $today)
            ->first();

        if (!$existingVisitor) {
            try {
                Visitor::create([
                    'ip_address' => $request->ip(),
                    'user_agent' => substr($userAgent, 0, 255),
                    'page_url' => substr($request->fullUrl(), 0, 255),
                    'referer' => $request->header('referer') ? substr($request->header('referer'), 0, 255) : null,
                    'visited_at' => now(),
                ]);
            } catch (\Exception $e) {
                // Log error tapi jangan ganggu user
                \Log::error('Visitor tracking failed: ' . $e->getMessage());
            }
        }

        return $next($request);
    }
}