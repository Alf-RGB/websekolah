

<?php $__env->startSection('title', 'Formulir Lamaran Guru - SMK Multi Karya Medan'); ?>

<?php $__env->startSection('content'); ?>

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
        --accent-color: #667eea;
        --accent-hover: #764ba2;
        --success-color: #10B981;
        --error-color: #EF4444;
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
    @keyframes slideIn { from { opacity: 0; transform: scale(0.96) translateY(20px); } to { opacity: 1; transform: scale(1) translateY(0); } }
    @keyframes pulse { 0%, 100% { transform: scale(1); } 50% { transform: scale(1.05); } }

    /* =========================================
       2. WRAPPER & HEADER
       ========================================= */
    .form-lamaran-wrapper {
        max-width: 900px;
        margin: 40px auto;
        padding: 0 20px;
        animation: fadeInUp 0.6s ease-out;
    }

    .form-header {
        text-align: center;
        margin-bottom: 40px;
        animation: fadeInDown 0.6s ease-out;
    }

    .form-header-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 20px;
        background: linear-gradient(135deg, var(--accent-color) 0%, var(--accent-hover) 100%);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
        animation: pulse 2s infinite;
        transition: var(--transition-smooth);
    }
    .form-header-icon:hover {
        transform: scale(1.1) rotate(-5deg);
    }
    .form-header-icon svg {
        width: 40px;
        height: 40px;
        color: white;
    }

    .form-header h1 {
        font-size: 32px;
        font-weight: 800;
        color: var(--text-primary);
        margin: 0 0 10px 0;
        letter-spacing: -0.5px;
    }

    .form-header p {
        font-size: 16px;
        color: var(--text-secondary);
        margin: 0;
        line-height: 1.6;
    }

    /* =========================================
       3. FORM CARD & SECTIONS
       ========================================= */
    .form-card {
        background: var(--bg-secondary);
        border-radius: 24px;
        padding: 40px;
        box-shadow: var(--shadow-lg);
        border: 1px solid var(--border-color);
        margin-bottom: 30px;
        animation: slideIn 0.6s cubic-bezier(0.4, 0, 0.2, 1) 0.1s backwards;
    }

    .form-section { 
        margin-bottom: 35px; 
        animation: fadeInUp 0.5s ease-out backwards;
    }
    .form-section:nth-child(1) { animation-delay: 0.15s; }
    .form-section:nth-child(2) { animation-delay: 0.25s; }
    .form-section:nth-child(3) { animation-delay: 0.35s; }
    .form-section:last-child { margin-bottom: 0; }

    .form-section-title {
        font-size: 18px;
        font-weight: 700;
        color: var(--text-primary);
        margin: 0 0 20px 0;
        padding-bottom: 12px;
        border-bottom: 2px solid var(--border-color);
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .form-section-title svg {
        width: 22px;
        height: 22px;
        color: var(--accent-color);
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }
    .form-grid .form-group.full-width {
        grid-column: 1 / -1;
    }

    .form-group { margin-bottom: 20px; }

    .form-label {
        display: block;
        font-size: 14px;
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 8px;
    }
    .form-label .required { color: var(--error-color); margin-left: 3px; }

    .form-input, .form-select, .form-textarea {
        width: 100%;
        padding: 14px 18px;
        border: 2px solid var(--border-color);
        border-radius: 12px;
        font-size: 15px;
        background: var(--bg-primary);
        color: var(--text-primary);
        transition: var(--transition-smooth);
        box-sizing: border-box;
        font-family: inherit;
    }

    .form-input:focus, .form-select:focus, .form-textarea:focus {
        outline: none;
        border-color: var(--accent-color);
        background: var(--bg-secondary);
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        transform: translateY(-2px);
    }
    .form-input::placeholder, .form-textarea::placeholder { color: var(--text-muted); }
    .form-textarea { resize: vertical; min-height: 120px; }

    .form-hint {
        font-size: 13px;
        color: var(--text-secondary);
        margin-top: 6px;
    }

    /* =========================================
       4. FILE UPLOAD AREA
       ========================================= */
    .file-upload-wrapper { position: relative; }
    .file-upload-input { display: none; }

    .file-upload-label {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        padding: 24px 20px;
        border: 2px dashed var(--border-color);
        border-radius: 12px;
        background: var(--bg-primary);
        cursor: pointer;
        transition: var(--transition-smooth);
        text-align: center;
    }

    .file-upload-label:hover, .file-upload-label.dragover {
        border-color: var(--accent-color);
        background: rgba(102, 126, 234, 0.05);
        transform: translateY(-2px);
    }
    .file-upload-label svg { 
        width: 24px; 
        height: 24px; 
        color: var(--accent-color);
        transition: var(--transition-smooth);
    }
    .file-upload-label:hover svg {
        transform: translateY(-4px);
    }
    .file-upload-text { font-size: 14px; color: var(--text-secondary); }
    .file-upload-text strong { color: var(--accent-color); }

    /* =========================================
       5. BUTTONS & ALERTS
       ========================================= */
    .btn-submit {
        width: 100%;
        padding: 16px;
        background: linear-gradient(135deg, var(--accent-color) 0%, var(--accent-hover) 100%);
        color: white;
        border: none;
        border-radius: 14px;
        font-size: 16px;
        font-weight: 700;
        cursor: pointer;
        transition: var(--transition-smooth);
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
        position: relative;
        overflow: hidden;
        animation: fadeInUp 0.5s ease-out 0.45s backwards;
    }

    .btn-submit::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
        transition: left 0.6s;
    }

    .btn-submit:hover::before { left: 100%; }
    .btn-submit:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 40px rgba(102, 126, 234, 0.4);
    }
    .btn-submit:active { transform: translateY(-1px) scale(0.98); }
    .btn-submit:disabled { 
        opacity: 0.7; 
        cursor: not-allowed; 
        transform: none; 
        box-shadow: none;
    }

    .alert-error {
        background: linear-gradient(135deg, #FEE2E2 0%, #FECACA 100%);
        border: 2px solid var(--error-color);
        border-radius: 16px;
        padding: 20px 25px;
        margin-bottom: 30px;
        display: flex;
        align-items: flex-start;
        gap: 15px;
        animation: slideIn 0.4s ease-out;
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.15);
    }
    .alert-error-icon {
        width: 24px;
        height: 24px;
        flex-shrink: 0;
        color: var(--error-color);
    }
    .alert-error-content { flex: 1; }
    .alert-error-title {
        font-size: 15px;
        font-weight: 700;
        color: #991B1B;
        margin: 0 0 8px 0;
    }
    .alert-error-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .alert-error-list li {
        font-size: 14px;
        color: #991B1B;
        margin-bottom: 5px;
        padding-left: 20px;
        position: relative;
    }
    .alert-error-list li::before {
        content: '•';
        position: absolute;
        left: 0;
        color: var(--error-color);
        font-weight: bold;
    }

    /* =========================================
       6. DARK MODE OVERRIDES
       ========================================= */
    [data-theme="dark"] .form-card { background: var(--bg-secondary) !important; border-color: var(--border-color) !important; }
    [data-theme="dark"] .form-header h1 { color: var(--text-primary) !important; }
    [data-theme="dark"] .form-header p { color: var(--text-secondary) !important; }
    [data-theme="dark"] .form-section-title { color: var(--text-primary) !important; border-color: var(--border-color) !important; }
    [data-theme="dark"] .form-label { color: var(--text-primary) !important; }
    [data-theme="dark"] .form-input, [data-theme="dark"] .form-select, [data-theme="dark"] .form-textarea {
        background: var(--bg-primary) !important; border-color: var(--border-color) !important; color: var(--text-primary) !important;
    }
    [data-theme="dark"] .form-input:focus, [data-theme="dark"] .form-select:focus, [data-theme="dark"] .form-textarea:focus {
        background: var(--bg-secondary) !important; border-color: var(--accent-color) !important;
    }
    [data-theme="dark"] .form-hint { color: var(--text-secondary) !important; }
    [data-theme="dark"] .file-upload-label { background: var(--bg-primary) !important; border-color: var(--border-color) !important; }
    [data-theme="dark"] .file-upload-label:hover { background: rgba(102, 126, 234, 0.1) !important; border-color: var(--accent-color) !important; }
    [data-theme="dark"] .alert-error { 
        background: linear-gradient(135deg, #7F1D1D 0%, #991B1B 100%) !important; 
        border-color: var(--error-color) !important; 
    }
    [data-theme="dark"] .alert-error-title, [data-theme="dark"] .alert-error-list li { color: #FCA5A5 !important; }

    /* =========================================
       7. RESPONSIVE
       ========================================= */
    @media (max-width: 768px) {
        .form-lamaran-wrapper { margin: 20px auto; padding: 0 15px; }
        .form-card { padding: 25px 20px; }
        .form-grid { grid-template-columns: 1fr; }
        .form-header h1 { font-size: 26px; }
    }
</style>

<div class="form-lamaran-wrapper">

    <div class="form-header">
        <div class="form-header-icon">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
        </div>
        <h1>Formulir Lamaran Guru</h1>
        <p>Silakan isi data dengan lengkap dan jujur. Kami menantikan potensi terbaik Anda!</p>
    </div>

    <?php if($errors->any()): ?>
    <div class="alert-error">
        <svg class="alert-error-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <div class="alert-error-content">
            <h3 class="alert-error-title">Ada kesalahan pada input:</h3>
            <ul class="alert-error-list">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    </div>
    <?php endif; ?>

    <div class="form-card">
        <form action="<?php echo e(route('join-us.guru.store')); ?>" method="POST" enctype="multipart/form-data" id="formLamaran">
            <?php echo csrf_field(); ?>

            
            <div class="form-section">
                <h2 class="form-section-title">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Data Pribadi
                </h2>
                <div class="form-grid">
                    <div class="form-group full-width">
                        <label class="form-label">Nama Lengkap <span class="required">*</span></label>
                        <input type="text" name="nama_lengkap" class="form-input" placeholder="Masukkan nama lengkap Anda" value="<?php echo e(old('nama_lengkap')); ?>" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Email <span class="required">*</span></label>
                        <input type="email" name="email" class="form-input" placeholder="contoh@email.com" value="<?php echo e(old('email')); ?>" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">No. HP / WhatsApp <span class="required">*</span></label>
                        <input type="tel" name="no_hp" class="form-input" placeholder="08xxxxxxxxxx" value="<?php echo e(old('no_hp')); ?>" required>
                    </div>
                </div>
            </div>

            
            <div class="form-section">
                <h2 class="form-section-title">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                    </svg>
                    Pendidikan & Pengalaman
                </h2>
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Pendidikan Terakhir <span class="required">*</span></label>
                        <select name="pendidikan_terakhir" class="form-select" required>
                            <option value="">Pilih Pendidikan</option>
                            <option value="SMA/SMK" <?php echo e(old('pendidikan_terakhir') == 'SMA/SMK' ? 'selected' : ''); ?>>SMA/SMK</option>
                            <option value="D3" <?php echo e(old('pendidikan_terakhir') == 'D3' ? 'selected' : ''); ?>>D3 (Diploma)</option>
                            <option value="S1" <?php echo e(old('pendidikan_terakhir') == 'S1' ? 'selected' : ''); ?>>S1 (Sarjana)</option>
                            <option value="S2" <?php echo e(old('pendidikan_terakhir') == 'S2' ? 'selected' : ''); ?>>S2 (Magister)</option>
                            <option value="S3" <?php echo e(old('pendidikan_terakhir') == 'S3' ? 'selected' : ''); ?>>S3 (Doktor)</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Jurusan / Program Studi <span class="required">*</span></label>
                        <input type="text" name="jurusan" class="form-input" placeholder="Contoh: Teknik Informatika" value="<?php echo e(old('jurusan')); ?>" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Mata Pelajaran yang Diinginkan <span class="required">*</span></label>
                        <input type="text" name="mata_pelajaran_diinginkan" class="form-input" placeholder="Contoh: Matematika, Bahasa Indonesia" value="<?php echo e(old('mata_pelajaran_diinginkan')); ?>" required>
                        <p class="form-hint">Mata pelajaran yang ingin Anda ajarkan</p>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Pengalaman Mengajar</label>
                        <input type="text" name="pengalaman_mengajar" class="form-input" placeholder="Contoh: 2 tahun di SMA Negeri 1" value="<?php echo e(old('pengalaman_mengajar')); ?>">
                        <p class="form-hint">Opsional, tapi sangat membantu proses seleksi</p>
                    </div>
                </div>
            </div>

            
            <div class="form-section">
                <h2 class="form-section-title">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Dokumen & Motivasi
                </h2>
                <div class="form-grid">
                    <div class="form-group full-width">
                        <label class="form-label">Upload CV / Resume</label>
                        <div class="file-upload-wrapper" id="dropZone">
                            <input type="file" name="file_cv" id="file_cv" class="file-upload-input" accept=".pdf">
                            <label for="file_cv" class="file-upload-label">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                </svg>
                                <span class="file-upload-text"><strong>Klik untuk upload</strong> atau drag & drop<br>Format PDF (Maksimal 2MB)</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group full-width">
                        <label class="form-label">Alasan Melamar <span class="required">*</span></label>
                        <textarea name="alasan_melamar" class="form-textarea" rows="4" placeholder="Ceritakan mengapa Anda ingin bergabung dengan kami dan apa yang bisa Anda kontribusikan..." required><?php echo e(old('alasan_melamar')); ?></textarea>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn-submit" id="btnSubmit">
                Kirim Lamaran
            </button>
        </form>
    </div>

</div>

<script>
    // 1. Modern File Upload UX
    const fileInput = document.getElementById('file_cv');
    const dropZone = document.getElementById('dropZone');
    const uploadLabel = dropZone.querySelector('.file-upload-label');
    const textSpan = uploadLabel.querySelector('.file-upload-text');

    if (fileInput) {
        fileInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                // Validasi ukuran (2MB)
                if (file.size > 2 * 1024 * 1024) {
                    alert('⚠️ Ukuran file melebihi batas maksimal 2MB!');
                    this.value = '';
                    resetUploadUI();
                    return;
                }
                
                // Validasi tipe file
                if (file.type !== 'application/pdf') {
                    alert('⚠️ Hanya file PDF yang diperbolehkan!');
                    this.value = '';
                    resetUploadUI();
                    return;
                }

                textSpan.innerHTML = `<strong>${file.name}</strong><br>File berhasil dipilih (${(file.size / 1024 / 1024).toFixed(2)} MB)`;
                uploadLabel.style.borderColor = 'var(--success-color)';
                uploadLabel.style.background = 'rgba(16, 185, 129, 0.05)';
            } else {
                resetUploadUI();
            }
        });

        // Drag and Drop visual feedback
        ['dragenter', 'dragover'].forEach(eventName => {
            dropZone.addEventListener(eventName, (e) => {
                e.preventDefault();
                uploadLabel.classList.add('dragover');
            }, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, (e) => {
                e.preventDefault();
                uploadLabel.classList.remove('dragover');
            }, false);
        });
    }

    function resetUploadUI() {
        textSpan.innerHTML = `<strong>Klik untuk upload</strong> atau drag & drop<br>Format PDF (Maksimal 2MB)`;
        uploadLabel.style.borderColor = '';
        uploadLabel.style.background = '';
    }

    // 2. Form submit loading state
    const formLamaran = document.getElementById('formLamaran');
    if (formLamaran) {
        formLamaran.addEventListener('submit', function() {
            const btn = document.getElementById('btnSubmit');
            if (btn) {
                btn.disabled = true;
                btn.innerHTML = '⏳ Mengirim Lamaran...';
                btn.style.opacity = '0.8';
                btn.style.transform = 'scale(0.98)';
            }
        });
    }
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\sekolah-app-v2\resources\views/public/join-us/form-guru.blade.php ENDPATH**/ ?>