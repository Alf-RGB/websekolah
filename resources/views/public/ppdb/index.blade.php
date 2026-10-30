@extends('layouts.app')

@section('title', 'Formulir PPDB Online - ' . (\App\Models\Setting::where('key', 'nama_sekolah')->value('value') ?? 'Sekolah'))

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
        --success-color: #10B981;
        --success-hover: #059669;
        --primary-color: #1D3557;
        --primary-hover: #457B9D;
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
    @keyframes fadeInDown { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: translateY(0); } }

    .ppdb-wrapper { 
        max-width: 900px; 
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
    }
    .page-header p { 
        color: var(--text-secondary); 
        font-size: 16px; 
        margin: 0; 
    }

    .ppdb-card {
        background: var(--bg-secondary);
        padding: 40px;
        border-radius: 24px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        border: 1px solid var(--border-color);
        animation: fadeInUp 0.6s ease-out 0.1s backwards;
    }

    .form-section {
        margin-bottom: 32px;
        padding-bottom: 32px;
        border-bottom: 2px solid var(--border-color);
    }
    .form-section:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }
    .form-section-title {
        font-size: 18px;
        font-weight: 700;
        color: var(--primary-color);
        margin: 0 0 24px 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .form-section-title svg {
        color: var(--success-color);
    }

    .form-group { margin-bottom: 24px; }
    .form-row { 
        display: grid; 
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); 
        gap: 20px; 
    }

    .form-label { 
        display: block; 
        font-weight: 600; 
        margin-bottom: 8px; 
        color: var(--text-primary); 
        font-size: 14px; 
    }
    .form-label .required { color: #EF4444; margin-left: 2px; }

    .form-input, .form-select, textarea.form-input {
        width: 100%;
        padding: 14px 16px;
        border: 2px solid var(--border-color);
        border-radius: 12px;
        font-size: 14px;
        font-family: inherit;
        transition: var(--transition-smooth);
        background: var(--bg-primary);
        color: var(--text-primary);
        box-sizing: border-box;
    }
    .form-input:focus, .form-select:focus, textarea.form-input:focus {
        outline: none;
        border-color: var(--primary-hover);
        box-shadow: 0 0 0 4px rgba(69, 123, 157, 0.1);
        background: var(--bg-secondary);
        transform: translateY(-2px);
    }
    textarea.form-input { resize: vertical; min-height: 100px; }

    .form-hint { color: var(--text-muted); font-size: 12px; margin-top: 6px; }
    .form-error { color: #EF4444; font-size: 12px; margin-top: 6px; font-weight: 500; }

    .btn-submit {
        width: 100%;
        background: linear-gradient(135deg, var(--success-color) 0%, var(--success-hover) 100%);
        color: white;
        padding: 16px;
        border: none;
        border-radius: 12px;
        font-size: 16px;
        font-weight: 700;
        cursor: pointer;
        transition: var(--transition-smooth);
        box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
    }
    .btn-submit:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(16, 185, 129, 0.4);
    }
    .btn-submit:disabled { opacity: 0.7; cursor: not-allowed; transform: none; }

    /* Success Box */
    .success-box {
        background: linear-gradient(135deg, #D1FAE5 0%, #A7F3D0 100%);
        padding: 40px;
        border-radius: 24px;
        border: 2px solid var(--success-color);
        text-align: center;
        animation: fadeInUp 0.6s ease-out;
    }
    .success-icon { font-size: 60px; margin-bottom: 15px; }
    .success-title { color: #065F46; margin: 0 0 15px 0; font-size: 26px; }
    
    .tracking-code {
        background: var(--bg-secondary);
        padding: 20px;
        border-radius: 12px;
        margin: 20px 0;
        font-family: 'Courier New', monospace;
        font-size: 32px;
        font-weight: 800;
        color: var(--primary-color);
        letter-spacing: 3px;
    }

    @media (max-width: 768px) {
        .ppdb-wrapper { padding: 0 15px; }
        .ppdb-card { padding: 25px 20px; }
        .form-row { grid-template-columns: 1fr; }
    }
</style>

<div class="ppdb-wrapper">
    
    {{-- HEADER --}}
    <div class="page-header">
        <h1> Formulir PPDB Online</h1>
        <p>Silakan isi data pendaftaran dengan lengkap dan benar</p>
    </div>

    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))
        <div class="success-box">
            <div class="success-icon">🎉</div>
            <h2 class="success-title">{{ session('success') }}</h2>
            
            @if(session('tracking_code'))
                <p style="color: #065F46; font-weight: 600; margin: 20px 0;">Kode Tracking Anda:</p>
                <div class="tracking-code">{{ session('tracking_code') }}</div>
                <p style="color: #065F46; font-size: 14px;">Simpan kode ini untuk cek status pendaftaran!</p>
            @endif
            
            <div style="margin-top: 30px;">
                <a href="/" class="btn-submit" style="display: inline-block; width: auto; padding: 14px 30px;">
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    @endif

    {{-- FORM PENDAFTARAN --}}
    @if(!session('success'))    
        <div class="ppdb-card">
            <form action="{{ route('ppdb.store') }}" method="POST" id="ppdbForm">
                @csrf
                
                {{-- SECTION 1: DATA PRIBADI --}}
                <div class="form-section">
                    <h3 class="form-section-title">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Data Pribadi Calon Siswa
                    </h3>
                    
                    <div class="form-group">
                        <label for="nama_lengkap" class="form-label">
                            Nama Lengkap <span class="required">*</span>
                        </label>
                        <input type="text" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required class="form-input" placeholder="Masukkan nama lengkap">
                        @error('nama_lengkap') <small class="form-error">{{ $message }}</small> @enderror
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="nisn" class="form-label">
                                NISN <span class="required">*</span>
                            </label>
                            <input type="text" id="nisn" name="nisn" value="{{ old('nisn') }}" required pattern="[0-9]{8,12}" class="form-input" placeholder="10 digit angka">
                            <small class="form-hint">Nomor Induk Siswa Nasional</small>
                            @error('nisn') <small class="form-error">{{ $message }}</small> @enderror
                        </div>
                        <div class="form-group">
                            <label for="asal_sekolah" class="form-label">
                                Asal Sekolah <span class="required">*</span>
                            </label>
                            <input type="text" id="asal_sekolah" name="asal_sekolah" value="{{ old('asal_sekolah') }}" required class="form-input" placeholder="Contoh: SMP Negeri 1 Medan">
                            @error('asal_sekolah') <small class="form-error">{{ $message }}</small> @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="alamat" class="form-label">
                            Alamat Lengkap <span class="required">*</span>
                        </label>
                        <textarea id="alamat" name="alamat" rows="3" required class="form-input" placeholder="Masukkan alamat lengkap sesuai KTP/KK">{{ old('alamat') }}</textarea>
                        @error('alamat') <small class="form-error">{{ $message }}</small> @enderror
                    </div>

                    <div class="form-group">
                        <label for="no_hp" class="form-label">
                            No. HP / WhatsApp <span class="required">*</span>
                        </label>
                        <input type="tel" id="no_hp" name="no_hp" value="{{ old('no_hp') }}" required class="form-input" placeholder="081234567890">
                        @error('no_hp') <small class="form-error">{{ $message }}</small> @enderror
                    </div>
                </div>

                {{-- SECTION 2: DATA ORANG TUA --}}
                <div class="form-section">
                    <h3 class="form-section-title">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        Data Orang Tua / Wali
                    </h3>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="nama_ortu" class="form-label">
                                Nama Orang Tua / Wali <span class="required">*</span>
                            </label>
                            <input type="text" id="nama_ortu" name="nama_ortu" value="{{ old('nama_ortu') }}" required class="form-input" placeholder="Nama lengkap orang tua">
                            @error('nama_ortu') <small class="form-error">{{ $message }}</small> @enderror
                        </div>
                        <div class="form-group">
                            <label for="pekerjaan_ortu" class="form-label">
                                Pekerjaan Orang Tua <span class="required">*</span>
                            </label>
                            <input type="text" id="pekerjaan_ortu" name="pekerjaan_ortu" value="{{ old('pekerjaan_ortu') }}" required class="form-input" placeholder="Contoh: PNS, Wiraswasta, Guru">
                            @error('pekerjaan_ortu') <small class="form-error">{{ $message }}</small> @enderror
                        </div>
                    </div>
                </div>

                {{-- SECTION 3: ALASAN --}}
                <div class="form-section">
                    <h3 class="form-section-title">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Informasi Tambahan
                    </h3>
                    
                    <div class="form-group">
                        <label for="alasan" class="form-label">
                            Alasan Memilih Sekolah Kami
                        </label>
                        <textarea id="alasan" name="alasan" rows="4" class="form-input" placeholder="Ceritakan alasan Anda memilih sekolah kami (opsional)">{{ old('alasan') }}</textarea>
                        <small class="form-hint">Field ini opsional, tapi sangat membantu kami memahami motivasi Anda</small>
                    </div>
                </div>

                <button type="submit" id="btn-submit" class="btn-submit">
                    🚀 Kirim Pendaftaran
                </button>
            </form>
        </div>
    @endif

</div>

<script>
    const ppdbForm = document.getElementById('ppdbForm');
    if(ppdbForm) {
        ppdbForm.addEventListener('submit', function() {
            const btn = document.getElementById('btn-submit');
            if(btn) {
                btn.disabled = true;
                btn.innerHTML = '⏳ Mengirim Data...';
            }
        });
    }
</script>
@endsection