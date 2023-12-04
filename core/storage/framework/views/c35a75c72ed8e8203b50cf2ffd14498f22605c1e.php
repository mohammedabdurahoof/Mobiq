<div class="faq-area-wrapper" data-padding-top="<?php echo e($settings['padding_top']); ?>"  data-padding-bottom="<?php echo e($settings['padding_bottom']); ?>">
    <div class="container custom-container-1318">
        <div class="row">
            <div class="col-md-6 col-lg-6">
                <div class="faq-accordion">
                    <div class="accordion" id="faq_accordion">
                        <?php $__currentLoopData = $faq_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="card">
                            <div class="card-header" id="heading<?php echo e($faq->id); ?>">
                                <h5 class="mb-0">
                                    <a href="#" class="accordion-btn btn-link" data-toggle="collapse"
                                       data-target="#collapse<?php echo e($faq->id); ?>" aria-expanded="<?php echo $loop->first ? "true" : "false"; ?>" aria-controls="collapse<?php echo e($faq->id); ?>">
                                        <?php echo e($faq->title); ?>

                                        <span class="color-1">
                                                <i class="las la-plus open"></i>
                                                <i class="las la-minus close"></i>
                                            </span>
                                    </a>
                                </h5>
                            </div>

                            <div id="collapse<?php echo e($faq->id); ?>" class="collapse <?php if($loop->first): ?> show <?php endif; ?>" aria-labelledby="heading<?php echo e($faq->id); ?>"
                                 data-parent="#faq_accordion">
                                <div class="card-body">
                                    <p class="info"><?php echo e($faq->description); ?></p>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6">
                <div class="faq-form-wrapper">
                    <h3 class="faq-form-title"><?php echo e($ask_question_form_title); ?></h3>
                    <div class="faq_container mt-4">
                        <?php echo $custom_form_markup; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div><?php /**PATH /home/mobidvab/public_html/core/app/Providers/../PageBuilder/views/common/faq_style_one.blade.php ENDPATH**/ ?>