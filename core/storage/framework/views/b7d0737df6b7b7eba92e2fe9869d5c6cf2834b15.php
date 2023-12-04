
<?php $__env->startSection('style'); ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.datatable.css','data' => []]); ?>
<?php $component->withName('datatable.css'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('My Orders')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('section'); ?>
    <div class="form-header-wrap margin-bottom-20 d-flex justify-content-between">
        <h3 class="mb-3"><?php echo e(__('My Orders')); ?></h3>
    </div>
    <div class="table-wrap table-responsive all-user-campaign-table">
        <div class="order-history-inner text-center">
            <table class="table">
                <thead>
                    <tr>
                        <th>
                            <?php echo e(__('Order')); ?>

                        </th>
                        <th>
                            <?php echo e(__('Date')); ?>

                        </th>
                        <th>
                            <?php echo e(__('Status')); ?>

                        </th>
                        <th>
                            <?php echo e(__('Amount')); ?>

                        </th>
                        <th>
                            <?php echo e(__('Action')); ?>

                        </th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $all_orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="completed">
                            <td class="order-numb">
                                #<?php echo e($order->id); ?>

                            </td>
                            <td class="date">
                                <?php echo e($order->created_at->format('F d, Y')); ?>

                            </td>
                            <td class="status">
                                <?php if($order->status == 'complete'): ?>
                                    <span class="badge badge-success px-2 py-1"><?php echo e(__('Complete')); ?></span>
                                <?php elseif($order->status == 'pending'): ?>
                                    <span class="badge badge-warning px-2 py-1"><?php echo e(__('Pending')); ?></span>
                                <?php elseif($order->status == 'canceling'): ?>
                                    <span class="badge badge-danger px-2 py-1"><?php echo e(__('Canceling')); ?></span>
                                <?php elseif($order->status == 'cancel'): ?>
                                    <span class="badge badge-danger px-2 py-1"><?php echo e(__('Cancel')); ?></span>
                                <?php endif; ?>
                            </td>
                            <td class="amount">
                                <?php echo e(float_amount_with_currency_symbol($order->total_amount)); ?>

                            </td>
                            <td class="table-btn">
                                <div class="btn-wrapper">
                                    <a href="<?php echo e(route('user.product.order.details', $order->id)); ?>"
                                        class="btn-default rounded-btn"> <?php echo e(__('view details')); ?></a>
                                    <?php if($order->status == 'pending'): ?>
                                        <a href="<?php echo e(route('user.product.order.cancelOrder', $order->id)); ?>"
                                            class="btn-default rounded-btn"> <?php echo e(__('cancel order')); ?></a>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="pagination">
        <?php echo $all_orders->links(); ?>

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('assets/backend/js/sweetalert2.js')); ?>"></script>

    <script>
        (function($) {
            "use strict";
            $(document).ready(function() {

                $(document).on('click', '.mobile_nav', function(e) {
                    e.preventDefault();
                    $(this).parent().toggleClass('show');
                });

                $(document).on('click', '.swal_delete_button', function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: '<?php echo e(__('Are you sure?')); ?>',
                        text: '<?php echo e(__('You would not be able to revert this item!')); ?>',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $(this).next().find('.swal_form_submit_btn').trigger('click');
                        }
                    });
                });
            })
        })(jQuery)
    </script>

    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.datatable.js','data' => []]); ?>
<?php $component->withName('datatable.js'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.user.dashboard.user-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mobiq\core\resources\views/frontend/user/dashboard/order/all.blade.php ENDPATH**/ ?>