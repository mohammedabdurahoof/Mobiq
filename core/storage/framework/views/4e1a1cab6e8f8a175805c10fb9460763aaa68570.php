
<?php $__env->startSection('page-title'); ?>
    <?php echo e($campaign->title); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<?php
    $item_style = request()->s ?? 'grid';
?>
<div class="shop-grid-area-wrapper shop-campaing">
    <div class="container custom-container-1318">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="toolbox-wrapper">
                            <div class="toolbox-left">
                                <div class="toolbox-item">
                                    <?php
                                        $pagination_summary = getPaginationSummaryText($campaign_products);
                                    ?>
                                    <p class="showing"><?php echo e(__('Showing')); ?> <?php echo e($pagination_summary['start']); ?>–<?php echo e($pagination_summary['end']); ?>

                                        <?php echo e(__('of')); ?> <?php echo e($pagination_summary['total']); ?> <?php echo e(__('results')); ?></p>
                                </div>
                            </div>
                            <div class="toolbox-right">
                                <div class="toolbox-item toolbox-sort">
                                    <select id="item-shows" class="select-box">
                                        <option value="default" <?php if(isset($sort_by) && $sort_by == 'default'): ?> selected <?php endif; ?>><?php echo e(__('Default sorting')); ?></option>
                                        <option value="popularity" <?php if(isset($sort_by) && $sort_by == 'popularity'): ?> selected <?php endif; ?>><?php echo e(__('Sort by popularity')); ?></option>
                                        <option value="rating" <?php if(isset($sort_by) && $sort_by == 'rating'): ?> selected <?php endif; ?>><?php echo e(__('Sort by rating')); ?></option>
                                        <option value="latest" <?php if(isset($sort_by) && $sort_by == 'latest'): ?> selected <?php endif; ?>><?php echo e(__('Sort by latest')); ?></option>
                                        <option value="price_low" <?php if(isset($sort_by) && $sort_by == 'price_low'): ?> selected <?php endif; ?>><?php echo e(__('Sort by price: low to high')); ?></option>
                                        <option value="price_high" <?php if(isset($sort_by) && $sort_by == 'price_high'): ?> selected <?php endif; ?>><?php echo e(__('Sort by price: high to low')); ?></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php if(isset($campaign_products) && $campaign_products->count()): ?>
                        <?php $__currentLoopData = $campaign_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $campaign_product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                                <?php $end_date = $campaign_product->end_date ?? $campaign->end_date ?? ''; ?>
                                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.frontend.product.product-card-03','data' => ['product' => $campaign_product->product,'isCampaign' => true,'campaignId' => $campaign->id,'campaignProductEndDate' => $end_date]]); ?>
<?php $component->withName('frontend.product.product-card-03'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['product' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($campaign_product->product),'isCampaign' => true,'campaignId' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($campaign->id),'campaignProductEndDate' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($end_date)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <div class="col-md-12">
                            <div class="text-center">
                                <h1><?php echo e(__('No products to show')); ?></h1>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="pagination margin-top-30">
                            <?php echo $campaign_products->withQueryString()->links(); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script>
        (function ($) {
            $(document).ready(function () {
                loopcounter('flash-countdown');
            });
        })(jQuery)
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mobidvab/public_html/core/resources/views/frontend/campaign/index.blade.php ENDPATH**/ ?>