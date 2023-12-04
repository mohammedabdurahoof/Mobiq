
<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Track Order')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Track Order')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="sign-in-area-wrapper">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <div class="box-animation" <?php if(session()->has('info') || session()->has('msg') || $errors->any()): ?> style="min-height: 410px!important;" <?php endif; ?>>
                        <div class="wrap">

                      
                        <div class="sign-in register">
                            <h4 class="title"><?php echo e(__('Order Tracking')); ?></h4>
                            <div class="form-wrapper">
                                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.msg.flash','data' => []]); ?>
<?php $component->withName('msg.flash'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.msg.error','data' => []]); ?>
<?php $component->withName('msg.error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>

                                <?php if(session()->has('info')): ?>
                                    <div class="alert alert-<?php echo e(session('type')); ?>">
                                        <?php echo session('info'); ?>

                                    </div>
                                <?php endif; ?>
                                <form method="POST" action="<?php echo e(route('frontend.products.track.order')); ?>">
                                    <?php echo csrf_field(); ?>
                                    <div class="form-group">
                                        <input type="text" name="order_id" class="form-control" id="order_id" placeholder="<?php echo e(__('Order Id')); ?>">
                                    </div>



                                    <div class="btn-wrapper">
                                        <button type="submit" class="btn-default rounded-btn"><?php echo e(__('Track your order')); ?></button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mobidvab/public_html/core/resources/views/frontend/pages/track-order.blade.php ENDPATH**/ ?>