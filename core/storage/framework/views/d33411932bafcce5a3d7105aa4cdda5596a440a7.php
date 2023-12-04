
<div class="new-brand section-bg-1 pt-50 pb-50">
    <div class="container custom-container-1318">
        <div class="row">
            <div class="col-lg-7">
                <div class="simple-cart">

                    
                    <div class="product-tittle  mb-20">
                        <h5 class="title"><?php echo e($category_one_prd->title); ?></h5>
                    </div>

                    
                    <div class="new-brand-slider arrow-style-one mb-40">
                        <?php $__currentLoopData = $category_one_prd?->product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.product-style.grid-style-one','data' => ['product' => $product]]); ?>
<?php $component->withName('product-style.grid-style-one'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['product' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                    
                    
                    <div class="product-tittle  mb-20">
                        <h5 class="title"><?php echo e($category_three_prd->title); ?></h5>
                    </div>
                    <div class="new-brand-slider2 arrow-style-one">
                        <?php
                            // first I need to get all total product number
                            $products = $category_three_prd?->product;
                            $product_count = $products?->count() ?? 0;
                            // get separated items
                            $separated_items = round($product_count / 9);
                        ?>

                        <?php for($i = 0; $i < $separated_items; $i++): ?>
                            <div class="single-feature-cat simple-cart">
                                <div class="feature-cat-products flex-content">
                                    <?php $__currentLoopData = $products->skip($i * 9)->take(($i * 9) + 9); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="smal-product-img">
                                            <a href="<?php echo e(route('frontend.products.single',$product->slug)); ?>" class="product-img">
                                                <?php echo render_image($product->singleImage); ?>

                                            </a>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        <?php endfor; ?>
                    </div>
                </div>


            </div>
            <div class="col-lg-5">
                <div class="simple-cart height-480 mb-24">
                    
                    <div class="product-tittle  mb-20">
                        <h5 class="title"><?php echo e($category_two_prd->title); ?></h5>
                    </div>

                    
                    <div class="top-brand-slider arrow-style-one ">
                        <?php $__currentLoopData = $category_two_prd?->product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.product-style.list-style-one','data' => ['product' => $product]]); ?>
<?php $component->withName('product-style.list-style-one'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['product' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>


                <div class="singleCart singleCartTwo mb-24 bgColorFour tilt-effect wow fadeInLeft" data-wow-delay="0.0s" style="visibility: visible; animation-delay: 0s; animation-name: fadeInLeft;">
                    <div class="itemsCaption">
                        <p class="itemsCap"><?php echo e($banner["title"]); ?></p>
                        <h5><a href="#" class="itemsTittle"><?php echo e($banner["sub_title"]); ?></a></h5>
                        <div class="btn-wrapper">
                            <a href="<?php echo e($banner["btn_url"]); ?>" class="cmn-btn0"><?php echo e($banner["btn_text"]); ?></a>
                        </div>
                    </div>
                    <div class="itemsImg wow fadeInUp h-0" data-wow-delay="0.0s" style="visibility: visible; animation-delay: 0s; animation-name: fadeInUp;">
                        <?php echo render_image_markup_by_attachment_id($banner["image"]); ?>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<?php /**PATH /home/mobidvab/public_html/core/app/Providers/../PageBuilder/views/product-style/style-03.blade.php ENDPATH**/ ?>