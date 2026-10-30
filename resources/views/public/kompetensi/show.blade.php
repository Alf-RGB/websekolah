@extends('layouts.app')

@section('title', $kompetensi->nama_jurusan . ' - Kompetensi Keahlian')

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
        --primary-color: #1D3557;
        --primary-hover: #457B9D;
        --accent-color: #A8DADC;
        --success-color: #10B981;
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
    @keyframes slideIn { from { opacity: 0; transform: scale(0.96) translateY(20px); } to { opacity: 1; transform: scale(1) translateY(0); } }

    /* =========================================
       2. WRAPPER & LAYOUT
       ========================================= */
    .jurusan-detail-wrapper { 
        max-width: 900px; 
        margin: 40px auto; 
        padding: 0 20px; 
        animation: fadeInUp 0.6s ease-out;
    }

    /* =========================================
       3. BACK BUTTON
       ========================================= */
    .btn-back {
        color: var(--primary-hover);
        font-weight: 600;
        font-size: 14px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        margin-bottom: 25px;
        text-decoration: none;
        transition: var(--transition-smooth);
        animation: fadeInDown 0.6s ease-out;
    }
    .btn-back:hover {
        color: var(--primary-color);
        gap: 10px;
        transform: translateX(-4px);
    }

    /* =========================================
       4. CARDS
       ========================================= */
    .detail-card {
        background: var(--bg-secondary);
        padding: 40px;
        border-radius: 20px;
        box-shadow: var(--shadow-md);
        margin-bottom: 30px;
        border: 1px solid var(--border-color);
        transition: var(--transition-smooth);
    }
    .detail-card:hover {
        box-shadow: var(--shadow-lg);
    }

    .header-card {
        display: flex;
        flex-wrap: wrap;
        gap: 30px;
        align-items: center;
        animation: slideIn 0.6s cubic-bezier(0.4, 0, 0.2, 1) 0.1s backwards;
    }
    .header-card:hover .jurusan-icon-wrapper {
        transform: scale(1.05) rotate(-3deg);
    }

    .jurusan-icon-wrapper {
        width: 120px;
        height: 120px;
        border-radius: 16px;
        background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 48px;
        color: white;
        font-weight: 700;
        flex-shrink: 0;
        box-shadow: var(--shadow-md);
        transition: var(--transition-smooth);
        overflow: hidden;
    }
    .jurusan-icon-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .header-info { flex: 1; min-width: 250px; }
    
    .jurusan-badge {
        background: var(--accent-color);
        color: var(--primary-color);
        padding: 6px 16px;
        border-radius: 50px;
        font-size: 12px;
        font-weight: 700;
        display: inline-block;
        margin-bottom: 10px;
        letter-spacing: 0.5px;
        transition: var(--transition-smooth);
    }
    .header-card:hover .jurusan-badge {
        background: var(--primary-color);
        color: white;
    }

    .jurusan-title {
        color: var(--text-primary);
        font-size: 28px;
        margin: 0;
        line-height: 1.3;
        font-weight: 800;
    }
    .jurusan-subtitle {
        color: var(--text-secondary);
        font-size: 15px;
        margin-top: 10px;
    }

    /* Section Titles */
    .section-title {
        color: var(--text-primary);
        font-size: 20px;
        margin-bottom: 20px;
        border-left: 4px solid var(--primary-hover);
        padding-left: 15px;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .section-title.green { border-left-color: var(--success-color); }

    .content-text {
        color: var(--text-primary);
        line-height: 1.8;
        font-size: 15px;
    }

    /* CTA Card */
    .cta-card {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-hover) 100%);
        padding: 50px 40px;
        border-radius: 20px;
        text-align: center;
        color: white;
        box-shadow: 0 10px 30px rgba(29, 53, 87, 0.2);
        position: relative;
        overflow: hidden;
        animation: slideIn 0.6s cubic-bezier(0.4, 0, 0.2, 1) 0.3s backwards;
    }
    .cta-card::before {
        content: '';
        position: absolute;
        right: -30px;
        top: -30px;
        width: 150px;
        height: 150px;
        background: rgba(255,255,255,0.1);
        border-radius: 50%;
        transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .cta-card::after {
        content: '';
        position: absolute;
        left: -20px;
        bottom: -20px;
        width: 100px;
        height: 100px;
        background: rgba(255,255,255,0.05);
        border-radius: 50%;
        transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .cta-card:hover::before { transform: scale(1.2) translate(-20px, 20px); }
    .cta-card:hover::after { transform: scale(1.2) translate(20px, -20px); }

    .cta-content { position: relative; z-index: 2; }
    .cta-title { font-size: 26px; margin-bottom: 15px; font-weight: 800; }
    .cta-desc { opacity: 0.95; margin-bottom: 30px; font-size: 16px; line-height: 1.6; max-width: 600px; margin-left: auto; margin-right: auto; }

    .btn-cta {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: white;
        color: var(--primary-color);
        padding: 16px 40px;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 700;
        font-size: 16px;
        transition: var(--transition-smooth);
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    .btn-cta:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        color: var(--primary-hover);
    }
    .btn-cta:active { transform: translateY(0) scale(0.98); }

    /* =========================================
       5. DARK MODE OVERRIDES
       ========================================= */
    [data-theme="dark"] .detail-card { background: var(--bg-secondary); border-color: var(--border-color); }
    [data-theme="dark"] .jurusan-icon-wrapper { box-shadow: 0 4px 15px rgba(0,0,0,0.3); }
    [data-theme="dark"] .cta-card { box-shadow: 0 10px 30px rgba(0,0,0,0.4); }

    /* =========================================
       6. RESPONSIVE
       ========================================= */
    @media (max-width: 768px) {
        .jurusan-detail-wrapper { margin: 20px auto; padding: 0 15px; }
        .detail-card { padding: 25px 20px; }
        .header-card { flex-direction: column; text-align: center; }
        .header-info { min-width: 100%; }
        .jurusan-title { font-size: 24px; }
        .cta-card { padding: 40px 20px; }
        .cta-title { font-size: 22px; }
        .btn-cta { width: 100%; justify-content: center; }
    }
</style>

<div class="jurusan-detail-wrapper">
    {{-- Tombol Kembali --}}
    <a href="/portal-akademik/jurusan" class="btn-back">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M19 12H5M12 19l-7-7 7-7"/>
        </svg>
        Kembali ke Daftar Jurusan
    </a>

    {{-- Header Jurusan --}}
    <div class="detail-card header-card">
        @php
            $iconExists = $kompetensi->icon && file_exists(storage_path('app/public/kompetensi/' . $kompetensi->icon));
        @endphp

        <div class="jurusan-icon-wrapper">
            @if($iconExists)
                <img src="{{ asset('storage/kompetensi/' . $kompetensi->icon) }}" alt="Icon {{ $kompetensi->nama_jurusan }}" loading="lazy">
            @else
                {{ strtoupper(substr($kompetensi->nama_jurusan, 0, 2)) }}
            @endif
        </div>
        
        <div class="header-info">
            @if($kompetensi->singkatan)
                <span class="jurusan-badge">
                    {{ strtoupper($kompetensi->singkatan) }}
                </span>
            @endif
            <h1 class="jurusan-title">{{ $kompetensi->nama_jurusan }}</h1>
            <p class="jurusan-subtitle">Kompetensi Keahlian Unggulan</p>
        </div>
    </div>

    {{-- Deskripsi --}}
    @if($kompetensi->deskripsi)
        <div class="detail-card" style="animation: fadeInUp 0.6s ease-out 0.15s backwards;">
            <h2 class="section-title">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path></svg>
                Tentang Jurusan
            </h2>
            <div class="content-text">
                {!! nl2br(e($kompetensi->deskripsi)) !!}
            </div>
        </div>
    @endif

    {{-- Prospek Karir --}}
    @if($kompetensi->prospek_karir)
        <div class="detail-card" style="animation: fadeInUp 0.6s ease-out 0.2s backwards;">
            <h2 class="section-title green">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg>
                Prospek Karir
            </h2>
            <div class="content-text">
                {!! nl2br(e($kompetensi->prospek_karir)) !!}
            </div>
        </div>
    @endif

    {{-- CTA PPDB --}}
    <div class="cta-card">
        <div class="cta-content">
            <h2 class="cta-title">Tertarik dengan jurusan ini? 🎓</h2>
            <p class="cta-desc">
                Daftarkan dirimu sekarang dan raih masa depan cerah bersama kami! Kuota terbatas, jangan sampai ketinggalan.
            </p>
            <a href="/ppdb" class="btn-cta">
                🚀 Daftar PPDB Sekarang
            </a>
        </div>
    </div>
</div>

@endsection