





<div class="count-down-area-wrapper mb-50  bg section-bg-1 wow fadeInUp" data-wow-delay="0.0s" data-padding-top="<?php echo e($settings['padding_top']); ?>"  data-padding-bottom="<?php echo e($settings['padding_bottom']); ?>"
        
>
    
    
    
    <div class="container custom-container-1318">
        <div class="row align-items-start">
            <div class="col-xl-8 col-lg-5">
                <div class="row align-items-end justify-content-between">
                    <div class="col-xl-7 col-lg-12 col-md-6">
                        <div class="count-down-inner mb-40">
                            <div class="content">
                                <span class="offer wow fadeInUp" data-wow-delay="0.0s"><?php echo e($subtitle); ?></span>
                                <h3 class="title wow fadeInUp" data-wow-delay="0.1s"><?php echo e(str_replace('[brk]', '<br/>', $title)); ?></h3>

                                <div class="flash-countdown-1 flash-countdown-style-1 wow fadeInUp" data-wow-delay="0.2s" data-date="<?php echo e(\Carbon\Carbon::parse($end_date)->format('Y-m-d h:i:s')); ?>">
                                    <div class="single-box">
                                        <span class="counter-days item time">00</span>
                                        <span class="label item"><?php echo e(__('Day')); ?></span>
                                    </div>
                                    <div class="colon-wrap">
                                        <span class="colon">:</span>
                                    </div>
                                    <div class="single-box">
                                        <span class="counter-hours item time">00</span>
                                        <span class="label item"><?php echo e(__('Hour')); ?></span>
                                    </div>
                                    <div class="colon-wrap">
                                        <span class="colon">:</span>
                                    </div>
                                    <div class="single-box">
                                        <span class="counter-minutes item time">00</span>
                                        <span class="label item"><?php echo e(__('Min')); ?></span>
                                    </div>
                                    <div class="colon-wrap">
                                        <span class="colon">:</span>
                                    </div>
                                    <div class="single-box">
                                        <span class="counter-seconds item time">00</span>
                                        <span class="label item"><?php echo e(__('Sec')); ?></span>
                                    </div>
                                </div>
                                <div class="btn-wrapper wow fadeInUp" data-wow-delay="0.4s">
                                    <a href="<?php echo e(\App\traits\URL_PARSE::url($button_url)); ?>" class="btnBorder2 big-btn"><?php echo e($button_text); ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-4 col-md-6 position-relative">
                        <div class="right-shape f-right wow fadeInRight" data-wow-delay="0.3s">
                            <?php echo render_image_markup_by_attachment_id($right_front_image, '', 'full', true); ?>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6">
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        // campaign data check
                        $campaign_product = !is_null($product->campaignProduct) ? $product->campaignProduct : getCampaignProductById($product->id);
                        $sale_price = $campaign_product ? optional($campaign_product)->campaign_price : $product->sale_price;
                        $deleted_price = !is_null($campaign_product) ? $product->sale_price : $product->price;
                        $campaign_percentage = !is_null($campaign_product) ? getPercentage($product->sale_price, $sale_price) : false;
                    ?>
                    <div class="singleCart singleCartTwo mb-20 white-bg tilt-effect wow fadeInLeft" data-wow-delay="0.<?php echo e($loop->iteration); ?>s" style="visibility: visible; animation-delay: 0s; animation-name: fadeInLeft;">
                        <div class="itemsCaption">
                            <p class="itemsCap"><?php echo e(round($campaign_percentage,2)); ?>% off</p>
                            <h5><a href="<?php echo e(route("frontend.products.single", $product->slug)); ?>" class="itemsTittle"><?php echo e($product->title); ?></a></h5>
                        </div>
                        <div class="itemsImg wow fadeInUp h-0" data-wow-delay="0.0s" style="visibility: visible; animation-delay: 0s; animation-name: fadeInUp;">
                            <?php echo render_image($product->singleImage); ?>

                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</div><?php /**PATH /home/mobidvab/public_html/core/app/Providers/../PageBuilder/views/banner/banner_style_four.blade.php ENDPATH**/ ?>