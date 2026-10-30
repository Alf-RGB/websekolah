<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <title>@yield('title', 'SMK Multi Karya Medan')</title>
    
    {{--  ANTI-FLASH: Apply theme BEFORE rendering --}}
    <script>
        (function() {
            const theme = localStorage.getItem('theme') || 
                (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
            document.documentElement.setAttribute('data-theme', theme);
        })();
    </script>
    
    <link rel="stylesheet" href="{{ asset('css/dark-mode.css') }}">
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');

        :root {
            --bg-primary: #F8FAFC;
            --bg-secondary: #FFFFFF;
            --text-primary: #0F172A;
            --text-secondary: #475569;
            --border-color: #E2E8F0;
            --hover-bg: #F1F5F9;
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.05);
            --shadow-md: 0 4px 6px -1px rgba(0,0,0,0.1);
            --shadow-lg: 0 10px 15px -3px rgba(0,0,0,0.1);
            --transition-smooth: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        [data-theme="dark"] {
            --bg-primary: #0F172A;
            --bg-secondary: #1E293B;
            --text-primary: #F1F5F9;
            --text-secondary: #CBD5E1;
            --border-color: #334155;
            --hover-bg: #334155;
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.3);
            --shadow-md: 0 4px 6px -1px rgba(0,0,0,0.4);
            --shadow-lg: 0 10px 15px -3px rgba(0,0,0,0.5);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body { 
            font-family: 'Inter', sans-serif; 
            background: var(--bg-primary); 
            color: var(--text-primary); 
            line-height: 1.6; 
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        @keyframes fadeInDown { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes slideInRight { from { opacity: 0; transform: translateX(100px); } to { opacity: 1; transform: translateX(0); } }

        /* =========================================
           NAVBAR STYLES
           ========================================= */
        .navbar { 
            background: var(--bg-secondary); 
            border-bottom: 1px solid var(--border-color); 
            position: sticky; 
            top: 0; 
            z-index: 1000; 
            box-shadow: var(--shadow-sm);
            animation: fadeInDown 0.6s ease-out;
        }
        
        .navbar-container { 
            max-width: 1200px; 
            margin: 0 auto; 
            padding: 0 30px; 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            height: 70px; 
        }
        
        .navbar-brand { 
            font-size: 18px; 
            font-weight: 800; 
            color: var(--text-primary); 
            text-decoration: none; 
            letter-spacing: -0.3px; 
            flex-shrink: 0;
            transition: var(--transition-smooth);
        }
        .navbar-brand:hover { opacity: 0.8; }

        .navbar-menu { 
            display: flex; 
            gap: 5px; 
            list-style: none; 
            align-items: center; 
            margin: 0; 
            padding: 0; 
        }
        
        .navbar-menu > li > a { 
            padding: 10px 16px; 
            border-radius: 8px; 
            text-decoration: none; 
            color: var(--text-secondary); 
            font-weight: 600; 
            font-size: 14px; 
            transition: var(--transition-smooth); 
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }
        
        .navbar-menu > li > a:hover, 
        .navbar-menu > li > a.active { 
            background: var(--hover-bg); 
            color: var(--text-primary); 
        }

        /* Dropdown Desktop */
        .has-dropdown { position: relative; }
        
        .dropdown-menu { 
            position: absolute; 
            top: 100%; 
            left: 0; 
            background: var(--bg-secondary); 
            min-width: 220px; 
            box-shadow: var(--shadow-lg); 
            border-radius: 12px; 
            padding: 8px; 
            opacity: 0; 
            visibility: hidden; 
            transform: translateY(10px); 
            transition: var(--transition-smooth); 
            z-index: 1000; 
            border: 1px solid var(--border-color); 
            margin-top: 8px; 
            list-style: none; 
        }
        
        .has-dropdown:hover > .dropdown-menu { 
            opacity: 1; 
            visibility: visible; 
            transform: translateY(0); 
        }
        
        .dropdown-menu li a { 
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 14px; 
            color: var(--text-secondary); 
            text-decoration: none; 
            transition: var(--transition-smooth); 
            font-size: 14px;
            border-radius: 8px;
        }
        
        .dropdown-menu li a:hover { 
            background: var(--hover-bg); 
            color: var(--text-primary); 
            transform: translateX(4px);
        }

        /* Hamburger Button */
        .hamburger-btn { 
            display: none; 
            background: var(--bg-secondary); 
            border: 1px solid var(--border-color); 
            border-radius: 8px; 
            font-size: 24px; 
            cursor: pointer; 
            color: var(--text-primary); 
            padding: 8px; 
            z-index: 1001; 
            transition: var(--transition-smooth); 
        }
        .hamburger-btn:hover { background: var(--hover-bg); transform: scale(1.05); }
        .hamburger-btn:active { transform: scale(0.95); }

        /* =========================================
           THEME TOGGLE - SAMA KAYAK ADMIN (PROFESSIONAL)
           ========================================= */
        #themeToggle {
            width: 60px !important;
            height: 32px !important;
            border-radius: 16px !important;
            background: #E2E8F0 !important;
            border: none !important;
            cursor: pointer !important;
            position: relative !important;
            transition: all 0.3s ease !important;
            flex-shrink: 0 !important;
            padding: 0 !important;
            display: inline-block !important;
            overflow: hidden !important;
            box-shadow: inset 0 2px 4px rgba(0,0,0,0.1) !important;
        }
        
        #themeToggle:hover {
            background: #CBD5E1 !important;
        }
        
        [data-theme="dark"] #themeToggle {
            background: #334155 !important;
            box-shadow: inset 0 2px 4px rgba(0,0,0,0.3) !important;
        }
        
        [data-theme="dark"] #themeToggle:hover {
            background: #475569 !important;
        }
        
        /* HAPUS SEMUA PSEUDO-ELEMENT */
        #themeToggle::before,
        #themeToggle::after {
            display: none !important;
            content: none !important;
        }
        
        .theme-toggle-ball {
            position: absolute !important;
            top: 4px !important;
            left: 4px !important;
            width: 24px !important;
            height: 24px !important;
            border-radius: 50% !important;
            background: white !important;
            box-shadow: 0 2px 4px rgba(0,0,0,0.2) !important;
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            z-index: 10 !important;
        }
        
        [data-theme="dark"] .theme-toggle-ball {
            transform: translateX(28px) !important;
            background: #1E293B !important;
        }
        
        .theme-toggle-ball svg {
            width: 14px !important;
            height: 14px !important;
            color: #F59E0B !important;
            transition: color 0.3s ease !important;
        }
        
        [data-theme="dark"] .theme-toggle-ball svg {
            color: #818CF8 !important;
        }

        /* =========================================
           MOBILE MENU OVERLAY
           ========================================= */
        .mobile-menu-overlay { 
            position: fixed; 
            top: 70px; 
            left: 0; 
            right: 0; 
            background: var(--bg-secondary); 
            box-shadow: var(--shadow-lg); 
            z-index: 999; 
            padding: 20px; 
            border-top: 1px solid var(--border-color); 
            max-height: 0;
            overflow: hidden;
            opacity: 0;
            visibility: hidden;
            transition: max-height 0.4s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.3s ease, visibility 0.3s ease;
        }
        
        .mobile-menu-overlay.active { 
            max-height: calc(100vh - 70px);
            opacity: 1;
            visibility: visible;
            overflow-y: auto;
        }
        
        .mobile-menu-list { list-style: none; padding: 0; margin: 0; }
        .mobile-menu-list > li { margin-bottom: 4px; }
        
        .mobile-menu-list > li > a { 
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 14px 16px; 
            color: var(--text-primary); 
            text-decoration: none; 
            font-weight: 600; 
            font-size: 15px; 
            border-radius: 8px; 
            transition: var(--transition-smooth); 
        }
        .mobile-menu-list > li > a:hover { background: var(--hover-bg); }
        
        .mobile-dropdown-content { 
            list-style: none; 
            padding: 0; 
            margin: 0; 
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .mobile-dropdown-content.active { 
            max-height: 500px;
        }
        .mobile-dropdown-content a { 
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px 10px 30px; 
            font-size: 14px; 
            color: var(--text-secondary); 
            text-decoration: none; 
            border-radius: 6px;
            transition: var(--transition-smooth);
        }
        .mobile-dropdown-content a:hover { background: var(--hover-bg); color: var(--text-primary); }
        
        .mobile-theme-toggle-wrapper { 
            display: flex; 
            align-items: center; 
            justify-content: space-between;
            padding: 14px 16px; 
            margin-top: 15px; 
            border-top: 1px solid var(--border-color); 
        }
        .mobile-theme-toggle-wrapper span { font-weight: 600; color: var(--text-primary); font-size: 15px; }

        /* =========================================
           FOOTER STYLES
           ========================================= */
        .footer { 
            background: var(--bg-secondary); 
            border-top: 1px solid var(--border-color); 
            padding: 60px 0 30px; 
            margin-top: auto;
        }
        
        .footer-container { max-width: 1200px; margin: 0 auto; padding: 0 30px; }
        
        .footer-grid { 
            display: grid; 
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); 
            gap: 40px; 
            margin-bottom: 40px; 
        }
        
        .footer-section { animation: fadeInUp 0.6s ease-out backwards; }
        .footer-section:nth-child(1) { animation-delay: 0.1s; }
        .footer-section:nth-child(2) { animation-delay: 0.2s; }
        .footer-section:nth-child(3) { animation-delay: 0.3s; }

        .footer-section h3 { 
            color: var(--text-primary); 
            font-size: 18px; 
            font-weight: 700; 
            margin-bottom: 20px; 
            position: relative;
            display: inline-block;
        }
        .footer-section h3::after {
            content: '';
            position: absolute;
            bottom: -6px;
            left: 0;
            width: 40px;
            height: 3px;
            background: #7C3AED;
            border-radius: 2px;
        }
        
        .footer-section p, .footer-section a { 
            color: var(--text-secondary); 
            font-size: 14px; 
            line-height: 1.8; 
            text-decoration: none; 
            display: block; 
            transition: var(--transition-smooth); 
            margin-bottom: 8px;
        }
        .footer-section a:hover { color: #7C3AED; transform: translateX(4px); }
        
        .footer-bottom { 
            border-top: 1px solid var(--border-color); 
            padding-top: 25px; 
            text-align: center; 
            color: var(--text-secondary); 
            font-size: 13px; 
            animation: fadeInUp 0.6s ease-out 0.4s backwards;
        }
        
        .social-links { display: flex; gap: 12px; margin-top: 20px; }
        .social-links a { 
            width: 40px; 
            height: 40px; 
            border-radius: 50%; 
            background: var(--hover-bg); 
            border: 1px solid var(--border-color); 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            transition: var(--transition-smooth); 
            text-decoration: none;
            color: var(--text-secondary);
            font-size: 18px;
        }
        .social-links a:hover { 
            background: #7C3AED; 
            border-color: #7C3AED; 
            color: white; 
            transform: translateY(-4px); 
            box-shadow: 0 8px 20px rgba(124, 58, 237, 0.3);
        }

        /* =========================================
           RESPONSIVE DESIGN
           ========================================= */
        @media (max-width: 768px) {
            .navbar-container { padding: 0 20px; height: 60px; }
            .navbar-brand { font-size: 16px; }
            .hamburger-btn { display: flex !important; align-items: center; justify-content: center; }
            .navbar-menu { display: none; }
            .mobile-menu-overlay { top: 60px; }
            
            /* Toggle di mobile tetap bagus */
            #themeToggle {
                width: 56px !important;
                height: 30px !important;
            }
            .theme-toggle-ball {
                width: 22px !important;
                height: 22px !important;
            }
            [data-theme="dark"] .theme-toggle-ball {
                transform: translateX(26px) !important;
            }
            .theme-toggle-ball svg {
                width: 12px !important;
                height: 12px !important;
            }
            
            .footer-grid { grid-template-columns: 1fr; gap: 30px; }
            .footer-container { padding: 0 20px; }
        }
        
        @media (max-width: 480px) { 
            .navbar-brand { font-size: 14px; } 
            .footer-section h3 { font-size: 16px; }
        }
    </style>
    @stack('styles')
