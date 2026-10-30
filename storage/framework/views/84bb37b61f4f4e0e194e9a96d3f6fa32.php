<?php if($paginator->hasPages()): ?>
<nav role="navigation" aria-label="Pagination Navigation" style="margin-top: 20px;">
    <ul style="display: flex; justify-content: center; align-items: center; gap: 6px; list-style: none; padding: 0; margin: 0; flex-wrap: wrap;">
        
        
        <?php if($paginator->onFirstPage()): ?>
            <li style="display: inline-block; opacity: 0.5; cursor: not-allowed;">
                <span style="display: inline-flex; align-items: center; justify-content: center; min-width: 36px; height: 36px; padding: 0 12px; border-radius: 8px; font-size: 13px; font-weight: 600; background: var(--card-bg, white); color: var(--text-secondary, #94A3B8); border: 1px solid var(--border-color, #E2E8F0);">
                    «
                </span>
            </li>
        <?php else: ?>
            <li style="display: inline-block;">
                <a href="<?php echo e($paginator->previousPageUrl()); ?>" rel="prev" aria-label="Previous" style="display: inline-flex; align-items: center; justify-content: center; min-width: 36px; height: 36px; padding: 0 12px; border-radius: 8px; font-size: 13px; font-weight: 600; text-decoration: none; background: var(--card-bg, white); color: var(--text-primary, #1E293B); border: 1px solid var(--border-color, #E2E8F0); transition: all 0.2s;">
                    «
                </a>
            </li>
        <?php endif; ?>

        
        <?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            
            <?php if(is_string($element)): ?>
                <li style="display: inline-block;">
                    <span style="display: inline-flex; align-items: center; justify-content: center; min-width: 36px; height: 36px; padding: 0 12px; border-radius: 8px; font-size: 13px; font-weight: 600; color: var(--text-secondary, #94A3B8);">
                        <?php echo e($element); ?>

                    </span>
                </li>
            <?php endif; ?>

            
            <?php if(is_array($element)): ?>
                <?php $__currentLoopData = $element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($page == $paginator->currentPage()): ?>
                        <li style="display: inline-block;" aria-current="page">
                            <span style="display: inline-flex; align-items: center; justify-content: center; min-width: 36px; height: 36px; padding: 0 12px; border-radius: 8px; font-size: 13px; font-weight: 700; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: 1px solid #667eea; box-shadow: 0 2px 8px rgba(102, 126, 234, 0.3);">
                                <?php echo e($page); ?>

                            </span>
                        </li>
                    <?php else: ?>
                        <li style="display: inline-block;">
                            <a href="<?php echo e($url); ?>" style="display: inline-flex; align-items: center; justify-content: center; min-width: 36px; height: 36px; padding: 0 12px; border-radius: 8px; font-size: 13px; font-weight: 600; text-decoration: none; background: var(--card-bg, white); color: var(--text-primary, #1E293B); border: 1px solid var(--border-color, #E2E8F0); transition: all 0.2s;">
                                <?php echo e($page); ?>

                            </a>
                        </li>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        
        <?php if($paginator->hasMorePages()): ?>
            <li style="display: inline-block;">
                <a href="<?php echo e($paginator->nextPageUrl()); ?>" rel="next" aria-label="Next" style="display: inline-flex; align-items: center; justify-content: center; min-width: 36px; height: 36px; padding: 0 12px; border-radius: 8px; font-size: 13px; font-weight: 600; text-decoration: none; background: var(--card-bg, white); color: var(--text-primary, #1E293B); border: 1px solid var(--border-color, #E2E8F0); transition: all 0.2s;">
                    »
                </a>
            </li>
        <?php else: ?>
            <li style="display: inline-block; opacity: 0.5; cursor: not-allowed;">
                <span style="display: inline-flex; align-items: center; justify-content: center; min-width: 36px; height: 36px; padding: 0 12px; border-radius: 8px; font-size: 13px; font-weight: 600; background: var(--card-bg, white); color: var(--text-secondary, #94A3B8); border: 1px solid var(--border-color, #E2E8F0);">
                    »
                </span>
            </li>
        <?php endif; ?>
    </ul>
</nav>
<?php endif; ?><?php /**PATH C:\laragon\www\sekolah-app-v2\resources\views/vendor/pagination/custom.blade.php ENDPATH**/ ?>