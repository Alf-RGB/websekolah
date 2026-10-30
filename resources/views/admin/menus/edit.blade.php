<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Menu - Admin</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', sans-serif; }
        body { background: #F1FAEE; padding: 40px 20px; }
        .container { max-width: 800px; margin: 0 auto; }
        .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; flex-wrap: wrap; gap: 15px; }
        .page-header h1 { color: #1D3557; font-size: 24px; }
        .btn { padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: bold; transition: 0.3s; border: none; cursor: pointer; font-size: 14px; display: inline-flex; align-items: center; gap: 6px; }
        .btn-save { background: #1D3557; color: white; }
        .btn-save:hover { background: #457B9D; }
        .btn-save:disabled { background: #94A3B8; cursor: not-allowed; }
        .btn-back { background: white; color: #1D3557; box-shadow: 0 2px 5px rgba(0,0,0,0.05); }
        .btn-back:hover { background: #F8FAFC; }
        .form-card { background: white; padding: 40px; border-radius: 16px; box-shadow: 0 10px 30px rgba(29, 53, 87, 0.05); }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; color: #2B2D42; font-weight: 600; margin-bottom: 8px; font-size: 14px; }
        .form-group input, .form-group textarea, .form-group select { width: 100%; padding: 12px 16px; border: 2px solid #E2E8F0; border-radius: 8px; font-size: 15px; font-family: inherit; transition: 0.3s; background: white; }
        .form-group input:focus, .form-group textarea:focus, .form-group select:focus { border-color: #457B9D; outline: none; }
        .form-actions { display: flex; gap: 15px; margin-top: 30px; }
        .btn-cancel { background: #E2E8F0; color: #2B2D42; padding: 12px 30px; border-radius: 8px; text-decoration: none; font-weight: bold; }
        .btn-cancel:hover { background: #CBD5E1; }
        .hint { font-size: 12px; color: #8D99AE; margin-top: 5px; }
        .error { background: #FEE2E2; color: #991B1B; padding: 15px; border-radius: 8px; margin-bottom: 20px; border-left: 4px solid #EF4444; }
        
        /* Style khusus checkbox */
        .checkbox-group { display: flex; align-items: center; gap: 10px; cursor: pointer; }
        .checkbox-group input[type="checkbox"] { width: 20px; height: 20px; cursor: pointer; accent-color: #1D3557; }
        .checkbox-group label { margin: 0 !important; font-weight: 500; color: #1D3557; cursor: pointer; }
    </style>
</head>
<body>
    <div class="container">
        <div class="page-header">
            <h1>✏️ Edit Menu</h1>
            <a href="/admin/menus" class="btn btn-back">← Kembali</a>
        </div>

        @if($errors->any())
            <div class="error">
                <strong>⚠️ Ada kesalahan pada input:</strong>
                <ul style="margin: 10px 0 0 20px;">
                    @foreach($errors->all() as $error) 
                        <li>{{ $error }}</li> 
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="form-card">
            <form action="/admin/menus/{{ $menu->id }}" method="POST" id="menuEditForm">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label>Judul Menu *</label>
                    <input type="text" name="judul_menu" value="{{ old('judul_menu', $menu->judul_menu) }}" required placeholder="Contoh: Profil Sekolah">
                </div>

                <div class="form-group">
                    <label>URL Tujuan *</label>
                    <input type="text" name="url" value="{{ old('url', $menu->url) }}" required placeholder="Contoh: /profil atau https://example.com">
                    <p class="hint">Gunakan <code>/</code> untuk halaman internal, atau URL lengkap untuk link eksternal.</p>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div class="form-group">
                        <label>Menu Induk (Opsional)</label>
                        <select name="parent_id">
                            <option value="">-- Tidak Ada (Jadikan Menu Utama) --</option>
                            {{-- SAFEGUARD: Mencegah menu menjadi induk dirinya sendiri ($m->id != $menu->id) --}}
                            @foreach($menus ?? [] as $m)
                                @if($m->id != $menu->id)
                                    <option value="{{ $m->id }}" {{ old('parent_id', $menu->parent_id) == $m->id ? 'selected' : '' }}>
                                        {{ $m->judul_menu }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                        <p class="hint">Pilih jika ini adalah sub-menu (dropdown).</p>
                    </div>

                    <div class="form-group">
                        <label>Urutan Tampil *</label>
                        <input type="number" name="urutan" value="{{ old('urutan', $menu->urutan) }}" min="1" required>
                        <p class="hint">Angka lebih kecil akan tampil lebih kiri/dulu.</p>
                    </div>
                </div>

                <div class="form-group">
                    <div class="checkbox-group">
                        <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $menu->is_active) ? 'checked' : '' }}>
                        <label for="is_active">Aktif (tampilkan menu ini di website publik)</label>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" id="btn-submit" class="btn btn-save">💾 Update Menu</button>
                    <a href="/admin/menus" class="btn btn-cancel">Batal</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Script mencegah double submit
        document.getElementById('menuEditForm').addEventListener('submit', function() {
            const btn = document.getElementById('btn-submit');
            btn.disabled = true;
            btn.innerHTML = '⏳ Memperbarui...';
        });
    </script>
</body>
</html>