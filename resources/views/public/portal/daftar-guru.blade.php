@extends('layouts.app')

@section('title', 'Tenaga Pendidik - Portal Akademik')

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
        --success-color: #10B981;
        --success-hover: #059669;
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
    @keyframes pulse { 0%, 100% { transform: scale(1); } 50% { transform: scale(1.05); } }

    /* =========================================
       2. WRAPPER & HEADER
       ========================================= */
    .guru-wrapper { 
        max-width: 1200px; 
        margin: 40px auto; 
        padding: 0 20px; 
        animation: fadeInUp 0.6s ease-out;
    }

    .portal-header { 
        text-align: center; 
        margin-bottom: 50px; 
        animation: fadeInDown 0.6s ease-out;
    }
    .portal-header h1 { 
        color: var(--text-primary); 
        font-size: 36px; 
        font-weight: 800; 
        margin-bottom: 12px; 
        letter-spacing: -0.5px;
    }
    .portal-header p { 
        color: var(--text-secondary); 
        font-size: 16px; 
        max-width: 600px; 
        margin: 0 auto; 
        line-height: 1.6; 
    }

    /* =========================================
       3. GURU GRID & CARDS
       ========================================= */
    .guru-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 25px;
    }

    .guru-card {
        background: var(--bg-secondary);
        border-radius: 20px;
        padding: 35px 25px;
        text-align: center;
        box-shadow: var(--shadow-md);
        border: 1px solid var(--border-color);
        transition: var(--transition-smooth);
        position: relative;
        overflow: hidden;
        animation: slideIn 0.6s cubic-bezier(0.4, 0, 0.2, 1) backwards;
    }

    /* Staggered Animation Delays */
    .guru-card:nth-child(1) { animation-delay: 0.1s; }
    .guru-card:nth-child(2) { animation-delay: 0.15s; }
    .guru-card:nth-child(3) { animation-delay: 0.2s; }
    .guru-card:nth-child(4) { animation-delay: 0.25s; }
    .guru-card:nth-child(5) { animation-delay: 0.3s; }
    .guru-card:nth-child(6) { animation-delay: 0.35s; }

    .guru-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--success-color) 0%, var(--success-hover) 100%);
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .guru-card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: var(--shadow-xl);
    }
    .guru-card:hover::before {
        transform: scaleX(1);
    }

    .guru-avatar {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--success-color) 0%, var(--success-hover) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 40px;
        font-weight: 800;
        margin: 0 auto 20px;
        border: 4px solid rgba(16, 185, 129, 0.2);
        box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3);
        overflow: hidden;
        transition: var(--transition-smooth);
    }
    .guru-card:hover .guru-avatar {
        transform: scale(1.1) rotate(-5deg);
        box-shadow: 0 12px 30px rgba(16, 185, 129, 0.4);
    }
    .guru-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .guru-name {
        color: var(--text-primary);
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 8px;
        line-height: 1.3;
        transition: color 0.3s;
    }
    .guru-card:hover .guru-name {
        color: var(--success-color);
    }

    .guru-subject {
        color: var(--text-secondary);
        font-size: 14px;
        margin-bottom: 25px;
    }

    /* =========================================
       4. BUTTONS
       ========================================= */
    .btn-lihat-profil {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        background: linear-gradient(135deg, var(--success-color) 0%, var(--success-hover) 100%);
        color: white;
        padding: 12px 24px;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 700;
        font-size: 14px;
        transition: var(--transition-smooth);
        border: 2px solid transparent;
        box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
        cursor: pointer;
        position: relative;
        overflow: hidden;
        width: 100%;
    }

    .btn-lihat-profil::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
        transition: left 0.6s;
    }

    .btn-lihat-profil:hover::before { left: 100%; }
    .btn-lihat-profil:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(16, 185, 129, 0.4);
    }
    .btn-lihat-profil:active {
        transform: translateY(0) scale(0.98);
    }
    .btn-lihat-profil svg {
        width: 16px;
        height: 16px;
    }

    /* =========================================
       5. EMPTY STATE
       ========================================= */
    .empty-state {
        text-align: center;
        padding: 80px 40px;
        background: var(--bg-secondary);
        border-radius: 20px;
        box-shadow: var(--shadow-md);
        border: 1px solid var(--border-color);
        animation: slideIn 0.6s ease-out;
    }
    .empty-icon {
        font-size: 80px;
        margin-bottom: 20px;
        display: inline-block;
        animation: pulse 2s ease-in-out infinite;
    }
    .empty-state h3 {
        color: var(--text-primary);
        font-size: 22px;
        font-weight: 700;
        margin-bottom: 12px;
    }
    .empty-state p {
        color: var(--text-secondary);
        font-size: 15px;
        margin: 0;
    }

    /* =========================================
       6. DARK MODE OVERRIDES
       ========================================= */
    [data-theme="dark"] .portal-header h1 { color: var(--text-primary) !important; }
    [data-theme="dark"] .portal-header p { color: var(--text-secondary) !important; }
    [data-theme="dark"] .guru-card { background: var(--bg-secondary) !important; border-color: var(--border-color) !important; }
    [data-theme="dark"] .guru-name { color: var(--text-primary) !important; }
    [data-theme="dark"] .guru-subject { color: var(--text-secondary) !important; }
    [data-theme="dark"] .empty-state { background: var(--bg-secondary) !important; border-color: var(--border-color) !important; }
    [data-theme="dark"] .btn-lihat-profil {
        background: linear-gradient(135deg, #34D399 0%, #10B981 100%) !important;
        box-shadow: 0 4px 15px rgba(52, 211, 153, 0.4) !important;
    }
    [data-theme="dark"] .btn-lihat-profil:hover {
        background: linear-gradient(135deg, #10B981 0%, #059669 100%) !important;
        box-shadow: 0 8px 25px rgba(52, 211, 153, 0.5) !important;
    }

    /* =========================================
       7. RESPONSIVE
       ========================================= */
    @media (max-width: 768px) {
        .guru-wrapper { margin: 20px auto; padding: 0 15px; }
        .portal-header h1 { font-size: 28px; }
        .portal-header p { font-size: 14px; }
        .guru-grid { grid-template-columns: 1fr; gap: 20px; }
        .guru-card { padding: 30px 20px; }
        .guru-avatar { width: 90px; height: 90px; font-size: 36px; }
    }
</style>

<div class="guru-wrapper">
    
    {{-- Header --}}
    <div class="portal-header">
        <h1>Tenaga Pendidik</h1>
        <p>Kenali guru-guru profesional kami yang berdedikasi untuk mendidik dan membimbing siswa menuju masa depan yang cerah.</p>
    </div>

    {{-- Grid Guru --}}
    @if($gurus->isNotEmpty())
        <div class="guru-grid">
            @foreach($gurus as $guru)
                <div class="guru-card">
                    <div class="guru-avatar">
                        @if($guru->foto && file_exists(public_path('storage/gurus/' . $guru->foto)))
                            <img src="{{ asset('storage/gurus/' . $guru->foto) }}" alt="{{ $guru->nama }}" loading="lazy">
                        @else
                            {{ strtoupper(substr($guru->nama, 0, 1)) }}
                        @endif
                    </div>
                    <h3 class="guru-name">{{ $guru->nama }}</h3>
                    <p class="guru-subject">{{ $guru->mata_pelajaran ?: 'Tenaga Pendidik' }}</p>
                    
                    {{-- Tombol Lihat Profil --}}
                    <a href="{{ route('portal.guru.dashboard') }}" class="btn-lihat-profil">
                        Lihat Profil
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </a>
                </div>
            @endforeach
        </div>
    @else
        <div class="empty-state">
            <div class="empty-icon">👨‍🏫</div>
            <h3>Belum Ada Data Guru</h3>
            <p>Belum ada guru yang terdaftar di portal akademik.</p>
        </div>
    @endif

</div>

@endsection