<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Setting;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

            if ($this->app->environment('production')) {
                URL::forceScheme('https');
            }
        // 🪄 MAGIC TRICK: Otomatis kirim variabel ke SEMUA view di folder 'admin'
        View::composer('admin.*', function ($view) {
            if (Auth::check()) {
                $user = Auth::user();
                
                // 1. Tentukan Layout berdasarkan role
                $layout = ($user->role === 'super_admin') ? 'layouts.superadmin' : 'layouts.admin';
                
                // 2. Ambil Paket Aktif (Default 'full')
                $packageLevel = Setting::where('key', 'package_level')->value('value') ?? 'full';
                
                // 3. Mapping Fitur per Paket
                $featuresMap = [
                    'easy'   => ['profil', 'berita', 'galeri', 'kontak'],
                    'medium' => ['profil', 'berita', 'galeri', 'kontak', 'guru', 'lamaran', 'jurusan', 'ppdb'],
                    'full'   => ['profil', 'berita', 'galeri', 'kontak', 'guru', 'lamaran', 'jurusan', 'ppdb', 'alumni'],
                ];

                $activeFeatures = $featuresMap[$packageLevel] ?? $featuresMap['full'];

                // 4. Kirim variabel ke View
                $view->with('layout', $layout);
                $view->with('activeFeatures', $activeFeatures);
                $view->with('packageLevel', $packageLevel);
            }
        });
    }
}