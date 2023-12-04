<?php
    use Modules\Product\Entities\ProductSubCategory;
    $sub_cat_details = ProductSubCategory::with('category')->find(request()->subcat);
    $cat = optional(optional($sub_cat_details)->category)->id;
?>

<div class="widget-area-wrapper">
    <div class="widget widget-search">
        <form class="search-from">
            <div class="form-group">
                <input type="search" id="search_query" class="form-control" autocomplete="off" placeholder="search..." value="<?php echo e(request()->q); ?>">
            </div>
            <button type="submit" class="widget-search-btn">
                <i class="las la-search icon"></i>
            </button>
        </form>
    </div>
    
    
    <div class="widget widget-range">
        <h5 class="widget-title"><?php echo e(__('filter by price')); ?></h5>
        <div class="range-wrap">
            <div id="slider-range"></div>
            <div class="range">
                <form>
                    <p class="price-range-wrap">
                        <label for="amount"><?php echo e(__('Range')); ?>:</label>
                        <input type="text" id="amount" readonly
                               style="border:0; color:#f6931f; font-weight:bold;"
                               value="<?php echo e(amount_with_currency_symbol($min_price)); ?> - <?php echo e(amount_with_currency_symbol($max_price)); ?>"
                        >
                    </p>
                </form>
            </div>
        </div>
    </div>

   

    <!--<div class="widget widget-tag">-->
    <!--    <h5 class="widget-title"><?php echo e(__('tags')); ?></h5>-->
    <!--    <div class="tag-wrap">-->
    <!--        <?php $__currentLoopData = $all_tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>-->
    <!--            <a href="#" class="tag-btn <?php if(isset(request()->t) && request()->t == $tag->tag_text): ?> active <?php endif; ?>"><?php echo e($tag->tag_text ?? $tag->tag); ?></a>-->
    <!--        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>-->
    <!--    </div>-->
    <!--</div>-->
    <?php if(!empty($selected_items_display_status)): ?>
        <div class="widget widget-recently-added">
            <h5 class="widget-title"><?php echo e($selected_items_name); ?></h5>
            <div class="recently-added-wrap">
                <?php $__currentLoopData = $selected_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $selected_item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="single-recent-item">
                       
                        <div class="content">
                            <h5 class="title">
                                <a href="<?php echo e(route('frontend.products.single', $selected_item->slug)); ?>"><?php echo e(Str::limit($selected_item->title, 25)); ?></a>
                            </h5>
                            <span class="product-meta"><?php echo e(float_amount_with_currency_symbol($selected_item->sale_price)); ?>/1kg</span>
                            <div class="ratings">
                                <a href="#" class="icon-wrap">
                                    <?php echo render_ratings($selected_item->ratingAvg(), 'icon active'); ?>

                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    <?php endif; ?>
    <?php if(!empty($featured_section_display_status)): ?>
        <div class="widget widget-add">
            <div class="add-banner-y-style-01">
                <a href="<?php echo e(url($featured_section_btn_url)); ?>">
                    <?php echo render_image_markup_by_attachment_id($featured_section_background_image); ?>

                </a>
                <div class="content">
                    <span class="sub-title"><?php echo e($featured_section_subtitle); ?></span>
                    <h4 class="title"><?php echo e($featured_section_title); ?></h4>
                    <div class="btn-wrapper">
                        <a href="<?php echo e(url($featured_section_btn_url)); ?>" class="shop-now-btn-style-01"><?php echo e($featured_section_btn_text); ?></a>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div><?php /**PATH /home/mobidvab/public_html/core/resources/views/frontend/partials/product/product-filter-sidebar.blade.php ENDPATH**/ ?>