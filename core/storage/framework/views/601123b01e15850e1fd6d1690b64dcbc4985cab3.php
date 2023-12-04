<?php
    // campaign data check
    $campaign_product = !is_null($product->campaignProduct) ? $product->campaignProduct : getCampaignProductById($product->id);
    $sale_price = $campaign_product ? optional($campaign_product)->campaign_price : $product->sale_price;
    $deleted_price = !is_null($campaign_product) ? $product->sale_price : $product->price;
    $campaign_percentage = !is_null($campaign_product) ? getPercentage($product->sale_price, $sale_price) : false;
    $buttons = \App\PageBuilder\Services\ProductItemServices::product_hover_button($product);

    $attributes = \Modules\Product\Entities\ProductInventoryDetails::where("product_id",$product->id)->count();
    $quick_view_data = getQuickViewDataMarkup($product);
    $quick_view_markup = '<a href="#" id="quickview" class="quick-view" '.$quick_view_data.'}><i class="lar la-eye icon"></i></a>';
?>
        <!-- Single -->
<div class="single-branding-product col-lg-6" data-wow-delay="0.0s">
    <div class="top-items-img">
        <span class="tag-box-new top-right">
            <?php if(!empty($item->badge)): ?>
                <span class="tag-new bg-dark border-radius">
                    <?php echo e($item->badge); ?>

                </span>
            <?php endif; ?>
            <?php if(!empty($campaign_percentage)): ?>
                <span class="tag-new bg-orange border-radius">
                    <?php echo e(round($campaign_percentage)); ?>%
                </span>
            <?php endif; ?>
        </span>
        <a href="<?php echo e(route("frontend.products.single",$product->slug)); ?>"><?php echo render_image($product->singleImage); ?></a>
    </div>
    <div class="cat-caption">
        <h5><a href="<?php echo e(route("frontend.products.single",$product->slug)); ?>" class="title"><?php echo e($product->title); ?></a></h5>
        <div class="product-price d-flex align-items-center mb-1">
            <div class="mr-20 mb-10">
                <strong class="price"><?php echo e(float_amount_with_currency_symbol($sale_price)); ?></strong>
                <?php if($deleted_price > $sale_price): ?>
                    <span class="offer-price"><?php echo e(float_amount_with_currency_symbol($deleted_price)); ?></span>
                <?php endif; ?>
            </div>
            <ul class="ratting mb-10">
                <?php if($product->ratingCount()): ?>
                    <?php echo ratingMarkup($product->ratingAvg(), $product->ratingCount()); ?>

                <?php endif; ?>
            </ul>
        </div>
        <ul class="cart-icon mt-15">
            <li>
                <?php if(isset($attributes) && $attributes > 0): ?>
                    <a href="<?php echo e(route('frontend.products.single', $product->slug)); ?>">

                        <i class="las la-plus-circle icon"></i>
                    </a>
                <?php else: ?>
                    <a href="#" data-attributes="<?php echo e($product->attributes); ?>" data-id="<?php echo e($product->id); ?>"
                       class="add_to_cart_ajax">
                        <i class="las la-shopping-cart icon"></i>
                    </a>
                <?php endif; ?>
            </li>
            <li>
                <?php if(isset($attributes) && $attributes > 0): ?>
                    <a href="<?php echo e(route('frontend.products.single', $product->slug)); ?>">
                        <i class="lar la-heart icon"></i>
                    </a>
                <?php else: ?>
                    <a href="#" data-attributes="<?php echo e($product->attributes); ?>" data-id="<?php echo e($product->id); ?>"
                       class="add_to_wishlist_ajax">
                        <i class="lar la-heart icon"></i></a>
                    </a>
                <?php endif; ?>
            </li>
            <li>
                <a href="#" data-id="<?php echo e($product->id); ?>" class="add_to_compare_ajax"> <i class="las la-retweet icon"></i></a>
            </li>
            <li>
                <?php if(isset($attributes) && $attributes > 0): ?>
                    <a class="product-quick-view-ajax" href="javascript:void(0)" data-action-route="<?php echo e(route('frontend.products.single-quick-view', $product->slug)); ?>">
                        <i class="las la-expand-arrows-alt icon"></i>
                    </a>
                <?php else: ?>
                    <?php echo $quick_view_markup; ?>

                <?php endif; ?>
            </li>



        </ul>
    </div>
</div>
<!-- Single --><?php /**PATH /home/mobidvab/public_html/core/resources/views/components/product-style/list-style-one.blade.php ENDPATH**/ ?>