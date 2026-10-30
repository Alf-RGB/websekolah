<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Materi - Portal Guru</title>
    
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
        .container { 
            max-width: 700px; 
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
        .form-textarea { resize: vertical; min-height: 100px; }

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
            padding: 30px 20px;
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
            font-size: 32px;
            margin-bottom: 10px;
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
        .file-upload-hint {
            font-size: 12px;
            color: var(--text-muted);
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
           5. ACTIONS & ALERTS
           ========================================= */
        .form-actions { 
            display: flex; 
            gap: 12px; 
            margin-top: 30px; 
            padding-top: 25px;
            border-top: 1px solid var(--border-color);
            animation: fadeInUp 0.5s ease-out 0.3s backwards;
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

        /* =========================================
           6. DARK MODE OVERRIDES
           ========================================= */
        [data-theme="dark"] .btn-back { background: var(--bg-secondary); color: var(--text-primary); border-color: var(--border-color); }
        [data-theme="dark"] .btn-back:hover { background: var(--bg-tertiary); }
        [data-theme="dark"] .alert-error { background: linear-gradient(135deg, #7F1D1D 0%, #991B1B 100%) !important; color: #FCA5A5 !important; border-color: #EF4444 !important; }
        [data-theme="dark"] .file-upload-wrapper { background: var(--bg-primary); border-color: var(--border-color); }
        [data-theme="dark"] .file-upload-wrapper:hover { background: rgba(16, 185, 129, 0.1); border-color: var(--accent-color); }

        /* =========================================
           7. RESPONSIVE
           ========================================= */
        @media (max-width: 768px) {
            body { padding: 20px 15px; }
            .page-header { flex-direction: column; align-items: flex-start; }
            .form-card { padding: 25px 20px; }
            .form-actions { flex-direction: column-reverse; }
            .btn { width: 100%; }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="page-header">
            <h1>📚 Upload Materi Ajar</h1>
            <a href="/portal/guru/materi" class="btn-back">← Kembali</a>
        </div>

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
            <form action="/portal/guru/materi" method="POST" enctype="multipart/form-data" id="materiForm">
                @csrf
                
                <div class="form-group">
                    <label class="form-label">Judul Materi <span class="required">*</span></label>
                    <input type="text" name="judul" class="form-input" value="{{ old('judul') }}" required placeholder="Contoh: Bab 1 - Pengenalan HTML">
                </div>
                
                <div class="form-group">
                    <label class="form-label">Deskripsi Singkat</label>
                    <textarea name="deskripsi" class="form-textarea" rows="3" placeholder="Penjelasan singkat tentang materi ini...">{{ old('deskripsi') }}</textarea>
                </div>
                
                <div class="form-group">
                    <label class="form-label">File Materi <span class="required">*</span></label>
                    <div class="file-upload-wrapper" id="dropZone">
                        <input type="file" name="file" id="fileInput" accept=".pdf" required>
                        <div class="file-upload-icon">📄</div>
                        <div class="file-upload-text">Klik atau seret file PDF ke sini</div>
                        <div class="file-upload-hint">Format: PDF. Maksimal ukuran: 5MB.</div>
                        <div class="file-name-display" id="fileNameDisplay">
                            <span>✅</span> <span id="fileNameText"></span>
                        </div>
                    </div>
                </div>
                
                <div class="form-actions">
                    <a href="/portal/guru/materi" class="btn btn-cancel">Batal</a>
                    <button type="submit" id="btn-submit" class="btn btn-save">💾 Upload Materi</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // 1. Modern File Input UX
        const fileInput = document.getElementById('fileInput');
        const fileNameDisplay = document.getElementById('fileNameDisplay');
        const fileNameText = document.getElementById('fileNameText');
        const dropZone = document.getElementById('dropZone');

        fileInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const file = this.files[0];
                
                // Validasi ukuran (5MB)
                if (file.size > 5 * 1024 * 1024) {
                    alert('⚠️ Ukuran file melebihi batas maksimal 5MB!');
                    this.value = '';
                    fileNameDisplay.classList.remove('active');
                    return;
                }
                
                // Validasi tipe file
                if (file.type !== 'application/pdf') {
                    alert('⚠️ Hanya file PDF yang diperbolehkan!');
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

        // 2. Cegah double submit saat upload file besar
        document.getElementById('materiForm').addEventListener('submit', function() {
            const btn = document.getElementById('btn-submit');
            if (btn) {
                btn.disabled = true;
                btn.innerHTML = '⏳ Mengupload...';
                btn.style.opacity = '0.8';
                btn.style.transform = 'scale(0.98)';
            }
        });
    </script>
</body>
</html>