

<?php $__env->startSection('title', 'Kelola Halaman Profil - Admin'); ?>

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
        from { opacity: 0; transform: scale(0.95); }
        to { opacity: 1; transform: scale(1); }
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }

    .pages-wrapper { 
        max-width: 1400px; 
        margin: 0 auto; 
        padding: 30px; 
        animation: fadeInUp 0.6s ease;
    }

    .profile-header-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 20px;
        padding: 35px 40px;
        margin-bottom: 30px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(102, 126, 234, 0.3);
        animation: fadeInDown 0.8s ease;
    }
    .profile-header-card::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 400px;
        height: 400px;
        background: rgba(255,255,255,0.1);
        border-radius: 50%;
    }
    .profile-header-content { position: relative; z-index: 1; }
    .profile-header-title {
        font-size: 32px;
        font-weight: 800;
        color: white;
        margin: 0 0 10px 0;
        letter-spacing: -0.5px;
    }
    .profile-header-subtitle {
        font-size: 16px;
        color: rgba(255,255,255,0.9);
        margin: 0 0 20px 0;
    }
    .profile-header-note {
        background: rgba(255,255,255,0.15);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.2);
        border-radius: 12px;
        padding: 15px 20px;
        display: flex;
        align-items: flex-start;
        gap: 12px;
        margin-top: 20px;
        animation: fadeInUp 0.6s ease 0.2s both;
    }
    .profile-header-note svg { width: 24px; height: 24px; flex-shrink: 0; color: #FDE047; }
    .profile-header-note p { font-size: 14px; color: white; margin: 0; line-height: 1.6; }

    .pages-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
        gap: 25px;
        margin-bottom: 30px;
    }

    .page-card {
        background: var(--card-bg, white);
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        border: 1px solid var(--border-color, #E2E8F0);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        display: flex;
        flex-direction: column;
        animation: fadeInUp 0.6s ease backwards;
    }
    .page-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 35px rgba(0,0,0,0.12);
    }

    .page-card-header {
        padding: 16px 20px;
        color: white;
        position: relative;
    }
    
    .page-card-title {
        font-size: 18px;
        font-weight: 700;
        margin: 0;
        letter-spacing: -0.3px;
    }

    .page-card-body {
        padding: 16px 20px 20px 20px;
        display: flex;
        flex-direction: column;
        flex: 1;
        justify-content: space-between;
    }

    .page-meta {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 12px;
    }

    .meta-item {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }
    .meta-label {
        font-size: 11px;
        color: var(--text-secondary, #64748B);
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .meta-value {
        font-size: 13px;
        color: var(--text-primary, #1E293B);
        font-weight: 600;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 5px 12px;
        border-radius: 50px;
        font-size: 12px;
        font-weight: 700;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .status-badge:hover {
        transform: scale(1.05);
    }
    .status-published {
        background: linear-gradient(135deg, #D1FAE5 0%, #A7F3D0 100%);
        color: #065F46;
        border: 1px solid #10B981;
    }
    .status-draft {
        background: linear-gradient(135deg, #FEE2E2 0%, #FECACA 100%);
        color: #991B1B;
        border: 1px solid #EF4444;
    }

    .page-actions {
        display: flex;
        gap: 10px;
        align-items: stretch;
        margin-top: auto;
    }

    .btn-page {
        flex: 1;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 10px 20px;
        border-radius: 10px;
        font-weight: 700;
        font-size: 13px;
        text-decoration: none;
        border: none;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        white-space: nowrap;
    }

    .btn-edit {
        background: linear-gradient(135deg, #3B82F6 0%, #2563EB 100%);
        color: white;
        box-shadow: 0 3px 10px rgba(59, 130, 246, 0.3);
    }
    .btn-edit:hover {
        background: linear-gradient(135deg, #2563EB 0%, #1D4ED8 100%);
        transform: translateY(-3px);
        box-shadow: 0 6px 18px rgba(59, 130, 246, 0.4);
    }
    .btn-edit:active {
        transform: translateY(0) scale(0.98);
    }

    .empty-state {
        text-align: center;
        padding: 80px 40px;
        background: var(--card-bg, white);
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        border: 1px solid var(--border-color, #E2E8F0);
        animation: fadeInUp 0.6s ease;
    }
    .empty-icon {
        font-size: 72px;
        margin-bottom: 20px;
        opacity: 0.5;
        animation: pulse 2s ease infinite;
    }
    .empty-title {
        font-size: 22px;
        font-weight: 700;
        color: var(--text-primary, #1E293B);
        margin: 0 0 10px 0;
    }
    .empty-text {
        font-size: 15px;
        color: var(--text-secondary, #64748B);
        margin: 0 0 25px 0;
    }
    .btn-primary {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 13px 28px;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 700;
        font-size: 14px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
    }
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
    }
    .btn-primary:active {
        transform: translateY(0) scale(0.98);
    }

    /* Dark Mode */
    [data-theme="dark"] .profile-header-card {
        background: linear-gradient(135deg, #4C1D95 0%, #5B21B6 100%) !important;
    }
    [data-theme="dark"] .page-card {
        background: #1E293B !important;
        border-color: #334155 !important;
    }
    [data-theme="dark"] .meta-label { color: #94A3B8 !important; }
    [data-theme="dark"] .meta-value { color: #F1F5F9 !important; }
    [data-theme="dark"] .status-published {
        background: linear-gradient(135deg, #064E3B 0%, #065F46 100%) !important;
        color: #D1FAE5 !important;
        border-color: #10B981 !important;
    }
    [data-theme="dark"] .status-draft {
        background: linear-gradient(135deg, #7F1D1D 0%, #991B1B 100%) !important;
        color: #FECACA !important;
        border-color: #EF4444 !important;
    }
    [data-theme="dark"] .empty-state {
        background: #1E293B !important;
        border-color: #334155 !important;
    }
    [data-theme="dark"] .empty-title { color: #F1F5F9 !important; }
    [data-theme="dark"] .empty-text { color: #94A3B8 !important; }

    @media (max-width: 768px) {
        .pages-wrapper { padding: 20px; }
        .profile-header-card { padding: 25px 20px; }
        .profile-header-title { font-size: 24px; }
        .pages-grid { grid-template-columns: 1fr; gap: 20px; }
        .page-card-header { padding: 18px 20px; }
        .page-card-body { padding: 18px 20px; }
        .page-actions { flex-direction: column; }
        .btn-page { width: 100%; }
    }
</style>

<div class="pages-wrapper">

    
    <div class="profile-header-card">
        <div class="profile-header-content">
            <h1 class="profile-header-title">Kelola Halaman Profil</h1>
            <p class="profile-header-subtitle">Edit konten Sejarah, Visi & Misi, dan Sambutan Kepala Sekolah.</p>
            
            <div class="profile-header-note">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p>
                    <strong>Info:</strong> Halaman di bawah ini akan ditampilkan di menu <strong>Profil</strong> pada website publik. Klik tombol "Edit" untuk mengubah konten.
                </p>
            </div>
        </div>
    </div>

    
    <?php if($pages->isNotEmpty()): ?>
        <div class="pages-grid">
            <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $headerGradient = match($page->slug ?? '') {
                        'sejarah-sekolah' => 'linear-gradient(135deg, #1D3557 0%, #457B9D 100%)',
                        'visi-dan-misi' => 'linear-gradient(135deg, #059669 0%, #10B981 100%)',
                        'sambutan-kepala-sekolah' => 'linear-gradient(135deg, #D97706 0%, #F59E0B 100%)',
                        default => 'linear-gradient(135deg, #475569 0%, #64748B 100%)',
                    };
                ?>

                <div class="page-card" style="animation-delay: <?php echo e($loop->index * 0.1); ?>s;">
                    
                    <div class="page-card-header" style="background: <?php echo e($headerGradient); ?>;">
                        <h3 class="page-card-title"><?php echo e($page->judul ?? 'Judul Halaman'); ?></h3>
                    </div>

                    
                    <div class="page-card-body">
                        <div class="page-meta">
                            <div class="meta-item">
                                <span class="meta-label">Status</span>
                                <?php if($page->is_published): ?>
                                    <span class="status-badge status-published">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Dipublikasi
                                    </span>
                                <?php else: ?>
                                    <span class="status-badge status-draft">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Draft
                                    </span>
                                <?php endif; ?>
                            </div>
                            <div class="meta-item" style="text-align: right;">
                                <span class="meta-label">Terakhir Update</span>
                                <div class="meta-value"><?php echo e(optional($page->updated_at)->format('d M Y') ?? '-'); ?></div>
                            </div>
                        </div>

                        <div class="page-actions">
                            <a href="<?php echo e(route('admin.pages.edit', $page->id)); ?>" class="btn-page btn-edit">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Edit Halaman
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php else: ?>
        
        <div class="empty-state">
            <div class="empty-icon">📄</div>
            <h3 class="empty-title">Belum Ada Halaman Profil</h3>
            <p class="empty-text">Mulai tambahkan halaman Sejarah, Visi Misi, atau Sambutan untuk website publik Anda.</p>
            <a href="<?php echo e(route('admin.pages.create')); ?>" class="btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Halaman Pertama
            </a>
        </div>
    <?php endif; ?>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make($layout, array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\sekolah-app-v2\resources\views/admin/pages/index.blade.php ENDPATH**/ ?>