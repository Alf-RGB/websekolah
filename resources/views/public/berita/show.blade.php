@extends('layouts.app')

@section('title', $post->judul . ' - Berita')

@section('content')

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
        --accent-color: #667eea;
        --accent-hover: #764ba2;
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

    @keyframes fadeInDown { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes slideIn { from { opacity: 0; transform: scale(0.98) translateY(20px); } to { opacity: 1; transform: scale(1) translateY(0); } }

    /* =========================================
       2. WRAPPER & LAYOUT
       ========================================= */
    .berita-show-page {
        max-width: 900px;
        margin: 60px auto;
        padding: 0 20px;
        animation: fadeInUp 0.6s ease-out;
    }

    /* =========================================
       3. BACK BUTTON
       ========================================= */
    .berita-show-page .btn-kembali {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: var(--bg-secondary);
        color: var(--text-primary);
        padding: 12px 24px;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 600;
        font-size: 14px;
        border: 1px solid var(--border-color);
        transition: var(--transition-smooth);
        margin-bottom: 30px;
        box-shadow: var(--shadow-sm);
        animation: fadeInDown 0.6s ease-out;
    }

    .berita-show-page .btn-kembali:hover {
        background: var(--bg-tertiary);
        border-color: var(--accent-color);
        color: var(--accent-color);
        transform: translateX(-5px);
        box-shadow: var(--shadow-md);
    }
    .berita-show-page .btn-kembali:active {
        transform: translateX(-5px) scale(0.98);
    }

    /* =========================================
       4. MAIN CARD & HEADER
       ========================================= */
    .berita-show-page .berita-card {
        background: var(--bg-secondary);
        border-radius: 24px;
        overflow: hidden;
        box-shadow: var(--shadow-lg);
        border: 1px solid var(--border-color);
        animation: slideIn 0.6s cubic-bezier(0.4, 0, 0.2, 1) 0.1s backwards;
    }

    .berita-show-page .berita-header {
        background: linear-gradient(135deg, var(--accent-color) 0%, var(--accent-hover) 100%);
        padding: 50px 40px;
        position: relative;
        overflow: hidden;
    }
    
    /* Decorative circles in header */
    .berita-show-page .berita-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 400px;
        height: 400px;
        background: rgba(255,255,255,0.1);
        border-radius: 50%;
    }

    .berita-show-page .berita-badge {
        display: inline-block;
        padding: 8px 20px;
        background: rgba(255,255,255,0.2);
        backdrop-filter: blur(10px);
        border-radius: 50px;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 20px;
        border: 1px solid rgba(255,255,255,0.3);
        color: #ffffff !important;
        position: relative;
        z-index: 1;
    }

    /* NUCLEAR OVERRIDE FOR TITLE */
    .berita-show-page .berita-judul {
        font-size: 36px;
        font-weight: 800;
        line-height: 1.3;
        margin: 0 0 20px 0;
        color: #ffffff !important;
        background: transparent !important;
        background-color: transparent !important;
        background-image: none !important;
        padding: 0 !important;
        box-shadow: none !important;
        text-shadow: 0 2px 4px rgba(0,0,0,0.15);
        border: none !important;
        position: relative;
        z-index: 1;
    }

    .berita-show-page .berita-meta {
        display: flex;
        align-items: center;
        gap: 20px;
        font-size: 14px;
        color: rgba(255,255,255,0.95) !important;
        background: transparent !important;
        padding: 0 !important;
        margin: 0 !important;
        position: relative;
        z-index: 1;
    }

    .berita-show-page .berita-meta-item {
        display: flex;
        align-items: center;
        gap: 6px;
        color: rgba(255,255,255,0.95) !important;
    }

    /* =========================================
       5. THUMBNAIL & CONTENT
       ========================================= */
    .berita-show-page .berita-thumbnail {
        width: 100%;
        height: 400px;
        object-fit: cover;
        display: block;
        border-bottom: 1px solid var(--border-color);
    }

    .berita-show-page .berita-content-wrapper {
        padding: 50px 40px;
        animation: fadeInUp 0.6s ease-out 0.2s backwards;
    }

    .berita-show-page .berita-content {
        font-size: 16px;
        line-height: 1.9;
        color: var(--text-primary) !important;
    }

    .berita-show-page .berita-content p {
        margin-bottom: 24px;
        color: var(--text-primary) !important;
        background: transparent !important;
    }

    .berita-show-page .berita-content h1,
    .berita-show-page .berita-content h2,
    .berita-show-page .berita-content h3,
    .berita-show-page .berita-content h4 {
        color: var(--text-primary) !important;
        margin-top: 40px;
        margin-bottom: 20px;
        font-weight: 700;
        background: transparent !important;
        padding: 0 !important;
        border: none !important;
    }

    .berita-show-page .berita-content img {
        max-width: 100%;
        height: auto;
        border-radius: 12px;
        margin: 30px 0;
        box-shadow: var(--shadow-md);
        transition: var(--transition-smooth);
    }
    .berita-show-page .berita-content img:hover {
        transform: scale(1.02);
        box-shadow: var(--shadow-lg);
    }

    .berita-show-page .berita-content blockquote {
        border-left: 4px solid var(--accent-color);
        padding: 20px 30px;
        margin: 30px 0;
        background: var(--bg-tertiary);
        border-radius: 0 12px 12px 0;
        font-style: italic;
        color: var(--text-secondary);
    }

    .berita-show-page .berita-content a {
        color: var(--accent-color);
        text-decoration: underline;
        transition: var(--transition-smooth);
    }
    .berita-show-page .berita-content a:hover {
        color: var(--accent-hover);
    }

    /* =========================================
       6. FOOTER & SHARE
       ========================================= */
    .berita-show-page .berita-footer {
        padding: 40px;
        background: var(--bg-tertiary);
        border-top: 1px solid var(--border-color);
        text-align: center;
        animation: fadeInUp 0.6s ease-out 0.3s backwards;
    }

    .berita-show-page .share-text {
        font-size: 14px;
        color: var(--text-secondary);
        margin-bottom: 20px;
    }

    .berita-show-page .btn-share {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: linear-gradient(135deg, #25D366, #128C7E);
        color: white !important;
        padding: 14px 28px;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 700;
        font-size: 14px;
        transition: var(--transition-smooth);
        box-shadow: 0 4px 15px rgba(37, 211, 102, 0.3);
    }

    .berita-show-page .btn-share:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(37, 211, 102, 0.4);
    }
    .berita-show-page .btn-share:active {
        transform: translateY(0) scale(0.98);
    }

    /* =========================================
       7. DARK MODE OVERRIDES
       ========================================= */
    [data-theme="dark"] .berita-show-page .btn-share {
        background: linear-gradient(135deg, #25D366, #128C7E) !important;
        color: #ffffff !important;
        text-shadow: 0 1px 2px rgba(0,0,0,0.2) !important;
    }
    [data-theme="dark"] .berita-show-page .btn-share:hover {
        background: linear-gradient(135deg, #128C7E, #075E54) !important;
    }

    [data-theme="dark"] .berita-show-page .berita-card {
        background: #1E293B !important;
        border-color: #334155 !important;
    }

    [data-theme="dark"] .berita-show-page .berita-header {
        background: linear-gradient(135deg, #4C1D95, #312E81) !important;
    }

    [data-theme="dark"] .berita-show-page .berita-judul {
        color: #ffffff !important;
        text-shadow: 0 2px 4px rgba(0,0,0,0.3) !important;
    }

    [data-theme="dark"] .berita-show-page .berita-badge {
        background: rgba(255,255,255,0.15) !important;
        color: #ffffff !important;
        border-color: rgba(255,255,255,0.25) !important;
    }

    [data-theme="dark"] .berita-show-page .berita-meta,
    [data-theme="dark"] .berita-show-page .berita-meta-item {
        color: rgba(255,255,255,0.9) !important;
    }

    [data-theme="dark"] .berita-show-page .berita-content,
    [data-theme="dark"] .berita-show-page .berita-content p,
    [data-theme="dark"] .berita-show-page .berita-content h1,
    [data-theme="dark"] .berita-show-page .berita-content h2,
    [data-theme="dark"] .berita-show-page .berita-content h3 {
        color: #F1F5F9 !important;
    }

    [data-theme="dark"] .berita-show-page .berita-footer {
        background: #0F172A !important;
        border-color: #334155 !important;
    }

    [data-theme="dark"] .berita-show-page .share-text {
        color: #94A3B8 !important;
    }

    [data-theme="dark"] .berita-show-page .btn-kembali {
        background: #1E293B !important;
        color: #F1F5F9 !important;
        border-color: #475569 !important;
    }
    [data-theme="dark"] .berita-show-page .btn-kembali:hover {
        background: #334155 !important;
        border-color: var(--accent-color) !important;
        color: var(--accent-color) !important;
    }

    /* =========================================
       8. RESPONSIVE
       ========================================= */
    @media (max-width: 768px) {
        .berita-show-page {
            margin: 30px auto;
            padding: 0 15px;
        }
        .berita-show-page .berita-header {
            padding: 30px 20px;
        }
        .berita-show-page .berita-judul {
            font-size: 26px !important;
        }
        .berita-show-page .berita-content-wrapper {
            padding: 30px 20px;
        }
        .berita-show-page .berita-thumbnail {
            height: 250px;
        }
        .berita-show-page .berita-footer {
            padding: 30px 20px;
        }
        .berita-show-page .btn-share {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<div class="berita-show-page">
    
    {{-- Tombol Kembali --}}
    <a href="/berita" class="btn-kembali">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M19 12H5M12 19l-7-7 7-7"/>
        </svg>
        Kembali ke Daftar Berita
    </a>

    <article class="berita-card">
        {{-- Header dengan Gradient --}}
        <div class="berita-header">
            <span class="berita-badge">
                {{ ucfirst($post->kategori ?? 'Berita') }}
            </span>
            <h1 class="berita-judul">{{ $post->judul }}</h1>
            <div class="berita-meta">
                <div class="berita-meta-item">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                        <line x1="16" y1="2" x2="16" y2="6"></line>
                        <line x1="8" y1="2" x2="8" y2="6"></line>
                        <line x1="3" y1="10" x2="21" y2="10"></line>
                    </svg>
                    <span>{{ $post->created_at->format('d F Y') }}</span>
                </div>
            </div>
        </div>

        {{-- Thumbnail (Jika Ada) --}}
        @if($post->image && file_exists(public_path('storage/posts/' . $post->image)))
            <img src="{{ asset('storage/posts/' . $post->image) }}" 
                 alt="{{ $post->judul }}" 
                 class="berita-thumbnail">
        @endif

        {{-- Konten Berita --}}
        <div class="berita-content-wrapper">
            <div class="berita-content">
                {!! $post->konten !!}
            </div>
        </div>

        {{-- Footer dengan Share Button --}}
        <div class="berita-footer">
            <p class="share-text">Suka dengan berita ini? Bagikan ke teman-temanmu!</p>
            <a href="https://wa.me/?text={{ urlencode($post->judul . ' - ' . url()->current()) }}" 
               target="_blank" 
               rel="noopener noreferrer"
               class="btn-share">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                </svg>
                <span>Bagikan via WhatsApp</span>
            </a>
        </div>
    </article>
</div>

@endsection