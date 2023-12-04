

<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Wishlist')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php if(empty($all_wishlist_items)): ?>
    <div class="row justify-content-center my-5">
        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.frontend.page.empty','data' => ['text' => get_static_option('empty_wishlist_text'),'image' => get_static_option('empty_wishlist_image')]]); ?>
<?php $component->withName('frontend.page.empty'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['text' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(get_static_option('empty_wishlist_text')),'image' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(get_static_option('empty_wishlist_image'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
    </div>
<?php else: ?>
    <div class="wishlist-area-wrapper">
        <div class="container custom-container-1318">
            <div class="row">
                <div class="col-lg-12">
                    <div class="wishlist-inner-content">
                        <table>
                            <thead>
                            <tr>
                                <th><?php echo e(__('product name')); ?></th>
                                <th><?php echo e(__('unit price')); ?></th>
                                <th><?php echo e(__('quantity')); ?></th>
                                <th><?php echo e(__('total')); ?></th>
                                <th><?php echo e(__('action')); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $all_wishlist_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $product = $products->find($key);
                                    ?>
                                    <?php $__currentLoopData = $item; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $wishlist_item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr class="in-stock">
                                            <td class="product-info product-mane ">
                                                <span class="product-info-wrap">
                                                    <?php echo render_image_markup_by_attachment_id($product->image, 'product-title', 'grid'); ?>

                                                    <a href="<?php echo e(route('frontend.products.single', ['slug' => $product->slug])); ?>">
                                                        <span class="product-title"> <?php echo e($product->title); ?> <?php echo e(getItemAttributesName($wishlist_item['attributes'])); ?></span>
                                                    </a>
                                                </span>
                                            </td>
                                            <td class="unit-price"><?php echo e(float_amount_with_currency_symbol($wishlist_item['attributes']['price'] ?? $product->sale_price)); ?></td>
                                            <td class="status">
                                                <input type="number" class="form-control item_quantity" value="<?php echo e($wishlist_item['quantity'] ?? 0); ?>">
                                            </td>
                                            <td class="add-to-cart-btn">
                                                <?php
                                                $cart_price = $wishlist_item['attributes']['price'] ?? $product->sale_price;
                                                $total_price = $cart_price * $wishlist_item['quantity'];
                                                ?>
                                                <?php echo e(float_amount_with_currency_symbol($total_price)); ?>

                                            </td>
                                            <td class="trash">
                                                <a href="#" class="remove_wishlist_item trash" data-id="<?php echo e($wishlist_item['id']); ?>" data-attr="<?php echo e(json_encode($wishlist_item['attributes'])); ?>">
                                                    <i class="las la-trash icon"></i>
                                                </a>
                                                <a href="#" data-attributes="<?php echo e(json_encode($wishlist_item['attributes'])); ?>" data-id="<?php echo e($product->id); ?>" class="add-cart-style-01 add_to_cart_ajax_with_attributes">
                                                    <i class="las la-shopping-bag icon"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="wishlist-btn-box">
                        <div class="coupon-and-btn">
                            <div class="btn-wrapper">
                                <a href="#" class="btn-default rounded-btn disable clear_wishlist"><?php echo e(__('Clear Wishlist')); ?></a>
                            </div>
                            <div class="btn-wrapper">
                                <form action="<?php echo e(route('frontend.products.wishlist.send.to.cart')); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="btn-default rounded-btn"><?php echo e(__('Add to cart all')); ?></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script>
    (function ($) {
        'use script'
        $(document).ready(function () {
            toastr.options.progressBar = true;

            $('.remove_wishlist_item').on('click', function (e) {
                e.preventDefault();
                let id = $(this).data('id');
                let attributes = $(this).data('attr');
                $.ajax({
                    url: '<?php echo e(route("frontend.products.wishlist.ajax.remove")); ?>',
                    type: 'POST',
                    data: {
                        _token: '<?php echo e(csrf_token()); ?>',
                        id: id,
                        product_attributes: attributes
                    },
                    success: function (data) {
                        if (data.type === 'success') {
                            toastr.success(data.msg);
                            setTimeout(function () {
                                location.reload();
                            }, 500);
                        }
                    },
                    error: function (err) {
                        toastr.error('<?php echo e(__("Something went wrong")); ?>');
                    }
                });
            });
    
            $('.clear_wishlist').on('click', function (e) {
                e.preventDefault();
                $.ajax({
                    url: '<?php echo e(route("frontend.products.wishlist.ajax.clear")); ?>',
                    type: 'POST',
                    data: {
                        _token: '<?php echo e(csrf_token()); ?>',
                    },
                    success: function (data) {
                        if (data.type === 'success') {
                            toastr.success(data.msg);
                            setTimeout(function () {
                                location.reload();
                            }, 500);
                        }
                    },
                    error: function (err) {
                        toastr.error('<?php echo e(__("Something went wrong")); ?>');
                    }
                });
            });

            $('.add_to_cart_ajax_with_attributes').on('click', function (e) {
                e.preventDefault();
                let data = $(this).data();
                let id = data['id'];
                let attributes = data['attributes'];
                let quantity = $(this).closest('tr').find('.item_quantity').val();
                $.ajax({
                    url: '<?php echo e(route("frontend.products.wishlist.send.to.cart.single")); ?>',
                    type: 'POST',
                    data: {
                        _token: '<?php echo e(csrf_token()); ?>',
                        id: id,
                        product_attributes: attributes,
                        quantity: quantity,
                    },
                    success: function (data) {
                        if (data['type'] === 'success') {
                            toastr.success(data['msg']);
                            setTimeout(function () {
                                location.reload();
                            }, 500);
                        }
                    },
                    error: function (err) {
                        toastr.error('<?php echo e(__("Something went wrong")); ?>');
                    }
                });
            });
        });
    })(jQuery)
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mobidvab/public_html/core/resources/views/frontend/wishlist/all.blade.php ENDPATH**/ ?>