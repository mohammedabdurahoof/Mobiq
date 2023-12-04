
<?php $__env->startSection('page-title'); ?>
    <?php echo e($category_name); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Subcategory:')); ?> <?php echo e($category_name); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('category-url'); ?>
    <?php echo e(route("frontend.products.category", $subCategory?->category?->id)); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('category-title'); ?>
    <?php echo e(__("Category: ")); ?> <?php echo e($subCategory?->category?->title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-meta-data'); ?>
    <meta name="description" content="<?php echo e(get_static_option('product_page_'.$user_select_lang_slug.'_meta_description')); ?>">
    <meta name="tags" content="<?php echo e(get_static_option('product_page_'.$user_select_lang_slug.'_meta_tags')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="shop-grid-area-wrapper left-sidebar" id="shop">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <?php $__currentLoopData = $all_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-6 col-sm-6 col-md-6 col-lg-4 py-3">
                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.frontend.product.product-card','data' => ['product' => $product]]); ?>
<?php $component->withName('frontend.product.product-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['product' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="pagination-default">
                            <?php echo $all_products->links(); ?>

                        </div>
                    </div>
                </div>
                
                <?php if($all_products->total() < 1): ?>
                    <div><h2 class="text-warning"><?php echo e(__('no product found')); ?></h2></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mobidvab/public_html/core/resources/views/frontend/pages/product/subcategory.blade.php ENDPATH**/ ?>