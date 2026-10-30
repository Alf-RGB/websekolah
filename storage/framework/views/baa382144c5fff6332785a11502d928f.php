

<?php $__env->startSection('title', 'Dashboard Admin'); ?>

<?php $__env->startSection('content'); ?>

<style>
    /* =========================================
       DASHBOARD SPECIFIC STYLES
       (Harmonized with layouts/admin variables)
       ========================================= */
    :root {
        --accent-primary: #667eea;
        --accent-secondary: #764ba2;
        --success: #10B981;
        --warning: #F59E0B;
        --error: #EF4444;
        --info: #3B82F6;
        --transition-bounce: all 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    @keyframes fadeInUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes fadeInDown { from { opacity: 0; transform: translateY(-30px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes float { 0%, 100% { transform: translateY(0px); } 50% { transform: translateY(-10px); } }

    /* Dashboard Header */
    .dashboard-header {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.15) 0%, rgba(118, 75, 162, 0.15) 100%);
        border: 1px solid rgba(102, 126, 234, 0.2);
        border-radius: 20px;
        padding: 32px;
        margin-bottom: 30px;
        position: relative;
        overflow: hidden;
        animation: fadeInDown 0.8s ease;
    }
    [data-theme="dark"] .dashboard-header {
        background: linear-gradient(135deg, rgba(124, 58, 237, 0.2) 0%, rgba(109, 40, 217, 0.2) 100%);
        border-color: rgba(124, 58, 237, 0.3);
    }
    .dashboard-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(102, 126, 234, 0.1) 0%, transparent 70%);
        border-radius: 50%;
        animation: float 6s ease-in-out infinite;
    }
    .dashboard-header-content { position: relative; z-index: 1; }
    .dashboard-header-title {
        font-size: 28px;
        font-weight: 800;
        color: var(--text-primary);
        margin: 0 0 8px 0;
        letter-spacing: -0.5px;
    }
    .dashboard-header-subtitle {
        font-size: 15px;
        color: var(--text-secondary);
        margin: 0 0 20px 0;
    }
    .dashboard-header-note {
        background: rgba(255, 255, 255, 0.5);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(102, 126, 234, 0.2);
        border-radius: 12px;
        padding: 14px 18px;
        display: flex;
        align-items: center;
        gap: 12px;
        animation: fadeInUp 0.8s ease 0.3s both;
    }
    [data-theme="dark"] .dashboard-header-note {
        background: rgba(30, 41, 59, 0.5);
    }
    .dashboard-header-note-icon {
        width: 22px;
        height: 22px;
        color: var(--warning);
        flex-shrink: 0;
    }
    .dashboard-header-note-text {
        font-size: 13px;
        color: var(--text-secondary);
        line-height: 1.5;
        margin: 0;
    }

    /* Stats Grid */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }
    .stat-card {
        background: var(--bg-secondary);
        border: 1px solid var(--border-color);
        border-radius: 16px;
        padding: 24px;
        position: relative;
        overflow: hidden;
        transition: var(--transition-bounce);
        animation: fadeInUp 0.6s ease backwards;
    }
    .stat-card:nth-child(1) { animation-delay: 0.1s; }
    .stat-card:nth-child(2) { animation-delay: 0.2s; }
    .stat-card:nth-child(3) { animation-delay: 0.3s; }
    .stat-card:nth-child(4) { animation-delay: 0.4s; }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0;
        width: 100%; height: 4px;
        background: var(--stat-gradient);
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.5s ease;
    }
    .stat-card:hover::before { transform: scaleX(1); }
    .stat-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-lg);
        border-color: rgba(102, 126, 234, 0.3);
    }

    .stat-card.hari-ini { --stat-gradient: linear-gradient(90deg, var(--success), #059669); }
    .stat-card.kemarin { --stat-gradient: linear-gradient(90deg, var(--info), #2563EB); }
    .stat-card.minggu-ini { --stat-gradient: linear-gradient(90deg, var(--warning), #D97706); }
    .stat-card.total { --stat-gradient: linear-gradient(90deg, var(--accent-primary), var(--accent-secondary)); }

    .stat-icon {
        width: 48px; height: 48px;
        border-radius: 12px;
        background: var(--stat-gradient);
        display: flex; align-items: center; justify-content: center;
        margin-bottom: 16px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        transition: var(--transition-bounce);
    }
    .stat-card:hover .stat-icon { transform: rotate(-10deg) scale(1.1); }
    .stat-icon svg { width: 24px; height: 24px; color: white; stroke-width: 1.5; }

    .stat-value {
        font-size: 32px; font-weight: 800;
        color: var(--text-primary);
        margin: 0 0 8px 0; line-height: 1;
        background: var(--stat-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    .stat-label {
        font-size: 12px; color: var(--text-muted);
        font-weight: 600; text-transform: uppercase;
        letter-spacing: 0.5px; margin: 0;
    }

    /* Content Sections */
    .content-section {
        background: var(--bg-secondary);
        border: 1px solid var(--border-color);
        border-radius: 20px;
        padding: 28px;
        margin-bottom: 30px;
        animation: fadeInUp 0.6s ease;
    }
    .section-title {
        font-size: 18px; font-weight: 700;
        color: var(--text-primary);
        margin: 0 0 24px 0;
        display: flex; align-items: center; gap: 10px;
    }
    .section-title::before {
        content: ''; width: 4px; height: 22px;
        background: linear-gradient(180deg, var(--accent-primary), var(--accent-secondary));
        border-radius: 4px;
    }

    .chart-container {
        background: var(--bg-primary);
        border-radius: 12px;
        padding: 20px;
        border: 1px solid var(--border-color);
    }

    .content-stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 16px;
    }
    .content-stat-item {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.08) 0%, rgba(118, 75, 162, 0.05) 100%);
        border: 1px solid rgba(102, 126, 234, 0.15);
        border-radius: 12px;
        padding: 20px;
        transition: var(--transition-bounce);
    }
    .content-stat-item:hover {
        transform: translateY(-5px);
        border-color: rgba(102, 126, 234, 0.4);
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.1);
    }
    .content-stat-value {
        font-size: 28px; font-weight: 800;
        background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin: 0 0 8px 0;
    }
    .content-stat-label {
        font-size: 12px; color: var(--text-muted);
        font-weight: 600; text-transform: uppercase;
        letter-spacing: 0.5px; margin: 0;
    }

    .actions-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 20px;
    }
    .action-card {
        background: var(--bg-primary);
        border: 1px solid var(--border-color);
        border-radius: 16px;
        padding: 24px;
        text-decoration: none;
        display: block;
        transition: var(--transition-bounce);
        position: relative;
        overflow: hidden;
    }
    .action-card::before {
        content: ''; position: absolute; top: 0; left: 0;
        width: 100%; height: 100%;
        background: linear-gradient(135deg, var(--action-gradient) 0%, transparent 100%);
        opacity: 0; transition: opacity 0.3s ease;
    }
    .action-card:hover::before { opacity: 0.05; }
    .action-card:hover {
        transform: translateY(-8px);
        border-color: var(--accent-primary);
        box-shadow: 0 15px 35px rgba(102, 126, 234, 0.15);
    }
    .action-card.berita { --action-gradient: linear-gradient(135deg, var(--info), transparent); }
    .action-card.galeri { --action-gradient: linear-gradient(135deg, var(--success), transparent); }
    .action-card.settings { --action-gradient: linear-gradient(135deg, #14B8A6, transparent); }

    .action-icon-box {
        width: 52px; height: 52px;
        border-radius: 14px;
        background: var(--action-gradient);
        display: flex; align-items: center; justify-content: center;
        margin-bottom: 16px;
        position: relative; z-index: 1;
        transition: var(--transition-bounce);
    }
    .action-card:hover .action-icon-box { transform: rotate(-12deg) scale(1.1); }
    .action-icon-box svg { width: 26px; height: 26px; color: white; stroke-width: 1.5; }

    .action-card h3 {
        font-size: 16px; font-weight: 700;
        color: var(--text-primary);
        margin: 0 0 8px 0; position: relative; z-index: 1;
    }
    .action-card p {
        font-size: 13px; color: var(--text-muted);
        margin: 0; line-height: 1.5; position: relative; z-index: 1;
    }

    .package-card {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
        border: 1px solid rgba(102, 126, 234, 0.2);
        border-radius: 16px;
        padding: 24px;
        display: flex; gap: 20px; align-items: center;
        animation: fadeInUp 0.8s ease 0.5s both;
    }
    .package-icon {
        width: 52px; height: 52px;
        border-radius: 14px;
        background: linear-gradient(135deg, var(--info), #8B5CF6);
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
        box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
    }
    .package-icon svg { width: 26px; height: 26px; color: white; stroke-width: 1.5; }
    .package-content h3 {
        font-size: 16px; font-weight: 700;
        color: var(--text-primary); margin: 0 0 6px 0;
    }
    .package-content p {
        font-size: 13px; color: var(--text-muted);
        margin: 0; line-height: 1.5;
    }

    @media (max-width: 768px) {
        .dashboard-header { padding: 24px 20px; }
        .dashboard-header-title { font-size: 22px; }
        .stats-grid, .content-stats-grid, .actions-grid { grid-template-columns: 1fr; }
        .package-card { flex-direction: column; text-align: center; }
    }
</style>


<div class="dashboard-header">
    <div class="dashboard-header-content">
        <h1 class="dashboard-header-title">Dashboard Admin</h1>
        <p class="dashboard-header-subtitle">Selamat datang kembali, <?php echo e(auth()->user()->name ?? 'Admin'); ?>! Kelola website sekolah dengan mudah.</p>
        
        <div class="dashboard-header-note">
            <svg class="dashboard-header-note-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <p class="dashboard-header-note-text">
                <strong>Info:</strong> Pantau statistik pengunjung, kelola konten website, dan pantau pendaftaran PPDB dari panel ini.
            </p>
        </div>
    </div>
</div>


<div class="stats-grid">
    <div class="stat-card hari-ini">
        <div class="stat-icon">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
        <div class="stat-value animate-number" data-target="<?php echo e($visitorStats['today'] ?? 0); ?>">0</div>
        <div class="stat-label">Hari Ini</div>
    </div>
    <div class="stat-card kemarin">
        <div class="stat-icon">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
        <div class="stat-value animate-number" data-target="<?php echo e($visitorStats['yesterday'] ?? 0); ?>">0</div>
        <div class="stat-label">Kemarin</div>
    </div>
    <div class="stat-card minggu-ini">
        <div class="stat-icon">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
        </div>
        <div class="stat-value animate-number" data-target="<?php echo e($visitorStats['this_week'] ?? 0); ?>">0</div>
        <div class="stat-label">Minggu Ini</div>
    </div>
    <div class="stat-card total">
        <div class="stat-icon">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
            </svg>
        </div>
        <div class="stat-value animate-number" data-target="<?php echo e($visitorStats['total'] ?? 0); ?>">0</div>
        <div class="stat-label">Total Pengunjung</div>
    </div>
</div>


<div class="content-section">
    <h2 class="section-title">Grafik Pengunjung (30 Hari Terakhir)</h2>
    <div class="chart-container">
        <canvas id="visitorChart" height="100"></canvas>
    </div>
</div>


<div class="content-section">
    <h2 class="section-title">Statistik Konten</h2>
    
    <div class="content-stats-grid">
        <?php if(in_array('berita', $activeFeatures)): ?>
        <div class="content-stat-item">
            <div class="content-stat-value animate-number" data-target="<?php echo e($stats['berita'] ?? 0); ?>">0</div>
            <div class="content-stat-label">Total Berita</div>
        </div>
        <?php endif; ?>

        <?php if(in_array('galeri', $activeFeatures)): ?>
        <div class="content-stat-item">
            <div class="content-stat-value animate-number" data-target="<?php echo e($stats['galeri'] ?? 0); ?>">0</div>
            <div class="content-stat-label">Total Galeri</div>
        </div>
        <?php endif; ?>

        <?php if(in_array('ppdb', $activeFeatures)): ?>
        <div class="content-stat-item">
            <div class="content-stat-value animate-number" data-target="<?php echo e($stats['ppdb'] ?? 0); ?>">0</div>
            <div class="content-stat-label">Pendaftar PPDB</div>
        </div>
        <?php endif; ?>

        <?php if(in_array('jurusan', $activeFeatures)): ?>
        <div class="content-stat-item">
            <div class="content-stat-value animate-number" data-target="<?php echo e($stats['jurusan'] ?? 0); ?>">0</div>
            <div class="content-stat-label">Kompetensi Keahlian</div>
        </div>
        <?php endif; ?>

        <?php if(in_array('guru', $activeFeatures)): ?>
        <div class="content-stat-item">
            <div class="content-stat-value animate-number" data-target="<?php echo e($stats['guru'] ?? 0); ?>">0</div>
            <div class="content-stat-label">Total Guru</div>
        </div>
        <?php endif; ?>

        <?php if(in_array('lamaran', $activeFeatures)): ?>
        <div class="content-stat-item">
            <div class="content-stat-value animate-number" data-target="<?php echo e($stats['pelamar'] ?? 0); ?>">0</div>
            <div class="content-stat-label">Pelamar Guru</div>
        </div>
        <?php endif; ?>

        <?php if(in_array('alumni', $activeFeatures)): ?>
        <div class="content-stat-item">
            <div class="content-stat-value animate-number" data-target="<?php echo e($stats['alumni'] ?? 0); ?>">0</div>
            <div class="content-stat-label">Total Alumni</div>
        </div>
        <?php endif; ?>
    </div>
</div>


<div class="content-section">
    <h2 class="section-title">Aksi Cepat</h2>
    
    <div class="actions-grid">
        <?php if(in_array('berita', $activeFeatures)): ?>
        <a href="/admin/posts" class="action-card berita">
            <div class="action-icon-box">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                </svg>
            </div>
            <h3>Kelola Berita</h3>
            <p>Lihat dan publikasikan informasi terbaru untuk pengunjung website</p>
        </a>
        <?php endif; ?>

        <?php if(in_array('galeri', $activeFeatures)): ?>
        <a href="/admin/galleries" class="action-card galeri">
            <div class="action-icon-box">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
            <h3>Kelola Galeri</h3>
            <p>Upload dan kelola foto-foto kegiatan sekolah</p>
        </a>
        <?php endif; ?>

        <a href="/admin/settings" class="action-card settings">
            <div class="action-icon-box">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </div>
            <h3>Identitas Sekolah</h3>
            <p>Ubah nama, alamat, logo, dan informasi sekolah</p>
        </a>
    </div>
</div>


<div class="package-card">
    <div class="package-icon">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
        </svg>
    </div>
    <div class="package-content">
        <h3>Paket Aktif: <span style="color: var(--accent-primary);"><?php echo e(strtoupper($packageLevel ?? 'full')); ?></span></h3>
        <p>
            <?php if($packageLevel === 'easy'): ?>
                Anda menggunakan paket Easy. Upgrade ke Medium atau Full untuk akses PPDB, Kompetensi, dan Alumni.
            <?php elseif($packageLevel === 'medium'): ?>
                Anda menggunakan paket Medium. Upgrade ke Full Service untuk akses semua fitur premium.
            <?php else: ?>
                Anda menggunakan paket Full Service dengan akses penuh ke semua fitur premium.
            <?php endif; ?>
        </p>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animasi Angka
    const statValues = document.querySelectorAll('.animate-number');
    statValues.forEach(el => {
        const target = parseInt(el.getAttribute('data-target')) || 0;
        const duration = 2000;
        const startTime = performance.now();
        
        function easeOutCubic(t) { return 1 - Math.pow(1 - t, 3); }
        
        function update(currentTime) {
            const elapsed = currentTime - startTime;
            const progress = Math.min(elapsed / duration, 1);
            const easedProgress = easeOutCubic(progress);
            const current = Math.floor(target * easedProgress);
            el.textContent = current.toLocaleString('id-ID');
            if (progress < 1) requestAnimationFrame(update);
            else el.textContent = target.toLocaleString('id-ID');
        }
        requestAnimationFrame(update);
    });

    // Chart
    const ctx = document.getElementById('visitorChart');
    if (!ctx) return;
    
    const context = ctx.getContext('2d');
    const isDarkMode = document.documentElement.getAttribute('data-theme') === 'dark';
    const gridColor = isDarkMode ? 'rgba(148, 163, 184, 0.1)' : 'rgba(148, 163, 184, 0.1)';
    const tickColor = isDarkMode ? '#94A3B8' : '#64748B';
    
    const gradient = context.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, 'rgba(124, 58, 237, 0.3)');
    gradient.addColorStop(1, 'rgba(124, 58, 237, 0.0)');
    
    new Chart(context, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($chartLabels ?? []); ?>,
            datasets: [{
                label: 'Pengunjung',
                data: <?php echo json_encode($chartData ?? []); ?>,
                borderColor: '#7C3AED',
                backgroundColor: gradient,
                borderWidth: 2.5,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#7C3AED',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 4,
                pointHoverRadius: 7,
                pointHoverBackgroundColor: '#7C3AED',
                pointHoverBorderColor: '#fff',
                pointHoverBorderWidth: 2,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: isDarkMode ? 'rgba(30, 41, 59, 0.95)' : 'rgba(15, 23, 42, 0.95)',
                    titleColor: '#fff',
                    bodyColor: '#fff',
                    padding: 12,
                    cornerRadius: 10,
                    displayColors: false,
                    titleFont: { size: 13, weight: '600' },
                    bodyFont: { size: 12 },
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: gridColor, drawBorder: false },
                    ticks: { color: tickColor, font: { size: 11, family: 'Inter' }, stepSize: 1 }
                },
                x: {
                    grid: { display: false, drawBorder: false },
                    ticks: { color: tickColor, font: { size: 11, family: 'Inter' }, maxRotation: 45, minRotation: 45 }
                }
            },
            interaction: { intersect: false, mode: 'index' }
        }
    });
});
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\sekolah-app-v2\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>