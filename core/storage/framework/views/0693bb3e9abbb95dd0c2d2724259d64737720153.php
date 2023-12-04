
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Compare')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <?php $compare_empty = is_array($display_compare_items) && empty($display_compare_items[0]) && empty($display_compare_items[1]); ?>

    <?php if($compare_empty): ?>
        <div class="only-img-page-wrapper cart padding-top-100 padding-bottom-100">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="img-box">
                            <?php echo render_image_markup_by_attachment_id(get_static_option('compare_empty_image')); ?>

                        </div>
                        <div class="content">
                            <p class="info"><?php echo e(get_static_option('compare_empty_text',__('No products added to compare'))); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="product-compare-wrapper padding-top-100 padding-bottom-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="produdt-compare-box table-responsive">
                            <table>
                                <thead>
                                <tr>
                                    <th>
                                        <p class="main-title"><?php echo e(get_static_option('compare_title',__('Product Comparison'))); ?></p>
                                        <p class="info"><?php echo e(get_static_option('compare_subtitle', __('There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some.'))); ?></p>
                                    </th>
                                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <th>
                                            <div class="img-box">
                                                <a href="#" data-id="<?php echo e($product->id); ?>" class="compare-close-btn remove_compare_item_ajax">
                                                    <i class="lar la-times-circle icon"></i>
                                                </a>
                                                <?php echo render_image_markup_by_attachment_id($product->image); ?>

                                            </div>
                                            <div class="info-box">
                                                <p class="title"><a href="<?php echo e(route('frontend.products.single', $product->slug)); ?>"><?php echo e($product->title); ?></a></p>
                                                <p class="price"><?php echo e(float_amount_with_currency_symbol($product->sale_price)); ?></p>
                                                <a href="#" class="remove-btn remove_compare_item_ajax" data-id="<?php echo e($product->id); ?>"><?php echo e(__('remove')); ?></a>
                                            </div>
                                        </th>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(!empty($categories)): ?>
                                    <tr>
                                        <td>
                                            <span class="same-s-1"><?php echo e(__('Category')); ?></span>
                                        </td>
                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if(!empty($category)): ?>
                                            <td>
                                                <a href="<?php echo e(route('frontend.products.category', [ 'id' => $category->id, 'slug' => \Str::slug($category->title ?? 'x')])); ?>" class="same-s-1"><?php echo e($category->title); ?></a>
                                            </td>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tr>
                                <?php endif; ?>

                                <?php if(!empty($all_ratings)): ?>
                                    <tr>
                                        <td>
                                            <span class="same-s-1"><?php echo e(__('Ratings')); ?></span>
                                        </td>
                                        <?php $__currentLoopData = $all_ratings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rating): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <td>
                                                <?php echo ratingMarkup($rating['avg'], $rating['count'].' '.__('Customer Review'), true); ?>

                                            </td>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tr>
                                <?php endif; ?>
                                <?php if($products && $products->count()): ?>
                                    <tr>
                                        <td>
                                            <span class="same-s-1"><?php echo e(__('Description')); ?></span>
                                        </td>
                                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <td>
                                                <span class="same-s-1"><?php echo e($product->summary); ?></span>
                                            </td>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="same-s-1"><?php echo e(__('Availability')); ?></span>
                                        </td>
                                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <td>
                                                
                                                    <?php $inventory = $product->inventory; ?>
                                                    <?php if($inventory): ?>
                                                        <?php if($inventory->sum('stock_count') - $inventory->sum('sold_count') > 0): ?>
                                                            <span class="same-s-1 stock"><?php echo e(__('In Stock')); ?></span>
                                                        <?php else: ?>
                                                           <span class="same-s-1 outofstock"> <?php echo e(__('Out of Stock')); ?></span>
                                                        <?php endif; ?>
                                                    <?php else: ?>
                                                        <span class="same-s-1 outofstock"><?php echo e(__('Not Available')); ?></span>
                                                    <?php endif; ?>
                                        </td>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tr>
                                <?php endif; ?>

                                <?php if($products && $products->count()): ?>
                                    <tr>
                                        <td>
                                            <?php echo e(__('Attributes')); ?>

                                        </td>
                                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <td>
                                                <?php
                                                    $product_attributes = getItemAttributes($product->id);
                                                    $item_attributes = '';
                                                ?>
                                                <?php $__currentLoopData = $product_attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name => $attributes): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <b><?php echo e($name); ?></b>:
                                                    <?php
                                                        $item_attributes = '';
                                                    ?>
                                                    <?php $__currentLoopData = $attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php
                                                            $item_attributes .= $attribute;
                                                            $item_attributes .= !$loop->last ? ', ' : '';
                                                        ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <span><?php echo e($item_attributes); ?></span>
                                                    <br>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </td>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tr>
                                <?php endif; ?>
                                <tr>
                                    <td></td>
                                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <td>
                                            <?php if($product->attributes): ?>
                                                <a href="<?php echo e(route('frontend.products.single', $product->slug)); ?>" class="default-btn browse-btn"><?php echo e(__('View Options')); ?></a>
                                            <?php else: ?>
                                                <a href="#" data-attributes="<?php echo e($product->attributes); ?>" data-id="<?php echo e($product->id); ?>" class="default-btn add_to_cart_ajax browse-btn"><?php echo e(__('Buy Now')); ?></a>
                                            <?php endif; ?>
                                        </td>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="btn-wrapper d-flex justify-content-between">
                            <?php if(isset(request()->index) && request()->index > 1): ?>
                                <a href="<?php echo e(route('frontend.products.compare', ['index' => request()->index - 1])); ?>" class="btn-default color-reverse"><?php echo e(__('Previous Item')); ?></a>
                            <?php endif; ?>
                            <?php
                                $next_index = isset(request()->index) && request()->index > 1 ? request()->index : 1;
                            ?>
                            <a href="<?php echo e(route('frontend.products.compare', ['index' => $next_index + 1])); ?>" class="btn-default color-reverse"><?php echo e(__('Next Item')); ?></a>
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
            'use strict'
            $(document).ready(function () {
                $('.remove_compare_item_ajax').on('click', function (e) {
                    e.preventDefault();
                    let id = $(this).data('id');
                    $.ajax({
                        url: '<?php echo e(route("frontend.products.compare.ajax.remove")); ?>',
                        type: 'POST',
                        data: {
                            _token: '<?php echo e(csrf_token()); ?>',
                            id: id
                        },
                        success: function (data) {
                            if (data) {
                                toastr.error('<?php echo e(__("Item removed")); ?>');
                                setTimeout(function () {
                                    location.reload();
                                }, 500);
                            }
                        },
                        error: function (err) {
                            toastr.error('<?php echo e(__("Something went wrong, failed to remove item")); ?>');
                        }
                    });
                });
            })
        })(jQuery)
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mobidvab/public_html/core/resources/views/frontend/compare/all.blade.php ENDPATH**/ ?>