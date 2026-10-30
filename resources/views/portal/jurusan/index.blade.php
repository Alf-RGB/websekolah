@extends('layouts.app')

@section('title', 'Kompetensi Keahlian - SMK Multi Karya Medan')

@section('content')

<style>
    /* =========================================
       1. ANIMATIONS - SMOOTH & PROFESSIONAL
       ========================================= */
    @keyframes fadeInDown {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes slideIn {
        from { opacity: 0; transform: scale(0.96) translateY(20px); }
        to { opacity: 1; transform: scale(1) translateY(0); }
    }
    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }

    /* =========================================
       2. WRAPPER & HEADER
       ========================================= */
    .jurusan-list-wrapper {
        max-width: 1200px;
        margin: 40px auto;
        padding: 0 20px;
        animation: fadeInUp 0.6s ease-out;
    }
    
    .page-header {
        text-align: center;
        margin-bottom: 50px;
        animation: fadeInDown 0.6s ease-out;
    }
    .page-header h1 {
        font-size: 36px;
        font-weight: 800;
        color: var(--text-primary, #1E293B);
        margin: 0 0 15px 0;
        letter-spacing: -0.5px;
    }
    .page-header p {
        font-size: 16px;
        color: var(--text-secondary, #64748B);
        max-width: 600px;
        margin: 0 auto;
        line-height: 1.6;
    }

    /* =========================================
       3. JURUSAN GRID & CARDS
       ========================================= */
    .jurusan-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 28px;
        margin-bottom: 40px;
    }

    .jurusan-card {
        background: var(--card-bg, white);
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        border: 1px solid var(--border-color, #E2E8F0);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        cursor: pointer;
        animation: slideIn 0.6s cubic-bezier(0.4, 0, 0.2, 1) backwards;
        display: flex;
        flex-direction: column;
    }
    
    /* Staggered Animation Delays */
    .jurusan-card:nth-child(1) { animation-delay: 0.1s; }
    .jurusan-card:nth-child(2) { animation-delay: 0.2s; }
    .jurusan-card:nth-child(3) { animation-delay: 0.3s; }
    .jurusan-card:nth-child(4) { animation-delay: 0.4s; }
    .jurusan-card:nth-child(5) { animation-delay: 0.5s; }
    .jurusan-card:nth-child(6) { animation-delay: 0.6s; }

    .jurusan-card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 20px 40px rgba(0,0,0,0.12);
        border-color: #667eea;
    }

    .jurusan-card-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 35px 30px;
        text-align: center;
        position: relative;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .jurusan-card-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 200px;
        height: 200px;
        background: rgba(255,255,255,0.1);
        border-radius: 50%;
        transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .jurusan-card-header::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -10%;
        width: 150px;
        height: 150px;
        background: rgba(255,255,255,0.05);
        border-radius: 50%;
        transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .jurusan-card:hover .jurusan-card-header::before { transform: scale(1.2) translate(-20px, 20px); }
    .jurusan-card:hover .jurusan-card-header::after { transform: scale(1.2) translate(20px, -20px); }

    .jurusan-card-header img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 16px;
        margin-bottom: 15px;
        border: 4px solid rgba(255,255,255,0.3);
        position: relative;
        z-index: 1;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }
    
    .jurusan-card:hover .jurusan-card-header img {
        transform: scale(1.1) rotate(-3deg);
        border-color: rgba(255,255,255,0.6);
    }

    .jurusan-card-header h3 {
        font-size: 22px;
        font-weight: 700;
        color: white;
        margin: 0 0 10px 0;
        position: relative;
        z-index: 1;
        transition: transform 0.3s;
    }
    .jurusan-card:hover .jurusan-card-header h3 { transform: translateY(-2px); }

    .jurusan-card-header .badge {
        background: rgba(255,255,255,0.2);
        backdrop-filter: blur(10px);
        padding: 6px 16px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
        display: inline-block;
        color: white;
        position: relative;
        z-index: 1;
        border: 1px solid rgba(255,255,255,0.3);
        transition: all 0.3s;
    }
    .jurusan-card:hover .jurusan-card-header .badge {
        background: rgba(255,255,255,0.3);
        transform: scale(1.05);
    }

    .jurusan-card-body {
        padding: 25px;
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    .jurusan-card-body p {
        font-size: 14px;
        color: var(--text-secondary, #64748B);
        line-height: 1.7;
        margin: 0 0 24px 0;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        transition: color 0.3s;
    }
    .jurusan-card:hover .jurusan-card-body p { color: var(--text-primary, #1E293B); }

    .btn-detail {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white !important;
        padding: 12px 24px;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 700;
        font-size: 14px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
        width: 100%;
    }
    .btn-detail svg {
        transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .btn-detail:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
    }
    .btn-detail:hover svg {
        transform: translateX(4px);
    }
    .btn-detail:active {
        transform: translateY(-1px) scale(0.98);
    }

    /* =========================================
       4. EMPTY STATE
       ========================================= */
    .empty-state {
        text-align: center;
        padding: 80px 20px;
        animation: fadeInUp 0.6s ease-out;
    }
    .empty-state svg {
        width: 80px;
        height: 80px;
        color: var(--text-secondary, #94A3B8);
        margin-bottom: 20px;
        animation: float 3s ease-in-out infinite;
    }
    .empty-state h3 {
        font-size: 24px;
        font-weight: 700;
        color: var(--text-primary, #1E293B);
        margin: 0 0 10px 0;
    }
    .empty-state p {
        font-size: 15px;
        color: var(--text-secondary, #64748B);
        margin: 0;
    }

    /* =========================================
       5. DARK MODE OVERRIDES
       ========================================= */
    [data-theme="dark"] .page-header h1 { color: #F1F5F9 !important; }
    [data-theme="dark"] .page-header p { color: #94A3B8 !important; }
    [data-theme="dark"] .jurusan-card { 
        background: #1E293B !important; 
        border-color: #334155 !important; 
    }
    [data-theme="dark"] .jurusan-card:hover {
        border-color: #667eea !important;
        box-shadow: 0 20px 40px rgba(0,0,0,0.3) !important;
    }
    [data-theme="dark"] .jurusan-card-header { 
        background: linear-gradient(135deg, #4C1D95 0%, #5B21B6 100%) !important; 
    }
    [data-theme="dark"] .jurusan-card-body p { color: #94A3B8 !important; }
    [data-theme="dark"] .jurusan-card:hover .jurusan-card-body p { color: #F1F5F9 !important; }
    [data-theme="dark"] .empty-state h3 { color: #F1F5F9 !important; }

    /* =========================================
       6. RESPONSIVE DESIGN
       ========================================= */
    @media (max-width: 768px) {
        .jurusan-list-wrapper { margin: 20px auto; padding: 0 15px; }
        .jurusan-grid { grid-template-columns: 1fr; gap: 20px; }
        .page-header { margin-bottom: 30px; }
        .page-header h1 { font-size: 28px; }
        .jurusan-card-header { padding: 25px 20px; }
        .jurusan-card-header img { width: 60px; height: 60px; }
        .jurusan-card-header h3 { font-size: 20px; }
        .jurusan-card-body { padding: 20px; }
    }
</style>

<div class="jurusan-list-wrapper">
    
    <div class="page-header">
        <h1>Kompetensi Keahlian</h1>
        <p>Pilih jurusan yang sesuai dengan minat dan bakat Anda untuk masa depan yang lebih cerah</p>
    </div>

    @if($kompetensis->count() > 0)
        <div class="jurusan-grid">
            @foreach($kompetensis as $kompetensi)
            <div class="jurusan-card" onclick="window.location.href='{{ route('portal.jurusan.show', $kompetensi->slug) }}'">
                <div class="jurusan-card-header">
                    @if($kompetensi->icon)
                        <img src="{{ asset('storage/' . $kompetensi->icon) }}" alt="{{ $kompetensi->nama_jurusan }}" loading="lazy">
                    @endif
                    <h3>{{ $kompetensi->nama_jurusan }}</h3>
                    @if($kompetensi->singkatan)
                        <span class="badge">{{ $kompetensi->singkatan }}</span>
                    @endif
                </div>
                <div class="jurusan-card-body">
                    @if($kompetensi->deskripsi)
                    <p>{{ Str::limit($kompetensi->deskripsi, 120) }}</p>
                    @endif
                    <a href="{{ route('portal.jurusan.show', $kompetensi->slug) }}" class="btn-detail" onclick="event.stopPropagation();">
                        Selengkapnya
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    @else
        <div class="empty-state">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
            </svg>
            <h3>Belum Ada Kompetensi Keahlian</h3>
            <p>Silakan hubungi admin untuk informasi lebih lanjut</p>
        </div>
    @endif

</div>

@endsection