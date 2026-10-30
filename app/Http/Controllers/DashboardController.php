<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Gallery;
use App\Models\Pendaftar;
use App\Models\Page;
use App\Models\Kompetensi;
use App\Models\Alumni;
use App\Models\Setting;
use App\Models\Visitor;
use App\Models\Guru;
use App\Models\LamaranGuru;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        // Jika Super Admin
        if ($user->role === 'super_admin') {
            return view('admin.superadmin-dashboard');
        }
        
        // Untuk Admin biasa
        $layout = 'layouts.admin';
        
        // Ambil paket aktif sekolah
        $packageLevel = Setting::where('key', 'package_level')->value('value') ?? 'full';
        
        // Definisi fitur per paket
        $packageFeatures = [
            'easy'   => ['profil', 'berita', 'galeri', 'kontak'],
            'medium' => ['profil', 'berita', 'galeri', 'kontak', 'guru', 'lamaran', 'jurusan', 'ppdb'],
            'full'   => ['profil', 'berita', 'galeri', 'kontak', 'guru', 'lamaran', 'jurusan', 'ppdb', 'alumni'],
        ];
        
        $activeFeatures = $packageFeatures[$packageLevel] ?? $packageFeatures['full'];
        
        // Statistik yang akan ditampilkan (hanya yang sesuai paket)
        $stats = [];
        
        if (in_array('berita', $activeFeatures)) {
            $stats['berita'] = Post::count();
        }
        
        if (in_array('galeri', $activeFeatures)) {
            $stats['galeri'] = Gallery::count();
        }
        
        if (in_array('ppdb', $activeFeatures)) {
            $stats['ppdb'] = Pendaftar::count();
        }
        
        if (in_array('jurusan', $activeFeatures)) {
            $stats['jurusan'] = Kompetensi::count();
        }
        
        if (in_array('alumni', $activeFeatures)) {
            $stats['alumni'] = Alumni::count();
        }
        
        // ✅ TOTAL GURU (untuk paket medium & full)
        if (in_array('guru', $activeFeatures)) {
            $stats['guru'] = Guru::count();
        }
        
        // ✅ TOTAL PELAMAR GURU (untuk paket medium & full)
        if (in_array('lamaran', $activeFeatures)) {
            $stats['pelamar'] = LamaranGuru::count();
        }
        
        // Halaman kustom (selalu ada)
        $stats['pages'] = Page::count();
        
        // 📊 STATISTIK PENGUNJUNG (GRAFIK)
        $visitorStats = [
            'today' => Visitor::whereDate('visited_at', now()->toDateString())->count(),
            'yesterday' => Visitor::whereDate('visited_at', now()->subDay()->toDateString())->count(),
            'this_week' => Visitor::whereBetween('visited_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
            'this_month' => Visitor::whereMonth('visited_at', now()->month)->count(),
            'total' => Visitor::count(),
        ];
        
        // Data untuk grafik (30 hari terakhir)
        $chartLabels = [];
        $chartData = [];
        
        for ($i = 29; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $chartLabels[] = $date->format('d M');
            $chartData[] = Visitor::whereDate('visited_at', $date->toDateString())->count();
        }

        return view('admin.dashboard', compact(
            'layout',
            'stats',
            'activeFeatures',
            'packageLevel',
            'visitorStats',
            'chartLabels',
            'chartData'
        ));
    }
}