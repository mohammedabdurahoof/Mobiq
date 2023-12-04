
<?php $__env->startSection('page-title'); ?>
    <?php echo e($product->title); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('site-title'); ?>
    <?php echo e($product->title); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/common/css/font-awesome.min.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php
        $product_img_url = null;
        $product_image = get_attachment_image_by_id($product->image,"full", false);
        $product_img_url = !empty($product_image) ? $product_image['img_url'] : '';
        $sidebar_status = get_static_option('sidebar_status');
        $sidebar_position = get_static_option('sidebar_position');

        $campaign_product = getCampaignProductById($product->id);
        $sale_price = $campaign_product ? $campaign_product->campaign_price : $product->sale_price;
        $deleted_price = $campaign_product ? $product->sale_price : $product->price;
        $campaign_percentage = $campaign_product ? getPercentage($product->sale_price, $sale_price) : false;
        $campaignSoldCount = \App\Campaign\CampaignSoldProduct::where("product_id",$product->id)->first();
        
        //todo remove it if manage it from inventory from listener
        $stock_count = $campaign_product ? $campaign_product->units_for_sale - optional($campaignSoldCount)->sold_count ?? 0 : optional($product->inventory)->stock_count;
        $stock_count = $stock_count > 0 ? $stock_count : 0;
        if($campaign_product){
            $campaign_title = \App\Campaign\Campaign::select('id','title')->where("id",$campaign_product->campaign_id)->first();
        }
    ?>
    <div class="shop-details-area-wrapper">
        <div class="container custom-container-1318">
            <div class="row <?php if(is_null($sidebar_status) && $sidebar_position == 'right'): ?> flex-row-reverse <?php endif; ?>"
            >
                <?php if(!empty($sidebar_status)): ?>
                    <div class="col-md-4 col-lg-3">
                        <?php echo $__env->make('frontend.partials.product.product-filter-sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                <?php endif; ?>
                <div class="<?php if(is_null($sidebar_status)): ?> col-md-12 <?php else: ?> col-md-8 col-lg-9 <?php endif; ?>">
                    <div class="product_details">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="product-view-wrap">
                                    <div class="shop-details-gallery-slider" id="shop_details_gallery_slider">
                                        <div class="single-main-image">
                                            <div class="product-view-tags">
                                                <?php if(!empty($product->badge)): ?>
                                                    <span class="badge-tag"><?php echo e($product->badge); ?></span>
                                                <?php endif; ?>
                                            </div>
                                            <a href="javascript:void(0)" class="long-img">
                                                <figure class="zoom zoom-js-handle"
                                                        data-src="<?php echo e(get_attachment_image_by_id($product->image, 'full')['img_url']); ?>"
                                                >
                                                    <div class="product-view-tags">
                                                        <?php if(!empty($product->badge)): ?>
                                                            <span class="badge-tag"><?php echo e($product->badge); ?></span>
                                                        <?php endif; ?>
                                                    </div>
                                                    <?php echo render_image_markup_by_attachment_id($product->image, 'img-fluid', 'full', false); ?>

                                                </figure>
                                            </a>
                                        </div>
                                        <?php
                                            $product_image_gallery = $product->product_image_gallery && $product->product_image_gallery != 'null'
                                                                        ? json_decode($product->product_image_gallery, true)
                                                                        : [];
                                        ?>
                                        <?php if($product_image_gallery && count($product_image_gallery)): ?>
                                            <?php $__currentLoopData = $product_image_gallery; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gallery_image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="single-main-image">

                                                    <div class="product-view-tags">
                                                        <?php if(!empty($product->badge)): ?>
                                                            <span class="badge-tag"><?php echo e($product->badge); ?></span>
                                                        <?php endif; ?>
                                                    </div>
                                                    <a href="javascript:void(0)" class="long-img">
                                                        <figure class="zoom zoom-js-handle"
                                                                data-src="<?php echo e(get_attachment_image_by_id($gallery_image, 'full')['img_url']); ?>">
                                                            <?php echo render_image_markup_by_attachment_id($gallery_image, 'img-fluid', 'full', false); ?>

                                                        </figure>
                                                    </a>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </div>

                                    <div class="thumb-wrap">
                                        <ul class="shop-details-gallery-nav" id="shop_details_gallery_nav">
                                            <li class="single-thumb">
                                                <a class="thumb-link individual_thumb_image_wrap" data-toggle="tab" href="#image-01">
                                                    <?php echo render_image_markup_by_attachment_id($product->image, 'img-fluid', 'full', false); ?>

                                                </a>
                                            </li>
                                            <?php if($product_image_gallery && count($product_image_gallery)): ?>
                                                <?php $__currentLoopData = $product_image_gallery; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gallery_image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li class="single-thumb">
                                                        <a class="thumb-link individual_thumb_image_wrap" data-toggle="tab"
                                                           href="#image-0<?php echo e($loop->iteration + 1); ?>">
                                                            <?php echo render_image_markup_by_attachment_id($gallery_image, 'img-fluid', 'full', false); ?>

                                                        </a>
                                                    </li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 pl-4">
                                <?php if(!empty($campaign_product)): ?>
                                    <div class="flash-countdown-wrapper">
                                        <div class="flash-countdown-title-single">
                                            <h6 class="flash-countdown-title"><?php echo e($campaign_title->title); ?></h6>
                                        </div>
                                        <div class="flash-countdown-product"
                                             data-date="<?php echo e(optional($campaign_product)->end_date); ?>">
                                            <div class="single-box">
                                                <span class="counter-days item"></span>
                                                <span class="label item"><?php echo e(__('D')); ?></span>
                                            </div>
                                            <div class="single-box">
                                                <span class="counter-hours item"></span>
                                                <span class="label item"><?php echo e(__('H')); ?></span>
                                            </div>
                                            <div class="single-box">
                                                <span class="counter-minutes item"></span>
                                                <span class="label item"><?php echo e(__('M')); ?></span>
                                            </div>
                                            <div class="single-box">
                                                <span class="counter-seconds item"></span>
                                                <span class="label item"><?php echo e(__('S')); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <div class="product-summery">

                                    <span class="product-meta">
                                         <?php echo e($product->unit); ?> <?php echo e($product->uom); ?>

                                    </span>

                                    <h3 class="product-title"><?php echo e($product->title); ?></h3>

                                    <?php if($stock_count > 0): ?>
                                        <span class="availability"><?php echo e(filter_static_option_value('product_in_stock_text', $setting_text, __('In stock'))); ?> (<?php echo e($stock_count); ?>)</span>
                                    <?php else: ?>
                                        <span class="availability text-danger"><?php echo e(filter_static_option_value('product_out_of_stock_text', $setting_text, __('Out of stock'))); ?></span>
                                    <?php endif; ?>

                                    <?php if($product->ratingCount() > 0): ?>
                                        <div class="rating-wrap">
                                            <div class="ratings">
                                                <?php echo ratingMarkup($product->ratingAvg(), $product->ratingCount(), false); ?>

                                            </div>
                                            <p class="total-ratings">(<?php echo e($product->ratingCount()); ?>)</p>
                                        </div>
                                    <?php endif; ?>

                                

                                    <?php if($product->attributes && $product->attributes != 'null'): ?>
                                        <?php $product_attributes = decodeProductAttributes($product->attributes); ?>
                                        <?php $__currentLoopData = $product_attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="size section attribute_row">
                                                <span class="name"><?php echo e($attribute['name']); ?></span>
                                                <div class="checkbox-color " style="display: flex;-webkit-box-align: center;-ms-flex-align: center;align-items: center;gap: 10px;-webkit-box-pack: start;-ms-flex-pack: start;justify-content: flex-start;margin-top: 10px;">
                                                    <?php $__currentLoopData = $attribute['terms']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $term): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div class="single-checkbox-wrap attribute">
                                                            <label>
                                                                <input type="radio" name="attr_<?php echo e($attribute['name']); ?>"
                                                                       data-attr="<?php echo e(json_encode($term)); ?>"
                                                                       class="checkbox">
                                                                <span data-name="<?php echo e($attribute['name']); ?>"
                                                                      data-extra="<?php echo e($term['additional_price']); ?>"
                                                                      class="size-code">
                                                                    <?php echo e($term['name']); ?> <?php if(isset($term['additional_price']) && $term['additional_price'] > 0): ?>
                                                                        (+<?php echo e(float_amount_with_currency_symbol($term['additional_price'])); ?>

                                                                        ) <?php endif; ?>
                                                                </span>
                                                            </label>
                                                        </div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>

                                    <div class="price-wrap">
                                        <span class="price"
                                              data-main-price="<?php echo e($sale_price); ?>"
                                              data-currency-symbol="<?php echo e(site_currency_symbol()); ?>"
                                              id="price"
                                        >
                                            <?php echo e(float_amount_with_currency_symbol($sale_price)); ?>

                                        </span>
                                        <?php if($deleted_price > $sale_price): ?>
                                            <del class="del-price"><?php echo e(float_amount_with_currency_symbol($deleted_price)); ?></del>
                                        <?php endif; ?>
                                    </div>

                                    
                                    <?php if($productSizes->count() > 0 && !empty(current(current($productSizes)))): ?>
                                        <div class="value-input-area margin-top-15 size_list">
                                            <span class="input-list">
                                                <strong class="color-light"><?php echo e(__('Size:')); ?></strong>
                                                <input class="form--input value-size" name="size" type="text" value="">
                                                <input type="hidden" id="selected_size">
                                            </span>
                                            <ul class="size-lists" data-type="Size">
                                                <?php $__currentLoopData = $productSizes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product_size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if(!empty($product_size)): ?>
                                                        <li class=""
                                                            data-value="<?php echo e(optional($product_size)->id); ?>"
                                                            data-display-value="<?php echo e(optional($product_size)->name); ?>"
                                                        > <?php echo e(optional($product_size)->name); ?> </li>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                        </div>
                                    <?php endif; ?>

                                   <?php if($productColors->count() > 0 && current(current($productColors))): ?>
                                        <div class="value-input-area margin-top-15 color_list">
                                                <span class="input-list">
                                                    <strong class="color-light"><?php echo e(__('Color:')); ?></strong>
                                                    <input class="form--input value-size" name="color" type="text"
                                                           value="">
                                                    <input type="hidden" id="selected_color">
                                                </span>
                                            <ul class="size-lists color-list" data-type="Color">
                                                
                                                <?php $__currentLoopData = $productColors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product_color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php
                                                    $image=Modules\Product\Entities\ProductInventoryDetails::where(['product_id'=>$product->id,'color'=>$product_color->id])->first();
                                                    $image_urls="";
                                                    if($image){
                                                        $d=get_attachment_image_by_id($image->image);
                                                        
                                                        $image_urls=$d['img_url'] ?? '';
                                                    }
                                                    
                                                ?>
                                                    <?php if(!empty($product_color)): ?>
                                                        <li
                                                                class="radius-percent-50"
                                                                data-value="<?php echo e(optional($product_color)->id); ?>"
                                                                data-display-value="<?php echo e(optional($product_color)->name); ?>"
                                                                data-image="<?php echo e($image_urls); ?>"
                                                        >
                                                            <span class="color-list-overlay"></span>
                                                            <span style="background: <?php echo e(optional($product_color)->color_code); ?>"></span>
                                                        </li>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                        </div>
                                    <?php endif; ?>
        
                                    <?php $__currentLoopData = $available_attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute => $options): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="value-input-area margin-top-15 attribute_options_list">
                                                <span class="input-list">
                                                    <strong class="color-light"><?php echo e($attribute); ?></strong>
                                                    <input class="form--input value-size" type="text" value="">
                                                    <input type="hidden" id="selected_attribute_option"
                                                           name="selected_attribute_option">
                                                </span>
                                            <ul class="size-lists" data-type="<?php echo e($attribute); ?>">
                                                <?php $__currentLoopData = $options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li
                                                            class=""
                                                            data-value="<?php echo e($option); ?>"
                                                            data-display-value="<?php echo e($option); ?>"
                                                    > <?php echo e($option); ?> </li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    
 <div class="short-description">
                                        <p class="info"><?php echo $product->summary; ?></p>
                                    </div>
                                    <div class="user-select-option">
                                        <div class="cart-control">
                                            <div class="value-button minus decrease"><i class="las la-minus"></i></div>
                                            <input type="text" name="quantity" id="quantity" class="qty_" value="1">
                                            <div class="value-button plus increase"><i class="las la-plus"></i></div>
                                        </div>
                                        <div class="btn-and-fav">
                                            <?php if($stock_count): ?>
                                                <div class="btn-wrapper">
                                                    <a href="#" class="btn-default rounded-btn add_to_cart_single_page"
                                                       data-id="<?php echo e($product->id); ?>"
                                                    >
                                                        <?php echo e(filter_static_option_value('add_to_cart_text', $setting_text, __('add to cart'))); ?>

                                                    </a>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <?php if($stock_count): ?>
                                        <div class="btn-wrapper btn-and-fav d-flex flex-wrap mb-4">
                                            <a href="#" data-id="<?php echo e($product->id); ?>"
                                               class="cart buy_now btn-default rounded-btn"><?php echo e(__('Buy Now')); ?></a>

                                            <div class="favorite add_to_wishlist" data-id="<?php echo e($product->id); ?>">
                                                <a href="#">
                                                    <i class="lar la-heart icon"></i>
                                                </a>
                                            </div>
                                            <div class="favorite add_to_compare_ajax" data-id="<?php echo e($product->id); ?>">
                                                <a href="#">
                                                    <i class="las la-retweet icon"></i>
                                                </a>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                   
                                    <?php if($product->category && $product->category->id): ?>
                                        <div class="category">
                                            <a href="<?php echo e(route('frontend.products.category', [
                                            'id' => optional($product->category)->id,
                                            'slug' => \Str::slug(optional($product->category)->title ?? '')
                                        ])); ?>">
                                                <?php echo e(optional($product->category)->title); ?>

                                            </a>
                                        </div>
                                    <?php endif; ?>

                                    <div class="product-details-tag-and-social-link">
                                        <?php if($product->tags && $product->tags->count()): ?>
                                            <div class="tag">
                                                <p class="name"><?php echo e(__('tags')); ?>:</p>
                                                <?php $__currentLoopData = $product->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <a href="<?php echo e(route('frontend.products.all', ['t' => $tag->tag])); ?>"
                                                       class="tag-btn"><?php echo e($tag->tag); ?></a>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        <?php endif; ?>
                                        <div class="social-link-wrap">
                                            <p class="name"><?php echo e(__('share')); ?>:</p>
                                            <div class="social-link">
                                                <ul class="social-link-list">
                                                    <?php echo single_post_share(route('frontend.products.single', purify_html($product->slug)), purify_html($product->title), $product_img_url); ?>

                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="product-details-tab">
                                    <nav>
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                            <a class="nav-link active" id="nav-home-tab" data-toggle="tab"
                                               href="#nav-home"
                                               role="tab" aria-controls="nav-home" aria-selected="true"
                                            >
                                                <?php echo e(filter_static_option_value('description_tab_text', $setting_text, __('Description'))); ?>

                                            </a>
                                            <?php if($product->additionalInfo && $product->additionalInfo->count()): ?>
                                                <a class="nav-link" id="nav-profile-tab" data-toggle="tab"
                                                   href="#nav-profile"
                                                   role="tab" aria-controls="nav-profile" aria-selected="false"
                                                >
                                                    <?php echo e(filter_static_option_value('additional_information_text', $setting_text, __('Additional information'))); ?>

                                                </a>
                                            <?php endif; ?>
                                            <a class="nav-link" id="nav-contact-tab" data-toggle="tab"
                                               href="#nav-contact"
                                               role="tab" aria-controls="nav-contact" aria-selected="false">
                                                <?php echo e(filter_static_option_value('reviews_text', $setting_text, __('Reviews'))); ?>

                                            </a>
                                        </div>
                                    </nav>
                                    <div class="tab-content" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                                             aria-labelledby="nav-home-tab">
                                            <div class="description">
                                                <p class="info"><?php echo $product->description; ?></p>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="nav-profile" role="tabpanel"
                                             aria-labelledby="nav-profile-tab">
                                            <div class="aditional-info">
                                                <div class="product-info">
                                                    <ul class="product-info-list">
                                                        <?php if($product->additionalInfo && $product->additionalInfo->count()): ?>
                                                            <?php $__currentLoopData = $product->additionalInfo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $additionalInfo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <li>
                                                                    <span class="spn-1">
                                                                    <?php echo e(optional($additionalInfo)->title); ?> :
                                                                    </span>
                                                                    <span class="spn-2">
                                                                    <?php echo e(optional($additionalInfo)->text); ?>

                                                                    </span>
                                                                </li>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php endif; ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="nav-contact" role="tabpanel"
                                             aria-labelledby="nav-contact-tab">
                                            <div class="feedback-section">
                                                <div class="feedback">
                                                    <?php if(auth()->check()): ?>
                                                        <?php if($user_has_item && $user_rated_already): ?>
                                                            <div class="ratings select-ratings">
                                                                <p><?php echo e(__('Your rating')); ?> <span
                                                                            class="required">*</span></p>
                                                                <a href="javascript:void(0)">
                                                                    
                                                                    <i data-rating="1" class="lar la-star icon"></i>
                                                                    <i data-rating="2" class="lar la-star icon"></i>
                                                                    <i data-rating="3" class="lar la-star icon"></i>
                                                                    <i data-rating="4" class="lar la-star icon"></i>
                                                                    <i data-rating="5" class="lar la-star icon"></i>
                                                                </a>
                                                            </div>
                                                            <div class="feedback-form">
                                                                <form method="POST"
                                                                      action="<?php echo e(route('frontend.products.ratings.store')); ?>">
                                                                    <?php echo csrf_field(); ?>
                                                                    <input name="id" value="<?php echo e($product->id); ?>"
                                                                           type="hidden">
                                                                    <input value="" name="rating" id="rating-number"
                                                                           type="hidden"/>

                                                                    <div class="form-group">
                                                                        <label for="comment">
                                                                            <?php echo e(filter_static_option_value('your_reviews_text', $setting_text, __('Your review'))); ?>

                                                                            &nbsp;
                                                                            <span class="required">*</span>
                                                                        </label>
                                                                        <textarea class="form-control" id="comment"
                                                                                  name="comment" required=""
                                                                                  placeholder="<?php echo e(filter_static_option_value('write_your_feedback_text', $setting_text, __('Write your feedback here'))); ?>"
                                                                        ></textarea>
                                                                    </div>
                                                                    <div class="btn-wrapper">
                                                                        <button type="submit"
                                                                                class="btn-default rounded-btn">
                                                                            <?php echo e(filter_static_option_value('post_your_feedback_text', $setting_text, __('Post your feedback'))); ?>

                                                                        </button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        <?php endif; ?>
                                                    <?php else: ?>
                                                        <div class="row">
                                                            <div class="col-sm-6 ">
                                                                <form action="<?php echo e(route('user.login')); ?>" method="post"
                                                                      class="register-form" id="login_form_order_page">
                                                                    <?php echo csrf_field(); ?>
                                                                    <div class="error-wrap"></div>

                                                                    <div class="row">
                                                                        <div class="form-group col-12">
                                                                            <label for="login_email"><?php echo e(__('Email or User Name')); ?>

                                                                                <span class="ex">*</span></label>
                                                                            <input class="form-control" type="text"
                                                                                   name="username" id="login_email"
                                                                                   required/>
                                                                        </div>
                                                                        <div class="form-group col-12">
                                                                            <label for="login_password"><?php echo e(__('Password')); ?>

                                                                                <span class="ex">*</span></label>
                                                                            <input class="form-control" type="password"
                                                                                   name="password" id="login_password"
                                                                                   required/>
                                                                        </div>
                                                                        <div class="form-group form-check col-12">
                                                                            <input type="checkbox" name="remember"
                                                                                   class="form-check-input"
                                                                                   id="login_remember">
                                                                            <label class="form-check-label"
                                                                                   for="remember"><?php echo e(__('Remember me')); ?> </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="btn-pair">
                                                                        <div class="btn-wrapper">
                                                                            <button type="button" class="default-btn"
                                                                                    id="login_btn"><?php echo e(__('SIGN IN')); ?></button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                    <div class="client-feedback">
                                                        <ul class="comment-list">
                                                            <?php $__empty_1 = true; $__currentLoopData = $ratings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rating): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                                <li>
                                                                    <div class="single-comment-wrap">
                                                                        <?php if(strlen(optional($rating->user)->image)): ?>
                                                                            <div class="thumb">
                                                                                <?php echo render_image_markup_by_attachment_id(optional($rating->user)->image, '', 'grid'); ?>

                                                                            </div>
                                                                        <?php endif; ?>
                                                                        <div class="content">
                                                                            <div class="content-top">
                                                                                <div class="left">
                                                                                    <h4 class="title"><?php echo e(optional($rating->user)->name); ?></h4>
                                                                                    <?php for($i = 0; $i < $rating->rating; $i++): ?>
                                                                                        <i class="las la-star icon"></i>
                                                                                    <?php endfor; ?>
                                                                                </div>
                                                                            </div>
                                                                            <p class="comment"><?php echo e($rating->review_msg); ?></p>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                                <div class="text-center">
                                                                    <h4 class="text-secondary">
                                                                        <?php echo e(filter_static_option_value('no_rating_text', $setting_text, __('No rating to show yet'))); ?>

                                                                    </h4>
                                                                </div>
                                                            <?php endif; ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="related_products">
                        <div class="row margin-top-90">
                            <div class="col-lg-12">
                                <div class="section-title-wrapper">

                                    <h2 class="section-title">
                                        <?php echo e(filter_static_option_value('related_product_text', $setting_text, __('Related products'))); ?>

                                    </h2>
                                  
                                </div>
                            </div>
                        </div>
                        <div class="row rel-prodc col-control" style="flex-direction: row;">
                            <?php $__empty_1 = true; $__currentLoopData = $related_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $related_product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <div class="col-6 col-lg-3 col-md-3">
                                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.product-style.grid-style-one','data' => ['product' => $related_product]]); ?>
