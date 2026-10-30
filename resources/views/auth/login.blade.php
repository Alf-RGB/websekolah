@extends('layouts.app')

@section('title', 'Login Admin - SMK Multi Karya Medan')

@section('content')

<style>
    /* =========================================
       HIDE FOOTER ON LOGIN PAGE
       ========================================= */
    footer, .footer, [class*="footer"] {
        display: none !important;
    }

    /* =========================================
       ANIMATIONS
       ========================================= */
    @keyframes floatBg {
        0%, 100% { transform: translate(0, 0) rotate(0deg); }
        33% { transform: translate(30px, -30px) rotate(120deg); }
        66% { transform: translate(-20px, 20px) rotate(240deg); }
    }
    @keyframes float1 {
        0%, 100% { transform: translate(0, 0) scale(1); }
        50% { transform: translate(100px, 50px) scale(1.1); }
    }
    @keyframes float2 {
        0%, 100% { transform: translate(0, 0) scale(1); }
        50% { transform: translate(-80px, -60px) scale(1.15); }
    }
    @keyframes float3 {
        0%, 100% { transform: translate(-50%, -50%) scale(1); }
        50% { transform: translate(-30%, -70%) scale(0.9); }
    }
    @keyframes slideUp {
        from { opacity: 0; transform: translateY(40px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes shimmer {
        0%, 100% { background-position: -200% 0; }
        50% { background-position: 200% 0; }
    }
    @keyframes pulse { 
        0%, 100% { transform: scale(1); } 
        50% { transform: scale(1.05); } 
    }
    @keyframes slideDown { 
        from { opacity: 0; transform: translateY(-10px); } 
        to { opacity: 1; transform: translateY(0); } 
    }

    /* =========================================
       LOGIN ADMIN - MODERN DESIGN
       ========================================= */
    .login-admin-wrapper {
        min-height: 85vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 20px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
        position: relative;
        overflow: hidden;
    }

    .login-admin-wrapper::before {
        content: '';
        position: absolute;
        width: 150%;
        height: 150%;
        background: 
            radial-gradient(circle at 20% 50%, rgba(255,255,255,0.1) 0%, transparent 50%),
            radial-gradient(circle at 80% 80%, rgba(255,255,255,0.08) 0%, transparent 50%),
            radial-gradient(circle at 40% 20%, rgba(255,255,255,0.06) 0%, transparent 50%);
        animation: floatBg 20s ease-in-out infinite;
        pointer-events: none;
    }

    .orb {
        position: absolute;
        border-radius: 50%;
        filter: blur(80px);
        opacity: 0.4;
        pointer-events: none;
    }
    .orb-1 { 
        width: 400px; height: 400px; 
        background: #ff6b6b; 
        top: -100px; left: -100px; 
        animation: float1 15s infinite ease-in-out; 
    }
    .orb-2 { 
        width: 350px; height: 350px; 
        background: #4ecdc4; 
        bottom: -50px; right: -100px; 
        animation: float2 18s infinite ease-in-out; 
    }
    .orb-3 { 
        width: 300px; height: 300px; 
        background: #ffe66d; 
        top: 50%; left: 50%; 
        animation: float3 22s infinite ease-in-out; 
    }

    .login-admin-container {
        position: relative;
        z-index: 10;
        width: 100%;
        max-width: 440px;
        animation: slideUp 0.8s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .login-admin-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border-radius: 24px;
        padding: 50px 40px;
        box-shadow: 
            0 25px 80px rgba(0, 0, 0, 0.15),
            0 0 0 1px rgba(255, 255, 255, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.3);
        position: relative;
        overflow: hidden;
    }

    .login-admin-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
        background-size: 200% 100%;
        animation: shimmer 3s infinite;
    }

    .login-admin-header { text-align: center; margin-bottom: 35px; }
    
    .login-admin-icon {
        width: 80px; height: 80px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 24px;
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 20px;
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
        animation: pulse 2s infinite;
        position: relative;
    }

    .login-admin-icon::after {
        content: '';
        position: absolute;
        inset: -4px;
        border-radius: 28px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        z-index: -1;
        opacity: 0.4;
        filter: blur(10px);
    }
    
    .login-admin-icon svg { width: 40px; height: 40px; color: white; }

    .login-admin-title { 
        font-size: 32px; 
        font-weight: 800; 
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin: 0 0 8px 0; 
        letter-spacing: -0.5px; 
    }
    
    .login-admin-subtitle { 
        color: #64748b; 
        font-size: 14px; 
        font-weight: 500; 
        margin: 0;
    }

    .alert-admin { 
        padding: 14px 18px; 
        border-radius: 14px; 
        margin-bottom: 24px; 
        font-size: 14px; 
        font-weight: 600; 
        display: flex; 
        align-items: center; 
        gap: 10px; 
        animation: slideDown 0.5s ease; 
        border: 2px solid;
    }
    .alert-admin-success { 
        background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%); 
        color: #065f46; 
        border-color: #10b981; 
        box-shadow: 0 4px 15px rgba(16, 185, 129, 0.2);
    }
    .alert-admin-error { 
        background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%); 
        color: #991b1b; 
        border-color: #ef4444; 
        box-shadow: 0 4px 15px rgba(239, 68, 68, 0.2);
    }
    .alert-admin svg { width: 20px; height: 20px; flex-shrink: 0; }

    .form-group-admin { margin-bottom: 20px; width: 100%; }
    
    .form-label-admin { 
        display: block; 
        font-size: 13px; 
        font-weight: 700; 
        color: #475569; 
        margin-bottom: 8px; 
        text-transform: uppercase; 
        letter-spacing: 0.5px; 
    }
    
    .form-input-admin {
        width: 100%;
        padding: 14px 18px;
        border: 2px solid #e2e8f0; 
        border-radius: 14px;
        font-size: 15px; 
        font-family: inherit;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        background: #f8fafc; 
        color: #1e293b;
        box-sizing: border-box;
    }
    
    .form-input-admin:focus { 
        outline: none; 
        border-color: #667eea; 
        background: white; 
        box-shadow: 
            0 0 0 4px rgba(102, 126, 234, 0.1),
            0 0 20px rgba(102, 126, 234, 0.2);
        transform: translateY(-2px);
    }
    
    .form-input-admin::placeholder { color: #94a3b8; }

    /* Password Toggle */
    .password-wrapper {
        position: relative;
    }
    .password-wrapper .form-input-admin {
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
        color: #94a3b8;
        transition: color 0.3s, transform 0.2s;
        box-shadow: none !important;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
    }
    .btn-toggle-password:hover {
        color: #667eea;
        transform: translateY(-50%) scale(1.1);
    }

    .btn-login-admin {
        width: 100%;
        padding: 16px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white; 
        border: none; 
        border-radius: 14px;
        font-size: 15px; 
        font-weight: 700; 
        font-family: inherit;
        cursor: pointer; 
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
        margin-top: 8px;
        position: relative;
        overflow: hidden;
    }

    .btn-login-admin::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
        transition: left 0.6s;
    }

    .btn-login-admin:hover::before {
        left: 100%;
    }
    
    .btn-login-admin:hover { 
        transform: translateY(-3px); 
        box-shadow: 
            0 15px 40px rgba(102, 126, 234, 0.4),
            0 0 30px rgba(102, 126, 234, 0.3);
    }
    
    .btn-login-admin:active { transform: translateY(-1px) scale(0.98); }
    .btn-login-admin:disabled { 
        opacity: 0.7; 
        cursor: not-allowed; 
        transform: none !important; 
        box-shadow: none !important;
    }

    /* =========================================
       DARK MODE OVERRIDES
       ========================================= */
    [data-theme="dark"] .login-admin-wrapper {
        background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 50%, #312e81 100%) !important;
    }
    
    [data-theme="dark"] .login-admin-card {
        background: rgba(30, 41, 59, 0.95) !important;
        border-color: rgba(255, 255, 255, 0.1) !important;
    }
    
    [data-theme="dark"] .login-admin-title { 
        background: linear-gradient(135deg, #60a5fa 0%, #a78bfa 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    [data-theme="dark"] .login-admin-subtitle { color: #94a3b8 !important; }
    [data-theme="dark"] .form-label-admin { color: #cbd5e1 !important; }
    
    [data-theme="dark"] .form-input-admin {
        background: #0f172a !important;
        border-color: #334155 !important;
        color: #f1f5f9 !important;
    }
    
    [data-theme="dark"] .form-input-admin:focus {
        border-color: #60a5fa !important;
        background: #1e293b !important;
        box-shadow: 
            0 0 0 4px rgba(96, 165, 250, 0.1),
            0 0 20px rgba(96, 165, 250, 0.2) !important;
    }
    
    [data-theme="dark"] .form-input-admin::placeholder { color: #64748b !important; }
    
    [data-theme="dark"] .btn-toggle-password {
        color: #64748b !important;
    }
    [data-theme="dark"] .btn-toggle-password:hover {
        color: #60a5fa !important;
    }
    
    [data-theme="dark"] .alert-admin-success {
        background: linear-gradient(135deg, #064E3B 0%, #065F46 100%) !important;
        color: #6EE7B7 !important;
        border-color: #10B981 !important;
    }
    
    [data-theme="dark"] .alert-admin-error {
        background: linear-gradient(135deg, #7F1D1D 0%, #991B1B 100%) !important;
        color: #FCA5A5 !important;
        border-color: #EF4444 !important;
    }

    @media (max-width: 768px) {
        .login-admin-wrapper { padding: 20px 15px; }
        .login-admin-card { padding: 35px 25px; border-radius: 20px; }
        .login-admin-icon { width: 70px; height: 70px; }
        .login-admin-icon svg { width: 35px; height: 35px; }
        .login-admin-title { font-size: 26px; }
        .login-admin-subtitle { font-size: 13px; }
        .form-input-admin { padding: 12px 16px; font-size: 16px !important; }
        .form-label-admin { font-size: 12px; }
        .btn-login-admin { padding: 14px; font-size: 15px; }
        .orb-1 { width: 200px; height: 200px; }
        .orb-2 { width: 180px; height: 180px; }
        .orb-3 { width: 150px; height: 150px; }
    }

    @media (max-width: 480px) {
        .login-admin-card { padding: 30px 20px; border-radius: 16px; }
        .login-admin-title { font-size: 24px; }
        .login-admin-icon { width: 60px; height: 60px; }
        .login-admin-icon svg { width: 30px; height: 30px; }
        .form-input-admin { padding: 11px 14px; }
        .btn-login-admin { padding: 13px; font-size: 14px; }
    }
</style>

<div class="login-admin-wrapper">
    <!-- Floating Orbs -->
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
    <div class="orb orb-3"></div>

    <div class="login-admin-container">
        <div class="login-admin-card">
            <!-- Header -->
            <div class="login-admin-header">
                <div class="login-admin-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <h1 class="login-admin-title">Halo Admin</h1>
                <p class="login-admin-subtitle">Silakan masuk untuk mengelola website</p>
            </div>

            <!-- Alert Messages -->
            @if(session('success'))
            <div class="alert-admin alert-admin-success">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                {{ session('success') }}
            </div>
            @endif

            @if(session('error'))
            <div class="alert-admin alert-admin-error">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                {{ session('error') }}
            </div>
            @endif

            @if($errors->any())
            <div class="alert-admin alert-admin-error">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                {{ $errors->first() }}
            </div>
            @endif

            <!-- Login Form -->
            <form action="{{ route('login.process') }}" method="POST" id="loginForm">
                @csrf
                
                <div class="form-group-admin">
                    <label class="form-label-admin" for="username">Username</label>
                    <input 
                        type="text" 
                        class="form-input-admin" 
                        id="username" 
                        name="username" 
                        placeholder="Contoh: SuperAdmin"
                        value="{{ old('username') }}"
                        required 
                        autofocus
                        autocomplete="username"
                    >
                </div>

                <div class="form-group-admin">
                    <label class="form-label-admin" for="password">Password</label>
                    <div class="password-wrapper">
                        <input 
                            type="password" 
                            class="form-input-admin" 
                            id="password" 
                            name="password" 
                            placeholder="Masukkan password Anda"
                            required
                            autocomplete="current-password"
                        >
                        <button 
                            type="button" 
                            id="togglePassword"
                            class="btn-toggle-password"
                            aria-label="Toggle password visibility"
                        >
                            <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn-login-admin" id="btnSubmit">
                    Masuk ke Dashboard
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // 1. Show/Hide Password Toggle
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');
        
        if (togglePassword && passwordInput) {
            togglePassword.addEventListener('click', function() {
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