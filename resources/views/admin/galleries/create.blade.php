@extends('layouts.admin')

@section('title', 'Upload Foto Baru')

@section('content')

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

    .gallery-form-wrapper { max-width: 1000px; margin: 0 auto; padding: 30px; animation: fadeInUp 0.6s ease; }

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
        box-shadow: 0 10px 15px -3px rgba(0,0,0,0.5);
        border: 1px solid var(--border-color);
        margin-bottom: 25px;
        animation: slideIn 0.6s cubic-bezier(0.4, 0, 0.2, 1) backwards;
    }
    .form-card.info-card { animation-delay: 0.1s; }
    .form-card.upload-card { animation-delay: 0.2s; }

    .form-section-title {
        background: linear-gradient(135deg, var(--accent-color), var(--accent-hover));
        color: white;
        padding: 18px 25px;
        border-radius: 12px;
        margin: 0 0 25px 0;
        font-size: 16px;
        font-weight: 700;
    }
    .form-card.upload-card .form-section-title {
        background: linear-gradient(135deg, var(--success-color), #059669);
    }

    .form-group { margin-bottom: 25px; animation: fadeInUp 0.5s ease backwards; }
    .form-card.info-card .form-group:nth-child(1) { animation-delay: 0.15s; }
    .form-card.info-card .form-group:nth-child(2) { animation-delay: 0.2s; }
    .form-card.info-card .form-row { animation: fadeInUp 0.5s ease 0.25s backwards; }

    .form-label {
        display: block;
        font-size: 13px;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 8px;
        letter-spacing: 0.3px;
    }
    .form-label .required { color: var(--error-color); margin-left: 2px; }
    
    .form-input, .form-textarea, .form-select {
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
    .form-input:focus, .form-textarea:focus, .form-select:focus {
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
        object-fit: cover;
        border: 3px solid var(--border-color);
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.4);
        transition: var(--transition-smooth);
        display: block;
        margin-bottom: 12px;
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
    
    /* ✅ OVERRIDE KUAT UNTUK TOMBOL HAPUS GAMBAR */
    .btn-remove-photo {
        background: linear-gradient(135deg, #EF4444 0%, #DC2626 100%) !important;
        color: #FFFFFF !important;
        border: 1px solid #DC2626 !important;
        padding: 10px 20px !important;
        border-radius: 8px !important;
        font-weight: 600 !important;
        font-size: 13px !important;
        cursor: pointer !important;
        display: inline-flex !important;
        align-items: center !important;
        gap: 6px !important;
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.4) !important;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
    }

    .btn-remove-photo:hover {
        background: linear-gradient(135deg, #DC2626 0%, #B91C1C 100%) !important;
        border-color: #B91C1C !important;
        box-shadow: 0 6px 20px rgba(239, 68, 68, 0.5) !important;
        transform: translateY(-2px) !important;
    }

    .btn-remove-photo svg {
        color: #FFFFFF !important;
        stroke: #FFFFFF !important;
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

    /* CUSTOM MODAL */
    .custom-modal-overlay {
        position: fixed;
        top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(15, 23, 42, 0.85);
        backdrop-filter: blur(6px);
        -webkit-backdrop-filter: blur(6px);
        display: flex; align-items: center; justify-content: center;
        z-index: 9999;
        opacity: 0; visibility: hidden;
        transition: var(--transition-smooth);
    }
    .custom-modal-overlay.show { opacity: 1; visibility: visible; }
    .custom-modal {
        background: var(--bg-secondary);
        border: 1px solid var(--border-color);
        padding: 35px;
        border-radius: 20px;
        max-width: 450px; width: 90%;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.6);
        text-align: center;
        transform: scale(0.9);
        transition: var(--transition-smooth);
        animation: modalPop 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .modal-icon {
        width: 70px;
        height: 70px;
        margin: 0 auto 20px;
        background: linear-gradient(135deg, var(--error-color), #DC2626);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 10px 25px rgba(239, 68, 68, 0.3);
    }
    .modal-icon svg {
        width: 35px;
        height: 35px;
        color: white;
    }
    .custom-modal h3 { color: var(--text-primary); margin: 0 0 12px 0; font-size: 20px; font-weight: 700; }
    .custom-modal p { color: var(--text-secondary); font-size: 14px; margin: 0 0 25px 0; line-height: 1.6; }
    .custom-modal-actions { 
        display: flex; 
        gap: 12px; 
        justify-content: center;
        flex-wrap: wrap;
    }
    
    /* Tombol Modal */
    .modal-btn { 
        padding: 12px 24px; 
        border-radius: 10px; 
        font-weight: 600; 
        font-size: 14px; 
        cursor: pointer; 
        border: 1px solid transparent;
        transition: var(--transition-smooth);
        display: inline-flex;
        align-items: center;
        gap: 8px;
        min-width: 120px;
        justify-content: center;
    }

    .modal-btn-cancel { 
        background: #475569 !important;
        color: #F1F5F9 !important;
        border-color: #64748B !important;
    }
    .modal-btn-cancel:hover { 
        background: #64748B !important;
        color: #FFFFFF !important;
        transform: translateY(-2px);
    }

    .modal-btn-confirm { 
        background: linear-gradient(135deg, #EF4444, #DC2626) !important;
        color: white !important;
        border-color: transparent !important;
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.4) !important;
    }
    .modal-btn-confirm:hover { 
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(239, 68, 68, 0.5) !important;
        background: linear-gradient(135deg, #DC2626, #B91C1C) !important;
    }

    /* Checkbox Aktif */
    .checkbox-wrapper {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 14px 18px;
        background: var(--bg-tertiary);
        border: 2px solid var(--border-color);
        border-radius: 12px;
        cursor: pointer;
        transition: var(--transition-smooth);
    }
    .checkbox-wrapper:hover {
        border-color: var(--accent-color);
        background: rgba(102, 126, 234, 0.05);
        transform: translateY(-2px);
    }
    .checkbox-wrapper input[type="checkbox"] {
        width: 18px;
        height: 18px;
        accent-color: var(--success-color);
        cursor: pointer;
    }
    .checkbox-wrapper label {
        margin: 0;
        cursor: pointer;
        font-weight: 600;
        color: var(--text-primary);
        font-size: 14px;
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
        .gallery-form-wrapper { padding: 20px; }
        .edit-header { flex-direction: column; align-items: flex-start; }
        .form-card { padding: 25px 20px; }
        .form-row { grid-template-columns: 1fr; gap: 15px; }
        .photo-preview-container { flex-direction: column; }
        .form-actions { flex-direction: column-reverse; }
        .btn { width: 100%; justify-content: center; }
        .custom-modal { padding: 25px 20px; }
    }

    /* ============================================
   FIX WARNA TOMBOL MODAL - PASTI WORK!
   ============================================ */

/* Tombol Batal - Abu-abu */
.modal-btn-cancel,
button.modal-btn-cancel,
[type="button"].modal-btn-cancel {
    background: #475569 !important;
    color: #F1F5F9 !important;
    border: 1px solid #64748B !important;
    padding: 12px 24px !important;
    border-radius: 10px !important;
    font-weight: 600 !important;
    font-size: 14px !important;
    cursor: pointer !important;
    display: inline-flex !important;
    align-items: center !important;
    gap: 8px !important;
    min-width: 120px !important;
    justify-content: center !important;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
}

.modal-btn-cancel:hover,
button.modal-btn-cancel:hover,
[type="button"].modal-btn-cancel:hover {
    background: #64748B !important;
    color: #FFFFFF !important;
    transform: translateY(-2px) !important;
}

/* Tombol Ya Hapus - Merah Gradient */
.modal-btn-confirm,
button.modal-btn-confirm,
[type="button"].modal-btn-confirm {
    background: linear-gradient(135deg, #EF4444 0%, #DC2626 100%) !important;
    color: #FFFFFF !important;
    border: none !important;
    padding: 12px 24px !important;
    border-radius: 10px !important;
    font-weight: 600 !important;
    font-size: 14px !important;
    cursor: pointer !important;
    display: inline-flex !important;
    align-items: center !important;
    gap: 8px !important;
    min-width: 120px !important;
    justify-content: center !important;
    box-shadow: 0 4px 12px rgba(239, 68, 68, 0.4) !important;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
}

.modal-btn-confirm:hover,
button.modal-btn-confirm:hover,
[type="button"].modal-btn-confirm:hover {
    background: linear-gradient(135deg, #DC2626 0%, #B91C1C 100%) !important;
    box-shadow: 0 6px 20px rgba(239, 68, 68, 0.5) !important;
    transform: translateY(-2px) !important;
}

/* Icon SVG di tombol */
.modal-btn-cancel svg,
.modal-btn-confirm svg {
    width: 16px;
    height: 16px;
}

.modal-btn-confirm svg {
    color: #FFFFFF !important;
    stroke: #FFFFFF !important;
}

</style>

<div class="gallery-form-wrapper">

    {{-- Header --}}
    <div class="edit-header">
        <div>
            <h1 class="edit-header-title">Upload Foto Baru</h1>
            <p class="edit-header-subtitle">Lengkapi formulir di bawah untuk menambah foto ke galeri sekolah.</p>
        </div>
    </div>

    {{-- Alert Error --}}
    @if($errors->any())
    <div class="alert-error">
        <h3 class="alert-error-title">⚠️ Ada kesalahan pada input:</h3>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {{-- Form --}}
    <form action="{{ route('admin.galleries.store') }}" method="POST" enctype="multipart/form-data" id="galleryForm">
        @csrf

        {{-- Section: Informasi Foto --}}
        <div class="form-card info-card">
            <h3 class="form-section-title">Informasi Foto</h3>
            
            <div class="form-group">
                <label class="form-label">
                    Judul Foto <span class="required">*</span>
                </label>
                <input type="text" 
                       name="judul" 
                       class="form-input" 
                       value="{{ old('judul') }}" 
                       required 
                       placeholder="Contoh: Upacara Bendera">
            </div>

            <div class="form-group">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi" 
                          class="form-textarea" 
                          rows="4" 
                          placeholder="Jelaskan deskripsi foto...">{{ old('deskripsi') }}</textarea>
                <div class="form-hint">Opsional, tapi sangat disarankan untuk SEO dan aksesibilitas</div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">
                        Kategori <span class="required">*</span>
                    </label>
                    <select name="kategori" class="form-select" required>
                        <option value="">-- Pilih Kategori --</option>
                        <option value="Kegiatan" {{ old('kategori') === 'Kegiatan' ? 'selected' : '' }}>Kegiatan</option>
                        <option value="Fasilitas" {{ old('kategori') === 'Fasilitas' ? 'selected' : '' }}>Fasilitas</option>
                        <option value="Prestasi" {{ old('kategori') === 'Prestasi' ? 'selected' : '' }}>Prestasi</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Status Tampilan</label>
                    <div class="checkbox-wrapper">
                        <input type="checkbox" 
                               name="is_active" 
                               id="isActive" 
                               value="1" 
                               {{ old('is_active', '1') == '1' ? 'checked' : '' }}>
                        <label for="isActive">Aktif - Tampilkan foto ini di website publik</label>
                    </div>
                </div>
            </div>
        </div>

        {{-- Section: Upload Foto --}}
        <div class="form-card upload-card">
            <h3 class="form-section-title">File Foto</h3>
            
            <div class="photo-upload-section">
                <h3 class="photo-upload-title">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    Upload Foto
                </h3>

                <div class="photo-preview-container">
                    <div style="flex-shrink: 0;">
                        <span style="color: var(--text-muted); font-size: 12px; font-weight: 600; display: block; margin-bottom: 10px;">Preview Foto:</span>
                        
                        {{-- Preview Image --}}
                        <div id="currentPhotoContainer" style="display: none;">
                            <img id="imagePreview" 
                                 src="" 
                                 class="current-photo"
                                 alt="Preview Foto">
                            <div>
                                {{-- TOMBOL HAPUS GAMBAR DENGAN INLINE STYLE --}}
                                <button type="button" 
                                        class="btn-remove-photo" 
                                        onclick="openDeleteModal()"
                                        style="background: linear-gradient(135deg, #EF4444, #DC2626) !important; 
                                               color: white !important; 
                                               border: none !important;
                                               padding: 10px 20px !important;
                                               border-radius: 8px !important;
                                               font-weight: 600 !important;
                                               font-size: 13px !important;
                                               cursor: pointer !important;
                                               display: inline-flex !important;
                                               align-items: center !important;
                                               gap: 6px !important;
                                               box-shadow: 0 4px 12px rgba(239, 68, 68, 0.4) !important;
                                               transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;"
                                        onmouseover="this.style.background='linear-gradient(135deg, #DC2626, #B91C1C)'; this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 20px rgba(239, 68, 68, 0.5)';"
                                        onmouseout="this.style.background='linear-gradient(135deg, #EF4444, #DC2626)'; this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(239, 68, 68, 0.4)';">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="color: white !important;">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    Hapus Foto
                                </button>
                            </div>
                        </div>

                        {{-- Placeholder --}}
                        <div class="photo-placeholder" id="photoPlaceholder" style="display: flex;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="opacity: 0.5;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span style="font-size: 13px; font-weight: 600;">Belum ada gambar</span>
                        </div>
                    </div>

                    <div style="flex: 1; min-width: 300px;">
                        <input type="file" 
                               id="photoInput" 
                               name="gambar" 
                               class="upload-input" 
                               accept="image/png,image/jpeg,image/jpg,image/webp" 
                               onchange="handlePhotoChange(event)" 
                               style="display: none;"
                               required>
                        <label for="photoInput" 
                               class="upload-label" 
                               id="uploadLabel" 
                               ondragover="handleDragOver(event)" 
                               ondragleave="handleDragLeave(event)" 
                               ondrop="handleDrop(event)">
                            <svg class="upload-icon" xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="color: var(--accent-color); transition: var(--transition-smooth);">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                            </svg>
                            <p class="upload-text">
                                <strong>Klik atau seret foto ke sini</strong>
                                <span class="form-hint" style="margin-top: 8px;">Format: JPG, PNG, WEBP. Maksimal 10MB</span>
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

        {{-- Form Actions --}}
        <div class="form-actions">
            <a href="{{ route('admin.galleries.index') }}" class="btn btn-secondary">
                Batal
            </a>
            <button type="submit" id="btn-submit" class="btn btn-primary">
                Upload Foto
            </button>
        </div>
    </form>

</div>

{{-- ✅ MODAL KONFIRMASI HAPUS FOTO --}}
<div class="custom-modal-overlay" id="deleteModalOverlay">
    <div class="custom-modal">
        <div class="modal-icon">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
            </svg>
        </div>
        <h3>Hapus Foto?</h3>
        <p>Apakah Anda yakin ingin menghapus foto ini?</p>
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
// Modal Functions
function openDeleteModal() {
    document.getElementById('deleteModalOverlay').classList.add('show');
    document.body.style.overflow = 'hidden';
}

function closeDeleteModal() {
    document.getElementById('deleteModalOverlay').classList.remove('show');
    document.body.style.overflow = '';
}

function confirmRemovePhoto() {
    const preview = document.getElementById('imagePreview');
    const noImageText = document.getElementById('photoPlaceholder');
    const currentPhotoContainer = document.getElementById('currentPhotoContainer');
    
    preview.src = '';
    preview.style.display = 'none';
    currentPhotoContainer.style.display = 'none';
    noImageText.style.display = 'flex';
    
    document.getElementById('photoInput').value = '';
    document.getElementById('selectedFileInfo').classList.remove('show');
    
    closeDeleteModal();
}

// Close modal when clicking outside
document.getElementById('deleteModalOverlay').addEventListener('click', function(e) {
    if (e.target === this) {
        closeDeleteModal();
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        const modal = document.getElementById('deleteModalOverlay');
        if (modal.classList.contains('show')) {
            closeDeleteModal();
        }
    }
});

// Photo Upload Functions
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
    const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];
    
    if (!allowedTypes.includes(file.type)) {
        alert('⚠️ Format file tidak didukung! Gunakan JPG, PNG, atau WEBP.');
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
        const preview = document.getElementById('imagePreview');
        const noImageText = document.getElementById('photoPlaceholder');
        const currentPhotoContainer = document.getElementById('currentPhotoContainer');
        
        preview.src = e.target.result;
        preview.style.display = 'block';
        currentPhotoContainer.style.display = 'block';
        noImageText.style.display = 'none';
        
        // Add scale animation
        preview.style.transform = 'scale(0.9)';
        setTimeout(() => {
            preview.style.transition = 'transform 0.3s cubic-bezier(0.4, 0, 0.2, 1)';
            preview.style.transform = 'scale(1)';
        }, 50);
    }
    reader.readAsDataURL(file);
}

// Form Submit Handler
document.getElementById('galleryForm').addEventListener('submit', function() {
    const btn = document.getElementById('btn-submit');
    if(btn) {
        btn.disabled = true;
        btn.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="animation: spin 1s linear infinite; margin-right: 8px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" /></svg> Mengupload...`;
    }
});
</script>
@endsection