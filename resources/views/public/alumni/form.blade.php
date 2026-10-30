@extends('layouts.app')

@section('title', 'Registrasi Alumni')

@section('content')

<style>
    /* =========================================
       1. CSS VARIABLES & THEME
       ========================================= */
    :root {
        --bg-primary: #F8FAFC;
        --bg-secondary: #FFFFFF;
        --bg-tertiary: #F1F5F9;
        --text-primary: #0F172A;
        --text-secondary: #475569;
        --text-muted: #94A3B8;
        --border-color: #E2E8F0;
        --accent-color: #10B981;
        --accent-hover: #059669;
        --primary-color: #1D3557;
        --primary-hover: #457B9D;
        --shadow-sm: 0 1px 3px rgba(0,0,0,0.05);
        --shadow-md: 0 4px 6px -1px rgba(0,0,0,0.1);
        --shadow-lg: 0 10px 15px -3px rgba(0,0,0,0.1);
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
    }

    /* =========================================
       2. GLOBAL RESET & ANIMATIONS
       ========================================= */
    * { margin: 0; padding: 0; box-sizing: border-box; }
    
    .alumni-register-wrapper { 
        max-width: 800px; 
        margin: 40px auto; 
        padding: 0 20px; 
        animation: fadeInUp 0.6s ease-out;
    }

    @keyframes fadeInDown { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes slideIn { from { opacity: 0; transform: scale(0.96) translateY(20px); } to { opacity: 1; transform: scale(1) translateY(0); } }
    @keyframes bounceIn { 0% { transform: scale(0.8); opacity: 0; } 60% { transform: scale(1.05); opacity: 1; } 100% { transform: scale(1); } }

    /* =========================================
       3. HEADER & SUCCESS MESSAGE
       ========================================= */
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
    }

    .success-card {
        background: linear-gradient(135deg, #D1FAE5 0%, #A7F3D0 100%);
        padding: 40px;
        border-radius: 20px;
        margin-bottom: 30px;
        border: 2px solid #10B981;
        text-align: center;
        box-shadow: 0 10px 30px rgba(16, 185, 129, 0.15);
        animation: bounceIn 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .success-icon { font-size: 60px; margin-bottom: 15px; display: inline-block; animation: bounceIn 0.8s ease-out 0.2s backwards; }
    .success-card h2 { color: #065F46; margin: 0 0 15px 0; font-size: 26px; font-weight: 700; }
    .success-card p { color: #064E3B; margin: 0; font-size: 15px; line-height: 1.6; }
    
    .btn-success-action {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-top: 25px;
        background: var(--primary-color);
        color: white;
        padding: 14px 30px;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        transition: var(--transition-smooth);
        box-shadow: 0 4px 12px rgba(29, 53, 87, 0.2);
    }
    .btn-success-action:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(29, 53, 87, 0.3);
        background: var(--primary-hover);
    }
    .btn-success-action:active { transform: translateY(0) scale(0.98); }

    [data-theme="dark"] .success-card {
        background: linear-gradient(135deg, #064E3B 0%, #065F46 100%) !important;
        border-color: #10B981 !important;
    }
    [data-theme="dark"] .success-card h2 { color: #6EE7B7 !important; }
    [data-theme="dark"] .success-card p { color: #D1FAE5 !important; }

    /* =========================================
       4. FORM CARD & ELEMENTS
       ========================================= */
    .form-card { 
        background: var(--bg-secondary); 
        padding: 40px; 
        border-radius: 20px; 
        box-shadow: var(--shadow-lg); 
        border: 1px solid var(--border-color);
        animation: slideIn 0.6s cubic-bezier(0.4, 0, 0.2, 1) 0.1s backwards;
    }

    .form-group { 
        margin-bottom: 24px; 
        animation: fadeInUp 0.5s ease-out backwards;
    }
    .form-group:nth-child(1) { animation-delay: 0.15s; }
    .form-group:nth-child(2) { animation-delay: 0.2s; }
    .form-group:nth-child(3) { animation-delay: 0.25s; }
    .form-group:nth-child(4) { animation-delay: 0.3s; }
    .form-group:nth-child(5) { animation-delay: 0.35s; }
    .form-group:nth-child(6) { animation-delay: 0.4s; }

    .form-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
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

    .form-input, .form-select, .form-textarea { 
        width: 100%; 
        padding: 12px 16px; 
        border: 2px solid var(--border-color); 
        border-radius: 12px; 
        font-size: 14px; 
        background: var(--bg-primary);
        color: var(--text-primary);
        transition: var(--transition-smooth); 
        font-family: inherit;
    }
    .form-input:focus, .form-select:focus, .form-textarea:focus { 
        border-color: var(--accent-color); 
        outline: none; 
        background: var(--bg-secondary);
        box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1);
        transform: translateY(-2px);
    }
    .form-textarea { resize: vertical; min-height: 100px; }
    .form-input::placeholder, .form-textarea::placeholder { color: var(--text-muted); }

    .hint { 
        font-size: 12px; 
        color: var(--text-muted); 
        margin-top: 6px; 
        font-style: italic;
    }

    /* Modern File Upload Area */
    .file-upload-wrapper {
        position: relative;
        border: 2px dashed var(--border-color);
        border-radius: 12px;
        padding: 24px 20px;
        text-align: center;
        background: var(--bg-primary);
        transition: var(--transition-smooth);
        cursor: pointer;
    }
    .file-upload-wrapper:hover, .file-upload-wrapper.dragover {
        border-color: var(--accent-color);
        background: rgba(16, 185, 129, 0.05);
    }
    .file-upload-wrapper input[type="file"] {
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        opacity: 0;
        cursor: pointer;
    }
    .file-upload-icon {
        font-size: 28px;
        margin-bottom: 8px;
        color: var(--text-muted);
        transition: var(--transition-smooth);
    }
    .file-upload-wrapper:hover .file-upload-icon {
        color: var(--accent-color);
        transform: translateY(-4px);
    }
    .file-upload-text {
        font-size: 14px;
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 4px;
    }
    .file-name-display {
        margin-top: 12px;
        font-size: 13px;
        color: var(--accent-color);
        font-weight: 600;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        opacity: 0;
        transform: translateY(5px);
        transition: var(--transition-smooth);
    }
    .file-name-display.active {
        opacity: 1;
        transform: translateY(0);
    }

    /* Submit Button */
    .btn-submit {
        width: 100%;
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-hover) 100%);
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
        animation: fadeInUp 0.5s ease-out 0.45s backwards;
    }
    .btn-submit:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(29, 53, 87, 0.3);
    }
    .btn-submit:active { transform: translateY(0) scale(0.98); }
    .btn-submit:disabled {
        background: var(--text-muted);
        cursor: not-allowed;
        transform: none;
        box-shadow: none;
    }

    /* Alert Error */
    .alert-error { 
        background: linear-gradient(135deg, #FEE2E2 0%, #FECACA 100%); 
        color: #991B1B; 
        padding: 16px 20px; 
        border-radius: 12px; 
        margin-bottom: 24px; 
        border-left: 4px solid #EF4444;
        animation: fadeInDown 0.5s ease-out;
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.15);
    }
    .alert-error strong { display: block; margin-bottom: 8px; font-size: 15px; }
    .alert-error ul { margin: 0; padding-left: 20px; font-size: 14px; }
    .alert-error li { margin-bottom: 4px; }
    [data-theme="dark"] .alert-error {
        background: linear-gradient(135deg, #7F1D1D 0%, #991B1B 100%) !important;
        color: #FCA5A5 !important;
    }

    /* =========================================
       5. RESPONSIVE
       ========================================= */
    @media (max-width: 768px) {
        .alumni-register-wrapper { margin: 20px auto; padding: 0 15px; }
        .page-header h1 { font-size: 26px; }
        .form-card { padding: 25px 20px; }
        .form-row { grid-template-columns: 1fr; }
        .success-card { padding: 30px 20px; }
    }
</style>

<div class="alumni-register-wrapper">
    <div class="page-header">
        <h1>🎓 Registrasi Alumni</h1>
        <p>Bagikan perjalananmu setelah lulus untuk menginspirasi adik kelas.</p>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="success-card">
            <div class="success-icon">🎉</div>
            <h2>{{ session('success') }}</h2>
            <p>Data kamu akan direview oleh admin. Terima kasih sudah berbagi dan menjadi bagian dari kebanggaan sekolah!</p>
            <a href="/alumni" class="btn-success-action">
                Lihat Alumni Lainnya →
            </a>
        </div>
    @endif

    @if(!session('success'))
    <div class="form-card">
        @if($errors->any())
            <div class="alert-error">
                <strong>⚠️ Ada kesalahan pada input:</strong>
                <ul>
                    @foreach($errors->all() as $error) 
                        <li>{{ $error }}</li> 
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/alumni/daftar" method="POST" enctype="multipart/form-data" id="alumniForm">
            @csrf
            
            <div class="form-group">
                <label class="form-label" for="nama_lengkap">Nama Lengkap <span class="required">*</span></label>
                <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-input" value="{{ old('nama_lengkap') }}" required placeholder="Contoh: Budi Santoso">
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label" for="tahun_lulus">Tahun Lulus <span class="required">*</span></label>
                    <input type="number" id="tahun_lulus" name="tahun_lulus" class="form-input" value="{{ old('tahun_lulus') }}" required min="1950" max="{{ date('Y') }}" placeholder="Contoh: 2020">
                </div>
                <div class="form-group">
                    <label class="form-label" for="jurusan">Jurusan di Sekolah</label>
                    <input type="text" id="jurusan" name="jurusan" class="form-input" value="{{ old('jurusan') }}" placeholder="Contoh: Rekayasa Perangkat Lunak">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label" for="email">Email <span class="required">*</span></label>
                    <input type="email" id="email" name="email" class="form-input" value="{{ old('email') }}" required placeholder="email@contoh.com">
                </div>
                <div class="form-group">
                    <label class="form-label" for="no_hp">Nomor HP / WhatsApp <span class="required">*</span></label>
                    <input type="tel" id="no_hp" name="no_hp" class="form-input" value="{{ old('no_hp') }}" required placeholder="08xxxxxxxxxx">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="status_sekarang">Status Sekarang <span class="required">*</span></label>
                <select id="status_sekarang" name="status_sekarang" class="form-select" required>
                    <option value="">-- Pilih Status --</option>
                    <option value="Kuliah" {{ old('status_sekarang') == 'Kuliah' ? 'selected' : '' }}>🎓 Sedang Kuliah</option>
                    <option value="Kerja" {{ old('status_sekarang') == 'Kerja' ? 'selected' : '' }}>💼 Sudah Bekerja</option>
                    <option value="Wirausaha" {{ old('status_sekarang') == 'Wirausaha' ? 'selected' : '' }}>🚀 Wirausaha / Bisnis Sendiri</option>
                    <option value="Lainnya" {{ old('status_sekarang') == 'Lainnya' ? 'selected' : '' }}>📌 Lainnya</option>
                </select>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label" for="nama_instansi">Nama Instansi (Kampus/Perusahaan)</label>
                    <input type="text" id="nama_instansi" name="nama_instansi" class="form-input" value="{{ old('nama_instansi') }}" placeholder="Contoh: Universitas Sumatera Utara">
                </div>
                <div class="form-group">
                    <label class="form-label" for="jabatan">Jabatan / Posisi</label>
                    <input type="text" id="jabatan" name="jabatan" class="form-input" value="{{ old('jabatan') }}" placeholder="Contoh: Mahasiswa / Staff IT">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="foto">Foto Profil (Opsional)</label>
                <div class="file-upload-wrapper" id="dropZone">
                    <input type="file" id="foto" name="foto" accept="image/jpeg,image/png,image/jpg">
                    <div class="file-upload-icon">📷</div>
                    <div class="file-upload-text">Klik atau seret foto ke sini</div>
                    <p class="hint" style="margin-top: 0;">Format: JPG, PNG. Maksimal 2MB.</p>
                    <div class="file-name-display" id="fileNameDisplay">
                        <span>✅</span> <span id="fileNameText"></span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="testimoni">Testimoni / Pesan untuk Adik Kelas</label>
                <textarea id="testimoni" name="testimoni" class="form-textarea" rows="4" placeholder="Bagikan pengalaman atau motivasi untuk adik kelas...">{{ old('testimoni') }}</textarea>
            </div>

            <button type="submit" id="btnSubmit" class="btn-submit">
                🚀 Kirim Data Saya
            </button>
        </form>
    </div>
    @endif
</div>

<script>
    // 1. Modern File Input UX
    const fileInput = document.getElementById('foto');
    const fileNameDisplay = document.getElementById('fileNameDisplay');
    const fileNameText = document.getElementById('fileNameText');
    const dropZone = document.getElementById('dropZone');

    if (fileInput) {
        fileInput.addEventListener('change', function() {
            const file = this.files[0];
            
            if (file) {
                // Validasi ukuran (2MB)
                if (file.size > 2 * 1024 * 1024) {
                    alert('⚠️ Ukuran file melebihi batas maksimal 2MB!');
                    this.value = '';
                    fileNameDisplay.classList.remove('active');
                    return;
                }
                
                // Validasi tipe file
                if (!['image/jpeg', 'image/png', 'image/jpg'].includes(file.type)) {
                    alert('⚠️ Hanya file JPG atau PNG yang diperbolehkan!');
                    this.value = '';
                    fileNameDisplay.classList.remove('active');
                    return;
                }

                fileNameText.textContent = file.name + ' (' + (file.size / 1024 / 1024).toFixed(2) + ' MB)';
                fileNameDisplay.classList.add('active');
                dropZone.style.borderColor = 'var(--accent-color)';
                dropZone.style.background = 'rgba(16, 185, 129, 0.05)';
            } else {
                fileNameDisplay.classList.remove('active');
                dropZone.style.borderColor = '';
                dropZone.style.background = '';
            }
        });

        // Drag and Drop visual feedback
        ['dragenter', 'dragover'].forEach(eventName => {
            dropZone.addEventListener(eventName, (e) => {
                e.preventDefault();
                dropZone.classList.add('dragover');
            }, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, (e) => {
                e.preventDefault();
                dropZone.classList.remove('dragover');
            }, false);
        });
    }

    // 2. Cegah double submit saat mengirim data
    const alumniForm = document.getElementById('alumniForm');
    if (alumniForm) {
        alumniForm.addEventListener('submit', function() {
            const btn = document.getElementById('btnSubmit');
            if (btn) {
                btn.disabled = true;
                btn.innerHTML = '⏳ Mengirim Data...';
                btn.style.opacity = '0.8';
                btn.style.transform = 'scale(0.98)';
            }
        });
    }
</script>

@endsection