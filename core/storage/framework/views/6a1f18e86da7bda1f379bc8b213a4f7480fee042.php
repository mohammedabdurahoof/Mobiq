
<div class="categeries-product-style section-bg-1">
    <div class="container custom-container-1318">
        <div class="row">
            <div class="col-lg-12">
                
                <div class="product-tittle  mb-20">
                    <h5 class="title"><?php echo e($section_title); ?></h5>
                </div>
                <div class="categories-product-slider arrow-style-one mb-24">
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $category_route = route('frontend.products.category', [
                                    'id' => optional($category)->id,
                                    'slug' => \Str::slug(optional($category)->title ?? '')
                                ]);
                            ?>
                            <div class="single-cat-style simple-cart">
                                <div class="feature-cat-products mb-10">
                                    <div class="big-product-img imgEffect">
                                        <a href="<?php echo e($category_route); ?>" class="product-img">
                                            
                                            <?php echo render_image($category->singleImage); ?>

                                        </a>
                                    </div>
                                </div>
                                <a href="<?php echo e($category_route); ?>" class="pro-btn m-0">See More</a>
                            </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
</div>




























<?php /**PATH /home/mobidvab/public_html/core/app/Providers/../PageBuilder/views/category/category_slider_three.blade.php ENDPATH**/ ?>