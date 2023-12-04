<div class="brand-area-wrapper index-01" data-padding-top="<?php echo e($settings['padding_top']); ?>"  data-padding-bottom="<?php echo e($settings['padding_bottom']); ?>">
    <div class="container custom-container-1318">
        <div class="row">
            <div class="col-lg-12">

               <div class="brand-item-wrap_ brand-item-slider-inst">

                    <?php if(isset($settings['header_style_one'])): ?>

                        <?php $__currentLoopData = $settings['header_style_one']['logo_image_']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $logo_image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <div class="single-brand-item">

                            <?php echo render_image_markup_by_attachment_id($logo_image); ?>


                        </div>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <?php endif; ?>

                </div>

            </div>
        </div>
    </div>
</div>
<?php /**PATH /home/mobidvab/public_html/core/app/Providers/../PageBuilder/views/brand/brand_style_one.blade.php ENDPATH**/ ?>