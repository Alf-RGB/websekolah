@extends($layout)

@section('title', 'Edit User - Admin')

@section('content')

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

    @keyframes fadeInDown { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes slideIn { from { opacity: 0; transform: scale(0.96) translateY(20px); } to { opacity: 1; transform: scale(1) translateY(0); } }

    /* =========================================
       2. WRAPPER & HEADER
       ========================================= */
    .admin-edit-wrapper { 
        max-width: 700px; 
        margin: 40px auto; 
        padding: 0 20px; 
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
        font-weight: 700; 
        margin: 0 0 5px 0; 
    }
    .page-header p { 
        color: var(--text-secondary); 
        font-size: 14px; 
        margin: 0; 
    }

    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: var(--bg-secondary);
        color: var(--text-primary);
        padding: 10px 20px;
        border-radius: 10px;
        text-decoration: none;
        font-weight: 600;
        font-size: 13px;
        border: 1px solid var(--border-color);
        transition: var(--transition-smooth);
        box-shadow: var(--shadow-sm);
    }
    .btn-back:hover {
        background: var(--bg-tertiary);
        border-color: var(--primary-hover);
        color: var(--primary-hover);
        transform: translateX(-3px);
    }
    .btn-back:active { transform: translateX(-3px) scale(0.98); }

    /* =========================================
       3. FORM CARDS & INPUTS
       ========================================= */
    .form-card {
        background: var(--bg-secondary);
        padding: 30px;
        border-radius: 16px;
        box-shadow: var(--shadow-lg);
        border: 1px solid var(--border-color);
        margin-bottom: 20px;
        animation: slideIn 0.6s cubic-bezier(0.4, 0, 0.2, 1) backwards;
    }
    .form-card:nth-child(1) { animation-delay: 0.1s; }
    .form-card:nth-child(2) { animation-delay: 0.2s; }

    .card-title {
        color: var(--text-primary);
        font-size: 18px;
        font-weight: 700;
        margin: 0 0 20px 0;
        padding-bottom: 15px;
        border-bottom: 1px solid var(--border-color);
    }

    .form-group { 
        margin-bottom: 20px; 
        animation: fadeInUp 0.5s ease-out backwards;
    }
    .form-group:nth-child(2) { animation-delay: 0.15s; }
    .form-group:nth-child(3) { animation-delay: 0.2s; }
    .form-group:nth-child(4) { animation-delay: 0.25s; }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        animation: fadeInUp 0.5s ease-out 0.3s backwards;
    }

    .form-label {
        display: block;
        font-weight: 600;
        margin-bottom: 8px;
        color: var(--text-primary);
        font-size: 14px;
    }
    .form-label .required { color: #EF4444; margin-left: 2px; }

    .form-input, .form-select {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid var(--border-color);
        border-radius: 10px;
        font-size: 14px;
        background: var(--bg-primary);
        color: var(--text-primary);
        transition: var(--transition-smooth);
        box-sizing: border-box;
        font-family: inherit;
    }
    .form-input:focus, .form-select:focus {
        outline: none;
        border-color: var(--primary-hover);
        background: var(--bg-secondary);
        box-shadow: 0 0 0 4px rgba(69, 123, 157, 0.1);
        transform: translateY(-2px);
    }
    .form-input::placeholder { color: var(--text-muted); }

    /* Readonly & Disabled States */
    .form-input:read-only, .form-select:disabled {
        background: var(--bg-tertiary) !important;
        color: var(--text-muted) !important;
        cursor: not-allowed;
        border-color: var(--border-color) !important;
        transform: none !important;
        box-shadow: none !important;
    }

    .form-hint {
        color: var(--text-secondary);
        font-size: 12px;
        margin-top: 6px;
        display: block;
    }
    .form-hint.warning {
        color: #F59E0B;
        font-weight: 600;
    }

    /* =========================================
       4. ALERTS & INFO BOX
       ========================================= */
    .alert-success {
        background: linear-gradient(135deg, #D1FAE5 0%, #A7F3D0 100%);
        color: #065F46;
        padding: 15px 20px;
        border-radius: 12px;
        margin-bottom: 25px;
        border: 1px solid #A7F3D0;
        border-left: 4px solid #22C55E;
        font-size: 14px;
        font-weight: 500;
        animation: fadeInDown 0.5s ease-out;
    }

    .alert-error {
        background: linear-gradient(135deg, #FEE2E2 0%, #FECACA 100%);
        color: #991B1B;
        padding: 15px 20px;
        border-radius: 12px;
        margin-bottom: 25px;
        border: 1px solid #FECACA;
        border-left: 4px solid #EF4444;
        animation: fadeInDown 0.5s ease-out;
    }
    .alert-error strong { display: block; margin-bottom: 5px; }
    .alert-error ul { margin: 0; padding-left: 20px; font-size: 14px; }
    .alert-error li { margin-bottom: 4px; }

    .info-box {
        background: rgba(245, 158, 11, 0.1);
        color: #92400E;
        padding: 15px;
        border-radius: 10px;
        border: 1px solid rgba(245, 158, 11, 0.2);
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
        animation: fadeInUp 0.5s ease-out 0.15s backwards;
    }
    .info-box strong { font-weight: 600; }

    /* =========================================
       5. ACTION BUTTONS
       ========================================= */
    .form-actions {
        display: flex;
        gap: 15px;
        justify-content: flex-end;
        flex-wrap: wrap;
        animation: fadeInUp 0.5s ease-out 0.35s backwards;
    }

    .btn-submit {
        background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
        color: white;
        padding: 14px 40px;
        border: none;
        border-radius: 10px;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
        transition: var(--transition-smooth);
        box-shadow: 0 4px 12px rgba(29, 53, 87, 0.2);
    }
    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(29, 53, 87, 0.3);
    }
    .btn-submit:active { transform: translateY(0) scale(0.98); }
    .btn-submit:disabled {
        opacity: 0.7;
        cursor: not-allowed;
        transform: none;
        box-shadow: none;
    }

    .btn-cancel {
        background: var(--bg-tertiary);
        color: var(--text-secondary);
        padding: 14px 30px;
        border-radius: 10px;
        text-decoration: none;
        font-weight: 600;
        font-size: 14px;
        border: 1px solid var(--border-color);
        text-align: center;
        transition: var(--transition-smooth);
    }
    .btn-cancel:hover {
        background: var(--border-color);
        color: var(--text-primary);
        transform: translateY(-2px);
    }
    .btn-cancel:active { transform: translateY(0) scale(0.98); }

    /* =========================================
       6. DARK MODE OVERRIDES
       ========================================= */
    [data-theme="dark"] .alert-success {
        background: linear-gradient(135deg, #064E3B 0%, #065F46 100%) !important;
        color: #6EE7B7 !important;
        border-color: #065F46 !important;
    }
    [data-theme="dark"] .alert-error {
        background: linear-gradient(135deg, #7F1D1D 0%, #991B1B 100%) !important;
        color: #FCA5A5 !important;
        border-color: #991B1B !important;
    }
    [data-theme="dark"] .info-box {
        background: rgba(245, 158, 11, 0.15) !important;
        color: #FCD34D !important;
        border-color: rgba(245, 158, 11, 0.3) !important;
    }
    [data-theme="dark"] .form-input, [data-theme="dark"] .form-select {
        background: var(--bg-primary) !important;
        border-color: var(--border-color) !important;
        color: var(--text-primary) !important;
    }
    [data-theme="dark"] .form-input:focus, [data-theme="dark"] .form-select:focus {
        background: var(--bg-secondary) !important;
        border-color: var(--primary-hover) !important;
    }

    /* =========================================
       7. RESPONSIVE
       ========================================= */
    @media (max-width: 768px) {
        .admin-edit-wrapper { margin: 20px auto; padding: 0 15px; }
        .page-header { flex-direction: column; align-items: flex-start; }
        .form-card { padding: 25px 20px; }
        .form-row { grid-template-columns: 1fr; gap: 15px; }
        .form-actions { flex-direction: column-reverse; }
        .btn-submit, .btn-cancel { width: 100%; }
    }
</style>

<div class="admin-edit-wrapper">
    {{-- HEADER --}}
    <div class="page-header">
        <div>
            <h1>✏️ Edit User Admin</h1>
            <p>Ubah informasi dan reset password user</p>
        </div>
        <a href="/admin/users" class="btn-back">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
            Kembali
        </a>
    </div>

    @if(session('success'))
        <div class="alert-success">
            ✅ {{ session('success') }}
        </div>
    @endif

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

    {{-- FORM EDIT --}}
    <form action="/admin/users/{{ $user->id }}" method="POST" id="userEditForm">
        @csrf
        @method('PUT')

        <div class="form-card">
            <h3 class="card-title">Informasi User</h3>
            
            <div class="form-group">
                <label for="name" class="form-label">Nama Lengkap <span class="required">*</span></label>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required class="form-input">
            </div>

            <div class="form-group">
                <label class="form-label">Username (Login)</label>
                <input type="text" value="{{ $user->username }}" readonly class="form-input">
                <small class="form-hint">🔒 Username dikunci untuk menjaga kestabilan akun login.</small>
            </div>

            <div class="form-group">
                <label for="email" class="form-label">Email <span class="required">*</span></label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required class="form-input">
            </div>

            <div class="form-group">
                <label for="role" class="form-label">Role <span class="required">*</span></label>
                
                @php
                    $isSelf = $user->id === auth()->id();
                @endphp

                <select id="role" name="role" required {{ $isSelf ? 'disabled' : '' }} class="form-select">
                    <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>🔑 Admin</option>
                    <option value="super_admin" {{ old('role', $user->role) === 'super_admin' ? 'selected' : '' }}>👑 Super Admin</option>
                </select>
                
                @if($isSelf)
                    <input type="hidden" name="role" value="{{ $user->role }}">
                    <small class="form-hint warning">
                        ⚠️ Anda tidak dapat mengubah role akun Anda sendiri untuk mencegah terkunci dari sistem.
                    </small>
                @else
                    <small class="form-hint">
                        <strong>Admin:</strong> Akses terbatas. <strong>Super Admin:</strong> Akses penuh termasuk kelola user.
                    </small>
                @endif
            </div>
        </div>

        <div class="form-card">
            <h3 class="card-title">Reset Password</h3>
            
            <div class="info-box">
                <span>💡</span> 
                <span><strong>Info:</strong> Kosongkan kedua field di bawah ini jika tidak ingin mengubah password user saat ini.</span>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="password" class="form-label">Password Baru</label>
                    <input type="password" id="password" name="password" minlength="6" placeholder="Minimal 6 karakter" class="form-input">
                </div>
                <div class="form-group">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" minlength="6" placeholder="Ulangi password baru" class="form-input">
                </div>
            </div>
        </div>

        {{-- Submit Buttons --}}
        <div class="form-actions">
            <a href="/admin/users" class="btn-cancel">
                Batal
            </a>
            <button type="submit" id="btn-submit" class="btn-submit">
                💾 Simpan Perubahan
            </button>
        </div>
    </form>
</div>

{{-- SCRIPT PENCEGAHAN DOUBLE SUBMIT --}}
<script>
    document.getElementById('userEditForm').addEventListener('submit', function() {
        const btn = document.getElementById('btn-submit');
        if (btn) {
            btn.disabled = true;
            btn.innerHTML = '⏳ Memperbarui...';
            btn.style.opacity = '0.8';
            btn.style.transform = 'scale(0.98)';
        }
    });
</script>

@endsection