<div class="about-area-wrapper" data-padding-top="<?php echo e($settings['padding_top']); ?>"  data-padding-bottom="<?php echo e($settings['padding_bottom']); ?>">
    <div class="container custom-container-1318">
        <div class="row sec custom-reverse <?php if($image_position == 'left'): ?> flex-row-reverse <?php endif; ?>">
            <div class="col-lg-6">
                <div class="content-box">
                    <h4 class="title"><?php echo e(html_entity_decode($title)); ?></h4>
                    <p class="info mt"><?php echo $description; ?></p>
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
<?php /**PATH /home/mobidvab/public_html/core/app/Providers/../PageBuilder/views/about/about_style_one.blade.php ENDPATH**/ ?>