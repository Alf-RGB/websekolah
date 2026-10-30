@extends('layouts.app')

@section('title', 'Cek Status Lamaran & Pendaftaran')

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
        --shadow-sm: 0 1px 3px rgba(0,0,0,0.05);
        --shadow-md: 0 4px 6px -1px rgba(0,0,0,0.1);
        --shadow-lg: 0 10px 15px -3px rgba(0,0,0,0.1);
        --shadow-xl: 0 20px 25px -5px rgba(0,0,0,0.1);
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
        --shadow-sm: 0 1px 3px rgba(0,0,0,0.3);
        --shadow-md: 0 4px 6px -1px rgba(0,0,0,0.4);
        --shadow-lg: 0 10px 15px -3px rgba(0,0,0,0.5);
        --shadow-xl: 0 20px 25px -5px rgba(0,0,0,0.5);
    }

    @keyframes fadeInDown { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes slideUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes pulse { 0%, 100% { transform: scale(1); } 50% { transform: scale(1.05); } }

    /* =========================================
       2. WRAPPER & HEADER
       ========================================= */
    .status-check-wrapper { 
        max-width: 600px; 
        margin: 40px auto; 
        padding: 0 20px; 
        animation: fadeInUp 0.6s ease-out;
    }

    .page-header { 
        text-align: center; 
        margin-bottom: 40px; 
        animation: fadeInDown 0.6s ease-out;
    }
    .page-header h1 { 
        color: var(--text-primary); 
        font-size: 32px; 
        margin-bottom: 10px; 
        font-weight: 800; 
        letter-spacing: -0.5px;
    }
    .page-header p { 
        color: var(--text-secondary); 
        font-size: 16px; 
        line-height: 1.6; 
    }

    /* =========================================
       3. TRACKING CARD & FORM
       ========================================= */
    .tracking-card {
        background: var(--bg-secondary);
        padding: 40px;
        border-radius: 20px;
        box-shadow: var(--shadow-lg);
        border: 1px solid var(--border-color);
        transition: var(--transition-smooth);
        animation: slideUp 0.6s cubic-bezier(0.4, 0, 0.2, 1) 0.1s backwards;
    }
    .tracking-card:hover {
        box-shadow: var(--shadow-xl);
        transform: translateY(-2px);
    }

    .form-group { margin-bottom: 24px; }
    .form-label { 
        display: block; 
        font-weight: 600; 
        margin-bottom: 8px; 
        color: var(--text-primary); 
        font-size: 14px; 
    }
    .form-label .required { color: #EF4444; margin-left: 2px; }

    .form-input {
        width: 100%;
        padding: 14px 16px;
        border: 2px solid var(--border-color);
        border-radius: 12px;
        font-size: 14px;
        background: var(--bg-primary);
        color: var(--text-primary);
        transition: var(--transition-smooth);
        box-sizing: border-box;
        font-family: inherit;
    }
    .form-input:focus {
        outline: none;
        border-color: var(--primary-hover);
        box-shadow: 0 0 0 4px rgba(69, 123, 157, 0.1);
        background: var(--bg-secondary);
        transform: translateY(-2px);
    }
    .form-input.monospace { 
        font-family: 'Courier New', Courier, monospace; 
        text-transform: uppercase; 
        letter-spacing: 1px; 
        font-weight: 600;
    }
    .form-hint { 
        font-size: 12px; 
        color: var(--text-muted); 
        margin-top: 6px; 
        display: block; 
    }

    .btn-cek {
        width: 100%;
        background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
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
        position: relative;
        overflow: hidden;
    }
    .btn-cek::before {
        content: '';
        position: absolute;
        top: 0; left: -100%;
        width: 100%; height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s;
    }
    .btn-cek:hover::before { left: 100%; }
    .btn-cek:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(29, 53, 87, 0.3);
    }
    .btn-cek:active { transform: translateY(0) scale(0.98); }
    .btn-cek:disabled { 
        opacity: 0.7; 
        cursor: not-allowed; 
        transform: none; 
        box-shadow: none;
    }

    .info-tip {
        background: rgba(245, 158, 11, 0.1);
        color: #92400E;
        padding: 15px;
        border-radius: 12px;
        border: 1px solid rgba(245, 158, 11, 0.2);
        text-align: center;
        font-size: 13px;
        margin-top: 25px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        animation: fadeInUp 0.5s ease-out 0.2s backwards;
    }
    [data-theme="dark"] .info-tip {
        background: rgba(245, 158, 11, 0.15) !important;
        color: #FCD34D !important;
        border-color: rgba(245, 158, 11, 0.3) !important;
    }

    /* =========================================
       4. RESULT & ERROR CARDS
       ========================================= */
    .result-card {
        margin-top: 30px;
        padding: 30px;
        background: var(--bg-secondary);
        border-radius: 20px;
        box-shadow: var(--shadow-lg);
        border: 1px solid var(--border-color);
        animation: slideUp 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .status-header { text-align: center; margin-bottom: 25px; }
    .status-icon { font-size: 60px; margin-bottom: 15px; display: inline-block; animation: pulse 2s infinite; }
    .status-header h3 { color: var(--text-primary); margin: 0 0 5px 0; font-size: 20px; font-weight: 700; }
    .status-header p { color: var(--text-secondary); font-size: 13px; margin: 0; }
    .status-header p strong { font-family: monospace; color: var(--text-primary); font-size: 14px; }

    .status-badge {
        padding: 25px;
        border-radius: 16px;
        margin: 20px 0;
        text-align: center;
        border: 3px solid;
        transition: var(--transition-smooth);
    }
    .status-badge:hover { transform: scale(1.02); }
    .status-badge h1 { margin: 0; font-size: 28px; text-transform: uppercase; letter-spacing: 2px; font-weight: 800; }

    .status-diterima { background: linear-gradient(135deg, #D1FAE5, #A7F3D0); border-color: #10B981; color: #065F46; }
    .status-ditolak { background: linear-gradient(135deg, #FEE2E2, #FECACA); border-color: #EF4444; color: #991B1B; }
    .status-diproses { background: linear-gradient(135deg, #DBEAFE, #BFDBFE); border-color: #3B82F6; color: #1E40AF; }
    .status-default { background: linear-gradient(135deg, #FEF3C7, #FDE68A); border-color: #F59E0B; color: #92400E; }

    .detail-box {
        background: var(--bg-primary);
        padding: 20px;
        border-radius: 12px;
        border: 1px solid var(--border-color);
    }
    .detail-box h4 {
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

    .error-box {
        margin-top: 30px;
        background: linear-gradient(135deg, #FEE2E2, #FECACA);
        color: #991B1B;
        padding: 30px;
        border-radius: 16px;
        text-align: center;
        border: 1px solid #FECACA;
        border-left: 4px solid #EF4444;
        animation: slideUp 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .error-icon { font-size: 40px; margin-bottom: 10px; display: inline-block; }
    .error-box p { margin: 0; font-weight: 600; font-size: 16px; }
    .error-box small { display: block; margin-top: 10px; font-size: 13px; opacity: 0.8; font-weight: 400; }

    /* =========================================
       5. DARK MODE OVERRIDES
       ========================================= */
    [data-theme="dark"] .tracking-card,
    [data-theme="dark"] .result-card,
    [data-theme="dark"] .detail-box {
        background: var(--bg-secondary) !important;
        border-color: var(--border-color) !important;
    }
    [data-theme="dark"] .form-input {
        background: var(--bg-primary) !important;
        border-color: var(--border-color) !important;
        color: var(--text-primary) !important;
    }
    [data-theme="dark"] .form-input:focus {
        background: var(--bg-secondary) !important;
        border-color: var(--primary-hover) !important;
    }
    [data-theme="dark"] .status-header h3,
    [data-theme="dark"] .detail-box h4,
    [data-theme="dark"] .detail-value { color: var(--text-primary) !important; }
    [data-theme="dark"] .status-header p,
    [data-theme="dark"] .detail-label { color: var(--text-secondary) !important; }
    
    [data-theme="dark"] .status-diterima { background: linear-gradient(135deg, #064E3B, #065F46); border-color: #10B981; color: #6EE7B7; }
    [data-theme="dark"] .status-ditolak { background: linear-gradient(135deg, #7F1D1D, #991B1B); border-color: #EF4444; color: #FCA5A5; }
    [data-theme="dark"] .status-diproses { background: linear-gradient(135deg, #1E3A8A, #1E40AF); border-color: #3B82F6; color: #93C5FD; }
    [data-theme="dark"] .status-default { background: linear-gradient(135deg, #78350F, #92400E); border-color: #F59E0B; color: #FCD34D; }
    
    [data-theme="dark"] .error-box {
        background: linear-gradient(135deg, #450A0A, #7F1D1D) !important;
        color: #FCA5A5 !important;
        border-color: #7F1D1D !important;
    }

    /* =========================================
       6. RESPONSIVE
       ========================================= */
    @media (max-width: 768px) {
        .status-check-wrapper { margin: 20px auto; padding: 0 15px; }
        .page-header h1 { font-size: 26px; }
        .tracking-card, .result-card, .error-box { padding: 25px 20px; }
        .status-badge h1 { font-size: 22px; }
        .detail-row { flex-direction: column; gap: 4px; }
        .detail-label { width: 100%; }
    }
</style>

<div class="status-check-wrapper">
    
    {{-- Header --}}
    <div class="page-header">
        <h1>Cek Status Lamaran</h1>
        <p>Masukkan kode tracking yang Anda dapatkan setelah berhasil mendaftar.</p>
    </div>

    {{-- Form Card --}}
    <div class="tracking-card">
        <form action="/ppdb/cek-status" method="POST" id="cekStatusForm">
            @csrf
            
            <div class="form-group">
                <label class="form-label" for="tipe">Tipe Pendaftaran <span class="required">*</span></label>
                <select id="tipe" name="tipe" class="form-input" required>
                    <option value="">-- Pilih Tipe --</option>
                    <option value="guru" {{ old('tipe') == 'guru' ? 'selected' : '' }}>👨‍🏫 Lamaran Guru</option>
                    <option value="siswa" {{ old('tipe') == 'siswa' ? 'selected' : '' }}>🎒 Pendaftaran Siswa (PPDB)</option>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label" for="kode_tracking">Kode Tracking <span class="required">*</span></label>
                <input type="text" id="kode_tracking" name="kode_tracking" value="{{ old('kode_tracking') }}" required placeholder="TRK-G-20260715-A3F2" class="form-input monospace">
                <small class="form-hint">Kode unik yang Anda dapatkan setelah mendaftar.</small>
            </div>

            <button type="submit" id="btnSubmit" class="btn-cek">
                Cek Status Sekarang
            </button>
        </form>

        <div class="info-tip">
            <span style="font-size: 18px;">💡</span>
            <span><strong>Tip:</strong> Simpan kode tracking Anda dengan baik. Screenshot atau catat di notes agar tidak hilang.</span>
        </div>
    </div>

    {{-- =========================================
         HASIL PENCARIAN (JIKA ADA)
         ========================================= --}}
    @if(isset($result))
        @php
            $statusClass = match($result->status) {
                'diterima' => 'status-diterima',
                'ditolak' => 'status-ditolak',
                'diproses' => 'status-diproses',
                default => 'status-default'
            };
            $statusIcon = match($result->status) {
                'diterima' => '🎉',
                'ditolak' => '😔',
                'diproses' => '⏳',
                default => '📋'
            };
        @endphp

        <div class="result-card">
            <div class="status-header">
                <div class="status-icon">{{ $statusIcon }}</div>
                <h3>Status Lamaran / Pendaftaran</h3>
                <p>Kode: <strong>{{ $result->kode_tracking }}</strong></p>
            </div>
            
            {{-- Status Badge --}}
            <div class="status-badge {{ $statusClass }}">
                <h1>{{ ucfirst($result->status) }}</h1>
            </div>

            {{-- Detail Info --}}
            <div class="detail-box">
                <h4>Detail Informasi:</h4>
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

            <div class="info-tip" style="margin-top: 20px;">
                <strong>💡 Info:</strong> Jika status Anda "Diterima", admin akan segera menghubungi Anda melalui nomor HP yang terdaftar.
            </div>
        </div>
    @endif

    {{-- =========================================
         ERROR MESSAGE (JIKA ADA)
         ========================================= --}}
    @if(isset($error))
        <div class="error-box">
            <div class="error-icon">❌</div>
            <p>{{ $error }}</p>
            <small>Periksa kembali kode tracking Anda atau pastikan tipe pendaftaran sudah benar.</small>
        </div>
    @endif

</div>

<script>
    // Cegah double submit saat mengecek status
    const cekStatusForm = document.getElementById('cekStatusForm');
    if (cekStatusForm) {
        cekStatusForm.addEventListener('submit', function() {
            const btn = document.getElementById('btnSubmit');
            if(btn) {
                btn.disabled = true;
                btn.innerHTML = '⏳ Memproses...';
                btn.style.opacity = '0.8';
                btn.style.transform = 'scale(0.98)';
            }
        });
    }
</script>

@endsection