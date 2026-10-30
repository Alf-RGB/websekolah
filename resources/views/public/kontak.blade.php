@extends('layouts.app')

@section('title', 'Kontak - ' . ($settings['nama_sekolah'] ?? 'Sekolah'))

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
        --wa-color: #25D366;
        --wa-hover: #128C7E;
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
       2. WRAPPER & HEADER
       ========================================= */
    .contact-wrapper { 
        max-width: 1000px; 
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
       3. CONTACT GRID & CARDS
       ========================================= */
    .contact-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 30px;
    }

    .contact-card {
        background: var(--bg-secondary);
        border: 1px solid var(--border-color);
        box-shadow: var(--shadow-md);
        border-radius: 20px;
        padding: 35px;
        transition: var(--transition-smooth);
        animation: slideIn 0.6s cubic-bezier(0.4, 0, 0.2, 1) backwards;
    }
    .contact-card:nth-child(1) { animation-delay: 0.1s; }
    .contact-card:nth-child(2) { animation-delay: 0.2s; }

    .contact-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-xl);
    }

    .card-title {
        color: var(--text-primary);
        margin-bottom: 20px;
        font-size: 20px;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .card-subtitle {
        color: var(--text-secondary);
        margin-bottom: 20px;
        font-size: 14px;
        line-height: 1.8;
    }

    /* =========================================
       4. CONTACT ITEMS
       ========================================= */
    .contact-list {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }
    .contact-item {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 15px;
        background: var(--bg-tertiary);
        border-radius: 12px;
        color: var(--text-primary);
        text-decoration: none;
        transition: var(--transition-smooth);
        border: 1px solid var(--border-color);
    }
    .contact-item:hover {
        background: #EFF6FF;
        border-color: var(--primary-color);
        transform: translateX(5px);
    }
    .contact-item .icon {
        font-size: 24px;
        flex-shrink: 0;
    }
    .contact-item .label {
        font-size: 11px;
        color: var(--text-muted);
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .contact-item .value {
        font-weight: 600;
        font-size: 15px;
        word-break: break-all;
    }

    /* WhatsApp Specific */
    .contact-item.wa {
        background: rgba(37, 211, 102, 0.1);
        color: #065F46;
        border-color: rgba(37, 211, 102, 0.2);
    }
    .contact-item.wa:hover {
        background: var(--wa-color);
        color: white;
        border-color: var(--wa-color);
        transform: translateX(5px) scale(1.02);
    }
    .contact-item.wa:hover .label,
    .contact-item.wa:hover .value {
        color: white;
    }

    /* =========================================
       5. SOCIAL MEDIA LINKS
       ========================================= */
    .social-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }
    .social-link {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 12px 15px;
        background: var(--bg-tertiary);
        border-radius: 12px;
        text-decoration: none;
        transition: var(--transition-smooth);
        border: 1px solid var(--border-color);
    }
    .social-link svg {
        width: 24px;
        height: 24px;
        flex-shrink: 0;
        transition: var(--transition-smooth);
    }
    .social-link .name {
        font-weight: 700;
        font-size: 14px;
        transition: var(--transition-smooth);
    }
    .social-link .handle {
        font-size: 12px;
        opacity: 0.8;
        transition: var(--transition-smooth);
    }

    /* Facebook */
    .social-link.fb { color: #1877F2; }
    .social-link.fb:hover { background: #1877F2; color: white; border-color: #1877F2; }
    
    /* Instagram */
    .social-link.ig { color: #E1306C; }
    .social-link.ig:hover { background: #E1306C; color: white; border-color: #E1306C; }
    
    /* TikTok */
    .social-link.tt { color: var(--text-primary); }
    .social-link.tt:hover { background: #000000; color: white; border-color: #000000; }

    /* =========================================
       6. MAP PLACEHOLDER
       ========================================= */
    .map-placeholder {
        background: var(--bg-tertiary);
        border-radius: 20px;
        overflow: hidden;
        border: 2px dashed var(--border-color);
        height: 250px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        color: var(--text-muted);
        transition: var(--transition-smooth);
        animation: slideIn 0.6s cubic-bezier(0.4, 0, 0.2, 1) 0.3s backwards;
    }
    .map-placeholder:hover {
        border-color: var(--primary-hover);
        color: var(--primary-hover);
    }
    .map-placeholder .icon { font-size: 40px; margin-bottom: 10px; }
    .map-placeholder .text { font-size: 14px; font-weight: 600; margin: 0; }
    .map-placeholder .subtext { font-size: 12px; margin: 5px 0 0 0; }

    /* =========================================
       7. BACK BUTTON
       ========================================= */
    .btn-kembali-wrapper {
        text-align: center;
        margin-top: 50px;
        animation: fadeInUp 0.6s ease-out 0.4s backwards;
    }
    .btn-kembali {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
        color: white;
        padding: 14px 30px;
        border-radius: 50px;
        font-weight: 600;
        text-decoration: none;
        transition: var(--transition-smooth);
        border: none;
        box-shadow: 0 4px 12px rgba(29, 53, 87, 0.2);
    }
    .btn-kembali:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(29, 53, 87, 0.3);
    }
    .btn-kembali:active {
        transform: translateY(0) scale(0.98);
    }

    /* =========================================
       8. DARK MODE OVERRIDES
       ========================================= */
    [data-theme="dark"] .contact-card,
    [data-theme="dark"] .map-placeholder {
        background: var(--bg-secondary) !important;
        border-color: var(--border-color) !important;
    }
    [data-theme="dark"] .contact-item {
        background: var(--bg-primary) !important;
        border-color: var(--border-color) !important;
        color: var(--text-primary) !important;
    }
    [data-theme="dark"] .contact-item:hover {
        background: var(--bg-tertiary) !important;
        border-color: var(--primary-hover) !important;
    }
    [data-theme="dark"] .contact-item.wa {
        background: rgba(37, 211, 102, 0.15) !important;
        color: #6EE7B7 !important;
        border-color: rgba(37, 211, 102, 0.3) !important;
    }
    [data-theme="dark"] .contact-item.wa:hover {
        background: var(--wa-color) !important;
        color: white !important;
    }
    [data-theme="dark"] .social-link {
        background: var(--bg-primary) !important;
        border-color: var(--border-color) !important;
    }
    [data-theme="dark"] .social-link.tt {
        color: var(--text-primary) !important;
    }
    [data-theme="dark"] .social-link.tt:hover {
        background: #F1F5F9 !important;
        color: #0F172A !important;
        border-color: #F1F5F9 !important;
    }

    /* =========================================
       9. RESPONSIVE
       ========================================= */
    @media (max-width: 768px) {
        .contact-wrapper { margin: 20px auto; padding: 0 15px; }
        .page-header h1 { font-size: 28px; }
        .contact-grid { grid-template-columns: 1fr; }
        .contact-card { padding: 25px 20px; }
    }
</style>

<div class="contact-wrapper">
    
    {{-- HEADER --}}
    <div class="page-header">
        <h1>Hubungi Kami</h1>
        <p>Kami senang mendengar dari Anda. Silakan hubungi kami melalui informasi di bawah ini atau kunjungi sekolah kami secara langsung.</p>
    </div>

    <div class="contact-grid">
        
        {{-- Kolom 1: Alamat & Kontak Langsung --}}
        <div class="contact-card">
            <h2 class="card-title">📍 Alamat Sekolah</h2>
            <p class="card-subtitle">
                {{ $settings['alamat_sekolah'] ?? 'Alamat sekolah akan ditampilkan di sini setelah diatur di dashboard admin.' }}
            </p>
            
            <h2 class="card-title" style="margin-top: 30px;">📱 Kontak Langsung</h2>
            <div class="contact-list">
                {{-- Telepon --}}
                <a href="tel:{{ $settings['telepon_sekolah'] ?? '' }}" class="contact-item">
                    <span class="icon">📞</span>
                    <div>
                        <div class="label">Telepon</div>
                        <div class="value">{{ $settings['telepon_sekolah'] ?? '-' }}</div>
                    </div>
                </a>
                
                {{-- Email --}}
                <a href="mailto:{{ $settings['email_sekolah'] ?? '' }}" class="contact-item">
                    <span class="icon">✉️</span>
                    <div style="flex: 1; min-width: 0;">
                        <div class="label">Email</div>
                        <div class="value">{{ $settings['email_sekolah'] ?? '-' }}</div>
                    </div>
                </a>

                {{-- WhatsApp --}}
                @if(!empty($settings['nomor_whatsapp']))
                    @php
                        $waClean = preg_replace('/[^0-9]/', '', $settings['nomor_whatsapp']);
                        if (str_starts_with($waClean, '0')) $waClean = '62' . substr($waClean, 1);
                    @endphp
                    <a href="https://wa.me/{{ $waClean }}" target="_blank" rel="noopener noreferrer" class="contact-item wa">
                        <span class="icon">💬</span>
                        <div>
                            <div class="label">WhatsApp</div>
                            <div class="value">Chat Langsung</div>
                        </div>
                    </a>
                @endif
            </div>
        </div>

        {{-- Kolom 2: Sosial Media & Peta --}}
        <div style="display: flex; flex-direction: column; gap: 30px;">
            
            {{-- Sosial Media --}}
            <div class="contact-card">
                <h2 class="card-title">🌐 Sosial Media</h2>
                <p class="card-subtitle">Ikuti kami untuk mendapatkan update terbaru:</p>
                
                <div class="social-list">
                    {{-- Facebook --}}
                    <a href="#" class="social-link fb" target="_blank" rel="noopener noreferrer">
                        <svg fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        <div>
                            <div class="name">Facebook</div>
                            <div class="handle">@sekolah.official</div>
                        </div>
                    </a>
                    
                    {{-- Instagram --}}
                    <a href="#" class="social-link ig" target="_blank" rel="noopener noreferrer">
                        <svg fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        <div>
                            <div class="name">Instagram</div>
                            <div class="handle">@sekolah.official</div>
                        </div>
                    </a>
                    
                    {{-- TikTok --}}
                    <a href="#" class="social-link tt" target="_blank" rel="noopener noreferrer">
                        <svg fill="currentColor" viewBox="0 0 24 24"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/></svg>
                        <div>
                            <div class="name">TikTok</div>
                            <div class="handle">@sekolah.official</div>
                        </div>
                    </a>
                </div>
            </div>

            {{-- Placeholder Peta --}}
            <div class="map-placeholder">
                <span class="icon">🗺️</span>
                <p class="text">Area Peta Google Maps</p>
                <p class="subtext">(Ganti div ini dengan &lt;iframe&gt; Google Maps)</p>
            </div>

        </div>
    </div>

    {{-- Tombol Kembali --}}
    <div class="btn-kembali-wrapper">
        <a href="/" class="btn-kembali">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
            Kembali ke Beranda
        </a>
    </div>
</div>

@endsection