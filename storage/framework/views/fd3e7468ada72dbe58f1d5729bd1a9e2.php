

<?php $__env->startSection('title', 'Profil Guru - ' . ($data['nama_sekolah'] ?? 'SMK')); ?>

<?php $__env->startSection('content'); ?>

<style>
    /* =========================================
       1. CSS VARIABLES & ANIMATIONS
       ========================================= */
    :root {
        --bg-dark-primary: #0F172A;
        --bg-dark-secondary: #1E1B4B;
        --text-white: #FFFFFF;
        --text-muted: #94A3B8;
        --text-light: #CBD5E1;
        --accent-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --card-bg: rgba(30, 41, 59, 0.8);
        --card-border: rgba(255, 255, 255, 0.1);
        --shadow-glow: 0 30px 60px rgba(102, 126, 234, 0.3);
        --transition-smooth: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    @keyframes fadeInDown { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes fadeInUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes slideIn { from { opacity: 0; transform: scale(0.95) translateY(20px); } to { opacity: 1; transform: scale(1) translateY(0); } }
    @keyframes float { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-10px); } }

    /* =========================================
       2. WRAPPER & LAYOUT
       ========================================= */
    .guru-public-wrapper {
        min-height: 80vh;
        padding: 60px 20px;
        background: linear-gradient(135deg, var(--bg-dark-primary) 0%, var(--bg-dark-secondary) 100%);
        position: relative;
        overflow: hidden;
    }

    /* Subtle background pattern */
    .guru-public-wrapper::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background-image: radial-gradient(circle at 20% 50%, rgba(102, 126, 234, 0.1) 0%, transparent 50%),
                          radial-gradient(circle at 80% 80%, rgba(118, 75, 162, 0.1) 0%, transparent 50%);
        pointer-events: none;
    }

    .guru-container {
        max-width: 1200px;
        margin: 0 auto;
        position: relative;
        z-index: 1;
        animation: fadeInUp 0.6s ease-out;
    }

    /* =========================================
       3. HEADER
       ========================================= */
    .guru-header {
        text-align: center;
        margin-bottom: 60px;
        animation: fadeInDown 0.6s ease-out;
    }

    .guru-title {
        font-size: 48px;
        font-weight: 800;
        color: var(--text-white);
        margin: 0 0 15px 0;
        letter-spacing: -1px;
        background: var(--accent-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .guru-subtitle {
        font-size: 16px;
        color: var(--text-muted);
        max-width: 600px;
        margin: 0 auto;
        line-height: 1.8;
    }

    /* =========================================
       4. GURU GRID & CARDS
       ========================================= */
    .guru-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 40px;
        margin-bottom: 60px;
    }

    .guru-card {
        background: var(--card-bg);
        border-radius: 24px;
        padding: 50px 40px;
        text-align: center;
        border: 1px solid var(--card-border);
        backdrop-filter: blur(10px);
        transition: var(--transition-smooth);
        position: relative;
        overflow: hidden;
        animation: slideIn 0.6s cubic-bezier(0.4, 0, 0.2, 1) backwards;
    }

    /* Staggered Animation Delays */
    .guru-card:nth-child(1) { animation-delay: 0.1s; }
    .guru-card:nth-child(2) { animation-delay: 0.15s; }
    .guru-card:nth-child(3) { animation-delay: 0.2s; }
    .guru-card:nth-child(4) { animation-delay: 0.25s; }
    .guru-card:nth-child(5) { animation-delay: 0.3s; }
    .guru-card:nth-child(6) { animation-delay: 0.35s; }

    .guru-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--accent-gradient);
        transform: scaleX(0);
        transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .guru-card:hover {
        transform: translateY(-10px) scale(1.02);
        box-shadow: var(--shadow-glow);
        border-color: rgba(102, 126, 234, 0.4);
    }

    .guru-card:hover::before {
        transform: scaleX(1);
    }

    .guru-avatar-wrapper {
        position: relative;
        margin-bottom: 30px;
    }

    .guru-avatar {
        width: 180px;
        height: 180px;
        border-radius: 50%;
        background: var(--accent-gradient);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 72px;
        font-weight: 800;
        margin: 0 auto;
        box-shadow: 0 20px 40px rgba(102, 126, 234, 0.4);
        border: 5px solid rgba(255, 255, 255, 0.1);
        position: relative;
        overflow: hidden;
        transition: var(--transition-smooth);
    }

    .guru-card:hover .guru-avatar {
        transform: scale(1.05) rotate(-3deg);
        box-shadow: 0 25px 50px rgba(102, 126, 234, 0.5);
    }

    .guru-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        position: relative;
        z-index: 1;
    }

    .guru-avatar::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.2) 0%, rgba(118, 75, 162, 0.2) 100%);
        z-index: 2;
        pointer-events: none;
    }

    .guru-name {
        font-size: 24px;
        font-weight: 700;
        color: var(--text-white);
        margin: 0 0 10px 0;
        letter-spacing: -0.5px;
        transition: var(--transition-smooth);
    }
    
    .guru-card:hover .guru-name {
        background: var(--accent-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .guru-subject {
        font-size: 15px;
        color: var(--text-muted);
        margin: 0 0 20px 0;
        font-weight: 500;
    }

    .guru-nip {
        font-size: 14px;
        color: var(--text-light);
        padding: 10px 20px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 12px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        transition: var(--transition-smooth);
    }
    
    .guru-card:hover .guru-nip {
        background: rgba(255, 255, 255, 0.1);
        border-color: rgba(102, 126, 234, 0.3);
    }

    /* =========================================
       5. FOOTER & EMPTY STATE
       ========================================= */
    .guru-footer {
        text-align: center;
        padding: 30px;
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.2) 0%, rgba(118, 75, 162, 0.2) 100%);
        border-radius: 16px;
        border: 1px solid rgba(102, 126, 234, 0.3);
        animation: fadeInUp 0.6s ease-out 0.4s backwards;
    }

    .guru-footer-text {
        font-size: 16px;
        font-weight: 700;
        color: var(--text-white);
        margin: 0;
    }

    .guru-footer-count {
        font-size: 32px;
        font-weight: 800;
        background: var(--accent-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        display: block;
        margin-top: 5px;
    }

    .empty-state {
        text-align: center;
        padding: 80px 20px;
        animation: slideIn 0.6s ease-out;
    }
    .empty-icon-wrapper {
        width: 120px;
        height: 120px;
        margin: 0 auto 30px;
        background: rgba(255,255,255,0.05);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid rgba(255,255,255,0.1);
        animation: float 3s ease-in-out infinite;
    }
    .empty-state h3 {
        font-size: 24px;
        font-weight: 700;
        color: var(--text-white);
        margin: 0 0 10px 0;
    }
    .empty-state p {
        color: var(--text-muted);
        font-size: 15px;
    }

    /* =========================================
       6. RESPONSIVE
       ========================================= */
    @media (max-width: 768px) {
        .guru-public-wrapper { padding: 40px 15px; }
        .guru-title { font-size: 36px; }
        .guru-grid { grid-template-columns: 1fr; gap: 30px; }
        .guru-card { padding: 40px 30px; }
        .guru-avatar { width: 150px; height: 150px; font-size: 60px; }
        .guru-name { font-size: 22px; }
    }

    @media (max-width: 480px) {
        .guru-title { font-size: 28px; }
        .guru-avatar { width: 120px; height: 120px; font-size: 48px; }
    }
</style>

<div class="guru-public-wrapper">
    <div class="guru-container">
        
        
        <div class="guru-header">
            <h1 class="guru-title">Profil Guru</h1>
            <p class="guru-subtitle">
                Tenaga pendidik profesional yang berkomitmen untuk membentuk generasi unggul dan berkarakter.
            </p>
        </div>

        
        <?php if($gurus->count() > 0): ?>
            <div class="guru-grid">
                <?php $__currentLoopData = $gurus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $guru): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="guru-card">
                    <div class="guru-avatar-wrapper">
                        <div class="guru-avatar">
                            <?php if($guru->foto && file_exists(public_path('storage/' . $guru->foto))): ?>
                                <img src="<?php echo e(asset('storage/' . $guru->foto)); ?>" alt="<?php echo e($guru->nama); ?>" loading="lazy">
                            <?php else: ?>
                                <?php echo e(strtoupper(substr($guru->nama ?? 'G', 0, 1))); ?>

                            <?php endif; ?>
                        </div>
                    </div>

                    <h3 class="guru-name"><?php echo e($guru->nama); ?></h3>
                    <p class="guru-subject"><?php echo e($guru->mata_pelajaran ?? 'Mata Pelajaran'); ?></p>
                    
                    <?php if($guru->nip): ?>
                    <div class="guru-nip">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                        </svg>
                        NIP: <?php echo e($guru->nip); ?>

                    </div>
                    <?php endif; ?>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            
            <div class="guru-footer">
                <p class="guru-footer-text">
                    Total Guru Profesional
                    <span class="guru-footer-count"><?php echo e($gurus->count()); ?></span>
                </p>
            </div>
        <?php else: ?>
            <div class="empty-state">
                <div class="empty-icon-wrapper">
                    <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="color: #94A3B8;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <h3>Belum Ada Data Guru</h3>
                <p>Data guru akan segera ditampilkan.</p>
            </div>
        <?php endif; ?>

    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\sekolah-app-v2\resources\views/public/guru/index.blade.php ENDPATH**/ ?>