@extends($layout)

@section('title', 'Detail Lamaran - ' . ($lamaran->nama_lengkap ?? 'Guru'))

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

    @keyframes slideIn {
        from { opacity: 0; transform: scale(0.95); }
        to { opacity: 1; transform: scale(1); }
    }

    .lamaran-wrapper { 
        max-width: 900px; 
        margin: 0 auto; 
        padding: 30px; 
        animation: fadeInUp 0.6s ease;
    }
    
    .header-section { 
        display: flex; 
        justify-content: space-between; 
        align-items: center; 
        margin-bottom: 30px; 
        flex-wrap: wrap; 
        gap: 15px; 
        animation: fadeInDown 0.6s ease; 
    }
    .header-title { 
        color: var(--text-primary, #1E293B); 
        font-size: 28px; 
        font-weight: 800; 
        margin-bottom: 5px; 
    }
    .header-subtitle { 
        color: var(--text-secondary, #64748B); 
        font-size: 14px; 
        margin: 0; 
    }
    
    .btn-back { 
        display: inline-flex; 
        align-items: center; 
        gap: 6px; 
        background: var(--card-bg, white); 
        color: var(--text-primary, #1E293B); 
        padding: 10px 20px; 
        border-radius: 10px; 
        text-decoration: none; 
        font-weight: 600; 
        font-size: 14px; 
        border: 2px solid var(--border-color, #E2E8F0); 
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); 
    }
    .btn-back:hover { 
        background: #F1F5F9; 
        transform: translateY(-2px); 
        border-color: #CBD5E1; 
    }

    .main-card { 
        background: var(--card-bg, white); 
        border-radius: 20px; 
        box-shadow: 0 4px 20px rgba(0,0,0,0.05); 
        overflow: hidden; 
        border: 1px solid var(--border-color, #E2E8F0); 
        margin-bottom: 20px; 
        animation: slideIn 0.6s cubic-bezier(0.4, 0, 0.2, 1) 0.1s backwards; 
    }
    
    .card-header { 
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); 
        padding: 25px 30px; 
    }
    .card-header-title { 
        color: white; 
        font-size: 22px; 
        font-weight: 700; 
        margin-bottom: 8px; 
    }
    .card-header-subtitle { 
        color: rgba(255,255,255,0.9); 
        font-size: 14px; 
        margin: 0; 
    }
    
    .status-badge { 
        padding: 8px 16px; 
        border-radius: 50px; 
        font-size: 12px; 
        font-weight: 600; 
        display: inline-block; 
        box-shadow: 0 2px 4px rgba(0,0,0,0.1); 
        color: white; 
    }
    .status-diterima { background: rgba(16, 185, 129, 0.95); }
    .status-ditolak { background: rgba(239, 68, 68, 0.95); }
    .status-pending { background: rgba(245, 158, 11, 0.95); }
    
    .tracking-code { 
        margin-top: 10px; 
        background: rgba(255,255,255,0.2); 
        padding: 6px 12px; 
        border-radius: 6px; 
        font-size: 11px; 
        font-family: monospace; 
        color: white; 
        display: inline-block; 
    }

    .card-body { padding: 30px; }
    
    .info-grid { 
        display: grid; 
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); 
        gap: 25px; 
        margin-bottom: 25px; 
    }
    .info-item { animation: fadeInUp 0.5s ease backwards; }
    .info-item:nth-child(1) { animation-delay: 0.2s; }
    .info-item:nth-child(2) { animation-delay: 0.25s; }
    .info-item:nth-child(3) { animation-delay: 0.3s; }
    .info-item:nth-child(4) { animation-delay: 0.35s; }
    
    .info-label { 
        font-size: 11px; 
        color: var(--text-secondary, #64748B); 
        font-weight: 600; 
        text-transform: uppercase; 
        letter-spacing: 0.5px; 
    }
    .info-value { 
        margin-top: 6px; 
        font-size: 14px; 
        color: var(--text-primary, #1E293B); 
        font-weight: 600; 
        word-break: break-all; 
    }

    .detail-box { 
        margin-bottom: 25px; 
        padding: 20px; 
        background: var(--bg-tertiary, #F8FAFC); 
        border-radius: 12px; 
        border-left: 4px solid #667eea; 
        animation: fadeInUp 0.5s ease 0.4s backwards; 
    }
    .detail-box.accent { 
        border-left-color: #F59E0B; 
        animation-delay: 0.45s; 
    }
    .detail-box-title { 
        font-size: 11px; 
        color: var(--text-secondary, #64748B); 
        font-weight: 600; 
        text-transform: uppercase; 
        letter-spacing: 0.5px; 
    }
    .detail-box-content { 
        margin-top: 8px; 
        font-size: 14px; 
        color: var(--text-primary, #1E293B); 
        line-height: 1.8; 
        white-space: pre-wrap; 
    }

    .cv-box { 
        padding: 20px; 
        background: #EFF6FF; 
        border-radius: 12px; 
        border: 1px solid #BFDBFE; 
        animation: fadeInUp 0.5s ease 0.5s backwards; 
    }
    .cv-box-title { 
        font-size: 11px; 
        color: #1E40AF; 
        font-weight: 600; 
        text-transform: uppercase; 
        letter-spacing: 0.5px; 
    }
    .cv-box-filename { 
        margin-top: 6px; 
        font-size: 14px; 
        color: #1E40AF; 
        font-weight: 600; 
        word-break: break-all; 
    }
    .btn-download { 
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); 
        color: white; 
        padding: 10px 20px; 
        border-radius: 10px; 
        text-decoration: none; 
        font-weight: 600; 
        font-size: 13px; 
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); 
        display: inline-flex; 
        align-items: center; 
        gap: 6px; 
        border: none; 
        cursor: pointer; 
    }
    .btn-download:hover { 
        transform: translateY(-2px); 
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4); 
    }

    .no-cv-box { 
        padding: 20px; 
        background: #FEF2F2; 
        border-radius: 12px; 
        border: 1px solid #FECACA; 
        animation: fadeInUp 0.5s ease 0.5s backwards; 
    }
    .no-cv-text { 
        font-size: 13px; 
        color: #991B1B; 
        font-weight: 600; 
    }

    .action-buttons { 
        display: flex; 
        gap: 15px; 
        flex-wrap: wrap; 
        animation: fadeInUp 0.5s ease 0.6s backwards; 
    }
    .form-update { 
        flex: 1; 
        min-width: 300px; 
        display: flex; 
        gap: 10px; 
    }
    
    .select-status { 
        flex: 1; 
        padding: 12px 16px; 
        border: 2px solid var(--border-color, #E2E8F0); 
        border-radius: 10px; 
        font-size: 14px; 
        font-weight: 600; 
        background: var(--card-bg, white); 
        color: var(--text-primary, #1E293B); 
        cursor: pointer; 
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); 
    }
    .select-status:focus { 
        outline: none; 
        border-color: #667eea; 
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1); 
    }
    
    .btn-update { 
        background: linear-gradient(135deg, #10B981 0%, #059669 100%); 
        color: white; 
        padding: 12px 24px; 
        border: none; 
        border-radius: 10px; 
        font-weight: 600; 
        font-size: 14px; 
        cursor: pointer; 
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); 
        white-space: nowrap; 
        box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3); 
    }
    .btn-update:hover { 
        transform: translateY(-2px); 
        box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4); 
    }
    .btn-update:active { 
        transform: translateY(0) scale(0.98); 
    }

    .btn-delete { 
        background: linear-gradient(135deg, #EF4444 0%, #DC2626 100%); 
        color: white; 
        padding: 12px 24px; 
        border: none; 
        border-radius: 10px; 
        font-weight: 600; 
        font-size: 14px; 
        cursor: pointer; 
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); 
        white-space: nowrap; 
        box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3); 
    }
    .btn-delete:hover { 
        transform: translateY(-2px); 
        box-shadow: 0 6px 20px rgba(239, 68, 68, 0.4); 
    }
    .btn-delete:active { 
        transform: translateY(0) scale(0.98); 
    }

    /* Dark Mode */
    [data-theme="dark"] .header-title { color: #F1F5F9 !important; }
    [data-theme="dark"] .header-subtitle { color: #94A3B8 !important; }
    [data-theme="dark"] .btn-back { background: #1E293B !important; color: #F1F5F9 !important; border-color: #334155 !important; }
    [data-theme="dark"] .btn-back:hover { background: #334155 !important; }
    [data-theme="dark"] .main-card { background: #1E293B !important; border-color: #334155 !important; }
    [data-theme="dark"] .info-label { color: #94A3B8 !important; }
    [data-theme="dark"] .info-value { color: #F1F5F9 !important; }
    [data-theme="dark"] .detail-box { background: #0F172A !important; }
    [data-theme="dark"] .detail-box-content { color: #F1F5F9 !important; }
    [data-theme="dark"] .select-status { background: #0F172A !important; border-color: #334155 !important; color: #F1F5F9 !important; }
    [data-theme="dark"] .select-status:focus { background: #1E293B !important; }

    @media (max-width: 768px) {
        .lamaran-wrapper { padding: 20px; }
        .header-section { flex-direction: column; align-items: flex-start; }
        .card-header { padding: 20px; }
        .card-body { padding: 20px; }
        .action-buttons { flex-direction: column; }
        .form-update { flex-direction: column; }
        .btn-update, .btn-delete { width: 100%; text-align: center; justify-content: center; }
    }
</style>

<div class="lamaran-wrapper">
    {{-- HEADER --}}
    <div class="header-section">
        <div>
            <h1 class="header-title">Detail Lamaran Guru</h1>
            <p class="header-subtitle">Informasi lengkap pelamar dan dokumen</p>
        </div>
        <a href="/admin/lamaran" class="btn-back">
            ← Kembali ke Daftar
        </a>
    </div>

    {{-- CARD UTAMA --}}
    <div class="main-card">
        {{-- Header dengan Status --}}
        <div class="card-header">
            <div style="display: flex; justify-content: space-between; align-items: start; flex-wrap: wrap; gap: 15px;">
                <div>
                    <h2 class="card-header-title">{{ $lamaran->nama_lengkap }}</h2>
                    <p class="card-header-subtitle">
                        {{ $lamaran->pendidikan_terakhir ?? '-' }} - {{ $lamaran->jurusan ?? '-' }}
                    </p>
                </div>
                <div style="text-align: right;">
                    @if($lamaran->status === 'diterima')
                        <span class="status-badge status-diterima">✅ Diterima</span>
                    @elseif($lamaran->status === 'ditolak')
                        <span class="status-badge status-ditolak">❌ Ditolak</span>
                    @else
                        <span class="status-badge status-pending">⏳ Pending</span>
                    @endif
                    
                    @if($lamaran->kode_tracking)
                        <div class="tracking-code">
                            🆔 {{ $lamaran->kode_tracking }}
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Detail Informasi --}}
        <div class="card-body">
            <div class="info-grid">
                <div class="info-item">
                    <span class="info-label">📧 Email</span>
                    <div class="info-value">{{ $lamaran->email }}</div>
                </div>
                <div class="info-item">
                    <span class="info-label">📞 No. Telepon / WhatsApp</span>
                    <div class="info-value">{{ $lamaran->no_hp ?? '-' }}</div>
                </div>
                <div class="info-item">
                    <span class="info-label">📚 Mata Pelajaran Diinginkan</span>
                    <div class="info-value">{{ $lamaran->mata_pelajaran ?? '-' }}</div>
                </div>
                <div class="info-item">
                    <span class="info-label">📅 Tanggal Melamar</span>
                    <div class="info-value">{{ $lamaran->created_at->format('d M Y, H:i') }}</div>
                </div>
            </div>

            @if($lamaran->pengalaman_mengajar)
                <div class="detail-box">
                    <span class="detail-box-title">💼 Pengalaman Mengajar</span>
                    <div class="detail-box-content">{{ $lamaran->pengalaman_mengajar }}</div>
                </div>
            @endif

            @if($lamaran->alasan_melamar)
                <div class="detail-box accent">
                    <span class="detail-box-title">💡 Alasan Melamar</span>
                    <div class="detail-box-content">{!! nl2br(e($lamaran->alasan_melamar)) !!}</div>
                </div>
            @endif

            {{-- CV Download --}}
            @if($lamaran->file_cv)
                <div class="cv-box">
                    <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
                        <div>
                            <span class="cv-box-title">📄 Dokumen CV / Resume</span>
                            <div class="cv-box-filename">
                                {{ $lamaran->file_cv }}
                            </div>
                        </div>
                        <a href="{{ asset('storage/lamaran/' . $lamaran->file_cv) }}" target="_blank" class="btn-download">
                            ⬇️ Download CV
                        </a>
                    </div>
                </div>
            @else
                <div class="no-cv-box">
                    <span class="no-cv-text">⚠️ Tidak ada dokumen CV yang diunggah oleh pelamar.</span>
                </div>
            @endif
        </div>
    </div>

    {{-- Action Buttons --}}
    <div class="action-buttons">
        <form action="/admin/lamaran/{{ $lamaran->id }}" method="POST" id="updateStatusForm" class="form-update">
            @csrf
            @method('PUT')
            <select name="status" class="select-status" required>
                <option value="pending" {{ $lamaran->status === 'pending' ? 'selected' : '' }}>⏳ Pending Review</option>
                <option value="diterima" {{ $lamaran->status === 'diterima' ? 'selected' : '' }}>✅ Diterima</option>
                <option value="ditolak" {{ $lamaran->status === 'ditolak' ? 'selected' : '' }}>❌ Ditolak</option>
            </select>
            <button type="submit" id="btn-update" class="btn-update">
                Update Status
            </button>
        </form>
        
        <form action="/admin/lamaran/{{ $lamaran->id }}" method="POST" onsubmit="return confirm('⚠️ Yakin ingin menghapus lamaran ini secara permanen?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-delete">
                🗑️ Hapus Lamaran
            </button>
        </form>
    </div>
</div>

{{-- SCRIPT PENCEGAHAN DOUBLE SUBMIT --}}
<script>
    document.getElementById('updateStatusForm').addEventListener('submit', function() {
        const btn = document.getElementById('btn-update');
        if(btn) {
            btn.disabled = true;
            btn.innerHTML = '⏳ Memperbarui...';
            btn.style.opacity = '0.8';
            btn.style.transform = 'scale(0.98)';
        }
    });
</script>

@endsection