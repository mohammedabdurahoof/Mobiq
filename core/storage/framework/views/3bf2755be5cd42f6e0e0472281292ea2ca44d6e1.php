
<?php $__env->startSection('style'); ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.media.css','data' => []]); ?>
<?php $component->withName('media.css'); ?>
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
    <?php echo e(__('Checkout Page Settings')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('page-settings-checkout-page')): ?>
        <div class="col-lg-12 col-ml-12 padding-bottom-30">
            <div class="row">
                <div class="col-lg-12">
                    <div class="margin-top-40"></div>
                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.msg.success','data' => []]); ?>
<?php $component->withName('msg.success'); ?>
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
                </div>
                <div class="col-lg-12 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title"><?php echo e(__('Checkout Page Settings')); ?></h4>
                            <form action="<?php echo e(route('admin.page.settings.checkout')); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <h6 class="mt-5 mb-3"><?php echo e(__('Empty checkout page')); ?></h6>
                                <div class="form-group">
                                    <label for="checkout_page_no_product_text"><?php echo e(__('Checkout page no product text')); ?></label>
                                    <input type="text" class="form-control" id="checkout_page_no_product_text"
                                           name="checkout_page_no_product_text"
                                           value="<?php echo e(get_static_option('checkout_page_no_product_text')); ?>">
                                </div>

                                <h6 class="mt-5 mb-3"><?php echo e(__('Login Section')); ?></h6>
                                <div class="form-group">
                                    <label for="returning_customer_text"><?php echo e(__('Returning customer text')); ?></label>
                                    <input type="text" class="form-control" id="returning_customer_text"
                                           name="returning_customer_text"
                                           value="<?php echo e(get_static_option('returning_customer_text')); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="toggle_login_text"><?php echo e(__('Toggle login text')); ?></label>
                                    <input type="text" class="form-control" id="toggle_login_text"
                                           name="toggle_login_text"
                                           value="<?php echo e(get_static_option('toggle_login_text')); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="checkout_username"><?php echo e(__('Checkout username')); ?></label>
                                    <input type="text" class="form-control" id="checkout_username"
                                           name="checkout_username"
                                           value="<?php echo e(get_static_option('checkout_username')); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="checkout_password"><?php echo e(__('Checkout password')); ?></label>
                                    <input type="text" class="form-control" id="checkout_password"
                                           name="checkout_password"
                                           value="<?php echo e(get_static_option('checkout_password')); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="checkout_remember_text"><?php echo e(__('Checkout remember text')); ?></label>
                                    <input type="text" class="form-control" id="checkout_remember_text"
                                           name="checkout_remember_text"
                                           value="<?php echo e(get_static_option('checkout_remember_text')); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="checkout_forgot_password"><?php echo e(__('Checkout forgot password')); ?></label>
                                    <input type="text" class="form-control" id="checkout_forgot_password"
                                           name="checkout_forgot_password"
                                           value="<?php echo e(get_static_option('checkout_forgot_password')); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="checkout_login_btn_text"><?php echo e(__('Checkout login button text')); ?></label>
                                    <input type="text" class="form-control" id="checkout_login_btn_text"
                                           name="checkout_login_btn_text"
                                           value="<?php echo e(get_static_option('checkout_login_btn_text')); ?>">
                                </div>

                                <h6 class="mt-5 mb-3"><?php echo e(__('Coupon Section')); ?></h6>
                                <div class="form-group">
                                    <label for="have_coupon_text"><?php echo e(__('Have coupon text')); ?></label>
                                    <input type="text" class="form-control" id="have_coupon_text"
                                           name="have_coupon_text" value="<?php echo e(get_static_option('have_coupon_text')); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="enter_coupon_text"><?php echo e(__('Enter coupon text')); ?></label>
                                    <input type="text" class="form-control" id="enter_coupon_text"
                                           name="enter_coupon_text"
                                           value="<?php echo e(get_static_option('enter_coupon_text')); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="coupon_placeholder"><?php echo e(__('Coupon placeholder')); ?></label>
                                    <input type="text" class="form-control" id="coupon_placeholder"
                                           name="coupon_placeholder"
                                           value="<?php echo e(get_static_option('coupon_placeholder')); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="apply_coupon_btn_text"><?php echo e(__('Apply coupon button text')); ?></label>
                                    <input type="text" class="form-control" id="apply_coupon_btn_text"
                                           name="apply_coupon_btn_text"
                                           value="<?php echo e(get_static_option('apply_coupon_btn_text')); ?>">
                                </div>

                                <h6 class="mt-5 mb-3"><?php echo e(__('Billing Info Section')); ?></h6>
                                <div class="form-group">
                                    <label for="checkout_billing_section_title"><?php echo e(__('Checkout billing title')); ?></label>
                                    <input type="text" class="form-control" id="checkout_billing_section_title"
                                           name="checkout_billing_section_title"
                                           value="<?php echo e(get_static_option('checkout_billing_section_title')); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="checkout_billing_city"><?php echo e(__('Checkout billing city')); ?></label>
                                    <input type="text" class="form-control" id="checkout_billing_city"
                                           name="checkout_billing_city"
                                           value="<?php echo e(get_static_option('checkout_billing_city')); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="checkout_billing_zipcode"><?php echo e(__('Checkout billing zipcode')); ?></label>
                                    <input type="text" class="form-control" id="checkout_billing_zipcode"
                                           name="checkout_billing_zipcode"
                                           value="<?php echo e(get_static_option('checkout_billing_zipcode')); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="checkout_billing_address"><?php echo e(__('Checkout billing address')); ?></label>
                                    <input type="text" class="form-control" id="checkout_billing_address"
                                           name="checkout_billing_address"
                                           value="<?php echo e(get_static_option('checkout_billing_address')); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="checkout_billing_email"><?php echo e(__('Checkout billing email')); ?></label>
                                    <input type="text" class="form-control" id="checkout_billing_email"
                                           name="checkout_billing_email"
                                           value="<?php echo e(get_static_option('checkout_billing_email')); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="checkout_billing_phone"><?php echo e(__('Checkout billing phone')); ?></label>
                                    <input type="text" class="form-control" id="checkout_billing_phone"
                                           name="checkout_billing_phone"
                                           value="<?php echo e(get_static_option('checkout_billing_phone')); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="checkout_order_note"><?php echo e(__('Checkout order note')); ?></label>
                                    <input type="text" class="form-control" id="checkout_order_note"
                                           name="checkout_order_note"
                                           value="<?php echo e(get_static_option('checkout_order_note')); ?>">
                                </div>

                                <h6 class="mt-5 mb-3"><?php echo e(__('Create Account Section')); ?></h6>
                                <div class="form-group">
                                    <label for="create_account_text"><?php echo e(__('Create account text')); ?></label>
                                    <input type="text" class="form-control" id="create_account_text"
                                           name="create_account_text"
                                           value="<?php echo e(get_static_option('create_account_text')); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="create_account_username"><?php echo e(__('Create account username')); ?></label>
                                    <input type="text" class="form-control" id="create_account_username"
                                           name="create_account_username"
                                           value="<?php echo e(get_static_option('create_account_username')); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="create_account_password"><?php echo e(__('Create account password')); ?></label>
                                    <input type="text" class="form-control" id="create_account_password"
                                           name="create_account_password"
                                           value="<?php echo e(get_static_option('create_account_password')); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="create_account_confirmed_password"><?php echo e(__('Create account confirmed password')); ?></label>
                                    <input type="text" class="form-control" id="create_account_confirmed_password"
                                           name="create_account_confirmed_password"
                                           value="<?php echo e(get_static_option('create_account_confirmed_password')); ?>">
                                </div>

                                <h6 class="mt-5 mb-3"><?php echo e(__('Shipping Address Section')); ?></h6>
                                <div class="form-group">
                                    <label for="ship_to_another_text"><?php echo e(__('Ship to another text')); ?></label>
                                    <input type="text" class="form-control" id="ship_to_another_text"
                                           name="ship_to_another_text"
                                           value="<?php echo e(get_static_option('ship_to_another_text')); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="shipping_name"><?php echo e(__('Shipping name')); ?></label>
                                    <input type="text" class="form-control" id="shipping_name" name="shipping_name"
                                           value="<?php echo e(get_static_option('shipping_name')); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="shipping_country"><?php echo e(__('Shipping country')); ?></label>
                                    <input type="text" class="form-control" id="shipping_country"
                                           name="shipping_country" value="<?php echo e(get_static_option('shipping_country')); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="shipping_state"><?php echo e(__('Shipping state')); ?></label>
                                    <input type="text" class="form-control" id="shipping_state" name="shipping_state"
                                           value="<?php echo e(get_static_option('shipping_state')); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="shipping_city"><?php echo e(__('Shipping city')); ?></label>
                                    <input type="text" class="form-control" id="shipping_city" name="shipping_city"
                                           value="<?php echo e(get_static_option('shipping_city')); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="shipping_zipcode"><?php echo e(__('Shipping zipcode')); ?></label>
                                    <input type="text" class="form-control" id="shipping_zipcode"
                                           name="shipping_zipcode" value="<?php echo e(get_static_option('shipping_zipcode')); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="shipping_address"><?php echo e(__('Shipping address')); ?></label>
                                    <input type="text" class="form-control" id="shipping_address"
                                           name="shipping_address" value="<?php echo e(get_static_option('shipping_address')); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="shipping_email"><?php echo e(__('Shipping email')); ?></label>
                                    <input type="text" class="form-control" id="shipping_email" name="shipping_email"
                                           value="<?php echo e(get_static_option('shipping_email')); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="shipping_phone"><?php echo e(__('Shipping phone')); ?></label>
                                    <input type="text" class="form-control" id="shipping_phone" name="shipping_phone"
                                           value="<?php echo e(get_static_option('shipping_phone')); ?>">
                                </div>

                                <h6 class="mt-5 mb-3"><?php echo e(__('Order Summary Section')); ?></h6>
                                <div class="form-group">
                                    <label for="order_summary_title"><?php echo e(__('Order summary title')); ?></label>
                                    <input type="text" class="form-control" id="order_summary_title"
                                           name="order_summary_title"
                                           value="<?php echo e(get_static_option('order_summary_title')); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="subtotal_text"><?php echo e(__('Subtotal text')); ?></label>
                                    <input type="text" class="form-control" id="subtotal_text" name="subtotal_text"
                                           value="<?php echo e(get_static_option('subtotal_text')); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="discount_text"><?php echo e(__('Discount text')); ?></label>
                                    <input type="text" class="form-control" id="discount_text" name="discount_text"
                                           value="<?php echo e(get_static_option('discount_text')); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="vat_text"><?php echo e(__('VAT text')); ?></label>
                                    <input type="text" class="form-control" id="vat_text" name="vat_text"
                                           value="<?php echo e(get_static_option('vat_text')); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="shipping_text"><?php echo e(__('Shipping text')); ?></label>
                                    <input type="text" class="form-control" id="shipping_text" name="shipping_text"
                                           value="<?php echo e(get_static_option('shipping_text')); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="total_text"><?php echo e(__('Total text')); ?></label>
                                    <input type="text" class="form-control" id="total_text" name="total_text"
                                           value="<?php echo e(get_static_option('total_text')); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="checkout_place_order"><?php echo e(__('Checkout place order')); ?></label>
                                    <input type="text" class="form-control" id="checkout_place_order"
                                           name="checkout_place_order"
                                           value="<?php echo e(get_static_option('checkout_place_order')); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="checkout_return_cart"><?php echo e(__('Checkout return cart')); ?></label>
                                    <input type="text" class="form-control" id="checkout_return_cart"
                                           name="checkout_return_cart"
                                           value="<?php echo e(get_static_option('checkout_return_cart')); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="checkout_page_terms_text"><?php echo e(__('Checkout page terms text')); ?></label>
                                    <input type="text" class="form-control" id="checkout_page_terms_text"
                                           name="checkout_page_terms_text"
                                           value="<?php echo e(get_static_option('checkout_page_terms_text')); ?>">
                                    <small><?php echo e(__('Embrace the part of text you want to make a link with ')); ?>

                                        <b>[lnk]</b> <?php echo e(__(' and ')); ?> <b>[/lnk]</b>.</small>
                                    <small><?php echo __('For example: I have read and agree to the Website <b>[lnk]</b>terms & conditions<b>[/lnk]</b>.'); ?></small>
                                </div>
                                <div class="form-group">
                                    <label for="checkout_page_terms_link_url"><?php echo e(__('Checkout page terms link url')); ?></label>
                                    <select name="checkout_page_terms_link_url" id="checkout_page_terms_link_url"
                                            class="form-control">
                                        <?php $__currentLoopData = $all_pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($page->slug); ?>"
                                                    <?php if($page->slug == get_static_option('checkout_page_terms_link_url')): ?> selected <?php endif; ?>><?php echo e($page->title); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>

                                <button class="btn btn-primary mt-5 px-5"><?php echo e(__('Update Settings')); ?></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.media.markup','data' => []]); ?>
<?php $component->withName('media.markup'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.media.js','data' => []]); ?>
<?php $component->withName('media.js'); ?>
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

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mobidvab/public_html/core/resources/views/backend/settings/checkout.blade.php ENDPATH**/ ?>