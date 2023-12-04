<div class="coupon-wrapper">
    <div class="coupon-title-wrap" id="coupon">
        <p class="query">
            <?php echo filter_static_option_value('have_coupon_text', $setting_text, __('Have a coupon?')); ?>

            <span class="click"><?php echo filter_static_option_value('enter_coupon_text', $setting_text, __('Click here to enter your code')); ?></span>
        </p>
    </div>
    <div class="coupon-content" <?php if(!isset(request()->coupon)): ?> style="display: none;" <?php endif; ?>>
        <div class="search-form">
            <form action="<?php echo e(route('frontend.checkout.apply.coupon')); ?>" class="discount-coupon">
                <div class="form-group">
                    <input type="text"
                           class="form-control"
                           placeholder="<?php echo filter_static_option_value('coupon_placeholder', $setting_text, __('Enter your coupon code')); ?>"
                           name="coupon"
                           value="<?php echo e(old('coupon') ?? request()->coupon); ?>"
                    >
                </div>

                <button class="search-btn coupon-btn" type="submit"><?php echo filter_static_option_value('apply_coupon_btn_text', $setting_text, __('apply coupon')); ?></button>
            </form>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\mobiq\core\resources\views/frontend/cart/partials/coupon.blade.php ENDPATH**/ ?>