<!-- Our Branding S t a r t-->
<div class="ourBranding section-padding2 mt-50 mb-50">
    <div class="container custom-container-1318">
        <div class="row justify-content-center">
            <div class="col-xl-7 col-lg-10 col-md-10 col-sm-10">
                <div class="section-tittle section-tittle2 text-center mb-40">
                    <h2 class="tittle"><?php echo e($title); ?></h2>
                </div>
            </div>
        </div>
        <div class="row ">
            <div class="col-xl-12">
                <div class="brandWrapper wrapperStyleOne brand-slider-active">
                    <?php $__currentLoopData = $brands["image_"]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="client-single wow fadeInLeft" data-wow-delay="0.<?php echo e($loop->iteration); ?>s">
                            <?php echo render_image_markup_by_attachment_id($brand); ?>

                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!--  End-of Branding--><?php /**PATH /home/mobidvab/public_html/core/app/Providers/../PageBuilder/views/brand/brand-style-one.blade.php ENDPATH**/ ?>