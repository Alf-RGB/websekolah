@extends('layouts.app')

@section('title', $gallery->judul . ' - Galeri Foto')

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
        --accent-color: #7C3AED;
        --accent-hover: #6D28D9;
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
    .galeri-detail-wrapper {
        max-width: 1000px;
        margin: 40px auto;
        padding: 0 20px;
        animation: fadeInUp 0.6s ease-out;
    }

    /* =========================================
       3. BACK BUTTON
       ========================================= */
    .btn-kembali-galeri {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: var(--bg-secondary);
        color: var(--text-secondary);
        padding: 10px 20px;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 600;
        font-size: 14px;
        border: 1px solid var(--border-color);
        transition: var(--transition-smooth);
        margin-bottom: 25px;
        box-shadow: var(--shadow-sm);
        animation: fadeInDown 0.6s ease-out;
    }

    .btn-kembali-galeri:hover {
        color: var(--accent-color);
        border-color: var(--accent-color);
        background: rgba(124, 58, 237, 0.05);
        transform: translateX(-5px);
        box-shadow: var(--shadow-md);
    }
    .btn-kembali-galeri:active {
        transform: translateX(-5px) scale(0.98);
    }
    .btn-kembali-galeri svg {
        width: 18px;
        height: 18px;
        transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .btn-kembali-galeri:hover svg {
        transform: translateX(-3px);
    }

    /* =========================================
       4. MAIN IMAGE CONTAINER
       ========================================= */
    .galeri-image-container {
        background: var(--bg-secondary);
        border-radius: 24px;
        overflow: hidden;
        box-shadow: var(--shadow-lg);
        border: 1px solid var(--border-color);
        margin-bottom: 30px;
        position: relative;
        animation: slideIn 0.6s cubic-bezier(0.4, 0, 0.2, 1) 0.1s backwards;
    }

    .galeri-image {
        width: 100%;
        height: auto;
        max-height: 600px;
        object-fit: cover;
        display: block;
        transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .galeri-image-container:hover .galeri-image {
        transform: scale(1.03);
    }

    .galeri-image-placeholder {
        width: 100%;
        height: 400px;
        background: linear-gradient(135deg, var(--accent-color) 0%, var(--accent-hover) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
    }
    .galeri-image-placeholder svg {
        width: 80px;
        height: 80px;
        opacity: 0.8;
    }

    /* =========================================
       5. INFO CARD
       ========================================= */
    .galeri-info-card {
        background: var(--bg-secondary);
        border-radius: 24px;
        padding: 40px;
        box-shadow: var(--shadow-md);
        border: 1px solid var(--border-color);
        animation: slideIn 0.6s cubic-bezier(0.4, 0, 0.2, 1) 0.2s backwards;
    }

    .galeri-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 16px;
        background: rgba(124, 58, 237, 0.1);
        color: var(--accent-color);
        border: 1px solid rgba(124, 58, 237, 0.2);
        border-radius: 50px;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 16px;
        transition: var(--transition-smooth);
    }
    .galeri-info-card:hover .galeri-badge {
        background: var(--accent-color);
        color: white;
        border-color: var(--accent-color);
    }
    .galeri-badge svg {
        width: 14px;
        height: 14px;
    }

    .galeri-title {
        font-size: 36px;
        font-weight: 800;
        color: var(--text-primary);
        margin: 0 0 20px 0;
        letter-spacing: -0.5px;
        line-height: 1.2;
    }

    .galeri-meta {
        display: flex;
        align-items: center;
        gap: 12px;
        color: var(--text-secondary);
        font-size: 14px;
        padding-bottom: 24px;
        border-bottom: 2px solid var(--border-color);
        margin-bottom: 28px;
        flex-wrap: wrap;
    }

    .galeri-meta-item {
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .galeri-meta-item svg {
        width: 16px;
        height: 16px;
        color: var(--text-muted);
    }

    .galeri-description {
        color: var(--text-primary);
        line-height: 1.8;
        font-size: 16px;
    }
    .galeri-description p {
        margin-bottom: 16px;
    }
    .galeri-description p:last-child {
        margin-bottom: 0;
    }

    /* =========================================
       6. SHARE SECTION
       ========================================= */
    .share-section {
        margin-top: 40px;
        padding-top: 30px;
        border-top: 2px solid var(--border-color);
        text-align: center;
        animation: fadeInUp 0.6s ease-out 0.3s backwards;
    }

    .share-text {
        color: var(--text-secondary);
        font-size: 14px;
        margin-bottom: 16px;
        font-weight: 500;
    }

    .btn-share {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: linear-gradient(135deg, #25D366 0%, #128C7E 100%);
        color: white !important;
        padding: 14px 28px;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 700;
        font-size: 15px;
        transition: var(--transition-smooth);
        box-shadow: 0 4px 15px rgba(37, 211, 102, 0.3);
        border: none;
    }

    .btn-share:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(37, 211, 102, 0.4);
        background: linear-gradient(135deg, #128C7E 0%, #075E54 100%);
    }
    .btn-share:active {
        transform: translateY(0) scale(0.98);
    }
    .btn-share svg {
        width: 20px;
        height: 20px;
    }

    /* =========================================
       7. DARK MODE OVERRIDES
       ========================================= */
    [data-theme="dark"] .btn-kembali-galeri {
        background: var(--bg-secondary) !important;
        color: var(--text-secondary) !important;
        border-color: var(--border-color) !important;
    }
    [data-theme="dark"] .btn-kembali-galeri:hover {
        color: #A78BFA !important;
        border-color: var(--accent-color) !important;
        background: rgba(124, 58, 237, 0.1) !important;
    }

    [data-theme="dark"] .galeri-image-container,
    [data-theme="dark"] .galeri-info-card {
        background: var(--bg-secondary) !important;
        border-color: var(--border-color) !important;
    }

    [data-theme="dark"] .galeri-title {
        color: var(--text-primary) !important;
    }

    [data-theme="dark"] .galeri-description {
        color: var(--text-secondary) !important;
    }

    [data-theme="dark"] .galeri-meta {
        color: var(--text-muted) !important;
        border-color: var(--border-color) !important;
    }

    [data-theme="dark"] .share-section {
        border-color: var(--border-color) !important;
    }

    [data-theme="dark"] .share-text {
        color: var(--text-muted) !important;
    }

    /* =========================================
       8. RESPONSIVE
       ========================================= */
    @media (max-width: 768px) {
        .galeri-detail-wrapper {
            margin: 20px auto;
            padding: 0 16px;
        }
        .galeri-image {
            max-height: 300px;
        }
        .galeri-image-placeholder {
            height: 250px;
        }
        .galeri-info-card {
            padding: 24px 20px;
            border-radius: 20px;
        }
        .galeri-title {
            font-size: 26px;
        }
        .galeri-description {
            font-size: 15px;
        }
        .btn-share {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<div class="galeri-detail-wrapper">

    {{-- Tombol Kembali --}}
    <a href="{{ url()->previous() ?? '/galeri' }}" class="btn-kembali-galeri">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        Kembali ke Galeri
    </a>

    {{-- Gambar Utama --}}
    <div class="galeri-image-container">
        @if($gallery->gambar)
            <img src="{{ asset('storage/' . $gallery->gambar) }}" 
                 alt="{{ $gallery->judul }}" 
                 class="galeri-image"
                 loading="lazy"
                 onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
            
            {{-- Fallback jika gambar error --}}
            <div class="galeri-image-placeholder" style="display: none;">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
        @else
            <div class="galeri-image-placeholder">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
        @endif
    </div>

    {{-- Info Card --}}
    <div class="galeri-info-card">
        {{-- Badge Kategori --}}
        @if($gallery->kategori)
            <span class="galeri-badge">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                </svg>
                {{ ucfirst($gallery->kategori) }}
            </span>
        @endif

        {{-- Judul --}}
        <h1 class="galeri-title">{{ $gallery->judul }}</h1>

        {{-- Meta Info --}}
        <div class="galeri-meta">
            <div class="galeri-meta-item">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <span>{{ $gallery->created_at ? $gallery->created_at->format('d F Y') : 'Tanggal tidak tersedia' }}</span>
            </div>
        </div>

        {{-- Deskripsi --}}
        @if($gallery->deskripsi)
            <div class="galeri-description">
                {!! nl2br(e($gallery->deskripsi)) !!}
            </div>
        @else
            <div class="galeri-description" style="color: var(--text-muted); font-style: italic;">
                Tidak ada deskripsi untuk foto ini.
            </div>
        @endif

        {{-- Share Section --}}
        <div class="share-section">
            <p class="share-text">Suka dengan foto ini? Bagikan ke teman-temanmu!</p>
            <a href="https://wa.me/?text={{ urlencode('Lihat foto ini: ' . $gallery->judul . ' - ' . url()->current()) }}" 
               target="_blank" 
               rel="noopener noreferrer"
               class="btn-share">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                </svg>
                <span>Bagikan via WhatsApp</span>
            </a>
        </div>
    </div>

</div>

@endsection