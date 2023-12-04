<div class="header-and-menu-area-wrapper index-01" data-padding-top="<?php echo e($settings['padding_top']); ?>"  data-padding-bottom="<?php echo e($settings['padding_bottom']); ?>">
    <div class="container custom-container-1318">
        <div class="row">
            <div class="col-lg-3">












            </div>
            <div class="col-lg-9">


                <div class=" header-area-wrapper">
                    <div class="header-area index-01">
                        <div class="header-slider-inst-index-01 wave-animated">
                            <?php $data = $settings['header_style_one']; ?>
                            <?php $__currentLoopData = $data['subtitle_']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $subtitle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="single-slider-item bg lazy" style="background-size: 100% 100%;"
                                    <?php echo render_background_image_markup_by_attachment_id($data['background_image_'][$key], 'full', true); ?>

                            >
                                <div class="content">
                                    <h5 class="sub-title"><?php echo e($data['subtitle_'][$key]); ?></h5>
                                    <h1 class="title"><?php echo e($data['title_'][$key]); ?></h1>
                                    <p class="offer-title"><?php echo e($data['offer_text_'][$key]); ?></p>
                                    <div class="btn-wrapper">
                                        <a href="<?php echo e(\App\traits\URL_PARSE::url($data['button_url_'][$key])); ?>" class="cmn-btn0"><?php echo e($data['button_text_'][$key]); ?></a>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
                <!-- header area end -->
            </div>
        </div>
    </div>
</div>
<?php /**PATH /home/mobidvab/public_html/core/app/Providers/../PageBuilder/views/header/header_slider_one.blade.php ENDPATH**/ ?>