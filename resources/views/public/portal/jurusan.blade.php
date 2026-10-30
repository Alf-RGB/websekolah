@extends('layouts.app')

@section('title', 'Kompetensi Keahlian - ' . (\App\Models\Setting::where('key', 'nama_sekolah')->value('value') ?? 'Sekolah'))

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
    @keyframes float { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-8px); } }

    /* =========================================
       2. WRAPPER & HEADER
       ========================================= */
    .jurusan-wrapper { 
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
        color: var(--text-primary); 
        font-size: 36px; 
        margin-bottom: 10px; 
        font-weight: 800; 
        letter-spacing: -0.5px;
    }
    .page-header p { 
        color: var(--text-secondary); 
        font-size: 16px; 
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
        gap: 25px;
    }

    .jurusan-card {
        background: var(--bg-secondary);
        border-radius: 20px;
        padding: 30px;
        box-shadow: var(--shadow-md);
        border: 1px solid var(--border-color);
        transition: var(--transition-smooth);
        height: 100%;
        display: flex;
        flex-direction: column;
        text-decoration: none;
        color: inherit;
        animation: slideIn 0.6s cubic-bezier(0.4, 0, 0.2, 1) backwards;
        position: relative;
        overflow: hidden;
    }
    
    /* Staggered Animation Delays */
    .jurusan-card:nth-child(1) { animation-delay: 0.1s; }
    .jurusan-card:nth-child(2) { animation-delay: 0.15s; }
    .jurusan-card:nth-child(3) { animation-delay: 0.2s; }
    .jurusan-card:nth-child(4) { animation-delay: 0.25s; }
    .jurusan-card:nth-child(5) { animation-delay: 0.3s; }
    .jurusan-card:nth-child(6) { animation-delay: 0.35s; }

    .jurusan-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--primary-color), var(--primary-hover));
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .jurusan-card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: var(--shadow-xl);
        border-color: var(--primary-hover);
    }
    .jurusan-card:hover::before {
        transform: scaleX(1);
    }

    .jurusan-icon {
        font-size: 50px;
        margin-bottom: 15px;
        display: inline-block;
        transition: var(--transition-smooth);
    }
    .jurusan-card:hover .jurusan-icon {
        transform: scale(1.15) rotate(-5deg);
    }

    .jurusan-title {
        color: var(--text-primary);
        font-size: 20px;
        margin: 0 0 10px 0;
        font-weight: 700;
        transition: color 0.3s;
    }
    .jurusan-card:hover .jurusan-title {
        color: var(--primary-hover);
    }

    .jurusan-desc {
        color: var(--text-secondary);
        font-size: 14px;
        line-height: 1.6;
        margin: 0 0 20px 0;
        flex: 1;
    }

    .jurusan-link {
        color: var(--primary-hover);
        font-weight: 600;
        font-size: 14px;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        margin-top: auto;
        transition: var(--transition-smooth);
    }
    .jurusan-link svg {
        width: 16px;
        height: 16px;
        transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .jurusan-card:hover .jurusan-link {
        gap: 10px;
        color: var(--primary-color);
    }
    .jurusan-card:hover .jurusan-link svg {
        transform: translateX(4px);
    }

    /* =========================================
       4. EMPTY STATE
       ========================================= */
    .empty-state {
        grid-column: 1/-1;
        text-align: center;
        padding: 60px 20px;
        background: var(--bg-secondary);
        border-radius: 20px;
        box-shadow: var(--shadow-md);
        border: 1px solid var(--border-color);
        animation: slideIn 0.6s ease-out;
    }
    .empty-icon {
        font-size: 60px;
        margin-bottom: 15px;
        display: inline-block;
        animation: float 3s ease-in-out infinite;
    }
    .empty-state h3 {
        color: var(--text-primary);
        margin-bottom: 10px;
        font-size: 20px;
        font-weight: 700;
    }
    .empty-state p {
        color: var(--text-secondary);
        font-size: 15px;
    }

    /* =========================================
       5. DARK MODE OVERRIDES
       ========================================= */
    [data-theme="dark"] .jurusan-card {
        background: var(--bg-secondary) !important;
        border-color: var(--border-color) !important;
    }
    [data-theme="dark"] .jurusan-card:hover {
        border-color: var(--primary-hover) !important;
    }

    /* =========================================
       6. RESPONSIVE
       ========================================= */
    @media (max-width: 768px) {
        .jurusan-wrapper { margin: 20px auto; padding: 0 15px; }
        .page-header h1 { font-size: 28px; }
        .jurusan-grid { grid-template-columns: 1fr; }
        .jurusan-card { padding: 25px 20px; }
    }
</style>

<div class="jurusan-wrapper">
    {{-- HEADER --}}
    <div class="page-header">
        <h1>🎓 Kompetensi Keahlian</h1>
        <p>Pilih jurusan yang sesuai dengan minat dan bakatmu untuk masa depan yang cerah.</p>
    </div>

    {{-- GRID JURUSAN --}}
    <div class="jurusan-grid">
        @forelse($kompetensis as $komp)
            <a href="/portal-akademik/jurusan/{{ $komp->slug }}" class="jurusan-card">
                <div class="jurusan-icon">{{ $komp->icon ?? '🎓' }}</div>
                <h3 class="jurusan-title">{{ $komp->nama }}</h3>
                @if($komp->deskripsi)
                    <p class="jurusan-desc">
                        {{ Str::limit(strip_tags($komp->deskripsi), 120) }}
                    </p>
                @endif
                <span class="jurusan-link">
                    Selengkapnya 
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </span>
            </a>
        @empty
            <div class="empty-state">
                <div class="empty-icon">🎓</div>
                <h3>Belum Ada Kompetensi Keahlian</h3>
                <p>Admin belum menambahkan data jurusan/kompetensi.</p>
            </div>
        @endforelse
    </div>
</div>

@endsection