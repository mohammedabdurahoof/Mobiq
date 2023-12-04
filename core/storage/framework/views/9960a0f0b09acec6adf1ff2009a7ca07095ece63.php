
<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('User Dashboard')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('section'); ?>
    <div class="row">
        <div class="col-lg-6">
            <div class="user-dashboard-card style-01 ">
                <div class="icon slider-thumb"><i class="las la-dollar-sign"></i></div>
                <div class="content">
                    <h4 class="title"><?php echo e(__('Total Orders')); ?></h4>
                    <span class="number"><?php echo e($product_count); ?></span>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="user-dashboard-card style-01 ">
                <div class="icon slider-thumb"><i class="las la-sort-amount-up"></i></div>
                <div class="content">
                    <h4 class="title"><?php echo e(__('Support Tickets')); ?></h4>
                    <span class="number"><?php echo e($support_ticket_count); ?></span>
                </div>
            </div>
        </div>
    </div>



    <div class="row">
        <div class="col-lg-12">
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
                                    <?php elseif($order->status == 'canceled'): ?>
                                        <span class="badge badge-danger px-2 py-1"><?php echo e(__('Canceled')); ?></span>
                                    <?php endif; ?>
                                </td>
                                <td class="amount">
                                    <?php echo e(float_amount_with_currency_symbol($order->total_amount)); ?>

                                </td>
                                <td class="table-btn">
                                    <div class="btn-wrapper">
                                        <a href="<?php echo e(route('user.product.order.details', $order->id)); ?>"
                                           class="btn-default rounded-btn"> <?php echo e(__('view details')); ?></a>
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
        </div>
    </div>




<?php $__env->stopSection(); ?>






<?php echo $__env->make('frontend.user.dashboard.user-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mobidvab/public_html/core/resources/views/frontend/user/dashboard/user-home.blade.php ENDPATH**/ ?>