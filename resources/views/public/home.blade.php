@extends('layouts.app')

@section('title', 'Beranda - ' . ($settings['school_name'] ?? 'SMK Multi Karya Medan'))

@section('content')

@php
    // Fetch settings
    $settings = \App\Models\Setting::pluck('value', 'key')->toArray();
    
    // Fetch hero galleries (active, latest 5)
    $heroGalleries = \App\Models\Gallery::where('is_active', 1)
        ->orderBy('created_at', 'desc')
        ->take(5)
        ->get();
    
    // Fetch sambutan kepala sekolah
    $sambutan = \App\Models\Page::where('slug', 'sambutan-kepala-sekolah')
        ->orWhere('slug', 'sambutan')
        ->first();
    
    // Fetch latest posts (published, latest 3)
    $latestPosts = \App\Models\Post::where('is_published', 1)
        ->orderBy('created_at', 'desc')
        ->take(3)
        ->get();
    
    // Fetch latest galleries (active, latest 3)
    $latestGalleries = \App\Models\Gallery::where('is_active', 1)
        ->orderBy('created_at', 'desc')
        ->take(3)
        ->get();
    
    // Fetch active teachers (latest 3)
    $previewGurus = \App\Models\Guru::where('is_active', 1)
        ->orderBy('created_at', 'desc')
        ->take(3)
        ->get();
@endphp

