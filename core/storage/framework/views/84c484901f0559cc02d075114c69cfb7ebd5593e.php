<div class="row">
    <div class="form-group col-lg-12 col-12">
        <label><?php echo e('Name'); ?> <span class="text-danger">*</span></label>
        <input type="text" id="f-name" name="name" value="<?php echo e(old('name') ?? $user->name ?? ''); ?>" placeholder="Full Name">
    </div>
    <div class="form-group col-lg-6 col-12">
        <label><?php echo e('Country'); ?> <span class="text-danger">*</span></label>
        <select name="country" id="country">
            <option value=""><?php echo e(__('Select Country')); ?></option>
            <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($country->id); ?>" <?php if(isset($user) && isset($user->country) && $user->country == $country->id): ?> selected <?php endif; ?> >
                    <?php echo e($country->name); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
    <div class="form-group col-lg-6 col-12">
        <label><?php echo e('State'); ?> <span class="text-danger">*</span></label>
        <select id="state" name="state">
            <option value=""><?php echo e(__('Select State')); ?></option>
            <?php if(isset($user) && isset($user->country)): ?>
                <?php
                    $states = \App\Country\State::select('id', 'name')->where('country_id', $user->country)->get();
                ?>
                <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($state->id); ?>" <?php if($user->state == $state->id): ?> selected <?php endif; ?>><?php echo e($state->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </select>
    </div>
    <div class="form-group col-lg-6 col-12">
        <label><?php echo e('City'); ?> <span class="text-danger">*</span></label>
        <input type="text" id="city" name="city" value="<?php echo e(old('city') ?? $user->city ?? ''); ?>" placeholder="<?php echo e(filter_static_option_value('checkout_billing_city', $setting_text,  __('City'))); ?>">
    </div>
    <div class="form-group col-lg-6 col-12">
        <label><?php echo e('Zipcode'); ?> <span class="text-danger">*</span></label>
        <input type="text" id="zipcode" name="zipcode" value="<?php echo e(old('zipcode') ?? $user->zipcode ?? ''); ?>" placeholder="<?php echo e(filter_static_option_value('checkout_billing_zipcode', $setting_text, __('Zip Code'))); ?>">
    </div>
    <div class="form-group col-12">
         <label><?php echo e('Adress'); ?> <span class="text-danger">*</span></label>
        <input type="text" id="address" name="address" value="<?php echo e(old('address') ?? $user->address ?? ''); ?>" placeholder="<?php echo e(filter_static_option_value('checkout_billing_address', $setting_text,  __('Address'))); ?>">
    </div>
    <div class="form-group col-lg-6 col-12">
         <label><?php echo e('Email'); ?> <span class="text-danger">*</span></label>
        <input type="email" id="email" autocomplete="off" name="email" value="<?php echo e(old('email') ?? $user->email ?? ''); ?>" placeholder="<?php echo e(filter_static_option_value('checkout_billing_email', $setting_text, __('Email Address'))); ?>">
    </div>
    <div class="form-group col-lg-6 col-12">
         <label><?php echo e('Phone'); ?> <span class="text-danger">*</span></label>
        <input type="text" id="phone" name="phone" value="<?php echo e(old('phone') ?? $user->phone ?? ''); ?>" placeholder="<?php echo e(filter_static_option_value('checkout_billing_phone', $setting_text, __('Phone Number'))); ?>">
    </div>
</div>
<div class="row">
    <div class="form-group col-12">
         <label><?php echo e('Order Note'); ?></label>
        <textarea class="form-control" name="order_note" id="order_note" rows="3" value="<?php echo e(old('order_note') ?? $user->order_note ?? ''); ?>" placeholder="<?php echo e(filter_static_option_value('checkout_order_note', $setting_text, __('Order Note'))); ?>"></textarea>
    </div>
</div>
<?php /**PATH /home/mobidvab/public_html/core/resources/views/frontend/cart/partials/billing-info.blade.php ENDPATH**/ ?>