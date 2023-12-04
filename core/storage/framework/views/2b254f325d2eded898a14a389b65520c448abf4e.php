<ul class="cart-item-wrap">
    <?php $__currentLoopData = $all_cart_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            $product = $products->find($key);
            $pid = $product_stock_attributes
                                        ->where('id', $key)
                                        ->where('attribute_name', 'Color')
                                        ->where('attribute_value', 'Green');
            $pid_id = $pid->count() ? $pid->first()->inventory_details_id : null;
        ?>

        <?php $__currentLoopData = $item; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart_item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $price = $cart_item['attributes']['price'] ?? $product->sale_price;
                $deleted_price = $product->price ?? null;
                if (!empty($cart_item['attributes']['price'])) {
                    if ($cart_item['attributes']['price'] != $product->sale_price) {
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
                                <?php echo e($product->title); ?> <?php echo e(getItemAttributesName($cart_item['attributes'])); ?>

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
                    <span class="number-of-product"> (<?php echo e($cart_item['quantity']); ?>)</span>
                    <div class="del-icon">
                        <a href="#" class="remove_cart_item"
                           data-id="<?php echo e($cart_item['id']); ?>"
                           data-attr="<?php echo e(json_encode($cart_item['attributes'])); ?>"
                           <?php if(isset($pid_id) && $pid_id): ?> data-pid_id="<?php echo e($pid_id); ?>" <?php endif; ?>
                        >
                            <i class="lar la-trash-alt"></i>
                        </a>
                    </div>
                </div>
            </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ul>
<div class="total-price">
    <span class="text"><?php echo e(__('Subtotal')); ?></span>
    <span class="text sum"><?php echo e(float_amount_with_currency_symbol($subtotal)); ?></span>
</div>
<div class="btn-section">
    <div class="btn-wrapper">
        <a href="<?php echo e(route('frontend.products.cart')); ?>" class="btn-default"><?php echo e(__('Shopping Cart')); ?></a>
        <a href="<?php echo e(route('frontend.checkout')); ?>" class="btn-default"><?php echo e(__('Checkout')); ?></a>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\mobiq\core\resources\views/frontend/partials/mini-cart.blade.php ENDPATH**/ ?>