<?php if($product): ?>
<tr class="product_row">
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.table.td-image','data' => ['image' => $product->image]]); ?>
<?php $component->withName('table.td-image'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['image' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product->image)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
    <td class="product_name">
        <b><?php echo e($product->title); ?></b>
        <input type="hidden" name="products[<?php echo e($count); ?>][]" value="<?php echo e($product->id); ?>">
        <input type="hidden" name="count_arr[<?php echo e($count); ?>]" value="<?php echo e($count); ?>">
        <?php if($product->attributes): ?>
            <?php $attributes_arr = $product->attributes ? json_decode($product->attributes, true) : []; ?>
            <ul class="ml-2">
                <?php if(count($attributes_arr)): ?>
                    <?php $__currentLoopData = $attributes_arr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attr_id => $attributes): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <b class="text-secondary"><?php echo e($attributes[0]['type']); ?></b>
                        <ul class="product_attribute_list">
                            <?php $__currentLoopData = $attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $additional_price = isset($attribute['additional_price']) ? float_amount_with_currency_symbol($attribute['additional_price']) : 0;
                                $attribute_arr = [
                                    'id' => $product->id,
                                    $attribute['type'] => $attribute['name'],
                                    'price' => $attribute['additional_price']
                                ];
                            ?>
                            <li class="ml-2">
                                <input type="radio" 
                                        name="product_attributes[<?php echo e($count); ?>][<?php echo e($product->id); ?>][<?php echo e($attribute['type']); ?>]" 
                                        id="product_attr[<?php echo e($product->id); ?>]" 
                                        data-add-price="<?php echo e($additional_price); ?>" 
                                        value="<?php echo e(json_encode($attribute_arr)); ?>"
                                        required
                                />
                                <?php echo e($attribute['name']); ?> 
                                <?php if($attribute['additional_price'] > 0): ?> +<?php echo e($additional_price); ?> <?php endif; ?>
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </ul>
        <?php else: ?>
            <?php
                $additional_price = isset($attribute['additional_price']) ? float_amount_with_currency_symbol($attribute['additional_price']) : 0;
                $attribute_arr = [
                    'price' => $product->sale_price ?? 0
                ];
            ?>
            <input type="hidden" 
                name="product_attributes[<?php echo e($count); ?>][<?php echo e($product->id); ?>]" 
                id="product_attr[<?php echo e($product->id); ?>]" 
                value="<?php echo e(json_encode($attribute_arr)); ?>"
                required
            />
        <?php endif; ?>
    </td>
    <td><input class="form-control" type="number" name="products_count[<?php echo e($count); ?>]" id="" required></td>
    <td><?php echo e(float_amount_with_currency_symbol($product->sale_price)); ?></td>
    <td>
        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.table.btn.swal.delete','data' => ['route' => route('homepage'),'selector' => 'delete_order_product']]); ?>
<?php $component->withName('table.btn.swal.delete'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['route' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('homepage')),'selector' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('delete_order_product')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
    </td>
</tr>
<?php endif; ?>
<?php /**PATH /home/mobidvab/public_html/core/resources/views/backend/partials/table/add-product-tr.blade.php ENDPATH**/ ?>