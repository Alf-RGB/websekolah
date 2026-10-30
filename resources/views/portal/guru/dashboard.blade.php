@extends('layouts.app')

@section('title', 'Dashboard Guru - ' . $guru->nama)

@section('content')

<style>
    /* =========================================
       1. ANIMATIONS - SMOOTH & PROFESSIONAL
       ========================================= */
    @keyframes fadeInDown {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes slideIn {
        from { opacity: 0; transform: scale(0.96) translateY(20px); }
        to { opacity: 1; transform: scale(1) translateY(0); }
    }
    @keyframes slideDown {
        from { opacity: 0; transform: translateY(-10px); max-height: 0; }
        to { opacity: 1; transform: translateY(0); max-height: 1000px; }
    }

    /* =========================================
       2. GLOBAL & WRAPPER
       ========================================= */
    .dashboard-wrapper {
        max-width: 1400px;
        margin: 0 auto;
        padding: 40px 20px;
        animation: fadeInUp 0.6s ease-out;
    }

    /* =========================================
       3. WELCOME HEADER
       ========================================= */
    .welcome-header {
        background: linear-gradient(135deg, #10B981 0%, #059669 100%);
        border-radius: 24px;
        padding: 40px;
        margin-bottom: 30px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(16, 185, 129, 0.3);
        animation: fadeInDown 0.6s ease-out;
    }
    .welcome-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 400px;
        height: 400px;
        background: rgba(255,255,255,0.1);
        border-radius: 50%;
        transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .welcome-header::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -10%;
        width: 300px;
        height: 300px;
        background: rgba(255,255,255,0.05);
        border-radius: 50%;
        transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .welcome-header:hover::before { transform: scale(1.1) translate(-20px, 20px); }
    .welcome-header:hover::after { transform: scale(1.1) translate(20px, -20px); }

    .welcome-content {
        position: relative;
        z-index: 1;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 20px;
    }
    .welcome-text h1 {
        font-size: 32px;
        font-weight: 800;
        color: white;
        margin: 0 0 10px 0;
        letter-spacing: -0.5px;
    }
    .welcome-text p {
        font-size: 16px;
        color: rgba(255,255,255,0.9);
        margin: 0;
    }
    .btn-logout-dashboard {
        background: rgba(255,255,255,0.2);
        color: white;
        padding: 12px 24px;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 600;
        font-size: 14px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid rgba(255,255,255,0.3);
        backdrop-filter: blur(10px);
        cursor: pointer;
    }
    .btn-logout-dashboard:hover {
        background: rgba(255,255,255,0.3);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    .btn-logout-dashboard:active { transform: translateY(0) scale(0.98); }

    /* =========================================
       4. STAT CARDS GRID
       ========================================= */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }
    .stat-card {
        background: var(--card-bg, white);
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        border: 1px solid var(--border-color, #E2E8F0);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
        animation: slideIn 0.6s cubic-bezier(0.4, 0, 0.2, 1) backwards;
    }
    .stat-card:nth-child(1) { animation-delay: 0.1s; }
    .stat-card:nth-child(2) { animation-delay: 0.2s; }
    .stat-card:nth-child(3) { animation-delay: 0.3s; }
    .stat-card:nth-child(4) { animation-delay: 0.4s; }

    .stat-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 30px rgba(0,0,0,0.1);
    }
    .stat-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 4px;
        transition: height 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .stat-card:hover::before { height: 6px; }

    .stat-card.materi::before { background: linear-gradient(90deg, #10B981 0%, #059669 100%); }
    .stat-card.mapel::before { background: linear-gradient(90deg, #3B82F6 0%, #2563EB 100%); }
    .stat-card.nip::before { background: linear-gradient(90deg, #F59E0B 0%, #D97706 100%); }
    .stat-card.pendidikan::before { background: linear-gradient(90deg, #8B5CF6 0%, #7C3AED 100%); }

    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .stat-card:hover .stat-icon { transform: scale(1.1) rotate(-5deg); }

    .stat-card.materi .stat-icon { background: linear-gradient(135deg, #10B981 0%, #059669 100%); }
    .stat-card.mapel .stat-icon { background: linear-gradient(135deg, #3B82F6 0%, #2563EB 100%); }
    .stat-card.nip .stat-icon { background: linear-gradient(135deg, #F59E0B 0%, #D97706 100%); }
    .stat-card.pendidikan .stat-icon { background: linear-gradient(135deg, #8B5CF6 0%, #7C3AED 100%); }

    .stat-icon svg { width: 28px; height: 28px; color: white; }

    .stat-value {
        font-size: 24px;
        font-weight: 800;
        color: var(--text-primary, #1E293B);
        margin: 0 0 8px 0;
        line-height: 1.3;
        word-break: break-word;
    }
    .stat-label {
        font-size: 14px;
        color: var(--text-secondary, #64748B);
        margin: 0;
        font-weight: 600;
    }

    /* =========================================
       5. MAIN CONTENT GRID & CARDS
       ========================================= */
    .dashboard-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 25px;
        margin-bottom: 30px;
    }
    .dashboard-card {
        background: var(--card-bg, white);
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        border: 1px solid var(--border-color, #E2E8F0);
        animation: slideIn 0.6s cubic-bezier(0.4, 0, 0.2, 1) 0.2s backwards;
    }
    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 2px solid var(--border-color, #E2E8F0);
    }
    .card-title {
        font-size: 20px;
        font-weight: 700;
        color: var(--text-primary, #1E293B);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .card-title svg { width: 24px; height: 24px; color: #10B981; }

    .btn-edit {
        background: #10B981;
        color: white;
        padding: 8px 16px;
        border-radius: 10px;
        text-decoration: none;
        font-weight: 600;
        font-size: 13px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 2px solid #10B981;
        cursor: pointer;
        box-shadow: 0 2px 8px rgba(16, 185, 129, 0.3);
    }
    .btn-edit:hover {
        background: #059669;
        border-color: #059669;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.4);
    }
    .btn-edit:active { transform: translateY(0) scale(0.98); }

    /* Profile Overview */
    .profile-overview {
        display: flex;
        align-items: center;
        gap: 20px;
        margin-bottom: 25px;
        padding: 20px;
        background: var(--bg-tertiary, #F8FAFC);
        border-radius: 16px;
        transition: all 0.3s;
    }
    .profile-overview:hover {
        background: var(--hover-bg, #F1F5F9);
    }
    .profile-avatar {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        overflow: hidden;
        flex-shrink: 0;
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        border: 4px solid white;
        transition: transform 0.3s;
    }
    .profile-overview:hover .profile-avatar { transform: scale(1.05); }
    .profile-avatar img { width: 100%; height: 100%; object-fit: cover; }
    .profile-avatar-placeholder {
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, #10B981 0%, #059669 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 36px;
        font-weight: 800;
    }
    .profile-info h3 {
        font-size: 22px;
        font-weight: 700;
        color: var(--text-primary, #1E293B);
        margin: 0 0 5px 0;
    }
    .profile-info p {
        font-size: 14px;
        color: var(--text-secondary, #64748B);
        margin: 0;
    }
    .profile-details {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
    }
    .detail-item {
        padding: 15px;
        background: var(--bg-tertiary, #F8FAFC);
        border-radius: 12px;
        border-left: 4px solid #10B981;
        transition: all 0.3s;
    }
    .detail-item:hover {
        transform: translateX(4px);
        background: var(--hover-bg, #F1F5F9);
    }
    .detail-label {
        font-size: 12px;
        color: var(--text-secondary, #64748B);
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 5px;
    }
    .detail-value {
        font-size: 15px;
        color: var(--text-primary, #1E293B);
        font-weight: 600;
        margin: 0;
    }

    /* Quick Actions */
    .quick-actions {
        display: grid;
        grid-template-columns: 1fr;
        gap: 12px;
    }
    .action-btn {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 16px;
        background: var(--bg-tertiary, #F8FAFC);
        border-radius: 12px;
        text-decoration: none;
        color: var(--text-primary, #1E293B);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid var(--border-color, #E2E8F0);
        cursor: pointer;
    }
    .action-btn:hover {
        background: #10B981;
        color: white;
        transform: translateX(5px);
        border-color: #10B981;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2);
    }
    .action-btn:active { transform: translateX(5px) scale(0.98); }
    .action-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        background: #10B981;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .action-icon svg { width: 20px; height: 20px; }
    .action-btn:hover .action-icon {
        background: white;
        color: #10B981;
        transform: rotate(-5deg);
    }
    .action-text { font-size: 14px; font-weight: 600; }

    /* Edit Form */
    .edit-form {
        display: none;
        margin-top: 20px;
        padding: 20px;
        background: var(--bg-tertiary, #F8FAFC);
        border-radius: 16px;
    }
    .edit-form.active {
        display: block;
        animation: slideDown 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .form-group { margin-bottom: 15px; }
    .form-label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: var(--text-secondary, #64748B);
        margin-bottom: 8px;
    }
    .form-input {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid var(--border-color, #E2E8F0);
        border-radius: 10px;
        background: var(--card-bg, white);
        color: var(--text-primary, #1E293B);
        font-size: 14px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-sizing: border-box;
    }
    .form-input:focus {
        outline: none;
        border-color: #10B981;
        background: white;
        box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1);
        transform: translateY(-2px);
    }
    .form-hint {
        font-size: 12px;
        color: var(--text-secondary, #64748B);
        margin-top: 6px;
        font-style: italic;
    }

    /* Foto Upload */
    .foto-upload-section {
        display: flex;
        gap: 20px;
        align-items: flex-start;
        margin-bottom: 20px;
        padding: 20px;
        background: white;
        border-radius: 12px;
        border: 2px dashed var(--border-color, #E2E8F0);
        transition: all 0.3s;
    }
    .foto-upload-section:hover {
        border-color: #10B981;
        background: rgba(16, 185, 129, 0.02);
    }
    .foto-preview {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        overflow: hidden;
        flex-shrink: 0;
        border: 3px solid #10B981;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2);
    }
    .foto-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .foto-preview:hover img { transform: scale(1.1); }
    .foto-preview-placeholder {
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, #10B981 0%, #059669 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 32px;
        font-weight: 800;
    }
    .foto-upload-info { flex: 1; }
    .foto-upload-info h4 {
        margin: 0 0 10px 0;
        font-size: 14px;
        color: var(--text-primary, #1E293B);
        font-weight: 700;
    }

    .btn-save, .btn-cancel {
        padding: 12px 24px;
        border-radius: 10px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: none;
        font-size: 14px;
    }
    .btn-save {
        background: #10B981;
        color: white;
        margin-right: 10px;
        box-shadow: 0 2px 8px rgba(16, 185, 129, 0.3);
    }
    .btn-save:hover {
        background: #059669;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.4);
    }
    .btn-save:active { transform: translateY(0) scale(0.98); }
    .btn-cancel {
        background: var(--bg-tertiary, #F8FAFC);
        color: var(--text-primary, #1E293B);
        border: 1px solid var(--border-color, #E2E8F0);
    }
    .btn-cancel:hover {
        background: #E2E8F0;
        transform: translateY(-2px);
    }
    .btn-cancel:active { transform: translateY(0) scale(0.98); }

    /* Alert */
    .alert-success {
        background: linear-gradient(135deg, #D1FAE5 0%, #A7F3D0 100%);
        color: #065F46;
        padding: 14px 18px;
        border-radius: 12px;
        margin-bottom: 20px;
        font-weight: 600;
        border: 2px solid #10B981;
        display: flex;
        align-items: center;
        gap: 10px;
        animation: fadeInDown 0.5s ease-out;
    }
    .alert-success svg { width: 20px; height: 20px; flex-shrink: 0; }

    /* =========================================
       6. DARK MODE OVERRIDES
       ========================================= */
    [data-theme="dark"] .welcome-header {
        background: linear-gradient(135deg, #065F46 0%, #064E3B 100%) !important;
    }
    [data-theme="dark"] .dashboard-card,
    [data-theme="dark"] .stat-card {
        background: #1E293B !important;
        border-color: #334155 !important;
    }
    [data-theme="dark"] .stat-value,
    [data-theme="dark"] .card-title,
    [data-theme="dark"] .profile-info h3,
    [data-theme="dark"] .detail-value,
    [data-theme="dark"] .foto-upload-info h4 {
        color: #F1F5F9 !important;
    }
    [data-theme="dark"] .stat-label,
    [data-theme="dark"] .profile-info p,
    [data-theme="dark"] .detail-label,
    [data-theme="dark"] .form-label,
    [data-theme="dark"] .form-hint {
        color: #94A3B8 !important;
    }
    [data-theme="dark"] .profile-overview,
    [data-theme="dark"] .detail-item,
    [data-theme="dark"] .action-btn,
    [data-theme="dark"] .edit-form,
    [data-theme="dark"] .foto-upload-section {
        background: #0F172A !important;
        border-color: #334155 !important;
    }
    [data-theme="dark"] .detail-item:hover,
    [data-theme="dark"] .profile-overview:hover {
        background: #1E293B !important;
    }
    [data-theme="dark"] .form-input {
        background: #0F172A !important;
        border-color: #334155 !important;
        color: #F1F5F9 !important;
    }
    [data-theme="dark"] .form-input:focus {
        background: #1E293B !important;
        border-color: #10B981 !important;
    }
    [data-theme="dark"] .btn-cancel {
        background: #0F172A !important;
        border-color: #334155 !important;
        color: #F1F5F9 !important;
    }
    [data-theme="dark"] .btn-cancel:hover {
        background: #1E293B !important;
    }
    [data-theme="dark"] .alert-success {
        background: linear-gradient(135deg, #064E3B 0%, #065F46 100%) !important;
        color: #6EE7B7 !important;
        border-color: #10B981 !important;
    }
    [data-theme="dark"] .profile-avatar,
    [data-theme="dark"] .foto-preview {
        border-color: #1E293B !important;
    }
    [data-theme="dark"] .foto-upload-section:hover {
        border-color: #10B981 !important;
        background: rgba(16, 185, 129, 0.05) !important;
    }

    /* =========================================
       7. RESPONSIVE DESIGN
       ========================================= */
    @media (max-width: 768px) {
        .dashboard-wrapper { padding: 20px; }
        .dashboard-grid { grid-template-columns: 1fr; }
        .welcome-text h1 { font-size: 24px; }
        .stats-grid { grid-template-columns: 1fr; }
        .profile-details { grid-template-columns: 1fr; }
        .foto-upload-section { flex-direction: column; align-items: center; text-align: center; }
        .welcome-content { flex-direction: column; align-items: flex-start; }
        .btn-logout-dashboard { width: 100%; text-align: center; }
    }
</style>

<div class="dashboard-wrapper">

    {{-- Welcome Header --}}
    <div class="welcome-header">
        <div class="welcome-content">
            <div class="welcome-text">
                <h1>Selamat Datang, {{ $guru->nama }}</h1>
                <p>Kelola profil dan materi ajar Anda dengan mudah</p>
            </div>
            <form action="{{ route('portal.guru.logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn-logout-dashboard">Logout</button>
            </form>
        </div>
    </div>

    {{-- Alert Success --}}
    @if(session('success'))
        <div class="alert-success">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            {{ session('success') }}
        </div>
    @endif

    {{-- Stat Cards --}}
    <div class="stats-grid">
        <div class="stat-card materi">
            <div class="stat-icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
            </div>
            <h2 class="stat-value">{{ $guru->materis->count() ?? 0 }}</h2>
            <p class="stat-label">Materi Ajar</p>
        </div>
        <div class="stat-card mapel">
            <div class="stat-icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                </svg>
            </div>
            <h2 class="stat-value">{{ $guru->mata_pelajaran ?? '-' }}</h2>
            <p class="stat-label">Mata Pelajaran</p>
        </div>
        <div class="stat-card nip">
            <div class="stat-icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                </svg>
            </div>
            <h2 class="stat-value">{{ $guru->nip ?? '-' }}</h2>
            <p class="stat-label">NIP</p>
        </div>
        <div class="stat-card pendidikan">
            <div class="stat-icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zM12 14v7" />
                </svg>
            </div>
            <h2 class="stat-value">{{ $guru->pendidikan ?? '-' }}</h2>
            <p class="stat-label">Pendidikan</p>
        </div>
    </div>

    {{-- Main Content Grid --}}
    <div class="dashboard-grid">
        
        {{-- Profile Overview Card --}}
        <div class="dashboard-card">
            <div class="card-header">
                <h2 class="card-title">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Profil Saya
                </h2>
                <button class="btn-edit" onclick="toggleEditForm()">Edit Profil</button>
            </div>

            {{-- Profile Display --}}
            <div id="profileDisplay">
                <div class="profile-overview">
                    @php
                        $fotoPath = 'storage/gurus/' . $guru->foto;
                        $fotoExists = $guru->foto && file_exists(public_path('storage/gurus/' . $guru->foto));
                    @endphp
                    <div class="profile-avatar">
                        @if($fotoExists)
                            <img src="{{ asset($fotoPath) }}" alt="{{ $guru->nama }}">
                        @else
                            <div class="profile-avatar-placeholder">
                                {{ strtoupper(substr($guru->nama, 0, 1)) }}
                            </div>
                        @endif
                    </div>
                    <div class="profile-info">
                        <h3>{{ $guru->nama }}</h3>
                        <p>{{ $guru->mata_pelajaran ?? 'Mata Pelajaran Belum Diisi' }}</p>
                    </div>
                </div>

                <div class="profile-details">
                    <div class="detail-item">
                        <div class="detail-label">NIP</div>
                        <p class="detail-value">{{ $guru->nip ?? 'Belum Diisi' }}</p>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Mata Pelajaran</div>
                        <p class="detail-value">{{ $guru->mata_pelajaran ?? 'Belum Diisi' }}</p>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Pendidikan Terakhir</div>
                        <p class="detail-value">{{ $guru->pendidikan ?? 'Belum Diisi' }}</p>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Username</div>
                        <p class="detail-value">{{ $guru->username }}</p>
                    </div>
                </div>
            </div>

            {{-- Edit Form --}}
            <div id="editForm" class="edit-form">
                <form action="{{ route('portal.guru.profil.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    {{-- Foto Upload --}}
                    <div class="foto-upload-section">
                        <div class="foto-preview">
                            @if($fotoExists)
                                <img id="fotoPreview" src="{{ asset($fotoPath) }}" alt="{{ $guru->nama }}">
                            @else
                                <div class="foto-preview-placeholder" id="fotoPreviewPlaceholder">
                                    {{ strtoupper(substr($guru->nama, 0, 1)) }}
                                </div>
                            @endif
                        </div>
                        <div class="foto-upload-info">
                            <h4>Foto Profil</h4>
                            <input type="file" name="foto" id="fotoInput" class="form-input" accept="image/*" onchange="previewFoto(event)">
                            <div class="form-hint">Format: JPG, PNG. Maksimal 2MB. Kosongkan jika tidak ingin mengubah.</div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-input" value="{{ $guru->nama }}" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">NIP</label>
                        <input type="text" name="nip" class="form-input" value="{{ $guru->nip ?? '' }}" placeholder="Isi NIP Anda">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Mata Pelajaran</label>
                        <input type="text" name="mata_pelajaran" class="form-input" value="{{ $guru->mata_pelajaran ?? '' }}" placeholder="Contoh: Matematika">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Pendidikan Terakhir</label>
                        <input type="text" name="pendidikan" class="form-input" value="{{ $guru->pendidikan ?? '' }}" placeholder="Contoh: S1 Pendidikan Matematika">
                    </div>

                    <button type="submit" class="btn-save">Simpan Perubahan</button>
                    <button type="button" class="btn-cancel" onclick="toggleEditForm()">Batal</button>
                </form>
            </div>
        </div>

        {{-- Quick Actions Card --}}
        <div class="dashboard-card" style="animation-delay: 0.3s;">
            <div class="card-header">
                <h2 class="card-title">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                    Aksi Cepat
                </h2>
            </div>

            <div class="quick-actions">
                <button class="action-btn" onclick="toggleEditForm()">
                    <div class="action-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </div>
                    <span class="action-text">Edit Profil</span>
                </button>
                <a href="#" class="action-btn">
                    <div class="action-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                        </svg>
                    </div>
                    <span class="action-text">Upload Materi</span>
                </a>
                <a href="/portal-akademik" class="action-btn">
                    <div class="action-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </div>
                    <span class="action-text">Lihat Portal Publik</span>
                </a>
                <a href="/" class="action-btn">
                    <div class="action-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                    </div>
                    <span class="action-text">Kembali ke Beranda</span>
                </a>
            </div>
        </div>

    </div>

</div>

<script>
    function toggleEditForm() {
        const editForm = document.getElementById('editForm');
        const profileDisplay = document.getElementById('profileDisplay');
        
        if (editForm.classList.contains('active')) {
            editForm.classList.remove('active');
            // Small delay to allow animation to reverse smoothly if we added one, 
            // but for display:none/block, immediate is fine, or we can use a timeout.
            setTimeout(() => {
                profileDisplay.style.display = 'block';
                profileDisplay.style.animation = 'fadeInUp 0.4s ease-out';
            }, 50);
        } else {
            profileDisplay.style.display = 'none';
            editForm.classList.add('active');
        }
    }

    function previewFoto(event) {
        const input = event.target;
        const preview = document.getElementById('fotoPreview');
        const placeholder = document.getElementById('fotoPreviewPlaceholder');
        
        if (input.files && input.files[0]) {
            // Validasi ukuran file (2MB)
            if (input.files[0].size > 2 * 1024 * 1024) {
                alert('⚠️ Ukuran file melebihi 2MB!');
                input.value = '';
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                if (preview) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                    
                    // Smooth scale animation
                    preview.style.transform = 'scale(0.8)';
                    preview.style.opacity = '0';
                    setTimeout(() => {
                        preview.style.transition = 'all 0.4s cubic-bezier(0.4, 0, 0.2, 1)';
                        preview.style.transform = 'scale(1)';
                        preview.style.opacity = '1';
                    }, 50);
                }
                if (placeholder) {
                    placeholder.style.display = 'none';
                }
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

@endsection