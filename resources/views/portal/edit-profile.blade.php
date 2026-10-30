<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil - Portal Guru</title>
    
    {{-- 🚨 ANTI-FLASH: Apply theme BEFORE rendering --}}
    <script>
        (function() {
            const theme = localStorage.getItem('theme') || 
                (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
            document.documentElement.setAttribute('data-theme', theme);
        })();
    </script>
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');

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
        
        body { 
            font-family: 'Inter', sans-serif; 
            background: var(--bg-primary); 
            color: var(--text-primary); 
            line-height: 1.6; 
            min-height: 100vh;
            padding: 40px 20px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        @keyframes fadeInDown { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes slideIn { from { opacity: 0; transform: scale(0.96) translateY(20px); } to { opacity: 1; transform: scale(1) translateY(0); } }

        /* =========================================
           3. LAYOUT & HEADER
           ========================================= */
        .admin-container { 
            max-width: 750px; 
            margin: 0 auto; 
            animation: fadeInUp 0.6s ease-out;
        }

        .page-header { 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            margin-bottom: 30px; 
            flex-wrap: wrap; 
            gap: 15px; 
            animation: fadeInDown 0.6s ease-out;
        }
        .page-header h1 { 
            color: var(--text-primary); 
            font-size: 26px; 
            font-weight: 800; 
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .btn-back { 
            background: var(--bg-secondary); 
            color: var(--text-primary); 
            padding: 10px 20px; 
            border-radius: 10px; 
            text-decoration: none; 
            font-weight: 600; 
            font-size: 14px; 
            border: 1px solid var(--border-color);
            transition: var(--transition-smooth);
            display: inline-flex; 
            align-items: center; 
            gap: 6px; 
            box-shadow: var(--shadow-sm);
        }
        .btn-back:hover { 
            background: var(--bg-tertiary); 
            transform: translateX(-3px);
            box-shadow: var(--shadow-md);
        }
        .btn-back:active { transform: translateX(-3px) scale(0.98); }

        /* =========================================
           4. INFO BOX & ALERTS
           ========================================= */
        .info-box { 
            background: linear-gradient(135deg, #EFF6FF 0%, #DBEAFE 100%); 
            padding: 16px 20px; 
            border-radius: 12px; 
            border: 1px solid #BFDBFE; 
            margin-bottom: 24px; 
            font-size: 14px; 
            color: #1E40AF; 
            line-height: 1.6;
            display: flex;
            align-items: flex-start;
            gap: 12px;
            animation: slideIn 0.5s ease-out 0.1s backwards;
        }
        .info-box strong { display: block; margin-bottom: 4px; font-size: 15px; }
        [data-theme="dark"] .info-box {
            background: linear-gradient(135deg, rgba(30, 58, 138, 0.3) 0%, rgba(30, 64, 175, 0.2) 100%) !important;
            border-color: #1E40AF !important;
            color: #93C5FD !important;
        }

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
           5. FORM CARD & ELEMENTS
           ========================================= */
        .form-card { 
            background: var(--bg-secondary); 
            padding: 40px; 
            border-radius: 20px; 
            box-shadow: var(--shadow-lg); 
            border: 1px solid var(--border-color);
            animation: slideIn 0.6s cubic-bezier(0.4, 0, 0.2, 1) 0.15s backwards;
        }

        .form-group { 
            margin-bottom: 24px; 
            animation: fadeInUp 0.5s ease-out backwards;
        }
        .form-group:nth-child(1) { animation-delay: 0.2s; }
        .form-group:nth-child(2) { animation-delay: 0.25s; }
        .form-group:nth-child(3) { animation-delay: 0.3s; }
        .form-group:nth-child(4) { animation-delay: 0.35s; }

        .form-label { 
            display: block; 
            color: var(--text-primary); 
            font-weight: 600; 
            margin-bottom: 8px; 
            font-size: 14px; 
        }
        .form-label .required { color: #EF4444; margin-left: 2px; }

        .form-input, .form-textarea { 
            width: 100%; 
            padding: 12px 16px; 
            border: 2px solid var(--border-color); 
            border-radius: 12px; 
            font-size: 15px; 
            font-family: inherit; 
            background: var(--bg-primary);
            color: var(--text-primary);
            transition: var(--transition-smooth); 
        }
        .form-input:focus, .form-textarea:focus { 
            border-color: var(--accent-color); 
            outline: none; 
            background: var(--bg-secondary);
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1);
            transform: translateY(-2px);
        }
        .form-textarea { resize: vertical; min-height: 120px; }

        .hint { 
            font-size: 12px; 
            color: var(--text-muted); 
            margin-top: 6px; 
            font-style: italic;
        }

        /* Modern Photo Upload Section */
        .photo-section { 
            display: flex; 
            gap: 24px; 
            align-items: flex-start; 
            flex-wrap: wrap; 
        }
        .photo-preview-container {
            position: relative;
            width: 120px;
            height: 120px;
            flex-shrink: 0;
        }
        .current-photo, .photo-placeholder {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid var(--border-color);
            box-shadow: var(--shadow-md);
            transition: var(--transition-smooth);
        }
        .photo-placeholder {
            background: linear-gradient(135deg, var(--accent-color) 0%, var(--accent-hover) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 48px;
            color: white;
            font-weight: 800;
            border-color: rgba(255,255,255,0.5);
        }
        .photo-preview-container:hover .current-photo,
        .photo-preview-container:hover .photo-placeholder {
            transform: scale(1.05);
            box-shadow: var(--shadow-lg);
        }

        .photo-upload-area {
            flex: 1;
            min-width: 200px;
            border: 2px dashed var(--border-color);
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            background: var(--bg-primary);
            transition: var(--transition-smooth);
            cursor: pointer;
            position: relative;
        }
        .photo-upload-area:hover {
            border-color: var(--accent-color);
            background: rgba(16, 185, 129, 0.05);
        }
        .photo-upload-area input[type="file"] {
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            opacity: 0;
            cursor: pointer;
        }
        .photo-upload-icon {
            font-size: 24px;
            margin-bottom: 8px;
            color: var(--text-muted);
            transition: var(--transition-smooth);
        }
        .photo-upload-area:hover .photo-upload-icon {
            color: var(--accent-color);
            transform: translateY(-4px);
        }
        .photo-upload-title {
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

        /* =========================================
           6. ACTIONS
           ========================================= */
        .form-actions { 
            display: flex; 
            gap: 12px; 
            margin-top: 30px; 
            padding-top: 25px;
            border-top: 1px solid var(--border-color);
            flex-wrap: wrap;
            animation: fadeInUp 0.5s ease-out 0.4s backwards;
        }

        .btn {
            padding: 12px 24px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: var(--transition-smooth);
            border: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-decoration: none;
            font-family: inherit;
        }
        .btn-save { 
            background: linear-gradient(135deg, var(--accent-color) 0%, var(--accent-hover) 100%); 
            color: white; 
            flex: 1;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }
        .btn-save:hover { 
            transform: translateY(-2px); 
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
        }
        .btn-save:active { transform: translateY(0) scale(0.98); }
        .btn-save:disabled { 
            background: var(--text-muted); 
            cursor: not-allowed; 
            transform: none;
            box-shadow: none;
        }

        .btn-cancel { 
            background: var(--bg-tertiary); 
            color: var(--text-primary); 
            border: 1px solid var(--border-color);
        }
        .btn-cancel:hover { 
            background: var(--border-color); 
            transform: translateY(-2px);
        }
        .btn-cancel:active { transform: translateY(0) scale(0.98); }

        /* =========================================
           7. RESPONSIVE
           ========================================= */
        @media (max-width: 768px) {
            body { padding: 20px 15px; }
            .page-header { flex-direction: column; align-items: flex-start; }
            .form-card { padding: 25px 20px; }
            .photo-section { flex-direction: column; align-items: center; text-align: center; }
            .form-actions { flex-direction: column-reverse; }
            .btn { width: 100%; }
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <div class="page-header">
            <h1>👤 Edit Profil Saya</h1>
            <a href="/portal/guru/dashboard" class="btn-back">← Dashboard</a>
        </div>

        {{-- INFO BOX --}}
        <div class="info-box">
            <div style="font-size: 20px;">💡</div>
            <div>
                <strong>Informasi:</strong>
                Data yang Anda isi di sini akan langsung ditampilkan di halaman <strong>Portal Akademik</strong> website publik sekolah. Pastikan data sudah benar sebelum disimpan.
            </div>
        </div>

        {{-- ERROR VALIDATION --}}
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

        <div class="form-card">
            <form action="/portal/guru/profil" method="POST" enctype="multipart/form-data" id="profileForm">
                @csrf
                @method('PUT')
                
                {{-- FOTO PROFIL --}}
                <div class="form-group">
                    <label class="form-label">Foto Profil</label>
                    <div class="photo-section">
                        @php
                            $fotoExists = $guru->foto && file_exists(storage_path('app/public/gurus/' . $guru->foto));
                        @endphp
                        
                        <div class="photo-preview-container">
                            @if($fotoExists)
                                <img src="{{ asset('storage/gurus/' . $guru->foto) }}" alt="Foto {{ $guru->nama }}" class="current-photo" id="photoPreview">
                            @else
                                <div class="photo-placeholder" id="photoPreview">
                                    {{ strtoupper(substr($guru->nama, 0, 1)) }}
                                </div>
                            @endif
                        </div>
                        
                        <div class="photo-upload-area" id="dropZone">
                            <input type="file" name="foto" id="fotoInput" accept="image/jpeg,image/png,image/jpg">
                            <div class="photo-upload-icon">📷</div>
                            <div class="photo-upload-title">Klik atau seret foto ke sini</div>
                            <p class="hint" style="margin-top: 0;">Format: JPG, PNG. Maksimal 2MB.</p>
                            <div class="file-name-display" id="fileNameDisplay">
                                <span>✅</span> <span id="fileNameText"></span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- NAMA LENGKAP --}}
                <div class="form-group">
                    <label class="form-label">Nama Lengkap <span class="required">*</span></label>
                    <input type="text" name="nama" class="form-input" value="{{ old('nama', $guru->nama) }}" required placeholder="Contoh: Budi Santoso, S.Pd.">
                    <p class="hint">Nama ini akan ditampilkan di halaman profil publik.</p>
                </div>
                
                {{-- MATA PELAJARAN --}}
                <div class="form-group">
                    <label class="form-label">Mata Pelajaran <span class="required">*</span></label>
                    <input type="text" name="mata_pelajaran" class="form-input" value="{{ old('mata_pelajaran', $guru->mata_pelajaran) }}" required placeholder="Contoh: Matematika, Bahasa Indonesia, dll">
                    <p class="hint">Mata pelajaran yang Anda ampu di sekolah.</p>
                </div>

                {{-- BIO SINGKAT --}}
                <div class="form-group">
                    <label class="form-label">Bio Singkat</label>
                    <textarea name="bio" class="form-textarea" rows="4" placeholder="Ceritakan tentang diri Anda, pengalaman mengajar, atau motto hidup...">{{ old('bio', $guru->bio) }}</textarea>
                    <p class="hint">Bio ini akan ditampilkan di halaman profil publik Anda. Siswa dan orang tua bisa membaca tentang Anda.</p>
                </div>

                {{-- ACTION BUTTONS --}}
                <div class="form-actions">
                    <a href="/portal/guru/dashboard" class="btn btn-cancel">Batal</a>
                    <button type="submit" id="btn-submit" class="btn btn-save">💾 Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // 1. Modern File Input UX
        const fileInput = document.getElementById('fotoInput');
        const fileNameDisplay = document.getElementById('fileNameDisplay');
        const fileNameText = document.getElementById('fileNameText');
        const dropZone = document.getElementById('dropZone');
        const photoPreview = document.getElementById('photoPreview');

        fileInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            
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

                // Tampilkan nama file
                fileNameText.textContent = file.name + ' (' + (file.size / 1024 / 1024).toFixed(2) + ' MB)';
                fileNameDisplay.classList.add('active');
                dropZone.style.borderColor = 'var(--accent-color)';
                dropZone.style.background = 'rgba(16, 185, 129, 0.05)';
                
                // Preview gambar dengan animasi halus
                const reader = new FileReader();
                reader.onload = function(e) {
                    if (photoPreview.tagName === 'IMG') {
                        // Jika sudah img, fade out-in
                        photoPreview.style.opacity = '0';
                        photoPreview.style.transform = 'scale(0.9)';
                        setTimeout(() => {
                            photoPreview.src = e.target.result;
                            photoPreview.style.opacity = '1';
                            photoPreview.style.transform = 'scale(1)';
                        }, 200);
                    } else {
                        // Jika placeholder, ganti dengan img
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.id = 'photoPreview';
                        img.className = 'current-photo';
                        img.alt = 'Preview Foto';
                        img.style.opacity = '0';
                        img.style.transform = 'scale(0.8)';
                        
                        photoPreview.replaceWith(img);
                        
                        // Trigger reflow untuk animasi
                        setTimeout(() => {
                            const newImg = document.getElementById('photoPreview');
                            newImg.style.transition = 'all 0.4s cubic-bezier(0.4, 0, 0.2, 1)';
                            newImg.style.opacity = '1';
                            newImg.style.transform = 'scale(1)';
                        }, 50);
                    }
                }
                reader.readAsDataURL(file);
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
                dropZone.style.borderColor = 'var(--accent-color)';
                dropZone.style.background = 'rgba(16, 185, 129, 0.1)';
            }, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, (e) => {
                e.preventDefault();
                if (!fileInput.files[0]) {
                    dropZone.style.borderColor = '';
                    dropZone.style.background = '';
                }
            }, false);
        });

        // 2. Cegah double submit
        document.getElementById('profileForm').addEventListener('submit', function() {
            const btn = document.getElementById('btn-submit');
            if (btn) {
                btn.disabled = true;
                btn.innerHTML = '⏳ Menyimpan...';
                btn.style.opacity = '0.8';
                btn.style.transform = 'scale(0.98)';
            }
        });
    </script>
</body>
</html>