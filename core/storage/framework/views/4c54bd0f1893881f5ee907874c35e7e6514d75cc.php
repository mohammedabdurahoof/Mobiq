
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Payment Success')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content-s'); ?>
<div class="patment-success-area padding-top-100 padding-bottom-100">
    <div class="container">
        <div class="payment-success-wrapper">
            <div class="payment-contents">
                <h4 class="title"> <?php echo e(__('Payment Successful')); ?> </h4>
                <div class="icon">
                    <i class="las la-check"></i>
                </div>
                <ul class="payment-list margin-top-40">
                    <li><?php echo e(__('Payment Gateway')); ?> <span class="payment-strong"><?php echo e($payment_details->payment_gateway); ?></span></li>
                    <li><?php echo e(__('Phone')); ?> <span class="payment-strong"><?php echo e($payment_details->phone); ?></span></li>
                    <li><?php echo e(__('Name')); ?> <span class="payment-strong"><?php echo e($payment_details->name); ?></span></li>
                    <li><?php echo e(__('Email')); ?> <span class="payment-strong"><?php echo e($payment_details->email); ?></span></li>
                </ul>
                <ul class="payment-list payment-list-two margin-top-30">
                    <li><span class="list-bold"><?php echo e(__('Amount Paid')); ?></span> <span class="payment-strong payment-bold"><?php echo e(float_amount_with_currency_symbol($payment_details->total_amount)); ?></span></li>
                    <li><?php echo e(__('Transaction ID')); ?><span class="payment-strong"><?php echo e($payment_details->transaction_id); ?></span></li>
                </ul>
                <div class="btn-wrapper margin-top-40">
                    <?php if(auth('web')->check()): ?>
                        <a href="<?php echo e(route('user.home')); ?>" class="default-btn color-one"><?php echo e(__('Go to Dashboard')); ?></a>
                    <?php else: ?>
                        <a href="<?php echo e(route('homepage')); ?>" class="default-btn outline-one"><?php echo e(__('Back to Home')); ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="order-completed-area-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="content text-center">
                        <img src="<?php echo e(asset('assets/frontend/img/icon/check-icon.svg')); ?>" alt="icon">
                        <h2 class="page-status-title"><?php echo e(__('Your order is Completed!')); ?></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="order-data">
                        <table>
                            <thead>
                                <tr>
                                    <th><?php echo e(__('order number')); ?></th>
                                    <th><?php echo e(__('date')); ?></th>
                                    <th><?php echo e(__('total')); ?></th>
                                    <th><?php echo e(__('payment method')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>#<?php echo e($payment_details->id); ?></td>
                                    <td><?php echo e($payment_details->created_at->format('d/m/Y')); ?></td>
                                    <td><?php echo e(float_amount_with_currency_symbol($payment_details->total_amount)); ?></td>
                                    <td><?php echo e(str_replace('_', ' ', $payment_details->payment_gateway)); ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="order-complete-wrap">
                        <h4 class="title"><?php echo e(__('order details')); ?></h4>

                        <ul class="order-summery-list">
                            <?php
                                $payment_meta = json_decode($payment_details->payment_meta, true);
                            ?>
                            <li class="single-order-summery border-bottom">
                                <div class="content border-bottom ex">
                                    <span class="subject text-deep"><?php echo e(__('product')); ?></span>
                                    <span class="object text-deep"><?php echo e(__('subtotal')); ?></span>
                                </div>
                                <ul class="internal-order-summery-list">
                                    <?php $__currentLoopData = $order_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order_detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $product = $products->find($order_detail->item_id);
                                        ?>
                                        <?php if($products->find($order_detail->item_id)): ?>
                                            <li class="internal-single-order-summery">
                                                <span class="internal-subject">
                                                    <?php echo e(optional($product)->title); ?> <?php echo e(getItemAttributesName($order_detail['attributes'])); ?>

                                                    <i class="las la-times icon"></i>
                                                    <span class="times text-deep"><?php echo e($order_detail->quantity); ?></span>
                                                </span>
                                                <span class="internal-object">
                                                    <?php echo e(float_amount_with_currency_symbol($order_detail->price * $order_detail->quantity)); ?>

                                                </span>
                                            </li>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </li>
                            <li class="single-order-summery border-bottom">
                                <div class="content">
                                    <span class="subject text-deep"><?php echo e(__('Subtotal')); ?></span>
                                    <span class="object text-deep"><?php echo e(float_amount_with_currency_symbol($payment_meta['subtotal'])); ?></span>
                                </div>
                            </li>
                            <li class="single-order-summery">
                                <div class="content">
                                    <span class="subject text-deep">
                                        <?php echo e(__('coupon discount')); ?>

                                    </span>
                                    <span class="object">
                                        (-) <?php echo e(float_amount_with_currency_symbol($payment_meta['coupon_amount'])); ?>

                                    </span>
                                </div>
                            </li>
                            <li class="single-order-summery">
                                <div class="content">
                                    <span class="subject text-deep"><?php echo e(__('tax')); ?></span>
                                    <span class="object">(+) <?php echo e(float_amount_with_currency_symbol($payment_meta['tax_amount'])); ?></span>
                                </div>
                            </li>
                            <li class="single-order-summery border-bottom">
                                <div class="content">
                                    <span class="subject text-deep"><?php echo e(__('shipping cost')); ?></span>
                                    <span class="object">(+) <?php echo e(float_amount_with_currency_symbol($payment_meta['shipping_cost'])); ?></span>
                                </div>
                            </li>
                            <li class="single-order-summery border-bottom">
                                <div class="content total">
                                    <span class="subject text-deep color-main"><?php echo e(__('total')); ?></span>
                                    <span class="object text-deep color-main"><?php echo e(float_amount_with_currency_symbol($payment_meta['total'])); ?></span>
                                </div>
                            </li>
                            <li class="single-order-summery">
                                <div class="content total">
                                    <span class="subject text-deep"><?php echo e(__('payment method')); ?></span>
                                    <span class="object"><?php echo e(str_replace('_', ' ', render_payment_gateway_name($payment_details->payment_gateway))); ?></span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="btn-wrapper text-right">
                        <a href="<?php echo e(route('homepage')); ?>" class="btn-default rounded-btn semi-bold"><?php echo e(__('back to home')); ?></a>
                        <a href="<?php echo e(route('frontend.products.download-invoice',["id" => $payment_details->id])); ?>" class="btn-default rounded-btn semi-bold">download invoice</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.frontend-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mobidvab/public_html/core/resources/views/frontend/payment/payment-success.blade.php ENDPATH**/ ?>