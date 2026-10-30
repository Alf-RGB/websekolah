@extends('layouts.app')

@section('title', $guru->nama . ' - Portal Akademik')

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
    @keyframes slideIn { from { opacity: 0; transform: scale(0.96) translateY(20px); } to { opacity: 1; transform: scale(1) translateY(0); } }
    @keyframes pulse { 0%, 100% { transform: scale(1); } 50% { transform: scale(1.05); } }

    /* =========================================
       2. WRAPPER & LAYOUT
       ========================================= */
    .guru-detail-wrapper { 
        max-width: 900px; 
        margin: 40px auto; 
        padding: 0 20px; 
        animation: fadeInUp 0.6s ease-out;
    }

    /* =========================================
       3. BACK BUTTON
       ========================================= */
    .btn-kembali-guru {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: var(--bg-secondary);
        color: var(--text-primary);
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
    .btn-kembali-guru:hover {
        background: var(--bg-tertiary);
        border-color: var(--accent-color);
        color: var(--accent-color);
        transform: translateX(-5px);
        box-shadow: var(--shadow-md);
    }
    .btn-kembali-guru:active {
        transform: translateX(-5px) scale(0.98);
    }

    /* =========================================
       4. PROFILE CARD
       ========================================= */
    .guru-profile-card {
        background: var(--bg-secondary);
        border-radius: 24px;
        padding: 40px;
        box-shadow: var(--shadow-lg);
        border: 1px solid var(--border-color);
        margin-bottom: 30px;
        display: flex;
        align-items: center;
        gap: 30px;
        flex-wrap: wrap;
        transition: var(--transition-smooth);
        animation: slideIn 0.6s cubic-bezier(0.4, 0, 0.2, 1) 0.1s backwards;
    }
    .guru-profile-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-xl);
    }

    .guru-avatar {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--accent-color) 0%, var(--accent-hover) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 48px;
        font-weight: 700;
        flex-shrink: 0;
        border: 4px solid var(--bg-secondary);
        box-shadow: var(--shadow-md);
        transition: var(--transition-smooth);
        overflow: hidden;
    }
    .guru-profile-card:hover .guru-avatar {
        transform: scale(1.05) rotate(-3deg);
        box-shadow: var(--shadow-lg);
    }
    .guru-avatar img {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        object-fit: cover;
    }

    .guru-info h1 {
        color: var(--text-primary);
        font-size: 28px;
        font-weight: 800;
        margin-bottom: 8px;
        letter-spacing: -0.5px;
    }
    .guru-info p {
        color: var(--text-secondary);
        font-size: 16px;
        margin: 0;
        font-weight: 500;
    }

    /* =========================================
       5. MATERI SECTION
       ========================================= */
    .materi-section {
        margin-top: 40px;
        animation: fadeInUp 0.6s ease-out 0.2s backwards;
    }
    .materi-section h2 {
        color: var(--text-primary);
        font-size: 22px;
        font-weight: 700;
        margin-bottom: 20px;
        padding-left: 15px;
        border-left: 4px solid var(--accent-color);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .materi-card {
        background: var(--bg-secondary);
        border-radius: 20px;
        padding: 60px 40px;
        text-align: center;
        box-shadow: var(--shadow-md);
        border: 1px solid var(--border-color);
        transition: var(--transition-smooth);
    }
    .materi-card:hover {
        box-shadow: var(--shadow-lg);
        border-color: var(--accent-color);
    }

    .materi-card .empty-icon {
        font-size: 60px;
        margin-bottom: 15px;
        display: inline-block;
        animation: pulse 2s ease-in-out infinite;
    }
    .materi-card p {
        color: var(--text-secondary);
        font-size: 15px;
        margin: 0;
    }

    /* =========================================
       6. DARK MODE OVERRIDES
       ========================================= */
    [data-theme="dark"] .btn-kembali-guru {
        background: var(--bg-secondary) !important;
        color: var(--text-primary) !important;
        border-color: var(--border-color) !important;
    }
    [data-theme="dark"] .btn-kembali-guru:hover {
        background: var(--bg-tertiary) !important;
        border-color: var(--accent-color) !important;
        color: var(--accent-color) !important;
    }
    [data-theme="dark"] .guru-profile-card,
    [data-theme="dark"] .materi-card {
        background: var(--bg-secondary) !important;
        border-color: var(--border-color) !important;
    }
    [data-theme="dark"] .guru-info h1 {
        color: var(--text-primary) !important;
    }
    [data-theme="dark"] .materi-section h2 {
        color: var(--text-primary) !important;
    }

    /* =========================================
       7. RESPONSIVE
       ========================================= */
    @media (max-width: 768px) {
        .guru-detail-wrapper { margin: 20px auto; padding: 0 15px; }
        .guru-profile-card {
            padding: 30px 20px;
            flex-direction: column;
            text-align: center;
        }
        .guru-info h1 { font-size: 24px; }
        .materi-card { padding: 40px 20px; }
    }
</style>

<div class="guru-detail-wrapper">
    
    {{-- Tombol Kembali --}}
    <a href="/portal-akademik" class="btn-kembali-guru">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M19 12H5M12 19l-7-7 7-7"/>
        </svg>
        Daftar Guru
    </a>

    {{-- Profil Guru Card --}}
    <div class="guru-profile-card">
        <div class="guru-avatar">
            @if($guru->foto && file_exists(public_path('storage/gurus/' . $guru->foto)))
                <img src="{{ asset('storage/gurus/' . $guru->foto) }}" alt="{{ $guru->nama }}" loading="lazy">
            @else
                {{ strtoupper(substr($guru->nama, 0, 1)) }}
            @endif
        </div>
        <div class="guru-info">
            <h1>{{ $guru->nama }}</h1>
            <p>{{ $guru->mata_pelajaran ?: 'Tenaga Pendidik' }}</p>
        </div>
    </div>

    {{-- Materi Ajar Section --}}
    <div class="materi-section">
        <h2>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg>
            Materi Ajar
        </h2>
        <div class="materi-card">
            <div class="empty-icon">📁</div>
            <p>Guru ini belum mengupload materi ajar.</p>
        </div>
    </div>

</div>

@endsection