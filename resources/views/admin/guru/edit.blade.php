@extends('layouts.admin')

@section('title', 'Kelola Akun Guru - ' . ($guru->nama ?? 'Admin'))

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

    .guru-edit-wrapper { 
        max-width: 700px; 
        margin: 0 auto; 
        padding: 30px; 
        animation: fadeInUp 0.6s ease;
    }

    .info-box {
        background: rgba(59, 130, 246, 0.1);
        border: 1px solid rgba(59, 130, 246, 0.3);
        border-radius: 12px;
        padding: 15px 20px;
        display: flex;
        align-items: flex-start;
        gap: 12px;
        margin-bottom: 30px;
        animation: fadeInDown 0.6s ease;
    }
    .info-box svg { width: 20px; height: 20px; color: #3B82F6; flex-shrink: 0; margin-top: 2px; }
    .info-box p { font-size: 14px; color: var(--text-primary, #1E293B); margin: 0; line-height: 1.6; }

    .form-card {
        background: var(--card-bg, white);
        border-radius: 20px;
        padding: 35px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        border: 1px solid var(--border-color, #E2E8F0);
        margin-bottom: 30px;
        animation: slideIn 0.6s cubic-bezier(0.4, 0, 0.2, 1) 0.1s backwards;
    }
    .form-card-title {
        font-size: 20px;
        font-weight: 700;
        color: var(--text-primary, #1E293B);
        margin: 0 0 25px 0;
        padding-bottom: 15px;
        border-bottom: 2px solid var(--border-color, #E2E8F0);
        animation: fadeInDown 0.5s ease 0.15s backwards;
    }

    .guru-info-box {
        background: var(--bg-tertiary, #F8FAFC);
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 25px;
        border-left: 4px solid #667eea;
        display: flex;
        align-items: center;
        gap: 15px;
        animation: fadeInUp 0.5s ease 0.2s backwards;
    }
    .guru-avatar {
        width: 60px; height: 60px; border-radius: 50%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex; align-items: center; justify-content: center;
        color: white; font-weight: 700; font-size: 22px; flex-shrink: 0;
    }
    .guru-info-text h3 { font-size: 18px; font-weight: 700; color: var(--text-primary, #1E293B); margin: 0 0 5px 0; }
    .guru-info-text p { font-size: 13px; color: var(--text-secondary, #64748B); margin: 0; }

    /* Form Groups dengan Stagger Animation */
    .form-group { 
        margin-bottom: 20px; 
        animation: fadeInUp 0.5s ease backwards;
    }
    .form-group:nth-child(1) { animation-delay: 0.25s; }
    .form-group:nth-child(2) { animation-delay: 0.3s; }
    .form-group:nth-child(3) { animation-delay: 0.35s; }
    .form-group:nth-child(4) { animation-delay: 0.4s; }

    .form-label { display: block; font-size: 13px; font-weight: 600; color: var(--text-primary, #1E293B); margin-bottom: 8px; }
    .form-label .required { color: #EF4444; margin-left: 2px; }
    
    .form-input, .password-input {
        width: 100%; padding: 12px 16px; border: 2px solid var(--border-color, #E2E8F0);
        border-radius: 12px; font-size: 14px; background: var(--input-bg, #F8FAFC);
        color: var(--text-primary, #1E293B); transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); box-sizing: border-box;
    }
    .form-input:focus, .password-input:focus { 
        outline: none; border-color: #667eea; background: white; 
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        transform: translateY(-2px); /* Efek angkat halus saat focus */
    }
    .form-input:disabled { background: var(--bg-tertiary, #F1F5F9); color: var(--text-secondary, #64748B); cursor: not-allowed; transform: none !important; }
    .form-hint { font-size: 12px; color: var(--text-secondary, #64748B); margin-top: 6px; }

    .password-wrapper { position: relative; }
    .password-input { padding: 12px 45px 12px 16px; }
    .password-toggle {
        position: absolute; right: 12px; top: 50%; transform: translateY(-50%);
        background: transparent !important; border: none !important; cursor: pointer;
        padding: 4px !important; color: var(--text-secondary, #94A3B8);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); display: flex; align-items: center; justify-content: center; opacity: 0.6;
    }
    .password-toggle:hover { color: var(--text-primary, #1E293B); opacity: 1; transform: translateY(-50%) scale(1.1); }
    .password-toggle svg { width: 20px; height: 20px; }

    .password-strength { margin-top: 12px; margin-bottom: 15px; animation: fadeInUp 0.4s ease; }
    .strength-bar { height: 6px; background: var(--bg-tertiary, #E2E8F0); border-radius: 3px; overflow: hidden; margin-bottom: 8px; }
    .strength-progress { height: 100%; width: 0; transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); border-radius: 3px; }
    .strength-weak { width: 33%; background: linear-gradient(135deg, #EF4444 0%, #DC2626 100%); }
    .strength-medium { width: 66%; background: linear-gradient(135deg, #F59E0B 0%, #D97706 100%); }
    .strength-strong { width: 100%; background: linear-gradient(135deg, #10B981 0%, #059669 100%); }
    
    .strength-text { font-size: 12px; font-weight: 600; color: var(--text-secondary, #64748B); transition: color 0.3s; }
    .strength-weak-text { color: #EF4444; }
    .strength-medium-text { color: #F59E0B; }
    .strength-strong-text { color: #10B981; }

    .password-requirements { background: var(--bg-tertiary, #F8FAFC); border: 1px solid var(--border-color, #E2E8F0); border-radius: 12px; padding: 15px; margin-bottom: 20px; animation: fadeInUp 0.4s ease; }
    .requirements-title { font-size: 12px; font-weight: 600; color: var(--text-primary, #1E293B); margin: 0 0 10px 0; text-transform: uppercase; letter-spacing: 0.5px; }
    .requirement-item { display: flex; align-items: center; gap: 8px; font-size: 13px; color: var(--text-secondary, #64748B); margin-bottom: 6px; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
    .requirement-item:last-child { margin-bottom: 0; }
    .requirement-item.met { color: #059669; transform: translateX(4px); }
    .requirement-item svg { width: 16px; height: 16px; flex-shrink: 0; transition: all 0.3s; }
    .requirement-item:not(.met) svg { color: #94A3B8; }
    .requirement-item.met svg { color: #10B981; }

    .password-match-indicator { margin-top: 8px; font-size: 13px; font-weight: 600; display: flex; align-items: center; gap: 6px; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
    .password-match-indicator svg { width: 16px; height: 16px; }
    .password-match-indicator.match { color: #10B981; }
    .password-match-indicator.mismatch { color: #EF4444; }
    .password-match-indicator.empty { color: var(--text-secondary, #64748B); }

    .form-actions {
        display: flex !important; gap: 12px !important; justify-content: flex-end !important;
        align-items: center !important; margin-top: 30px !important; padding-top: 25px !important;
        border-top: 2px solid var(--border-color, #E2E8F0) !important;
        animation: fadeInUp 0.5s ease 0.5s backwards !important;
    }
    .btn-form {
        padding: 12px 32px !important; border-radius: 12px !important; border: none !important;
        outline: none !important; font-weight: 700 !important; font-size: 14px !important;
        cursor: pointer !important; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
        text-decoration: none !important; display: inline-flex !important; align-items: center !important;
        justify-content: center !important; font-family: inherit !important; line-height: 1.5 !important;
        box-sizing: border-box !important; white-space: nowrap !important; min-width: 140px !important;
    }
    .btn-batal { background: #F1F5F9 !important; color: #475569 !important; border: 2px solid #CBD5E1 !important; }
    .btn-batal:hover { background: #E2E8F0 !important; color: #1E293B !important; border-color: #94A3B8 !important; transform: translateY(-2px) !important; }
    .btn-batal:active { transform: translateY(0) scale(0.98) !important; }
    
    .btn-simpan { background: linear-gradient(135deg, #3B82F6 0%, #2563EB 100%) !important; color: white !important; border: none !important; box-shadow: 0 4px 15px rgba(59, 130, 246, 0.4) !important; }
    .btn-simpan:hover { background: linear-gradient(135deg, #2563EB 0%, #1D4ED8 100%) !important; transform: translateY(-2px) !important; box-shadow: 0 6px 20px rgba(59, 130, 246, 0.5) !important; }
    .btn-simpan:active { transform: translateY(0) scale(0.98) !important; }

    .alert-error { background: linear-gradient(135deg, #FEE2E2 0%, #FECACA 100%); border: 2px solid #EF4444; border-radius: 12px; padding: 15px 20px; margin-bottom: 20px; animation: fadeInDown 0.5s ease; box-shadow: 0 4px 15px rgba(239, 68, 68, 0.15); }
    .alert-error-title { font-weight: 700; color: #DC2626; margin-bottom: 8px; font-size: 14px; }
    .alert-error ul { margin: 0; padding-left: 20px; color: #DC2626; font-size: 13px; }
    .alert-error li { margin-bottom: 4px; }

    /* Dark Mode */
    [data-theme="dark"] .form-card { background: #1E293B !important; border-color: #334155 !important; }
    [data-theme="dark"] .form-card-title { color: #F1F5F9 !important; border-color: #334155 !important; }
    [data-theme="dark"] .form-label { color: #F1F5F9 !important; }
    [data-theme="dark"] .form-input, [data-theme="dark"] .password-input { background: #0F172A !important; border-color: #334155 !important; color: #F1F5F9 !important; }
    [data-theme="dark"] .form-input:focus, [data-theme="dark"] .password-input:focus { background: #1E293B !important; border-color: #667eea !important; }
    [data-theme="dark"] .form-input:disabled { background: #1E293B !important; color: #94A3B8 !important; }
    [data-theme="dark"] .form-hint { color: #94A3B8 !important; }
    [data-theme="dark"] .password-requirements { background: #0F172A !important; border-color: #334155 !important; }
    [data-theme="dark"] .requirements-title { color: #F1F5F9 !important; }
    [data-theme="dark"] .requirement-item { color: #94A3B8 !important; }
    [data-theme="dark"] .requirement-item.met { color: #34D399 !important; }
    [data-theme="dark"] .strength-bar { background: #334155 !important; }
    [data-theme="dark"] .info-box { background: rgba(59, 130, 246, 0.15) !important; border-color: rgba(59, 130, 246, 0.4) !important; }
    [data-theme="dark"] .info-box p { color: #BFDBFE !important; }
    [data-theme="dark"] .guru-info-box { background: #0F172A !important; }
    [data-theme="dark"] .guru-info-text h3 { color: #F1F5F9 !important; }
    [data-theme="dark"] .guru-info-text p { color: #94A3B8 !important; }
    [data-theme="dark"] .btn-batal { background: #334155 !important; color: #F1F5F9 !important; border-color: #475569 !important; }
    [data-theme="dark"] .btn-batal:hover { background: #475569 !important; }
    [data-theme="dark"] .btn-simpan { background: linear-gradient(135deg, #3B82F6 0%, #2563EB 100%) !important; }
    [data-theme="dark"] .password-match-indicator.match { color: #34D399 !important; }
    [data-theme="dark"] .password-match-indicator.mismatch { color: #F87171 !important; }
    [data-theme="dark"] .password-match-indicator.empty { color: #94A3B8 !important; }
    [data-theme="dark"] .alert-error { background: linear-gradient(135deg, #7F1D1D 0%, #991B1B 100%) !important; border-color: #DC2626 !important; }
    [data-theme="dark"] .alert-error-title { color: #FECACA !important; }
    [data-theme="dark"] .alert-error ul { color: #FECACA !important; }

    @media (max-width: 768px) {
        .guru-edit-wrapper { padding: 20px; }
        .form-card { padding: 25px 20px; }
        .form-actions { flex-direction: column-reverse; }
        .btn-form { width: 100% !important; }
    }
</style>

<div class="guru-edit-wrapper">

    <div class="info-box">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <p><strong>Info:</strong> Halaman ini untuk mengelola akun login dan status tampilan guru. Data profil lengkap (foto, NIP, bio) hanya dapat diedit oleh guru tersebut setelah login di portal akademik.</p>
    </div>

    <form action="{{ route('admin.guru.update', $guru->id) }}" method="POST" id="guruEditForm">
        @csrf
        @method('PUT')

        <div class="form-card">
            <h2 class="form-card-title">Kelola Akun & Status</h2>
            
            @if($errors->any())
            <div class="alert-error">
                <div class="alert-error-title">⚠ Terjadi Kesalahan</div>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="guru-info-box">
                <div class="guru-avatar">{{ strtoupper(substr($guru->nama ?? 'G', 0, 1)) }}</div>
                <div class="guru-info-text">
                    <h3>{{ $guru->nama }}</h3>
                    <p>Username: <strong>{{ $guru->username ?? '-' }}</strong></p>
                    <p>Status Saat Ini: 
                        @if($guru->is_active)
                            <span style="color: #10B981; font-weight: 700;">✓ Aktif</span>
                        @else
                            <span style="color: #EF4444; font-weight: 700;">✗ Nonaktif</span>
                        @endif
                    </p>
                </div>
            </div>

            {{-- Username (Read Only) --}}
            <div class="form-group">
                <label class="form-label">Username</label>
                <input type="text" class="form-input" value="{{ $guru->username ?? '-' }}" disabled>
                <div class="form-hint">Username tidak dapat diubah oleh admin</div>
            </div>

            {{-- STATUS AKTIF/NONAKTIF --}}
            <div class="form-group">
                <label class="form-label">Status Tampilan di Website</label>
                <div style="display: flex; gap: 20px; align-items: center; flex-wrap: wrap;">
                    <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                        <input type="radio" name="is_active" value="1" {{ $guru->is_active == 1 ? 'checked' : '' }} 
                            style="width: 18px; height: 18px; cursor: pointer; accent-color: #10B981;">
                        <span style="font-weight: 600; color: #10B981;">✓ Aktif (Tampil di website)</span>
                    </label>
                    <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                        <input type="radio" name="is_active" value="0" {{ $guru->is_active == 0 ? 'checked' : '' }} 
                            style="width: 18px; height: 18px; cursor: pointer; accent-color: #EF4444;">
                        <span style="font-weight: 600; color: #EF4444;">✗ Nonaktif (Sembunyi dari website)</span>
                    </label>
                </div>
                <div class="form-hint">Guru yang nonaktif tidak akan tampil di halaman Portal Akademik publik</div>
            </div>

            {{-- Password Baru (Optional) --}}
            <div class="form-group">
                <label class="form-label">Password Baru</label>
                <div class="password-wrapper">
                    <input type="password" id="passwordInput" name="password" class="password-input" 
                           placeholder="Kosongkan jika tidak ingin mengubah password" autocomplete="new-password">
                    <button type="button" class="password-toggle" onclick="togglePassword()">
                        <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        <svg id="eyeOffIcon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display: none;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                        </svg>
                    </button>
                </div>
                <div class="form-hint">Minimal 6 karakter. Kosongkan jika tidak ingin mengubah password.</div>

                <div class="password-strength" id="passwordStrength" style="display: none;">
                    <div class="strength-bar"><div class="strength-progress" id="strengthProgress"></div></div>
                    <div class="strength-text" id="strengthText"></div>
                </div>

                <div class="password-requirements" id="passwordRequirements" style="display: none;">
                    <div class="requirements-title">Kriteria Password:</div>
                    <div class="requirement-item" id="reqLength">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        <span>Minimal 6 karakter</span>
                    </div>
                    <div class="requirement-item" id="reqUpper">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        <span>Huruf kapital (A-Z)</span>
                    </div>
                    <div class="requirement-item" id="reqLower">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        <span>Huruf kecil (a-z)</span>
                    </div>
                    <div class="requirement-item" id="reqNumber">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        <span>Angka (0-9)</span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Konfirmasi Password Baru</label>
                <div class="password-wrapper">
                    <input type="password" id="passwordConfirmation" name="password_confirmation" class="password-input" 
                           placeholder="Ulangi password baru" autocomplete="new-password">
                    <button type="button" class="password-toggle" onclick="togglePasswordConfirmation()">
                        <svg id="eyeIconConfirm" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        <svg id="eyeOffIconConfirm" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display: none;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                        </svg>
                    </button>
                </div>
                <div class="form-hint">Ulangi password baru untuk konfirmasi</div>
                
                <div class="password-match-indicator empty" id="passwordMatchIndicator">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span id="passwordMatchText">Menunggu input...</span>
                </div>
            </div>

            <div class="form-actions">
                <a href="{{ route('admin.guru.index') }}" class="btn-form btn-batal">Batal</a>
                <button type="submit" class="btn-form btn-simpan">Simpan Perubahan</button>
            </div>
        </div>
    </form>

</div>

<script>
// Toggle Show/Hide Password
function togglePassword() {
    const passwordInput = document.getElementById('passwordInput');
    const eyeIcon = document.getElementById('eyeIcon');
    const eyeOffIcon = document.getElementById('eyeOffIcon');
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeIcon.style.display = 'none';
        eyeOffIcon.style.display = 'block';
    } else {
        passwordInput.type = 'password';
        eyeIcon.style.display = 'block';
        eyeOffIcon.style.display = 'none';
    }
}

function togglePasswordConfirmation() {
    const passwordConfirm = document.getElementById('passwordConfirmation');
    const eyeIconConfirm = document.getElementById('eyeIconConfirm');
    const eyeOffIconConfirm = document.getElementById('eyeOffIconConfirm');
    if (passwordConfirm.type === 'password') {
        passwordConfirm.type = 'text';
        eyeIconConfirm.style.display = 'none';
        eyeOffIconConfirm.style.display = 'block';
    } else {
        passwordConfirm.type = 'password';
        eyeIconConfirm.style.display = 'block';
        eyeOffIconConfirm.style.display = 'none';
    }
}

// Password Strength Checker
const passwordInput = document.getElementById('passwordInput');
const passwordStrength = document.getElementById('passwordStrength');
const passwordRequirements = document.getElementById('passwordRequirements');
const strengthProgress = document.getElementById('strengthProgress');
const strengthText = document.getElementById('strengthText');

passwordInput.addEventListener('input', function() {
    const password = this.value;
    if (password.length > 0) {
        passwordStrength.style.display = 'block';
        passwordRequirements.style.display = 'block';
    } else {
        passwordStrength.style.display = 'none';
        passwordRequirements.style.display = 'none';
    }
    
    const hasLength = password.length >= 6;
    const hasUpper = /[A-Z]/.test(password);
    const hasLower = /[a-z]/.test(password);
    const hasNumber = /[0-9]/.test(password);
    
    updateRequirement('reqLength', hasLength);
    updateRequirement('reqUpper', hasUpper);
    updateRequirement('reqLower', hasLower);
    updateRequirement('reqNumber', hasNumber);
    
    let strength = 0;
    if (hasLength) strength++;
    if (hasUpper) strength++;
    if (hasLower) strength++;
    if (hasNumber) strength++;
    
    strengthProgress.className = 'strength-progress';
    strengthText.className = 'strength-text';
    
    if (strength <= 1) {
        strengthProgress.classList.add('strength-weak');
        strengthText.classList.add('strength-weak-text');
        strengthText.textContent = 'Lemah';
    } else if (strength === 2 || strength === 3) {
        strengthProgress.classList.add('strength-medium');
        strengthText.classList.add('strength-medium-text');
        strengthText.textContent = 'Sedang';
    } else {
        strengthProgress.classList.add('strength-strong');
        strengthText.classList.add('strength-strong-text');
        strengthText.textContent = 'Kuat';
    }
    
    checkPasswordMatch();
});

function updateRequirement(id, met) {
    const element = document.getElementById(id);
    if (met) {
        element.classList.add('met');
        element.querySelector('svg').innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />';
    } else {
        element.classList.remove('met');
        element.querySelector('svg').innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />';
    }
}

// Password Match Checker
const passwordConfirmation = document.getElementById('passwordConfirmation');
const passwordMatchIndicator = document.getElementById('passwordMatchIndicator');
const passwordMatchText = document.getElementById('passwordMatchText');

passwordConfirmation.addEventListener('input', function() {
    checkPasswordMatch();
});

function checkPasswordMatch() {
    const password = passwordInput.value;
    const confirmation = passwordConfirmation.value;
    
    if (confirmation.length === 0) {
        passwordMatchIndicator.className = 'password-match-indicator empty';
        passwordMatchIndicator.querySelector('svg').innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />';
        passwordMatchText.textContent = 'Menunggu input...';
    } else if (password === confirmation) {
        passwordMatchIndicator.className = 'password-match-indicator match';
        passwordMatchIndicator.querySelector('svg').innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />';
        passwordMatchText.textContent = 'Password cocok!';
    } else {
        passwordMatchIndicator.className = 'password-match-indicator mismatch';
        passwordMatchIndicator.querySelector('svg').innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />';
        passwordMatchText.textContent = 'Password tidak cocok!';
    }
}

// Prevent double submit dengan animasi tombol
document.getElementById('guruEditForm').addEventListener('submit', function() {
    const btn = document.querySelector('.btn-simpan');
    if(btn) {
        btn.disabled = true;
        btn.innerHTML = '⏳ Menyimpan...';
        btn.style.opacity = '0.8';
        btn.style.transform = 'scale(0.98)';
    }
});
</script>

@endsection