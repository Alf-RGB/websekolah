@extends('layouts.app')

@section('title', 'Join Us - Bergabung Bersama Kami')

@section('content')

<style>
    /* =========================================
       1. CSS VARIABLES & ANIMATIONS
       ========================================= */
    :root {
        --bg-primary: #F8FAFC;
        --bg-secondary: #FFFFFF;
        --bg-tertiary: #F1F5F9;
        --text-primary: #0F172A;
        --text-secondary: #475569;
        --text-muted: #94A3B8;
        --border-color: #E2E8F0;
        --primary-color: #1D3557;
        --primary-hover: #457B9D;
        --accent-color: #A8DADC;
        --success-color: #10B981;
        --error-color: #EF4444;
        --shadow-sm: 0 1px 3px rgba(0,0,0,0.05);
        --shadow-md: 0 4px 6px -1px rgba(0,0,0,0.1);
        --shadow-lg: 0 10px 15px -3px rgba(0,0,0,0.1);
        --shadow-xl: 0 20px 25px -5px rgba(0,0,0,0.1);
        --transition-smooth: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    [data-theme="dark"] {
        --bg-primary: #0F172A;
        --bg-secondary: #1E293B;
        --bg-tertiary: #334155;
        --text-primary: #F1F5F9;
        --text-secondary: #CBD5E1;
        --text-muted: #94A3B8;
        --border-color: #334155;
        --shadow-sm: 0 1px 3px rgba(0,0,0,0.3);
        --shadow-md: 0 4px 6px -1px rgba(0,0,0,0.4);
        --shadow-lg: 0 10px 15px -3px rgba(0,0,0,0.5);
        --shadow-xl: 0 20px 25px -5px rgba(0,0,0,0.5);
    }

    @keyframes fadeInDown { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes slideIn { from { opacity: 0; transform: scale(0.96) translateY(20px); } to { opacity: 1; transform: scale(1) translateY(0); } }
    @keyframes slideUp { from { opacity: 0; transform: translateY(50px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes pulse { 0%, 100% { transform: scale(1); } 50% { transform: scale(1.05); } }

    /* =========================================
       2. WRAPPER & HEADER
       ========================================= */
    .join-us-wrapper { 
        max-width: 900px; 
        margin: 40px auto; 
        padding: 0 20px; 
        animation: fadeInUp 0.6s ease-out;
    }

    .page-header { 
        text-align: center; 
        margin-bottom: 50px; 
        animation: fadeInDown 0.6s ease-out;
    }
    .page-header h1 { 
        color: var(--text-primary); 
        font-size: 36px; 
        margin-bottom: 15px; 
        font-weight: 800; 
        letter-spacing: -0.5px;
    }
    .page-header p { 
        color: var(--text-secondary); 
        font-size: 18px; 
        max-width: 600px; 
        margin: 0 auto; 
        line-height: 1.6; 
    }

    /* =========================================
       3. SUCCESS MESSAGE & TRACKING
       ========================================= */
    .success-card {
        background: linear-gradient(135deg, #D1FAE5 0%, #A7F3D0 100%);
        padding: 40px;
        border-radius: 20px;
        margin-bottom: 40px;
        border: 2px solid var(--success-color);
        text-align: center;
        box-shadow: 0 10px 30px rgba(16, 185, 129, 0.15);
        animation: slideIn 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .success-icon { font-size: 60px; margin-bottom: 15px; display: inline-block; animation: pulse 2s infinite; }
    .success-card h2 { color: #065F46; margin: 0 0 15px 0; font-size: 26px; font-weight: 700; }
    
    .tracking-box {
        background: #FEF3C7;
        border: 3px dashed #F59E0B;
        padding: 25px;
        border-radius: 16px;
        margin: 25px 0;
        animation: fadeInUp 0.5s ease-out 0.2s backwards;
    }
    .tracking-badge {
        background: #F59E0B;
        color: white;
        padding: 6px 15px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 12px;
        letter-spacing: 0.5px;
        display: inline-block;
        margin-bottom: 15px;
    }
    .tracking-code-display {
        background: var(--bg-secondary);
        padding: 20px;
        border-radius: 12px;
        margin: 15px 0;
        border: 1px solid #FDE68A;
    }
    .tracking-code-display h1 {
        margin: 0;
        color: var(--primary-color);
        font-family: monospace;
        font-size: 32px;
        letter-spacing: 3px;
        font-weight: 800;
    }
    .next-steps {
        background: var(--bg-secondary);
        padding: 25px;
        border-radius: 16px;
        margin-top: 25px;
        text-align: left;
        border: 1px solid #BBF7D0;
        animation: fadeInUp 0.5s ease-out 0.3s backwards;
    }
    .next-steps h3 { color: var(--primary-color); margin: 0 0 15px 0; font-size: 16px; font-weight: 700; }
    .next-steps ol { color: var(--text-primary); line-height: 1.8; margin: 0; padding-left: 20px; font-size: 14px; }

    [data-theme="dark"] .success-card {
        background: linear-gradient(135deg, #064E3B 0%, #065F46 100%) !important;
        border-color: var(--success-color) !important;
    }
    [data-theme="dark"] .success-card h2 { color: #6EE7B7 !important; }
    [data-theme="dark"] .tracking-box { background: rgba(245, 158, 11, 0.15) !important; border-color: #F59E0B !important; }
    [data-theme="dark"] .tracking-code-display { background: var(--bg-secondary) !important; border-color: rgba(245, 158, 11, 0.3) !important; }
    [data-theme="dark"] .next-steps { background: var(--bg-secondary) !important; border-color: var(--border-color) !important; }

    /* =========================================
       4. PATH CARDS (GURU & SISWA)
       ========================================= */
    .path-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 30px;
        margin-bottom: 50px;
    }

    .path-card {
        background: var(--bg-secondary);
        padding: 40px 30px;
        border-radius: 20px;
        box-shadow: var(--shadow-md);
        text-align: center;
        border-top: 5px solid var(--primary-color);
        transition: var(--transition-smooth);
        height: 100%;
        display: flex;
        flex-direction: column;
        text-decoration: none;
        color: inherit;
        animation: slideIn 0.6s cubic-bezier(0.4, 0, 0.2, 1) backwards;
    }
    .path-card:nth-child(1) { animation-delay: 0.1s; border-top-color: var(--primary-color); }
    .path-card:nth-child(2) { animation-delay: 0.2s; border-top-color: var(--accent-color); }

    .path-card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: var(--shadow-xl);
    }
    .path-card:nth-child(2):hover { border-top-color: var(--primary-hover); }

    .path-icon { font-size: 60px; margin-bottom: 20px; transition: var(--transition-smooth); }
    .path-card:hover .path-icon { transform: scale(1.1) rotate(-5deg); }

    .path-title {
        color: var(--text-primary);
        font-size: 24px;
        margin-bottom: 15px;
        font-weight: 700;
    }
    .path-desc {
        color: var(--text-secondary);
        font-size: 14px;
        line-height: 1.6;
        margin-bottom: 25px;
        flex: 1;
    }
    .path-btn {
        display: inline-block;
        background: var(--primary-color);
        color: white;
        padding: 12px 30px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 14px;
        transition: var(--transition-smooth);
        margin-top: auto;
    }
    .path-card:nth-child(2) .path-btn {
        background: var(--accent-color);
        color: var(--primary-color);
    }
    .path-card:hover .path-btn {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    /* =========================================
       5. STATUS CHECK FORM
       ========================================= */
    .status-check-card {
        background: var(--bg-secondary);
        padding: 40px;
        border-radius: 20px;
        box-shadow: var(--shadow-md);
        border: 1px solid var(--border-color);
        animation: slideIn 0.6s cubic-bezier(0.4, 0, 0.2, 1) 0.3s backwards;
    }
    .status-check-header { text-align: center; margin-bottom: 30px; }
    .status-check-icon { font-size: 50px; margin-bottom: 10px; display: inline-block; }
    .status-check-header h2 { color: var(--text-primary); font-size: 24px; margin-bottom: 10px; font-weight: 700; }
    .status-check-header p { color: var(--text-secondary); font-size: 14px; }

    .check-form {
        background: var(--bg-primary);
        padding: 30px;
        border-radius: 16px;
        border: 1px solid var(--border-color);
    }
    .form-group { margin-bottom: 20px; }
    .form-label { display: block; font-weight: 600; margin-bottom: 8px; color: var(--text-primary); font-size: 14px; }
    .form-label .required { color: var(--error-color); }

    .form-input, .form-select {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid var(--border-color);
        border-radius: 12px;
        font-size: 14px;
        background: var(--bg-secondary);
        color: var(--text-primary);
        transition: var(--transition-smooth);
        box-sizing: border-box;
        font-family: inherit;
    }
    .form-input:focus, .form-select:focus {
        outline: none;
        border-color: var(--primary-hover);
        box-shadow: 0 0 0 4px rgba(69, 123, 157, 0.1);
        transform: translateY(-2px);
    }
    .form-input.monospace { font-family: monospace; text-transform: uppercase; letter-spacing: 1px; }
    .form-hint { font-size: 12px; color: var(--text-muted); margin-top: 6px; }

    .btn-submit {
        width: 100%;
        background: var(--primary-color);
        color: white;
        padding: 16px;
        border: none;
        border-radius: 12px;
        font-size: 16px;
        font-weight: 700;
        cursor: pointer;
        transition: var(--transition-smooth);
        letter-spacing: 0.5px;
        box-shadow: 0 4px 12px rgba(29, 53, 87, 0.2);
    }
    .btn-submit:hover {
        background: var(--primary-hover);
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(29, 53, 87, 0.3);
    }
    .btn-submit:active { transform: translateY(0) scale(0.98); }
    .btn-submit:disabled { opacity: 0.7; cursor: not-allowed; transform: none; }

    /* =========================================
       6. MODAL POPUP
       ========================================= */
    .modal-overlay {
        position: fixed;
        top: 0; left: 0; right: 0; bottom: 0;
        background: rgba(0,0,0,0.6);
        backdrop-filter: blur(4px);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
        padding: 20px;
        animation: fadeInDown 0.3s ease-out;
    }
    .modal-content {
        background: var(--bg-secondary);
        padding: 40px;
        border-radius: 24px;
        max-width: 500px;
        width: 100%;
        box-shadow: var(--shadow-xl);
        animation: slideUp 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        max-height: 90vh;
        overflow-y: auto;
    }
    .modal-close-btn {
        position: absolute;
        top: 15px;
        right: 15px;
        background: var(--bg-tertiary);
        border: none;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        cursor: pointer;
        font-size: 18px;
        color: var(--text-secondary);
        transition: var(--transition-smooth);
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .modal-close-btn:hover { background: var(--border-color); color: var(--text-primary); transform: rotate(90deg); }

    .status-badge-large {
        padding: 25px;
        border-radius: 16px;
        margin: 20px 0;
        text-align: center;
    }
    .status-badge-large h1 {
        margin: 0;
        font-size: 28px;
        text-transform: uppercase;
        letter-spacing: 2px;
        font-weight: 800;
    }
    .detail-box {
        background: var(--bg-primary);
        padding: 20px;
        border-radius: 12px;
        text-align: left;
        margin: 20px 0;
        border: 1px solid var(--border-color);
    }
    .detail-box h3 {
        color: var(--text-primary);
        margin: 0 0 15px 0;
        font-size: 15px;
        font-weight: 700;
        border-bottom: 2px solid var(--border-color);
        padding-bottom: 10px;
    }
    .detail-row { display: flex; padding: 8px 0; font-size: 14px; }
    .detail-label { color: var(--text-secondary); width: 40%; font-weight: 500; }
    .detail-value { color: var(--text-primary); font-weight: 600; flex: 1; }

    .info-box {
        background: #FEF3C7;
        padding: 15px;
        border-radius: 12px;
        margin-top: 20px;
        color: #92400E;
        font-size: 13px;
        line-height: 1.5;
        border: 1px solid #FDE68A;
    }
    [data-theme="dark"] .info-box { background: rgba(245, 158, 11, 0.15); color: #FDE68A; border-color: rgba(245, 158, 11, 0.3); }

    .btn-modal-close {
        width: 100%;
        margin-top: 25px;
        background: var(--primary-color);
        color: white;
        padding: 14px;
        border: none;
        border-radius: 12px;
        font-size: 15px;
        font-weight: 700;
        cursor: pointer;
        transition: var(--transition-smooth);
    }
    .btn-modal-close:hover { background: var(--primary-hover); transform: translateY(-2px); }

    /* =========================================
       7. WHATSAPP HELP SECTION
       ========================================= */
    .wa-help-section {
        background: linear-gradient(135deg, #25D366 0%, #128C7E 100%);
        padding: 40px 30px;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(37, 211, 102, 0.2);
        margin-top: 40px;
        text-align: center;
        color: white;
        animation: fadeInUp 0.6s ease-out 0.4s backwards;
    }
    .wa-help-icon { font-size: 50px; margin-bottom: 15px; display: inline-block; transition: var(--transition-smooth); }
    .wa-help-section:hover .wa-help-icon { transform: scale(1.1) rotate(-10deg); }
    .wa-help-section h3 { margin: 0 0 10px 0; font-size: 22px; font-weight: 700; }
    .wa-help-section p { margin: 0 0 25px 0; opacity: 0.95; font-size: 15px; line-height: 1.6; }
    
    .wa-help-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: white;
        color: #25D366;
        padding: 14px 30px;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 700;
        font-size: 15px;
        transition: var(--transition-smooth);
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    .wa-help-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }
    .wa-help-btn:active { transform: translateY(0) scale(0.98); }

    /* =========================================
       8. RESPONSIVE
       ========================================= */
    @media (max-width: 768px) {
        .join-us-wrapper { margin: 20px auto; padding: 0 15px; }
        .page-header h1 { font-size: 28px; }
        .path-grid { grid-template-columns: 1fr; }
        .status-check-card, .success-card { padding: 25px 20px; }
        .modal-content { padding: 30px 20px; }
        .tracking-code-display h1 { font-size: 24px; letter-spacing: 2px; }
    }
</style>

<div class="join-us-wrapper">
    <div class="page-header">
        <h1>🤝 Bergabung Bersama Kami</h1>
        <p>
            Kami selalu mencari talenta terbaik untuk bergabung dengan {{ $data['nama_sekolah'] ?? 'sekolah kami' }}.
            Pilih jalur yang sesuai dengan Anda.
        </p>
    </div>

    {{-- SUCCESS MESSAGE DENGAN TRACKING CODE --}}
    @if(session('success'))
        <div class="success-card">
            <div class="success-icon">🎉</div>
            <h2>{{ session('success') }}</h2>
            
            @if(session('tracking_code'))
                <div class="tracking-box">
                    <div class="tracking-badge">⚠️ PENTING - WAJIB SIMPAN!</div>
                    <p style="margin: 0 0 15px 0; color: #92400E; font-weight: 600; font-size: 15px;">Kode Tracking Anda:</p>
                    <div class="tracking-code-display">
                        <h1>{{ session('tracking_code') }}</h1>
                    </div>
                    <p style="margin: 10px 0 0 0; color: #92400E; font-size: 14px; font-weight: 600;">Screenshot atau catat kode ini! Anda tidak akan bisa mengecek status tanpa kode ini.</p>
                </div>
                
                <div class="next-steps">
                    <h3>📌 Langkah Selanjutnya:</h3>
                    <ol>
                        <li>Simpan kode tracking di atas dengan aman.</li>
                        <li>Tunggu konfirmasi dari admin via email atau telepon.</li>
                        <li>Cek status pendaftaran Anda secara mandiri menggunakan form di bawah ini.</li>
                    </ol>
                </div>
            @endif
        </div>
    @endif

    {{-- PILIHAN JALUR PENDAFTARAN --}}
    <div class="path-grid">
        {{-- KARTU GURU --}}
        <a href="/join-us/guru" class="path-card">
            <div class="path-icon">👨‍🏫</div>
            <h2 class="path-title">Melamar Sebagai Guru</h2>
            <p class="path-desc">
                Bergabunglah sebagai tenaga pendidik profesional. Kami mencari guru yang berdedikasi, kompeten, dan berkarakter.
            </p>
            <span class="path-btn">Isi Formulir Lamaran →</span>
        </a>

        {{-- KARTU SISWA --}}
        <a href="/ppdb" class="path-card">
            <div class="path-icon">🎒</div>
            <h2 class="path-title">Mendaftar Sebagai Siswa</h2>
            <p class="path-desc">
                Bergabunglah sebagai siswa baru. Raih masa depan cerah bersama kami melalui jalur Penerimaan Peserta Didik Baru (PPDB).
            </p>
            <span class="path-btn">Daftar PPDB Sekarang →</span>
        </a>
    </div>

    {{-- FORM CEK STATUS --}}
    <div class="status-check-card">
        <div class="status-check-header">
            <div class="status-check-icon">🔍</div>
            <h2>Cek Status Lamaran / Pendaftaran</h2>
            <p>Masukkan kode tracking Anda untuk mengecek status terkini.</p>
        </div>

        <form action="/cek-status" method="POST" id="cekStatusForm" class="check-form">
            @csrf
            
            <div class="form-group">
                <label class="form-label" for="tipe">Tipe Pendaftaran <span class="required">*</span></label>
                <select id="tipe" name="tipe" class="form-select" required>
                    <option value="">-- Pilih Tipe --</option>
                    <option value="guru" {{ old('tipe') == 'guru' ? 'selected' : '' }}>Lamaran Guru</option>
                    <option value="siswa" {{ old('tipe') == 'siswa' ? 'selected' : '' }}>Pendaftaran Siswa (PPDB)</option>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label" for="kode_tracking">Kode Tracking <span class="required">*</span></label>
                <input type="text" id="kode_tracking" name="kode_tracking" class="form-input monospace" value="{{ old('kode_tracking') }}" required placeholder="CONTOH: TRK-G-20260715-A3F2">
                <p class="form-hint">Kode unik yang Anda dapatkan setelah berhasil mendaftar.</p>
            </div>

            <button type="submit" id="btnSubmit" class="btn-submit">
                🔍 Cek Status Sekarang
            </button>
        </form>

        {{-- MODAL POPUP HASIL CEK STATUS --}}
        @if(isset($result) || isset($error))
            <div id="statusModal" class="modal-overlay">
                <div class="modal-content">
                    <button onclick="closeModal()" class="modal-close-btn" aria-label="Tutup">✕</button>

                    @if(isset($error))
                        <div style="text-align: center; padding-top: 10px;">
                            <div style="font-size: 60px; margin-bottom: 15px;">❌</div>
                            <h2 style="color: var(--error-color); margin: 0 0 15px 0; font-size: 22px; font-weight: 700;">Kode Tidak Ditemukan</h2>
                            <p style="color: var(--text-secondary); margin: 0; font-size: 15px; line-height: 1.6;">{{ $error }}</p>
                            <p style="font-size: 13px; color: var(--text-muted); margin-top: 15px;">Periksa kembali kode tracking Anda atau pastikan tipe pendaftaran sudah benar.</p>
                        </div>
                    @else
                        @php
                            $statusIcon = match($result->status) {
                                'diterima' => '🎉',
                                'ditolak' => '😔',
                                'diproses' => '⏳',
                                default => '📋'
                            };
                            $statusColor = match($result->status) {
                                'diterima' => '#065F46',
                                'ditolak' => '#991B1B',
                                'diproses' => '#1E40AF',
                                default => '#92400E'
                            };
                            $statusBg = match($result->status) {
                                'diterima' => 'linear-gradient(135deg, #D1FAE5, #A7F3D0)',
                                'ditolak' => 'linear-gradient(135deg, #FEE2E2, #FECACA)',
                                'diproses' => 'linear-gradient(135deg, #DBEAFE, #BFDBFE)',
                                default => 'linear-gradient(135deg, #FEF3C7, #FDE68A)'
                            };
                            $statusBorder = match($result->status) {
                                'diterima' => '#10B981',
                                'ditolak' => '#EF4444',
                                'diproses' => '#3B82F6',
                                default => '#F59E0B'
                            };
                        @endphp

                        <div style="text-align: center; padding-top: 10px;">
                            <div style="font-size: 60px; margin-bottom: 15px;">{{ $statusIcon }}</div>
                            
                            <h2 style="color: var(--text-primary); margin: 0 0 5px 0; font-size: 20px; font-weight: 700;">Status Lamaran / Pendaftaran</h2>
                            <p style="color: var(--text-secondary); font-size: 13px; margin: 0 0 25px 0;">Kode: <strong style="font-family: monospace; color: var(--primary-color); font-size: 14px;">{{ $result->kode_tracking }}</strong></p>
                            
                            <div class="status-badge-large" style="background: {{ $statusBg }}; border: 3px solid {{ $statusBorder }};">
                                <h1 style="color: {{ $statusColor }};">{{ ucfirst($result->status) }}</h1>
                            </div>

                            <div class="detail-box">
                                <h3>Detail Informasi:</h3>
                                <div class="detail-row">
                                    <span class="detail-label">Nama</span>
                                    <span class="detail-value">: {{ $result->nama_lengkap }}</span>
                                </div>
                                <div class="detail-row">
                                    <span class="detail-label">No. HP</span>
                                    <span class="detail-value">: {{ $result->no_hp }}</span>
                                </div>
                                <div class="detail-row">
                                    <span class="detail-label">Tanggal Daftar</span>
                                    <span class="detail-value">: {{ \Carbon\Carbon::parse($result->created_at)->format('d F Y') }}</span>
                                </div>
                            </div>

                            <div class="info-box">
                                <strong>💡 Info:</strong> Jika status Anda "Diterima", admin akan segera menghubungi Anda melalui nomor HP yang terdaftar untuk langkah selanjutnya.
                            </div>
                        </div>
                    @endif

                    <button onclick="closeModal()" class="btn-modal-close">Tutup</button>
                </div>
            </div>

            <script>
                function closeModal() {
                    const modal = document.getElementById('statusModal');
                    modal.style.opacity = '0';
                    modal.style.transition = 'opacity 0.3s ease';
                    setTimeout(() => {
                        modal.style.display = 'none';
                        window.history.pushState({}, '', '/join-us');
                    }, 300);
                }
                
                document.getElementById('statusModal').addEventListener('click', function(e) {
                    if (e.target === this) {
                        closeModal();
                    }
                });
            </script>
        @endif
    </div>

    {{-- BUTUH BANTUAN - LINK WHATSAPP --}}
    @php
        $waNumber = $data['telepon_sekolah'] ?? '6281234567890';
        $cleanWa = preg_replace('/[^0-9]/', '', $waNumber);
        if (str_starts_with($cleanWa, '0')) {
            $cleanWa = '62' . substr($cleanWa, 1);
        }
    @endphp
    <div class="wa-help-section">
        <div class="wa-help-icon">💬</div>
        <h3>Butuh Bantuan?</h3>
        <p>Hubungi kami via WhatsApp untuk informasi lebih lanjut atau jika mengalami kendala teknis.</p>
        <a href="https://wa.me/{{ $cleanWa }}" target="_blank" rel="noopener noreferrer" class="wa-help-btn">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
            </svg>
            Chat WhatsApp Admin
        </a>
    </div>
</div>

<script>
    // Form submit loading state
    const cekStatusForm = document.getElementById('cekStatusForm');
    if (cekStatusForm) {
        cekStatusForm.addEventListener('submit', function() {
            const btn = document.getElementById('btnSubmit');
            if (btn) {
                btn.disabled = true;
                btn.innerHTML = '⏳ Mengecek Status...';
                btn.style.opacity = '0.8';
                btn.style.transform = 'scale(0.98)';
            }
        });
    }
</script>

@endsection