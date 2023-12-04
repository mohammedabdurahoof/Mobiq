
<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Product Details Page Settings')); ?>

<?php $__env->stopSection(); ?>
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
<?php $__env->startSection('content'); ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('page-settings-product-details-page')): ?>
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
                            <h4 class="header-title"><?php echo e(__('Product Details Page Settings')); ?></h4>
                            <form action="<?php echo e(route('admin.page.settings.product.detail.page')); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <div class="form-group">
                                    <label for="product_in_stock_text"><?php echo e(__('Product In Stock Text')); ?></label>
                                    <input type="text" name="product_in_stock_text" class="form-control"
                                           value="<?php echo e(get_static_option('product_in_stock_text')); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="product_out_of_stock_text"><?php echo e(__('Product Out of Stock Text')); ?></label>
                                    <input type="text" name="product_out_of_stock_text" class="form-control"
                                           value="<?php echo e(get_static_option('product_out_of_stock_text')); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="add_to_cart_text"><?php echo e(__('Add to Cart Text')); ?></label>
                                    <input type="text" name="add_to_cart_text" class="form-control"
                                           value="<?php echo e(get_static_option('add_to_cart_text')); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="description_tab_text"><?php echo e(__('Description Tab Text')); ?></label>
                                    <input type="text" name="description_tab_text" class="form-control"
                                           value="<?php echo e(get_static_option('description_tab_text')); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="additional_information_text"><?php echo e(__('Additional Information Tab Text')); ?></label>
                                    <input type="text" name="additional_information_text" class="form-control"
                                           value="<?php echo e(get_static_option('additional_information_text')); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="reviews_text"><?php echo e(__('Reviews Tab Text')); ?></label>
                                    <input type="text" name="reviews_text" class="form-control"
                                           value="<?php echo e(get_static_option('reviews_text')); ?>">
                                </div>

                                <div class="form-group">
                                    <label for="your_reviews_text"><?php echo e(__('Your Review Text')); ?></label>
                                    <input type="text" name="your_reviews_text" class="form-control"
                                           value="<?php echo e(get_static_option('your_reviews_text')); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="write_your_feedback_text"><?php echo e(__('Write Your Feedback Text')); ?></label>
                                    <input type="text" name="write_your_feedback_text" class="form-control"
                                           value="<?php echo e(get_static_option('write_your_feedback_text')); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="post_your_feedback_text"><?php echo e(__('Post Your Feedback Text')); ?></label>
                                    <input type="text" name="post_your_feedback_text" class="form-control"
                                           value="<?php echo e(get_static_option('post_your_feedback_text')); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="no_rating_text"><?php echo e(__('No Rating Text')); ?></label>
                                    <input type="text" name="no_rating_text" class="form-control"
                                           value="<?php echo e(get_static_option('no_rating_text')); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="related_product_text"><?php echo e(__('Related Product Section Title Text')); ?></label>
                                    <input type="text" name="related_product_text" class="form-control"
                                           value="<?php echo e(get_static_option('related_product_text')); ?>">
                                </div>
                                <div class="form-group">
                                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.media-upload','data' => ['name' => 'related_product_image','id' => get_static_option('related_product_image'),'title' => __('Related Product Section Image')]]); ?>
<?php $component->withName('media-upload'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('related_product_image'),'id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(get_static_option('related_product_image')),'title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Related Product Section Image'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <label for=""><?php echo e(__('Sidebar status')); ?></label>
                                    <label class="switch">
                                        <input type="checkbox"
                                               name="sidebar_status" <?php echo e(!empty(get_static_option('sidebar_status')) ? 'checked' : ''); ?>><span
                                                class="slider"></span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label for="sidebar_position"><?php echo e(__('Sidebar Position')); ?></label>
                                    <select class="form-control" name="sidebar_position" id="sidebar_position">
                                        <option value="left"
                                                <?php if(get_static_option('sidebar_position') == 'left'): ?> selected <?php endif; ?>><?php echo e(__('Left')); ?></option>
                                        <option value="right"
                                                <?php if(get_static_option('sidebar_position') == 'right'): ?> selected <?php endif; ?>><?php echo e(__('Right')); ?></option>
                                    </select>
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

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mobidvab/public_html/core/resources/views/backend/settings/product-detail-page.blade.php ENDPATH**/ ?>