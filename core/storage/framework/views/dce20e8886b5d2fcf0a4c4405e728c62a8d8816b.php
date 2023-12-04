<?php
    $visibility_class = '';

    if (request()->routeIs('frontend.dynamic.page')) {
        if (isset($page_post) && !$page_post->breadcrumb_status) {
            $visibility_class = 'd-none';
        }
    }

    if (request()->route()->getName() === 'homepage') {
        $visibility_class = 'd-none';
        if (isset($page_details) && $page_details->breadcrumb_status) {
            $visibility_class = '';
        }
    }
?>

<div class="breadcrumb-area bg <?php if(request()->route()->getName() === 'homepage'): ?> d-none <?php endif; ?> <?php echo e($visibility_class); ?>">
    <div class="container custom-container-1318">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-inner ">
                    <div class="content">
                        <ul class="page-list">
                            <li class="list-item"><a href="<?php echo e(url('/')); ?>"><?php echo e(__('Home')); ?></a></li>
                            <?php if(Route::currentRouteName() === 'frontend.dynamic.page'): ?>
                                <li class="list-item"><a href="#"><?php echo e($page_post->title ?? $page_name ?? ''); ?></a></li>
                            <?php elseif(Route::currentRouteName() === 'frontend.products.single'): ?>
                                <li class="list-item"><a href="#"><?php echo $__env->yieldContent('page-title'); ?></a></li>
                            <?php elseif(Route::currentRouteName() === 'frontend.products.subcategory'): ?>
                                <li class="list-item"><a href="<?php echo $__env->yieldContent('category-url'); ?>"><?php echo $__env->yieldContent('category-title'); ?></a></li>
                            <?php else: ?>
                                <li class="list-item"><a href="#"><?php echo $__env->yieldContent('page-title'); ?></a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /home/mobidvab/public_html/core/resources/views/frontend/partials/breadcrumb.blade.php ENDPATH**/ ?>