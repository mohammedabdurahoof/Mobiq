<?php if($all_user_shipping): ?>
    <?php $__currentLoopData = $all_user_shipping; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user_shipping): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-12 px-0">
            <div class="card mb-3 user_shipping_address"
                 data-id="<?php echo e($user_shipping->id); ?>"
                 data-name="<?php echo e($user_shipping->name); ?>"
                 data-phone="<?php echo e($user_shipping->phone); ?>"
                 data-email="<?php echo e($user_shipping->email); ?>"
                 data-address="<?php echo e($user_shipping->address); ?>"
                 data-country_id="<?php echo e($user_shipping->country_id); ?>"
                 data-state_id="<?php echo e($user_shipping->state_id); ?>"
                 data-city="<?php echo e($user_shipping->city); ?>"
                 data-zip_code="<?php echo e($user_shipping->zip_code); ?>"
            >
                <div class="card-body">
                    <div class="h5"><?php echo e($user_shipping->name); ?></div>
                    <p><?php echo e(Str::limit($user_shipping->address, 20)); ?></p>
                </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
<?php /**PATH /home/mobidvab/public_html/core/resources/views/frontend/cart/checkout-user-shipping.blade.php ENDPATH**/ ?>