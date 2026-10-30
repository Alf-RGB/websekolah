@extends($layout)

@section('title', 'Edit User - Admin')

@section('content')

<style>
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

    @keyframes slideIn {
        from { opacity: 0; transform: scale(0.95); }
        to { opacity: 1; transform: scale(1); }
    }

    .user-edit-wrapper { 
        max-width: 700px; 
        margin: 0 auto; 
        padding: 30px; 
        animation: fadeInUp 0.6s ease;
    }

    .edit-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        flex-wrap: wrap;
        gap: 15px;
        animation: fadeInDown 0.6s ease;
    }
    .edit-header-title {
        font-size: 26px;
        font-weight: 700;
        color: var(--text-primary, #1E293B);
        margin: 0 0 5px 0;
    }
    .edit-header-subtitle {
        font-size: 14px;
        color: var(--text-secondary, #64748B);
        margin: 0;
    }

    .alert-success, .alert-error {
        border-radius: 12px;
        padding: 15px 20px;
        margin-bottom: 25px;
        animation: fadeInDown 0.5s ease;
        font-size: 14px;
        font-weight: 500;
    }
    .alert-success {
        background: linear-gradient(135deg, #DCFCE7 0%, #BBF7D0 100%);
        color: #166534;
        border: 1px solid #BBF7D0;
        border-left: 4px solid #22C55E;
    }
    .alert-error {
        background: linear-gradient(135deg, #FEE2E2 0%, #FECACA 100%);
        color: #991B1B;
        border: 1px solid #FECACA;
        border-left: 4px solid #EF4444;
    }
    .alert-error ul { margin: 10px 0 0 20px; }

    .form-card {
        background: var(--card-bg, white);
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        border: 1px solid var(--border-color, #E2E8F0);
        margin-bottom: 20px;
        animation: slideIn 0.6s cubic-bezier(0.4, 0, 0.2, 1) backwards;
    }
    .form-card.card-info { animation-delay: 0.1s; }
    .form-card.card-password { animation-delay: 0.2s; }

    .card-header {
        padding: 20px 25px;
    }
    .card-header-title {
        color: white;
        font-size: 16px;
        font-weight: 700;
        margin: 0;
    }
    .card-header.user-profile {
        background: linear-gradient(135deg, {{ $user->role === 'super_admin' ? '#8B5CF6 0%, #A78BFA 100%' : 'var(--primary, #1D3557) 0%, var(--secondary, #457B9D) 100%' }});
        padding: 25px;
    }
    .user-profile-content {
        display: flex;
        align-items: center;
        gap: 15px;
        flex-wrap: wrap;
    }
    .user-avatar {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        background: rgba(255,255,255,0.25);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 28px;
        font-weight: 700;
        border: 3px solid white;
        flex-shrink: 0;
    }
    .user-details h2 {
        color: white;
        font-size: 20px;
        font-weight: 700;
        margin: 0 0 5px 0;
    }
    .user-details p {
        color: rgba(255,255,255,0.9);
        font-size: 14px;
        margin: 0;
    }
    .role-badge {
        display: inline-block;
        margin-top: 8px;
        padding: 4px 12px;
        border-radius: 50px;
        font-size: 11px;
        font-weight: 700;
        background: rgba(255,255,255,0.95);
    }
    .role-badge.super { color: #8B5CF6; }
    .role-badge.admin { color: var(--primary, #1D3557); }

    .card-body { padding: 25px; }

    .form-group { 
        margin-bottom: 20px; 
        animation: fadeInUp 0.5s ease backwards;
    }
    .form-card.card-info .form-group:nth-child(1) { animation-delay: 0.15s; }
    .form-card.card-info .form-group:nth-child(2) { animation-delay: 0.2s; }
    .form-card.card-info .form-group:nth-child(3) { animation-delay: 0.25s; }
    .form-card.card-info .form-group:nth-child(4) { animation-delay: 0.3s; }

    .form-label {
        display: block;
        font-weight: 600;
        margin-bottom: 8px;
        color: var(--text-primary, #1E293B);
        font-size: 14px;
    }
    .form-label .required { color: #EF4444; }
    
    .form-input, .form-select {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid var(--border-color, #E2E8F0);
        border-radius: 12px;
        font-size: 14px;
        background: var(--input-bg, #F8FAFC);
        color: var(--text-primary, #1E293B);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-sizing: border-box;
        font-family: inherit;
    }
    .form-input:focus, .form-select:focus {
        outline: none;
        border-color: #667eea;
        background: white;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        transform: translateY(-2px);
    }
    .form-input:disabled, .form-select:disabled {
        background: #F1F5F9 !important;
        color: #64748B !important;
        cursor: not-allowed !important;
        transform: none !important;
    }
    
    .form-hint {
        font-size: 12px;
        color: var(--text-secondary, #64748B);
        margin-top: 6px;
        display: block;
    }
    .form-hint.warning { color: #F59E0B; font-weight: 600; }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .info-box {
        background: #FEF3C7;
        padding: 15px;
        border-radius: 8px;
        border: 1px solid #FCD34D;
        margin-bottom: 20px;
        animation: fadeInUp 0.5s ease 0.25s backwards;
    }
    .info-box p {
        font-size: 13px;
        color: #92400E;
        margin: 0;
    }

    .form-actions {
        display: flex;
        gap: 15px;
        justify-content: flex-end;
        flex-wrap: wrap;
        animation: fadeInUp 0.5s ease 0.35s backwards;
    }

    .btn-action {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 14px 30px !important;
        border-radius: 12px !important;
        text-decoration: none !important;
        font-weight: 600 !important;
        font-size: 14px !important;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
        border: 1px solid #E2E8F0 !important;
        cursor: pointer !important;
    }
    .btn-secondary {
        background: #F1F5F9 !important;
        color: #475569 !important;
    }
    .btn-secondary:hover {
        background: #E2E8F0 !important;
        transform: translateY(-2px) !important;
    }
    .btn-secondary:active { transform: translateY(0) scale(0.98) !important; }

    .btn-primary {
        background: linear-gradient(135deg, #10B981 0%, #059669 100%) !important;
        color: white !important;
        border: none !important;
        box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3) !important;
        padding: 14px 40px !important;
    }
    .btn-primary:hover {
        transform: translateY(-2px) scale(1.02) !important;
        box-shadow: 0 8px 25px rgba(16, 185, 129, 0.4) !important;
        background: linear-gradient(135deg, #059669 0%, #047857 100%) !important;
    }
    .btn-primary:active { transform: translateY(0) scale(0.98) !important; }

    /* Dark Mode */
    [data-theme="dark"] .edit-header-title { color: #F1F5F9 !important; }
    [data-theme="dark"] .edit-header-subtitle { color: #94A3B8 !important; }
    [data-theme="dark"] .form-card { background: #1E293B !important; border-color: #334155 !important; }
    [data-theme="dark"] .form-label { color: #F1F5F9 !important; }
    [data-theme="dark"] .form-input, [data-theme="dark"] .form-select { 
        background: #0F172A !important; border-color: #334155 !important; color: #F1F5F9 !important; 
    }
    [data-theme="dark"] .form-input:focus, [data-theme="dark"] .form-select:focus { 
        background: #1E293B !important; border-color: #667eea !important; 
    }
    [data-theme="dark"] .form-input:disabled, [data-theme="dark"] .form-select:disabled {
        background: #1E293B !important; color: #64748B !important;
    }
    [data-theme="dark"] .form-hint { color: #94A3B8 !important; }
    [data-theme="dark"] .btn-secondary {
        background: #334155 !important; color: #F1F5F9 !important; border-color: #475569 !important;
    }
    [data-theme="dark"] .btn-secondary:hover { background: #475569 !important; }
    [data-theme="dark"] .btn-primary {
        background: linear-gradient(135deg, #34D399 0%, #10B981 100%) !important;
        border: 2px solid rgba(52, 211, 153, 0.3) !important;
    }
    [data-theme="dark"] .btn-primary:hover {
        background: linear-gradient(135deg, #6EE7B7 0%, #34D399 100%) !important;
        border-color: rgba(52, 211, 153, 0.5) !important;
    }

    @media (max-width: 768px) {
        .user-edit-wrapper { padding: 20px; }
        .edit-header { flex-direction: column; align-items: flex-start; }
        .card-body { padding: 20px; }
        .form-row { grid-template-columns: 1fr; gap: 15px; }
        .form-actions { flex-direction: column-reverse; }
        .btn-action { width: 100% !important; }
    }
</style>

<div class="user-edit-wrapper">

    {{-- HEADER --}}
    <div class="edit-header">
        <div>
            <h1 class="edit-header-title">✏️ Edit User Admin</h1>
            <p class="edit-header-subtitle">Ubah informasi dan reset password user</p>
        </div>
        <a href="/admin/users" class="btn-action btn-secondary" style="min-width: auto; padding: 10px 20px !important;">
            ← Kembali
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

    {{-- INFO USER --}}
    <div class="form-card card-info" style="animation-delay: 0s;">
        <div class="card-header user-profile">
            <div class="user-profile-content">
                <div class="user-avatar">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                <div class="user-details">
                    <h2>{{ $user->name }}</h2>
                    <p>{{ $user->email }}</p>
                    <div>
                        @if($user->role === 'super_admin')
                            <span class="role-badge super">👑 Super Admin</span>
                        @else
                            <span class="role-badge admin">🔑 Admin</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- FORM EDIT --}}
    <form action="/admin/users/{{ $user->id }}" method="POST" id="userEditForm">
        @csrf
        @method('PUT')

        {{-- Section: Informasi --}}
        <div class="form-card card-info">
            <div class="card-header" style="background: linear-gradient(135deg, var(--primary, #1D3557) 0%, var(--secondary, #457B9D) 100%);">
                <h3 class="card-header-title">Informasi User</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label">Nama Lengkap <span class="required">*</span></label>
                    <input type="text" name="name" class="form-input" value="{{ old('name', $user->name) }}" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Username (Login)</label>
                    <input type="text" class="form-input" value="{{ $user->username }}" readonly>
                    <small class="form-hint">🔒 Username dikunci untuk menjaga kestabilan akun.</small>
                </div>

                <div class="form-group">
                    <label class="form-label">Email <span class="required">*</span></label>
                    <input type="email" name="email" class="form-input" value="{{ old('email', $user->email) }}" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Role <span class="required">*</span></label>
                    
                    @php
                        $isSelf = $user->id === auth()->id();
                    @endphp

                    <select name="role" class="form-select" required {{ $isSelf ? 'disabled' : '' }}>
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
        </div>

        {{-- Section: Reset Password --}}
        <div class="form-card card-password">
            <div class="card-header" style="background: linear-gradient(135deg, #F59E0B 0%, #FBBF24 100%);">
                <h3 class="card-header-title">Reset Password</h3>
            </div>
            <div class="card-body">
                <div class="info-box">
                    <p>
                        <strong>💡 Info:</strong> Kosongkan field password jika tidak ingin mengubah password user saat ini.
                    </p>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Password Baru</label>
                        <input type="password" name="password" class="form-input" placeholder="Minimal 6 karakter" minlength="6">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="form-input" placeholder="Ulangi password baru" minlength="6">
                    </div>
                </div>
                <small class="form-hint">Kosongkan kedua field di atas jika tidak ingin mengubah password.</small>
            </div>
        </div>

        {{-- Submit --}}
        <div class="form-actions">
            <a href="/admin/users" class="btn-action btn-secondary">
                Batal
            </a>
            <button type="submit" id="btn-submit" class="btn-action btn-primary">
                💾 Simpan Perubahan
            </button>
        </div>
    </form>

</div>

{{-- SCRIPT PENCEGAHAN DOUBLE SUBMIT --}}
<script>
    document.getElementById('userEditForm').addEventListener('submit', function() {
        const btn = document.getElementById('btn-submit');
        if(btn) {
            btn.disabled = true;
            btn.innerHTML = '⏳ Memperbarui...';
            btn.style.opacity = '0.8';
            btn.style.transform = 'scale(0.98)';
        }
    });
</script>

@endsection