</head>
<body>
    <nav class="navbar">
        <div class="navbar-container">
            <a href="/" class="navbar-brand">{{ $data['nama_sekolah'] ?? 'SMK Multi Karya Medan' }}</a>
            
            <ul class="navbar-menu">
                <li><a href="/" class="{{ request()->is('/') ? 'active' : '' }}">Beranda</a></li>
                
                <li class="has-dropdown">
                    <a href="javascript:void(0)" class="{{ request()->is('profil*') ? 'active' : '' }}">
                        Profil <span style="font-size: 10px; transition: transform 0.3s;">▼</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="/profil">🏫 Profil Sekolah</a></li>
                        <li><a href="/profil/guru">👨‍ Profil Guru</a></li>
                    </ul>
                </li>
                
                <li class="has-dropdown">
                    <a href="javascript:void(0)" class="{{ request()->is('berita*') || request()->is('galeri*') ? 'active' : '' }}">
                        Media <span style="font-size: 10px; transition: transform 0.3s;">▼</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="/berita">📰 Berita</a></li>
                        <li><a href="/galeri">🖼️ Galeri</a></li>
                    </ul>
                </li>
                
                <li class="has-dropdown">
                    <a href="javascript:void(0)" class="{{ request()->is('portal-akademik*') ? 'active' : '' }}">
                        Portal Akademik <span style="font-size: 10px; transition: transform 0.3s;">▼</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="/portal-akademik">‍🏫 Data Guru</a></li>
                        <li><a href="/portal-akademik/jurusan">🎯 Kompetensi Keahlian</a></li>
                        <li><a href="/portal-akademik/alumni"> Alumni</a></li>
                        <li><a href="/portal-akademik/ppdb">📝 PPDB Online</a></li>
                    </ul>
                </li>
                
                <li><a href="/join-us" class="{{ request()->is('join-us*') ? 'active' : '' }}">Join Us</a></li>
                
                <li>
                    {{-- THEME TOGGLE - PROFESSIONAL (SAMA KAYAK ADMIN) --}}
                    <button id="themeToggle" title="Toggle Dark Mode" aria-label="Toggle Dark Mode">
                        <div class="theme-toggle-ball">
                            <svg class="sun-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            <svg class="moon-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display: none;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                            </svg>
                        </div>
                    </button>
                </li>
            </ul>
            
            <button class="hamburger-btn" onclick="toggleMobileMenu()" aria-label="Menu">
                <svg id="hamburgerIcon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></line>
                </svg>
            </button>
        </div>
        
        <div class="mobile-menu-overlay" id="mobileMenuOverlay">
            <ul class="mobile-menu-list">
                <li><a href="/">🏠 Beranda</a></li>
                
                <li>
                    <a href="javascript:void(0)" onclick="toggleMobileDropdown('profil', this)">
                        📁 Profil <span class="arrow">▼</span>
                    </a>
                    <ul id="mobile-profil" class="mobile-dropdown-content">
                        <li><a href="/profil">🏫 Profil Sekolah</a></li>
                        <li><a href="/profil/guru">👨‍🏫 Profil Guru</a></li>
                    </ul>
                </li>
                
                <li>
                    <a href="javascript:void(0)" onclick="toggleMobileDropdown('media', this)">
                         Media <span class="arrow">▼</span>
                    </a>
                    <ul id="mobile-media" class="mobile-dropdown-content">
                        <li><a href="/berita"> Berita</a></li>
                        <li><a href="/galeri">️ Galeri</a></li>
                    </ul>
                </li>
                
                <li>
                    <a href="javascript:void(0)" onclick="toggleMobileDropdown('portal', this)">
                        🎓 Portal Akademik <span class="arrow">▼</span>
                    </a>
                    <ul id="mobile-portal" class="mobile-dropdown-content">
                        <li><a href="/portal-akademik">👨‍🏫 Data Guru</a></li>
                        <li><a href="/portal-akademik/jurusan">🎯 Kompetensi Keahlian</a></li>
                        <li><a href="/portal-akademik/alumni">🎓 Alumni</a></li>
                        <li><a href="/portal-akademik/ppdb">📝 PPDB Online</a></li>
                    </ul>
                </li>
                
                <li><a href="/join-us">🤝 Join Us</a></li>
                
                <li class="mobile-theme-toggle-wrapper">
                    <span>🌙 Mode Gelap</span>
                    <button id="mobileThemeToggle" title="Toggle Dark Mode" aria-label="Toggle Dark Mode">
                        <div class="theme-toggle-ball">
                            <svg class="sun-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            <svg class="moon-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display: none;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                            </svg>
                        </div>
                    </button>
                </li>
            </ul>
        </div>
    </nav>

    <main style="flex: 1;">
        @yield('content')
    </main>

    <footer class="footer">
        <div class="footer-container">
            <div class="footer-grid">
                <div class="footer-section">
                    <h3>{{ $data['nama_sekolah'] ?? 'SMK Multi Karya Medan' }}</h3>
                    <p>Mewujudkan generasi cerdas, berkarakter, dan siap menghadapi tantangan global melalui pendidikan yang berkualitas dan inovatif.</p>
                    @php
                        $socialMedias = \App\Models\SocialMedia::active()->get();
                    @endphp

                    @if($socialMedias->count() > 0)
                    <div class="social-links">
                        @foreach($socialMedias as $social)
                            <a href="{{ $social->url }}" target="_blank" rel="noopener noreferrer" title="{{ $social->name }}">
                                {!! $social->icon !!}
                            </a>
                        @endforeach
                    </div>
                    @else
                    {{-- Fallback jika belum ada data --}}
                    <div class="social-links">
                        <a href="#" title="Facebook">f</a>
                        <a href="#" title="Instagram">📷</a>
                        <a href="#" title="YouTube">▶</a>
                    </div>
                    @endif
                </div>
                <div class="footer-section">
                    <h3>Link Cepat</h3>
                    <a href="/">Beranda</a>
                    <a href="/berita">Berita</a>
                    <a href="/galeri">Galeri</a>
                    <a href="/profil">Profil</a>
                    <a href="/login">Login Admin</a>
                </div>
                <div class="footer-section">
                    <h3>Hubungi Kami</h3>
                    <p>📍 {{ $data['alamat'] ?? 'Jl. Multi Karya No. 123, Medan' }}</p>
                    <p>📞 {{ $data['telepon'] ?? '(061) 1234567' }}</p>
                    <p>✉️ {{ $data['email'] ?? 'info@sekolah.sch.id' }}</p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} {{ $data['nama_sekolah'] ?? 'SMK Multi Karya Medan' }}. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    {{--  TOMBOL WHATSAPP FLOATING (PREMIUM) --}}
    @php
        $wa = \App\Models\Setting::where('key', 'nomor_whatsapp')->first();
        $rawNumber = $wa ? $wa->value : '6281234567890';
        $nomor = preg_replace('/[^0-9]/', '', $rawNumber);
        if (str_starts_with($nomor, '0')) { $nomor = '62' . substr($nomor, 1); }
        $pesan = urlencode("Halo Admin, saya ingin bertanya mengenai informasi sekolah.");
    @endphp

    @if($nomor)
    <a href="https://wa.me/{{ $nomor }}?text={{ $pesan }}" 
       target="_blank" 
       rel="noopener noreferrer" 
       class="whatsapp-float" 
       aria-label="Chat dengan kami via WhatsApp"
       title="Chat via WhatsApp">
        <span class="wa-tooltip">Chat dengan Kami</span>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="32" height="32" fill="white">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
        </svg>
    </a>

    <style>
        @keyframes slideInRight { from { opacity: 0; transform: translateX(100px) scale(0.8); } to { opacity: 1; transform: translateX(0) scale(1); } }
        @keyframes float { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-8px); } }
        @keyframes pulse-wa { 0%, 100% { box-shadow: 0 4px 15px rgba(37, 211, 102, 0.4); } 50% { box-shadow: 0 4px 25px rgba(37, 211, 102, 0.7), 0 0 0 10px rgba(37, 211, 102, 0.1); } }

        .whatsapp-float {
            position: fixed; bottom: 30px; right: 30px;
            background: linear-gradient(135deg, #25D366 0%, #128C7E 100%);
            width: 60px; height: 60px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 4px 15px rgba(37, 211, 102, 0.4);
            z-index: 9999; transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            animation: slideInRight 0.6s cubic-bezier(0.4, 0, 0.2, 1) 0.5s backwards, float 3s ease-in-out infinite, pulse-wa 2s ease-in-out infinite;
            text-decoration: none; cursor: pointer;
        }
        .whatsapp-float:hover { transform: scale(1.1) translateY(-5px); box-shadow: 0 12px 35px rgba(37, 211, 102, 0.6); animation: float 3s ease-in-out infinite; }
        .whatsapp-float:active { transform: scale(0.95); }
        .whatsapp-float svg { width: 32px; height: 32px; fill: white; filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1)); transition: transform 0.3s; }
        .whatsapp-float:hover svg { transform: scale(1.1); }

        .wa-tooltip {
            position: absolute; right: 75px; background: linear-gradient(135deg, #1D3557 0%, #457B9D 100%);
            color: white; padding: 10px 16px; border-radius: 12px; font-size: 13px; font-weight: 600;
            white-space: nowrap; opacity: 0; visibility: hidden; transform: translateX(15px);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); pointer-events: none; box-shadow: 0 8px 25px rgba(29, 53, 87, 0.3); z-index: 10;
        }
        .wa-tooltip::after {
            content: ''; position: absolute; right: -8px; top: 50%; transform: translateY(-50%);
            border-width: 8px; border-style: solid; border-color: transparent transparent transparent #1D3557;
        }
        .whatsapp-float:hover .wa-tooltip { opacity: 1; visibility: visible; transform: translateX(0); }

        @media (max-width: 768px) {
            .whatsapp-float { bottom: 20px; right: 20px; width: 55px; height: 55px; }
            .whatsapp-float svg { width: 28px; height: 28px; }
            .wa-tooltip { display: none; }
        }
        [data-theme="dark"] .wa-tooltip { background: linear-gradient(135deg, #0F172A 0%, #1E293B 100%); }
        [data-theme="dark"] .wa-tooltip::after { border-color: transparent transparent transparent #0F172A; }
    </style>
    @endif

    <script src="{{ asset('js/dark-mode.js') }}"></script>
    @stack('scripts')
    
    <script>
        // 1. Mobile Menu Toggle
        function toggleMobileMenu() {
            const overlay = document.getElementById('mobileMenuOverlay');
            const icon = document.getElementById('hamburgerIcon');
            
            if (overlay.classList.contains('active')) {
                overlay.classList.remove('active');
                icon.innerHTML = '<line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="18" x2="21" y2="18"></line>';
                document.body.style.overflow = '';
            } else {
                overlay.classList.add('active');
                icon.innerHTML = '<line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line>';
                document.body.style.overflow = 'hidden';
            }
        }

        // 2. Mobile Dropdown Toggle
        function toggleMobileDropdown(menuId, element) {
            const content = document.getElementById('mobile-' + menuId);
            const arrow = element.querySelector('.arrow');
            
            document.querySelectorAll('.mobile-dropdown-content').forEach(el => {
                if (el.id !== 'mobile-' + menuId) {
                    el.classList.remove('active');
                    el.previousElementSibling.querySelector('.arrow').style.transform = 'rotate(0deg)';
                }
            });
            
            content.classList.toggle('active');
            if (content.classList.contains('active')) {
                arrow.style.transform = 'rotate(180deg)';
            } else {
                arrow.style.transform = 'rotate(0deg)';
            }
        }

        // 3. Close mobile menu when clicking outside
        document.addEventListener('click', function(e) {
            const overlay = document.getElementById('mobileMenuOverlay');
            const btn = document.querySelector('.hamburger-btn');
            
            if (overlay.classList.contains('active') && !e.target.closest('.hamburger-btn') && !e.target.closest('.mobile-menu-overlay')) {
                toggleMobileMenu();
            }
        });

        // 4. Close mobile menu on window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768) {
                const overlay = document.getElementById('mobileMenuOverlay');
                if (overlay.classList.contains('active')) {
                    toggleMobileMenu();
                }
            }
        });

        // 5. Theme Toggle - SAMA PERSIS KAYAK ADMIN
        function initThemeToggle(toggleElement) {
            if (!toggleElement) return;
            
            toggleElement.addEventListener('click', function() {
                const html = document.documentElement;
                const currentTheme = html.getAttribute('data-theme');
                const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
                
                html.setAttribute('data-theme', newTheme);
                localStorage.setItem('theme', newTheme);
                
                const sunIcon = this.querySelector('.sun-icon');
                const moonIcon = this.querySelector('.moon-icon');
                if (newTheme === 'dark') {
                    sunIcon.style.display = 'none';
                    moonIcon.style.display = 'block';
                } else {
                    sunIcon.style.display = 'block';
                    moonIcon.style.display = 'none';
                }
            });
        }

        // Initialize both desktop and mobile toggles
        document.addEventListener('DOMContentLoaded', function() {
            const desktopToggle = document.getElementById('themeToggle');
            const mobileToggle = document.getElementById('mobileThemeToggle');
            const currentTheme = localStorage.getItem('theme') || 
                (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
            
            document.documentElement.setAttribute('data-theme', currentTheme);
            
            // Set initial icons
            [desktopToggle, mobileToggle].forEach(toggle => {
                if (toggle) {
                    initThemeToggle(toggle);
                    const sunIcon = toggle.querySelector('.sun-icon');
                    const moonIcon = toggle.querySelector('.moon-icon');
                    if (currentTheme === 'dark') {
                        sunIcon.style.display = 'none';
                        moonIcon.style.display = 'block';
                    }
                }
            });
        });
    </script>
</body>
</html>