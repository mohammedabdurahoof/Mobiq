
<div class="feature-categories-product section-bg-1 mt-30 pt-50 pb-50">
    <div class="container custom-container-1318">
        <div class="row">
            <div class="col-lg-3">
                <div class="single-feature-cat simple-cart mb-24">
                    <div class="product-tittle flex-content mb-20">
                        <h5 class="title"><?php echo e($category_one_prd->title); ?></h5>
                        <a href="<?php echo e(route('frontend.products.category',$category_one_prd->id)); ?>" class="pro-btn">View All</a>
                    </div>

                    <div class="feature-cat-products flex-content">
                        <?php
                            $category_one_product = $category_one_prd?->product?->first();
                        ?>
                        <div class="smal-product-img">
                            <?php $__currentLoopData = $category_one_prd?->product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($loop->iteration > 1): ?>
                                    <a href="<?php echo e(route('frontend.products.single',$product->slug)); ?>" class="product-img">
                                        <?php echo render_image($product->singleImage); ?>

                                    </a>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <div class="big-product-img">

                            <a href="<?php echo e(route('frontend.products.single',$category_one_product->slug)); ?>" class="product-img">
                                <?php echo render_image($category_one_product->singleImage); ?>

                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="single-feature-cat simple-cart mb-24">
                    <div class="product-tittle flex-content mb-20">
                        <h5 class="title"><?php echo e($category_two_prd->title); ?></h5>
                        <a href="<?php echo e(route('frontend.products.category',$category_two_prd->id)); ?>" class="pro-btn">View All</a>
                    </div>

                    <div class="feature-cat-products flex-content">
                        <?php $__currentLoopData = $category_two_prd?->product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="smal-product-img  mb-2">
                                <a href="<?php echo e(route('frontend.products.single',$product->slug)); ?>" class="product-img">
                                    <?php echo render_image($product->singleImage); ?>

                                </a>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="single-feature-cat simple-cart mb-24">
                    <div class="product-tittle flex-content mb-20">
                        <h5 class="title"><?php echo e($category_three_prd->title); ?></h5>
                        <a href="<?php echo e(route('frontend.products.category',$category_three_prd->id)); ?>" class="pro-btn">View All</a>
                    </div>

                    <div class="feature-cat-products flex-content">
                        <?php
                            $category_three_product = $category_three_prd?->product?->first();
                        ?>
                        <div class="smal-product-img">
                            <?php $__currentLoopData = $category_three_prd?->product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($loop->iteration > 1): ?>
                                    <a href="<?php echo e(route('frontend.products.single',$product->slug)); ?>" class="product-img">
                                        <?php echo render_image($product->singleImage); ?>

                                    </a>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <div class="big-product-img">

                            <a href="<?php echo e(route('frontend.products.single',$category_three_product->slug)); ?>" class="product-img">
                                <?php echo render_image($category_three_product->singleImage); ?>

                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="single-feature-cat simple-cart mb-24">
                    <div class="product-tittle flex-content mb-20">
                        <h5 class="title"><?php echo e($category_for_prd->title); ?></h5>
                        <a href="<?php echo e(route('frontend.products.category',$category_for_prd->id)); ?>" class="pro-btn">View All</a>
                    </div>

                    <div class="feature-cat-products flex-content">
                        <?php $__currentLoopData = $category_for_prd?->product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="smal-product-img  mb-2">
                                <a href="<?php echo e(route('frontend.products.single',$product->slug)); ?>" class="product-img">
                                    <?php echo render_image($product->singleImage); ?>

                                </a>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <?php $__currentLoopData = $banners['title_']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.banner-style.style-two','data' => ['btnText' => $banners['btn_text_'][$key],'btnUrl' => $banners['btn_url_'][$key],'title' => $banner,'subTitle' => $banners['sub_title_'][$key],'image' => $banners['image_'][$key],'bgColor' => $banners['bg_color_'][$key],'loop' => $loop]]); ?>
<?php $component->withName('banner-style.style-two'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['btn_text' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($banners['btn_text_'][$key]),'btn_url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($banners['btn_url_'][$key]),'title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($banner),'sub-title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($banners['sub_title_'][$key]),'image' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($banners['image_'][$key]),'bg-color' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($banners['bg_color_'][$key]),'loop' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($loop)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

    </div>
</div>
<?php /**PATH /home/mobidvab/public_html/core/app/Providers/../PageBuilder/views/product-style/style-02.blade.php ENDPATH**/ ?>