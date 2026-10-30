@extends('layouts.app')

@section('title', $kompetensi->nama . ' - Kompetensi Keahlian')

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
       2. WRAPPER & BACK BUTTON
       ========================================= */
    .jurusan-detail-wrapper { 
        max-width: 900px; 
        margin: 40px auto; 
        padding: 0 20px; 
        animation: fadeInUp 0.6s ease-out;
    }

    .btn-kembali {
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
    .btn-kembali:hover {
        color: var(--primary-color);
        gap: 10px;
        transform: translateX(-4px);
    }

    /* =========================================
       3. MAIN DETAIL CARD
       ========================================= */
    .main-detail-card {
        background: var(--bg-secondary);
        padding: 40px;
        border-radius: 24px;
        box-shadow: var(--shadow-lg);
        border: 1px solid var(--border-color);
        margin-bottom: 30px;
        transition: var(--transition-smooth);
        position: relative;
        overflow: hidden;
        animation: slideIn 0.6s cubic-bezier(0.4, 0, 0.2, 1) 0.1s backwards;
    }
    .main-detail-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--primary-color), var(--primary-hover));
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .main-detail-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-xl);
    }
    .main-detail-card:hover::before {
        transform: scaleX(1);
    }

    .jurusan-icon-large {
        font-size: 60px;
        margin-bottom: 15px;
        display: inline-block;
        transition: var(--transition-smooth);
    }
    .main-detail-card:hover .jurusan-icon-large {
        transform: scale(1.1) rotate(-5deg);
    }

    .jurusan-title {
        color: var(--text-primary);
        font-size: 32px;
        margin-bottom: 15px;
        font-weight: 800;
        letter-spacing: -0.5px;
    }

    .jurusan-description {
        color: var(--text-primary);
        line-height: 1.8;
        font-size: 16px;
        margin-bottom: 30px;
    }

    /* =========================================
       4. INFO BOXES (VISI, MISI, ETC.)
       ========================================= */
    .info-box {
        padding: 25px;
        border-radius: 16px;
        margin-bottom: 20px;
        border-left: 4px solid;
        transition: var(--transition-smooth);
        animation: fadeInUp 0.5s ease-out backwards;
    }
    .info-box:hover {
        transform: translateX(5px);
    }
    .info-box h3 {
        font-size: 18px;
        margin: 0 0 10px 0;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .info-box-content {
        color: var(--text-primary);
        line-height: 1.7;
    }

    /* Color Variants */
    .info-box.visi {
        background: rgba(59, 130, 246, 0.08);
        border-color: #3B82F6;
        animation-delay: 0.15s;
    }
    .info-box.visi h3 { color: #1D4ED8; }
    [data-theme="dark"] .info-box.visi { background: rgba(59, 130, 246, 0.15); }
    [data-theme="dark"] .info-box.visi h3 { color: #93C5FD; }

    .info-box.misi {
        background: rgba(34, 197, 94, 0.08);
        border-color: #22C55E;
        animation-delay: 0.2s;
    }
    .info-box.misi h3 { color: #166534; }
    [data-theme="dark"] .info-box.misi { background: rgba(34, 197, 94, 0.15); }
    [data-theme="dark"] .info-box.misi h3 { color: #86EFAC; }

    .info-box.mapel {
        background: rgba(245, 158, 11, 0.08);
        border-color: #F59E0B;
        animation-delay: 0.25s;
    }
    .info-box.mapel h3 { color: #92400E; }
    [data-theme="dark"] .info-box.mapel { background: rgba(245, 158, 11, 0.15); }
    [data-theme="dark"] .info-box.mapel h3 { color: #FCD34D; }

    .info-box.prospek {
        background: rgba(236, 72, 153, 0.08);
        border-color: #EC4899;
        animation-delay: 0.3s;
    }
    .info-box.prospek h3 { color: #9D174D; }
    [data-theme="dark"] .info-box.prospek { background: rgba(236, 72, 153, 0.15); }
    [data-theme="dark"] .info-box.prospek h3 { color: #F9A8D4; }

    .info-box.fasilitas {
        background: rgba(139, 92, 246, 0.08);
        border-color: #8B5CF6;
        animation-delay: 0.35s;
    }
    .info-box.fasilitas h3 { color: #5B21B6; }
    [data-theme="dark"] .info-box.fasilitas { background: rgba(139, 92, 246, 0.15); }
    [data-theme="dark"] .info-box.fasilitas h3 { color: #C4B5FD; }

    /* =========================================
       5. OTHER JURUSAN SECTION
       ========================================= */
    .other-jurusan-section {
        margin-top: 50px;
        animation: fadeInUp 0.6s ease-out 0.4s backwards;
    }
    .section-title {
        color: var(--text-primary);
        font-size: 24px;
        margin-bottom: 25px;
        border-left: 5px solid var(--primary-hover);
        padding-left: 15px;
        font-weight: 700;
    }
    .other-jurusan-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 20px;
    }
    .other-jurusan-card {
        background: var(--bg-secondary);
        border-radius: 16px;
        padding: 25px;
        box-shadow: var(--shadow-md);
        border: 1px solid var(--border-color);
        text-decoration: none;
        color: inherit;
        display: block;
        transition: var(--transition-smooth);
    }
    .other-jurusan-card:hover {
        transform: translateY(-6px) scale(1.02);
        box-shadow: var(--shadow-xl);
        border-color: var(--primary-hover);
    }
    .other-jurusan-icon {
        font-size: 40px;
        margin-bottom: 10px;
        display: inline-block;
        transition: var(--transition-smooth);
    }
    .other-jurusan-card:hover .other-jurusan-icon {
        transform: scale(1.15) rotate(-5deg);
    }
    .other-jurusan-name {
        color: var(--text-primary);
        font-size: 16px;
        margin: 0;
        font-weight: 700;
    }

    /* =========================================
       6. DARK MODE GLOBAL OVERRIDES
       ========================================= */
    [data-theme="dark"] .main-detail-card {
        background: var(--bg-secondary) !important;
        border-color: var(--border-color) !important;
    }
    [data-theme="dark"] .jurusan-title,
    [data-theme="dark"] .jurusan-description,
    [data-theme="dark"] .info-box-content,
    [data-theme="dark"] .other-jurusan-name {
        color: var(--text-primary) !important;
    }
    [data-theme="dark"] .section-title {
        color: var(--text-primary) !important;
    }

    /* =========================================
       7. RESPONSIVE
       ========================================= */
    @media (max-width: 768px) {
        .jurusan-detail-wrapper { margin: 20px auto; padding: 0 15px; }
        .main-detail-card { padding: 25px 20px; }
        .jurusan-title { font-size: 26px; }
        .info-box { padding: 20px; }
        .other-jurusan-grid { grid-template-columns: 1fr; }
    }
</style>

<div class="jurusan-detail-wrapper">
    
    {{-- Tombol Kembali --}}
    <a href="/portal-akademik/jurusan" class="btn-kembali">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M19 12H5M12 19l-7-7 7-7"/>
        </svg>
        Kembali ke Daftar Jurusan
    </a>

    <div class="main-detail-card">
        <div class="jurusan-icon-large">{{ $kompetensi->icon ?? '🎓' }}</div>
        <h1 class="jurusan-title">{{ $kompetensi->nama }}</h1>
        
        @if($kompetensi->deskripsi)
            <div class="jurusan-description">
                {!! nl2br(e($kompetensi->deskripsi)) !!}
            </div>
        @endif

        @if($kompetensi->visi)
            <div class="info-box visi">
                <h3>🎯 Visi</h3>
                <div class="info-box-content">{!! nl2br(e($kompetensi->visi)) !!}</div>
            </div>
        @endif

        @if($kompetensi->misi)
            <div class="info-box misi">
                <h3>📌 Misi</h3>
                <div class="info-box-content">{!! nl2br(e($kompetensi->misi)) !!}</div>
            </div>
        @endif

        @if($kompetensi->mata_pelajaran)
            <div class="info-box mapel">
                <h3>📚 Mata Pelajaran Kejuruan</h3>
                <div class="info-box-content">{!! nl2br(e($kompetensi->mata_pelajaran)) !!}</div>
            </div>
        @endif

        @if($kompetensi->prospek_kerja)
            <div class="info-box prospek">
                <h3>💼 Prospek Kerja</h3>
                <div class="info-box-content">{!! nl2br(e($kompetensi->prospek_kerja)) !!}</div>
            </div>
        @endif

        @if($kompetensi->fasilitas)
            <div class="info-box fasilitas">
                <h3>🏫 Fasilitas</h3>
                <div class="info-box-content">{!! nl2br(e($kompetensi->fasilitas)) !!}</div>
            </div>
        @endif
    </div>

    {{-- Jurusan Lainnya --}}
    @if(isset($otherKompetensis) && $otherKompetensis->isNotEmpty())
        <div class="other-jurusan-section">
            <h2 class="section-title">Kompetensi Keahlian Lainnya</h2>
            <div class="other-jurusan-grid">
                @foreach($otherKompetensis as $other)
                    <a href="/portal-akademik/jurusan/{{ $other->slug }}" class="other-jurusan-card">
                        <div class="other-jurusan-icon">{{ $other->icon ?? '🎓' }}</div>
                        <h3 class="other-jurusan-name">{{ $other->nama }}</h3>
                    </a>
                @endforeach
            </div>
        </div>
    @endif

</div>

@endsection