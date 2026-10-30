@extends($layout)

@section('title', 'Tambah Admin - Super Admin')

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

    .admin-create-wrapper { 
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

    .alert-error {
        background: linear-gradient(135deg, #FEE2E2 0%, #FECACA 100%);
        border: 2px solid #EF4444;
        border-radius: 12px;
        padding: 15px 20px;
        margin-bottom: 25px;
        animation: fadeInDown 0.5s ease;
        box-shadow: 0 4px 15px rgba(239, 68, 68, 0.15);
    }
    .alert-error-title {
        color: #991B1B;
        font-weight: 700;
        font-size: 14px;
        margin: 0 0 8px 0;
    }
    .alert-error ul {
        margin: 0;
        padding-left: 20px;
        color: #991B1B;
        font-size: 13px;
    }

    .form-card {
        background: var(--card-bg, white);
        border-radius: 20px;
        padding: 35px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        border: 1px solid var(--border-color, #E2E8F0);
        animation: slideIn 0.6s cubic-bezier(0.4, 0, 0.2, 1) 0.1s backwards;
    }

    .form-group { 
        margin-bottom: 25px; 
        animation: fadeInUp 0.5s ease backwards;
    }
    .form-group:nth-child(1) { animation-delay: 0.2s; }
    .form-group:nth-child(2) { animation-delay: 0.25s; }
    .form-group:nth-child(3) { animation-delay: 0.3s; }
    .form-group:nth-child(4) { animation-delay: 0.35s; }

    .form-label {
        display: block;
        font-size: 14px;
        font-weight: 600;
        color: var(--text-primary, #1E293B);
        margin-bottom: 8px;
    }
    .form-label .required { color: #EF4444; margin-left: 2px; }
    
    .form-input {
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
    .form-input:focus {
        outline: none;
        border-color: #667eea;
        background: white;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        transform: translateY(-2px); /* Efek angkat halus saat focus */
    }
    
    .form-hint {
        font-size: 12px;
        color: var(--text-secondary, #64748B);
        margin-top: 6px;
        font-style: italic;
    }

    .form-row {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }

    .form-actions {
        display: flex;
        gap: 12px;
        padding-top: 25px;
        border-top: 2px solid var(--border-color, #E2E8F0);
        animation: fadeInUp 0.5s ease 0.45s backwards;
    }

    .btn-action {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 12px 28px !important;
        border-radius: 12px !important;
        text-decoration: none !important;
        font-weight: 700 !important;
        font-size: 14px !important;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
        border: none !important;
        cursor: pointer !important;
        min-width: 120px !important;
        height: 44px !important;
    }

    .btn-secondary {
        background: #F1F5F9 !important;
        color: #475569 !important;
        border: 2px solid #CBD5E1 !important;
    }
    .btn-secondary:hover {
        background: #E2E8F0 !important;
        color: #1E293B !important;
        transform: translateY(-2px) !important;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1) !important;
    }
    .btn-secondary:active {
        transform: translateY(0) scale(0.98) !important;
    }

    .btn-primary {
        background: linear-gradient(135deg, #10B981 0%, #059669 100%) !important;
        color: white !important;
        box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3) !important;
        flex: 1;
    }
    .btn-primary:hover {
        transform: translateY(-2px) scale(1.02) !important;
        box-shadow: 0 8px 25px rgba(16, 185, 129, 0.4) !important;
        background: linear-gradient(135deg, #059669 0%, #047857 100%) !important;
    }
    .btn-primary:active {
        transform: translateY(0) scale(0.98) !important;
    }

    /* Dark Mode */
    [data-theme="dark"] .edit-header-title { color: #F1F5F9 !important; }
    [data-theme="dark"] .edit-header-subtitle { color: #94A3B8 !important; }
    [data-theme="dark"] .form-card { background: #1E293B !important; border-color: #334155 !important; }
    [data-theme="dark"] .form-label { color: #F1F5F9 !important; }
    [data-theme="dark"] .form-input { 
        background: #0F172A !important; border-color: #334155 !important; color: #F1F5F9 !important; 
    }
    [data-theme="dark"] .form-input:focus { 
        background: #1E293B !important; border-color: #667eea !important; 
    }
    [data-theme="dark"] .form-hint { color: #94A3B8 !important; }
    [data-theme="dark"] .form-actions { border-top-color: #334155 !important; }
    [data-theme="dark"] .btn-secondary {
        background: #334155 !important;
        color: #F1F5F9 !important;
        border-color: #475569 !important;
    }
    [data-theme="dark"] .btn-secondary:hover {
        background: #475569 !important;
        color: #FFFFFF !important;
    }
    [data-theme="dark"] .btn-primary {
        background: linear-gradient(135deg, #34D399 0%, #10B981 100%) !important;
        border: 2px solid rgba(52, 211, 153, 0.3) !important;
        box-shadow: 0 4px 15px rgba(52, 211, 153, 0.4) !important;
    }
    [data-theme="dark"] .btn-primary:hover {
        background: linear-gradient(135deg, #6EE7B7 0%, #34D399 100%) !important;
        border-color: rgba(52, 211, 153, 0.5) !important;
        box-shadow: 0 8px 25px rgba(52, 211, 153, 0.5) !important;
    }

    @media (max-width: 768px) {
        .admin-create-wrapper { padding: 20px; }
        .edit-header { flex-direction: column; align-items: flex-start; }
        .form-card { padding: 25px 20px; }
        .form-row { grid-template-columns: 1fr; gap: 15px; }
        .form-actions { flex-direction: column-reverse; }
        .btn-action { width: 100% !important; }
    }
</style>

<div class="admin-create-wrapper">

    {{-- HEADER --}}
    <div class="edit-header">
        <div>
            <h1 class="edit-header-title">➕ Tambah Admin Operator Baru</h1>
            <p class="edit-header-subtitle">Buatkan akun untuk operator atau admin sekolah</p>
        </div>
        <a href="/admin/users" class="btn-action btn-secondary" style="min-width: auto; padding: 10px 20px;">
            ← Kembali ke Daftar
        </a>
    </div>

    {{-- ERROR VALIDATION --}}
    @if($errors->any())
        <div class="alert-error">
            <div class="alert-error-title">⚠️ Ada kesalahan pada input:</div>
            <ul>
                @foreach($errors->all() as $error) 
                    <li>{{ $error }}</li> 
                @endforeach
            </ul>
        </div>
    @endif

    {{-- FORM CARD --}}
    <div class="form-card">
        <form action="/admin/users" method="POST" id="userCreateForm">
            @csrf
            
            {{-- KEAMANAN: Memastikan role selalu 'admin' saat dibuat dari halaman ini --}}
            <input type="hidden" name="role" value="admin">

            <div class="form-group">
                <label class="form-label">Nama Lengkap <span class="required">*</span></label>
                <input type="text" name="name" class="form-input" value="{{ old('name') }}" required placeholder="Contoh: Budi Santoso">
            </div>

            <div class="form-group">
                <label class="form-label">Username (untuk login) <span class="required">*</span></label>
                <input type="text" name="username" class="form-input" value="{{ old('username') }}" required placeholder="Contoh: Operator01">
                <div class="form-hint">Username unik yang akan digunakan untuk login ke dashboard.</div>
            </div>

            <div class="form-group">
                <label class="form-label">Email <span class="required">*</span></label>
                <input type="email" name="email" class="form-input" value="{{ old('email') }}" required placeholder="admin@sekolah.com">
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Password <span class="required">*</span></label>
                    <input type="password" name="password" class="form-input" required minlength="6" placeholder="Minimal 6 karakter">
                </div>
                <div class="form-group">
                    <label class="form-label">Konfirmasi Password <span class="required">*</span></label>
                    <input type="password" name="password_confirmation" class="form-input" required minlength="6" placeholder="Ulangi password">
                </div>
            </div>

            {{-- ACTION BUTTONS --}}
            <div class="form-actions">
                <a href="/admin/users" class="btn-action btn-secondary">
                    Batal
                </a>
                <button type="submit" id="btn-submit" class="btn-action btn-primary">
                    💾 Simpan Admin
                </button>
            </div>
        </form>
    </div>

</div>

{{-- SCRIPT PENCEGAHAN DOUBLE SUBMIT --}}
<script>
    document.getElementById('userCreateForm').addEventListener('submit', function() {
        const btn = document.getElementById('btn-submit');
        if(btn) {
            btn.disabled = true;
            btn.innerHTML = '⏳ Menyimpan...';
            btn.style.opacity = '0.8';
            btn.style.transform = 'scale(0.98)';
        }
    });
</script>

@endsection