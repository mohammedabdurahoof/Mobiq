
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Products')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Product Page')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection("style"); ?>
    <style>
        a.reset-search-form-button.btn.btn-danger {
            position: relative;
            top: -3px;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php $item_width = 'col-lg-4'; ?>

    <div class="shop-grid-area-wrapper left-sidebar padding-100">
        <div class="container custom-container-1318">
            <div class="row flex-row-reverse">
                <div class="col-md-4 col-lg-3">
                    <?php echo $__env->make('frontend.partials.product.product-filter-sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
                <div class="col-md-8 col-lg-9">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="toolbox-wrapper toolbox-wrapper01">
                                <div class="toolbox-left">
                                    <div class="toolbox-item">
                                        <?php
                                            $pagination_summary = getPaginationSummaryText($all_products);
                                        ?>

                                        <?php if($pagination_summary['end'] > 0): ?>
                                            <p class="showing"><?php echo e(__('Showing')); ?> <?php echo e($pagination_summary['start']); ?>–<?php echo e($pagination_summary['end']); ?>

                                                <?php echo e(__('of')); ?> <?php echo e($pagination_summary['total']); ?> <?php echo e(__('results')); ?></p>
                                        <?php else: ?>
                                            <p class="showing"><?php echo e(__("No result found")); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="toolbox-right">
                                    <div class="toolbox-item toolbox-sort">
                                        <select id="set_item_sort_by" class="select-box">
                                            <option value="default" <?php if(isset($sort_by) && $sort_by == 'default'): ?> selected <?php endif; ?>><?php echo e(__('Default sorting')); ?></option>
                                            <option value="popularity" <?php if(isset($sort_by) && $sort_by == 'popularity'): ?> selected <?php endif; ?>><?php echo e(__('Sort by popularity')); ?></option>
                                            <option value="rating" <?php if(isset($sort_by) && $sort_by == 'rating'): ?> selected <?php endif; ?>><?php echo e(__('Sort by rating')); ?></option>
                                            <option value="latest" <?php if(isset($sort_by) && $sort_by == 'latest'): ?> selected <?php endif; ?>><?php echo e(__('Sort by latest')); ?></option>
                                            <option value="price_low" <?php if(isset($sort_by) && $sort_by == 'price_low'): ?> selected <?php endif; ?>><?php echo e(__('Sort by price: low to high')); ?></option>
                                            <option value="price_high" <?php if(isset($sort_by) && $sort_by == 'price_high'): ?> selected <?php endif; ?>><?php echo e(__('Sort by price: high to low')); ?></option>
                                        </select>
                                    </div>
                                    <div class="toolbox-item toolbox-layout">
                                        <ul class="layout-list">
                                            <li class="layout-item">
                                                <a href="<?php echo e(route('frontend.products.all', ['s' => 'grid'])); ?>"
                                                   class="grid-layout <?php if($item_style == 'grid'): ?> current <?php endif; ?>"
                                                   data-style="grid"
                                                >
                                                    <i class="las la-border-all icon"></i>
                                                </a>
                                            </li>
                                            <li class="layout-item">
                                                <a href="<?php echo e(route('frontend.products.all', ['s' => 'list'])); ?>" class="list-layout <?php if($item_style == 'list'): ?> current <?php endif; ?>" data-style="list">
                                                    <i class="las la-list icon"></i>
                                                </a>
                                            </li>
                                            <li class="layout-item">
                                                <a href="javascript:void(0)"
                                                   class="reset-search-form-button btn btn-danger"
                                                >
                                                    <i class="las la-redo-alt icon"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <?php $__currentLoopData = $all_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($item_style == 'grid'): ?>
                                <div class="col-6 col-sm-3 col-md-4">
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
                            <?php else: ?>
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.product-style.list-style-one','data' => ['product' => $product]]); ?>
<?php $component->withName('product-style.list-style-one'); ?>
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
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="pagination margin-top-30">
                                <?php if($all_products->count() > 0): ?>
                                    <?php echo $all_products->withQueryString()->links(); ?>

                                <?php else: ?>
                                    <h1 class="no-product-found-title text-danger">
                                        <?php echo e(__("No product found")); ?>

                                    </h1>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <?php echo $__env->make('frontend.partials.product.product-filter-form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <?php echo $__env->make('frontend.partials.product.product-filter-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mobidvab/public_html/core/resources/views/frontend/dynamic-redirect/product.blade.php ENDPATH**/ ?>