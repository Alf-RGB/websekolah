@extends('layouts.admin')

@section('title', 'Identitas Sekolah - Admin')

@section('content')

@php
    // 1. AMBIL DATA DENGAN KEY YANG BENAR SESUAI DATABASE
    $nama = $settings->firstWhere('key', 'nama_sekolah')->value ?? 'Belum diatur';
    $alamat = $settings->firstWhere('key', 'alamat_sekolah')->value ?? 'Belum diatur';
    $telepon = $settings->firstWhere('key', 'telepon_sekolah')->value ?? 'Belum diatur';
    $email = $settings->firstWhere('key', 'email_sekolah')->value ?? 'Belum diatur';
    $wa = $settings->firstWhere('key', 'nomor_whatsapp')->value ?? 'Belum diatur';
    $logo = $settings->firstWhere('key', 'logo_sekolah')->value ?? null;

    // 2. CEK APAKAH FILE LOGO BENAR-BENAR ADA DI STORAGE
    $logoExists = $logo && \Storage::disk('public')->exists('logos/' . $logo);
    $logoUrl = $logoExists ? asset('storage/logos/' . $logo) : null;
@endphp

<style>
    :root {
        --bg-primary: #F8FAFC;
        --bg-secondary: #FFFFFF;
        --text-primary: #0F172A;
        --text-secondary: #475569;
        --text-muted: #94A3B8;
        --border-color: #E2E8F0;
        --accent-color: #667eea;
        --accent-hover: #764ba2;
        --success-color: #10B981;
        --transition-smooth: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    [data-theme="dark"] {
        --bg-primary: #0F172A;
        --bg-secondary: #1E293B;
        --text-primary: #F1F5F9;
        --text-secondary: #CBD5E1;
        --text-muted: #94A3B8;
        --border-color: #334155;
    }

    @keyframes fadeInDown { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes slideIn { from { opacity: 0; transform: scale(0.96); } to { opacity: 1; transform: scale(1); } }

    .settings-wrapper { 
        max-width: 1200px; 
        margin: 0 auto; 
        padding: 30px 20px; 
        animation: fadeInUp 0.6s ease;
    }

    /* Header Card */
    .settings-header-card {
        background: linear-gradient(135deg, var(--accent-color) 0%, var(--accent-hover) 100%);
        border-radius: 20px;
        padding: 35px 40px;
        margin-bottom: 30px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 15px 40px rgba(102, 126, 234, 0.25);
        animation: fadeInDown 0.8s ease;
    }
    [data-theme="dark"] .settings-header-card {
        background: linear-gradient(135deg, #7C3AED 0%, #6D28D9 100%);
    }
    .settings-header-card::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 400px;
        height: 400px;
        background: rgba(255,255,255,0.08);
        border-radius: 50%;
    }
    .settings-header-content { position: relative; z-index: 1; }
    .settings-header-title {
        font-size: 28px;
        font-weight: 800;
        color: white !important;
        margin: 0 0 8px 0;
        letter-spacing: -0.5px;
    }
    .settings-header-subtitle {
        font-size: 15px;
        color: rgba(255,255,255,0.9) !important;
        margin: 0;
    }

    /* Info Alert */
    .info-alert {
        background: rgba(59, 130, 246, 0.1);
        border: 1px solid rgba(59, 130, 246, 0.2);
        border-radius: 12px;
        padding: 16px 20px;
        margin-bottom: 30px;
        display: flex;
        align-items: flex-start;
        gap: 14px;
        animation: fadeInUp 0.6s ease 0.2s backwards;
    }
    .info-alert svg { width: 22px; height: 22px; color: #3B82F6; flex-shrink: 0; margin-top: 2px; }
    .info-alert-text { color: #1E40AF; font-size: 14px; line-height: 1.5; margin: 0; }
    [data-theme="dark"] .info-alert { background: rgba(59, 130, 246, 0.15); border-color: rgba(59, 130, 246, 0.3); }
    [data-theme="dark"] .info-alert-text { color: #93C5FD; }

    /* Settings Grid */
    .settings-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    /* Setting Card */
    .setting-card {
        background: var(--bg-secondary);
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0,0,0,0.03);
        border: 1px solid var(--border-color);
        transition: var(--transition-smooth);
        display: flex;
        flex-direction: column;
        animation: slideIn 0.6s cubic-bezier(0.4, 0, 0.2, 1) backwards;
    }
    .setting-card:nth-child(1) { animation-delay: 0.1s; }
    .setting-card:nth-child(2) { animation-delay: 0.15s; }
    .setting-card:nth-child(3) { animation-delay: 0.2s; }
    .setting-card:nth-child(4) { animation-delay: 0.25s; }
    .setting-card:nth-child(5) { animation-delay: 0.3s; }
    .setting-card:nth-child(6) { animation-delay: 0.35s; }

    .setting-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 30px rgba(0,0,0,0.08);
        border-color: var(--accent-color);
    }

    .setting-card-body {
        padding: 24px;
        display: flex;
        align-items: flex-start;
        gap: 16px;
        flex: 1;
    }

    .setting-icon-box {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        background: var(--bg-primary);
        border: 1px solid var(--border-color);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--accent-color);
        flex-shrink: 0;
        transition: var(--transition-smooth);
    }
    .setting-card:hover .setting-icon-box {
        background: var(--accent-color);
        color: white;
        border-color: var(--accent-color);
        transform: scale(1.05);
    }
    .setting-icon-box svg { width: 22px; height: 22px; }

    .setting-content-area { flex: 1; min-width: 0; }

    .setting-label {
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--text-muted);
        margin: 0 0 8px 0;
        transition: color 0.3s;
    }
    .setting-card:hover .setting-label { color: var(--accent-color); }

    .setting-value {
        font-size: 15px;
        color: var(--text-primary);
        line-height: 1.5;
        margin: 0;
        font-weight: 600;
        word-break: break-word;
    }
    .setting-value a {
        color: var(--accent-color);
        text-decoration: none;
        transition: var(--transition-smooth);
    }
    .setting-value a:hover { text-decoration: underline; }

    /* Logo Specific Inline Layout */
    .setting-logo-inline { display: flex; align-items: center; gap: 12px; }
    
    .setting-logo-thumb {
        width: 50px;
        height: 50px;
        border-radius: 10px;
        object-fit: contain;
        background: var(--bg-primary);
        border: 1px solid var(--border-color);
        padding: 6px;
        flex-shrink: 0;
        transition: var(--transition-smooth);
    }
    .setting-card:hover .setting-logo-thumb {
        transform: scale(1.05);
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    
    .setting-logo-thumb-placeholder {
        width: 50px;
        height: 50px;
        background: var(--bg-primary);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px dashed var(--border-color);
        color: var(--text-muted);
        flex-shrink: 0;
    }
    .setting-logo-thumb-placeholder svg { width: 22px; height: 22px; }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 12px;
        justify-content: flex-end;
        align-items: center;
        padding-top: 25px;
        border-top: 1px solid var(--border-color);
        animation: fadeInUp 0.5s ease 0.4s backwards;
    }

    .btn-action {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 8px;
        padding: 12px 28px !important;
        min-width: 140px !important;
        height: 48px !important;
        border-radius: 12px !important;
        text-decoration: none !important;
        font-weight: 700 !important;
        font-size: 14px !important;
        transition: var(--transition-smooth) !important;
        border: none !important;
        cursor: pointer !important;
    }

    .btn-secondary {
        background: var(--bg-primary) !important;
        color: var(--text-secondary) !important;
        border: 2px solid var(--border-color) !important;
    }
    .btn-secondary:hover {
        background: var(--border-color) !important;
        color: var(--text-primary) !important;
        transform: translateY(-2px) !important;
    }

    .btn-primary {
        background: linear-gradient(135deg, var(--success-color), #059669) !important;
        color: white !important;
        box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3) !important;
    }
    .btn-primary:hover {
        transform: translateY(-2px) !important;
        box-shadow: 0 8px 25px rgba(16, 185, 129, 0.4) !important;
    }

    /* Dark Mode Overrides */
    [data-theme="dark"] .setting-card { background: var(--bg-secondary); border-color: var(--border-color); }
    [data-theme="dark"] .setting-card:hover { border-color: var(--accent-color); }
    [data-theme="dark"] .setting-icon-box { background: var(--bg-primary); border-color: var(--border-color); }
    [data-theme="dark"] .setting-value { color: var(--text-primary); }

    @media (max-width: 768px) {
        .settings-wrapper { padding: 15px; }
        .settings-header-card { padding: 25px 20px; }
        .settings-header-title { font-size: 24px; }
        .settings-grid { grid-template-columns: 1fr; }
        .action-buttons { flex-direction: column-reverse; width: 100%; }
        .btn-action { width: 100% !important; }
    }
</style>

<div class="settings-wrapper">

    {{-- Session Alert --}}
    @if(session('success'))
        <div class="info-alert" style="background: rgba(16, 185, 129, 0.1); border-color: rgba(16, 185, 129, 0.3); animation: fadeInDown 0.5s ease;">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="color: #10B981;">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <p class="info-alert-text" style="color: #065F46;">
                <strong>Berhasil:</strong> {{ session('success') }}
            </p>
        </div>
    @endif

    {{-- Header Card --}}
    <div class="settings-header-card">
        <div class="settings-header-content">
            <h1 class="settings-header-title">Identitas Sekolah</h1>
            <p class="settings-header-subtitle">Kelola informasi dasar dan profil resmi sekolah yang terintegrasi dengan website publik.</p>
        </div>
    </div>

    {{-- Info Alert --}}
    <div class="info-alert">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <p class="info-alert-text">
            <strong>Catatan Penting:</strong> Perubahan data identitas sekolah pada halaman ini akan langsung diperbarui secara otomatis pada bagian header, footer, serta halaman kontak situs web utama.
        </p>
    </div>

    {{-- Settings Grid --}}
    <div class="settings-grid">

        {{-- 1. Nama Sekolah --}}
        <div class="setting-card">
            <div class="setting-card-body">
                <div class="setting-icon-box">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </div>
                <div class="setting-content-area">
                    <p class="setting-label">Nama Sekolah</p>
                    <p class="setting-value">{{ $nama }}</p>
                </div>
            </div>
        </div>

        {{-- 2. Logo Sekolah --}}
        <div class="setting-card">
            <div class="setting-card-body">
                <div class="setting-icon-box">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <div class="setting-content-area">
                    <p class="setting-label">Logo Sekolah</p>
                    
                    @if($logoExists)
                        <div class="setting-logo-inline">
                            <img src="{{ $logoUrl }}" alt="Logo Sekolah" class="setting-logo-thumb" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'; this.nextElementSibling.nextElementSibling.textContent='Error Memuat';">
                            <div class="setting-logo-thumb-placeholder" style="display: none;">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                            </div>
                            <span class="setting-value" style="font-size: 13px; color: var(--success-color); font-weight: 600;">✓ Tersimpan</span>
                        </div>
                    @else
                        <div class="setting-logo-inline">
                            <div class="setting-logo-thumb-placeholder">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                            </div>
                            <span class="setting-value" style="font-size: 13px; color: var(--text-muted);">Belum diupload</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- 3. Alamat Sekolah --}}
        <div class="setting-card">
            <div class="setting-card-body">
                <div class="setting-icon-box">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                <div class="setting-content-area">
                    <p class="setting-label">Alamat Lengkap</p>
                    <p class="setting-value">{{ $alamat }}</p>
                </div>
            </div>
        </div>

        {{-- 4. Telepon / WhatsApp --}}
        <div class="setting-card">
            <div class="setting-card-body">
                <div class="setting-icon-box">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                    </svg>
                </div>
                <div class="setting-content-area">
                    <p class="setting-label">Telepon / WhatsApp</p>
                    <p class="setting-value">
                        @if($telepon !== 'Belum diatur')
                            <a href="tel:{{ $telepon }}">{{ $telepon }}</a>
                        @else
                            {{ $telepon }}
                        @endif
                        @if($wa !== 'Belum diatur')
                            <br><span style="font-size: 12px; color: var(--text-muted); font-weight: 400;">WA: {{ $wa }}</span>
                        @endif
                    </p>
                </div>
            </div>
        </div>

        {{-- 5. Email --}}
        <div class="setting-card">
            <div class="setting-card-body">
                <div class="setting-icon-box">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <div class="setting-content-area">
                    <p class="setting-label">Email Resmi</p>
                    <p class="setting-value">
                        @if($email !== 'Belum diatur')
                            <a href="mailto:{{ $email }}">{{ $email }}</a>
                        @else
                            {{ $email }}
                        @endif
                    </p>
                </div>
            </div>
        </div>

        {{-- 6. Link Website --}}
        <div class="setting-card">
            <div class="setting-card-body">
                <div class="setting-icon-box">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                    </svg>
                </div>
                <div class="setting-content-area">
                    <p class="setting-label">Situs Web Publik</p>
                    <p class="setting-value">
                        <a href="{{ url('/') }}" target="_blank" rel="noopener noreferrer">
                            {{ parse_url(url('/'), PHP_URL_HOST) }}
                        </a>
                    </p>
                </div>
            </div>
        </div>

    </div>

    {{-- Action Buttons --}}
    <div class="action-buttons">
        <a href="{{ route('admin.dashboard') }}" class="btn-action btn-secondary">
            Kembali
        </a>
        <a href="{{ route('admin.settings.edit') }}" class="btn-action btn-primary">
            Edit Identitas
        </a>
    </div>

</div>
@endsection