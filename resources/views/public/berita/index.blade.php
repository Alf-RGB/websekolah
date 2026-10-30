@extends('layouts.app')

@section('title', 'Berita & Artikel - ' . (\App\Models\Setting::where('key', 'nama_sekolah')->value('value') ?? 'Sekolah'))

@section('content')

<style>
    /* =========================================
       1. CSS VARIABLES & THEME
       ========================================= */
    :root {
        --bg-primary: #F8FAFC;
        --bg-secondary: #FFFFFF;
        --bg-tertiary: #F1F5F9;
        --text-primary: #0F172A;
        --text-secondary: #475569;
        --text-muted: #94A3B8;
        --border-color: #E2E8F0;
        --accent-color: #10B981;
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

    /* =========================================
       2. GLOBAL RESET & ANIMATIONS
       ========================================= */
    * { margin: 0; padding: 0; box-sizing: border-box; }
    
    .news-wrapper { 
        max-width: 1200px; 
        margin: 40px auto; 
        padding: 0 20px; 
        animation: fadeInUp 0.6s ease-out;
    }

    @keyframes fadeInDown { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes slideIn { from { opacity: 0; transform: scale(0.96) translateY(20px); } to { opacity: 1; transform: scale(1) translateY(0); } }
    @keyframes float { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-8px); } }

    /* =========================================
       3. PAGE HEADER
       ========================================= */
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
       4. NEWS GRID & CARDS
       ========================================= */
    .news-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 30px;
    }

    .news-card {
        background: var(--bg-secondary);
        border-radius: 20px;
        overflow: hidden;
        box-shadow: var(--shadow-md);
        border: 1px solid var(--border-color);
        transition: var(--transition-smooth);
        display: flex;
        flex-direction: column;
        height: 100%;
        animation: slideIn 0.6s cubic-bezier(0.4, 0, 0.2, 1) backwards;
        text-decoration: none;
        color: inherit;
    }
    
    /* Staggered Animation Delays */
    .news-card:nth-child(1) { animation-delay: 0.1s; }
    .news-card:nth-child(2) { animation-delay: 0.15s; }
    .news-card:nth-child(3) { animation-delay: 0.2s; }
    .news-card:nth-child(4) { animation-delay: 0.25s; }
    .news-card:nth-child(5) { animation-delay: 0.3s; }
    .news-card:nth-child(6) { animation-delay: 0.35s; }

    .news-card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: var(--shadow-xl);
        border-color: var(--primary-hover);
    }

    .news-image-wrapper {
        width: 100%;
        height: 200px;
        overflow: hidden;
        position: relative;
        background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
    }
    .news-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .news-card:hover .news-image {
        transform: scale(1.08);
    }
    .news-image-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 50px;
        transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .news-card:hover .news-image-placeholder {
        transform: scale(1.08) rotate(-3deg);
    }

    .news-content {
        padding: 25px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .news-category {
        background: var(--bg-tertiary);
        color: var(--primary-color);
        padding: 6px 14px;
        border-radius: 50px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        align-self: flex-start;
        letter-spacing: 0.5px;
        margin-bottom: 12px;
        transition: var(--transition-smooth);
    }
    .news-card:hover .news-category {
        background: var(--primary-color);
        color: white;
    }
    
    .news-title {
        margin: 0 0 10px 0;
        font-size: 18px;
        color: var(--text-primary);
        line-height: 1.4;
        font-weight: 700;
        transition: color 0.3s;
    }
    .news-card:hover .news-title {
        color: var(--primary-hover);
    }
    
    .news-excerpt {
        color: var(--text-secondary);
        font-size: 14px;
        line-height: 1.6;
        margin-bottom: 20px;
        flex: 1;
    }

    .news-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: auto;
        padding-top: 15px;
        border-top: 1px solid var(--border-color);
    }
    .news-date {
        color: var(--text-muted);
        font-size: 12px;
        display: flex;
        align-items: center;
        gap: 5px;
    }
    .news-link {
        color: var(--primary-hover);
        font-weight: 600;
        font-size: 13px;
        display: flex;
        align-items: center;
        gap: 4px;
        transition: var(--transition-smooth);
    }
    .news-link svg {
        transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .news-card:hover .news-link {
        gap: 8px;
        color: var(--primary-color);
    }
    .news-card:hover .news-link svg {
        transform: translateX(4px);
    }

    /* =========================================
       5. EMPTY STATE
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
       6. PAGINATION
       ========================================= */
    .pagination-wrapper {
        margin-top: 50px;
        display: flex;
        justify-content: center;
        animation: fadeInUp 0.6s ease-out 0.4s backwards;
    }

    /* =========================================
       7. DARK MODE OVERRIDES
       ========================================= */
    [data-theme="dark"] .news-category {
        background: rgba(255,255,255,0.1);
        color: #F1F5F9;
    }
    [data-theme="dark"] .news-card:hover .news-category {
        background: var(--primary-hover);
        color: white;
    }

    /* =========================================
       8. RESPONSIVE
       ========================================= */
    @media (max-width: 768px) {
        .news-wrapper { margin: 20px auto; padding: 0 15px; }
        .page-header h1 { font-size: 28px; }
        .news-grid { grid-template-columns: 1fr; }
    }
</style>

<div class="news-wrapper">
    {{-- HEADER --}}
    <div class="page-header">
        <h1>📰 Berita & Artikel</h1>
        <p>Informasi terbaru seputar kegiatan, pengumuman, dan prestasi sekolah kami.</p>
    </div>

    {{-- GRID BERITA --}}
    <div class="news-grid">
        @forelse($posts as $post)
            <a href="/berita/{{ $post->slug }}" class="news-card">
                {{-- Thumbnail/Image --}}
                <div class="news-image-wrapper">
                    @if($post->image)
                        <img src="{{ asset('storage/posts/' . $post->image) }}" alt="{{ $post->judul }}" class="news-image" loading="lazy">
                    @else
                        <div class="news-image-placeholder">
                            📰
                        </div>
                    @endif
                </div>

                {{-- Konten Kartu --}}
                <div class="news-content">
                    <span class="news-category">
                        {{ ucfirst($post->kategori ?? 'Berita') }}
                    </span>
                    
                    <h3 class="news-title">
                        {{ $post->judul }}
                    </h3>
                    
                    {{-- Snippet Konten --}}
                    @if($post->konten)
                        <p class="news-excerpt">
                            {{ Str::limit(strip_tags($post->konten), 90) }}
                        </p>
                    @endif

                    <div class="news-footer">
                        <span class="news-date">
                            📅 {{ $post->published_at ? $post->published_at->format('d M Y') : $post->created_at->format('d M Y') }}
                        </span>
                        <span class="news-link">
                            Baca Selengkapnya 
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </span>
                    </div>
                </div>
            </a>
        @empty
            {{-- Empty State --}}
            <div class="empty-state">
                <div class="empty-icon">📭</div>
                <h3>Belum Ada Berita</h3>
                <p>Admin belum mempublikasikan berita atau artikel apa pun.</p>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if(method_exists($posts, 'links') && $posts->hasPages())
        <div class="pagination-wrapper">
            {{ $posts->links() }}
        </div>
    @endif
</div>

@endsection