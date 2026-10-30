

<?php $__env->startSection('title', 'Galeri Foto - ' . (\App\Models\Setting::where('key', 'nama_sekolah')->value('value') ?? 'Sekolah')); ?>

<?php $__env->startSection('content'); ?>

<style>
    /* =========================================
       1. CSS VARIABLES & THEME
       ========================================= */
    :root {
        --bg-primary: #F8FAFC;
        --bg-secondary: #FFFFFF;
        --bg-tertiary: #F1F5F9;
        --text-primary: #0F172A;
        --text-secondary: #475569;
        --text-muted: #94A3B8;
        --border-color: #E2E8F0;
        --primary-color: #1D3557;
        --primary-hover: #457B9D;
        --shadow-sm: 0 1px 3px rgba(0,0,0,0.05);
        --shadow-md: 0 4px 6px -1px rgba(0,0,0,0.1);
        --shadow-lg: 0 10px 15px -3px rgba(0,0,0,0.1);
        --shadow-xl: 0 20px 25px -5px rgba(0,0,0,0.1);
        --transition-smooth: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    [data-theme="dark"] {
        --bg-primary: #0F172A;
        --bg-secondary: #1E293B;
        --bg-tertiary: #334155;
        --text-primary: #F1F5F9;
        --text-secondary: #CBD5E1;
        --text-muted: #94A3B8;
        --border-color: #334155;
        --shadow-sm: 0 1px 3px rgba(0,0,0,0.3);
        --shadow-md: 0 4px 6px -1px rgba(0,0,0,0.4);
        --shadow-lg: 0 10px 15px -3px rgba(0,0,0,0.5);
        --shadow-xl: 0 20px 25px -5px rgba(0,0,0,0.5);
    }

    /* =========================================
       2. GLOBAL RESET & ANIMATIONS
       ========================================= */
    * { margin: 0; padding: 0; box-sizing: border-box; }
    
    .gallery-wrapper { 
        max-width: 1200px; 
        margin: 40px auto; 
        padding: 0 20px; 
        animation: fadeInUp 0.6s ease-out;
    }

    @keyframes fadeInDown { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes slideIn { from { opacity: 0; transform: scale(0.96) translateY(20px); } to { opacity: 1; transform: scale(1) translateY(0); } }
    @keyframes float { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-8px); } }

    /* =========================================
       3. PAGE HEADER
       ========================================= */
    .page-header { 
        text-align: center; 
        margin-bottom: 40px; 
        animation: fadeInDown 0.6s ease-out;
    }
    .page-header h1 { 
        color: var(--text-primary); 
        font-size: 36px; 
        margin-bottom: 10px; 
        font-weight: 800; 
        letter-spacing: -0.5px;
    }
    .page-header p { 
        color: var(--text-secondary); 
        font-size: 16px; 
        max-width: 600px; 
        margin: 0 auto; 
        line-height: 1.6; 
    }

    /* =========================================
       4. FILTER BUTTONS
       ========================================= */
    .filter-container {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        justify-content: center;
        margin-bottom: 40px;
        animation: fadeInUp 0.6s ease-out 0.1s backwards;
    }
    .filter-btn {
        padding: 10px 24px;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        font-size: 14px;
        transition: var(--transition-smooth);
        background: var(--bg-secondary);
        color: var(--text-secondary);
        border: 1px solid var(--border-color);
        box-shadow: var(--shadow-sm);
    }
    .filter-btn:hover {
        background: var(--bg-tertiary);
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
        color: var(--text-primary);
    }
    .filter-btn.active {
        background: var(--primary-color);
        color: white;
        border-color: var(--primary-color);
        box-shadow: 0 4px 12px rgba(29, 53, 87, 0.2);
    }
    .filter-btn.active:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(29, 53, 87, 0.3);
    }

    /* =========================================
       5. GALLERY GRID & CARDS
       ========================================= */
    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 25px;
    }

    .gallery-card {
        position: relative;
        border-radius: 20px;
        overflow: hidden;
        background: var(--bg-secondary);
        box-shadow: var(--shadow-md);
        border: 1px solid var(--border-color);
        transition: var(--transition-smooth);
        height: 100%;
        display: flex;
        flex-direction: column;
        text-decoration: none;
        color: inherit;
        animation: slideIn 0.6s cubic-bezier(0.4, 0, 0.2, 1) backwards;
    }
    
    /* Staggered Animation Delays */
    .gallery-card:nth-child(1) { animation-delay: 0.1s; }
    .gallery-card:nth-child(2) { animation-delay: 0.15s; }
    .gallery-card:nth-child(3) { animation-delay: 0.2s; }
    .gallery-card:nth-child(4) { animation-delay: 0.25s; }
    .gallery-card:nth-child(5) { animation-delay: 0.3s; }
    .gallery-card:nth-child(6) { animation-delay: 0.35s; }
    .gallery-card:nth-child(7) { animation-delay: 0.4s; }
    .gallery-card:nth-child(8) { animation-delay: 0.45s; }

    .gallery-card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: var(--shadow-xl);
        border-color: var(--primary-hover);
    }

    .gallery-image-wrapper {
        overflow: hidden;
        height: 250px;
        background: var(--bg-tertiary);
        position: relative;
    }
    .gallery-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .gallery-card:hover .gallery-image {
        transform: scale(1.1);
    }
    .gallery-placeholder {
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 50px;
        transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .gallery-card:hover .gallery-placeholder {
        transform: scale(1.1) rotate(-3deg);
    }

    .gallery-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(to top, rgba(0, 0, 0, 0.9) 0%, rgba(0, 0, 0, 0.7) 60%, transparent 100%);
        padding: 60px 20px 20px;
        color: white;
        transition: var(--transition-smooth);
    }
    .gallery-card:hover .gallery-overlay {
        padding-bottom: 25px;
    }
    .gallery-category {
        background: rgba(255,255,255,0.2);
        backdrop-filter: blur(4px);
        color: white;
        padding: 4px 12px;
        border-radius: 50px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        display: inline-block;
        margin-bottom: 8px;
        letter-spacing: 0.5px;
        border: 1px solid rgba(255,255,255,0.3);
    }
    .gallery-title {
        color: white;
        font-size: 18px;
        margin: 0 0 5px;
        line-height: 1.3;
        font-weight: 700;
    }
    .gallery-desc {
        color: rgba(255,255,255,0.85);
        font-size: 13px;
        margin: 0;
        line-height: 1.4;
    }

    /* =========================================
       6. EMPTY STATE
       ========================================= */
    .empty-state {
        grid-column: 1/-1;
        text-align: center;
        padding: 60px 20px;
        background: var(--bg-secondary);
        border-radius: 20px;
        box-shadow: var(--shadow-md);
        border: 1px solid var(--border-color);
        animation: slideIn 0.6s ease-out;
    }
    .empty-icon {
        font-size: 60px;
        margin-bottom: 15px;
        display: inline-block;
        animation: float 3s ease-in-out infinite;
    }
    .empty-state h3 {
        color: var(--text-primary);
        margin-bottom: 10px;
        font-size: 20px;
        font-weight: 700;
    }
    .empty-state p {
        color: var(--text-secondary);
        font-size: 15px;
    }

    /* =========================================
       7. PAGINATION
       ========================================= */
    .pagination-wrapper {
        margin-top: 50px;
        display: flex;
        justify-content: center;
        animation: fadeInUp 0.6s ease-out 0.4s backwards;
    }

    /* =========================================
       8. DARK MODE OVERRIDES
       ========================================= */
    [data-theme="dark"] .filter-btn {
        background: var(--bg-secondary);
        color: var(--text-secondary);
        border-color: var(--border-color);
    }
    [data-theme="dark"] .filter-btn:hover {
        background: var(--bg-tertiary);
        color: var(--text-primary);
    }
    [data-theme="dark"] .filter-btn.active {
        background: var(--primary-color);
        color: white;
        border-color: var(--primary-color);
    }

    /* =========================================
       9. RESPONSIVE
       ========================================= */
    @media (max-width: 768px) {
        .gallery-wrapper { margin: 20px auto; padding: 0 15px; }
        .page-header h1 { font-size: 28px; }
        .gallery-grid { grid-template-columns: 1fr; }
    }
