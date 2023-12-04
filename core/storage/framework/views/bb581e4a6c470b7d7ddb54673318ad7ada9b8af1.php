<ul class="cart-item-wrap">
    <?php $__currentLoopData = $all_wishlist_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php $product = $products->find($key); ?>
        <?php $__currentLoopData = $item; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $wishlist_item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $price = $wishlist_item['attributes']['price'] ?? $product->sale_price;
                $deleted_price = $product->price ?? null;
                if (!empty($wishlist_item['attributes']['price'])) {
                    if ($wishlist_item['attributes']['price'] != $product->sale_price) {
                        $deleted_price = $product->sale_price;
                    }
                }
            ?>
            <li class="single-cart-item">
                <div class="first-content">
                    <div class="cart-img">
                        <a href="<?php echo e(route('frontend.products.single', $product->slug)); ?>">
                            <?php echo render_image_markup_by_attachment_id($product->image, '', 'grid'); ?>

                        </a>
                    </div>
                    <div class="cart-content">
                        <h4 class="product-title">
                            <a href="<?php echo e(route('frontend.products.single', $product->slug)); ?>">
                                <?php echo e($product->title); ?> <?php echo e(getItemAttributesName($wishlist_item['attributes'])); ?>

                            </a>
                        </h4>
                        <div class="cart-price">
                            <span class="new"><?php echo e(float_amount_with_currency_symbol($price)); ?></span>
                            <?php if($deleted_price): ?>
                            <span><del><?php echo e(float_amount_with_currency_symbol($deleted_price)); ?></del></span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="second-content">
                    <span class="number-of-product"> (<?php echo e($wishlist_item['quantity']); ?>)</span>
                    <div class="del-icon">
                        <a href="#" class="remove_wishlist_item" data-id="<?php echo e($wishlist_item['id']); ?>" data-attr="<?php echo e(json_encode($wishlist_item['attributes'])); ?>">
                            <i class="lar la-trash-alt"></i>
                        </a>
                    </div>
                </div>
            </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ul>
<div class="btn-section">
    <div class="btn-wrapper">
        <a href="<?php echo e(route('frontend.products.wishlist')); ?>" class="btn-default"><?php echo e(__('view wishlist')); ?></a>
    </div>
</div>
<?php /**PATH /home/mobidvab/public_html/core/resources/views/frontend/partials/mini-wishlist.blade.php ENDPATH**/ ?>