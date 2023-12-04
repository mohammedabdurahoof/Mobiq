
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Category:')); ?> <?php echo e(' '.$category_name); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Category:')); ?> <?php echo e(' '.$category_name); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <section class="blog-content-area padding-top-100 padding-bottom-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                        <?php $__empty_1 = true; $__currentLoopData = $all_blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.frontend.blog.list','data' => ['blog' => $data,'readMoreBtnText' => __('Read More')]]); ?>
<?php $component->withName('frontend.blog.list'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['blog' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($data),'readMoreBtnText' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Read More'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div class="alert alert-danger">
                                <?php echo e(__('No Post Available In ').$category_name.__(' Category')); ?>

                            </div>
                        <?php endif; ?>
                    <div class="pagination-default">
                        <?php echo $all_blogs->links(); ?>

                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="widget-area-wrapper">
                        <?php echo render_frontend_sidebar('blog',['column' => false]); ?>

                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mobidvab/public_html/core/resources/views/frontend/pages/blog/blog-category.blade.php ENDPATH**/ ?>