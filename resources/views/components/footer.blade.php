@php
    // 1. OPTIMASI PERFORMA: Ambil semua setting yang dibutuhkan dalam 1 query saja
    $settings = \App\Models\Setting::whereIn('key', ['nama_sekolah', 'alamat_sekolah', 'telepon_sekolah', 'email_sekolah'])
        ->pluck('value', 'key');
    
    $namaSekolah = $settings['nama_sekolah'] ?? 'Sekolah Kami';
    $alamat = $settings['alamat_sekolah'] ?? 'Alamat sekolah belum diatur';
    $telepon = $settings['telepon_sekolah'] ?? '-';
    $email = $settings['email_sekolah'] ?? '-';

    // 2. MANFAATKAN DATA MENU: Ambil menu utama yang aktif untuk "Link Cepat"
    $menus = \App\Models\Menu::where('is_active', true)
        ->whereNull('parent_id') 
        ->orderBy('urutan')
        ->limit(6)
        ->get();
@endphp

<style>
    /* =========================================
       ANIMATIONS
       ========================================= */
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* =========================================
       FOOTER WRAPPER
       ========================================= */
    .footer-wrapper {
        background: linear-gradient(135deg, #1D3557 0%, #457B9D 100%);
        color: #ecf0f1;
        padding: 60px 0 20px;
        margin-top: 60px;
        position: relative;
        overflow: hidden;
    }

    /* Subtle top glow */
    .footer-wrapper::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 1px;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
    }

    .footer-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    /* =========================================
       FOOTER GRID
       ========================================= */
    .footer-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 40px;
        margin-bottom: 40px;
    }

    .footer-col {
        animation: fadeInUp 0.6s cubic-bezier(0.4, 0, 0.2, 1) backwards;
    }
    .footer-col:nth-child(1) { animation-delay: 0.1s; }
    .footer-col:nth-child(2) { animation-delay: 0.2s; }
    .footer-col:nth-child(3) { animation-delay: 0.3s; }

    .footer-title {
        color: #ffffff;
        font-size: 20px;
        margin: 0 0 20px 0;
        font-weight: 700;
        position: relative;
        display: inline-block;
    }
    
    .footer-title::after {
        content: '';
        position: absolute;
        bottom: -8px;
        left: 0;
        width: 40px;
        height: 3px;
        background: #fbbf24;
        border-radius: 2px;
    }

    .footer-text {
        color: rgba(255,255,255,0.8);
        line-height: 1.7;
        font-size: 14px;
        margin: 0 0 24px 0;
    }

    /* =========================================
       SOCIAL ICONS
       ========================================= */
    .social-icons {
        display: flex;
        gap: 12px;
    }
    .social-icon {
        width: 40px;
        height: 40px;
        background: rgba(255,255,255,0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        text-decoration: none;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid rgba(255,255,255,0.1);
    }
    .social-icon:hover {
        transform: translateY(-4px);
        border-color: transparent;
    }
    .social-icon.fb:hover { background: #1877F2; box-shadow: 0 8px 20px rgba(24, 119, 242, 0.4); }
    .social-icon.ig:hover { background: #E4405F; box-shadow: 0 8px 20px rgba(228, 64, 95, 0.4); }
    .social-icon.yt:hover { background: #FF0000; box-shadow: 0 8px 20px rgba(255, 0, 0, 0.4); }

    /* =========================================
       FOOTER LINKS
       ========================================= */
    .footer-links {
        list-style: none;
        padding: 0;
        margin: 0;
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
    }
    .footer-link {
        color: rgba(255,255,255,0.8);
        text-decoration: none;
        font-size: 14px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .footer-link::before {
        content: '›';
        font-size: 16px;
        font-weight: 700;
        transition: transform 0.3s;
    }
    .footer-link:hover {
        color: #ffffff;
        transform: translateX(5px);
    }
    .footer-link:hover::before {
        transform: translateX(3px);
    }
    .footer-link.login-link {
        color: #fbbf24;
        font-weight: 600;
        grid-column: 1 / -1; /* Span full width */
        margin-top: 8px;
        padding-top: 12px;
        border-top: 1px solid rgba(255,255,255,0.1);
    }
    .footer-link.login-link:hover {
        color: #f59e0b;
    }

    /* =========================================
       CONTACT INFO
       ========================================= */
    .contact-list {
        color: rgba(255,255,255,0.8);
        font-size: 14px;
        line-height: 1.8;
        margin: 0;
        padding: 0;
        list-style: none;
    }
    .contact-item {
        margin-bottom: 16px;
        display: flex;
        align-items: flex-start;
        gap: 12px;
        transition: color 0.3s;
    }
    .contact-item:last-child { margin-bottom: 0; }
    .contact-item:hover { color: #ffffff; }
    .contact-icon {
        width: 18px;
        height: 18px;
        flex-shrink: 0;
        margin-top: 3px;
        color: #fbbf24;
    }

    /* =========================================
       COPYRIGHT BAR
       ========================================= */
    .copyright-bar {
        border-top: 1px solid rgba(255,255,255,0.1);
        padding-top: 24px;
        text-align: center;
        color: rgba(255,255,255,0.6);
        font-size: 13px;
        animation: fadeInUp 0.6s ease 0.4s backwards;
    }
    .copyright-bar p { margin: 0; }

    /* =========================================
       DARK MODE ADAPTATION (Optional but good)
       ========================================= */
    [data-theme="dark"] .footer-wrapper {
        background: linear-gradient(135deg, #0F172A 0%, #1E293B 100%) !important;
    }
    [data-theme="dark"] .footer-title::after {
        background: #60a5fa !important;
    }
</style>

<footer class="footer-wrapper">
    <div class="footer-container">
        
        {{-- GRID 3 KOLOM --}}
        <div class="footer-grid">
            
            {{-- KOLOM 1: TENTANG SEKOLAH --}}
            <div class="footer-col">
                <h3 class="footer-title">{{ $namaSekolah }}</h3>
                <p class="footer-text">
                    Mewujudkan generasi cerdas, berkarakter, dan siap menghadapi tantangan global melalui pendidikan yang berkualitas dan inovatif.
                </p>
                <div class="social-icons">
                    <a href="#" class="social-icon fb" title="Facebook">
                        <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                    <a href="#" class="social-icon ig" title="Instagram">
                        <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    </a>
                    <a href="#" class="social-icon yt" title="YouTube">
                        <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                    </a>
                </div>
            </div>

            {{-- KOLOM 2: LINK CEPAT (DINAMIS DARI DATABASE) --}}
            <div class="footer-col">
                <h3 class="footer-title">Link Cepat</h3>
                <ul class="footer-links">
                    @forelse($menus as $menu)
                        <li>
                            <a href="{{ $menu->url }}" class="footer-link">
                                {{ $menu->judul_menu }}
                            </a>
                        </li>
                    @empty
                        {{-- Fallback jika belum ada menu di database --}}
                        <li><a href="/" class="footer-link">Beranda</a></li>
                        <li><a href="/profil" class="footer-link">Profil</a></li>
                        <li><a href="/galeri" class="footer-link">Galeri</a></li>
                        <li><a href="/kontak" class="footer-link">Kontak</a></li>
                    @endforelse
                    <li>
                        <a href="/login" class="footer-link login-link">
                            Login Admin
                        </a>
                    </li>
                </ul>
            </div>

            {{-- KOLOM 3: KONTAK --}}
            <div class="footer-col">
                <h3 class="footer-title">Hubungi Kami</h3>
                <ul class="contact-list">
                    <li class="contact-item">
                        <svg class="contact-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span>{{ $alamat }}</span>
                    </li>
                    <li class="contact-item">
                        <svg class="contact-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        <span>{{ $telepon }}</span>
                    </li>
                    <li class="contact-item">
                        <svg class="contact-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <span>{{ $email }}</span>
                    </li>
                </ul>
            </div>
        </div>

        {{-- COPYRIGHT BAR --}}
        <div class="copyright-bar">
            <p>&copy; {{ date('Y') }} {{ $namaSekolah }}. All Rights Reserved.</p>
        </div>
    </div>
</footer>