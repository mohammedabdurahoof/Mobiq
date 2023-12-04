
<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Product Inventory')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.niceselect.css','data' => []]); ?>
<?php $component->withName('niceselect.css'); ?>
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
<?php $__env->startSection('content'); ?>
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                <div class="card my-5">
                    <div class="card-body">
                        <h4 class="mb-5"><?php echo e(__('Create Order')); ?></h4>

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

                        <form action="<?php echo e(route('admin.product.order.new')); ?>" id="order_form" method="POST">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="country"><?php echo e(__('Country')); ?></label>
                                    <select class="form-control" name="country" id="country">
                                        <option value=""><?php echo e(__('Select Country')); ?></option>
                                        <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($country->id); ?>"><?php echo e($country->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="form-group col-lg-6 col-6">
                                    <label for="state"><?php echo e(__('State')); ?></label>
                                    <select class="form-control" id="state" name="state">
                                        <option value=""><?php echo e(__('Select State')); ?></option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="state"><?php echo e(__('User')); ?></label>
                                    <select id="user_id" name="user_id" class="form-control nice-select wide">
                                        <option value=""><?php echo e(__('Select User')); ?></option>
                                        <?php $__currentLoopData = $all_users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($user->id); ?>" 
                                                data-name="<?php echo e($user->name); ?>"
                                                data-email="<?php echo e($user->email); ?>"
                                                data-phone="<?php echo e($user->phone); ?>"
                                                data-address="<?php echo e($user->address); ?>"
                                                data-country="<?php echo e($user->country); ?>"
                                                data-state="<?php echo e($user->state); ?>"
                                                data-city="<?php echo e($user->city); ?>"
                                                data-zipcode="<?php echo e($user->zipcode); ?>"
                                            ><?php echo e($user->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="form-group col-6">
                                    <label for="f-name"><?php echo e(__('Full name')); ?></label>
                                    <input class="form-control" type="text" id="name" name="name">
                                </div>
                                <div class="form-group col-6">
                                    <label for="email"><?php echo e(__('Email')); ?></label>
                                    <input class="form-control" type="email" id="email" name="email">
                                </div>
                                <div class="form-group col-lg-6 col-6">
                                    <label for="address_phone"><?php echo e(__('Phone')); ?></label>
                                    <input class="form-control" type="text" id="phone" name="phone" />
                                </div>
                                <div class="form-group col-12">
                                    <label for="address"><?php echo e(__('Address')); ?></label>
                                    <input class="form-control" type="text" id="address" name="address">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="address_03"><?php echo e(__('City/Town')); ?></label>
                                    <input class="form-control" type="text" id="city" name="city" >
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="address_zip_ship_2"><?php echo e(__('Zip Code')); ?></label>
                                    <input class="form-control" type="text" id="zipcode" name="zipcode" />
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="payment_gateway"><?php echo e(__('Payment Gateway')); ?></label>
                                    <select name="payment_gateway" class="form-control" >
                                        <option value=""><?php echo e(__('Select Shipping Method')); ?></option>
                                        <?php
                                            $all_gateways = ['paypal','manual_payment','mollie','paytm','stripe','razorpay','flutterwave','paystack','bank_transfer'];
                                        ?>
                                        <?php $__currentLoopData = $all_gateways; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gateway): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($gateway); ?>" <?php if(get_static_option('site_default_payment_gateway') == $gateway): ?> selected <?php endif; ?>><?php echo e(ucwords(str_replace('_',' ',$gateway))); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="user_shipping"><?php echo e(__('User Saved Shipping Address')); ?></label>
                                    <select class="form-control" name="shipping_address_id" id="shipping_address_id">
                                        <option value=""><?php echo e(__('Select Shipping Address')); ?></option>
                                        <?php $__currentLoopData = $user_shipping_address; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shippingAddress): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($shippingAddress->id); ?>"><?php echo e($shippingAddress->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="status"><?php echo e(__('Status')); ?></label>
                                    <select name="status" id="status"  class="form-control">
                                        <option value="pending"><?php echo e(__('Pending')); ?></option>
                                        <option value="in_progress"><?php echo e(__('In Progress')); ?></option>
                                        <option value="shipped"><?php echo e(__('Shipped')); ?></option>
                                        <option value="cancel"><?php echo e(__('Cancel')); ?></option>
                                        <option value="complete"><?php echo e(__('Complete')); ?></option>
                                    </select>
                                </div>
                                <div class="form-group col-12">
                                    <label for="order_note"><?php echo e(__('Order Note')); ?></label>
                                    <textarea class="form-control" id="order_note" name="order_note" rows="3"></textarea>
                                </div>
                                <div class="form-group col-lg-5">
                                    <label for="products"><?php echo e(__('Products')); ?></label>
                                    <select id="all_products" class="form-control nice-select wide">
                                        <?php $__currentLoopData = $all_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($product->id); ?>" data-attributes="<?php echo e($product->attributes); ?>"><?php echo e($product->title); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="col-lg-12" id="product_container">
                                    <h5 class="mb-3"><?php echo e(__('Cart Products')); ?></h5>
                                    <div class="table-wrap">
                                        <table class="table table-default">
                                            <thead>
                                                <tr>
                                                    <th><?php echo e(__('Image')); ?></th>
                                                    <th><?php echo e(__('Product Name')); ?></th>
                                                    <th><?php echo e(__('Quantity')); ?></th>
                                                    <th><?php echo e(__('Price')); ?></th>
                                                    <th><?php echo e(__('Action')); ?></th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="text-center col-12 my-4">
                                    <button class="btn btn-primary px-5" id="order_form_submit_btn"><?php echo e(__('Create Order')); ?></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.niceselect.js','data' => []]); ?>
