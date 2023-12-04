<div class="about-area-wrapper" data-padding-top="<?php echo e($padding_top); ?>"  data-padding-bottom="<?php echo e($padding_bottom); ?>">
    <div class="container custom-container-1318">
        <div class="row sec custom-reverse <?php if($image_position == 'left'): ?> flex-row-reverse <?php endif; ?>">
            <div class="col-lg-6">
                <div class="content-box">
                    <h4 class="title"><?php echo e(html_entity_decode($title)); ?></h4>
                    <div class="advantage-box support-area-wrapper">
                        <div class="support-item-wrap">
                            <?php $__currentLoopData = $all_features['title_']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $title): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="single-support-item">
                                    <div class="icon-box">
                                        <i class="<?php echo e($all_features['icon_'][$loop->index]); ?> icon"></i>
                                    </div>
                                    <div class="content">
                                        <h5 class="title"><?php echo e($title); ?></h5>
                                        <p class="info"><?php echo e($all_features['description_'][$loop->index]); ?></p>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                    <div class="btn-wrapper">
                        <a href="<?php echo e(\App\traits\URL_PARSE::url($button_url)); ?>" class="btn-default rounded-btn"><?php echo e($button_text); ?></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="img-box">
                    <?php echo render_image_markup_by_attachment_id($section_image); ?>

                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /home/mobidvab/public_html/core/app/Providers/../PageBuilder/views/about/about_style_two.blade.php ENDPATH**/ ?>