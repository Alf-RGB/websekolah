<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Guru - Portal Akademik</title>
    
    {{-- 🚨 ANTI-FLASH: Apply theme BEFORE rendering --}}
    <script>
        (function() {
            const theme = localStorage.getItem('theme') || 
                (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
            document.documentElement.setAttribute('data-theme', theme);
        })();
    </script>
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');

        /* =========================================
           1. CSS VARIABLES & THEME
           ========================================= */
        :root {
            --bg-primary: #F8FAFC;
            --bg-secondary: #FFFFFF;
            --text-primary: #0F172A;
            --text-secondary: #475569;
            --text-muted: #94A3B8;
            --border-color: #E2E8F0;
            --accent-color: #10B981;
            --accent-hover: #059669;
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.05);
            --shadow-md: 0 4px 6px -1px rgba(0,0,0,0.1);
            --shadow-lg: 0 10px 15px -3px rgba(0,0,0,0.1);
            --shadow-xl: 0 20px 25px -5px rgba(0,0,0,0.1), 0 10px 10px -5px rgba(0,0,0,0.04);
            --transition-smooth: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        [data-theme="dark"] {
            --bg-primary: #0F172A;
            --bg-secondary: #1E293B;
            --text-primary: #F1F5F9;
            --text-secondary: #CBD5E1;
            --text-muted: #94A3B8;
            --border-color: #334155;
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.3);
            --shadow-md: 0 4px 6px -1px rgba(0,0,0,0.4);
            --shadow-lg: 0 10px 15px -3px rgba(0,0,0,0.5);
            --shadow-xl: 0 20px 25px -5px rgba(0,0,0,0.5), 0 10px 10px -5px rgba(0,0,0,0.3);
        }

        /* =========================================
           2. GLOBAL RESET & ANIMATIONS
           ========================================= */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body { 
            font-family: 'Inter', sans-serif; 
            background: var(--bg-primary); 
            color: var(--text-primary); 
            display: flex; 
            justify-content: center; 
            align-items: center; 
            min-height: 100vh; 
            position: relative; 
            padding: 20px;
            transition: background-color 0.3s ease, color 0.3s ease;
            overflow-x: hidden;
        }

        /* Subtle animated background pattern */
        body::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background-image: 
                radial-gradient(circle at 20% 50%, rgba(16, 185, 129, 0.05) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(59, 130, 246, 0.05) 0%, transparent 50%);
            z-index: -1;
            animation: bgPulse 10s ease-in-out infinite alternate;
        }
        @keyframes bgPulse {
            0% { transform: scale(1); }
            100% { transform: scale(1.1); }
        }

        @keyframes fadeInDown { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes slideIn { from { opacity: 0; transform: scale(0.96) translateY(20px); } to { opacity: 1; transform: scale(1) translateY(0); } }

        /* =========================================
           3. BACK BUTTON
           ========================================= */
        .back-btn {
            position: absolute; 
            top: 30px; 
            right: 40px;
            background: var(--bg-secondary); 
            color: var(--text-primary); 
            padding: 10px 20px;
            border-radius: 50px; 
            text-decoration: none; 
            font-weight: 600; 
            font-size: 14px;
            box-shadow: var(--shadow-md); 
            transition: var(--transition-smooth);
            display: flex; 
            align-items: center; 
            gap: 8px; 
            border: 1px solid var(--border-color);
            z-index: 10;
            animation: fadeInDown 0.6s ease-out;
        }
        .back-btn:hover { 
            background: var(--accent-color); 
            color: white; 
            transform: translateY(-2px) translateX(-3px); 
            box-shadow: var(--shadow-lg);
            border-color: var(--accent-color);
        }
        .back-btn:active { transform: translateY(0) translateX(-3px) scale(0.98); }

        /* =========================================
           4. LOGIN CONTAINER
           ========================================= */
        .login-container {
            background: var(--bg-secondary); 
            width: 100%; 
            max-width: 440px;
            padding: 50px 40px; 
            border-radius: 24px;
            box-shadow: var(--shadow-xl);
            border: 1px solid var(--border-color);
            position: relative;
            animation: slideIn 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .login-header { 
            text-align: center; 
            margin-bottom: 35px; 
            animation: fadeInUp 0.6s ease-out 0.1s backwards;
        }
        .login-header .icon { 
            font-size: 40px; 
            width: 90px; 
            height: 90px; 
            margin: 0 auto 20px;
            background: linear-gradient(135deg, var(--accent-color) 0%, var(--accent-hover) 100%);
            border-radius: 50%; 
            display: flex; 
            align-items: center; 
            justify-content: center;
            box-shadow: 0 10px 25px rgba(16, 185, 129, 0.3);
            transition: var(--transition-smooth);
        }
        .login-container:hover .login-header .icon {
            transform: scale(1.05) rotate(-5deg);
        }
        .login-header h2 { 
            color: var(--text-primary); 
            font-size: 28px; 
            margin-bottom: 8px; 
            font-weight: 800; 
            letter-spacing: -0.5px;
        }
        .login-header p { 
            color: var(--text-secondary); 
            font-size: 14px; 
        }
        
        /* =========================================
           5. FORM ELEMENTS
           ========================================= */
        .form-group { 
            margin-bottom: 20px; 
            animation: fadeInUp 0.5s ease-out backwards;
        }
        .form-group:nth-child(1) { animation-delay: 0.2s; }
        .form-group:nth-child(2) { animation-delay: 0.25s; }

        .form-group label { 
            display: block; 
            color: var(--text-primary); 
            font-weight: 600; 
            margin-bottom: 8px; 
            font-size: 14px; 
        }
        .form-group input {
            width: 100%; 
            padding: 14px 16px; 
            border: 2px solid var(--border-color);
            border-radius: 12px; 
            font-size: 15px; 
            transition: var(--transition-smooth); 
            outline: none;
            background: var(--bg-primary);
            color: var(--text-primary);
        }
        .form-group input:focus { 
            border-color: var(--accent-color); 
            background: var(--bg-secondary); 
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1); 
            transform: translateY(-2px);
        }
        .form-group input::placeholder {
            color: var(--text-muted);
        }
        
        .btn-login {
            width: 100%; 
            background: linear-gradient(135deg, var(--accent-color) 0%, var(--accent-hover) 100%); 
            color: white; 
            padding: 14px;
            border: none; 
            border-radius: 12px; 
            font-size: 16px; 
            font-weight: 700;
            cursor: pointer; 
            transition: var(--transition-smooth); 
            margin-top: 10px; 
            letter-spacing: 0.5px;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
            animation: fadeInUp 0.5s ease-out 0.3s backwards;
        }
        .btn-login:hover { 
            transform: translateY(-3px); 
            box-shadow: 0 8px 25px rgba(16, 185, 129, 0.4); 
        }
        .btn-login:active { transform: translateY(0) scale(0.98); }
        .btn-login:disabled { 
            background: var(--text-muted); 
            cursor: not-allowed; 
            transform: none; 
            box-shadow: none;
        }
        
        /* =========================================
           6. ALERTS & FOOTER
           ========================================= */
        .alert { 
            padding: 14px 16px; 
            border-radius: 12px; 
            margin-bottom: 25px; 
            font-size: 14px; 
            display: flex; 
            align-items: flex-start; 
            gap: 10px; 
            animation: slideIn 0.5s ease-out;
        }
        .alert-danger { 
            background: linear-gradient(135deg, #FEE2E2 0%, #FECACA 100%); 
            color: #991B1B; 
            border: 1px solid #FECACA; 
        }
        .alert-success { 
            background: linear-gradient(135deg, #D1FAE5 0%, #A7F3D0 100%); 
            color: #065F46; 
            border: 1px solid #A7F3D0; 
        }
        [data-theme="dark"] .alert-danger {
            background: linear-gradient(135deg, #7F1D1D 0%, #991B1B 100%) !important;
            color: #FCA5A5 !important;
            border-color: #991B1B !important;
        }
        [data-theme="dark"] .alert-success {
            background: linear-gradient(135deg, #064E3B 0%, #065F46 100%) !important;
            color: #6EE7B7 !important;
            border-color: #065F46 !important;
        }
        
        .footer-text { 
            text-align: center; 
            margin-top: 30px; 
            padding-top: 20px; 
            border-top: 1px solid var(--border-color); 
            font-size: 13px; 
            color: var(--text-secondary); 
            line-height: 1.6; 
            animation: fadeInUp 0.5s ease-out 0.35s backwards;
        }
        .footer-text strong { 
            color: var(--accent-color); 
        }

        /* =========================================
           7. RESPONSIVE
           ========================================= */
        @media (max-width: 480px) {
            .login-container { padding: 40px 25px; }
            .back-btn { 
                top: 15px; 
                right: 15px; 
                padding: 8px 14px; 
                font-size: 13px; 
            }
            .back-btn span { display: none; } /* Hide arrow on very small screens to save space */
            .login-header .icon { width: 75px; height: 75px; font-size: 32px; }
            .login-header h2 { font-size: 24px; }
        }
    </style>
</head>
<body>

    {{-- TOMBOL KEMBALI KE WEBSITE --}}
    <a href="/" class="back-btn">
        <span>←</span> Kembali ke Website
    </a>

    <div class="login-container">
        <div class="login-header">
            <div class="icon">👨‍🏫</div>
            <h2>Portal Guru</h2>
            <p>Masuk untuk mengelola profil dan materi ajar</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                <span style="font-size: 18px; flex-shrink: 0;">✅</span> 
                <div>{{ session('success') }}</div>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <span style="font-size: 18px; flex-shrink: 0;">⚠️</span>
                <div style="flex: 1;">
                    @foreach($errors->all() as $error)
                        <p style="margin: 0 0 4px 0;">{{ $error }}</p>
                    @endforeach
                </div>
            </div>
        @endif

        <form action="/portal/login" method="POST" id="loginForm">
            @csrf
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" value="{{ old('username') }}" required autofocus placeholder="Masukkan username Anda" autocomplete="username">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required placeholder="Masukkan password Anda" autocomplete="current-password">
            </div>

            <button type="submit" class="btn-login" id="btnSubmit">Masuk ke Portal</button>
        </form>

        <div class="footer-text">
            <p>Lupa password? <strong>Hubungi admin sekolah</strong> untuk melakukan reset.</p>
        </div>
    </div>

    {{-- Script pencegahan double-submit --}}
    <script>
        document.getElementById('loginForm').addEventListener('submit', function() {
            const btn = document.getElementById('btnSubmit');
            if (btn) {
                btn.disabled = true;
                btn.innerHTML = '⏳ Memverifikasi...';
                btn.style.opacity = '0.8';
                btn.style.transform = 'scale(0.98)';
            }
        });
    </script>

</body>
</html>