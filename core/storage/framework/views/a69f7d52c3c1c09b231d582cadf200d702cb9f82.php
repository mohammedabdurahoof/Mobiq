<div class="category-area-wrapper" data-padding-top="<?php echo e($settings['padding_top']); ?>"  data-padding-bottom="<?php echo e($settings['padding_bottom']); ?>">
    <div class="container custom-container-1318">
        <div class="row">
        
            <div class="col-lg-12">
                <div class="category-slider-inst">
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="single-slider-item">
                            <div class="img-box bg"
                                <?php echo render_background_image_markup_by_attachment_id($category->image); ?>

                            >
                                <a href="<?php echo e(route('frontend.products.category', [
                                    'id' => optional($category)->id,
                                    'slug' => \Str::slug(optional($category)->title ?? '')
                                ])); ?>">
                                    <?php echo render_image_markup_by_attachment_id($category->image); ?>

                                </a>
                            </div>
                            <div class="content">
                                <h4 class="title text-limit-line1">
                                    <a href="<?php echo e(route('frontend.products.category', [
                                        'id' => optional($category)->id,
                                        'slug' => \Str::slug(optional($category)->title ?? '')
                                    ])); ?>"><?php echo e($category->title); ?></a>
                                </h4>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
</div><?php /**PATH C:\xampp\htdocs\mobiq\core\app\Providers/../PageBuilder/views/category/category_slider_one.blade.php ENDPATH**/ ?>