<style>
    /* =========================================
       1. CSS VARIABLES & ANIMATIONS
       ========================================= */
    :root {
        --bg-primary: #F8FAFC;
        --bg-secondary: #FFFFFF;
        --bg-tertiary: #F1F5F9;
        --text-primary: #0F172A;
        --text-secondary: #475569;
        --text-muted: #94A3B8;
        --border-color: #E2E8F0;
        --accent-color: #7C3AED;
        --accent-hover: #6D28D9;
        --primary-color: #1D3557;
        --primary-hover: #457B9D;
        --shadow-sm: 0 1px 3px rgba(0,0,0,0.05);
        --shadow-md: 0 4px 6px -1px rgba(0,0,0,0.1);
        --shadow-lg: 0 10px 15px -3px rgba(0,0,0,0.1);
        --shadow-xl: 0 20px 25px -5px rgba(0,0,0,0.1);
        --transition-smooth: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    [data-theme="dark"] {
        --bg-primary: #0F172A;
        --bg-secondary: #1E293B;
        --bg-tertiary: #334155;
        --text-primary: #F1F5F9;
        --text-secondary: #CBD5E1;
        --text-muted: #94A3B8;
        --border-color: #334155;
        --shadow-sm: 0 1px 3px rgba(0,0,0,0.3);
        --shadow-md: 0 4px 6px -1px rgba(0,0,0,0.4);
        --shadow-lg: 0 10px 15px -3px rgba(0,0,0,0.5);
        --shadow-xl: 0 20px 25px -5px rgba(0,0,0,0.5);
    }

    @keyframes fadeInUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes fadeInDown { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes slideIn { from { opacity: 0; transform: scale(0.96) translateY(20px); } to { opacity: 1; transform: scale(1) translateY(0); } }

    /* =========================================
       2. GLOBAL WRAPPER & SECTIONS
       ========================================= */
    .homepage-wrapper { 
        max-width: 1200px; 
        margin: 0 auto; 
        padding: 20px; 
        animation: fadeInUp 0.6s ease-out;
    }
    .section-wrapper { margin-bottom: 80px; animation: fadeInUp 0.6s ease-out backwards; }
    .section-wrapper:nth-child(2) { animation-delay: 0.1s; }
    .section-wrapper:nth-child(3) { animation-delay: 0.2s; }
    .section-wrapper:nth-child(4) { animation-delay: 0.3s; }
    .section-wrapper:nth-child(5) { animation-delay: 0.4s; }
    .section-wrapper:nth-child(6) { animation-delay: 0.5s; }

    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        flex-wrap: wrap;
        gap: 15px;
    }
    .section-title {
        color: var(--text-primary);
        border-left: 5px solid var(--accent-color);
        padding-left: 15px;
        font-size: 28px;
        font-weight: 800;
    }
    .section-link {
        color: var(--accent-color);
        font-weight: 700;
        font-size: 14px;
        text-decoration: none;
        transition: var(--transition-smooth);
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }
    .section-link:hover {
        color: var(--accent-hover);
        gap: 10px;
    }

    /* =========================================
       3. HERO CAROUSEL
       ========================================= */
    .hero-carousel {
        position: relative;
        border-radius: 24px;
        overflow: hidden;
        height: 500px;
        box-shadow: var(--shadow-xl);
        margin-bottom: 20px;
    }
    .carousel-track {
        display: flex;
        height: 100%;
        transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .carousel-slide {
        flex: 0 0 100%;
        position: relative;
        display: flex;
        align-items: flex-end;
    }
    .slide-bg {
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background-size: cover;
        background-position: center;
        transition: transform 6s ease;
    }
    .carousel-slide:hover .slide-bg { transform: scale(1.05); }
    .slide-overlay {
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: linear-gradient(to top, rgba(0, 0, 0, 0.9) 0%, rgba(0, 0, 0, 0.4) 50%, transparent 100%);
    }
    .slide-content {
        position: relative;
        z-index: 2;
        padding: 50px;
        color: white;
        max-width: 800px;
    }
    .slide-content h1 {
        font-size: 42px;
        font-weight: 800;
        margin-bottom: 15px;
        text-shadow: 0 4px 15px rgba(0,0,0,0.5);
        line-height: 1.2;
    }
    .slide-content p {
        font-size: 18px;
        opacity: 0.95;
        margin-bottom: 25px;
        max-width: 600px;
        line-height: 1.6;
    }
    .carousel-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(255,255,255,0.9);
        border: none;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        cursor: pointer;
        font-size: 20px;
        color: var(--primary-color);
        box-shadow: var(--shadow-lg);
        z-index: 20;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: var(--transition-smooth);
    }
    .carousel-btn:hover {
        background: white;
        transform: translateY(-50%) scale(1.1);
        box-shadow: var(--shadow-xl);
    }
    .carousel-btn.prev { left: 20px; }
    .carousel-btn.next { right: 20px; }

    .hero-dots {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-top: 20px;
    }
    .hero-dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        border: none;
        background: rgba(124, 58, 237, 0.3);
        cursor: pointer;
        transition: var(--transition-smooth);
    }
    .hero-dot.active {
        width: 24px;
        border-radius: 4px;
        background: var(--accent-color);
    }

    /* =========================================
       4. SAMBUTAN CARD
       ========================================= */
    .sambutan-card {
        background: var(--bg-secondary);
        padding: 40px;
        border-radius: 24px;
        box-shadow: var(--shadow-lg);
        display: flex;
        flex-wrap: wrap;
        gap: 40px;
        align-items: center;
        border: 1px solid var(--border-color);
        transition: var(--transition-smooth);
    }
    .sambutan-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-xl);
    }
    .sambutan-avatar {
        width: 160px;
        height: 160px;
        background: linear-gradient(135deg, var(--accent-color), var(--accent-hover));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 70px;
        box-shadow: 0 10px 30px rgba(124, 58, 237, 0.3);
        border: 4px solid var(--bg-secondary);
        flex-shrink: 0;
        transition: var(--transition-smooth);
    }
    .sambutan-card:hover .sambutan-avatar { transform: scale(1.05) rotate(-3deg); }
    .sambutan-label {
        color: var(--accent-color);
        font-size: 13px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        margin-bottom: 10px;
    }
    .sambutan-title {
        color: var(--text-primary);
        font-size: 32px;
        margin-bottom: 20px;
        line-height: 1.2;
        font-weight: 800;
    }
    .sambutan-text {
        color: var(--text-secondary);
        line-height: 1.8;
        font-size: 16px;
    }
    .sambutan-link {
        display: inline-flex;
        align-items: center;
        margin-top: 20px;
        color: var(--accent-color);
        font-weight: 700;
        text-decoration: none;
        font-size: 15px;
        transition: var(--transition-smooth);
        gap: 5px;
    }
    .sambutan-link:hover { gap: 10px; color: var(--accent-hover); }

    /* =========================================
       5. NEWS & GALLERY CARDS
       ========================================= */
    .content-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 25px;
    }
    .content-card {
        background: var(--bg-secondary);
        border-radius: 20px;
        overflow: hidden;
        box-shadow: var(--shadow-md);
        border: 1px solid var(--border-color);
        transition: var(--transition-smooth);
        height: 100%;
        display: flex;
        flex-direction: column;
        text-decoration: none;
        color: inherit;
    }
    .content-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-xl);
        border-color: var(--accent-color);
    }
    .card-image-wrapper {
        width: 100%;
        height: 200px;
        overflow: hidden;
        position: relative;
    }
    .card-image-wrapper.tall { height: 280px; }
    .card-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .content-card:hover .card-image { transform: scale(1.08); }
    .card-placeholder {
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, var(--accent-color), var(--accent-hover));
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 50px;
    }
    .card-body {
        padding: 24px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }
    .card-badge {
        background: rgba(124, 58, 237, 0.1);
        color: var(--accent-color);
        padding: 6px 14px;
        border-radius: 50px;
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
        align-self: flex-start;
        letter-spacing: 0.5px;
        margin-bottom: 15px;
        transition: var(--transition-smooth);
    }
    .content-card:hover .card-badge {
        background: var(--accent-color);
        color: white;
    }
    .card-title {
        margin: 0 0 15px 0;
        font-size: 18px;
        color: var(--text-primary);
        line-height: 1.4;
        flex: 1;
        font-weight: 700;
    }
    .card-meta {
        color: var(--text-secondary);
        font-size: 13px;
        margin-top: auto;
        display: flex;
        align-items: center;
        gap: 6px;
        font-weight: 500;
    }

    /* Gallery Overlay */
    .gallery-overlay {
        position: absolute;
        bottom: 0; left: 0; right: 0;
        background: linear-gradient(transparent, rgba(0, 0, 0, 0.85));
        color: white;
        padding: 30px 20px 20px;
        transition: var(--transition-smooth);
    }
    .content-card:hover .gallery-overlay { padding-bottom: 25px; }
    .gallery-overlay p {
        font-size: 16px;
        font-weight: 700;
        margin: 0;
        line-height: 1.4;
    }

    /* =========================================
       6. GURU CARDS
       ========================================= */
    .guru-card {
        background: var(--bg-secondary);
        border-radius: 20px;
        overflow: hidden;
        box-shadow: var(--shadow-md);
        border: 1px solid var(--border-color);
        transition: var(--transition-smooth);
        text-decoration: none;
        color: inherit;
        display: block;
    }
    .guru-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-xl);
        border-color: var(--accent-color);
    }
    .guru-header {
        height: 80px;
        background: linear-gradient(135deg, var(--accent-color), var(--accent-hover));
        position: relative;
    }
    .guru-header::after {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Ccircle cx='20' cy='20' r='15' fill='rgba(255,255,255,0.1)'/%3E%3Ccircle cx='80' cy='60' r='25' fill='rgba(255,255,255,0.05)'/%3E%3C/svg%3E");
    }
    .guru-avatar-wrapper {
        position: relative;
        padding: 0 20px;
        margin-top: -40px;
    }
    .guru-avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        border: 4px solid var(--bg-secondary);
        margin: 0 auto;
        overflow: hidden;
        box-shadow: var(--shadow-md);
        background: white;
        transition: var(--transition-smooth);
    }
    .guru-card:hover .guru-avatar { transform: scale(1.1) rotate(-3deg); }
    .guru-avatar img { width: 100%; height: 100%; object-fit: cover; }
    .guru-avatar-placeholder {
        width: 100%; height: 100%;
        background: linear-gradient(135deg, var(--accent-color), var(--accent-hover));
        display: flex; align-items: center; justify-content: center;
        color: white; font-size: 28px; font-weight: 700;
    }
    .guru-info {
        padding: 20px;
        text-align: center;
    }
    .guru-name {
        color: var(--text-primary);
        font-size: 17px;
        margin: 0 0 8px 0;
        font-weight: 700;
        line-height: 1.3;
    }
    .guru-subject {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(124, 58, 237, 0.1);
        color: var(--accent-color);
        padding: 6px 14px;
        border-radius: 50px;
        font-size: 12px;
        font-weight: 600;
        margin-bottom: 12px;
    }
    .guru-nip {
        color: var(--text-secondary);
        font-size: 12px;
        margin: 0;
        font-weight: 500;
    }

    /* =========================================
       7. INFO CEPAT (CTA)
       ========================================= */
    .cta-grid {
        display: flex;
        justify-content: center;
        gap: 30px;
        flex-wrap: wrap;
    }
    .cta-card {
        text-decoration: none;
        color: inherit;
        background: var(--bg-secondary);
        padding: 40px 30px;
        border-radius: 24px;
        text-align: center;
        box-shadow: var(--shadow-md);
        width: 100%;
        max-width: 400px;
        border: 1px solid var(--border-color);
        border-top: 5px solid var(--accent-color);
        transition: var(--transition-smooth);
    }
    .cta-card.orange { border-top-color: #F59E0B; }
    .cta-card.orange .cta-icon { color: #F59E0B; }
    .cta-card.orange .cta-link { color: #F59E0B; }
    
    .cta-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-xl);
    }
    .cta-icon {
        font-size: 48px;
        margin-bottom: 20px;
        display: inline-block;
        color: var(--accent-color);
        transition: var(--transition-smooth);
    }
    .cta-card:hover .cta-icon { transform: scale(1.1) rotate(-5deg); }
    .cta-title {
        margin-bottom: 12px;
        color: var(--text-primary);
        font-weight: 800;
        font-size: 22px;
    }
    .cta-desc {
        color: var(--text-secondary);
        font-size: 15px;
        margin-bottom: 25px;
        line-height: 1.6;
    }
    .cta-link {
        color: var(--accent-color);
        font-weight: 800;
        font-size: 15px;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        transition: var(--transition-smooth);
    }
    .cta-card:hover .cta-link { gap: 10px; }

    /* =========================================
       8. DARK MODE OVERRIDES
       ========================================= */
    [data-theme="dark"] .card-badge {
        background: rgba(124, 58, 237, 0.25) !important;
        color: #C4B5FD !important;
    }
    [data-theme="dark"] .content-card:hover .card-badge {
        background: var(--accent-color) !important;
        color: white !important;
    }
    [data-theme="dark"] .sambutan-card,
    [data-theme="dark"] .content-card,
    [data-theme="dark"] .guru-card,
    [data-theme="dark"] .cta-card {
        background: var(--bg-secondary) !important;
        border-color: var(--border-color) !important;
    }
    [data-theme="dark"] .section-title,
    [data-theme="dark"] .sambutan-title,
    [data-theme="dark"] .card-title,
    [data-theme="dark"] .guru-name,
    [data-theme="dark"] .cta-title {
        color: var(--text-primary) !important;
    }
    [data-theme="dark"] .sambutan-text,
    [data-theme="dark"] .card-meta,
    [data-theme="dark"] .guru-nip,
    [data-theme="dark"] .cta-desc {
        color: var(--text-secondary) !important;
    }

    /* =========================================
       9. RESPONSIVE
       ========================================= */
    @media (max-width: 768px) {
        .homepage-wrapper { padding: 15px; }
        .hero-carousel { height: 350px; }
        .slide-content { padding: 30px; }
        .slide-content h1 { font-size: 28px; }
        .slide-content p { font-size: 14px; }
        .carousel-btn { width: 40px; height: 40px; font-size: 16px; }
        .hero-dot { width: 8px; height: 8px; }
        .hero-dot.active { width: 20px; }
        
        .sambutan-card { padding: 30px 20px; flex-direction: column; text-align: center; }
        .section-title { font-size: 24px; }
        .content-grid { grid-template-columns: 1fr; }
        .guru-grid { grid-template-columns: 1fr; }
        .cta-grid { flex-direction: column; align-items: center; }
    }
</style>

<div class="homepage-wrapper">

    {{-- 1. HERO CAROUSEL --}}
    <div class="section-wrapper">
        <div class="hero-carousel" id="heroCarousel">
            <div class="carousel-track">
                @forelse($heroGalleries as $img)
                    @php
                        $heroImgPath = $img->gambar ? asset('storage/' . $img->gambar) : null;
                    @endphp
                    <div class="carousel-slide">
                        @if($heroImgPath)
                            <div class="slide-bg" style="background-image: url('{{ $heroImgPath }}');"></div>
                        @endif
                        <div class="slide-overlay"></div>
                        <div class="slide-content">
                            <h1>{{ $img->judul }}</h1>
                            @if($img->deskripsi)
                                <p>{{ Str::limit(strip_tags($img->deskripsi), 120) }}</p>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="carousel-slide" style="align-items: center; justify-content: center; background: linear-gradient(135deg, var(--accent-color), var(--accent-hover));">
                        <div class="slide-content" style="text-align: center; max-width: 100%;">
                            <h1>Selamat Datang</h1>
                            <p>Di Website Resmi {{ $settings['school_name'] ?? 'SMK Multi Karya Medan' }}</p>
                        </div>
                    </div>
                @endforelse
            </div>
            
            @if($heroGalleries->count() > 1)
                <button onclick="moveHero(-1)" class="carousel-btn prev">&#10094;</button>
                <button onclick="moveHero(1)" class="carousel-btn next">&#10095;</button>
            @endif
        </div>
        
        @if($heroGalleries->count() > 1)
            <div class="hero-dots" id="heroDots">
                @foreach($heroGalleries as $index => $img)
                    <button onclick="goToHero({{ $index }})" class="hero-dot {{ $index === 0 ? 'active' : '' }}" data-index="{{ $index }}"></button>
                @endforeach
            </div>
        @endif
    </div>

    {{-- 2. SAMBUTAN KEPALA SEKOLAH --}}
    @if($sambutan)
    <div class="section-wrapper">
        <div class="sambutan-card">
            <div class="sambutan-avatar">👨‍🏫</div>
            <div style="flex: 1; min-width: 300px;">
                <p class="sambutan-label">Sambutan</p>
                <h2 class="sambutan-title">Kepala Sekolah</h2>
                <div class="sambutan-text">
                    {!! nl2br(e(Str::limit($sambutan->konten, 350))) !!}
                </div>
                <a href="/profil" class="sambutan-link">
                    Baca Selengkapnya 
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </a>
            </div>
        </div>
    </div>
    @endif

    {{-- 3. BERITA TERBARU --}}
    @if($latestPosts->isNotEmpty())
    <div class="section-wrapper">
        <div class="section-header">
            <h2 class="section-title">📰 Berita Terbaru</h2>
            <a href="/berita" class="section-link">Lihat Semua Berita <span>→</span></a>
        </div>
        
        <div class="content-grid">
            @foreach($latestPosts as $post)
                @php
                    $thumbExists = $post->image && file_exists(public_path('storage/posts/' . $post->image));
                    $thumbPath = $thumbExists ? asset('storage/posts/' . $post->image) : null;
                @endphp
                <a href="/berita/{{ $post->slug }}" class="content-card">
                    <div class="card-image-wrapper">
                        @if($thumbPath)
                            <img src="{{ $thumbPath }}" alt="{{ $post->judul }}" class="card-image" loading="lazy">
                        @else
                            <div class="card-placeholder">📰</div>
                        @endif
                    </div>
                    <div class="card-body">
                        <span class="card-badge">{{ $post->kategori ?? 'Umum' }}</span>
                        <h3 class="card-title">{{ $post->judul }}</h3>
                        <p class="card-meta">📅 {{ $post->created_at->format('d M Y') }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
    @endif

    {{-- 4. GALERI KEGIATAN --}}
    @if($latestGalleries->isNotEmpty())
    <div class="section-wrapper">
        <div class="section-header">
            <h2 class="section-title">📸 Galeri Kegiatan</h2>
            <a href="/galeri" class="section-link">Lihat Semua Galeri <span>→</span></a>
        </div>
        
        <div class="content-grid">
            @foreach($latestGalleries as $gallery)
                @php
                    $galImgExists = $gallery->gambar && file_exists(public_path('storage/' . $gallery->gambar));
                    $galImgPath = $galImgExists ? asset('storage/' . $gallery->gambar) : null;
                @endphp
                <a href="/galeri/{{ $gallery->slug }}" class="content-card">
                    <div class="card-image-wrapper tall">
                        @if($galImgPath)
                            <img src="{{ $galImgPath }}" alt="{{ $gallery->judul }}" class="card-image" loading="lazy">
                        @else
                            <div class="card-placeholder">📷</div>
                        @endif
                        <div class="gallery-overlay">
                            <p>{{ $gallery->judul }}</p>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
    @endif

    {{-- 5. PREVIEW GURU --}}
    @if($previewGurus->isNotEmpty())
    <div class="section-wrapper">
        <div class="section-header">
            <h2 class="section-title">👨‍🏫 Tenaga Pendidik</h2>
            <a href="/profil/guru" class="section-link">Lihat Semua Guru <span>→</span></a>
        </div>
        
        <div class="content-grid guru-grid">
            @foreach($previewGurus as $guru)
                @php
                    $guruFotoExists = $guru->foto && file_exists(public_path('storage/gurus/' . $guru->foto));
                    $guruFotoPath = $guruFotoExists ? asset('storage/gurus/' . $guru->foto) : null;
                @endphp
                <a href="/portal-akademik/guru/{{ $guru->id }}" class="guru-card">
                    <div class="guru-header"></div>
                    <div class="guru-avatar-wrapper">
                        <div class="guru-avatar">
                            @if($guruFotoPath)
                                <img src="{{ $guruFotoPath }}" alt="{{ $guru->nama }}" loading="lazy">
                            @else
                                <div class="guru-avatar-placeholder">{{ strtoupper(substr($guru->nama, 0, 1)) }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="guru-info">
                        <h3 class="guru-name">{{ $guru->nama }}</h3>
                        @if($guru->mata_pelajaran)
                            <div class="guru-subject">
                                <span>📚</span> {{ $guru->mata_pelajaran }}
                            </div>
                        @endif
                        @if($guru->nip)
                            <p class="guru-nip"><span style="opacity: 0.7;">NIP:</span> {{ $guru->nip }}</p>
                        @endif
                    </div>
                </a>
            @endforeach
        </div>
    </div>
    @endif

    {{-- 6. INFO CEPAT (CTA) --}}
    <div class="section-wrapper">
        <div class="cta-grid">
            <a href="/portal-akademik" class="cta-card">
                <div class="cta-icon">🎓</div>
                <h3 class="cta-title">Portal Akademik</h3>
                <p class="cta-desc">Akses profil guru, kompetensi keahlian, dan data alumni dengan mudah.</p>
                <span class="cta-link">Buka Portal <span>→</span></span>
            </a>
            
            <a href="/portal-akademik/ppdb" class="cta-card orange">
                <div class="cta-icon">📝</div>
                <h3 class="cta-title">PPDB Online</h3>
                <p class="cta-desc">Penerimaan Peserta Didik Baru. Daftar mudah, cepat, dan transparan.</p>
                <span class="cta-link">Daftar Sekarang <span>→</span></span>
            </a>
        </div>
    </div>

</div>

{{-- SCRIPT KHUSUS HERO CAROUSEL --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let currentHero = 0;
        const heroSlides = document.querySelectorAll('#heroCarousel .carousel-slide');
        const totalHero = heroSlides.length;
        const heroDots = document.querySelectorAll('.hero-dot');
        const track = document.querySelector('#heroCarousel .carousel-track');
        
        if (totalHero > 1 && track) {
            function updateHero() {
                track.style.transform = 'translateX(-' + (currentHero * 100) + '%)';
                heroDots.forEach((d, i) => {
                    if (i === currentHero) {
                        d.classList.add('active');
                    } else {
                        d.classList.remove('active');
                    }
                });
            }
            
            window.moveHero = function(dir) { 
                currentHero = (currentHero + dir + totalHero) % totalHero; 
                updateHero(); 
            }
            
            window.goToHero = function(idx) { 
                currentHero = idx; 
                updateHero(); 
            }
            
            // Auto slide every 6 seconds
            setInterval(() => window.moveHero(1), 6000);
            updateHero();
        }
    });
</script>

@endsection