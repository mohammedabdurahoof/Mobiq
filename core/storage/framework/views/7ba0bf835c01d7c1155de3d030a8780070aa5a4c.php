
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Tags:')); ?> <?php echo e(' '.$tag_name); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Tags:')); ?> <?php echo e(' '.$tag_name); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <section class="blog-list-area-wrapper blog-grid-area-wrapper padding-top-100 padding-bottom-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="blog-list-inner-wrap">
                        <?php $__empty_1 = true; $__currentLoopData = $all_blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.frontend.blog.list01','data' => ['image' => $data->image,'date' => $data->created_at,'title' => $data->title,'slug' => $data->slug,'author' => $data->author,'catid' => $data->blog_categories_id,'content' => $data->blog_content]]); ?>
<?php $component->withName('frontend.blog.list01'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['image' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($data->image),'date' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($data->created_at),'title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($data->title),'slug' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($data->slug),'author' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($data->author),'catid' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($data->blog_categories_id),'content' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($data->blog_content)]); ?>
                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div class="col-lg-12">
                                <div class="alert alert-danger">
                                    <?php echo e(__('No Post Available In').' '.$tag_name.__(' Tags')); ?>

                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <nav class="pagination" aria-label="Page navigation ">
                        <div class="pagination-default">
                            <?php echo $all_blogs->links(); ?>

                        </div>
                    </nav>
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

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mobidvab/public_html/core/resources/views/frontend/pages/blog/blog-tags.blade.php ENDPATH**/ ?>