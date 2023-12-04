



<div class="featured-product section-bg-1">
    <div class="container custom-container-1318">
        <div class="row">
            <div class="col-lg-12">
                
                <div class="product-tittle  mb-20">
                    <h5 class="title"><?php echo e($section_title); ?></h5>
                </div>
                <div class="featured-product-slider3 arrow-style-one  mb-24">
                    <?php for($i = 0;$i < count($product_types["category_"] ?? []) ?? 0; $i++): ?>
                        <?php if($product_types["layout_type_"][$i] == 'type_one'): ?>
                            <?php
                                $category_id = $product_types["category_"][$i];
                                $products = \Modules\Product\Entities\Product::select('id','image','slug','title','status')->with(['singleImage','category'])
                                ->where("status","publish")
                                ->without(['inventory', 'campaign' ,'rating','campaignProduct'])
                                ->when(!empty($product_types["category_"][$i]), function ($query) use ($category_id){
                                    $query->where('category_id', $category_id);
                                })->take(4)->get();
                            ?>

                            <div class="single-feature-cat simple-cart">
                                <div class="product-tittle flex-content mb-20">
                                    <h5 class="title"><?php echo e($products->first()?->category?->title); ?></h5>
                                    <a href="#" class="pro-btn">View All</a>
                                </div>
                                <div class="feature-cat-products flex-content">
                                    <div class="smal-product-img">
                                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if(!$loop->first): ?>
                                                <a href="<?php echo e(route("frontend.products.single",$product->slug)); ?>" class="product-img">
                                                    <?php echo render_image($product->singleImage); ?>

                                                </a>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>

                                    <div class="big-product-img">
                                        <a href="<?php echo e(route("frontend.products.single",$products->first()?->slug)); ?>" class="product-img">
                                            <?php echo render_image($products->first()?->singleImage); ?>

                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php elseif($product_types["layout_type_"][$i] == 'type_two'): ?>
                            <?php
                                $category_id = $product_types["category_"][$i];
                                $products = \Modules\Product\Entities\Product::select('id','image','slug','title','status')->with(['singleImage','category'])
                                ->where("status","publish")
                                ->without(['inventory', 'campaign' ,'rating','campaignProduct'])
                                ->when(!empty($product_types["category_"][$i]), function ($query) use ($category_id){
                                    $query->where('category_id', $category_id);
                                })->take(9)->get();
                            ?>

                            <div class="single-feature-cat simple-cart">
                                <div class="product-tittle flex-content mb-20">
                                    <h5 class="title"><?php echo e($products->first()?->category?->title); ?></h5>
                                    <a href="#" class="pro-btn">View All</a>
                                </div>
                                <div class="feature-cat-products flex-content">
                                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="smal-product-img">
                                            <a href="<?php echo e(route("frontend.products.single",$product->slug)); ?>"
                                               class="product-img">
                                                <?php echo render_image($product->singleImage); ?>

                                            </a>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endfor; ?>
                </div>
            </div>
        </div>
    </div>
</div>

                    



























































































































































                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /home/mobidvab/public_html/core/app/Providers/../PageBuilder/views/product-style/style-05.blade.php ENDPATH**/ ?>