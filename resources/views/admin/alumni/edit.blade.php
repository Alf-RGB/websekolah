<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Alumni - Admin</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', sans-serif; }
        
        body { 
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); 
            min-height: 100vh;
            padding: 40px 20px;
            position: relative;
            overflow-x: hidden;
        }

        /* Background Pattern */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            pointer-events: none;
            z-index: 0;
        }

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

        @keyframes fadeInLeft {
            from { opacity: 0; transform: translateX(-30px); }
            to { opacity: 1; transform: translateX(0); }
        }

        @keyframes slideIn {
            from { opacity: 0; transform: scale(0.95); }
            to { opacity: 1; transform: scale(1); }
        }

        .container { 
            max-width: 900px; 
            margin: 0 auto; 
            position: relative;
            z-index: 1;
            animation: fadeInUp 0.6s ease;
        }

        /* Page Header */
        .page-header { 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            margin-bottom: 40px; 
            animation: fadeInDown 0.6s ease;
        }

        .page-header h1 { 
            color: white; 
            font-size: 32px; 
            font-weight: 800;
            text-shadow: 0 2px 10px rgba(0,0,0,0.2);
        }

        .btn { 
            padding: 12px 24px; 
            border-radius: 12px; 
            text-decoration: none; 
            font-weight: 700; 
            font-size: 14px; 
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); 
            border: none; 
            cursor: pointer; 
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-save { 
            background: linear-gradient(135deg, #10B981 0%, #059669 100%); 
            color: white;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
        }

        .btn-save:hover { 
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(16, 185, 129, 0.4);
        }

        .btn-back { 
            background: rgba(255,255,255,0.95); 
            color: #667eea; 
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .btn-back:hover { 
            background: white;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.15);
        }

        /* Form Card */
        .form-card { 
            background: white; 
            padding: 45px; 
            border-radius: 24px; 
            box-shadow: 0 20px 60px rgba(0,0,0,0.15);
            animation: slideIn 0.6s ease 0.2s both;
        }

        /* Form Groups dengan Stagger Animation */
        .form-group { 
            margin-bottom: 25px; 
            animation: fadeInUp 0.5s ease backwards;
        }

        .form-group:nth-child(1) { animation-delay: 0.1s; }
        .form-group:nth-child(2) { animation-delay: 0.15s; }
        .form-group:nth-child(3) { animation-delay: 0.2s; }
        .form-group:nth-child(4) { animation-delay: 0.25s; }
        .form-group:nth-child(5) { animation-delay: 0.3s; }
        .form-group:nth-child(6) { animation-delay: 0.35s; }

        .form-group label { 
            display: block; 
            color: #1E293B; 
            font-weight: 700; 
            margin-bottom: 10px; 
            font-size: 14px;
            letter-spacing: 0.3px;
        }

        .form-group input, 
        .form-group textarea, 
        .form-group select { 
            width: 100%; 
            padding: 14px 18px; 
            border: 2px solid #E2E8F0; 
            border-radius: 12px; 
            font-size: 15px; 
            font-family: inherit; 
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background: #F8FAFC;
        }

        .form-group input:focus, 
        .form-group textarea:focus, 
        .form-group select:focus { 
            border-color: #667eea; 
            outline: none;
            background: white;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
            transform: translateY(-2px);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        .form-actions { 
            display: flex; 
            gap: 15px; 
            margin-top: 35px;
            padding-top: 30px;
            border-top: 2px solid #E2E8F0;
            animation: fadeInUp 0.5s ease 0.5s both;
        }

        .btn-cancel { 
            background: #F1F5F9; 
            color: #475569; 
            padding: 12px 30px; 
            border-radius: 12px; 
            text-decoration: none; 
            font-weight: 700;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .btn-cancel:hover { 
            background: #E2E8F0;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .hint { 
            font-size: 12px; 
            color: #64748B; 
            margin-top: 8px;
            font-style: italic;
        }

        .error { 
            background: linear-gradient(135deg, #FEE2E2 0%, #FECACA 100%); 
            color: #991B1B; 
            padding: 18px 22px; 
            border-radius: 12px; 
            margin-bottom: 25px; 
            border-left: 4px solid #EF4444;
            animation: fadeInDown 0.5s ease;
            box-shadow: 0 4px 15px rgba(239, 68, 68, 0.15);
        }

        .current-photo { 
            display: flex; 
            align-items: center; 
            gap: 15px; 
            margin-top: 15px;
            padding: 15px;
            background: #F8FAFC;
            border-radius: 12px;
            animation: fadeInLeft 0.5s ease;
        }

        .current-photo img { 
            width: 80px; 
            height: 80px; 
            border-radius: 50%; 
            object-fit: cover; 
            border: 3px solid #E2E8F0;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: all 0.3s;
        }

        .current-photo img:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 20px rgba(0,0,0,0.15);
        }

        /* Checkbox Styling */
        .checkbox-wrapper {
            background: linear-gradient(135deg, #F0FDF4 0%, #DCFCE7 100%);
            padding: 20px;
            border-radius: 12px;
            border: 2px solid #86EFAC;
            animation: fadeInUp 0.5s ease 0.4s both;
        }

        .checkbox-label { 
            display: flex; 
            align-items: center; 
            gap: 12px; 
            cursor: pointer; 
            font-weight: 700; 
            color: #166534;
            font-size: 15px;
        }

        .checkbox-label input[type="checkbox"] { 
            width: 22px; 
            height: 22px; 
            cursor: pointer; 
            accent-color: #10B981;
        }

        /* File Upload dengan Preview */
        .file-upload-wrapper {
            animation: fadeInUp 0.5s ease 0.45s both;
        }

        .file-input-wrapper {
            position: relative;
            overflow: hidden;
            display: inline-block;
            width: 100%;
        }

        .file-input-wrapper input[type=file] {
            position: absolute;
            left: -9999px;
        }

        .file-input-label {
            display: block;
            padding: 14px 18px;
            background: #F8FAFC;
            border: 2px dashed #CBD5E1;
            border-radius: 12px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            color: #64748B;
            font-weight: 600;
        }

        .file-input-label:hover {
            border-color: #667eea;
            background: #EEF2FF;
            color: #667eea;
            transform: translateY(-2px);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .form-row {
                grid-template-columns: 1fr;
            }
            .form-card {
                padding: 30px 20px;
            }
            .page-header h1 {
                font-size: 24px;
            }
            .form-actions {
                flex-direction: column;
            }
            .btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="page-header">
            <h1>✏️ Edit Data Alumni</h1>
            <a href="/admin/alumni" class="btn btn-back">← Kembali</a>
        </div>

        @if($errors->any())
            <div class="error">
                <strong>⚠️ Ada kesalahan:</strong>
                <ul style="margin: 10px 0 0 20px;">
                    @foreach($errors->all() as $error) 
                        <li>{{ $error }}</li> 
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="form-card">
            <form action="/admin/alumni/{{ $alumni->id }}" method="POST" enctype="multipart/form-data">
                @csrf 
                @method('PUT')
                
                <div class="form-group">
                    <label>Nama Lengkap *</label>
                    <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $alumni->nama_lengkap) }}" required placeholder="Contoh: Budi Santoso">
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Tahun Lulus *</label>
                        <input type="number" name="tahun_lulus" value="{{ old('tahun_lulus', $alumni->tahun_lulus) }}" required min="1950" max="{{ date('Y') }}">
                    </div>
                    <div class="form-group">
                        <label>Jurusan di Sekolah</label>
                        <input type="text" name="jurusan" value="{{ old('jurusan', $alumni->jurusan) }}" placeholder="Contoh: Teknik Komputer Jaringan">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Email *</label>
                        <input type="email" name="email" value="{{ old('email', $alumni->email) }}" required placeholder="email@contoh.com">
                    </div>
                    <div class="form-group">
                        <label>Nomor HP / WhatsApp *</label>
                        <input type="tel" name="no_hp" value="{{ old('no_hp', $alumni->no_hp) }}" required placeholder="08123456789">
                    </div>
                </div>

                <div class="form-group">
                    <label>Status Sekarang *</label>
                    <select name="status_sekarang" required>
                        <option value="">-- Pilih Status --</option>
                        <option value="Kuliah" {{ old('status_sekarang', $alumni->status_sekarang) == 'Kuliah' ? 'selected' : '' }}>Sedang Kuliah</option>
                        <option value="Kerja" {{ old('status_sekarang', $alumni->status_sekarang) == 'Kerja' ? 'selected' : '' }}>Sudah Bekerja</option>
                        <option value="Wirausaha" {{ old('status_sekarang', $alumni->status_sekarang) == 'Wirausaha' ? 'selected' : '' }}>Wirausaha / Bisnis Sendiri</option>
                        <option value="Lainnya" {{ old('status_sekarang', $alumni->status_sekarang) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Nama Instansi (Kampus/Perusahaan)</label>
                        <input type="text" name="nama_instansi" value="{{ old('nama_instansi', $alumni->nama_instansi) }}">
                    </div>
                    <div class="form-group">
                        <label>Jabatan / Posisi</label>
                        <input type="text" name="jabatan" value="{{ old('jabatan', $alumni->jabatan) }}">
                    </div>
                </div>

                <div class="checkbox-wrapper">
                    <label class="checkbox-label">
                        <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $alumni->is_featured) ? 'checked' : '' }}>
                         Tampilkan di Halaman Depan (Featured Alumni)
                    </label>
                    <p class="hint">Centang jika alumni ini ingin ditampilkan sebagai testimoni utama di beranda.</p>
                </div>

                <div class="form-group file-upload-wrapper">
                    <label>Foto Profil</label>
                    <div class="file-input-wrapper">
                        <input type="file" name="foto" id="fotoInput" accept="image/jpeg,image/png,image/jpg" onchange="previewFoto(this)">
                        <label for="fotoInput" class="file-input-label">
                            📁 Klik untuk upload foto
                        </label>
                    </div>
                    <p class="hint">Format: JPG, PNG. Maksimal 2MB. Kosongkan jika tidak ingin mengganti.</p>
                    
                    @if($alumni->foto && file_exists(storage_path('app/public/alumni/' . $alumni->foto)))
                        <div class="current-photo">
                            <img src="{{ asset('storage/alumni/' . $alumni->foto) }}" alt="Foto {{ $alumni->nama_lengkap }}" id="currentFoto">
                            <div>
                                <span style="color: #475569; font-weight: 600; display: block;">Foto saat ini</span>
                                <span style="color: #8D99AE; font-size: 13px;">{{ $alumni->foto }}</span>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label>Testimoni / Pesan untuk Adik Kelas</label>
                    <textarea name="testimoni" rows="4" placeholder="Tulis pesan motivasi...">{{ old('testimoni', $alumni->testimoni) }}</textarea>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-save">💾 Update Data</button>
                    <a href="/admin/alumni" class="btn btn-cancel">Batal</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        function previewFoto(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    let currentFoto = document.getElementById('currentFoto');
                    if (!currentFoto) {
                        const wrapper = document.querySelector('.current-photo');
                        if (wrapper) {
                            wrapper.innerHTML = '<img src="' + e.target.result + '" alt="Preview" id="currentFoto"><div><span style="color: #475569; font-weight: 600; display: block;">Preview foto baru</span></div>';
                        } else {
                            const newDiv = document.createElement('div');
                            newDiv.className = 'current-photo';
                            newDiv.innerHTML = '<img src="' + e.target.result + '" alt="Preview" id="currentFoto"><div><span style="color: #475569; font-weight: 600; display: block;">Preview foto baru</span></div>';
                            input.parentElement.parentElement.appendChild(newDiv);
                        }
                    } else {
                        currentFoto.src = e.target.result;
                    }
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>
</html>