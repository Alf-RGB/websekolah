<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <title><?php echo $__env->yieldContent('title', 'Admin Dashboard'); ?></title>
    
    
    <script>
        (function() {
            const theme = localStorage.getItem('theme') || 
                (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
            document.documentElement.setAttribute('data-theme', theme);
        })();
    </script>
    
    <link rel="stylesheet" href="<?php echo e(asset('css/dark-mode.css')); ?>">
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');

        :root {
            --bg-primary: #F8FAFC;
            --bg-secondary: #FFFFFF;
            --bg-tertiary: #F1F5F9;
            --text-primary: #0F172A;
            --text-secondary: #475569;
            --text-muted: #94A3B8;
            --border-color: #E2E8F0;
            
            --sidebar-bg: #0F172A;
            --sidebar-border: rgba(255, 255, 255, 0.06);
            --sidebar-hover: rgba(255, 255, 255, 0.05);
            --sidebar-active: rgba(99, 102, 241, 0.15);
            --sidebar-text: #94A3B8;
            --sidebar-text-active: #F8FAFC;
            
            --topbar-bg: rgba(255, 255, 255, 0.95);
            --shadow-sm: 0 1px 2px rgba(0,0,0,0.05);
            --shadow-md: 0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -1px rgba(0,0,0,0.03);
            --shadow-lg: 0 10px 15px -3px rgba(0,0,0,0.05), 0 4px 6px -2px rgba(0,0,0,0.025);
            --transition-smooth: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            --transition-bounce: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        [data-theme="dark"] {
            --bg-primary: #020617;
            --bg-secondary: #0F172A;
            --bg-tertiary: #1E293B;
            --text-primary: #F1F5F9;
            --text-secondary: #CBD5E1;
            --text-muted: #64748B;
            --border-color: #1E293B;
            
            --sidebar-bg: #0F172A;
            --topbar-bg: rgba(15, 23, 42, 0.95);
            --shadow-sm: 0 1px 2px rgba(0,0,0,0.3);
            --shadow-md: 0 4px 6px -1px rgba(0,0,0,0.4);
            --shadow-lg: 0 10px 15px -3px rgba(0,0,0,0.5);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body { 
            font-family: 'Inter', sans-serif; 
            background: var(--bg-primary); 
            color: var(--text-primary); 
            line-height: 1.6; 
            font-size: 15px;
            transition: background-color 0.3s ease, color 0.3s ease;
            overflow-x: hidden;
        }
        
        a { text-decoration: none; color: inherit; transition: var(--transition-smooth); }

        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        @keyframes slideInLeft { from { opacity: 0; transform: translateX(-20px); } to { opacity: 1; transform: translateX(0); } }
        @keyframes slideInDown { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }

        /* =========================================
           SIDEBAR STYLES
           ========================================= */
        .admin-sidebar { 
            width: 270px; 
            background: var(--sidebar-bg); 
            display: flex; 
            flex-direction: column; 
            position: fixed; 
            height: 100vh;
            height: 100dvh;
            overflow-y: auto; 
            overflow-x: hidden;
            z-index: 1000;
            border-right: 1px solid var(--sidebar-border);
            transition: width 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            animation: slideInLeft 0.5s ease-out;
        }
        
        .admin-sidebar::-webkit-scrollbar { width: 4px; }
        .admin-sidebar::-webkit-scrollbar-track { background: transparent; }
        .admin-sidebar::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 4px; }
        .admin-sidebar::-webkit-scrollbar-thumb:hover { background: rgba(255,255,255,0.2); }

        .admin-sidebar.collapsed { width: 80px; }

        .admin-sidebar-header { 
            padding: 20px; 
            border-bottom: 1px solid var(--sidebar-border); 
            display: flex; 
            align-items: center; 
            justify-content: space-between; 
            gap: 12px;
            transition: padding 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            min-height: 80px;
        }
        
        .admin-sidebar.collapsed .admin-sidebar-header { 
            padding: 20px 16px; 
            justify-content: center; 
        }
        
        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            flex: 1;
            overflow: hidden;
        }
        
        .sidebar-brand-icon {
            width: 32px;
            height: 32px;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
        }
        .sidebar-brand-icon svg {
            width: 18px;
            height: 18px;
            color: white;
        }
        
        .admin-sidebar-title { 
            font-weight: 800; 
            font-size: 14px; 
            letter-spacing: 0.5px;
            color: var(--sidebar-text-active);
            white-space: nowrap; 
            overflow: hidden; 
            transition: opacity 0.3s, width 0.3s;
        }
        
        .admin-sidebar.collapsed .sidebar-brand { 
            display: none;
        }

        .sidebar-toggle {
            background: var(--sidebar-hover); 
            border: 1px solid var(--sidebar-border); 
            width: 32px; 
            height: 32px;
            border-radius: 8px; 
            cursor: pointer; 
            display: flex; 
            align-items: center; 
            justify-content: center;
            transition: var(--transition-smooth); 
            color: var(--sidebar-text); 
            flex-shrink: 0; 
        }
        .sidebar-toggle:hover { background: rgba(255,255,255,0.1); color: var(--sidebar-text-active); }
        .sidebar-toggle svg { width: 18px; height: 18px; }
        
        .admin-sidebar.collapsed .sidebar-toggle {
            display: none;
        }

        .sidebar-toggle-collapsed {
            display: none;
            background: var(--sidebar-hover); 
            border: 1px solid var(--sidebar-border); 
            width: 40px; 
            height: 40px;
            border-radius: 10px; 
            cursor: pointer; 
            align-items: center; 
            justify-content: center;
            transition: var(--transition-smooth); 
            color: var(--sidebar-text); 
        }
        .sidebar-toggle-collapsed:hover { 
            background: rgba(255,255,255,0.1); 
            color: var(--sidebar-text-active);
            transform: scale(1.1);
        }
        .sidebar-toggle-collapsed svg { width: 20px; height: 20px; }
        
        .admin-sidebar.collapsed .sidebar-toggle-collapsed {
            display: flex;
        }

        .admin-menu { list-style: none; padding: 16px 12px; flex: 1; }
        .admin-menu-item { margin-bottom: 4px; position: relative; }
        
        .admin-menu-link { 
            display: flex; 
            align-items: center; 
            gap: 14px; 
            padding: 11px 16px; 
            color: var(--sidebar-text); 
            font-size: 14px; 
            font-weight: 500; 
            transition: var(--transition-smooth);
            border-radius: 10px;
            white-space: nowrap; 
            overflow: hidden;
            position: relative;
        }
        
        .admin-menu-link:hover { 
            background: var(--sidebar-hover); 
            color: var(--sidebar-text-active); 
        }
        
        .admin-menu-link.active { 
            background: var(--sidebar-active); 
            color: #818CF8;
            font-weight: 600;
        }

        .menu-icon { 
            display: flex;
            align-items: center;
            justify-content: center;
            width: 20px; 
            flex-shrink: 0; 
            transition: transform 0.3s; 
        }
        .menu-icon svg { width: 20px; height: 20px; stroke-width: 1.5; }
        .admin-menu-link:hover .menu-icon { transform: scale(1.1); }
        
        .admin-sidebar.collapsed .admin-menu-link { 
            padding: 11px 0; 
            justify-content: center; 
        }
        .admin-sidebar.collapsed .menu-text { display: none; }
        .admin-sidebar.collapsed .menu-icon { margin: 0; }

        .has-submenu > .admin-menu-link .chevron {
            margin-left: auto;
            width: 16px;
            height: 16px;
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .has-submenu.submenu-open > .admin-menu-link .chevron { transform: rotate(90deg); }
        .admin-sidebar.collapsed .has-submenu > .admin-menu-link .chevron { display: none; }

        .admin-submenu { 
            list-style: none; 
            max-height: 0; 
            overflow: hidden; 
            transition: max-height 0.4s cubic-bezier(0.4, 0, 0.2, 1); 
            padding-left: 16px;
        }
        .admin-menu-item.submenu-open .admin-submenu { max-height: 200px; }
        
        .admin-submenu .admin-menu-link { 
            padding: 9px 16px 9px 48px; 
            font-size: 13px; 
            color: var(--sidebar-text);
            border-radius: 8px;
        }
        .admin-submenu .admin-menu-link:hover { 
            background: rgba(255,255,255,0.03); 
            color: var(--sidebar-text-active); 
        }
        .admin-submenu .admin-menu-link.active {
            color: #818CF8;
            background: rgba(99, 102, 241, 0.1);
        }
        .admin-sidebar.collapsed .admin-submenu { display: none !important; }

        /* =========================================
           MAIN CONTENT & TOPBAR
           ========================================= */
        .admin-main { 
            flex: 1; 
            margin-left: 270px; 
            display: flex; 
            flex-direction: column; 
            transition: margin-left 0.4s cubic-bezier(0.4, 0, 0.2, 1), width 0.4s cubic-bezier(0.4, 0, 0.2, 1); 
            min-width: 0;
            width: calc(100% - 270px);
        }
        
        .admin-sidebar.collapsed + .admin-main { margin-left: 80px; width: calc(100% - 80px); }

        .admin-topbar { 
            background: var(--topbar-bg); 
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            padding: 0;
            border-bottom: 1px solid var(--border-color);
            position: sticky; 
            top: 0; 
            z-index: 100;
            animation: slideInDown 0.5s ease-out;
        }

        .topbar-inner {
            max-width: 1400px;
            margin: 0 auto;
            padding: 16px 32px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
        }

        .topbar-left, .topbar-right {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .admin-content { 
            padding: 32px; 
            flex: 1; 
            max-width: 1400px; 
            margin: 0 auto; 
            width: 100%; 
            animation: fadeInUp 0.6s ease-out 0.1s backwards;
        }

        .school-name {
            font-weight: 800;
            font-size: 16px;
            color: var(--text-primary);
            letter-spacing: 0.3px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .school-name svg { width: 24px; height: 24px; color: #6366f1; }

        .user-greeting {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 8px 16px;
            background: var(--bg-tertiary);
            border-radius: 10px;
            border: 1px solid var(--border-color);
        }
        .user-greeting svg { width: 18px; height: 18px; color: var(--text-muted); }
        .user-name { font-weight: 600; font-size: 14px; color: var(--text-primary); }

        .admin-topbar .btn-see-website,
        .admin-topbar .btn-logout {
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 8px;
            height: 40px !important;
            padding: 0 18px !important;
            border-radius: 10px !important;
            font-size: 13px !important;
            font-weight: 600 !important;
            text-decoration: none !important;
            white-space: nowrap !important;
            transition: var(--transition-smooth) !important;
            border: 1px solid transparent !important;
            cursor: pointer !important;
        }

        .admin-topbar .btn-see-website {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%) !important;
            color: #ffffff !important;
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.25);
        }
        .admin-topbar .btn-see-website:hover { 
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(99, 102, 241, 0.35) !important;
        }
        .admin-topbar .btn-see-website svg { width: 16px; height: 16px; }

        .admin-topbar .btn-logout { 
            background: rgba(239, 68, 68, 0.1) !important; 
            color: #EF4444 !important; 
            border-color: rgba(239, 68, 68, 0.2) !important;
        }
        .admin-topbar .btn-logout:hover { 
            background: rgba(239, 68, 68, 0.15) !important; 
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.15) !important;
        }
        .admin-topbar .btn-logout svg { width: 16px; height: 16px; }

        /* =========================================
           THEME TOGGLE - ULTRA SIMPLE & OVERRIDE ALL
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
        
        /* HAPUS SEMUA PSEUDO-ELEMENT YANG MUNGKIN DARI dark-mode.css */
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

        .package-badge {
            background: linear-gradient(135deg, #F59E0B, #D97706);
            color: white;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 2px 6px rgba(245, 158, 11, 0.25);
        }

        .admin-hamburger {
            display: none;
            background: transparent;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            width: 40px;
            height: 40px;
            cursor: pointer;
            color: var(--text-primary);
            align-items: center;
            justify-content: center;
            transition: var(--transition-smooth);
        }
        .admin-hamburger:hover { background: var(--bg-tertiary); }
        .admin-hamburger svg { width: 20px; height: 20px; }

        .sidebar-overlay {
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0,0,0,0.6);
            backdrop-filter: blur(4px);
            z-index: 998;
            opacity: 0;
            visibility: hidden;
            transition: var(--transition-smooth);
        }
        .sidebar-overlay.active { opacity: 1; visibility: visible; }

        @media (max-width: 1024px) {
            .admin-sidebar {
                transform: translateX(-100%);
                width: 280px !important;
                transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                box-shadow: 10px 0 30px rgba(0,0,0,0.3);
            }
            .admin-sidebar.mobile-open { transform: translateX(0); }
            .admin-sidebar.collapsed { width: 280px !important; }
            
            .admin-main { margin-left: 0 !important; width: 100% !important; }
            .admin-sidebar.collapsed + .admin-main { margin-left: 0 !important; width: 100% !important; }
            
            .admin-hamburger { display: flex; }
            .sidebar-toggle { display: none; }
            .sidebar-toggle-collapsed { display: none !important; }
            
            .topbar-inner { padding: 12px 20px; }
            .user-name { display: none; }
            .user-greeting { padding: 8px 12px; }
            
            .btn-see-website .btn-text { display: none; }
            .btn-see-website { padding: 0 12px !important; }
            
            .admin-content { padding: 20px; }
        }

        input, textarea, select {
            background: var(--bg-secondary);
            color: var(--text-primary);
            border: 1px solid var(--border-color);
            transition: var(--transition-smooth);
        }
        input:focus, textarea:focus, select:focus {
            outline: none;
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }
        
        .badge, .status-badge, [class*="badge-"], .label, [class*="label-"] {
            color: white !important;
            font-weight: 600 !important;
            text-shadow: 0 1px 2px rgba(0,0,0,0.15) !important;
        }
        .badge-success, .bg-success { background: linear-gradient(135deg, #10B981, #059669) !important; }
        .badge-warning, .bg-warning { background: linear-gradient(135deg, #F59E0B, #D97706) !important; }
        .badge-danger, .bg-danger { background: linear-gradient(135deg, #EF4444, #DC2626) !important; }
        .badge-info, .bg-info { background: linear-gradient(135deg, #3B82F6, #2563EB) !important; }
    </style>
    
    <link rel="stylesheet" href="<?php echo e(asset('css/admin-components.css')); ?>">
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>

    <?php
        $settings = \App\Models\Setting::whereIn('key', ['nama_sekolah', 'logo_sekolah', 'package_level'])->pluck('value', 'key');
        $namaSekolah = $settings['nama_sekolah'] ?? 'Panel Admin';
        $packageLevel = $settings['package_level'] ?? 'full';
        
        $featuresMap = [
            'easy'   => ['profil', 'berita', 'galeri'],
            'medium' => ['profil', 'berita', 'galeri', 'guru', 'lamaran', 'jurusan', 'ppdb'],
            'full'   => ['profil', 'berita', 'galeri', 'guru', 'lamaran', 'jurusan', 'ppdb', 'alumni'],
        ];
        $activeFeatures = $featuresMap[$packageLevel] ?? $featuresMap['full'];
    ?>

    <div class="sidebar-overlay" id="sidebarOverlay" onclick="closeMobileSidebar()"></div>

    <div class="admin-wrapper" style="display: flex; min-height: 100vh;">
        <aside class="admin-sidebar" id="adminSidebar">
            <div class="admin-sidebar-header">
                <div class="sidebar-brand">
                    <div class="sidebar-brand-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <span class="admin-sidebar-title">ADMIN PANEL</span>
                </div>
                
                <button onclick="handleSidebarClose()" class="sidebar-toggle" title="Collapse Sidebar" aria-label="Collapse Sidebar">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
                    </svg>
                </button>
                
                <button onclick="handleSidebarClose()" class="sidebar-toggle-collapsed" title="Expand Sidebar" aria-label="Expand Sidebar">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
            
            <ul class="admin-menu">
                <li class="admin-menu-item">
                    <a href="/admin/dashboard" class="admin-menu-link <?php echo e(request()->is('admin/dashboard') ? 'active' : ''); ?>">
                        <span class="menu-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>
                        </span>
                        <span class="menu-text">Dashboard</span>
                    </a>
                </li>

                <?php if(in_array('profil', $activeFeatures)): ?>
                <li class="admin-menu-item">
                    <a href="/admin/pages" class="admin-menu-link <?php echo e(request()->is('admin/pages*') ? 'active' : ''); ?>">
                        <span class="menu-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                        </span>
                        <span class="menu-text">Profil Sekolah</span>
                    </a>
                </li>
                <?php endif; ?>

                <?php if(in_array('berita', $activeFeatures)): ?>
                <li class="admin-menu-item">
                    <a href="/admin/posts" class="admin-menu-link <?php echo e(request()->is('admin/posts*') ? 'active' : ''); ?>">
                        <span class="menu-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" /></svg>
                        </span>
                        <span class="menu-text">Berita & Artikel</span>
                    </a>
                </li>
                <?php endif; ?>

                <?php if(in_array('galeri', $activeFeatures)): ?>
                <li class="admin-menu-item">
                    <a href="/admin/galleries" class="admin-menu-link <?php echo e(request()->is('admin/galleries*') ? 'active' : ''); ?>">
                        <span class="menu-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                        </span>
                        <span class="menu-text">Galeri Foto</span>
                    </a>
                </li>
                <?php endif; ?>

                <?php if(in_array('guru', $activeFeatures) || in_array('lamaran', $activeFeatures)): ?>
                <li class="admin-menu-item has-submenu">
                    <a href="javascript:void(0)" class="admin-menu-link">
                        <span class="menu-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                        </span>
                        <span class="menu-text">Guru & Portal</span>
                        <svg class="chevron" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                    </a>
                    <ul class="admin-submenu">
                        <?php if(in_array('guru', $activeFeatures)): ?>
                        <li><a href="/admin/guru" class="admin-menu-link <?php echo e(request()->is('admin/guru*') ? 'active' : ''); ?>">Data Guru</a></li>
                        <?php endif; ?>
                        <?php if(in_array('lamaran', $activeFeatures)): ?>
                        <li><a href="/admin/lamaran" class="admin-menu-link <?php echo e(request()->is('admin/lamaran*') ? 'active' : ''); ?>">Lamaran Guru</a></li>
                        <?php endif; ?>
                    </ul>
                </li>
                <?php endif; ?>

                <?php if(in_array('jurusan', $activeFeatures)): ?>
                <li class="admin-menu-item">
                    <a href="/admin/kompetensi" class="admin-menu-link <?php echo e(request()->is('admin/kompetensi*') ? 'active' : ''); ?>">
                        <span class="menu-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" /></svg>
                        </span>
                        <span class="menu-text">Kompetensi Keahlian</span>
                    </a>
                </li>
                <?php endif; ?>

                <?php if(in_array('ppdb', $activeFeatures)): ?>
                <li class="admin-menu-item">
                    <a href="/admin/pendaftar" class="admin-menu-link <?php echo e(request()->is('admin/pendaftar*') ? 'active' : ''); ?>">
                        <span class="menu-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" /></svg>
                        </span>
                        <span class="menu-text">Pendaftar PPDB</span>
                    </a>
                </li>
                <?php endif; ?>

                <?php if(in_array('alumni', $activeFeatures)): ?>
                <li class="admin-menu-item">
                    <a href="/admin/alumni" class="admin-menu-link <?php echo e(request()->is('admin/alumni*') ? 'active' : ''); ?>">
                        <span class="menu-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 14l9-5-9-5-9 5 9 5z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" /></svg>
                        </span>
                        <span class="menu-text">Alumni</span>
                    </a>
                </li>
                <?php endif; ?>

                <li class="admin-menu-item">
                    <a href="/admin/settings" class="admin-menu-link <?php echo e(request()->is('admin/settings*') ? 'active' : ''); ?>">
                        <span class="menu-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                        </span>
                        <span class="menu-text">Identitas Sekolah</span>
                    </a>
                </li>
            </ul>
        </aside>

        <div class="admin-main">
            <div class="admin-topbar">
                <div class="topbar-inner">
                    <div class="topbar-left">
                        <button class="admin-hamburger" onclick="openMobileSidebar()" aria-label="Open Menu">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                        
                        <div class="school-name">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            <?php echo e(strtoupper($namaSekolah)); ?>

                        </div>
                    </div>
                    
                    <div class="topbar-right">
                        <div class="user-greeting">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <span class="user-name">Halo, <?php echo e(Auth::user()->name); ?></span>
                            <span class="package-badge"><?php echo e(strtoupper($packageLevel)); ?></span>
                        </div>
                        
                        
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
                        
                        <a href="/" class="btn-see-website" title="Lihat Website Publik">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg>
                            <span class="btn-text">Lihat Website</span>
                        </a>
                        
                        <form action="/logout" method="POST" style="margin: 0; display: inline-flex;">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn-logout" title="Keluar">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                                <span class="btn-text">Logout</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            
            <main class="admin-content">
                <?php echo $__env->yieldContent('content'); ?>
            </main>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('adminSidebar');
            sidebar.classList.toggle('collapsed');
            
            if (sidebar.classList.contains('collapsed')) {
                document.querySelectorAll('.admin-menu-item.submenu-open').forEach(item => item.classList.remove('submenu-open'));
                localStorage.setItem('sidebarCollapsed', 'true');
            } else {
                localStorage.setItem('sidebarCollapsed', 'false');
            }
        }

        function openMobileSidebar() {
            document.getElementById('adminSidebar').classList.add('mobile-open');
            document.getElementById('sidebarOverlay').classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeMobileSidebar() {
            document.getElementById('adminSidebar').classList.remove('mobile-open');
            document.getElementById('sidebarOverlay').classList.remove('active');
            document.body.style.overflow = '';
        }

        function handleSidebarClose() {
            if (window.innerWidth <= 1024) {
                closeMobileSidebar();
            } else {
                toggleSidebar();
            }
        }

        // Theme Toggle
        document.getElementById('themeToggle').addEventListener('click', function() {
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

        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('adminSidebar');
            const currentTheme = document.documentElement.getAttribute('data-theme');
            const themeToggle = document.getElementById('themeToggle');
            const sunIcon = themeToggle.querySelector('.sun-icon');
            const moonIcon = themeToggle.querySelector('.moon-icon');
            
            if (currentTheme === 'dark') {
                sunIcon.style.display = 'none';
                moonIcon.style.display = 'block';
            }

            if (localStorage.getItem('sidebarCollapsed') === 'true' && window.innerWidth > 1024) {
                sidebar.classList.add('collapsed');
            }

            document.querySelectorAll('.has-submenu > .admin-menu-link').forEach(menuLink => {
                menuLink.addEventListener('click', function(e) {
                    e.preventDefault();
                    if (sidebar.classList.contains('collapsed')) return;
                    
                    const parentItem = this.parentElement;
                    const isOpen = parentItem.classList.contains('submenu-open');
                    
                    document.querySelectorAll('.admin-menu-item.submenu-open').forEach(item => {
                        if (item !== parentItem) item.classList.remove('submenu-open');
                    });
                    
                    parentItem.classList.toggle('submenu-open', !isOpen);
                });
            });

            document.querySelectorAll('.admin-menu-link').forEach(link => {
                link.addEventListener('click', function() {
                    if (window.innerWidth <= 1024 && !this.parentElement.classList.contains('has-submenu')) {
                        setTimeout(closeMobileSidebar, 150);
                    }
                });
            });

            document.addEventListener('click', function(e) {
                if (!e.target.closest('.admin-sidebar')) {
                    document.querySelectorAll('.admin-menu-item.submenu-open').forEach(item => {
                        item.classList.remove('submenu-open');
                    });
                }
            });
        });

        window.addEventListener('resize', function() {
            if (window.innerWidth > 1024) {
                closeMobileSidebar();
            }
        });
    </script>
    
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html><?php /**PATH C:\laragon\www\sekolah-app-v2\resources\views/layouts/admin.blade.php ENDPATH**/ ?>