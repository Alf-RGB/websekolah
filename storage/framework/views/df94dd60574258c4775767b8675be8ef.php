

<?php $__env->startSection('title', 'Data Pendaftar PPDB - Admin'); ?>

<?php $__env->startSection('content'); ?>

<style>
    :root {
        --bg-primary: #F8FAFC;
        --bg-secondary: #FFFFFF;
        --bg-tertiary: #F1F5F9;
        --text-primary: #0F172A;
        --text-secondary: #475569;
        --text-muted: #94A3B8;
        --border-color: #E2E8F0;
        --accent-color: #667eea;
        --accent-hover: #764ba2;
        --success-color: #10B981;
        --error-color: #EF4444;
        --warning-color: #F59E0B;
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
    }

    @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes fadeInDown { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes slideIn { from { opacity: 0; transform: scale(0.95); } to { opacity: 1; transform: scale(1); } }

    .pendaftar-wrapper { 
        max-width: 1400px; 
        margin: 0 auto; 
        padding: 30px 20px; 
        animation: fadeInUp 0.6s ease;
    }

    /* Header Card */
    .pendaftar-header-card {
        background: linear-gradient(135deg, var(--accent-color) 0%, var(--accent-hover) 100%);
        border-radius: 20px;
        padding: 35px 40px;
        margin-bottom: 30px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(102, 126, 234, 0.3);
        animation: fadeInDown 0.8s ease;
    }
    [data-theme="dark"] .pendaftar-header-card {
        background: linear-gradient(135deg, #7C3AED 0%, #6D28D9 100%);
    }
    .pendaftar-header-card::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 400px;
        height: 400px;
        background: rgba(255,255,255,0.1);
        border-radius: 50%;
    }
    .pendaftar-header-content { position: relative; z-index: 1; }
    .pendaftar-header-title {
        font-size: 32px;
        font-weight: 800;
        color: white !important;
        margin: 0 0 10px 0;
        letter-spacing: -0.5px;
    }
    .pendaftar-header-subtitle {
        font-size: 16px;
        color: rgba(255,255,255,0.9) !important;
        margin: 0;
    }

    /* Stats Cards */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }
    .stat-card {
        background: var(--bg-secondary);
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        border: 1px solid var(--border-color);
        transition: var(--transition-smooth);
        position: relative;
        overflow: hidden;
        animation: slideIn 0.6s ease backwards;
    }
    .stat-card:nth-child(1) { animation-delay: 0.1s; }
    .stat-card:nth-child(2) { animation-delay: 0.2s; }
    .stat-card:nth-child(3) { animation-delay: 0.3s; }
    .stat-card:nth-child(4) { animation-delay: 0.4s; }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0;
        width: 4px;
        height: 100%;
        transform: scaleY(0);
        transform-origin: top;
        transition: transform 0.5s ease;
    }
    .stat-card.total::before { background: linear-gradient(180deg, var(--accent-color), var(--accent-hover)); }
    .stat-card.diterima::before { background: linear-gradient(180deg, var(--success-color), #059669); }
    .stat-card.menunggu::before { background: linear-gradient(180deg, var(--warning-color), #D97706); }
    .stat-card.ditolak::before { background: linear-gradient(180deg, var(--error-color), #DC2626); }
    
    .stat-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 30px rgba(0,0,0,0.1);
    }
    .stat-card:hover::before {
        transform: scaleY(1);
    }
    .stat-value {
        font-size: 36px;
        font-weight: 800;
        color: var(--text-primary);
        margin: 0 0 8px 0;
        line-height: 1;
    }
    /* ✅ FIX: HAPUS SEMUA HIGHLIGHT DI LABEL */
    .stat-label {
        font-size: 12px;
        color: var(--text-muted) !important;
        margin: 0 !important;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        text-decoration: none !important;
        border: none !important;
        background: transparent !important;
        box-shadow: none !important;
        padding: 0 !important;
        display: block;
    }

    /* Search Section - FULL WIDTH & MODERN */
    .search-section {
        background: var(--bg-secondary);
        border-radius: 16px;
        padding: 24px 28px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        border: 1px solid var(--border-color);
        margin-bottom: 30px;
        animation: fadeInUp 0.6s ease 0.2s both;
    }
    .search-form {
        display: flex;
        gap: 12px;
        align-items: center;
    }
    .search-input-wrapper { 
        flex: 1; 
        position: relative; 
    }
    .search-icon {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        width: 20px;
        height: 20px;
        color: var(--text-muted);
        pointer-events: none;
        z-index: 10;
    }
    .search-input {
        width: 100%;
        padding: 14px 18px 14px 50px;
        border: 2px solid var(--border-color);
        border-radius: 12px;
        font-size: 14px;
        background: var(--bg-primary);
        color: var(--text-primary);
        transition: var(--transition-smooth);
        box-sizing: border-box;
    }
    .search-input:focus {
        outline: none;
        border-color: var(--accent-color);
        background: var(--bg-secondary);
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
    }
    .search-input::placeholder { 
        color: var(--text-muted);
    }

    .btn-cari {
        background: linear-gradient(135deg, var(--accent-color), var(--accent-hover));
        color: white !important;
        padding: 14px 32px;
        border-radius: 12px;
        border: none;
        font-weight: 700;
        font-size: 14px;
        cursor: pointer;
        transition: var(--transition-smooth);
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        white-space: nowrap;
    }
    .btn-cari:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
    }

    /* Content Card */
    .content-card {
        background: var(--bg-secondary);
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        border: 1px solid var(--border-color);
        animation: slideIn 0.6s ease 0.3s both;
    }

    /* Table */
    .table-container { overflow-x: auto; }
    .table-pendaftar {
        width: 100%;
        border-collapse: collapse;
        font-size: 14px;
    }
    .table-pendaftar thead tr {
        background: var(--bg-tertiary);
        border-bottom: 2px solid var(--border-color);
    }
    .table-pendaftar th {
        padding: 14px 16px;
        color: var(--text-muted);
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        text-align: left;
    }
    .table-pendaftar tbody tr {
        border-bottom: 1px solid var(--border-color);
        transition: var(--transition-smooth);
        animation: fadeInUp 0.5s ease backwards;
    }
    .table-pendaftar tbody tr:nth-child(1) { animation-delay: 0.1s; }
    .table-pendaftar tbody tr:nth-child(2) { animation-delay: 0.15s; }
    .table-pendaftar tbody tr:nth-child(3) { animation-delay: 0.2s; }
    .table-pendaftar tbody tr:nth-child(4) { animation-delay: 0.25s; }
    .table-pendaftar tbody tr:nth-child(5) { animation-delay: 0.3s; }
    
    .table-pendaftar tbody tr:hover {
        background: var(--bg-tertiary);
    }
    .table-pendaftar td {
        padding: 14px 16px;
        color: var(--text-primary);
        vertical-align: middle;
    }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 8px;
        justify-content: center;
    }
    .btn-action {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 8px 16px;
        border-radius: 8px;
        border: none;
        cursor: pointer;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        color: white !important;
        transition: var(--transition-smooth);
        box-shadow: 0 2px 6px rgba(0,0,0,0.15);
    }
    .btn-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(0,0,0,0.25);
    }
    .btn-lihat { background: linear-gradient(135deg, var(--success-color), #059669); }
    .btn-hapus { background: linear-gradient(135deg, var(--error-color), #DC2626); }

    /* Status Badge */
    .status-badge {
        display: inline-block;
        padding: 6px 14px;
        border-radius: 12px;
        font-size: 12px;
        font-weight: 700;
        color: white;
        text-align: center;
    }
    .status-menunggu { background: linear-gradient(135deg, var(--warning-color), #D97706); }
    .status-diterima { background: linear-gradient(135deg, var(--success-color), #059669); }
    .status-ditolak { background: linear-gradient(135deg, var(--error-color), #DC2626); }

    /* Tracking Code */
    .tracking-code {
        background: var(--bg-tertiary);
        padding: 6px 12px;
        border-radius: 8px;
        font-family: 'Courier New', monospace;
        font-size: 12px;
        font-weight: 700;
        color: var(--text-primary);
        display: inline-block;
    }

    .alert-success {
        background: rgba(16, 185, 129, 0.15);
        border: 1px solid rgba(16, 185, 129, 0.3);
        border-radius: 12px;
        padding: 15px 20px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 12px;
        animation: fadeInDown 0.5s ease;
    }
    .alert-success svg { width: 22px; height: 22px; color: #6EE7B7; flex-shrink: 0; }
    .alert-success span { color: #6EE7B7; font-weight: 600; font-size: 14px; }
    
    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        animation: fadeInUp 0.6s ease;
    }
    .empty-icon-wrapper {
        width: 120px;
        height: 120px;
        margin: 0 auto 25px;
        background: var(--bg-tertiary);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .empty-icon { width: 60px; height: 60px; color: var(--text-muted); }
    .empty-title {
        font-size: 24px;
        font-weight: 700;
        color: var(--text-primary);
        margin: 0 0 10px 0;
    }
    .empty-text {
        font-size: 15px;
        color: var(--text-secondary);
        margin: 0;
        max-width: 500px;
        margin-left: auto;
        margin-right: auto;
        line-height: 1.6;
    }

    /* Custom Modal */
    #modalKonfirmasi {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(15, 23, 42, 0.85);
        backdrop-filter: blur(6px);
        z-index: 9999;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }
    .konfirmasi-card {
        background: var(--bg-secondary);
        border-radius: 20px;
        padding: 35px;
        max-width: 420px;
        width: 100%;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.6);
        border: 1px solid var(--border-color);
        text-align: center;
        animation: slideIn 0.3s ease;
    }
    .konfirmasi-icon {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        background: linear-gradient(135deg, var(--error-color), #DC2626);
        box-shadow: 0 10px 25px rgba(239, 68, 68, 0.3);
    }
    .konfirmasi-icon svg {
        width: 35px;
        height: 35px;
        color: white;
    }
    .konfirmasi-title {
        font-size: 20px;
        font-weight: 700;
        color: var(--text-primary);
        margin: 0 0 12px 0;
    }
    .konfirmasi-message {
        font-size: 14px;
        color: var(--text-secondary);
        margin: 0 0 25px 0;
        line-height: 1.6;
    }
    .konfirmasi-buttons {
        display: flex;
        gap: 12px;
        justify-content: center;
    }
    .btn-konfirmasi {
        padding: 12px 24px;
        border-radius: 10px;
        border: none;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition-smooth);
        min-width: 110px;
    }
    .btn-konfirmasi-batal {
        background: var(--bg-tertiary);
        color: var(--text-secondary);
        border: 1px solid var(--border-color);
    }
    .btn-konfirmasi-batal:hover {
        background: var(--border-color);
        transform: translateY(-2px);
    }
    .btn-konfirmasi-ya {
        background: linear-gradient(135deg, var(--error-color), #DC2626);
        color: white;
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
    }
    .btn-konfirmasi-ya:hover {
        box-shadow: 0 6px 20px rgba(239, 68, 68, 0.4);
        transform: translateY(-2px);
    }

    /* Dark Mode */
    [data-theme="dark"] .stat-card,
    [data-theme="dark"] .search-section,
    [data-theme="dark"] .content-card,
    [data-theme="dark"] .konfirmasi-card {
        background: var(--bg-secondary);
        border-color: var(--border-color);
    }
    [data-theme="dark"] .table-pendaftar thead tr,
    [data-theme="dark"] .table-pendaftar tbody tr:hover {
        background: var(--bg-tertiary);
    }

    @media (max-width: 768px) {
        .pendaftar-wrapper { padding: 20px 15px; }
        .pendaftar-header-card { padding: 28px 20px; }
        .pendaftar-header-title { font-size: 24px; }
        .stats-grid { grid-template-columns: 1fr; }
        .search-form { flex-direction: column; }
        .btn-cari { width: 100%; }
        .content-card { padding: 20px; }
        .action-buttons { flex-direction: column; }
        .btn-action { width: 100%; }
        .konfirmasi-buttons { flex-direction: column; }
        .btn-konfirmasi { width: 100%; }
    }

    /* ✅ FIX TOMBOL CARI & HAPUS DI DARK MODE */
    [data-theme="dark"] .btn-cari {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
        color: white !important;
        border: none !important;
    }

    [data-theme="dark"] .btn-cari:hover {
        background: linear-gradient(135deg, #764ba2 0%, #667eea 100%) !important;
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4) !important;
    }

    [data-theme="dark"] .btn-hapus {
        background: linear-gradient(135deg, #EF4444 0%, #DC2626 100%) !important;
        color: white !important;
        border: none !important;
    }

    [data-theme="dark"] .btn-hapus:hover {
        background: linear-gradient(135deg, #DC2626 0%, #B91C1C 100%) !important;
        box-shadow: 0 6px 15px rgba(239, 68, 68, 0.4) !important;
    }

    [data-theme="dark"] .btn-lihat {
        background: linear-gradient(135deg, #10B981 0%, #059669 100%) !important;
        color: white !important;
    }

    [data-theme="dark"] .btn-lihat:hover {
        background: linear-gradient(135deg, #059669 0%, #047857 100%) !important;
    }

    /* Fix untuk search input di dark mode */
    [data-theme="dark"] .search-input {
        background: var(--bg-primary) !important;
        border-color: var(--border-color) !important;
        color: var(--text-primary) !important;
    }

    [data-theme="dark"] .search-input:focus {
        background: var(--bg-secondary) !important;
        border-color: var(--accent-color) !important;
    }

    /* Fix untuk table di dark mode */
    [data-theme="dark"] .table-pendaftar tbody tr {
        background: var(--bg-secondary) !important;
        border-color: var(--border-color) !important;
    }

    [data-theme="dark"] .table-pendaftar tbody tr:hover {
        background: var(--bg-tertiary) !important;
    }

    [data-theme="dark"] .tracking-code {
        background: var(--bg-tertiary) !important;
        color: var(--text-primary) !important;
    }

</style>

<div class="pendaftar-wrapper">

    
    <div class="pendaftar-header-card">
        <div class="pendaftar-header-content">
            <h1 class="pendaftar-header-title">Data Pendaftar PPDB</h1>
            <p class="pendaftar-header-subtitle">Kelola dan pantau pendaftar PPDB yang masuk</p>
        </div>
    </div>

    
    <div class="stats-grid">
        <div class="stat-card total">
            <h2 class="stat-value"><?php echo e($totalPendaftar ?? 0); ?></h2>
            <p class="stat-label">Total Pendaftar</p>
        </div>
        <div class="stat-card diterima">
            <h2 class="stat-value"><?php echo e($diterimaPendaftar ?? 0); ?></h2>
            <p class="stat-label">Diterima</p>
        </div>
        <div class="stat-card menunggu">
            <h2 class="stat-value"><?php echo e($menungguPendaftar ?? 0); ?></h2>
            <p class="stat-label">Menunggu</p>
        </div>
        <div class="stat-card ditolak">
            <h2 class="stat-value"><?php echo e($ditolakPendaftar ?? 0); ?></h2>
            <p class="stat-label">Ditolak</p>
        </div>
    </div>

    
    <div class="search-section">
        <form class="search-form" onsubmit="event.preventDefault(); searchPendaftar();">
            <div class="search-input-wrapper">
                <svg class="search-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input type="text" class="search-input" placeholder="Cari berdasarkan NISN, nama, atau kode tracking..." id="searchInput">
            </div>
            <button type="submit" class="btn-cari">Cari</button>
        </form>
    </div>

    
    <div class="content-card">
        
        <?php if(session('success')): ?>
        <div class="alert-success">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span><?php echo e(session('success')); ?></span>
        </div>
        <?php endif; ?>

        <?php if(isset($pendaftars) && $pendaftars->count() > 0): ?>
            <div class="table-container">
                <table class="table-pendaftar" id="pendaftarTable">
                    <thead>
                        <tr>
                            <th>Sekolah Asal</th>
                            <th>Nama Lengkap</th>
                            <th>NISN</th>
                            <th>Kode Tracking</th>
                            <th>Status</th>
                            <th>Tanggal Daftar</th>
                            <th style="text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $pendaftars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pendaftar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr data-nisn="<?php echo e($pendaftar->nisn); ?>" data-tracking="<?php echo e($pendaftar->kode_tracking); ?>" data-nama="<?php echo e(strtolower($pendaftar->nama_lengkap)); ?>">
                            <td>
                                <div style="font-weight: 600;"><?php echo e($pendaftar->asal_sekolah ?? '-'); ?></div>
                            </td>
                            <td><?php echo e($pendaftar->nama_lengkap ?? '-'); ?></td>
                            <td><?php echo e($pendaftar->nisn ?? '-'); ?></td>
                            <td>
                                <span class="tracking-code"><?php echo e($pendaftar->kode_tracking ?? '-'); ?></span>
                            </td>
                            <td>
                                <span class="status-badge status-<?php echo e(strtolower($pendaftar->status ?? 'menunggu')); ?>">
                                    <?php echo e(ucfirst($pendaftar->status ?? 'Menunggu')); ?>

                                </span>
                            </td>
                            <td><?php echo e($pendaftar->created_at ? $pendaftar->created_at->format('d M Y') : '-'); ?></td>
                            <td style="text-align: center;">
                                <div class="action-buttons">
                                    <a href="<?php echo e(route('admin.pendaftar.show', $pendaftar->id)); ?>" class="btn-action btn-lihat">Lihat</a>
                                    <button type="button" class="btn-action btn-hapus" onclick="showKonfirmasi(<?php echo e($pendaftar->id); ?>, '<?php echo e(addslashes($pendaftar->nama_lengkap)); ?>')">Hapus</button>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            
            <?php if(method_exists($pendaftars, 'links')): ?>
                <div style="margin-top: 25px;"><?php echo e($pendaftars->links()); ?></div>
            <?php endif; ?>
        <?php else: ?>
            <div class="empty-state">
                <div class="empty-icon-wrapper">
                    <svg class="empty-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <h3 class="empty-title">Belum Ada Pendaftar</h3>
                <p class="empty-text">Belum ada pendaftar PPDB yang masuk. Data akan muncul setelah ada yang mendaftar.</p>
            </div>
        <?php endif; ?>
    </div>

</div>


<div id="modalKonfirmasi">
    <div class="konfirmasi-card">
        <div class="konfirmasi-icon">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
            </svg>
        </div>
        <h3 class="konfirmasi-title">Hapus Pendaftar</h3>
        <p class="konfirmasi-message" id="konfirmasiMessage">Apakah Anda yakin ingin menghapus data ini?</p>
        <div class="konfirmasi-buttons">
            <button class="btn-konfirmasi btn-konfirmasi-batal" onclick="closeKonfirmasi()">Batal</button>
            <button class="btn-konfirmasi btn-konfirmasi-ya" id="btnKonfirmasiYa">Ya, Hapus</button>
        </div>
    </div>
</div>

<script>
let pendingAction = null;

// Search Pendaftar
function searchPendaftar() {
    const searchInput = document.getElementById('searchInput');
    const query = searchInput.value.toLowerCase().trim();
    const rows = document.querySelectorAll('#pendaftarTable tbody tr');
    
    if (query === '') {
        rows.forEach(row => row.style.display = '');
        return;
    }
    
    rows.forEach(row => {
        const nisn = (row.getAttribute('data-nisn') || '').toLowerCase();
        const tracking = (row.getAttribute('data-tracking') || '').toLowerCase();
        const nama = (row.getAttribute('data-nama') || '');
        
        if (nisn.includes(query) || tracking.includes(query) || nama.includes(query)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}

// Real-time search
document.getElementById('searchInput').addEventListener('input', function() {
    searchPendaftar();
});

function showKonfirmasi(id, nama) {
    const modal = document.getElementById('modalKonfirmasi');
    const messageEl = document.getElementById('konfirmasiMessage');
    
    messageEl.innerHTML = 'Apakah Anda yakin ingin menghapus data pendaftar <strong style="color: var(--text-primary);">' + nama + '</strong>?';
    
    pendingAction = function() {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '/admin/pendaftar/' + id;
        form.innerHTML = '<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>"><input type="hidden" name="_method" value="DELETE">';
        document.body.appendChild(form);
        form.submit();
    };
    
    modal.style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function closeKonfirmasi() {
    const modal = document.getElementById('modalKonfirmasi');
    modal.style.display = 'none';
    document.body.style.overflow = '';
    pendingAction = null;
}

document.getElementById('btnKonfirmasiYa').addEventListener('click', function() {
    if (pendingAction) pendingAction();
    closeKonfirmasi();
});

document.getElementById('modalKonfirmasi').addEventListener('click', function(e) {
    if (e.target === this) closeKonfirmasi();
});

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        const modal = document.getElementById('modalKonfirmasi');
        if (modal && modal.style.display === 'flex') closeKonfirmasi();
    }
});
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\sekolah-app-v2\resources\views/admin/pendaftar/index.blade.php ENDPATH**/ ?>