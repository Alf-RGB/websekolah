

<?php $__env->startSection('title', 'Edit Identitas Sekolah - Admin'); ?>

<?php $__env->startSection('content'); ?>

<style>
    /* =========================================
       LIGHT MODE (Default)
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
        --warning-color: #F59E0B;
        --card-bg: #FFFFFF;
        --input-bg: #F8FAFC;
        --transition-smooth: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* =========================================
       DARK MODE
       ========================================= */
    [data-theme="dark"] {
        --bg-primary: #0F172A;
        --bg-secondary: #1E293B;
        --bg-tertiary: #334155;
        --text-primary: #F1F5F9;
        --text-secondary: #CBD5E1;
        --text-muted: #94A3B8;
        --border-color: #334155;
        --accent-color: #667eea;
        --accent-hover: #764ba2;
        --success-color: #10B981;
        --error-color: #EF4444;
        --warning-color: #F59E0B;
        --card-bg: #1E293B;
        --input-bg: #0F172A;
    }

    @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes slideIn { from { opacity: 0; transform: scale(0.95); } to { opacity: 1; transform: scale(1); } }
    @keyframes spin { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }
    @keyframes modalPop { from { opacity: 0; transform: scale(0.9) translateY(10px); } to { opacity: 1; transform: scale(1) translateY(0); } }

    .settings-edit-wrapper { max-width: 1000px; margin: 0 auto; padding: 30px; animation: fadeInUp 0.6s ease; }

    .edit-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        flex-wrap: wrap;
        gap: 15px;
        animation: fadeInUp 0.6s ease;
    }
    .edit-header-title {
        font-size: 28px;
        font-weight: 800;
        color: var(--text-primary);
        margin: 0 0 5px 0;
    }
    .edit-header-subtitle {
        font-size: 14px;
        color: var(--text-secondary);
        margin: 0;
    }

    .alert-success {
        background: rgba(16, 185, 129, 0.15);
        border: 1px solid rgba(16, 185, 129, 0.3);
        border-radius: 12px;
        padding: 15px 20px;
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        gap: 12px;
        animation: fadeInUp 0.5s ease;
    }
    .alert-success svg { width: 24px; height: 24px; color: #6EE7B7; flex-shrink: 0; }
    .alert-success span { color: #6EE7B7; font-weight: 600; font-size: 14px; }

    .alert-error {
        background: rgba(239, 68, 68, 0.15);
        border: 1px solid rgba(239, 68, 68, 0.3);
        border-radius: 12px;
        padding: 15px 20px;
        margin-bottom: 25px;
        animation: fadeInUp 0.5s ease;
    }
    .alert-error-title {
        color: #FCA5A5;
        font-weight: 700;
        font-size: 14px;
        margin: 0 0 8px 0;
    }
    .alert-error ul {
        margin: 0;
        padding-left: 20px;
        color: #FCA5A5;
        font-size: 13px;
    }

    .form-card {
        background: var(--bg-secondary);
        border-radius: 20px;
        padding: 35px;
        box-shadow: 0 10px 15px -3px rgba(0,0,0,0.05);
        border: 1px solid var(--border-color);
        margin-bottom: 25px;
        animation: slideIn 0.6s cubic-bezier(0.4, 0, 0.2, 1) backwards;
    }
    .form-card.card-dasar { animation-delay: 0.1s; }
    .form-card.card-kontak { animation-delay: 0.2s; }
    .form-card.card-logo { animation-delay: 0.3s; }

    .form-section-title {
        background: linear-gradient(135deg, var(--accent-color), var(--accent-hover));
        color: white;
        padding: 18px 25px;
        border-radius: 12px;
        margin: 0 0 25px 0;
        font-size: 16px;
        font-weight: 700;
    }
    .form-card.card-kontak .form-section-title {
        background: linear-gradient(135deg, #8B5CF6 0%, #7C3AED 100%);
    }
    .form-card.card-logo .form-section-title {
        background: linear-gradient(135deg, var(--success-color), #059669);
    }

    .form-group { margin-bottom: 25px; animation: fadeInUp 0.5s ease backwards; }
    .form-card.card-dasar .form-group:nth-child(2) { animation-delay: 0.2s; }
    .form-card.card-dasar .form-group:nth-child(3) { animation-delay: 0.25s; }
    .form-card.card-kontak .form-row { animation: fadeInUp 0.5s ease 0.3s backwards; }
    .form-card.card-kontak .form-group:nth-child(3) { animation-delay: 0.35s; }

    .form-label {
        display: block;
        font-size: 13px;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 8px;
        letter-spacing: 0.3px;
    }
    .form-label .required { color: var(--error-color); margin-left: 2px; }
    
    .form-input, .form-textarea {
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
    .form-input:focus, .form-textarea:focus {
        outline: none;
        border-color: var(--accent-color);
        background: var(--bg-secondary);
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        transform: translateY(-2px);
    }
    .form-textarea { resize: vertical; min-height: 100px; }
    
    .form-hint {
        font-size: 12px;
        color: var(--text-muted);
        margin-top: 6px;
        display: block;
    }

    .form-row {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }

    /* PHOTO UPLOAD SECTION */
    .photo-upload-section {
        background: var(--bg-primary);
        border-radius: 16px;
        padding: 30px;
        border: 2px dashed var(--border-color);
        transition: var(--transition-smooth);
        animation: fadeInUp 0.5s ease 0.35s backwards;
    }
    .photo-upload-section:hover {
        border-color: var(--accent-color);
        background: rgba(102, 126, 234, 0.05);
    }
    .photo-upload-title {
        color: var(--text-primary);
        font-size: 16px;
        font-weight: 700;
        margin: 0 0 20px 0;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .photo-preview-container {
        display: flex;
        gap: 30px;
        align-items: flex-start;
        flex-wrap: wrap;
    }
    
    .current-photo {
        width: 180px;
        height: 180px;
        border-radius: 16px;
        object-fit: contain;
        border: 3px solid var(--border-color);
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.4);
        transition: var(--transition-smooth);
        display: block;
        margin-bottom: 12px;
        background: var(--bg-secondary);
        padding: 10px;
    }
    .current-photo:hover {
        transform: scale(1.02);
        border-color: var(--accent-color);
    }
    .photo-placeholder {
        width: 180px;
        height: 180px;
        border-radius: 16px;
        background: var(--bg-tertiary);
        border: 3px dashed var(--border-color);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        gap: 10px;
        color: var(--text-muted);
        margin-bottom: 12px;
    }
    
    .upload-label {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        padding: 60px 30px;
        background: var(--bg-secondary);
        border: 2px dashed var(--border-color);
        border-radius: 12px;
        cursor: pointer;
        transition: var(--transition-smooth);
        flex-direction: column;
        width: 100%;
    }
    .upload-label:hover {
        border-color: var(--accent-color);
        background: rgba(102, 126, 234, 0.05);
        transform: translateY(-2px);
    }
    .upload-label.dragover {
        border-color: var(--success-color);
        background: rgba(16, 185, 129, 0.1);
    }
    .upload-text {
        color: var(--text-secondary);
        font-size: 14px;
        text-align: center;
        margin: 0;
    }
    .upload-text strong {
        color: var(--accent-color);
        display: block;
        margin-bottom: 5px;
        font-size: 15px;
    }

    /* ============================================
       TOMBOL HAPUS LOGO - CENTER & COLORED
       ============================================ */
    .btn-remove-photo {
        background: linear-gradient(135deg, #EF4444 0%, #DC2626 100%) !important;
        color: #FFFFFF !important;
        border: none !important;
        padding: 10px 20px !important;
        border-radius: 8px !important;
        font-weight: 600 !important;
        font-size: 13px !important;
        cursor: pointer !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 6px !important;
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.4) !important;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
        width: auto !important;
        margin: 12px auto 0 auto !important;
    }

    .btn-remove-photo:hover {
        background: linear-gradient(135deg, #DC2626 0%, #B91C1C 100%) !important;
        box-shadow: 0 6px 20px rgba(239, 68, 68, 0.5) !important;
        transform: translateY(-2px) !important;
    }

    [data-theme="dark"] .btn-remove-photo {
        background: linear-gradient(135deg, #F87171 0%, #EF4444 100%) !important;
        box-shadow: 0 4px 12px rgba(248, 113, 113, 0.4) !important;
    }

    [data-theme="dark"] .btn-remove-photo:hover {
        background: linear-gradient(135deg, #EF4444 0%, #DC2626 100%) !important;
        box-shadow: 0 6px 20px rgba(248, 113, 113, 0.5) !important;
    }

    .selected-file-info {
        background: rgba(16, 185, 129, 0.1);
        border: 1px solid rgba(16, 185, 129, 0.3);
        border-radius: 8px;
        padding: 12px 15px;
        margin-top: 15px;
        display: none;
        align-items: center;
        gap: 10px;
        animation: slideIn 0.3s ease-out;
    }
    .selected-file-info.show { display: flex; }
    .selected-file-info span {
        color: var(--text-primary);
        font-size: 13px;
        font-weight: 600;
    }

    /* ============================================
       MODAL KONFIRMASI - FULL STYLING & DARK MODE
       ============================================ */
    .custom-modal-overlay {
        position: fixed;
        top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(15, 23, 42, 0.85) !important;
        backdrop-filter: blur(6px) !important;
        -webkit-backdrop-filter: blur(6px) !important;
        display: none !important; /* HIDDEN BY DEFAULT */
        align-items: center !important;
        justify-content: center !important;
        z-index: 9999;
        opacity: 0; 
        visibility: hidden;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
    }

    /* SHOW STATE - INI KUNCI AGAR MODAL MUNCUL */
    .custom-modal-overlay.show {
        display: flex !important;
        opacity: 1 !important;
        visibility: visible !important;
    }

    [data-theme="dark"] .custom-modal-overlay {
        background: rgba(0, 0, 0, 0.9) !important;
    }

    .custom-modal {
        background: #FFFFFF !important;
        border: 1px solid #E2E8F0 !important;
        padding: 35px !important;
        border-radius: 20px !important;
        max-width: 450px !important;
        width: 90% !important;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.6) !important;
        text-align: center !important;
        transform: scale(0.9);
        transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
        animation: modalPop 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
    }

    .custom-modal-overlay.show .custom-modal {
        transform: scale(1);
    }

    [data-theme="dark"] .custom-modal {
        background: #1E293B !important;
        border-color: #334155 !important;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.8) !important;
    }

    .modal-icon {
        width: 70px;
        height: 70px;
        margin: 0 auto 20px;
        background: linear-gradient(135deg, #EF4444, #DC2626) !important;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 10px 25px rgba(239, 68, 68, 0.3) !important;
    }

    .modal-icon svg {
        width: 35px;
        height: 35px;
        color: white !important;
    }

    [data-theme="dark"] .modal-icon {
        background: linear-gradient(135deg, #F87171, #EF4444) !important;
        box-shadow: 0 10px 25px rgba(248, 113, 113, 0.4) !important;
    }

    .custom-modal h3 {
        color: #0F172A !important;
        margin: 0 0 12px 0 !important;
        font-size: 20px !important;
        font-weight: 700 !important;
    }

    [data-theme="dark"] .custom-modal h3 {
        color: #F1F5F9 !important;
    }

    .custom-modal p {
        color: #475569 !important;
        font-size: 14px !important;
        margin: 0 0 25px 0 !important;
        line-height: 1.6 !important;
    }

    [data-theme="dark"] .custom-modal p {
        color: #CBD5E1 !important;
    }

    .custom-modal-actions {
        display: flex;
        gap: 12px;
        justify-content: center;
        flex-wrap: wrap;
    }

    .modal-btn {
        padding: 12px 24px !important;
        border-radius: 10px !important;
        font-weight: 600 !important;
        font-size: 14px !important;
        cursor: pointer !important;
        border: 1px solid transparent !important;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
        display: inline-flex !important;
        align-items: center !important;
        gap: 8px !important;
        min-width: 120px !important;
        justify-content: center !important;
    }

    .modal-btn-cancel {
        background: #475569 !important;
        color: #F1F5F9 !important;
        border: 1px solid #64748B !important;
    }

    [data-theme="dark"] .modal-btn-cancel {
        background: #334155 !important;
        color: #F1F5F9 !important;
        border-color: #475569 !important;
    }

    .modal-btn-cancel:hover {
        background: #64748B !important;
        transform: translateY(-2px) !important;
    }

    [data-theme="dark"] .modal-btn-cancel:hover {
        background: #475569 !important;
    }

    .modal-btn-confirm {
        background: linear-gradient(135deg, #EF4444, #DC2626) !important;
        color: white !important;
        border: none !important;
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.4) !important;
    }

    [data-theme="dark"] .modal-btn-confirm {
        background: linear-gradient(135deg, #F87171, #EF4444) !important;
        box-shadow: 0 4px 12px rgba(248, 113, 113, 0.4) !important;
    }

    .modal-btn-confirm:hover {
        background: linear-gradient(135deg, #DC2626, #B91C1C) !important;
        box-shadow: 0 6px 20px rgba(239, 68, 68, 0.5) !important;
        transform: translateY(-2px) !important;
    }

    [data-theme="dark"] .modal-btn-confirm:hover {
        background: linear-gradient(135deg, #EF4444, #DC2626) !important;
        box-shadow: 0 6px 20px rgba(248, 113, 113, 0.5) !important;
    }

    .modal-btn svg {
        width: 16px;
        height: 16px;
    }

    .modal-btn-confirm svg {
        color: #FFFFFF !important;
        stroke: #FFFFFF !important;
    }

    .form-actions {
        display: flex;
        gap: 15px;
        justify-content: flex-end;
        margin-top: 30px;
        padding-top: 25px;
        border-top: 2px solid var(--border-color);
        animation: fadeInUp 0.5s ease 0.45s backwards;
    }

    .btn {
        padding: 14px 30px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
        transition: var(--transition-smooth);
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
    }
    .btn-primary {
        background: linear-gradient(135deg, var(--success-color), #059669);
        color: white;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
    }
    .btn-secondary {
        background: var(--bg-tertiary);
        color: var(--text-secondary);
        border: 1px solid var(--border-color);
    }
    .btn-secondary:hover {
        background: var(--border-color);
        color: var(--text-primary);
        transform: translateY(-2px);
    }
    .btn:disabled { opacity: 0.6; cursor: not-allowed; transform: none !important; }

    @media (max-width: 768px) {
        .settings-edit-wrapper { padding: 20px; }
        .edit-header { flex-direction: column; align-items: flex-start; }
        .form-card { padding: 25px 20px; }
        .form-row { grid-template-columns: 1fr; gap: 15px; }
        .photo-preview-container { flex-direction: column; }
        .form-actions { flex-direction: column-reverse; }
        .btn { width: 100%; justify-content: center; }
        .custom-modal { padding: 25px 20px; }
    }
</style>

<div class="settings-edit-wrapper">

    
    <div class="edit-header">
        <div>
            <h1 class="edit-header-title">Edit Identitas Sekolah</h1>
            <p class="edit-header-subtitle">Perbarui informasi dasar sekolah yang tampil di website publik.</p>
        </div>
    </div>

    
    <?php if(session('success')): ?>
    <div class="alert-success">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span><?php echo e(session('success')); ?></span>
    </div>
    <?php endif; ?>

    
    <?php if($errors->any()): ?>
    <div class="alert-error">
        <h3 class="alert-error-title">⚠️ Ada kesalahan pada input:</h3>
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
    <?php endif; ?>

    
    <form action="<?php echo e(route('admin.settings.update')); ?>" method="POST" enctype="multipart/form-data" id="settingsForm">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        
        <div class="form-card card-dasar">
            <h3 class="form-section-title">Informasi Dasar Sekolah</h3>
            
            <div class="form-group">
                <label class="form-label">
                    Nama Sekolah <span class="required">*</span>
                </label>
                <input type="text" 
                       name="nama_sekolah" 
                       class="form-input" 
                       value="<?php echo e(old('nama_sekolah', $settings->firstWhere('key', 'nama_sekolah')->value ?? '')); ?>" 
                       required 
                       placeholder="Contoh: SMK Multi Karya Medan">
                <div class="form-hint">Nama resmi sekolah yang tampil di header website</div>
            </div>

            <div class="form-group">
                <label class="form-label">
                    Alamat Sekolah <span class="required">*</span>
                </label>
                <textarea name="alamat_sekolah" 
                          class="form-textarea" 
                          rows="3" 
                          required 
                          placeholder="Jl. Contoh No. 123, Kota, Provinsi"><?php echo e(old('alamat_sekolah', $settings->firstWhere('key', 'alamat_sekolah')->value ?? '')); ?></textarea>
                <div class="form-hint">Alamat lengkap sekolah untuk footer dan halaman kontak</div>
            </div>
        </div>

        
        <div class="form-card card-kontak">
            <h3 class="form-section-title">Informasi Kontak</h3>
            
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Telepon Sekolah</label>
                    <input type="text" 
                           name="telepon_sekolah" 
                           class="form-input" 
                           value="<?php echo e(old('telepon_sekolah', $settings->firstWhere('key', 'telepon_sekolah')->value ?? '')); ?>" 
                           placeholder="081234567890">
                    <div class="form-hint">Nomor telepon kantor</div>
                </div>

                <div class="form-group">
                    <label class="form-label">Email Sekolah</label>
                    <input type="email" 
                           name="email_sekolah" 
                           class="form-input" 
                           value="<?php echo e(old('email_sekolah', $settings->firstWhere('key', 'email_sekolah')->value ?? '')); ?>" 
                           placeholder="sekolah@email.com">
                    <div class="form-hint">Email resmi sekolah</div>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Nomor WhatsApp</label>
                <input type="text" 
                       name="nomor_whatsapp" 
                       class="form-input" 
                       value="<?php echo e(old('nomor_whatsapp', $settings->firstWhere('key', 'nomor_whatsapp')->value ?? '')); ?>" 
                       placeholder="6281234567890">
                <div class="form-hint">Format: 62xxx (tanpa tanda '+' atau spasi, untuk tombol WhatsApp floating)</div>
            </div>
        </div>

        
        <div class="form-card card-logo">
            <h3 class="form-section-title">Logo Sekolah</h3>
            
            <div class="photo-upload-section">
                <h3 class="photo-upload-title">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    Upload Logo Sekolah
                </h3>

                <div class="photo-preview-container">
                    <div style="flex-shrink: 0;">
                        <span style="color: var(--text-muted); font-size: 12px; font-weight: 600; display: block; margin-bottom: 10px;">Preview Logo:</span>
                        
                        
                        <?php
                            $currentLogo = $settings->firstWhere('key', 'logo_sekolah');
                            $logoValue = $currentLogo ? $currentLogo->value : null;
                            $logoExists = $logoValue && \Storage::disk('public')->exists('logos/' . $logoValue);
                        ?>

                        <div id="currentPhotoContainer" style="<?php echo e($logoExists ? 'display: block;' : 'display: none;'); ?>">
                            <?php if($logoExists): ?>
                                <img id="logoPreview" 
                                     src="<?php echo e(asset('storage/logos/' . $logoValue)); ?>" 
                                     class="current-photo"
                                     alt="Preview Logo"
                                     onerror="this.style.display='none'; document.getElementById('photoPlaceholder').style.display='flex'; document.getElementById('currentPhotoContainer').querySelector('div:last-child').style.display='none';">
                            <?php endif; ?>
                            <div style="margin-top: 12px; text-align: center;">
                                
                                <input type="hidden" name="remove_logo" id="removeLogoInput" value="0">
                                
                                
                                <button type="button" 
                                        class="btn-remove-photo" 
                                        onclick="openDeleteModal()">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    Hapus Logo
                                </button>
                            </div>
                        </div>

                        
                        <div class="photo-placeholder" id="photoPlaceholder" style="<?php echo e($logoExists ? 'display: none;' : 'display: flex;'); ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="opacity: 0.5;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span style="font-size: 13px; font-weight: 600;">Belum ada logo</span>
                        </div>
                    </div>

                    <div style="flex: 1; min-width: 300px;">
                        <input type="file" 
                               id="logoInput" 
                               name="logo_sekolah" 
                               class="upload-input" 
                               accept="image/png,image/jpeg,image/jpg,image/svg+xml" 
                               onchange="handlePhotoChange(event)" 
                               style="display: none;">
                        <label for="logoInput" 
                               class="upload-label" 
                               id="uploadLabel" 
                               ondragover="handleDragOver(event)" 
                               ondragleave="handleDragLeave(event)" 
                               ondrop="handleDrop(event)">
                            <svg class="upload-icon" xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="color: var(--accent-color); transition: var(--transition-smooth);">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                            </svg>
                            <p class="upload-text">
                                <strong>Klik atau seret logo ke sini</strong>
                                <span class="form-hint" style="margin-top: 8px;">Format: JPG, PNG, SVG. Maksimal 10MB. File akan dikompresi otomatis menjadi < 2MB. Kosongkan jika tidak ingin mengubah logo.</span>
                            </p>
                        </label>
                        
                        <div class="selected-file-info" id="selectedFileInfo">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="color: var(--success-color); flex-shrink: 0;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span id="selectedFileName"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="form-actions">
            <a href="<?php echo e(route('admin.settings.index')); ?>" class="btn btn-secondary">
                Batal
            </a>
            <button type="submit" id="btn-submit" class="btn btn-primary">
                Simpan Perubahan
            </button>
        </div>
    </form>

</div>


<div class="custom-modal-overlay" id="deleteModalOverlay">
    <div class="custom-modal">
        <div class="modal-icon">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
            </svg>
        </div>
        <h3>Hapus Logo?</h3>
        <p>Apakah Anda yakin ingin menghapus logo sekolah ini?</p>
        <div class="custom-modal-actions">
            <button type="button" class="modal-btn modal-btn-cancel" onclick="closeDeleteModal()">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
                Batal
            </button>
            <button type="button" class="modal-btn modal-btn-confirm" onclick="confirmRemovePhoto()">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
                Ya, Hapus
            </button>
        </div>
    </div>
</div>

<script>
// ==========================================
// MODAL FUNCTIONS
// ==========================================
function openDeleteModal() {
    console.log('Opening modal...');
    const modal = document.getElementById('deleteModalOverlay');
    if(modal) {
        modal.classList.add('show');
        document.body.style.overflow = 'hidden';
    } else {
        console.error('Modal element not found!');
    }
}

function closeDeleteModal() {
    const modal = document.getElementById('deleteModalOverlay');
    if(modal) {
        modal.classList.remove('show');
        document.body.style.overflow = '';
    }
}

function confirmRemovePhoto() {
    const preview = document.getElementById('logoPreview');
    const noLogoText = document.getElementById('photoPlaceholder');
    const currentPhotoContainer = document.getElementById('currentPhotoContainer');
    const logoInput = document.getElementById('logoInput');
    const selectedFileInfo = document.getElementById('selectedFileInfo');
    const removeInput = document.getElementById('removeLogoInput');
    
    if(preview) {
        preview.src = '';
        preview.style.display = 'none';
    }
    if(currentPhotoContainer) {
        currentPhotoContainer.style.display = 'none';
    }
    if(noLogoText) {
        noLogoText.style.display = 'flex';
    }
    if(logoInput) {
        logoInput.value = '';
    }
    if(selectedFileInfo) {
        selectedFileInfo.classList.remove('show');
    }
    
    // Set hidden input to tell backend to remove logo
    if(removeInput) {
        removeInput.value = '1';
    }
    
    closeDeleteModal();
}

// Close modal when clicking outside
document.addEventListener('DOMContentLoaded', function() {
    const modalOverlay = document.getElementById('deleteModalOverlay');
    if(modalOverlay) {
        modalOverlay.addEventListener('click', function(e) {
            if (e.target === this) {
                closeDeleteModal();
            }
        });
    }
    
    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const modal = document.getElementById('deleteModalOverlay');
            if (modal && modal.classList.contains('show')) {
                closeDeleteModal();
            }
        }
    });
});

// ==========================================
// PHOTO UPLOAD FUNCTIONS
// ==========================================
function handlePhotoChange(event) {
    const file = event.target.files[0];
    if (file) {
        validateAndShowPhoto(file);
        previewImage(file);
    }
}

function handleDragOver(e) { 
    e.preventDefault(); 
    e.currentTarget.classList.add('dragover'); 
}

function handleDragLeave(e) { 
    e.currentTarget.classList.remove('dragover'); 
}

function handleDrop(e) {
    e.preventDefault();
    e.currentTarget.classList.remove('dragover');
    const file = e.dataTransfer.files[0];
    if (file) {
        validateAndShowPhoto(file);
        previewImage(file);
    }
}

function validateAndShowPhoto(file) {
    const maxSize = 10 * 1024 * 1024; // 10MB
    const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/svg+xml'];
    
    if (!allowedTypes.includes(file.type)) {
        alert('⚠️ Format file tidak didukung! Gunakan JPG, PNG, atau SVG.');
        return;
    }
    if (file.size > maxSize) {
        alert('⚠️ Ukuran file terlalu besar! Maksimal 10MB.');
        return;
    }
    
    const fileInfo = document.getElementById('selectedFileInfo');
    const fileName = document.getElementById('selectedFileName');
    const fileSize = (file.size / 1024 / 1024).toFixed(2);
    fileName.textContent = `${file.name} (${fileSize} MB)`;
    fileInfo.classList.add('show');
}

function previewImage(file) {
    const reader = new FileReader();
    reader.onload = function(e) {
        const preview = document.getElementById('logoPreview');
        const noLogoText = document.getElementById('photoPlaceholder');
        const currentPhotoContainer = document.getElementById('currentPhotoContainer');
        
        console.log('Preview loaded:', e.target.result);
        
        preview.src = e.target.result;
        preview.style.display = 'block';
        if(currentPhotoContainer) currentPhotoContainer.style.display = 'block';
        if(noLogoText) noLogoText.style.display = 'none';
        
        // Add scale animation
        preview.style.transform = 'scale(0.9)';
        setTimeout(() => {
            preview.style.transition = 'transform 0.3s cubic-bezier(0.4, 0, 0.2, 1)';
            preview.style.transform = 'scale(1)';
        }, 50);
    }
    reader.onerror = function(error) {
        console.error('Error reading file:', error);
        alert('Error membaca file!');
    }
    reader.readAsDataURL(file);
}

// ==========================================
// FORM SUBMIT HANDLER
// ==========================================
document.addEventListener('DOMContentLoaded', function() {
    const settingsForm = document.getElementById('settingsForm');
    if(settingsForm) {
        settingsForm.addEventListener('submit', function() {
            const btn = document.getElementById('btn-submit');
            if(btn) {
                btn.disabled = true;
                btn.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="animation: spin 1s linear infinite; margin-right: 8px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" /></svg> Menyimpan...`;
            }
        });
    }
});
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\sekolah-app-v2\resources\views/admin/settings/edit.blade.php ENDPATH**/ ?>