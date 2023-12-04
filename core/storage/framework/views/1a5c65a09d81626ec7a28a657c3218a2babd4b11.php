
<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Product Order View')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="container custom-containers">
        <?php echo $__env->make("backend.products.order.invoice-partial", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mobidvab/public_html/core/resources/views/backend/products/order/view.blade.php ENDPATH**/ ?>