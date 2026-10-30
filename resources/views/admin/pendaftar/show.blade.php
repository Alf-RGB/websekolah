@extends('layouts.admin')

@section('title', 'Detail Pendaftar - ' . ($pendaftar->nama_lengkap ?? 'PPDB'))

@section('content')

<style>
    :root {
        --bg-primary: #F8FAFC;
        --bg-secondary: #FFFFFF;
        --bg-tertiary: #F1F5F9;
        --text-primary: #0F172A;
        --text-secondary: #475569;
        --text-muted: #94A3B8;
        --border-color: #E2E8F0;
        --accent-color: #667eea;
        --success-color: #10B981;
        --success-hover: #059669;
        --error-color: #EF4444;
        --error-hover: #DC2626;
        --info-color: #3B82F6;
        --info-hover: #2563EB;
        --transition-smooth: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    [data-theme="dark"] {
        --bg-primary: #0F172A;
        --bg-secondary: #1E293B;
        --bg-tertiary: #334155;
        --text-primary: #F1F5F9;
        --text-secondary: #CBD5E1;
        --text-muted: #94A3B8;
        --border-color: #334155;
    }

    @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes fadeInLeft { from { opacity: 0; transform: translateX(-20px); } to { opacity: 1; transform: translateX(0); } }

    .pendaftar-detail-wrapper { 
        max-width: 1000px; 
        margin: 0 auto; 
        padding: 30px 20px; 
        animation: fadeInUp 0.6s ease-out;
    }


    /* Header Card */
    .detail-header-card {
        background: linear-gradient(135deg, var(--accent-color) 0%, #764ba2 100%);
        border-radius: 16px;
        padding: 32px;
        margin-bottom: 24px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.25);
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 20px;
    }
    [data-theme="dark"] .detail-header-card {
        background: linear-gradient(135deg, #7C3AED 0%, #6D28D9 100%);
    }
    .detail-header-card::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 300px;
        height: 300px;
        background: rgba(255,255,255,0.08);
        border-radius: 50%;
    }
    .detail-header-content { position: relative; z-index: 1; }
    .detail-header-title {
        font-size: 28px;
        font-weight: 800;
        color: white !important;
        margin: 0 0 8px 0;
        letter-spacing: -0.5px;
    }
    .detail-header-subtitle {
        font-size: 14px;
        color: rgba(255,255,255,0.85) !important;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .tracking-badge {
        background: rgba(255,255,255,0.2);
        backdrop-filter: blur(8px);
        border: 1px solid rgba(255,255,255,0.3);
        color: white !important;
        padding: 8px 16px;
        border-radius: 8px;
        font-family: 'Courier New', monospace;
        font-size: 14px;
        font-weight: 700;
        position: relative;
        z-index: 1;
    }

    /* Info Cards */
    .info-card {
        background: var(--bg-secondary);
        border-radius: 16px;
        padding: 28px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        border: 1px solid var(--border-color);
        margin-bottom: 24px;
        animation: fadeInUp 0.5s ease-out backwards;
    }
    .info-card:nth-child(3) { animation-delay: 0.1s; }
    .info-card:nth-child(4) { animation-delay: 0.2s; }
    .info-card:nth-child(5) { animation-delay: 0.3s; }

    .info-card-title {
        font-size: 16px;
        font-weight: 700;
        color: var(--text-primary);
        margin: 0 0 24px 0;
        padding-bottom: 16px;
        border-bottom: 1px solid var(--border-color);
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .info-card-title svg { color: var(--accent-color); }

    /* Info Grid */
    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 24px;
    }
    .info-item { display: flex; flex-direction: column; gap: 6px; }
    .info-label {
        font-size: 12px;
        color: var(--text-muted);
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .info-value {
        font-size: 15px;
        color: var(--text-primary);
        font-weight: 600;
        line-height: 1.5;
        padding: 12px 16px;
        background: var(--bg-primary);
        border-radius: 10px;
        border: 1px solid var(--border-color);
    }

    /* Alasan Box */
    .alasan-box {
        background: var(--bg-primary);
        border-left: 4px solid var(--accent-color);
        border-radius: 0 12px 12px 0;
        padding: 24px;
        color: var(--text-primary);
        font-size: 15px;
        line-height: 1.8;
        white-space: pre-wrap;
        position: relative;
    }
    .alasan-box::before {
        content: '"';
        position: absolute;
        top: 10px;
        left: 15px;
        font-size: 40px;
        color: var(--accent-color);
        opacity: 0.3;
        font-family: serif;
        line-height: 1;
    }

    /* Status Badge */
    .status-badge-large {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 20px;
        border-radius: 10px;
        font-size: 15px;
        font-weight: 700;
        color: white !important;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    .status-menunggu { background: linear-gradient(135deg, #F59E0B 0%, #D97706 100%); }
    .status-diproses { background: linear-gradient(135deg, #3B82F6 0%, #2563EB 100%); }
    .status-diterima { background: linear-gradient(135deg, #10B981 0%, #059669 100%); }
    .status-ditolak { background: linear-gradient(135deg, #EF4444 0%, #DC2626 100%); }

    /* Action Section */
    .action-card {
        background: var(--bg-secondary);
        border-radius: 16px;
        padding: 28px;
        border: 2px solid var(--border-color);
        margin-top: 32px;
        animation: fadeInUp 0.5s ease-out 0.4s backwards;
    }
    .action-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
        padding-bottom: 16px;
        border-bottom: 1px solid var(--border-color);
        flex-wrap: wrap;
        gap: 16px;
    }
    .action-title {
        font-size: 18px;
        font-weight: 700;
        color: var(--text-primary);
        display: flex;
        align-items: center;
        gap: 10px;
        margin: 0;
    }

    .action-buttons-row {
        display: flex;
        gap: 16px;
        flex-wrap: wrap;
    }
    .action-buttons-row form {
        flex: 1;
        min-width: 180px;
    }

    /* Base Button Style */
    .btn-action {
        width: 100%;
        padding: 14px 20px;
        border-radius: 12px;
        font-weight: 700;
        font-size: 14px;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        transition: var(--transition-smooth);
        border: none;
    }
    .btn-action svg {
        width: 18px;
        height: 18px;
        flex-shrink: 0;
        color: white !important;
    }

    /* 1. Tombol Diproses */
    .btn-diproses {
        background: var(--info-color) !important;
        color: white !important;
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
    }
    .btn-diproses:hover {
        background: var(--info-hover) !important;
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(37, 99, 235, 0.4);
    }

    /* 2. Tombol Terima */
    .btn-terima {
        background: linear-gradient(135deg, var(--success-color) 0%, var(--success-hover) 100%) !important;
        color: white !important;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }
    .btn-terima:hover {
        background: linear-gradient(135deg, var(--success-hover) 0%, #047857 100%) !important;
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(5, 150, 105, 0.4);
    }

    /* 3. Tombol Tolak */
    .btn-tolak {
        background: var(--error-color) !important;
        color: white !important;
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
    }
    .btn-tolak:hover {
        background: var(--error-hover) !important;
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(220, 38, 38, 0.4);
    }

    /* Locked Status Info */
    .status-locked-info {
        width: 100%;
        background: var(--bg-primary);
        border: 1px dashed var(--border-color);
        border-radius: 12px;
        padding: 20px;
        text-align: center;
        color: var(--text-secondary);
        font-weight: 600;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }

    @media (max-width: 768px) {
        .detail-header-card { flex-direction: column; align-items: flex-start; }
        .info-grid { grid-template-columns: 1fr; }
        .action-buttons-row { flex-direction: column; }
        .action-buttons-row form { width: 100%; min-width: 100%; }
    }

    /* ✅ FIX DARK MODE - PASTIKAN TOMBOL TETAP BERWARNA */
    [data-theme="dark"] .btn-diproses {
        background: #3B82F6 !important;
        color: white !important;
        border-color: #3B82F6 !important;
    }

    [data-theme="dark"] .btn-diproses:hover {
        background: #2563EB !important;
        border-color: #2563EB !important;
    }

    [data-theme="dark"] .btn-terima {
        background: linear-gradient(135deg, #10B981 0%, #059669 100%) !important;
        color: white !important;
        border-color: #10B981 !important;
    }

    [data-theme="dark"] .btn-terima:hover {
        background: linear-gradient(135deg, #059669 0%, #047857 100%) !important;
    }

    [data-theme="dark"] .btn-tolak {
        background: #EF4444 !important;
        color: white !important;
        border-color: #EF4444 !important;
    }

    [data-theme="dark"] .btn-tolak:hover {
        background: #DC2626 !important;
        border-color: #DC2626 !important;
    }

    /* Fix untuk info cards di dark mode */
    [data-theme="dark"] .info-card {
        background: var(--bg-secondary) !important;
        border-color: var(--border-color) !important;
        color: var(--text-primary) !important;
    }

    [data-theme="dark"] .info-card-title {
        color: var(--text-primary) !important;
        border-color: var(--border-color) !important;
    }

    [data-theme="dark"] .info-value {
        background: var(--bg-primary) !important;
        border-color: var(--border-color) !important;
        color: var(--text-primary) !important;
    }

    [data-theme="dark"] .alasan-box {
        background: var(--bg-primary) !important;
        color: var(--text-primary) !important;
    }

    [data-theme="dark"] .action-card {
        background: var(--bg-secondary) !important;
        border-color: var(--border-color) !important;
    }

    [data-theme="dark"] .action-title {
        color: var(--text-primary) !important;
    }

    /* ============================================
   CUSTOM CONFIRMATION MODAL
   ============================================ */
.confirm-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(15, 23, 42, 0.85);
    backdrop-filter: blur(6px);
    -webkit-backdrop-filter: blur(6px);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 99999;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.confirm-overlay.show {
    opacity: 1;
    visibility: visible;
}

.confirm-modal {
    background: var(--bg-secondary, #1E293B);
    border: 1px solid var(--border-color, #334155);
    padding: 35px;
    border-radius: 20px;
    max-width: 420px;
    width: 90%;
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.6);
    text-align: center;
    transform: scale(0.9);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    animation: modalPop 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

@keyframes modalPop {
    from { opacity: 0; transform: scale(0.9) translateY(10px); }
    to { opacity: 1; transform: scale(1) translateY(0); }
}

.confirm-icon {
    width: 70px;
    height: 70px;
    margin: 0 auto 20px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
}

.confirm-icon.warning {
    background: linear-gradient(135deg, #F59E0B, #D97706);
}

.confirm-icon.success {
    background: linear-gradient(135deg, #10B981, #059669);
}

.confirm-icon.danger {
    background: linear-gradient(135deg, #EF4444, #DC2626);
}

.confirm-icon svg {
    width: 35px;
    height: 35px;
    color: white !important;
}

.confirm-title {
    color: var(--text-primary, #F1F5F9);
    margin: 0 0 12px 0;
    font-size: 20px;
    font-weight: 700;
}

.confirm-message {
    color: var(--text-secondary, #CBD5E1);
    font-size: 14px;
    margin: 0 0 25px 0;
    line-height: 1.6;
}

.confirm-actions {
    display: flex;
    gap: 12px;
    justify-content: center;
    flex-wrap: wrap;
}

.confirm-btn {
    padding: 12px 24px;
    border-radius: 10px;
    font-weight: 600;
    font-size: 14px;
    cursor: pointer;
    border: 1px solid transparent;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    display: inline-flex;
    align-items: center;
    gap: 8px;
    min-width: 120px;
    justify-content: center;
}

.confirm-btn-cancel {
    background: #475569 !important;
    color: #F1F5F9 !important;
    border-color: #64748B !important;
}

.confirm-btn-cancel:hover {
    background: #64748B !important;
    transform: translateY(-2px);
}

.confirm-btn-confirm {
    color: white !important;
    border-color: transparent !important;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
}

.confirm-btn-confirm:hover {
    transform: translateY(-2px);
}

.confirm-btn-confirm.warning {
    background: linear-gradient(135deg, #F59E0B, #D97706) !important;
}

.confirm-btn-confirm.success {
    background: linear-gradient(135deg, #10B981, #059669) !important;
}

.confirm-btn-confirm.danger {
    background: linear-gradient(135deg, #EF4444, #DC2626) !important;
}

</style>

<div class="pendaftar-detail-wrapper">

    {{-- Header Card --}}
    <div class="detail-header-card">
        <div class="detail-header-content">
            <h1 class="detail-header-title">{{ $pendaftar->nama_lengkap ?? 'Detail Pendaftar' }}</h1>
            <p class="detail-header-subtitle">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                Mendaftar pada: {{ $pendaftar->created_at ? $pendaftar->created_at->format('d M Y, H:i') : '-' }}
            </p>
        </div>
        @if($pendaftar->kode_tracking)
        <div class="tracking-badge">ID: {{ $pendaftar->kode_tracking }}</div>
        @endif
    </div>

    {{-- Informasi Pribadi --}}
    <div class="info-card">
        <h2 class="info-card-title">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
            Informasi Pribadi
        </h2>
        <div class="info-grid">
            <div class="info-item">
                <span class="info-label">Nama Lengkap</span>
                <div class="info-value">{{ $pendaftar->nama_lengkap ?? '-' }}</div>
            </div>
            <div class="info-item">
                <span class="info-label">NISN</span>
                <div class="info-value">{{ $pendaftar->nisn ?? '-' }}</div>
            </div>
            <div class="info-item">
                <span class="info-label">No. HP / WhatsApp</span>
                <div class="info-value">{{ $pendaftar->no_hp ?? '-' }}</div>
            </div>
            <div class="info-item">
                <span class="info-label">Asal Sekolah</span>
                <div class="info-value">{{ $pendaftar->asal_sekolah ?? '-' }}</div>
            </div>
            <div class="info-item" style="grid-column: 1 / -1;">
                <span class="info-label">Alamat Lengkap</span>
                <div class="info-value">{{ $pendaftar->alamat ?? '-' }}</div>
            </div>
        </div>
    </div>

    {{-- Informasi Orang Tua --}}
    <div class="info-card">
        <h2 class="info-card-title">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            Data Orang Tua / Wali
        </h2>
        <div class="info-grid">
            <div class="info-item">
                <span class="info-label">Nama Orang Tua</span>
                <div class="info-value">{{ $pendaftar->nama_ortu ?? '-' }}</div>
            </div>
            <div class="info-item">
                <span class="info-label">Pekerjaan Orang Tua</span>
                <div class="info-value">{{ $pendaftar->pekerjaan_ortu ?? '-' }}</div>
            </div>
        </div>
    </div>

    {{-- Alasan Mendaftar --}}
    @if($pendaftar->alasan)
    <div class="info-card">
        <h2 class="info-card-title">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            Alasan Mendaftar
        </h2>
        <div class="alasan-box">
            {{ $pendaftar->alasan }}
        </div>
    </div>
    @endif

    {{-- ACTION SECTION --}}
    <div class="action-card">
        <div class="action-header">
            <h3 class="action-title">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="color: var(--accent-color);">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                </svg>
                Aksi Status Pendaftaran
            </h3>
            
            <span class="status-badge-large status-{{ strtolower($pendaftar->status ?? 'menunggu') }}">
                @if($pendaftar->status == 'diterima') ✅ 
                @elseif($pendaftar->status == 'ditolak') ❌ 
                @elseif($pendaftar->status == 'diproses') 🔄 
                @else ⏳ @endif
                {{ ucfirst($pendaftar->status ?? 'Menunggu') }}
            </span>
        </div>

        @if($pendaftar->status == 'diterima')
            <div class="status-locked-info">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="color: var(--success-color);">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Pendaftar ini telah DITERIMA. Tidak ada aksi lebih lanjut yang diperlukan.
            </div>
        @elseif($pendaftar->status == 'ditolak')
            <div class="status-locked-info">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="color: var(--error-color);">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Pendaftar ini telah DITOLAK.
            </div>
        @else
            <div class="action-buttons-row">
                {{-- 1. Tandai Diproses --}}
                <form action="{{ route('admin.pendaftar.update-status', $pendaftar->id) }}" method="POST" id="formDiproses">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="status" value="diproses">
                    <button type="button" class="btn-action btn-diproses" onclick="showConfirmModal('warning', 'Tandai Diproses?', 'Apakah Anda yakin ingin mengubah status pendaftar ini menjadi DIPROSES?', document.getElementById('formDiproses'))">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                        Tandai Diproses
                    </button>
                </form>

                {{-- 2. Terima Pendaftar --}}
                <form action="{{ route('admin.pendaftar.update-status', $pendaftar->id) }}" method="POST" id="formTerima">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="status" value="diterima">
                    <button type="button" class="btn-action btn-terima" onclick="showConfirmModal('success', 'Terima Pendaftar?', 'Apakah Anda yakin ingin MENERIMA pendaftar ini? Status akan berubah menjadi DITERIMA.', document.getElementById('formTerima'))">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                        </svg>
                        Terima Pendaftar
                    </button>
                </form>

                {{-- 3. Tolak Pendaftaran --}}
                <form action="{{ route('admin.pendaftar.update-status', $pendaftar->id) }}" method="POST" id="formTolak">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="status" value="ditolak">
                    <button type="button" class="btn-action btn-tolak" onclick="showConfirmModal('danger', 'Tolak Pendaftaran?', 'Apakah Anda yakin ingin MENOLAK pendaftar ini? Tindakan ini dapat diubah nanti.', document.getElementById('formTolak'))">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Tolak Pendaftaran
                    </button>
                </form>
            </div>
        @endif
    </div>

</div>

{{-- ✅ CUSTOM CONFIRMATION MODAL --}}
<div class="confirm-overlay" id="confirmOverlay">
    <div class="confirm-modal">
        <div class="confirm-icon" id="confirmIcon">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
        </div>
        <h3 class="confirm-title" id="confirmTitle">Konfirmasi</h3>
        <p class="confirm-message" id="confirmMessage">Apakah Anda yakin?</p>
        <div class="confirm-actions">
            <button type="button" class="confirm-btn confirm-btn-cancel" onclick="closeConfirmModal()">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
                Batal
            </button>
            <button type="button" class="confirm-btn confirm-btn-confirm" id="confirmBtn" onclick="executeConfirm()">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                Ya, Lanjutkan
            </button>
        </div>
    </div>
</div>

<script>
    let pendingForm = null;
    let confirmType = 'warning';

    function showConfirmModal(type, title, message, form) {
        pendingForm = form;
        confirmType = type;
        
        // Set icon
        const iconEl = document.getElementById('confirmIcon');
        iconEl.className = 'confirm-icon ' + type;
        
        if (type === 'success') {
            iconEl.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>';
        } else if (type === 'danger') {
            iconEl.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>';
        } else {
            iconEl.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>';
        }
        
        // Set text
        document.getElementById('confirmTitle').textContent = title;
        document.getElementById('confirmMessage').textContent = message;
        
        // Set button style
        const btn = document.getElementById('confirmBtn');
        btn.className = 'confirm-btn confirm-btn-confirm ' + type;
        
        if (type === 'success') {
            btn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg> Ya, Terima';
        } else if (type === 'danger') {
            btn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg> Ya, Tolak';
        } else {
            btn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" /></svg> Ya, Proses';
        }
        
        // Show modal
        document.getElementById('confirmOverlay').classList.add('show');
        document.body.style.overflow = 'hidden';
    }

    function closeConfirmModal() {
        document.getElementById('confirmOverlay').classList.remove('show');
        document.body.style.overflow = '';
        pendingForm = null;
    }

    function executeConfirm() {
        if (pendingForm) {
            pendingForm.submit();
        }
        closeConfirmModal();
    }

    // Close modal when clicking outside
    document.getElementById('confirmOverlay').addEventListener('click', function(e) {
        if (e.target === this) {
            closeConfirmModal();
        }
    });

    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const overlay = document.getElementById('confirmOverlay');
            if (overlay.classList.contains('show')) {
                closeConfirmModal();
            }
        }
    });
</script>

@endsection