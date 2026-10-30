

<?php $__env->startSection('title', 'Dashboard Super Admin'); ?>

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

    .superadmin-dashboard-wrapper { 
        max-width: 1100px; 
        margin: 0 auto; 
        padding: 30px; 
        animation: fadeInUp 0.6s ease;
    }

    /* Header */
    .page-header { margin-bottom: 50px; animation: fadeInDown 0.6s ease; }
    .page-badge {
        font-size: 14px;
        font-weight: 600;
        color: #7C3AED;
        background: #F3E8FF;
        padding: 6px 14px;
        border-radius: 20px;
        display: inline-block;
        margin-bottom: 12px;
    }
    .page-title {
        color: var(--text-primary, #0F172A);
        font-size: 40px;
        font-weight: 800;
        margin: 0 0 12px 0;
        letter-spacing: -1px;
    }
    .page-subtitle {
        color: var(--text-secondary, #64748B);
        font-size: 16px;
        max-width: 600px;
        line-height: 1.6;
        margin: 0;
    }

    /* Menu Grid */
    .menu-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
        gap: 24px;
        margin-bottom: 40px;
    }

    /* Menu Cards */
    .menu-card {
        text-decoration: none;
        color: inherit;
        display: block;
        animation: slideIn 0.6s cubic-bezier(0.4, 0, 0.2, 1) backwards;
    }
    .menu-card[data-target="users"] { animation-delay: 0.1s; --card-gradient: linear-gradient(135deg, #7C3AED 0%, #5B21B6 100%); --card-shadow: rgba(124, 58, 237, 0.25); --card-shadow-hover: rgba(124, 58, 237, 0.35); }
    .menu-card[data-target="packages"] { animation-delay: 0.2s; --card-gradient: linear-gradient(135deg, #F59E0B 0%, #D97706 100%); --card-shadow: rgba(245, 158, 11, 0.25); --card-shadow-hover: rgba(245, 158, 11, 0.35); }

    .menu-card-inner {
        background: var(--card-gradient);
        border-radius: 24px;
        padding: 36px;
        box-shadow: 0 20px 40px var(--card-shadow);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .menu-card:hover .menu-card-inner {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 30px 60px var(--card-shadow-hover);
    }

    /* Decorative Circles */
    .menu-card-inner::before {
        content: '';
        position: absolute;
        top: -50px;
        right: -50px;
        width: 200px;
        height: 200px;
        background: rgba(255,255,255,0.1);
        border-radius: 50%;
        transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .menu-card-inner::after {
        content: '';
        position: absolute;
        bottom: -30px;
        right: 80px;
        width: 100px;
        height: 100px;
        background: rgba(255,255,255,0.08);
        border-radius: 50%;
        transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .menu-card:hover .menu-card-inner::before { transform: scale(1.1) translate(10px, -10px); }
    .menu-card:hover .menu-card-inner::after { transform: scale(1.1) translate(-5px, 5px); }

    .menu-card-content {
        position: relative;
        z-index: 1;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .menu-icon {
        background: rgba(255,255,255,0.2);
        backdrop-filter: blur(10px);
        width: 64px;
        height: 64px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 24px;
        font-size: 32px;
        border: 1px solid rgba(255,255,255,0.3);
        transition: transform 0.3s;
    }
    .menu-card:hover .menu-icon { transform: scale(1.1) rotate(-5deg); }

    .menu-title {
        color: white;
        font-size: 26px;
        font-weight: 800;
        margin: 0 0 12px 0;
        letter-spacing: -0.5px;
    }
    .menu-desc {
        color: rgba(255,255,255,0.9);
        font-size: 14px;
        line-height: 1.6;
        margin: 0 0 28px 0;
        flex-grow: 1;
    }
    .menu-action {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(255,255,255,0.25);
        color: white;
        padding: 10px 20px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 14px;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.3);
        width: fit-content;
        transition: all 0.3s;
    }
    .menu-card:hover .menu-action {
        background: rgba(255,255,255,0.35);
        transform: translateX(4px);
    }

    /* Info Box */
    .info-box {
        background: var(--card-bg, white);
        padding: 28px 32px;
        border-radius: 20px;
        border: 1px solid var(--border-color, #E2E8F0);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
        display: flex;
        gap: 20px;
        align-items: flex-start;
        animation: fadeInUp 0.6s ease 0.3s backwards;
        transition: all 0.3s;
    }
    .info-box:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
    }
    .info-icon {
        background: linear-gradient(135deg, #F3E8FF 0%, #E9D5FF 100%);
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        flex-shrink: 0;
        transition: transform 0.3s;
    }
    .info-box:hover .info-icon { transform: scale(1.1) rotate(10deg); }
    .info-box h3 {
        color: var(--text-primary, #0F172A);
        font-size: 17px;
        font-weight: 700;
        margin: 0 0 8px 0;
    }
    .info-box p {
        color: var(--text-secondary, #64748B);
        font-size: 14px;
        line-height: 1.7;
        margin: 0;
    }

    /* =========================================
       DARK MODE SUPPORT
       ========================================= */
    [data-theme="dark"] .page-title { color: #F1F5F9 !important; }
    [data-theme="dark"] .info-box { background: #1E293B !important; border-color: #334155 !important; }
    [data-theme="dark"] .info-box h3 { color: #F1F5F9 !important; }
    [data-theme="dark"] .info-box p { color: #CBD5E1 !important; }
    [data-theme="dark"] .info-icon { background: linear-gradient(135deg, #2D1B69 0%, #1E1B4B 100%) !important; }

    @media (max-width: 768px) {
        .superadmin-dashboard-wrapper { padding: 20px; }
        .page-title { font-size: 28px; }
        .menu-grid { grid-template-columns: 1fr; }
        .menu-card-inner { padding: 28px; }
        .info-box { flex-direction: column; }
    }
</style>

<div class="superadmin-dashboard-wrapper">
    
    
    <div class="page-header">
        <span class="page-badge">✨ Welcome Back</span>
        <h1 class="page-title">Selamat Datang, Super Admin!</h1>
        <p class="page-subtitle">
            Kelola akun admin dan pengaturan paket fitur sekolah dari panel ini.
        </p>
    </div>

    
    <div class="menu-grid">
        
        
        <a href="/admin/users" class="menu-card" data-target="users">
            <div class="menu-card-inner">
                <div class="menu-card-content">
                    <div class="menu-icon">👥</div>
                    <h2 class="menu-title">Kelola Akun Admin</h2>
                    <p class="menu-desc">
                        Tambah, edit, atau hapus akun admin yang dapat mengelola konten website sekolah.
                    </p>
                    <div class="menu-action">
                        Buka Menu
                    </div>
                </div>
            </div>
        </a>

        
        <a href="/admin/package-settings" class="menu-card" data-target="packages">
            <div class="menu-card-inner">
                <div class="menu-card-content">
                    <div class="menu-icon">⚙️</div>
                    <h2 class="menu-title">Pengaturan Paket</h2>
                    <p class="menu-desc">
                        Atur paket fitur (Easy, Medium, Full) yang dapat diakses oleh admin sekolah.
                    </p>
                    <div class="menu-action">
                        Buka Menu
                    </div>
                </div>
            </div>
        </a>

    </div>

    
    <div class="info-box">
        <div class="info-icon">💡</div>
        <div>
            <h3>Info Super Admin</h3>
            <p>
                Sebagai Super Admin, Anda memiliki akses penuh untuk mengelola akun admin dan menentukan paket fitur yang tersedia. 
                Admin sekolah hanya dapat mengelola konten sesuai paket yang Anda tentukan.
            </p>
        </div>
    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.superadmin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\sekolah-app-v2\resources\views/admin/superadmin-dashboard.blade.php ENDPATH**/ ?>