<?php $component->withName('niceselect.js'); ?>
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
(function ($) {
    let count = 0;
    $(document).ready(function($) {
        if ($('.nice-select').length) {
            $('.nice-select').niceSelect();
        }

        $('#country').on('change', function() {
            let id = $(this).val();
            $.get('<?php echo e(route('country.info.ajax')); ?>', {
                id: id
            }).then(function(data) {
                let options = '<option value=""><?php echo e(__('Select State')); ?></option>';
                data.states.map(function(e) {
                    options += '<option value="' + e.id + '">' + e.name +
                        '</option>';
                });
                $('#state').html(options);
                $('#tax_amount').text(site_currency_symbol + Number(data.tax).toFixed(2));
                calculateTotal();
            });
        });

        $('#state').on('change', function() {
            let id = $(this).val();
            $.get('<?php echo e(route('state.info.ajax')); ?>', {
                id: id
            }).then(function(data) {
                $('#tax_amount').text(site_currency_symbol + Number(data.tax).toFixed(
                    2));
                calculateTotal();
            });
        });

        $('#user_id').on('change', function () {
            let user_data = $(this).find('option:checked').data();

            $('#name').val(user_data['name']);
            $('#email').val(user_data['email']);
            $('#email').val(user_data['email']);
            $('#phone').val(user_data['phone']);
            $('#address').val(user_data['address']);
            $('#country').val(user_data['country']);
            $('#city').val(user_data['city']);
            $('#zipcode').val(user_data['zipcode']);
        });

        $('#all_products').on('change', function () {
            let container = $('#product_container');
            let id = $(this).find('option:checked').val();

            count += 1;

            $.get('<?php echo e(route("admin.product.order.product.row")); ?>', {
                id: id,
                count: count
            }).then(function (data) {
                $('#product_container table tbody').append(data);
            });
        });

        $('#order_form_submit_btn').on('click', function (e) {
            e.preventDefault();

            let available_attributes = $('.product_row .product_name .product_attribute_list').length
            let selected_attribute = $('.product_row .product_name .product_attribute_list input:checked').length

            if (available_attributes != selected_attribute) {
                toastr.error('<?php echo e(__("Select all product attributes to proceed.")); ?>');
            } else {
                $('#order_form').trigger('submit');
            }
        })

        $(document).on('click', '.delete_order_product', function () {
            $(this).closest('tr').remove();
        });
    });
})(jQuery)
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mobiq\core\resources\views/backend/products/order/new.blade.php ENDPATH**/ ?>