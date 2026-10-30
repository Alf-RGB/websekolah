@extends('layouts.app')

@section('title', 'Login Guru - Portal Akademik')

@section('content')

<style>
    /* Hide default footer for login page */
    footer, .footer, [class*="footer"] {
        display: none !important;
    }
    
    body {
        min-height: 100vh;
        overflow-x: hidden;
    }

    /* =========================================
       ANIMATIONS
       ========================================= */
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    @keyframes slideUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes slideDown {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes shimmer {
        0%, 100% { background-position: -200% 0; }
        50% { background-position: 200% 0; }
    }
    @keyframes moveGrid {
        0% { transform: translate(0, 0); }
        100% { transform: translate(50px, 50px); }
    }

    /* =========================================
       WRAPPER & BACKGROUND
       ========================================= */
    .login-guru-wrapper {
        min-height: 85vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 20px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        position: relative;
        overflow: hidden;
        animation: fadeIn 0.8s ease;
    }

    .login-guru-wrapper::before {
        content: '';
        position: absolute;
        width: 150%;
        height: 150%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 1px, transparent 1px);
        background-size: 50px 50px;
        animation: moveGrid 20s linear infinite;
        pointer-events: none;
    }

    .login-guru-container {
        position: relative;
        z-index: 10;
        width: 100%;
        max-width: 450px;
        animation: slideUp 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* =========================================
       LOGIN CARD
       ========================================= */
    .login-guru-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border-radius: 24px;
        padding: 50px 40px;
        box-shadow: 
            0 25px 50px rgba(0, 0, 0, 0.15),
            0 0 0 1px rgba(255, 255, 255, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.3);
        position: relative;
        overflow: hidden;
    }

    .login-guru-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #10B981 0%, #059669 50%, #10B981 100%);
        background-size: 200% 100%;
        animation: shimmer 3s infinite;
    }

    .login-guru-header {
        text-align: center;
        margin-bottom: 40px;
    }

    .login-guru-title {
        font-size: 32px;
        font-weight: 800;
        background: linear-gradient(135deg, #10B981 0%, #059669 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin: 0 0 10px 0;
        letter-spacing: -0.5px;
    }

    .login-guru-subtitle {
        font-size: 14px;
        color: var(--text-secondary, #64748B);
        line-height: 1.6;
        margin: 0;
    }

    /* =========================================
       FORM ELEMENTS
       ========================================= */
    .form-group-guru {
        margin-bottom: 24px;
    }

    .form-label-guru {
        display: block;
        font-size: 13px;
        font-weight: 700;
        color: var(--text-primary, #475569);
        margin-bottom: 8px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .form-input-guru {
        width: 100%;
        padding: 14px 18px;
        border: 2px solid var(--border-color, #E2E8F0);
        border-radius: 12px;
        font-size: 15px;
        background: var(--input-bg, #F8FAFC);
        color: var(--text-primary, #1E293B);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-sizing: border-box;
        font-family: inherit;
    }

    .form-input-guru:focus {
        outline: none;
        border-color: #10B981;
        background: white;
        box-shadow: 
            0 0 0 4px rgba(16, 185, 129, 0.1),
            0 0 20px rgba(16, 185, 129, 0.2);
        transform: translateY(-2px);
    }

    .form-input-guru::placeholder {
        color: #94A3B8;
    }

    /* Password Toggle */
    .password-wrapper {
        position: relative;
    }
    .password-wrapper .form-input-guru {
        padding-right: 50px;
    }
    .btn-toggle-password {
        position: absolute;
        right: 8px;
        top: 50%;
        transform: translateY(-50%);
        background: transparent !important;
        border: none !important;
        outline: none !important;
        cursor: pointer;
        padding: 8px;
        color: #94A3B8;
        transition: color 0.3s, transform 0.2s;
        box-shadow: none !important;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
    }
    .btn-toggle-password:hover {
        color: #10B981;
        transform: translateY(-50%) scale(1.1);
    }

    /* Submit Button */
    .btn-login-guru {
        width: 100%;
        padding: 16px;
        background: linear-gradient(135deg, #10B981 0%, #059669 100%);
        color: white;
        border: none;
        border-radius: 12px;
        font-size: 16px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 10px 25px rgba(16, 185, 129, 0.3);
        position: relative;
        overflow: hidden;
        font-family: inherit;
        margin-top: 10px;
    }

    .btn-login-guru::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
        transition: left 0.6s;
    }

    .btn-login-guru:hover::before {
        left: 100%;
    }

    .btn-login-guru:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 35px rgba(16, 185, 129, 0.4);
    }

    .btn-login-guru:active {
        transform: translateY(-1px);
    }

    .btn-login-guru:disabled {
        opacity: 0.7;
        cursor: not-allowed;
        transform: none !important;
        box-shadow: none !important;
    }

    /* Back Link */
    .back-link-guru {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #10B981;
        text-decoration: none;
        font-weight: 600;
        font-size: 14px;
        margin-top: 25px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
    }

    .back-link-guru::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 0;
        height: 2px;
        background: #10B981;
        transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .back-link-guru:hover::after {
        width: 100%;
    }

    .back-link-guru:hover {
        color: #059669;
        transform: translateX(-5px);
    }

    /* Alerts */
    .alert-guru {
        padding: 14px 18px;
        border-radius: 12px;
        margin-bottom: 24px;
        font-size: 14px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 10px;
        animation: slideDown 0.4s ease-out;
        border: 2px solid;
    }

    .alert-guru-success {
        background: linear-gradient(135deg, #D1FAE5 0%, #A7F3D0 100%);
        color: #065F46;
        border-color: #10B981;
        box-shadow: 0 4px 15px rgba(16, 185, 129, 0.2);
    }

    .alert-guru-error {
        background: linear-gradient(135deg, #FEE2E2 0%, #FECACA 100%);
        color: #991B1B;
        border-color: #EF4444;
        box-shadow: 0 4px 15px rgba(239, 68, 68, 0.2);
    }

    /* =========================================
       DARK MODE OVERRIDES
       ========================================= */
    [data-theme="dark"] .login-guru-wrapper {
        background: linear-gradient(135deg, #0F172A 0%, #1E1B4B 100%);
    }

    [data-theme="dark"] .login-guru-card {
        background: rgba(30, 41, 59, 0.95);
        border: 1px solid rgba(255, 255, 255, 0.1);
        box-shadow: 
            0 25px 50px rgba(0, 0, 0, 0.3),
            0 0 0 1px rgba(255, 255, 255, 0.05);
    }

    [data-theme="dark"] .login-guru-title {
        background: linear-gradient(135deg, #34D399 0%, #10B981 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    [data-theme="dark"] .login-guru-subtitle {
        color: #94A3B8;
    }

    [data-theme="dark"] .form-label-guru {
        color: #CBD5E1;
    }

    [data-theme="dark"] .form-input-guru {
        background: #0F172A;
        border-color: #334155;
        color: #F1F5F9;
    }

    [data-theme="dark"] .form-input-guru:focus {
        background: #1E293B;
        border-color: #34D399;
        box-shadow: 
            0 0 0 4px rgba(52, 211, 153, 0.1),
            0 0 20px rgba(52, 211, 153, 0.2);
    }

    [data-theme="dark"] .form-input-guru::placeholder {
        color: #64748B;
    }

    [data-theme="dark"] .btn-toggle-password {
        color: #64748B;
    }
    [data-theme="dark"] .btn-toggle-password:hover {
        color: #34D399;
    }

    [data-theme="dark"] .btn-login-guru {
        background: linear-gradient(135deg, #34D399 0%, #10B981 100%);
        box-shadow: 0 10px 25px rgba(52, 211, 153, 0.3);
    }

    [data-theme="dark"] .btn-login-guru:hover {
        box-shadow: 0 15px 35px rgba(52, 211, 153, 0.4);
    }

    [data-theme="dark"] .back-link-guru {
        color: #34D399;
    }

    [data-theme="dark"] .back-link-guru:hover {
        color: #10B981;
    }

    [data-theme="dark"] .back-link-guru::after {
        background: #34D399;
    }

    [data-theme="dark"] .alert-guru-success {
        background: linear-gradient(135deg, #064E3B 0%, #065F46 100%);
        color: #6EE7B7;
        border-color: #10B981;
    }

    [data-theme="dark"] .alert-guru-error {
        background: linear-gradient(135deg, #7F1D1D 0%, #991B1B 100%);
        color: #FCA5A5;
        border-color: #EF4444;
    }

    @media (max-width: 480px) {
        .login-guru-card {
            padding: 40px 25px;
        }
        .login-guru-title {
            font-size: 26px;
        }
    }
</style>

<div class="login-guru-wrapper">
    <div class="login-guru-container">
        
        <div class="login-guru-card">
            {{-- Header --}}
            <div class="login-guru-header">
                <h1 class="login-guru-title">Portal Guru</h1>
                <p class="login-guru-subtitle">Silakan login untuk mengelola profil dan materi ajar Anda</p>
            </div>

            {{-- Alert Messages --}}
            @if(session('success'))
                <div class="alert-guru alert-guru-success">
                    <span>✓</span>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert-guru alert-guru-error">
                    <span>✕</span>
                    {{ session('error') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert-guru alert-guru-error">
                    <span>✕</span>
                    {{ $errors->first() }}
                </div>
            @endif

            {{-- Login Form --}}
            <form action="{{ route('portal.guru.login.process') }}" method="POST" id="loginForm">
                @csrf
                
                <div class="form-group-guru">
                    <label class="form-label-guru" for="username">Username / NIP</label>
                    <input 
                        type="text" 
                        id="username" 
                        name="username" 
                        class="form-input-guru" 
                        placeholder="Masukkan username atau NIP"
                        value="{{ old('username') }}"
                        required 
                        autofocus
                    >
                </div>

                <div class="form-group-guru">
                    <label class="form-label-guru" for="password">Password</label>
                    <div class="password-wrapper">
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            class="form-input-guru" 
                            placeholder="Masukkan password Anda"
                            required
                        >
                        <button 
                            type="button" 
                            id="togglePasswordGuru"
                            class="btn-toggle-password"
                            aria-label="Toggle password visibility"
                        >
                            <svg id="eyeIconGuru" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn-login-guru" id="btnSubmit">
                    Masuk ke Dashboard
                </button>
            </form>

            {{-- Back Link --}}
            <div style="text-align: center;">
                <a href="/" class="back-link-guru">
                    ← Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // 1. Show/Hide Password Toggle
        const togglePasswordBtn = document.getElementById('togglePasswordGuru');
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIconGuru');
        
        if (togglePasswordBtn && passwordInput) {
            togglePasswordBtn.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                
                // Ganti icon mata
                if (type === 'text') {
                    eyeIcon.innerHTML = '<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line>';
                } else {
                    eyeIcon.innerHTML = '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle>';
                }
            });
        }

        // 2. Loading state untuk button (Consolidated)
        const loginForm = document.getElementById('loginForm');
        const btnSubmit = document.getElementById('btnSubmit');
        
        if (loginForm && btnSubmit) {
            loginForm.addEventListener('submit', function() {
                btnSubmit.disabled = true;
                btnSubmit.innerHTML = '⏳ Memproses...';
                btnSubmit.style.opacity = '0.8';
                btnSubmit.style.transform = 'scale(0.98)';
            });
        }
    });
</script>

@endsection