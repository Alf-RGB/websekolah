

<?php $__env->startSection('title', 'Pengaturan Paket'); ?>

<?php $__env->startSection('content'); ?>

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
        from { opacity: 0; transform: scale(0.95) translateY(20px); }
        to { opacity: 1; transform: scale(1) translateY(0); }
    }
    @keyframes popIn {
        0% { transform: scale(0.5); opacity: 0; }
        70% { transform: scale(1.1); opacity: 1; }
        100% { transform: scale(1); opacity: 1; }
    }

    .package-settings-wrapper { 
        max-width: 1200px; 
        margin: 0 auto; 
        padding: 30px; 
        animation: fadeInUp 0.6s ease;
    }

    /* Header */
    .page-header { margin-bottom: 40px; animation: fadeInDown 0.6s ease; }
    .header-nav {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 12px;
    }
    .btn-back {
        width: 36px;
        height: 36px;
        background: var(--card-bg, white);
        border: 1px solid var(--border-color, #E2E8F0);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        text-decoration: none;
        color: var(--text-primary, #0F172A);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .btn-back:hover {
        background: var(--bg-tertiary, #F8FAFC);
        transform: translateX(-3px);
    }
    .page-badge {
        font-size: 14px;
        font-weight: 600;
        color: #7C3AED;
        background: #F3E8FF;
        padding: 6px 14px;
        border-radius: 20px;
    }
    .page-title {
        color: var(--text-primary, #0F172A);
        font-size: 36px;
        font-weight: 800;
        margin: 0 0 8px 0;
        letter-spacing: -1px;
    }
    .page-subtitle {
        color: var(--text-secondary, #64748B);
        font-size: 15px;
        margin: 0;
    }

    /* Alerts & Info */
    .alert-success {
        background: linear-gradient(135deg, #D1FAE5 0%, #A7F3D0 100%);
        border: 1px solid #10B981;
        color: #065F46;
        padding: 16px 20px;
        border-radius: 12px;
        margin-bottom: 24px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 14px;
        animation: fadeInDown 0.5s ease;
    }
    .info-box {
        background: linear-gradient(135deg, #EFF6FF 0%, #DBEAFE 100%);
        border: 1px solid #BFDBFE;
        padding: 20px 24px;
        border-radius: 16px;
        margin-bottom: 40px;
        display: flex;
        gap: 16px;
        align-items: flex-start;
        animation: fadeInUp 0.6s ease 0.1s backwards;
    }
    .info-icon {
        background: white;
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        flex-shrink: 0;
        box-shadow: 0 2px 8px rgba(59, 130, 246, 0.15);
    }
    .info-box h3 {
        color: #1E40AF;
        font-size: 15px;
        font-weight: 700;
        margin: 0 0 6px 0;
    }
    .info-box p {
        color: #1E40AF;
        font-size: 14px;
        line-height: 1.6;
        margin: 0;
        opacity: 0.9;
    }

    /* Packages Grid */
    .packages-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 24px;
        margin-bottom: 40px;
    }

    /* Package Card */
    .package-card {
        cursor: pointer;
        display: block;
        animation: slideIn 0.6s cubic-bezier(0.4, 0, 0.2, 1) backwards;
    }
    .package-card[data-package="easy"] { animation-delay: 0.15s; --package-color: #10B981; --package-color-shadow: rgba(16, 185, 129, 0.25); --package-color-ring: rgba(16, 185, 129, 0.15); }
    .package-card[data-package="medium"] { animation-delay: 0.25s; --package-color: #F59E0B; --package-color-shadow: rgba(245, 158, 11, 0.25); --package-color-ring: rgba(245, 158, 11, 0.15); }
    .package-card[data-package="full"] { animation-delay: 0.35s; --package-color: #7C3AED; --package-color-shadow: rgba(124, 58, 237, 0.25); --package-color-ring: rgba(124, 58, 237, 0.15); }

    .package-card-inner {
        background: var(--card-bg, white);
        border: 2px solid var(--border-color, #E2E8F0);
        border-radius: 24px;
        padding: 32px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        height: 100%;
        position: relative;
        overflow: hidden;
        display: flex;
        flex-direction: column;
    }

    .package-card:hover .package-card-inner {
        transform: translateY(-6px);
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.08);
        border-color: var(--package-color);
    }

    .package-card.is-selected .package-card-inner {
        border-color: var(--package-color);
        box-shadow: 0 20px 40px var(--package-color-shadow), 0 0 0 4px var(--package-color-ring);
        transform: scale(1.02);
    }

    /* Checkmark Icon */
    .checkmark-icon {
        position: absolute;
        top: 20px;
        right: 20px;
        width: 32px;
        height: 32px;
        background: linear-gradient(135deg, var(--package-color), var(--package-color));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        color: white;
        font-weight: 700;
        box-shadow: 0 4px 12px var(--package-color-shadow);
        z-index: 10;
        opacity: 0;
        transform: scale(0.5);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .package-card.is-selected .checkmark-icon {
        opacity: 1;
        transform: scale(1);
        animation: popIn 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Card Content */
    .package-header {
        display: flex;
        align-items: center;
        gap: 16px;
        margin-bottom: 24px;
    }
    .package-icon {
        width: 56px;
        height: 56px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        background: linear-gradient(135deg, var(--package-color), var(--package-color));
        filter: brightness(0.9);
        box-shadow: 0 8px 20px var(--package-color-shadow);
    }
    .package-title {
        color: var(--text-primary, #0F172A);
        font-size: 22px;
        font-weight: 800;
        margin: 0;
        letter-spacing: -0.5px;
    }
    .package-subtitle {
        color: var(--text-secondary, #64748B);
        font-size: 13px;
        margin: 2px 0 0 0;
        font-weight: 500;
    }
    .package-price {
        font-size: 32px;
        font-weight: 800;
        color: var(--text-primary, #0F172A);
        letter-spacing: -1px;
        margin-bottom: 20px;
    }
    .package-price span {
        font-size: 15px;
        font-weight: 500;
        color: var(--text-secondary, #64748B);
    }
    .package-desc {
        color: var(--text-secondary, #64748B);
        font-size: 14px;
        line-height: 1.6;
        margin-bottom: 24px;
        flex-grow: 1;
    }

    /* Features Box */
    .features-box {
        background: var(--bg-tertiary, #F8FAFC);
        padding: 20px;
        border-radius: 14px;
        border: 1px solid var(--border-color, #F1F5F9);
    }
    .features-title {
        font-size: 11px;
        font-weight: 700;
        color: var(--text-secondary, #64748B);
        margin: 0 0 14px 0;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .feature-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .feature-list li {
        font-size: 13px;
        color: var(--text-primary, #0F172A);
        padding: 8px 0;
        display: flex;
        align-items: center;
        gap: 10px;
        border-bottom: 1px solid var(--border-color, #F1F5F9);
    }
    .feature-list li:last-child { border-bottom: none; }
    .feature-list li span {
        color: var(--package-color);
        font-weight: 700;
        font-size: 16px;
    }

    /* Submit & Footer */
    .submit-container {
        text-align: center;
        margin-top: 40px;
        animation: fadeInUp 0.5s ease 0.4s backwards;
    }
    .btn-submit {
        background: linear-gradient(135deg, #7C3AED 0%, #5B21B6 100%);
        color: white;
        padding: 16px 48px;
        border: none;
        border-radius: 14px;
        font-size: 15px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 8px 24px rgba(124, 58, 237, 0.3);
        font-family: 'Inter', sans-serif;
        letter-spacing: 0.3px;
    }
    .btn-submit:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 32px rgba(124, 58, 237, 0.4);
    }
    .btn-submit:active {
        transform: translateY(0) scale(0.98);
    }

    .current-package-box {
        margin-top: 40px;
        background: var(--card-bg, white);
        padding: 24px 32px;
        border-radius: 16px;
        border: 1px solid var(--border-color, #E2E8F0);
        text-align: center;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
        animation: fadeInUp 0.5s ease 0.5s backwards;
    }
    .current-package-label {
        color: var(--text-secondary, #64748B);
        font-size: 13px;
        margin-bottom: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .current-package-badge {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: linear-gradient(135deg, #7C3AED, #5B21B6);
        color: white;
        padding: 12px 28px;
        border-radius: 30px;
        font-size: 18px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1px;
        box-shadow: 0 8px 24px rgba(124, 58, 237, 0.3);
    }

    /* =========================================
       DARK MODE SUPPORT
       ========================================= */
    [data-theme="dark"] .btn-back { background: #1E293B !important; border-color: #334155 !important; color: #F1F5F9 !important; }
    [data-theme="dark"] .btn-back:hover { background: #334155 !important; }
    [data-theme="dark"] .page-title { color: #F1F5F9 !important; }
    [data-theme="dark"] .info-box { background: linear-gradient(135deg, #1E3A8A 0%, #1E40AF 100%) !important; border-color: #3B82F6 !important; }
    [data-theme="dark"] .info-box h3, [data-theme="dark"] .info-box p { color: #93C5FD !important; }
    [data-theme="dark"] .info-icon { background: #1E40AF !important; }
    [data-theme="dark"] .package-card-inner { background: #1E293B !important; border-color: #334155 !important; }
    [data-theme="dark"] .package-card:hover .package-card-inner { border-color: var(--package-color) !important; }
    [data-theme="dark"] .package-title, [data-theme="dark"] .package-price { color: #F1F5F9 !important; }
    [data-theme="dark"] .package-subtitle, [data-theme="dark"] .package-desc, [data-theme="dark"] .features-title { color: #94A3B8 !important; }
    [data-theme="dark"] .features-box { background: #0F172A !important; border-color: #334155 !important; }
    [data-theme="dark"] .feature-list li { color: #F1F5F9 !important; border-color: #334155 !important; }
    [data-theme="dark"] .current-package-box { background: #1E293B !important; border-color: #334155 !important; }
    [data-theme="dark"] .current-package-label { color: #94A3B8 !important; }
    [data-theme="dark"] .alert-success { background: linear-gradient(135deg, #064E3B 0%, #065F46 100%) !important; border-color: #10B981 !important; color: #6EE7B7 !important; }

    @media (max-width: 768px) {
        .package-settings-wrapper { padding: 20px; }
        .page-header { flex-direction: column; align-items: flex-start; }
        .packages-grid { grid-template-columns: 1fr; }
        .package-card-inner { padding: 24px; }
    }
</style>

<div class="package-settings-wrapper">
    
    
    <div class="page-header">
        <div class="header-nav">
            <a href="/admin/dashboard" class="btn-back">←</a>
            <span class="page-badge">⚙️ Package Settings</span>
        </div>
        <h1 class="page-title">Pengaturan Paket Fitur</h1>
        <p class="page-subtitle">Pilih dan atur paket fitur yang akan diaktifkan untuk sekolah ini.</p >
    </div>

    
    <?php if(session('success')): ?>
    <div class="alert-success">
        <span style="font-size: 20px;">✅</span>
        <?php echo e(session('success')); ?>

    </div>
    <?php endif; ?>

    
    <div class="info-box">
        <div class="info-icon">💡</div>
        <div>
            <h3>Info Penting</h3>
            <p>
                Perubahan paket akan langsung mempengaruhi menu dan fitur yang tersedia di dashboard Admin. 
                Admin sekolah hanya dapat mengelola konten sesuai dengan paket yang Anda pilih.
            </p>
        </div>
    </div>

    
    <form method="POST" action="/admin/package-settings" id="packageForm">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        
        <div class="packages-grid">
            
            
            <?php $isActive = ($currentPackage ?? 'full') === 'easy'; ?>
            <label class="package-card <?php echo e($isActive ? 'is-selected' : ''); ?>" data-package="easy">
                <input type="radio" name="package_level" value="easy" <?php echo e($isActive ? 'checked' : ''); ?> style="display: none;" class="package-radio">
                
                <div class="package-card-inner">
                    <div class="checkmark-icon">✓</div>

                    <div class="package-header">
                        <div class="package-icon">🌱</div>
                        <div>
                            <h3 class="package-title">Easy</h3>
                            <p class="package-subtitle">Paket Dasar</p>
                        </div>
                    </div>

                    <div class="package-price">
                        Rp 500.000<span>/bulan</span>
                    </div>

                    <p class="package-desc">
                        Paket dasar untuk sekolah yang baru memulai digitalisasi website.
                    </p>

                    <div class="features-box">
                        <p class="features-title">Fitur yang didapat:</p>
                        <ul class="feature-list">
                            <li><span>✓</span> Profil Sekolah</li>
                            <li><span>✓</span> Berita & Artikel</li>
                            <li><span>✓</span> Galeri Foto</li>
                            <li><span>✓</span> Halaman Kontak</li>
                        </ul>
                    </div>
                </div>
            </label>

            
            <?php $isActive = ($currentPackage ?? 'full') === 'medium'; ?>
            <label class="package-card <?php echo e($isActive ? 'is-selected' : ''); ?>" data-package="medium">
                <input type="radio" name="package_level" value="medium" <?php echo e($isActive ? 'checked' : ''); ?> style="display: none;" class="package-radio">
                
                <div class="package-card-inner">
                    <div class="checkmark-icon">✓</div>

                    <div class="package-header">
                        <div class="package-icon">🚀</div>
                        <div>
                            <h3 class="package-title">Medium</h3>
                            <p class="package-subtitle">Paket Menengah</p>
                        </div>
                    </div>

                    <div class="package-price">
                        Rp 1.500.000<span>/bulan</span>
                    </div>

                    <p class="package-desc">
                        Paket menengah untuk sekolah yang ingin fitur akademik lebih lengkap.
                    </p>

                    <div class="features-box">
                        <p class="features-title">Fitur yang didapat:</p>
                        <ul class="feature-list">
                            <li><span>✓</span> Semua fitur Easy</li>
                            <li><span>✓</span> Portal Guru</li>
                            <li><span>✓</span> Kompetensi Keahlian</li>
                            <li><span>✓</span> PPDB Online</li>
                            <li><span>✓</span> Lamaran Guru</li>
                        </ul>
                    </div>
                </div>
            </label>

            
            <?php $isActive = ($currentPackage ?? 'full') === 'full'; ?>
            <label class="package-card <?php echo e($isActive ? 'is-selected' : ''); ?>" data-package="full">
                <input type="radio" name="package_level" value="full" <?php echo e($isActive ? 'checked' : ''); ?> style="display: none;" class="package-radio">
                
                <div class="package-card-inner">
                    <div class="checkmark-icon">✓</div>

                    <div class="package-header">
                        <div class="package-icon">👑</div>
                        <div>
                            <h3 class="package-title">Full Service</h3>
                            <p class="package-subtitle">Paket Lengkap</p>
                        </div>
                    </div>

                    <div class="package-price">
                        Rp 3.000.000<span>/bulan</span>
                    </div>

                    <p class="package-desc">
                        Paket premium untuk sekolah yang menginginkan semua fitur terbaik.
                    </p>

                    <div class="features-box">
                        <p class="features-title">Fitur yang didapat:</p>
                        <ul class="feature-list">
                            <li><span>✓</span> Semua fitur Medium</li>
                            <li><span>✓</span> Alumni dengan Statistik</li>
                            <li><span>✓</span> Dashboard Analytics</li>
                            <li><span>✓</span> Priority Support</li>
                        </ul>
                    </div>
                </div>
            </label>

        </div>

        
        <div class="submit-container">
            <button type="submit" class="btn-submit" id="btnSubmit">
                💾 Simpan Perubahan Paket
            </button>
        </div>
    </form>

    
    <div class="current-package-box">
        <p class="current-package-label">Paket Aktif Saat Ini</p>
        <div class="current-package-badge">
            👑 <?php echo e(strtoupper($currentPackage ?? 'full')); ?>

        </div>
    </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function() {
    const packageCards = document.querySelectorAll('.package-card');
    
    // Fungsi untuk update visual berdasarkan state 'checked'
    function updateSelection() {
        packageCards.forEach(card => {
            const radio = card.querySelector('.package-radio');
            if (radio.checked) {
                card.classList.add('is-selected');
            } else {
                card.classList.remove('is-selected');
            }
        });
    }

    // Event listener untuk setiap card
    packageCards.forEach(card => {
        card.addEventListener('click', function(e) {
            // Pastikan radio button ter-check saat card diklik
            const radio = this.querySelector('.package-radio');
            radio.checked = true;
            updateSelection();
        });
    });

    // Inisialisasi awal
    updateSelection();

    // Prevent double submit animation
    const form = document.getElementById('packageForm');
    const btnSubmit = document.getElementById('btnSubmit');
    
    form.addEventListener('submit', function() {
        btnSubmit.disabled = true;
        btnSubmit.innerHTML = '⏳ Menyimpan...';
        btnSubmit.style.opacity = '0.8';
        btnSubmit.style.transform = 'scale(0.98)';
    });
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.superadmin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\sekolah-app-v2\resources\views/admin/package-settings.blade.php ENDPATH**/ ?>