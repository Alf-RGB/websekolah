@extends('layouts.app')

@section('title', 'Profil Sekolah - ' . ($data['nama_sekolah'] ?? 'SMK'))

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
        --accent-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --visi-gradient: linear-gradient(135deg, #10B981 0%, #059669 100%);
        --misi-gradient: linear-gradient(135deg, #3B82F6 0%, #2563EB 100%);
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

    @keyframes fadeInDown { from { opacity: 0; transform: translateY(-30px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes fadeInUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes slideIn { from { opacity: 0; transform: scale(0.96) translateY(20px); } to { opacity: 1; transform: scale(1) translateY(0); } }
    @keyframes pulse { 0%, 100% { transform: scale(1); } 50% { transform: scale(1.05); } }

    /* =========================================
       2. HERO SECTION
       ========================================= */
    .profil-hero {
        background: var(--accent-gradient);
        padding: 100px 20px 120px;
        text-align: center;
        margin-bottom: 0;
        position: relative;
        overflow: hidden;
    }
    .profil-hero::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        opacity: 0.3;
    }
    .profil-hero::after {
        content: '';
        position: absolute;
        bottom: 0; left: 0; right: 0;
        height: 150px;
        background: linear-gradient(to bottom, transparent, rgba(15, 23, 42, 0.8));
    }
    .profil-hero-content {
        position: relative;
        z-index: 1;
        max-width: 900px;
        margin: 0 auto;
    }
    .profil-hero h1 {
        font-size: 56px;
        font-weight: 900;
        color: white;
        margin: 0 0 20px 0;
        text-shadow: 0 4px 20px rgba(0,0,0,0.3);
        letter-spacing: -1.5px;
        animation: fadeInDown 0.8s ease-out;
    }
    .profil-hero p {
        font-size: 20px;
        color: rgba(255,255,255,0.95);
        margin: 0;
        line-height: 1.7;
        font-weight: 500;
        animation: fadeInUp 0.8s ease-out 0.2s backwards;
    }

    /* =========================================
       3. CONTAINER & SECTIONS
       ========================================= */
    .profil-container {
        max-width: 1200px;
        margin: -80px auto 60px;
        padding: 0 30px;
        position: relative;
        z-index: 2;
    }

    .profil-section {
        background: var(--bg-secondary);
        border-radius: 24px;
        padding: 40px 35px;
        margin-bottom: 40px;
        box-shadow: var(--shadow-lg);
        border: 1px solid var(--border-color);
        transition: var(--transition-smooth);
        position: relative;
        overflow: hidden;
        animation: slideIn 0.6s cubic-bezier(0.4, 0, 0.2, 1) backwards;
    }
    .profil-section:nth-child(1) { animation-delay: 0.1s; }
    .profil-section:nth-child(2) { animation-delay: 0.2s; }
    .profil-section:nth-child(3) { animation-delay: 0.3s; }

    .profil-section::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 5px;
        background: var(--accent-gradient);
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .profil-section:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-xl);
    }
    .profil-section:hover::before {
        transform: scaleX(1);
    }

    .section-header {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 35px;
        padding-bottom: 25px;
        border-bottom: 3px solid var(--border-color);
        position: relative;
    }
    .section-header::after {
        content: '';
        position: absolute;
        bottom: -3px; left: 50%;
        transform: translateX(-50%);
        width: 120px; height: 3px;
        background: var(--accent-gradient);
        border-radius: 3px;
    }
    .section-title-wrapper h2 {
        font-size: 32px;
        font-weight: 900;
        color: var(--text-primary);
        margin: 0;
        letter-spacing: -0.5px;
        text-align: center;
    }

    .section-content {
        color: var(--text-primary);
        line-height: 1.9;
        font-size: 16px;
        text-align: justify;
    }
    .section-content p { margin-bottom: 20px; }
    .section-content ul, .section-content ol { margin-bottom: 25px; padding-left: 30px; }
    .section-content li { margin-bottom: 12px; }
    .section-content h2, .section-content h3, .section-content h4 { 
        color: var(--text-primary); 
        margin-top: 30px; 
        margin-bottom: 18px; 
        font-weight: 800; 
    }
    .section-content img {
        max-width: 100%;
        height: auto;
        border-radius: 16px;
        margin: 30px 0;
        box-shadow: var(--shadow-lg);
        transition: var(--transition-smooth);
    }
    .section-content img:hover {
        transform: scale(1.02);
        box-shadow: var(--shadow-xl);
    }

    /* =========================================
       4. VISI MISI GRID
       ========================================= */
    .visi-misi-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 25px;
        margin-top: 30px;
        width: 100%;
    }

    .visi-box, .misi-box {
        padding: 35px 30px;
        border-radius: 20px;
        position: relative;
        overflow: hidden;
        box-shadow: var(--shadow-lg);
        transition: var(--transition-smooth);
        height: 100%;
        min-width: 0;
        color: white;
        display: flex;
        flex-direction: column;
    }
    .visi-box:hover, .misi-box:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 25px 50px rgba(0,0,0,0.25);
    }
    .visi-box { background: var(--visi-gradient); }
    .misi-box { background: var(--misi-gradient); }

    /* Subtle pattern overlay for boxes */
    .visi-box::before, .misi-box::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: url("data:image/svg+xml,%3Csvg width='20' height='20' viewBox='0 0 20 20' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23ffffff' fill-opacity='0.05' fill-rule='evenodd'%3E%3Ccircle cx='3' cy='3' r='3'/%3E%3Ccircle cx='13' cy='13' r='3'/%3E%3C/g%3E%3C/svg%3E");
        opacity: 0.5;
        transition: opacity 0.4s;
    }
    .visi-box:hover::before, .misi-box:hover::before { opacity: 0.8; }

    .box-header {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 25px;
        position: relative;
        z-index: 1;
    }
    .box-title {
        font-size: 26px;
        font-weight: 900;
        margin: 0;
        letter-spacing: 1.5px;
        text-align: center;
        text-shadow: 0 2px 4px rgba(0,0,0,0.2);
    }
    .box-content {
        position: relative;
        z-index: 1;
        line-height: 1.8;
        font-size: 15px;
        flex: 1;
    }
    .box-content ul { padding-left: 20px; margin: 0; }
    .box-content li { margin-bottom: 10px; }

    /* =========================================
       5. EMPTY STATE
       ========================================= */
    .empty-state {
        text-align: center;
        padding: 80px 40px;
        background: var(--bg-tertiary);
        border-radius: 20px;
        border: 3px dashed var(--border-color);
        animation: slideIn 0.6s ease-out;
    }
    .empty-icon {
        width: 100px;
        height: 100px;
        margin: 0 auto 30px;
        background: linear-gradient(135deg, var(--border-color) 0%, var(--text-muted) 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 50px;
        animation: pulse 2s ease-in-out infinite;
    }
    .empty-state h3 {
        color: var(--text-primary);
        font-size: 24px;
        font-weight: 800;
        margin-bottom: 15px;
    }
    .empty-state p {
        color: var(--text-secondary);
        font-size: 16px;
        margin: 0;
    }

    /* =========================================
       6. DARK MODE OVERRIDES
       ========================================= */
    [data-theme="dark"] .profil-section {
        background: var(--bg-secondary) !important;
        border-color: var(--border-color) !important;
    }
    [data-theme="dark"] .section-content,
    [data-theme="dark"] .section-content h2,
    [data-theme="dark"] .section-content h3,
    [data-theme="dark"] .section-content h4 {
        color: var(--text-primary) !important;
    }
    [data-theme="dark"] .section-header {
        border-color: var(--border-color) !important;
    }
    [data-theme="dark"] .section-title-wrapper h2 {
        color: var(--text-primary) !important;
    }
    [data-theme="dark"] .empty-state {
        background: var(--bg-tertiary) !important;
        border-color: var(--border-color) !important;
    }
    [data-theme="dark"] .empty-state h3 {
        color: var(--text-primary) !important;
    }
    [data-theme="dark"] .empty-state p {
        color: var(--text-secondary) !important;
    }

    /* =========================================
       7. RESPONSIVE
       ========================================= */
    @media (max-width: 992px) {
        .visi-misi-grid { grid-template-columns: 1fr; }
    }
    @media (max-width: 768px) {
        .profil-hero { padding: 60px 20px 80px; }
        .profil-hero h1 { font-size: 36px; }
        .profil-hero p { font-size: 16px; }
        .profil-container { margin: -60px auto 40px; padding: 0 15px; }
        .profil-section { padding: 30px 20px; border-radius: 20px; }
        .section-header { flex-direction: column; gap: 15px; }
        .section-title-wrapper h2 { font-size: 26px; }
        .visi-box, .misi-box { padding: 30px 20px; }
        .box-title { font-size: 24px; }
    }
    @media (max-width: 480px) {
        .profil-hero h1 { font-size: 28px; }
        .section-title-wrapper h2 { font-size: 22px; }
    }
</style>

{{-- HERO SECTION --}}
<div class="profil-hero">
    <div class="profil-hero-content">
        <h1>Profil Sekolah</h1>
        <p>Mengenal lebih dekat {{ $data['nama_sekolah'] ?? 'SMK Multi Karya Medan' }} - Sekolah unggulan yang mencetak generasi berkualitas, berkarakter, dan siap bersaing di era global.</p>
    </div>
</div>

<div class="profil-container">

    {{-- SECTION 1: SAMBUTAN KEPALA SEKOLAH --}}
    @if(isset($sambutan) && $sambutan)
    <div class="profil-section">
        <div class="section-header">
            <div class="section-title-wrapper">
                <h2>{{ $sambutan->judul ?? 'Sambutan Kepala Sekolah' }}</h2>
            </div>
        </div>
        <div class="section-content">
            {!! $sambutan->konten ?? '' !!}
        </div>
    </div>
    @endif

    {{-- SECTION 2: VISI & MISI --}}
    @if(isset($visiMisi) && $visiMisi)
    <div class="profil-section">
        <div class="section-header">
            <div class="section-title-wrapper">
                <h2>{{ $visiMisi->judul ?? 'Visi & Misi' }}</h2>
            </div>
        </div>
        
        @php
            $konten = $visiMisi->konten ?? '';
            $visiText = '';
            $misiText = '';
            
            if (preg_match('/(misi)/i', $konten)) {
                $parts = preg_split('/(<[^>]*>)?\s*(misi)\s*(<\/[^>]*>)?\s*[:\-]*/i', $konten, 2, PREG_SPLIT_DELIM_CAPTURE);
                if (count($parts) >= 2) {
                    $visiText = trim(preg_replace('/^\s*(visi)\s*[:\-]*/i', '', $parts[0]));
                    $misiText = trim(end($parts));
                } else {
                    $visiText = $konten;
                }
            } else {
                $visiText = $konten;
            }
        @endphp

        <div class="visi-misi-grid">
            <div class="visi-box">
                <div class="box-header">
                    <h3 class="box-title">VISI</h3>
                </div>
                <div class="box-content">
                    {!! $visiText ?: '<p>Belum ada data Visi.</p>' !!}
                </div>
            </div>

            <div class="misi-box">
                <div class="box-header">
                    <h3 class="box-title">MISI</h3>
                </div>
                <div class="box-content">
                    {!! $misiText ?: '<p>Belum ada data Misi.</p>' !!}
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- SECTION 3: SEJARAH SEKOLAH --}}
    @if(isset($sejarah) && $sejarah)
    <div class="profil-section">
        <div class="section-header">
            <div class="section-title-wrapper">
                <h2>{{ $sejarah->judul ?? 'Sejarah Sekolah' }}</h2>
            </div>
        </div>
        <div class="section-content">
            {!! $sejarah->konten ?? '' !!}
        </div>
    </div>
    @endif

    {{-- EMPTY STATE --}}
    @if((!isset($sambutan) || !$sambutan) && (!isset($visiMisi) || !$visiMisi) && (!isset($sejarah) || !$sejarah))
    <div class="profil-section">
        <div class="empty-state">
            <div class="empty-icon">📁</div>
            <h3>Belum Ada Informasi Profil</h3>
            <p>Informasi profil sekolah akan segera ditampilkan oleh admin.</p>
        </div>
    </div>
    @endif

</div>

@endsection