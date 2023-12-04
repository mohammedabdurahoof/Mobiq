<input type="hidden" name="shipping_address_id" id="shipping_address_id">
<div class="row">
    <div class="ship-to-another-address-wrap container">
        <div class="ship-title-wrap">
            <div class="row">
                <div class="form-group form-check col-12">
                    <input type="checkbox" class="form-check-input" id="ship">
                    <label class="form-check-label label-1" for="ship">
                        <?php echo filter_static_option_value('ship_to_another_text', $setting_text, __('Ship to another address?')); ?>

                    </label>
                </div>
            </div>
        </div>
        <div class="ship-another-address-content" style="display: none;">
            <?php if($all_user_shipping): ?>
                <?php echo $__env->make('frontend.cart.checkout-user-shipping', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
            <div class="row">
                <div class="form-group col-lg-12 col-12">
                    <input type="text" id="shipping_name" name="shipping_name" placeholder="<?php echo e(filter_static_option_value('shipping_name', $setting_text, __('Name'))); ?>">
                </div>
                <div class="form-group col-lg-6 col-12">
                    <select id="shipping_country" name="shipping_country">
                        <option value="" selected="" disabled=""><?php echo e(filter_static_option_value('shipping_country', $setting_text, __('Country'))); ?></option>
                        <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($country->id); ?>"><?php echo e($country->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="form-group col-lg-6 col-12">
                    <select id="shipping_state" name="shipping_state">
                        <option value="" selected="" disabled=""><?php echo e(filter_static_option_value('shipping_state', $setting_text, __('Select State'))); ?></option>
                    </select>
                </div>
                <div class="form-group col-lg-6 col-12">
                    <input type="text" id="shipping_city" value="" name="shipping_city" placeholder="<?php echo e(filter_static_option_value('shipping_city', $setting_text, __('City'))); ?>">
                </div>
                <div class="form-group col-lg-6 col-12">
                    <input type="text" id="shipping_zipcode" name="shipping_zipcode" placeholder="<?php echo e(filter_static_option_value('shipping_zipcode', $setting_text, __('Zip Code'))); ?>">
                </div>
                <div class="form-group col-12">
                    <label for="address_01"><?php echo e(filter_static_option_value('shipping_address', $setting_text, __('Address'))); ?></label>
                    <input type="text" id="shipping_address" name="shipping_address" value="">
                </div>
                <div class="form-group col-lg-6 col-12">
                    <input type="email" id="shipping_email" name="shipping_email" placeholder="<?php echo e(filter_static_option_value('shipping_email', $setting_text, __('Email Address'))); ?>">
                </div>
                <div class="form-group col-lg-6 col-12">
                    <input type="text" id="shipping_phone" name="shipping_phone" placeholder="<?php echo e(filter_static_option_value('shipping_phone', $setting_text, __('Phone Number'))); ?>">
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /home/mobidvab/public_html/core/resources/views/frontend/cart/partials/shipping-address.blade.php ENDPATH**/ ?>