
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
    <style>
        .max-width-100 {
            max-width: 100px;
        }
        
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('My Orders')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('section'); ?>
    <div class="form-header-wrap margin-bottom-50 d-flex justify-content-between">
        <h3 class="mb-3"><?php echo e(__('Order Details')); ?></h3>
    </div>
    <div class="row">
        <div class="col-md-12">
            <ul>
                <li><b><?php echo e(__('Order Id:')); ?></b> #<?php echo e($item->id); ?></li>
                <li><b><?php echo e(__('Payment Method:')); ?></b> <?php echo e(ucwords(str_replace('_', ' ', render_payment_gateway_name($item->payment_gateway)))); ?></li>
                <li><b><?php echo e(__('Payment Status:')); ?></b> <?php echo e(ucwords($item->payment_status)); ?></li>
                <li><b><?php echo e(__('Order Status:')); ?></b> <?php echo e(ucwords($item->status)); ?></li>
                <li><b><?php echo e(__('Transaction ID:')); ?></b> <?php echo e($item->transaction_id); ?></li>
            </ul>
        </div>
         <div class="row">
            <div class="col-lg-12">
                <div class="btn-wrapper text-right my-2">
                    <a href="<?php echo e(route('frontend.products.download-invoice',["id" => $item->id])); ?>" class="btn-default rounded-btn semi-bold">download invoice</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-12 my-5">
            <h3 class="mb-3"><?php echo e(__('Ordered Products')); ?></h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th><?php echo e(__('Image')); ?></th>
                        <th><?php echo e(__('Name')); ?></th>
                        <th><?php echo e(__('Quantity')); ?></th>
                        <th><?php echo e(__('Price')); ?></th>
                        <th><?php echo e(__('Total')); ?></th>
                    </tr>
                </thead>
                <?php $cart_items = json_decode($item->order_details, true); ?>
                <tbody>
                    <?php $__currentLoopData = $cart_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $product = \Modules\Product\Entities\Product::withTrashed()->find($id); 
                            if(is_null($product)){
                                continue;
                            }
                        ?>
                        
                        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart_item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.table.td-image','data' => ['image' => $product->image]]); ?>
<?php $component->withName('table.td-image'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['image' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product->image)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                            <td>
                                <a class="text" href="<?php echo e(route("frontend.products.single", $product->slug)); ?>">
                                    <?php echo e($product->title); ?> <?php echo e(getItemAttributesName($cart_item['attributes'])); ?>

                                </a>

                                <?php if($item->status == 'complete'): ?>
                                    <br>
                                    <b class="mb-2 mt-1 d-inline-block"><?php echo e(__("Now you're eligible to make a review")); ?></b>
                                    <br>
                                    <a class="btn btn-sm btn-info" href="<?php echo e(route("frontend.products.single", $product->slug)); ?>">
                                        <?php echo e(__("Please give us your feedback")); ?>

                                    </a>
                                <?php endif; ?>
                            </td>
                            <td><?php echo e($cart_item['quantity'] ?? 0); ?></td>
                            <?php
                                $price = $cart_item['attributes']['price'] ?? $product->sale_price;
                            ?>
                            <td><?php echo e(float_amount_with_currency_symbol($price)); ?></td>
                            <td>
                                <?php echo e(float_amount_with_currency_symbol($cart_item['quantity'] * $price)); ?>

                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
        <div class="col-md-6 my-2">
            <h3 class="mb-3"><?php echo e(__('Order Summary')); ?></h3>
            <?php
                $payment_meta = json_decode($item->payment_meta,true);
            ?>
            
            <table class="table table-bordered">
                <tbody>
                    <?php if($item->coupon): ?>
                        <tr>
                            <th><?php echo e(__('Coupon')); ?></th>
                            <td><?php echo e(float_amount_with_currency_symbol($item->coupon)); ?></td>
                        </tr>
                    <?php endif; ?>
                    <?php if($item->coupon_discounted): ?>
                        <tr>
                            <th><?php echo e(__('Coupon Discount')); ?></th>
                            <td><?php echo e(float_amount_with_currency_symbol($item->coupon_discounted)); ?></td>
                        </tr>
                    <?php endif; ?>
                    <tr>
                        <th><?php echo e(__('Tax')); ?></th>
                        <td>(+) <?php echo e(float_amount_with_currency_symbol($payment_meta['tax_amount'])); ?></td>
                    </tr>
                   <tr>
                        <th><?php echo e(__('Shipping cost')); ?></th>
                        <td>(+) <?php echo e(float_amount_with_currency_symbol($payment_meta['shipping_cost'])); ?></td>
                    </tr>
                    <tr>
                        <th><?php echo e(__('Total Amount')); ?></th>
                        <td><?php echo e(float_amount_with_currency_symbol($item->total_amount)); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('assets/backend/js/sweetalert2.js')); ?>"></script>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.user.dashboard.user-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mobiq\core\resources\views/frontend/user/dashboard/order/details.blade.php ENDPATH**/ ?>