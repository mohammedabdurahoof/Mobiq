<div class="blog-list-area-wrapper" data-padding-top="<?php echo e($padding_top); ?>" data-padding-bottom="<?php echo e($padding_bottom); ?>">
    <div class="container custom-container-1318">
        <div class="row row-reverse justify-content-around">
            <?php if($sidebar_position == 'left'): ?>
            <div class="col-md-4 col-lg-3">
                <div class="widget-area-wrapper">
                    <?php echo render_frontend_sidebar('blog', ['column' => false]); ?>

                </div>
            </div>
            <?php endif; ?>

            <div class="col-md-8 col-lg-9">
                <div class="row">
                    <?php $__currentLoopData = $all_blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-lg-12">
                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.frontend.blog.list-02','data' => ['blog' => $blog,'readMoreBtnText' => $readMoreBtnText]]); ?>
<?php $component->withName('frontend.blog.list-02'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['blog' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($blog),'readMoreBtnText' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($readMoreBtnText)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="pagination margin-top-10">
                            <?php echo $all_blogs->links(); ?>

                        </div>
                    </div>
                </div>
            </div>

            <?php if($sidebar_position == 'right'): ?>
                <div class="col-md-4 col-lg-3">
                    <div class="widget-area-wrapper">
                        <?php echo render_frontend_sidebar('blog', ['column' => false]); ?>

                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php /**PATH /home/mobidvab/public_html/core/app/Providers/../PageBuilder/views/blog/blog_list_style_two.blade.php ENDPATH**/ ?>