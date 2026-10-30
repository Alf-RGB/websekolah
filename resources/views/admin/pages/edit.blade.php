@extends('layouts.admin')

@section('title', 'Edit Halaman - ' . ($page->judul ?? 'Sambutan Kepala Sekolah'))

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
}

    @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes slideIn { from { opacity: 0; transform: scale(0.95); } to { opacity: 1; transform: scale(1); } }
    @keyframes spin { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }
    @keyframes modalPop { from { opacity: 0; transform: scale(0.9) translateY(10px); } to { opacity: 1; transform: scale(1) translateY(0); } }

    .edit-page-wrapper { max-width: 1000px; margin: 30px auto; padding: 0 20px; animation: fadeInUp 0.6s ease-out; }
    .edit-card { background: var(--bg-secondary); border-radius: 20px; padding: 40px; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.5); border: 1px solid var(--border-color); }
    .card-header { margin-bottom: 30px; padding-bottom: 20px; border-bottom: 2px solid var(--border-color); }
    .card-title { color: var(--text-primary); font-size: 26px; font-weight: 800; margin: 0 0 10px 0; }
    .card-subtitle { color: var(--text-secondary); font-size: 14px; margin: 0; }

    .form-group { margin-bottom: 25px; animation: fadeInUp 0.5s ease-out backwards; }
    .form-label { display: block; color: var(--text-primary); font-weight: 600; margin-bottom: 8px; font-size: 14px; }
    .form-label .required { color: var(--error-color); margin-left: 2px; }
    .form-input, .form-textarea { width: 100%; padding: 14px 16px; border: 2px solid var(--border-color); border-radius: 12px; font-size: 14px; background: var(--bg-primary); color: var(--text-primary); transition: var(--transition-smooth); box-sizing: border-box; }
    .form-input:focus, .form-textarea:focus { outline: none; border-color: var(--accent-color); box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1); transform: translateY(-2px); }
    .form-textarea { resize: vertical; min-height: 200px; }
    .form-hint { color: var(--text-muted); font-size: 12px; margin-top: 6px; display: block; }

    .photo-upload-section { background: var(--bg-primary); border-radius: 16px; padding: 30px; border: 2px dashed var(--border-color); transition: var(--transition-smooth); animation: fadeInUp 0.5s ease-out 0.25s backwards; }
    .photo-upload-section:hover { border-color: var(--accent-color); background: rgba(102, 126, 234, 0.05); }
    .photo-upload-title { color: var(--text-primary); font-size: 16px; font-weight: 700; margin: 0 0 20px 0; display: flex; align-items: center; gap: 8px; }
    .photo-preview-container { display: flex; gap: 30px; align-items: flex-start; flex-wrap: wrap; }
    
    .current-photo { width: 180px; height: 180px; border-radius: 16px; object-fit: cover; border: 3px solid var(--border-color); box-shadow: 0 4px 6px -1px rgba(0,0,0,0.4); transition: var(--transition-smooth); display: block; margin-bottom: 12px; }
    .current-photo:hover { transform: scale(1.02); border-color: var(--accent-color); }
    .photo-placeholder { width: 180px; height: 180px; border-radius: 16px; background: var(--bg-tertiary); border: 3px dashed var(--border-color); display: flex; align-items: center; justify-content: center; flex-direction: column; gap: 10px; color: var(--text-muted); margin-bottom: 12px; }
    
    .upload-label { display: flex; align-items: center; justify-content: center; gap: 10px; padding: 60px 30px; background: var(--bg-secondary); border: 2px dashed var(--border-color); border-radius: 12px; cursor: pointer; transition: var(--transition-smooth); flex-direction: column; width: 100%; }
    .upload-label:hover { border-color: var(--accent-color); background: rgba(102, 126, 234, 0.05); transform: translateY(-2px); }
    .upload-label.dragover { border-color: var(--success-color); background: rgba(16, 185, 129, 0.1); }
    .upload-text { color: var(--text-secondary); font-size: 14px; text-align: center; margin: 0; }
    .upload-text strong { color: var(--accent-color); display: block; margin-bottom: 5px; font-size: 15px; }
    
    .btn-remove-photo { background: var(--error-color); color: white; padding: 10px 20px; border: none; border-radius: 8px; font-weight: 600; font-size: 13px; cursor: pointer; transition: var(--transition-smooth); display: inline-flex; align-items: center; gap: 6px; }
    .btn-remove-photo:hover { background: #DC2626; transform: translateY(-2px); }

    .selected-file-info { background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.3); border-radius: 8px; padding: 12px 15px; margin-top: 15px; display: none; align-items: center; gap: 10px; animation: slideIn 0.3s ease-out; }
    .selected-file-info.show { display: flex; }
    .selected-file-info span { color: var(--text-primary); font-size: 13px; font-weight: 600; }

    .alert { padding: 15px 20px; border-radius: 12px; margin-bottom: 25px; display: flex; align-items: center; gap: 12px; animation: fadeInUp 0.5s ease-out; }
    .alert-success { background: rgba(16, 185, 129, 0.15); border: 1px solid rgba(16, 185, 129, 0.3); color: #6EE7B7; }
    .alert-error { background: rgba(239, 68, 68, 0.15); border: 1px solid rgba(239, 68, 68, 0.3); color: #FCA5A5; }

    /* ✅ PUBLISH SECTION */
    .publish-section {
        background: var(--bg-primary);
        padding: 25px;
        border-radius: 12px;
        border: 2px solid var(--border-color);
        margin-bottom: 25px;
        animation: fadeInUp 0.5s ease-out 0.3s backwards;
    }
    .publish-header {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        gap: 15px;
    }
    .publish-info { width: 100%; }
    .publish-info h3 {
        color: var(--text-primary);
        font-size: 16px;
        margin: 0 0 8px 0;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .publish-info p {
        color: var(--text-secondary);
        font-size: 13px;
        margin: 0;
        line-height: 1.6;
    }
    .publish-control {
        display: flex;
        align-items: center;
        gap: 12px;
        width: 100%;
        margin-top: 5px;
    }
    .toggle-switch {
        position: relative;
        width: 60px;
        height: 30px;
    }
    .toggle-switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }
    .toggle-slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: var(--bg-tertiary);
        transition: var(--transition-smooth);
        border-radius: 30px;
        border: 2px solid var(--border-color);
    }
    .toggle-slider:before {
        position: absolute;
        content: "";
        height: 20px;
        width: 20px;
        left: 3px;
        bottom: 3px;
        background-color: var(--text-muted);
        transition: var(--transition-smooth);
        border-radius: 50%;
    }
    .toggle-switch input:checked + .toggle-slider {
        background-color: var(--success-color);
        border-color: var(--success-color);
    }
    .toggle-switch input:checked + .toggle-slider:before {
        transform: translateX(30px);
        background-color: white;
    }
    .toggle-status {
        font-weight: 700;
        font-size: 14px;
        transition: color 0.3s;
    }
    .toggle-status.published { color: var(--success-color); }
    .toggle-status.draft { color: var(--text-muted); }

    /* ✅ CUSTOM MODAL KONFIRMASI (REDESIGNED) */
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
    .custom-modal-actions { display: flex; gap: 12px; justify-content: center; }
    /* ✅ CUSTOM MODAL KONFIRMASI (REDESIGNED) */
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

/* Tombol Batal - Dark Mode Friendly */
.modal-btn-cancel { 
    background: var(--bg-tertiary); 
    color: var(--text-secondary);
    border-color: var(--border-color);
}
.modal-btn-cancel:hover { 
    background: var(--border-color); 
    color: var(--text-primary);
    transform: translateY(-2px);
}

/* Tombol Hapus - Gradient Merah */
.modal-btn-confirm { 
    background: linear-gradient(135deg, var(--error-color), #DC2626); 
    color: white;
    border-color: transparent;
    box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
}
.modal-btn-confirm:hover { 
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(239, 68, 68, 0.4);
    background: linear-gradient(135deg, #DC2626, #B91C1C);
}

    .form-actions { display: flex; gap: 15px; justify-content: flex-end; padding-top: 25px; border-top: 2px solid var(--border-color); margin-top: 30px; flex-wrap: wrap; animation: fadeInUp 0.5s ease-out 0.35s backwards; }
    .btn { padding: 14px 30px; border-radius: 12px; font-weight: 600; font-size: 14px; cursor: pointer; transition: var(--transition-smooth); border: none; display: inline-flex; align-items: center; gap: 8px; text-decoration: none; }
    .btn-primary { background: linear-gradient(135deg, var(--accent-color), var(--accent-hover)); color: white; box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3); }
    .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4); }
    .btn-secondary { background: var(--bg-tertiary); color: var(--text-secondary); border: 1px solid var(--border-color); }
    .btn-secondary:hover { background: var(--border-color); color: var(--text-primary); transform: translateY(-2px); }
    .btn:disabled { opacity: 0.6; cursor: not-allowed; transform: none !important; }

    @media (max-width: 768px) {
        .edit-page-wrapper { padding: 0 15px; }
        .edit-card { padding: 25px 20px; }
        .photo-preview-container { flex-direction: column; }
        .form-actions { flex-direction: column-reverse; }
        .btn { width: 100%; justify-content: center; }
        .custom-modal { padding: 25px 20px; }
    }

