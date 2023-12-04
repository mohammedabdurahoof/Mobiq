
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
    <?php echo e(__('Cart Page Settings')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('page-settings-cart-page')): ?>
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
                            <h4 class="header-title"><?php echo e(__('Cart Page Settings')); ?></h4>
                            <form action="<?php echo e(route('admin.page.settings.cart')); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <div class="form-group">
                                    <label for="empty_cart_text"><?php echo e(__('Empty Cart Text')); ?></label>
                                    <input type="text" class="form-control" id="empty_cart_text" name="empty_cart_text"
                                           value="<?php echo e(get_static_option('empty_cart_text')); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="back_to_home_text"><?php echo e(__('Back to Home Text')); ?></label>
                                    <input type="text" class="form-control" id="back_to_home_text"
                                           name="back_to_home_text"
                                           value="<?php echo e(get_static_option('back_to_home_text')); ?>">
                                </div>
                                <div class="form-group">
                                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.media-upload','data' => ['id' => get_static_option('empty_cart_image'),'name' => 'empty_cart_image','dimentions' => '465X465','title' => __('Empty Cart Image')]]); ?>
<?php $component->withName('media-upload'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(get_static_option('empty_cart_image')),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('empty_cart_image'),'dimentions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('465X465'),'title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Empty Cart Image'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <label for="clear_cart_text"><?php echo e(__('Clear Cart Button Text')); ?></label>
                                    <input type="text" class="form-control" id="clear_cart_text" name="clear_cart_text"
                                           value="<?php echo e(get_static_option('clear_cart_text')); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="update_cart_text"><?php echo e(__('Update Cart Button Text')); ?></label>
                                    <input type="text" class="form-control" id="update_cart_text"
                                           name="update_cart_text" value="<?php echo e(get_static_option('update_cart_text')); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="cart_continue_shopping_text"><?php echo e(__('Continue Shopping Button Text')); ?></label>
                                    <input type="text" class="form-control" id="cart_continue_shopping_text"
                                           name="cart_continue_shopping_text"
                                           value="<?php echo e(get_static_option('cart_continue_shopping_text')); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="cart_coupon_discount_title"><?php echo e(__('Coupon Discount Title')); ?></label>
                                    <input type="text" class="form-control" id="cart_coupon_discount_title"
                                           name="cart_coupon_discount_title"
                                           value="<?php echo e(get_static_option('cart_coupon_discount_title')); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="cart_coupon_discount_subtitle"><?php echo e(__('Coupon Discount Subtitle')); ?></label>
                                    <input type="text" class="form-control" id="cart_coupon_discount_subtitle"
                                           name="cart_coupon_discount_subtitle"
                                           value="<?php echo e(get_static_option('cart_coupon_discount_subtitle')); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="cart_coupon_discount_placeholder"><?php echo e(__('Coupon Discount Placeholder')); ?></label>
                                    <input type="text" class="form-control" id="cart_coupon_discount_placeholder"
                                           name="cart_coupon_discount_placeholder"
                                           value="<?php echo e(get_static_option('cart_coupon_discount_placeholder')); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="cart_apply_coupon_text"><?php echo e(__('Apply Coupon Button Text')); ?></label>
                                    <input type="text" class="form-control" id="cart_apply_coupon_text"
                                           name="cart_apply_coupon_text"
                                           value="<?php echo e(get_static_option('cart_apply_coupon_text')); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="cart_total_title"><?php echo e(__('Cart Total Title')); ?></label>
                                    <input type="text" class="form-control" id="cart_total_title"
                                           name="cart_total_title" value="<?php echo e(get_static_option('cart_total_title')); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="cart_proceed_to_checkout_text"><?php echo e(__('Proceed to Checkout Button Text')); ?></label>
                                    <input type="text" class="form-control" id="cart_proceed_to_checkout_text"
                                           name="cart_proceed_to_checkout_text"
                                           value="<?php echo e(get_static_option('cart_proceed_to_checkout_text')); ?>">
                                </div>
                                <button class="btn btn-primary"><?php echo e(__('Save Settings')); ?></button>
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

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mobidvab/public_html/core/resources/views/backend/settings/cart.blade.php ENDPATH**/ ?>