<?php $component->withName('product-style.grid-style-one'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['product' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($related_product)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <h4 class="text-center py-4">No product found!</h4>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php echo $__env->make('frontend.partials.product.product-filter-form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('assets/frontend/js/rating.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/frontend/js/bootstrap4-rating-input.js')); ?>"></script>
    <?php echo $__env->make('frontend.partials.product.product-filter-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <script>
        let attribute_store = JSON.parse('<?php echo json_encode($product_inventory_set); ?>');
        let additional_info_store = JSON.parse('<?php echo json_encode($additional_info_store); ?>');
        let available_options = $('.value-input-area');

        $(document).on("mouseover", ".select-ratings a i", function () {
            rating_icon.call(this)
        });

        $(document).on("click", ".select-ratings a i", function () {
            rating_icon.call(this)
        });

        function getAttributesForCart() {
            let selected_options = get_selected_options();
            let cart_selected_options = selected_options;
            let hashed_key = getSelectionHash(selected_options);

            // if selected attribute set is available
            if (additional_info_store[hashed_key]) {
                return additional_info_store[hashed_key]['pid_id'];
            }

            // if selected attribute set is not available
            if  (Object.keys(selected_options).length) {
                toastr.error('Attribute not available')
            }

            return '';
        }

        function get_selected_options() {
            let selected_options = {};
            var available_options = $('.value-input-area');
            // get all selected attributes in {key:value} format
            available_options.map(function (k, option) {
                let selected_option = $(option).find('li.active');
                let type = selected_option.closest('.size-lists').data('type');
                let value = selected_option.data('displayValue');

                if (type && value) {
                    selected_options[type] = value;
                }
            });

            let ordered_data = {};
            let selected_options_keys = Object.keys(selected_options).sort();
            selected_options_keys.map(function (e) {
                ordered_data[e] = selected_options[e];
            });

            return ordered_data;
        }

        function getSelectionHash(selected_options) {
            return MD5(JSON.stringify(selected_options));
        }

        function validateSelectedAttributes() {
            let selected_options = get_selected_options();
            let hashed_key = getSelectionHash(selected_options);

            // validate if product has any attribute
            if (quick_view_attribute_store.length) {
                if (!Object.keys(selected_options).length) {
                    return false;
                }

                if (!additional_info_store[hashed_key]) {
                    return false;
                }

                return !!additional_info_store[hashed_key]['pid_id'];
            }

            return true;
        }

        function rating_icon() {
            let rating = $(this).data('rating');
            let icon = document.querySelectorAll(".select-ratings a i");

            // icon[i].classList.remove("las");
            $(".select-ratings a i").each(function () {
                $(this).removeClass("las").addClass("lar");
            });

            for (let i = 0; i < rating; i++) {
                icon[i].classList.replace("lar", "las");
            }

            $("#rating-number").val(rating);
        }

        (function ($) {
            'use script'
            let site_currency_symbol = '<?php echo e(site_currency_symbol()); ?>';

            $(document).ready(function () {
                $('.add_to_cart_single_page').on('click', function (e) {
                    e.preventDefault();

                    let selected_size = $('#selected_size').val();
                    let selected_color = $('#selected_color').val();

                    let pid_id = getAttributesForCart();

                    let product_id = $(this).data('id');
                    let quantity = Number($('#quantity').val().trim());
                    let price = $('#price').text().split(site_currency_symbol)[1];
                    let attributes = {};
                    let product_variant = pid_id;


                    console.log(selected_size,selected_color,pid_id);

                    attributes['price'] = price;

                    // if selected attribute is a valid product item
                    if (validateSelectedAttributes()) {
                        $.ajax({
                            url: '<?php echo e(route("frontend.products.add.to.cart.ajax")); ?>',
                            type: 'POST',
                            data: {
                                product_id: product_id,
                                quantity: quantity,
                                pid_id: pid_id,
                                product_variant: product_variant,
                                selected_size: selected_size,
                                selected_color: selected_color,
                                _token: '<?php echo e(csrf_token()); ?>'
                            },
                            success: function (data) {
                                toastr.success(data.msg);
                                if (data.quantity_msg) {
                                    toastr.warning(data.quantity_msg)
                                }
                                refreshShippingDropdown();
                            },
                            erorr: function (err) {
                                toastr.error('<?php echo e(__("An error occurred")); ?>');
                            }
                        });
                    } else {
                        toastr.error('<?php echo e(__("Select all attribute to proceed")); ?>');
                    }
                });

                $('.add_to_wishlist').on('click', function (e) {
                    e.preventDefault();
                    let product_id = $(this).data('id');
                    let quantity = Number($('#quantity').val().trim());
                    let pid_id = getAttributesForCart();

                    // if selected attribute is a valid product item
                    if (validateSelectedAttributes()) {
                        $.ajax({
                            url: '<?php echo e(route("frontend.products.add.to.wishlist.ajax")); ?>',
                            type: 'POST',
                            data: {
                                product_id: product_id,
                                quantity: quantity,
                                pid_id: pid_id,
                                _token: '<?php echo e(csrf_token()); ?>'
                            },
                            success: function (data) {
                                toastr.success(data.msg);
                                refreshWishlistDropdown();
                            },
                            erorr: function (err) {
                                toastr.error('<?php echo e(__("An error occurred")); ?>');
                            }
                        });
                    } else {
                        toastr.error('<?php echo e(__("Select an attribute to proceed")); ?>');
                    }
                });

                $('.buy_now').on('click', function (e) {
                    e.preventDefault();

                    let product_id = $(this).data('id');
                    let quantity = Number($('#quantity').val().trim());
                    let pid_id = getAttributesForCart();

                    if (validateSelectedAttributes()) {
                        $.ajax({
                            url: '<?php echo e(route("frontend.products.add.to.cart.ajax")); ?>',
                            type: 'POST',
                            data: {
                                product_id: product_id,
                                quantity: quantity,
                                pid_id: pid_id,
                                _token: '<?php echo e(csrf_token()); ?>'
                            },
                            success: function (data) {
                                toastr.success(data.msg);
                                if (data.quantity_msg) {
                                    toastr.warning(data.quantity_msg)
                                }
                                setTimeout(function () {
                                    location.href = '<?php echo e(route("frontend.checkout")); ?>';
                                }, 1000);
                                // refreshShippingDropdown();
                            },
                            erorr: function (err) {
                                toastr.error('<?php echo e(__("Something went wrong")); ?>');
                            }
                        });
                    } else {
                        toastr.error('<?php echo e(__("Select all attribute to proceed")); ?>');
                    }
                });

                $(document).on('click', '#login_btn', function (e) {
                    let formContainer = $('#login_form_order_page');
                    let el = $(this);
                    let username = $('#login_form_order_page #login_email').val();
                    let password = $('#login_form_order_page #login_password').val();
                    let remember = $('#login_form_order_page #login_remember').val();

                    el.text('<?php echo e(__("Please Wait")); ?>');

                    $.ajax({
                        type: 'post',
                        url: "<?php echo e(route('user.ajax.login')); ?>",
                        data: {
                            _token: "<?php echo e(csrf_token()); ?>",
                            username: username,
                            password: password,
                            remember: remember,
                        },
                        success: function (data) {
                            if (data.status === 'invalid') {
                                el.text('<?php echo e(__("Login")); ?>')
                                formContainer.find('.error-wrap').html('<div class="alert alert-danger">' + data.msg + '</div>');
                            } else {
                                formContainer.find('.error-wrap').html('');
                                el.text('<?php echo e(__("Login Success.. Redirecting ..")); ?>');
                                location.reload();
                            }
                        },
                        error: function (data) {
                            var response = data.responseJSON.errors;
                            formContainer.find('.error-wrap').html('<ul class="alert alert-danger"></ul>');
                            $.each(response, function (value, index) {
                                formContainer.find('.error-wrap ul').append('<li>' + index + '</li>');
                            });
                            el.text('<?php echo e(__("Login")); ?>');
                        }
                    });
                });

                $(document).on('click', '#shop_details_gallery_nav .individual_thumb_image_wrap', function (event) {
                    let el = $(this);
                    //let lgImage = $('#shop_details_gallery_slider .single-main-image[data-slick-index="0"]');
                });
                
                $(document).on('click', '.size-lists li', function (event) {
                    let el = $(this);
                    let value = el.data('displayValue');
                    let parentWrap = el.parent().parent();
                    el.addClass('active');
                    el.siblings().removeClass('active');
                    parentWrap.find('input[type=text]').val(value);
                    parentWrap.find('input[type=hidden]').val(el.data('value'));

                    // selected attributes
                    selectedAttributeSearch(this);
                });

                // $(document).on('click', '.value-input-area', function () {
                //     selectedAttributeSearch();
                // });
            });

            function refreshShippingDropdown() {
                $.ajax({
                    url: '<?php echo e(route("frontend.products.cart.info.ajax")); ?>',
                    type: 'GET',
                    success: function (data) {
                        $('#cart_badge').text(data.item_total);
                        $('#top_minicart_container').html(data.cart);
                    },
                    erorr: function (err) {
                        toastr.error('<?php echo e(__("An error occurred")); ?>');
                    }
                });
            }

            function refreshWishlistDropdown() {
                $.ajax({
                    url: '<?php echo e(route("frontend.products.wishlist.info.ajax")); ?>',
                    type: 'GET',
                    success: function (data) {
                        $('#wishlist_badge').text(data['item_total']);
                        $('#top_wishlist_container').html(data['wishlist']);
                    },
                    erorr: function (err) {
                        toastr.error('<?php echo e(__("Something went wrong")); ?>');
                    }
                });
            }
        })(jQuery)

        function selectedAttributeSearch(selected_item) {
            /*
            * search based on all selected attributes
            *
            * 1. get all selected attributes in {key:value} format
            * 2. search in attribute_store for all available matches
            * 3. display available matches (keep available matches selectable, and rest as disabled)
            * */

            let available_variant_types = [];
            let selected_options = {};

            // get all selected attributes in {key:value} format
            available_options.map(function (k, option) {
                let selected_option = $(option).find('li.active');
                let type = selected_option.closest('.size-lists').data('type');
                let value = selected_option.data('displayValue');

                if (type) {
                    available_variant_types.push(type);
                }

                if (type && value) {
                    selected_options[type] = value;
                }
            });

            syncImage(get_selected_options());
            syncPrice(get_selected_options());

            // search in attribute_store for all available matches
            let available_variants_selection = [];
            let selected_attributes_by_type = {};
            attribute_store.map(function (arr) {
                let matched = true;

                Object.keys(selected_options).map(function (type) {

                    if (arr[type] !== selected_options[type]) {
                        matched = false;
                    }
                })

                if (matched) {
                    available_variants_selection.push(arr);

                    // insert as {key: [value, value...]}
                    Object.keys(arr).map(function (type) {
                        // not array available for the given key
                        if (!selected_attributes_by_type[type]) {
                            selected_attributes_by_type[type] = []
                        }

                        // insert value if not inserted yet
                        if (selected_attributes_by_type[type].indexOf(arr[type]) <= -1) {
                            selected_attributes_by_type[type].push(arr[type]);
                        }
                    })
                }
            });

            // selected item not contain product then de-select all selected option hare
            if (Object.keys(selected_attributes_by_type).length == 0) {
                $('.size-lists li.active').each(function () {
                    let sizeItem = $(this).parent().parent();

                    sizeItem.find('input[type=hidden]').val('');
                    sizeItem.find('input[type=text]').val('');
                });

                $('.size-lists li.active').removeClass("active");
                $('.size-lists li.disabled-option').removeClass("disabled-option");

                let el = $(selected_item);
                let value = el.data('displayValue');

                el.addClass("active");
                $(this).find('input[type=hidden]').val(value);
                $(this).find('input[type=text]').val(el.data('value'));

                selectedAttributeSearch();
            }

            // keep only available matches selectable
            Object.keys(selected_attributes_by_type).map(function (type) {
                // initially, disable all buttons
                $('.size-lists[data-type="' + type + '"] li').addClass('disabled-option');

                // make buttons selectable for the available options
                selected_attributes_by_type[type].map(function (value) {
                    let available_buttons = $('.size-lists[data-type="' + type + '"] li[data-display-value="' + value + '"]');
                    available_buttons.map(function (key, el) {
                        $(el).removeClass('disabled-option');
                    })
                })
            });
            // todo check is empty object
            // selected_attributes_by_type
        }

        function getSelectedOptions() {
            let selected_options = {};

            // get all selected attributes in {key:value} format
            available_options.map(function (k, option) {
                let selected_option = $(option).find('li.active');
                let type = selected_option.closest('.size-lists').data('type');
                let value = selected_option.data('displayValue');

                if (type && value) {
                    selected_options[type] = value;
                }
            });

            return selected_options;
        }

        function syncImage(selected_options) {
            //todo fire when attribute changed
            let hashed_key = getSelectionHash(selected_options);
            //single-main-image slick-slide slick-current slick-active
            let product_image_el = $('#shop_details_gallery_slider .slick-current.slick-active .long-img img');

            let img_original_src = product_image_el.parent().data('src');
            // if selection has any image to it
            if (additional_info_store[hashed_key]) {
                let attribute_image = additional_info_store[hashed_key].image;
                if (attribute_image) {
                    product_image_el.attr('src', attribute_image);
                    product_image_el.parent().attr('data-src',attribute_image);
                    //chagne zoom image also
                }
            } else {
                product_image_el.attr('src', img_original_src);
                 product_image_el.parent().attr('data-src',img_original_src);
                //chagne zoom image also
            }
        }

        function syncPrice(selected_options) {
            let hashed_key = getSelectionHash(selected_options);

            let product_price_el = $('#price');
            let product_main_price = Number(String(product_price_el.data('mainPrice'))).toFixed(2);
            let site_currency_symbol = product_price_el.data('currencySymbol');
            // console.log(additional_info_store)

            // if selection has any additional price to it
            if (additional_info_store[hashed_key]) {
                let attribute_price = additional_info_store[hashed_key]['additional_price'];
                if (attribute_price) {
                    let price = Number(product_main_price) + Number(attribute_price);
                    product_price_el.text(site_currency_symbol + Number(price).toFixed(2));
                }
            } else {
                product_price_el.text(site_currency_symbol + product_main_price);
            }
        }

        function validateSelectedAttributes() {
            let selected_options = get_selected_options();
            let hashed_key = getSelectionHash(selected_options);

            // validate if product has any attribute
            if (attribute_store.length) {
                if (!Object.keys(selected_options).length) {
                    return false;
                }

                if (!additional_info_store[hashed_key]) {
                    return false;
                }

                return !!additional_info_store[hashed_key]['pid_id'];
            }

            return true;
        }
    $(".radius-percent-50").click(function(){
            
            var valu=$(this).attr('data-image');
            // console.log(valu)
            // $(".single-main-image").removeClass("slick-current slick-active")
            // $(".single-main-image").attr("aria-hidden",'true')
            // $('.single-main-image').css('opacity', '0');
            // $("."+valu).addClass('slick-current slick-active')
            // $("."+valu).attr('aria-hidden','false')
            // $("."+valu).css('opacity', '1');
            let product_image_el = $('#shop_details_gallery_slider .slick-current.slick-active .long-img img');

           
                    product_image_el.attr('src', valu);
                    product_image_el.parent().attr('data-src',valu);
                    //chagne zoom image also
          
        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mobidvab/public_html/core/resources/views/frontend/product/details.blade.php ENDPATH**/ ?>