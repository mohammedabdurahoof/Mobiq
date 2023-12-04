<div class="top-product-wrapper" data-padding-top="<?php echo e($settings['padding_top']); ?>"  data-padding-bottom="<?php echo e($settings['padding_bottom']); ?>">
    <div class="container custom-container-1318">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-wrapper">
                    <h2 class="section-title"><?php echo e($section_title); ?></h2>
                    <div class="img-box">
                        <?php echo render_image_markup_by_attachment_id($title_image, '', 'grid', false); ?>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="btn-list-wrapper">
                    <ul class="btn-list btn-wrapper product_filter_style_one_btn_list">
                        <li id="product_filter_featured_products" class="active"><?php echo e(__('Featured')); ?></li>
                        <li id="product_filter_top_selling" class=""><?php echo e(__('New Arrival')); ?></li>
                        <li id="product_filter_new_products" class=""><?php echo e(__('New')); ?></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="grid-wrapper" id="product_filter_section">
            <?php $__currentLoopData = $all_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="single-grid">
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.product-style.grid-style-one','data' => ['product' => $product]]); ?>
<?php $component->withName('product-style.grid-style-one'); ?>
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
        <div class="row">
            <div class="col-lg-12">
                <div class="btn-wrapper text-center margin-top-60">
                    <a href="<?php echo e(url(" shop-page")); ?>" class="btn-default rounded-btn semi-bold"><?php echo e(__('see all')); ?></a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /home/mobidvab/public_html/core/app/Providers/../PageBuilder/views/product/product_filter_one.blade.php ENDPATH**/ ?>