/* Override khusus untuk tombol modal di dark mode */
.custom-modal .modal-btn {
    background: var(--bg-tertiary) !important;
    color: var(--text-primary) !important;
    border: 1px solid var(--border-color) !important;
}

.custom-modal .modal-btn-cancel {
    background: var(--bg-tertiary) !important;
    color: var(--text-secondary) !important;
}

.custom-modal .modal-btn-confirm {
    background: linear-gradient(135deg, #EF4444, #DC2626) !important;
    color: white !important;
    border: none !important;
}

s/* ============================================
   OVERRIDE KUAT - TOMBOL HAPUS FOTO
   ============================================ */
button.btn-remove-photo,
[type="button"].btn-remove-photo,
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
    text-shadow: 0 1px 2px rgba(0,0,0,0.2) !important;
}

button.btn-remove-photo:hover,
[type="button"].btn-remove-photo:hover,
.btn-remove-photo:hover {
    background: linear-gradient(135deg, #DC2626 0%, #B91C1C 100%) !important;
    border-color: #B91C1C !important;
    box-shadow: 0 6px 20px rgba(239, 68, 68, 0.5) !important;
    transform: translateY(-2px) !important;
}

button.btn-remove-photo svg,
[type="button"].btn-remove-photo svg,
.btn-remove-photo svg {
    color: #FFFFFF !important;
    stroke: #FFFFFF !important;
}

</style>

<div class="edit-page-wrapper">
    <div class="edit-card">
        <div class="card-header">
            <h1 class="card-title">Edit Halaman: {{ $page->judul ?? 'Sambutan Kepala Sekolah' }}</h1>
            <p class="card-subtitle">Edit konten, foto, dan status publikasi halaman ini.</p>
        </div>

        {{-- ✅ NOTIFIKASI SUCCESS --}}
        @if(session('success'))
        <div class="alert alert-success">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <p style="margin:0; font-weight:600;">{!! session('success') !!}</p>
        </div>
        @endif

        @if($errors->any())
        <div class="alert alert-error">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <div>
                <p style="font-weight: 700; margin-bottom: 5px;">Ada kesalahan pada input:</p>
                <ul style="margin: 0; padding-left: 20px; font-size: 13px;">
                    @foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                </ul>
            </div>
        </div>
        @endif

        <form action="{{ route('admin.pages.update', $page->id) }}" method="POST" enctype="multipart/form-data" id="editPageForm">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="judul" class="form-label">Judul Halaman <span class="required">*</span></label>
                <input type="text" id="judul" name="judul" class="form-input" value="{{ old('judul', $page->judul) }}" required placeholder="Contoh: Sambutan Kepala Sekolah">
            </div>

            <div class="form-group">
                <label for="konten" class="form-label">Konten <span class="required">*</span></label>
                <textarea id="konten" name="konten" class="form-textarea" required placeholder="Tulis sambutan kepala sekolah di sini...">{{ old('konten', $page->konten) }}</textarea>
                <span class="form-hint">Gunakan HTML untuk formatting teks jika diperlukan.</span>
            </div>

            {{-- ✅ STATUS PUBLIKASI TOGGLE --}}
            <div class="publish-section">
                <div class="publish-header">
                    <div class="publish-info">
                        <h3>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="color: var(--accent-color);">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Status Publikasi
                        </h3>
                        <p>Aktifkan opsi ini agar halaman dapat dilihat oleh pengunjung di website publik. Jika tidak, halaman akan tersimpan sebagai <strong>Draft</strong>.</p>
                    </div>
                    <div class="publish-control">
                        <label class="toggle-switch">
                            <input type="checkbox" id="is_published" name="is_published" value="1" {{ old('is_published', $page->is_published) ? 'checked' : '' }}>
                            <span class="toggle-slider"></span>
                        </label>
                        <span class="toggle-status {{ old('is_published', $page->is_published) ? 'published' : 'draft' }}" id="publishStatus">
                            {{ old('is_published', $page->is_published) ? 'Published ✅' : 'Draft 📝' }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="photo-upload-section">
                    <h3 class="photo-upload-title">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Foto Kepala Sekolah
                    </h3>

                    <div class="photo-preview-container">
                        <div class="current-photo-wrapper" style="flex-shrink: 0;">
                            <span style="color: var(--text-muted); font-size: 12px; font-weight: 600; display: block; margin-bottom: 10px;" id="photoLabelTitle">Foto Saat Ini:</span>
                            
                            {{-- Foto Saat Ini (Jika ada di database) --}}
                            <div id="currentPhotoContainer" style="{{ ($page->foto && Storage::disk('public')->exists($page->foto)) ? 'display: block;' : 'display: none;' }}">
                                @if($page->foto && Storage::disk('public')->exists($page->foto))
                                    <img src="{{ asset('storage/' . $page->foto) }}" alt="Foto" class="current-photo" id="currentPhoto">
                                @endif
                                <div>
                                    <button type="button" class="btn-remove-photo" onclick="openDeleteModal()">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                        Hapus Foto
                                    </button>
                                </div>
                            </div>

                            {{-- Placeholder jika foto tidak ada / sudah dihapus --}}
                            <div class="photo-placeholder" id="photoPlaceholder" style="{{ ($page->foto && Storage::disk('public')->exists($page->foto)) ? 'display: none;' : 'display: flex;' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="opacity: 0.5;">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <span style="font-size: 13px; font-weight: 600;">Belum ada foto</span>
                            </div>

                            <input type="hidden" name="remove_photo" id="removePhotoInput" value="0">
                        </div>

                        <div class="upload-area" style="flex: 1; min-width: 300px;">
                            <input type="file" id="photoInput" name="foto" class="upload-input" accept="image/jpeg,image/jpg,image/png" onchange="handlePhotoChange(event)" style="display: none;">
                            <label for="photoInput" class="upload-label" id="uploadLabel" ondragover="handleDragOver(event)" ondragleave="handleDragLeave(event)" ondrop="handleDrop(event)">
                                <svg class="upload-icon" xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="color: var(--accent-color); transition: var(--transition-smooth);">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                </svg>
                                <p class="upload-text">
                                    <strong>Klik atau seret foto ke sini</strong>
                                    <span class="form-hint" style="margin-top: 8px;">Format: JPG, PNG. Maksimal 10MB (Akan dikompres otomatis jadi < 2MB)</span>
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
                <a href="{{ route('admin.pages.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary" id="btnSubmit">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

{{-- ✅ MODAL KONFIRMASI HAPUS FOTO (REDESIGNED) --}}
<div class="custom-modal-overlay" id="deleteModalOverlay">
    <div class="custom-modal">
        <div class="modal-icon">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
            </svg>
        </div>
        <h3>Hapus Foto Kepala Sekolah?</h3>
        <p>Apakah Anda yakin ingin menghapus foto kepala sekolah ini? Tindakan ini akan menghapus foto saat Anda menekan tombol <strong>"Simpan Perubahan"</strong>.</p>
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
                Ya, Hapus Foto
            </button>
        </div>
    </div>
</div>

<script>
// Fungsi Modal Konfirmasi
function openDeleteModal() {
    document.getElementById('deleteModalOverlay').classList.add('show');
    document.body.style.overflow = 'hidden'; // Prevent scrolling
}

function closeDeleteModal() {
    document.getElementById('deleteModalOverlay').classList.remove('show');
    document.body.style.overflow = ''; // Restore scrolling
}

function confirmRemovePhoto() {
    document.getElementById('removePhotoInput').value = '1';
    
    // Sembunyikan kontainer foto saat ini, tampilkan placeholder
    const currentPhotoContainer = document.getElementById('currentPhotoContainer');
    const placeholder = document.getElementById('photoPlaceholder');
    const photoLabelTitle = document.getElementById('photoLabelTitle');
    
    if (currentPhotoContainer) currentPhotoContainer.style.display = 'none';
    if (placeholder) placeholder.style.display = 'flex';
    if (photoLabelTitle) photoLabelTitle.style.display = 'none';
    
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

function handlePhotoChange(event) {
    const file = event.target.files[0];
    if (file) validateAndShowPhoto(file);
}

function handleDragOver(e) { e.preventDefault(); e.currentTarget.classList.add('dragover'); }
function handleDragLeave(e) { e.currentTarget.classList.remove('dragover'); }
function handleDrop(e) {
    e.preventDefault();
    e.currentTarget.classList.remove('dragover');
    const file = e.dataTransfer.files[0];
    if (file) validateAndShowPhoto(file);
}

function validateAndShowPhoto(file) {
    const maxSize = 10 * 1024 * 1024; // 10MB
    const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
    
    if (!allowedTypes.includes(file.type)) {
        alert('⚠️ Format file tidak didukung! Gunakan JPG atau PNG.');
        return;
    }
    if (file.size > maxSize) {
        alert('⚠️ Ukuran file terlalu besar! Maksimal 10MB.');
        return;
    }
    
    const fileInfo = document.getElementById('selectedFileInfo');
    const fileName = document.getElementById('selectedFileName');
    const fileSize = (file.size / 1024 / 1024).toFixed(2);
    fileName.textContent = `${file.name} (${fileSize} MB) - Akan dikompres otomatis`;
    fileInfo.classList.add('show');
    
    document.getElementById('removePhotoInput').value = '0';
}

// Toggle Switch Animation & Label
document.addEventListener('DOMContentLoaded', function() {
    const checkbox = document.getElementById('is_published');
    const statusLabel = document.getElementById('publishStatus');
    
    if (checkbox && statusLabel) {
        function updateStatus() {
            if (checkbox.checked) {
                statusLabel.textContent = 'Published ✅';
                statusLabel.className = 'toggle-status published';
            } else {
                statusLabel.textContent = 'Draft 📝';
                statusLabel.className = 'toggle-status draft';
            }
        }
        
        updateStatus();
        checkbox.addEventListener('change', updateStatus);
    }
});

// Form Submit Handler
document.getElementById('editPageForm').addEventListener('submit', function() {
    const btn = document.getElementById('btnSubmit');
    btn.disabled = true;
    btn.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="animation: spin 1s linear infinite; margin-right: 8px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" /></svg> Menyimpan...`;
});
</script>
@endsection