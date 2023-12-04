
<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Edit Attribute')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40">
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
                </div>
            </div>
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="header-wrapper d-flex justify-content-between">
                            <h4 class="header-title"><?php echo e(__('Edit Attribute')); ?></h4>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product-attribute-list')): ?>
                            <a href="<?php echo e(route('admin.products.attributes.all')); ?>" class="btn btn-primary"><?php echo e(__('All Attributes')); ?></a>
                            <?php endif; ?>
                        </div>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product-attribute-list')): ?>
                        <form action="<?php echo e(route('admin.products.attributes.update')); ?>" method="post" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="id" value="<?php echo e($attribute->id); ?>">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="title"><?php echo e(__('Title')); ?></label>
                                        <input type="text" class="form-control"  name="title" value="<?php echo e($attribute->title); ?>" placeholder="<?php echo e(__('Title')); ?>">
                                    </div>
                                    <div class="form-group attributes-field product-attributes">
                                        <label for="attributes"><?php echo e(__('Terms')); ?></label>
                                        <?php $__empty_1 = true; $__currentLoopData = json_decode($attribute->terms); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $terms): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <div class="attribute-field-wrapper">
                                                <input type="text" class="form-control" name="terms[]" value="<?php echo e($terms); ?>">
                                                <div class="icon-wrapper">
                                                    <span class="add_attributes"><i class="ti-plus"></i></span>
                                                    <span class="remove_attributes"><i class="ti-minus"></i></span>
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <div class="attribute-field-wrapper">
                                                <input type="text" class="form-control" name="terms[]" placeholder="<?php echo e(__('terms')); ?>">
                                                <div class="icon-wrapper">
                                                    <span class="add_attributes"><i class="ti-plus"></i></span>
                                                    <span class="remove_attributes"><i class="ti-minus"></i></span>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4"><?php echo e(__('Update Product')); ?></button>
                                </div>
                            </div>
                        </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script>
        $(document).ready(function () {
            $(document).on('click','.attribute-field-wrapper .add_attributes',function (e) {
               e.preventDefault();
                $(this).parent().parent().parent().append(' <div class="attribute-field-wrapper">\n' +
                    '<input type="text" class="form-control" name="terms[]" placeholder="<?php echo e(__('terms')); ?>">\n' +
                    '<div class="icon-wrapper">\n' +
                    '<span class="add_attributes"><i class="ti-plus"></i></span>\n' +
                    '<span class="remove_attributes"><i class="ti-minus"></i></span>\n' +
                    '</div>\n' +
                    '</div>');
            });

            $(document).on('click','.attribute-field-wrapper .remove_attributes',function (e) {
                e.preventDefault();
                $(this).parent().parent().remove();
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mobidvab/public_html/core/resources/views/backend/products/attribute/edit-attribute.blade.php ENDPATH**/ ?>