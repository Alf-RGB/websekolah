<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Super Admin Panel'); ?></title>
    
    
    <script>
        (function() {
            const theme = localStorage.getItem('theme') || 
                (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
            document.documentElement.setAttribute('data-theme', theme);
        })();
    </script>
    
    <link rel="stylesheet" href="<?php echo e(asset('css/dark-mode.css')); ?>">
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap');

        /* =========================================
           1. CSS VARIABLES & THEME
           ========================================= */
        :root {
            --bg-primary: #F8FAFC;
            --bg-secondary: #FFFFFF;
            --bg-tertiary: #F1F5F9;
            --text-primary: #0F172A;
            --text-secondary: #475569;
            --border-color: #E2E8F0;
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.05);
            --shadow-md: 0 4px 6px -1px rgba(0,0,0,0.1);
            --transition-smooth: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        [data-theme="dark"] {
            --bg-primary: #0F172A;
            --bg-secondary: #1E293B;
            --bg-tertiary: #334155;
            --text-primary: #F1F5F9;
            --text-secondary: #CBD5E1;
            --border-color: #334155;
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.3);
            --shadow-md: 0 4px 6px -1px rgba(0,0,0,0.4);
        }

        /* =========================================
           2. GLOBAL RESET & ANIMATIONS
           ========================================= */
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
        
        a { text-decoration: none; color: inherit; transition: var(--transition-smooth); }

        @keyframes fadeInDown { 
            from { opacity: 0; transform: translateY(-20px); } 
            to { opacity: 1; transform: translateY(0); } 
        }
        @keyframes fadeInUp { 
            from { opacity: 0; transform: translateY(20px); } 
            to { opacity: 1; transform: translateY(0); } 
        }

        /* =========================================
           3. TOPBAR STYLES
           ========================================= */
        .topbar { 
            background: rgba(255, 255, 255, 0.8); 
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            padding: 16px 40px; 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            border-bottom: 1px solid var(--border-color);
            position: sticky; 
            top: 0; 
            z-index: 1000; 
            box-shadow: var(--shadow-sm);
            animation: fadeInDown 0.6s ease-out;
        }

        [data-theme="dark"] .topbar {
            background: rgba(30, 41, 59, 0.8);
        }

        .topbar-brand { 
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 16px; 
            font-weight: 800; 
            color: #7C3AED;
            letter-spacing: -0.5px;
            transition: var(--transition-smooth);
        }
        .topbar-brand:hover { opacity: 0.8; }

        .topbar-brand-icon {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, #7C3AED 0%, #5B21B6 100%);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            box-shadow: 0 4px 12px rgba(124, 58, 237, 0.3);
            transition: var(--transition-smooth);
        }
        .topbar-brand:hover .topbar-brand-icon { transform: scale(1.05) rotate(-5deg); }

        .topbar-right { 
            display: flex; 
            align-items: center; 
            gap: 16px; 
        }

        .user-info { 
            display: flex; 
            align-items: center; 
            gap: 12px; 
            padding: 6px 6px 6px 16px;
            background: var(--bg-tertiary);
            border-radius: 50px; /* Pill shape */
            border: 1px solid var(--border-color);
            transition: var(--transition-smooth);
        }
        .user-info:hover {
            border-color: #7C3AED;
            box-shadow: 0 2px 8px rgba(124, 58, 237, 0.1);
        }

        .user-avatar {
            width: 32px;
            height: 32px;
            background: linear-gradient(135deg, #7C3AED, #5B21B6);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 14px;
            flex-shrink: 0;
        }

        .user-name {
            font-weight: 600;
            font-size: 14px;
            color: var(--text-primary);
        }

        .super-badge { 
            background: linear-gradient(135deg, #7C3AED, #5B21B6); 
            color: white; 
            padding: 4px 10px; 
            border-radius: 20px; 
            font-size: 11px; 
            font-weight: 700; 
            letter-spacing: 0.3px;
            box-shadow: 0 2px 6px rgba(124, 58, 237, 0.3);
        }

        .btn-logout { 
            background: #FEE2E2; 
            color: #991B1B; 
            padding: 8px 16px; 
            border-radius: 10px; 
            border: 1px solid transparent;
            cursor: pointer; 
            font-size: 13px; 
            font-weight: 600; 
            font-family: 'Inter', sans-serif;
            transition: var(--transition-smooth);
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .btn-logout:hover { 
            background: #991B1B; 
            color: white; 
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
        }
        .btn-logout:active {
            transform: translateY(0) scale(0.95);
        }

        /* =========================================
           4. MAIN CONTENT
           ========================================= */
        .main-content { 
            padding: 40px; 
            max-width: 1400px; 
            margin: 0 auto; 
            width: 100%;
            flex: 1;
            animation: fadeInUp 0.6s ease-out 0.1s backwards;
        }

        /* =========================================
           5. THEME TOGGLE - Modern Pill Design
           ========================================= */
        .theme-toggle {
            width: 56px;
            height: 30px;
            border-radius: 15px;
            border: none;
            background: var(--bg-tertiary);
            cursor: pointer;
            position: relative;
            transition: var(--transition-smooth);
            box-shadow: inset 0 2px 4px rgba(0,0,0,0.1);
            flex-shrink: 0;
        }
        .theme-toggle::before {
            content: '☀️';
            position: absolute;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: white;
            top: 3px;
            left: 3px;
            transition: var(--transition-smooth);
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            z-index: 2;
        }
        [data-theme="dark"] .theme-toggle { background: #334155; }
        [data-theme="dark"] .theme-toggle::before {
            left: 29px;
            content: '🌙';
        }
        .theme-toggle:hover { transform: scale(1.05); }
        .theme-toggle:active { transform: scale(0.95); }

        /* =========================================
           6. RESPONSIVE DESIGN
           ========================================= */
        @media (max-width: 768px) {
            .topbar { padding: 12px 20px; }
            .main-content { padding: 20px; }
            .user-name { display: none; }
            .user-info { padding: 4px 4px 4px 12px; }
            .super-badge { font-size: 10px; padding: 3px 8px; }
            
            .theme-toggle {
                width: 50px;
                height: 28px;
            }
            .theme-toggle::before {
                width: 22px;
                height: 22px;
                font-size: 12px;
            }
            [data-theme="dark"] .theme-toggle::before {
                left: 25px;
            }
            
            .btn-logout span { display: none; } /* Hide text, keep icon if added */
            .btn-logout { padding: 8px 12px; }
        }
    </style>
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>
    <nav class="topbar">
        <a href="/superadmin/dashboard" class="topbar-brand">
            <div class="topbar-brand-icon">🚀</div>
            <span>SUPER ADMIN</span>
        </a>
        
        <div class="topbar-right">
            
            <button class="theme-toggle" id="themeToggle" title="Toggle Dark Mode" aria-label="Toggle Dark Mode"></button>
            
            <div class="user-info">
                <div class="user-avatar"><?php echo e(strtoupper(substr(Auth::user()->name ?? 'A', 0, 1))); ?></div>
                <span class="user-name"><?php echo e(Auth::user()->name ?? 'Admin'); ?></span>
                <span class="super-badge">Super</span>
            </div>
            
            <form action="/logout" method="POST" style="margin: 0;">
                <?php echo csrf_field(); ?>
                <button type="submit" class="btn-logout" title="Keluar dari sistem">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                        <polyline points="16 17 21 12 16 7"></polyline>
                        <line x1="21" y1="12" x2="9" y2="12"></line>
                    </svg>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </nav>
    
    <main class="main-content">
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <script>
        // Theme Toggle Logic (Consolidated)
        document.getElementById('themeToggle').addEventListener('click', function() {
            const currentTheme = document.documentElement.getAttribute('data-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            
            document.documentElement.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
        });
    </script>
    
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html><?php /**PATH C:\laragon\www\sekolah-app-v2\resources\views/layouts/superadmin.blade.php ENDPATH**/ ?>