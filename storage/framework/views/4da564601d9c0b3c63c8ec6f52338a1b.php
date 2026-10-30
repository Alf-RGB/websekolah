

<?php $__env->startSection('title', 'Kelola Akun Admin'); ?>

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

    .admin-users-wrapper { 
        max-width: 1100px; 
        margin: 0 auto; 
        padding: 30px; 
        animation: fadeInUp 0.6s ease;
    }

    /* Header */
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 40px;
        flex-wrap: wrap;
        gap: 20px;
        animation: fadeInDown 0.6s ease;
    }
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
    .btn-primary {
        background: linear-gradient(135deg, #7C3AED 0%, #5B21B6 100%);
        color: white;
        padding: 12px 24px;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 600;
        font-size: 14px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 4px 15px rgba(124, 58, 237, 0.3);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: none;
        cursor: pointer;
    }
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(124, 58, 237, 0.4);
    }
    .btn-primary:active {
        transform: translateY(0) scale(0.98);
    }

    /* Alerts */
    .alert {
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
    .alert-success {
        background: linear-gradient(135deg, #D1FAE5 0%, #A7F3D0 100%);
        border: 1px solid #10B981;
        color: #065F46;
    }
    .alert-error {
        background: linear-gradient(135deg, #FEE2E2 0%, #FECACA 100%);
        border: 1px solid #EF4444;
        color: #991B1B;
    }

    /* Stats Grid */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 16px;
        margin-bottom: 32px;
    }
    .stat-card {
        background: var(--card-bg, white);
        padding: 24px;
        border-radius: 16px;
        border: 1px solid var(--border-color, #E2E8F0);
        box-shadow: 0 2px 10px rgba(0,0,0,0.02);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        animation: slideIn 0.6s cubic-bezier(0.4, 0, 0.2, 1) backwards;
    }
    .stat-card:nth-child(1) { animation-delay: 0.1s; }
    .stat-card:nth-child(2) { animation-delay: 0.2s; }
    .stat-card:nth-child(3) { animation-delay: 0.3s; }
    
    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.08);
    }
    .stat-label {
        font-size: 13px;
        color: var(--text-secondary, #64748B);
        font-weight: 600;
        margin-bottom: 8px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .stat-value {
        font-size: 32px;
        font-weight: 800;
        margin: 0;
    }
    .stat-value.total { color: var(--text-primary, #0F172A); }
    .stat-value.super { color: #7C3AED; }
    .stat-value.admin { color: #3B82F6; }

    /* Table Card */
    .table-card {
        background: var(--card-bg, white);
        border-radius: 20px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
        overflow: hidden;
        border: 1px solid var(--border-color, #E2E8F0);
        animation: slideIn 0.6s cubic-bezier(0.4, 0, 0.2, 1) 0.2s backwards;
    }
    .table-header {
        padding: 24px 28px;
        border-bottom: 1px solid var(--border-color, #F1F5F9);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .table-title {
        color: var(--text-primary, #0F172A);
        font-size: 18px;
        font-weight: 700;
        margin: 0;
    }
    .table-count {
        font-size: 13px;
        color: var(--text-secondary, #64748B);
    }
    
    .table-container { overflow-x: auto; }
    .data-table {
        width: 100%;
        border-collapse: collapse;
    }
    .data-table th {
        padding: 16px 28px;
        text-align: left;
        font-size: 12px;
        font-weight: 700;
        color: var(--text-secondary, #64748B);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        background: var(--bg-tertiary, #F8FAFC);
        border-bottom: 1px solid var(--border-color, #E2E8F0);
    }
    .data-table td {
        padding: 20px 28px;
        border-bottom: 1px solid var(--border-color, #F1F5F9);
        transition: background 0.2s;
    }
    .data-table tbody tr {
        transition: background 0.2s;
    }
    .data-table tbody tr:hover {
        background: var(--bg-tertiary, #F8FAFC);
    }

    /* User Cell */
    .user-cell {
        display: flex;
        align-items: center;
        gap: 14px;
    }
    .user-avatar {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 16px;
        flex-shrink: 0;
        transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .data-table tbody tr:hover .user-avatar {
        transform: scale(1.1);
    }
    .user-name {
        font-weight: 700;
        color: var(--text-primary, #0F172A);
        font-size: 14px;
        margin: 0 0 2px 0;
    }
    .user-id {
        font-size: 12px;
        color: var(--text-secondary, #94A3B8);
        margin: 0;
    }

    /* Badges */
    .role-badge {
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
        display: inline-block;
        transition: transform 0.3s;
    }
    .data-table tbody tr:hover .role-badge {
        transform: scale(1.05);
    }
    .role-super { background: linear-gradient(135deg, #F3E8FF, #E9D5FF); color: #7C3AED; }
    .role-admin { background: #DBEAFE; color: #1D4ED8; }

    /* Action Buttons */
    .action-group {
        display: flex;
        gap: 8px;
        justify-content: flex-end;
    }
    .btn-action {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 14px;
        border-radius: 10px;
        text-decoration: none;
        font-size: 12px;
        font-weight: 600;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: none;
        cursor: pointer;
        font-family: inherit;
    }
    .btn-edit {
        background: #FEF3C7;
        color: #92400E;
    }
    .btn-edit:hover {
        background: #FDE68A;
        transform: translateY(-2px);
    }
    .btn-delete {
        background: #FEE2E2;
        color: #991B1B;
    }
    .btn-delete:hover {
        background: #FECACA;
        transform: translateY(-2px);
    }
    .btn-delete:active {
        transform: translateY(0) scale(0.95);
    }

    /* Empty State */
    .empty-state {
        padding: 60px 28px;
        text-align: center;
    }
    .empty-icon { font-size: 48px; margin-bottom: 16px; display: block; }
    .empty-title {
        color: var(--text-primary, #0F172A);
        font-size: 16px;
        font-weight: 700;
        margin: 0 0 8px 0;
    }
    .empty-text {
        color: var(--text-secondary, #64748B);
        font-size: 14px;
        margin: 0;
    }

    /* Dark Mode */
    [data-theme="dark"] .btn-back { background: #1E293B !important; border-color: #334155 !important; color: #F1F5F9 !important; }
    [data-theme="dark"] .btn-back:hover { background: #334155 !important; }
    [data-theme="dark"] .page-title { color: #F1F5F9 !important; }
    [data-theme="dark"] .stat-card, [data-theme="dark"] .table-card { background: #1E293B !important; border-color: #334155 !important; }
    [data-theme="dark"] .stat-value.total { color: #F1F5F9 !important; }
    [data-theme="dark"] .data-table th { background: #0F172A !important; border-color: #334155 !important; }
    [data-theme="dark"] .data-table td { border-color: #334155 !important; }
    [data-theme="dark"] .data-table tbody tr:hover { background: #0F172A !important; }
    [data-theme="dark"] .user-name { color: #F1F5F9 !important; }
    [data-theme="dark"] .role-admin { background: rgba(59, 130, 246, 0.2) !important; color: #60A5FA !important; }
    [data-theme="dark"] .role-super { background: rgba(124, 58, 237, 0.2) !important; color: #A78BFA !important; }
    [data-theme="dark"] .empty-title { color: #F1F5F9 !important; }

    @media (max-width: 768px) {
        .admin-users-wrapper { padding: 20px; }
        .page-header { flex-direction: column; align-items: flex-start; }
        .btn-primary { width: 100%; justify-content: center; }
        .table-header { flex-direction: column; align-items: flex-start; gap: 8px; }
        .data-table th, .data-table td { padding: 16px 20px; }
        .action-group { flex-direction: column; }
        .btn-action { width: 100%; justify-content: center; }
    }
</style>

<div class="admin-users-wrapper">
    
    
    <div class="page-header">
        <div>
            <div class="header-nav">
                <a href="/admin/dashboard" class="btn-back">←</a>
                <span class="page-badge">👥 User Management</span>
            </div>
            <h1 class="page-title">Kelola Akun Admin</h1>
            <p class="page-subtitle">Tambah, edit, atau hapus akun admin yang dapat mengelola website.</p>
        </div>
        <a href="/admin/users/create" class="btn-primary">
            <span style="font-size: 18px; line-height: 1;">+</span> Tambah Admin Baru
        </a>
    </div>

    
    <?php if(session('success')): ?>
    <div class="alert alert-success">
        <span style="font-size: 20px;">✅</span>
        <?php echo e(session('success')); ?>

    </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
    <div class="alert alert-error">
        <span style="font-size: 20px;">⚠️</span>
        <?php echo e(session('error')); ?>

    </div>
    <?php endif; ?>

    
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-label">Total Admin</div>
            <div class="stat-value total"><?php echo e($users->count()); ?></div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Super Admin</div>
            <div class="stat-value super"><?php echo e($users->where('role', 'super_admin')->count()); ?></div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Admin</div>
            <div class="stat-value admin"><?php echo e($users->where('role', 'admin')->count()); ?></div>
        </div>
    </div>

    
    <div class="table-card">
        <div class="table-header">
            <h3 class="table-title">Daftar Akun Admin</h3>
            <span class="table-count"><?php echo e($users->count()); ?> akun terdaftar</span>
        </div>
        
        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th style="text-align: right;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td>
                            <div class="user-cell">
                                <div class="user-avatar" style="background: linear-gradient(135deg, <?php echo e($user->role === 'super_admin' ? '#7C3AED, #5B21B6' : '#3B82F6, #2563EB'); ?>);">
                                    <?php echo e(strtoupper(substr($user->name, 0, 1))); ?>

                                </div>
                                <div>
                                    <div class="user-name"><?php echo e($user->name); ?></div>
                                    <div class="user-id">ID: <?php echo e($user->id); ?></div>
                                </div>
                            </div>
                        </td>
                        <td style="font-size: 14px; color: var(--text-secondary, #64748B);"><?php echo e($user->email); ?></td>
                        <td>
                            <?php if($user->role === 'super_admin'): ?>
                                <span class="role-badge role-super">👑 Super Admin</span>
                            <?php else: ?>
                                <span class="role-badge role-admin">🔑 Admin</span>
                            <?php endif; ?>
                        </td>
                        <td style="text-align: right;">
                            <div class="action-group">
                                <a href="/admin/users/<?php echo e($user->id); ?>/edit" class="btn-action btn-edit">✏️ Edit</a>
                                
                                <?php if($user->id !== auth()->id()): ?>
                                <form action="/admin/users/<?php echo e($user->id); ?>" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus user ini? Tindakan ini tidak dapat dibatalkan.')">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn-action btn-delete">🗑️ Hapus</button>
                                </form>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="4">
                            <div class="empty-state">
                                <span class="empty-icon">👥</span>
                                <div class="empty-title">Belum ada data admin</div>
                                <div class="empty-text">Klik tombol "Tambah Admin Baru" untuk menambahkan.</div>
                            </div>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.superadmin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\sekolah-app-v2\resources\views/admin/users/index.blade.php ENDPATH**/ ?>