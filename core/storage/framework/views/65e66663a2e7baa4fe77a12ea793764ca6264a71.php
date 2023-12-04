<?php
    $model = $model ?? true;
    // check if product is isset and not empty only then those code will work
    if(empty($product)){
        return false;
    }
    $attributes = \Modules\Product\Entities\ProductInventoryDetails::where("product_id",optional($product)->id)->count();

    if (isset($isCampaign) && $isCampaign) {
        $campaign_product = getCampaignProductById(optional($product)->id);

        $campaignItemInfo = getCampaignItemStockInfo($campaign_product);
        $percentage = $campaignItemInfo['sold_count'] / $campaignItemInfo['in_stock_count'] * 100;
        $campaignProductEndDate = optional($product)->campaign->end_date ?? optional($product)->campaign->end_date ?? '';

        $sale_price = $campaign_product ? $campaign_product->campaign_price : $product->sale_price;
        $deleted_price = $campaign_product ? optional($product)->sale_price : optional($product)->price;
        $campaign_percentage = $campaign_product ? getPercentage(optional($product)->sale_price, $sale_price) : false;
    }else{
        $campaign_product = getCampaignProductById($product->id);
        $sale_price = $campaign_product ? $campaign_product->campaign_price : $product->sale_price;
        $deleted_price = $campaign_product ? $product->sale_price : $product->price;
        $campaign_percentage = $campaign_product ? getPercentage($product->sale_price, $sale_price) : false;
    }
?>
 <div class="single-product-view-grid-style-03 product_card">
    <div class="product-thumb">
        <a href="<?php echo e(route('frontend.products.single', $product->slug)); ?>" class="img-link">
            <?php
                $isAjax = isset($isAjax) && $isAjax ? $isAjax : true;
                $is_lazy = isset($isAjax) && $isAjax ? false : true; // if loaded on product filter or any other ajax, disable lazy loading
            ?>

            <?php echo render_image_markup_by_attachment_id($product->image, '', 'grid', $is_lazy, $isAjax); ?>


            <?php if(isset($campaignProductEndDate) && $campaignProductEndDate): ?>
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.counter','data' => ['countdownTime' => $campaignProductEndDate]]); ?>
<?php $component->withName('counter'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['countdown-time' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($campaignProductEndDate)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
            <?php endif; ?>
        </a>
        <ul class="other-content">
            <?php if(!empty($product->badge)): ?>
                <li>
                    <span class="badge-tag"><?php echo e($product->badge); ?></span>
                </li>
            <?php endif; ?>
            <?php if(!empty($campaign_percentage)): ?>
                <li>
                    <span class="discount-tag"><?php echo e(round($campaign_percentage)); ?>%</span>
                </li>
            <?php endif; ?>
        </ul>
        <div class="hover-content">
            <ul class="hover-element-list">
                <?php echo view("product::components.product.product_filter_style_two"); ?>


                <?php if(isset($attributes) && $attributes > 0): ?>
                    <li>
                        <a class="product-quick-view-ajax" href="javascript:void(0)"
                           data-action-route="<?php echo e(route('frontend.products.single-quick-view', $product->slug)); ?>">
                            <i class="lar la-heart icon"></i>
                        </a>
                    </li>
                <?php else: ?>
                    <li>
                        <a href="<?php echo e(route('frontend.products.single', $product->slug)); ?>"
                           class="add_to_wishlist_ajax"
                           data-attributes="<?php echo e($product->attributes); ?>"
                           data-id="<?php echo e($product->id); ?>"
                        >
                            <i class="lar la-heart icon"></i>
                        </a>
                    </li>
                <?php endif; ?>
                <li>
                    <a href="#" data-id="<?php echo e($product->id); ?>" class="add_to_compare_ajax">
                        <i class="las la-random icon"></i>
                    </a>
                </li>
                <li>
                    <?php if(isset($attributes) && $attributes > 0): ?>
                        <a class="product-quick-view-ajax" href="javascript:void(0)"
                           data-action-route="<?php echo e(route('frontend.products.single-quick-view', $product->slug)); ?>">
                            <i class="las la-expand-arrows-alt icon"></i>
                        </a>
                    <?php else: ?>
                        <a href="#" class="quick-view" <?php echo getQuickViewDataMarkup($product); ?>>
                            <i class="las la-expand-arrows-alt icon"></i>
                        </a>
                    <?php endif; ?>
                </li>
            </ul>
        </div>
    </div>
    <div class="product-content">
        <div class="main-content">
            <h4 class="product-title">
                <a href="<?php echo e(route('frontend.products.single', $product->slug)); ?>"><?php echo e($product->title); ?></a>
            </h4>
            <div class="product-meta-and-pricing">
                <span class="product-meta"><?php echo e($product->unit); ?> <?php echo e($product->uom); ?></span>
                <div class="product-pricing">
                    <?php if($deleted_price > $sale_price): ?>
                        <del><?php echo e(float_amount_with_currency_symbol($deleted_price)); ?></del>
                    <?php endif; ?>

                    <span class="price"><?php echo e(float_amount_with_currency_symbol($sale_price)); ?></span>
                </div>
            </div>
            <?php if(isset($isCampaign) && $isCampaign): ?>
                <div class="campaign-progress-wrap">
                    <div class="d-flex justify-content-between">
                        <small class="left"><b><?php echo e(__('Sold')); ?> <?php echo e($campaignItemInfo['sold_count']); ?></b></small>
                        <small class="right"><b><?php echo e(__('Total')); ?> <?php echo e($campaignItemInfo['in_stock_count']); ?></b></small>
                    </div>
                    <div class="progress campaign_item_progress">
                        <div class="progress-bar" role="progressbar" style="width: <?php echo e($percentage); ?>%;"
                             aria-valuenow="<?php echo e($percentage); ?>" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            <?php endif; ?>
            <div class="btn-wrapper d-flex justify-content-between align-items-center">
                <?php if(isset($attributes) && $attributes > 0): ?>
                    <a href="<?php echo e(route('frontend.products.single', $product->slug)); ?>" class="add-cart-style-02">
                        <?php echo e(__('View Options')); ?>

                    </a>
                <?php else: ?>
                    <a href="#" data-attributes="<?php echo e($product->attributes); ?>" data-id="<?php echo e($product->id); ?>" class="add-cart-style-02 add_to_cart_ajax">
                        <?php echo e(__('Add to Bag')); ?>

                    </a>
                <?php endif; ?>

                <div class="ratings">
                    <span class="icon-wrap">
                        <?php if($product->ratingCount()): ?>
                            <?php echo ratingMarkup($product->ratingAvg(), $product->ratingCount(), false); ?>

                        <?php endif; ?>
                    </span>
                    <?php if($product->ratingCount()): ?>
                        <span class="total-feedback">(<?php echo e($product->ratingCount()); ?>)</span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /home/mobidvab/public_html/core/resources/views/components/frontend/product/product-card-03.blade.php ENDPATH**/ ?>