</style>

<div class="gallery-wrapper">
    
    
    <div class="page-header">
        <h1>📷 Galeri Foto</h1>
        <p>Dokumentasi momen berharga, fasilitas, dan pencapaian sekolah kami.</p>
    </div>

    
    <?php
        $filters = [
            '' => 'Semua',
            'Kegiatan' => 'Kegiatan',
            'Fasilitas' => 'Fasilitas',
            'Prestasi' => 'Prestasi'
        ];
        $currentKategori = request('kategori', '');
    ?>
    
    <div class="filter-container">
        <?php $__currentLoopData = $filters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $isActive = strtolower($currentKategori) === strtolower($key);
            ?>
            <a href="/galeri<?php echo e($key ? '?kategori=' . urlencode($key) : ''); ?>" 
               class="filter-btn <?php echo e($isActive ? 'active' : ''); ?>">
                <?php echo e($label); ?>

            </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    
    <div class="gallery-grid">
        <?php $__empty_1 = true; $__currentLoopData = $galleries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gallery): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <a href="/galeri/<?php echo e($gallery->slug); ?>" class="gallery-card">
                
                <div class="gallery-image-wrapper">                        
                    <?php
                        $gambarExists = $gallery->gambar && file_exists(public_path('storage/' . $gallery->gambar));                        
                    ?>
                    
                    <?php if($gambarExists): ?>
                        <img src="<?php echo e(asset('storage/' . $gallery->gambar)); ?>" 
                             alt="<?php echo e($gallery->judul); ?>" 
                             class="gallery-image" 
                             loading="lazy">
                    <?php else: ?>
                        <div class="gallery-placeholder">
                            📷
                        </div>
                    <?php endif; ?>
                </div>
                
                
                <div class="gallery-overlay">
                    <span class="gallery-category">
                        <?php echo e(ucfirst($gallery->kategori ?? 'Umum')); ?>

                    </span>
                    <h3 class="gallery-title"><?php echo e($gallery->judul); ?></h3>
                    <?php if($gallery->deskripsi): ?>
                        <p class="gallery-desc"><?php echo e(Str::limit(strip_tags($gallery->deskripsi), 70)); ?></p>
                    <?php endif; ?>
                </div>
            </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            
            <div class="empty-state">
                <div class="empty-icon">📷</div>
                <h3>Belum Ada Foto</h3>
                <p>Belum ada dokumentasi foto yang ditambahkan di kategori ini.</p>
            </div>
        <?php endif; ?>
    </div>

    
    <?php if($galleries->hasPages()): ?>
        <div class="pagination-wrapper">
            <?php echo e($galleries->appends(['kategori' => request('kategori')])->links()); ?>

        </div>
    <?php endif; ?>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\sekolah-app-v2\resources\views/public/galeri/index.blade.php ENDPATH**/ ?>