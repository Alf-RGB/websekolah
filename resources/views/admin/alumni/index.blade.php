@extends('layouts.admin')

@section('title', 'Kelola Alumni - Admin')

@section('content')

<style>
    /* =========================================
       ANIMATIONS - SMOOTH & PROFESSIONAL
       ========================================= */
    @keyframes fadeInDown {
        from { opacity: 0; transform: translateY(-30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes fadeInLeft {
        from { opacity: 0; transform: translateX(-30px); }
        to { opacity: 1; transform: translateX(0); }
    }

    @keyframes fadeInRight {
        from { opacity: 0; transform: translateX(30px); }
        to { opacity: 1; transform: translateX(0); }
    }

    @keyframes slideIn {
        from { opacity: 0; transform: scale(0.95); }
        to { opacity: 1; transform: scale(1); }
    }

    @keyframes slideUp {
        from { opacity: 0; transform: translateY(20px) scale(0.98); }
        to { opacity: 1; transform: translateY(0) scale(1); }
    }

    .alumni-wrapper { 
        max-width: 1400px; 
        margin: 0 auto; 
        padding: 30px; 
        animation: fadeInUp 0.6s ease;
    }

    /* Header Card */
    .alumni-header-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 20px;
        padding: 35px 40px;
        margin-bottom: 30px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(102, 126, 234, 0.3);
        animation: fadeInDown 0.8s ease;
    }
    .alumni-header-card::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 400px;
        height: 400px;
        background: rgba(255,255,255,0.1);
        border-radius: 50%;
    }
    .alumni-header-content { position: relative; z-index: 1; }
    .alumni-header-title {
        font-size: 32px;
        font-weight: 800;
        color: white;
        margin: 0 0 10px 0;
        letter-spacing: -0.5px;
    }
    .alumni-header-subtitle {
        font-size: 16px;
        color: rgba(255,255,255,0.9);
        margin: 0;
    }

    /* Stats Cards dengan Stagger Animation */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        margin-bottom: 30px;
    }
    .stat-card {
        background: var(--card-bg, white);
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.04);
        border: 1px solid var(--border-color, #E2E8F0);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
        animation: fadeInUp 0.6s ease backwards;
    }
    .stat-card:nth-child(1) { animation-delay: 0.1s; }
    .stat-card:nth-child(2) { animation-delay: 0.2s; }
    .stat-card:nth-child(3) { animation-delay: 0.3s; }
    
    .stat-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0;
        width: 4px;
        height: 100%;
        transform: scaleY(0);
        transform-origin: top;
        transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .stat-card.total::before { background: linear-gradient(180deg, #667eea 0%, #764ba2 100%); }
    .stat-card.featured::before { background: linear-gradient(180deg, #10B981 0%, #059669 100%); }
    .stat-card.reguler::before { background: linear-gradient(180deg, #F59E0B 0%, #D97706 100%); }
    
    .stat-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 30px rgba(0,0,0,0.1);
    }
    .stat-card:hover::before {
        transform: scaleY(1);
    }
    .stat-value {
        font-size: 36px;
        font-weight: 900;
        color: var(--text-primary, #1E293B);
        margin: 0 0 5px 0;
        line-height: 1;
    }
    .stat-label {
        font-size: 11px;
        color: var(--text-secondary, #64748B);
        margin: 0;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Search Section */
    .search-section {
        background: var(--card-bg, white);
        border-radius: 16px;
        padding: 20px 25px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        border: 1px solid var(--border-color, #E2E8F0);
        margin-bottom: 30px;
        display: flex;
        gap: 12px;
        align-items: center;
        animation: fadeInUp 0.6s ease 0.4s both;
    }
    .search-input-wrapper { flex: 1; position: relative; }
    .search-icon {
        position: absolute !important;
        left: 15px !important;
        top: 50% !important;
        transform: translateY(-50%) !important;
        width: 18px !important;
        height: 18px !important;
        color: #94A3B8 !important;
        pointer-events: none !important;
        z-index: 10 !important;
    }
    .search-input {
        width: 100% !important;
        padding: 12px 16px 12px 45px !important;
        border: 2px solid var(--border-color, #E2E8F0) !important;
        border-radius: 12px !important;
        font-size: 14px !important;
        background: var(--input-bg, #F8FAFC) !important;
        color: var(--text-primary, #1E293B) !important;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
        box-sizing: border-box !important;
    }
    .search-input:focus {
        outline: none !important;
        border-color: #667eea !important;
        background: white !important;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1) !important;
        transform: translateY(-2px) !important;
    }
    .search-input::placeholder { color: #94A3B8 !important; }
    
    .btn-cari {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
        color: white !important;
        padding: 12px 28px !important;
        border-radius: 12px !important;
        border: none !important;
        font-weight: 700 !important;
        font-size: 14px !important;
        cursor: pointer !important;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3) !important;
        white-space: nowrap !important;
    }
    .btn-cari:hover {
        transform: translateY(-2px) !important;
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4) !important;
    }

    /* Content Card */
    .content-card {
        background: var(--card-bg, white);
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        border: 1px solid var(--border-color, #E2E8F0);
        animation: slideIn 0.6s ease 0.5s both;
    }

    /* Table dengan Row Animation */
    .table-container { overflow-x: auto; }
    .table-alumni {
        width: 100%;
        border-collapse: collapse;
        font-size: 14px;
    }
    .table-alumni thead tr {
        background: var(--bg-tertiary, #F8FAFC);
        border-bottom: 2px solid var(--border-color, #E2E8F0);
    }
    .table-alumni th {
        padding: 14px 12px;
        color: var(--text-secondary, #64748B);
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        text-align: left;
        white-space: nowrap;
    }
    .table-alumni tbody tr {
        border-bottom: 1px solid var(--border-color, #E2E8F0);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        animation: fadeInLeft 0.5s ease backwards;
    }
    .table-alumni tbody tr:nth-child(1) { animation-delay: 0.1s; }
    .table-alumni tbody tr:nth-child(2) { animation-delay: 0.15s; }
    .table-alumni tbody tr:nth-child(3) { animation-delay: 0.2s; }
    .table-alumni tbody tr:nth-child(4) { animation-delay: 0.25s; }
    .table-alumni tbody tr:nth-child(5) { animation-delay: 0.3s; }
    
    .table-alumni tbody tr:hover {
        background: var(--bg-tertiary, #F8FAFC);
        transform: translateX(5px);
    }
    .table-alumni td {
        padding: 14px 12px;
        color: var(--text-primary, #1E293B);
        vertical-align: middle !important;
    }

    /* Status Badge */
    .status-badge {
        display: inline-block;
        padding: 5px 12px;
        border-radius: 50px;
        font-size: 11px;
        font-weight: 700;
        color: white;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .status-badge:hover {
        transform: scale(1.05);
    }
    .status-featured { background: linear-gradient(135deg, #10B981 0%, #059669 100%); }
    .status-reguler { background: linear-gradient(135deg, #6B7280 0%, #4B5563 100%); }

    /* Action Icons */
    .action-icons-wrapper {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 6px !important;
    }

    .action-icon-btn {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        width: 34px !important;
        height: 34px !important;
        border-radius: 8px !important;
        border: none !important;
        cursor: pointer !important;
        text-decoration: none !important;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
        box-shadow: 0 2px 6px rgba(0,0,0,0.15) !important;
        padding: 0 !important;
        margin: 0 !important;
        line-height: 1 !important;
    }

    .action-icon-btn:hover {
        transform: translateY(-3px) scale(1.1) !important;
        box-shadow: 0 6px 15px rgba(0,0,0,0.25) !important;
    }

    .action-icon-btn svg {
        width: 16px !important;
        height: 16px !important;
        color: white !important;
    }

    .action-icon-btn.edit {
        background: linear-gradient(135deg, #3B82F6 0%, #2563EB 100%) !important;
    }
    .action-icon-btn.edit:hover {
        background: linear-gradient(135deg, #2563EB 0%, #1D4ED8 100%) !important;
    }

    .action-icon-btn.view {
        background: linear-gradient(135deg, #10B981 0%, #059669 100%) !important;
    }
    .action-icon-btn.view:hover {
        background: linear-gradient(135deg, #059669 0%, #047857 100%) !important;
    }

    .action-icon-btn.delete {
        background: linear-gradient(135deg, #EF4444 0%, #DC2626 100%) !important;
    }
    .action-icon-btn.delete:hover {
        background: linear-gradient(135deg, #DC2626 0%, #B91C1C 100%) !important;
    }

    .action-icon-btn.featured {
        background: linear-gradient(135deg, #F59E0B 0%, #D97706 100%) !important;
    }
    .action-icon-btn.featured:hover {
        background: linear-gradient(135deg, #D97706 0%, #B45309 100%) !important;
    }

    /* Alert Success */
    .alert-success {
        background: linear-gradient(135deg, #D1FAE5 0%, #A7F3D0 100%);
        border: 2px solid #10B981;
        border-radius: 12px;
        padding: 15px 20px;
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        gap: 10px;
        animation: fadeInDown 0.5s ease;
    }
    .alert-success svg { width: 20px; height: 20px; color: #065F46; }
    .alert-success span { color: #065F46; font-weight: 600; font-size: 14px; }

    /* Bottom Actions */
    .bottom-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 30px;
        padding-top: 25px;
        border-top: 2px solid var(--border-color, #E2E8F0);
        animation: fadeInUp 0.5s ease 0.6s both;
    }
    .pagination-info {
        font-size: 13px;
        color: var(--text-secondary, #64748B);
        font-weight: 500;
    }
    .btn-tambah {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: linear-gradient(135deg, #10B981 0%, #059669 100%);
        color: white;
        padding: 12px 24px;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 700;
        font-size: 14px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
    }
    .btn-tambah:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(16, 185, 129, 0.4);
    }

    /* Pagination */
    .pagination-wrapper {
        margin-top: 20px;
        display: flex;
        justify-content: center;
        animation: fadeInUp 0.5s ease 0.7s both;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        animation: fadeInUp 0.6s ease;
    }
    .empty-icon-wrapper {
        width: 120px;
        height: 120px;
        margin: 0 auto 25px;
        background: linear-gradient(135deg, #F3F4F6 0%, #E5E7EB 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        animation: pulse 2s ease infinite;
    }
    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }
    .empty-icon { width: 60px; height: 60px; color: #9CA3AF; }
    .empty-title {
        font-size: 24px;
        font-weight: 700;
        color: var(--text-primary, #1E293B);
        margin: 0 0 10px 0;
    }
    .empty-text {
        font-size: 15px;
        color: var(--text-secondary, #64748B);
        margin: 0;
        max-width: 500px;
        margin-left: auto;
        margin-right: auto;
        line-height: 1.6;
    }

    /* Custom Modal */
    #modalKonfirmasi {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(15, 23, 42, 0.4) !important;
        backdrop-filter: blur(4px) !important;
        -webkit-backdrop-filter: blur(4px) !important;
        z-index: 9999;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }
    .konfirmasi-card {
        background: var(--card-bg, white) !important;
        border-radius: 16px !important;
        padding: 30px !important;
        max-width: 400px !important;
        width: 100% !important;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3) !important;
        animation: slideUp 0.4s cubic-bezier(0.4, 0, 0.2, 1) !important;
        border: 1px solid var(--border-color, rgba(255,255,255,0.1)) !important;
        text-align: center;
    }
    .konfirmasi-icon {
        width: 60px !important;
        height: 60px !important;
        border-radius: 50% !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        margin: 0 auto 15px !important;
    }
    .konfirmasi-icon.danger {
        background: linear-gradient(135deg, #EF4444 0%, #DC2626 100%) !important;
        box-shadow: 0 8px 20px rgba(239, 68, 68, 0.3) !important;
    }
    .konfirmasi-icon svg {
        width: 30px !important;
        height: 30px !important;
        color: white !important;
    }
    .konfirmasi-title {
        font-size: 20px !important;
        font-weight: 700 !important;
        color: var(--text-primary, #1E293B) !important;
        margin: 0 0 12px 0 !important;
    }
    .konfirmasi-message {
        font-size: 14px !important;
        color: var(--text-secondary, #64748B) !important;
        margin: 0 0 24px 0 !important;
        line-height: 1.5 !important;
    }
    .konfirmasi-message .nama-item {
        color: var(--text-primary, #1E293B) !important;
        font-weight: 600 !important;
    }
    .konfirmasi-buttons {
        display: flex !important;
        gap: 10px !important;
        justify-content: center !important;
    }
    .btn-konfirmasi {
        padding: 10px 24px !important;
        border-radius: 10px !important;
        border: none !important;
        font-size: 13px !important;
        font-weight: 600 !important;
        cursor: pointer !important;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
        min-width: 100px !important;
    }
    .btn-konfirmasi-batal {
        background: var(--bg-tertiary, #F1F5F9) !important;
        color: var(--text-primary, #475569) !important;
        border: 1px solid var(--border-color, #CBD5E1) !important;
    }
    .btn-konfirmasi-batal:hover {
        background: var(--border-color, #E2E8F0) !important;
        transform: translateY(-2px) !important;
    }
    .btn-konfirmasi-ya.danger {
        background: linear-gradient(135deg, #EF4444 0%, #DC2626 100%) !important;
        color: white !important;
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3) !important;
    }
    .btn-konfirmasi-ya.danger:hover {
        box-shadow: 0 6px 20px rgba(239, 68, 68, 0.4) !important;
        transform: translateY(-2px) !important;
    }

    /* Dark Mode */
    [data-theme="dark"] .alumni-header-card { background: linear-gradient(135deg, #4C1D95 0%, #5B21B6 100%) !important; }
    [data-theme="dark"] .stat-card, [data-theme="dark"] .search-section, [data-theme="dark"] .content-card, [data-theme="dark"] .konfirmasi-card { background: #1E293B !important; border-color: #334155 !important; }
    [data-theme="dark"] .stat-value, [data-theme="dark"] .table-alumni th, [data-theme="dark"] .table-alumni td, [data-theme="dark"] .konfirmasi-title { color: #F1F5F9 !important; }
    [data-theme="dark"] .stat-label, [data-theme="dark"] .search-input, [data-theme="dark"] .konfirmasi-message { color: #94A3B8 !important; }
    [data-theme="dark"] .search-input { background: #0F172A !important; border-color: #334155 !important; }
    [data-theme="dark"] .search-input:focus { background: #1E293B !important; border-color: #667eea !important; }
    [data-theme="dark"] .empty-icon-wrapper { background: linear-gradient(135deg, #1E293B 0%, #334155 100%) !important; }
    [data-theme="dark"] .empty-icon { color: #64748B !important; }
    [data-theme="dark"] .table-alumni thead tr, [data-theme="dark"] .table-alumni tbody tr:hover { background: #0F172A !important; }
    [data-theme="dark"] .btn-cari { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important; }
    [data-theme="dark"] .btn-konfirmasi-batal { background: #334155 !important; color: #F1F5F9 !important; border-color: #475569 !important; }
    [data-theme="dark"] .btn-konfirmasi-batal:hover { background: #475569 !important; }
    [data-theme="dark"] .konfirmasi-message .nama-item { color: #F1F5F9 !important; }
    [data-theme="dark"] .bottom-actions { border-top-color: #334155 !important; }
    [data-theme="dark"] .pagination-info { color: #94A3B8 !important; }
    [data-theme="dark"] .btn-tambah {
        background: linear-gradient(135deg, #10B981 0%, #059669 100%) !important;
        color: white !important;
    }
    [data-theme="dark"] .btn-tambah:hover {
        background: linear-gradient(135deg, #059669 0%, #047857 100%) !important;
    }

    @media (max-width: 768px) {
        .alumni-wrapper { padding: 20px; }
        .alumni-header-card { padding: 25px 20px; }
        .alumni-header-title { font-size: 24px; }
        .stats-grid { grid-template-columns: 1fr; }
        .search-section { flex-direction: column; }
        .btn-cari { width: 100%; }
        .table-alumni { font-size: 12px; }
        .bottom-actions { flex-direction: column; gap: 15px; }
        .btn-tambah { width: 100%; justify-content: center; }
        .konfirmasi-card { padding: 25px 20px; }
        .konfirmasi-buttons { flex-direction: column; }
        .btn-konfirmasi { width: 100%; }
    }
</style>

<div class="alumni-wrapper">

    {{-- Header Card --}}
    <div class="alumni-header-card">
        <div class="alumni-header-content">
            <h1 class="alumni-header-title">Kelola Alumni</h1>
            <p class="alumni-header-subtitle">Kelola data alumni dan tampilkan di halaman publik.</p>
        </div>
    </div>

    {{-- Stats Cards --}}
    <div class="stats-grid">
        <div class="stat-card total">
            <h2 class="stat-value animate-number" data-target="{{ $totalAlumni ?? 0 }}">0</h2>
            <p class="stat-label">Total Alumni</p>
        </div>
        <div class="stat-card featured">
            <h2 class="stat-value animate-number" data-target="{{ $featuredAlumni ?? 0 }}">0</h2>
            <p class="stat-label">Featured</p>
        </div>
        <div class="stat-card reguler">
            <h2 class="stat-value animate-number" data-target="{{ $regulerAlumni ?? 0 }}">0</h2>
            <p class="stat-label">Reguler</p>
        </div>
    </div>

    {{-- Search Section --}}
    <div class="search-section">
        <div class="search-input-wrapper">
            <svg class="search-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            <input type="text" class="search-input" placeholder="Cari nama alumni atau tahun lulus..." id="searchInput">
        </div>
        <button type="button" class="btn-cari" onclick="searchAlumni()">Cari</button>
    </div>

    {{-- Content Card --}}
    <div class="content-card">
        
        @if(session('success'))
        <div class="alert-success" id="successAlert">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>{{ session('success') }}</span>
        </div>
        <script>
            setTimeout(function() {
                const alert = document.getElementById('successAlert');
                if (alert) {
                    alert.style.transition = 'opacity 0.5s';
                    alert.style.opacity = '0';
                    setTimeout(function() { alert.style.display = 'none'; }, 500);
                }
            }, 3000);
        </script>
        @endif

        @if(isset($alumnis) && $alumnis->count() > 0)
            <div class="table-container">
                <table class="table-alumni" id="alumniTable">
                    <thead>
                        <tr>
                            <th style="text-align: left;">Nama Alumni</th>
                            <th>Tahun Lulus</th>
                            <th>Pekerjaan</th>
                            <th>Status</th>
                            <th style="text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($alumnis as $alumni)
                        <tr data-nama="{{ strtolower($alumni->nama ?? '') }}" data-tahun="{{ $alumni->tahun_lulus ?? '' }}">
                            
                            {{-- 1. Nama Alumni --}}
                            <td>
                                <div style="font-weight: 600;">{{ $alumni->nama }}</div>
                            </td>
                            
                            {{-- 2. Tahun Lulus --}}
                            <td>{{ $alumni->tahun_lulus ?? '-' }}</td>
                            
                            {{-- 3. Pekerjaan --}}
                            <td>{{ $alumni->pekerjaan ?? '-' }}</td>
                            
                            {{-- 4. Status --}}
                            <td style="text-align: center;">
                                @if($alumni->is_featured == 1)
                                    <span class="status-badge status-featured">Featured</span>
                                @else
                                    <span class="status-badge status-reguler">Reguler</span>
                                @endif
                            </td>
                            
                            {{-- 5. Aksi (Icon Buttons) --}}
                            <td style="text-align: center; vertical-align: middle;">
                                <div class="action-icons-wrapper">
                                    <a href="{{ route('admin.alumni.edit', $alumni->id) }}" class="action-icon-btn edit" title="Edit Alumni">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>
                                    @if($alumni->is_featured == 0)
                                        <button type="button" class="action-icon-btn featured" onclick="toggleFeatured({{ $alumni->id }}, '{{ addslashes($alumni->nama) }}')" title="Jadikan Featured">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                            </svg>
                                        </button>
                                    @endif
                                    <button type="button" class="action-icon-btn delete" onclick="showKonfirmasi({{ $alumni->id }}, '{{ addslashes($alumni->nama) }}')" title="Hapus Alumni">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            {{-- Bottom Actions --}}
            <div class="bottom-actions">
                <div style="flex: 1;"></div>
                <div style="flex: 1; text-align: center !important; font-size: 13px !important; color: var(--text-secondary, #64748B) !important; font-weight: 500 !important;">
                    @if(method_exists($alumnis, 'hasPages') && $alumnis->hasPages())
                        Menampilkan {{ $alumnis->firstItem() }}-{{ $alumnis->lastItem() }} dari {{ $alumnis->total() }} alumni
                    @else
                        Menampilkan {{ $alumnis->count() }} alumni
                    @endif
                </div>
                <div style="flex: 1; text-align: right !important;">
                    <a href="{{ route('admin.alumni.create') }}" class="btn-tambah">
                        Tambah Alumni
                    </a>
                </div>
            </div>

            {{-- Pagination --}}
            @if(method_exists($alumnis, 'links') && $alumnis->hasPages())
            <div class="pagination-wrapper">
                {{ $alumnis->links('vendor.pagination.custom') }}
            </div>
            @endif

        @else
            <div class="empty-state">
                <div class="empty-icon-wrapper">
                    <svg class="empty-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <h3 class="empty-title">Belum Ada Alumni</h3>
                <p class="empty-text">Belum ada data alumni yang ditambahkan. Mulai tambahkan data alumni untuk ditampilkan di website publik.</p>
                <div style="margin-top: 30px;">
                    <a href="{{ route('admin.alumni.create') }}" class="btn-tambah" style="text-decoration: none;">
                        Tambah Alumni Pertama
                    </a>
                </div>
            </div>
        @endif
    </div>

</div>

{{-- Custom Konfirmasi Modal --}}
<div id="modalKonfirmasi">
    <div class="konfirmasi-card">
        <div class="konfirmasi-icon danger">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
            </svg>
        </div>
        <h3 class="konfirmasi-title">Hapus Alumni</h3>
        <p class="konfirmasi-message" id="konfirmasiMessage">Apakah Anda yakin ingin menghapus alumni ini?</p>
        <div class="konfirmasi-buttons">
            <button class="btn-konfirmasi btn-konfirmasi-batal" onclick="closeKonfirmasi()">Batal</button>
            <button class="btn-konfirmasi btn-konfirmasi-ya danger" id="btnKonfirmasiYa">Ya, Hapus</button>
        </div>
    </div>
</div>

<script>
// =========================================
// ANIMASI ANGKA INCREASING
// =========================================
document.addEventListener('DOMContentLoaded', function() {
    const statValues = document.querySelectorAll('.animate-number');
    statValues.forEach(el => {
        const target = parseInt(el.getAttribute('data-target')) || 0;
        const duration = 1500;
        const startTime = performance.now();
        function easeOutCubic(t) { return 1 - Math.pow(1 - t, 3); }
        function update(currentTime) {
            const elapsed = currentTime - startTime;
            const progress = Math.min(elapsed / duration, 1);
            el.textContent = Math.floor(easeOutCubic(progress) * target);
            if (progress < 1) requestAnimationFrame(update);
            else el.textContent = target;
        }
        requestAnimationFrame(update);
    });
});

// =========================================
// SEARCH ALUMNI
// =========================================
function searchAlumni() {
    const query = document.getElementById('searchInput').value.toLowerCase().trim();
    const rows = document.querySelectorAll('#alumniTable tbody tr');
    rows.forEach(row => {
        const nama = (row.getAttribute('data-nama') || '').toLowerCase();
        const tahun = (row.getAttribute('data-tahun') || '').toLowerCase();
        row.style.display = (query === '' || nama.includes(query) || tahun.includes(query)) ? '' : 'none';
    });
}
document.getElementById('searchInput').addEventListener('input', searchAlumni);
document.getElementById('searchInput').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') { e.preventDefault(); searchAlumni(); }
});

// =========================================
// TOGGLE FEATURED
// =========================================
function toggleFeatured(id, nama) {
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = '/admin/alumni/' + id + '/toggle-featured';
    form.innerHTML = '<input type="hidden" name="_token" value="{{ csrf_token() }}"><input type="hidden" name="_method" value="PATCH">';
    document.body.appendChild(form);
    form.submit();
}

// =========================================
// KONFIRMASI MODAL
// =========================================
let pendingAction = null;

function showKonfirmasi(id, nama) {
    const modal = document.getElementById('modalKonfirmasi');
    const messageEl = document.getElementById('konfirmasiMessage');
    
    messageEl.textContent = 'Apakah Anda yakin ingin menghapus alumni "' + nama + '"?';
    
    pendingAction = function() {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '/admin/alumni/' + id;
        form.innerHTML = '<input type="hidden" name="_token" value="{{ csrf_token() }}"><input type="hidden" name="_method" value="DELETE">';
        document.body.appendChild(form);
        form.submit();
    };
    
    modal.style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function closeKonfirmasi() {
    const modal = document.getElementById('modalKonfirmasi');
    modal.style.display = 'none';
    document.body.style.overflow = 'auto';
    pendingAction = null;
}

document.getElementById('btnKonfirmasiYa').addEventListener('click', function() {
    if (pendingAction) { pendingAction(); }
    closeKonfirmasi();
});

document.getElementById('modalKonfirmasi').addEventListener('click', function(e) {
    if (e.target === this) { closeKonfirmasi(); }
});

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' || e.keyCode === 27) {
        const modal = document.getElementById('modalKonfirmasi');
        if (modal && modal.style.display === 'flex') { closeKonfirmasi(); }
    }
});
</script>

@endsection