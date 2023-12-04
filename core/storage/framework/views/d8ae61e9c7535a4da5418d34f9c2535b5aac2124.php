
<div class="inventory_item shadow-sm rounded" <?php if(isset($key)): ?> data-id="<?php echo e($key); ?>" <?php endif; ?>>
    <?php if(isset($inventoryDetail) && !is_null($inventoryDetail)): ?>
        <input type="hidden" name="inventory_details_id[]" value="<?php echo e($inventoryDetail->id); ?>">
    <?php endif; ?>
    <div class="row">
        <div class="col">
            <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label for="item_size"><?php echo e(__('Item Size')); ?></label>
                        <select name="item_size[]" id="item_size" class="form-control">
                            <option ><?php echo e(__('Select Size')); ?></option>
                            <?php $__currentLoopData = $sizes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($size->id); ?>"
                                        <?php if(isset($selectedSize) && $selectedSize->id == $size->id): ?> selected <?php endif; ?>><?php echo e($size->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="item_color"><?php echo e(__('Item Color')); ?></label>
                        <select name="item_color[]" id="item_color" class="form-control">
                            <option ><?php echo e(__('Select Color')); ?></option>
                            <?php $__currentLoopData = $colors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($color->id); ?>"
                                        <?php if(isset($selectedColor) && $selectedColor->id == $color->id): ?> selected <?php endif; ?>><?php echo e($color->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="item_additional_price"><?php echo e(__('Additional Price')); ?></label>
                        <input type="number" step="0.01" name="item_additional_price[]" id="item_additional_price"
                               class="form-control" min="0" placeholder="<?php echo e(__('Additional price')); ?>"
                               <?php if(isset($inventoryDetail)): ?>
                                    value="<?php echo e(optional($inventoryDetail)->additional_price ?? 0); ?>"
                               <?php endif; ?>
                        >
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="item_stock_count"><?php echo e(__('Stock Count')); ?> <i class="las la-star required-filed"></i></label>
                        <input type="number" name="item_stock_count[]" id="item_stock_count" class="form-control"
                               min="0" placeholder="<?php echo e(__('Stock Count')); ?>"
                               <?php if(isset($inventoryDetail)): ?>
                                    value="<?php echo e(optional($inventoryDetail)->stock_count ?? 0); ?>"
                               <?php endif; ?>
                        >
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <?php
                            $image_id = isset($inventoryDetail) ? optional($inventoryDetail)->image ?? '' : '';
                        ?>
                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.media-upload','data' => ['title' => __('Attribute Image'),'id' => $image_id,'name' => 'item_image[]','dimentions' => '1280x1280']]); ?>
<?php $component->withName('media-upload'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Attribute Image')),'id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($image_id),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('item_image[]'),'dimentions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('1280x1280')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="item_selected_attributes">
                <?php if(isset($inventoryDetail) && !is_null($inventoryDetail) && !is_null($inventoryDetail->includedAttributes)): ?>
                    <?php $__currentLoopData = $inventoryDetail->includedAttributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="form-row">
                            <input type="hidden" name="item_attribute_id[<?php echo e($key); ?>][]" value="<?php echo e($attribute->id); ?>">
                            <div class="col">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="item_attribute_name[<?php echo e($key); ?>][]" value="<?php echo e($attribute->attribute_name); ?>" readonly />
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="item_attribute_value[<?php echo e($key); ?>][]" value="<?php echo e($attribute->attribute_value); ?>" readonly />
                                </div>
                            </div>
                            <div class="col-auto">
                                <button class="btn btn-danger remove_details_attribute" data-id="<?php echo e($attribute->id); ?>"> x </button>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </div>
            <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label><?php echo e(__('Attribute Name')); ?></label>
                        <select class="form-control item_attribute_name">
                            <option value=""><?php echo e(__('Select Attribute')); ?></option>
                            <?php $__currentLoopData = $allAvailableAttributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name => $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($attribute->id); ?>"
                                        data-terms="<?php echo e($attribute->terms); ?>"><?php echo e($name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label><?php echo e(__('Attribute Value')); ?></label>
                        <select class="form-control item_attribute_value">
                            <option value=""><?php echo e(__('Select attribute value')); ?></option>
                        </select>
                    </div>
                </div>
                <div class="col-auto">
                    <button type="button" class="btn btn-success margin-top-30 add_item_attribute">
                        <i class="las la-arrow-up"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="col-auto">
            <div class="item_repeater_add_remove">
                <div class="repeater_button">
                    <button type="button" class="btn btn-success btn-xs add"> +</button>
                </div>
                <?php if(!isset($isFirst) || !$isFirst): ?>
                    <div class="repeater_button">
                        <button type="button" class="btn btn-danger btn-xs remove"> -</button>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>




<?php if(isset($not_needed)): ?>
<div class="variant_variant_info_repeater">
    <div class="form-row">
        <div class="col">
            <div class="form-group">
                <label for="variant_color"><?php echo e(__('Color')); ?></label>
                <?php if(isset($variantId)): ?>
                    <input type="hidden" class="variant_id" name="variant_id[]" value="<?php echo e($variantId); ?>">
                <?php endif; ?>
                <select class="form-control" name="variant_color[]" id="variant_color">
                    <option value=""><?php echo e(__('Select Color')); ?></option>
                    <?php $__currentLoopData = $colors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($color->id); ?>"
                                <?php if(isset($selectedColor) && $selectedColor->id == $color->id): ?> selected <?php endif; ?>><?php echo e($color->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="variant_size"><?php echo e(__('Size')); ?></label>
                <select class="form-control" name="variant_size[]" id="variant_size">
                    <option value=""><?php echo e(__('Select Size')); ?></option>
                    <?php $__currentLoopData = $sizes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($size->id); ?>"
                                <?php if(isset($selectedSize) && $selectedSize->id == $size->id): ?> selected <?php endif; ?>><?php echo e($size->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="variant_stock_count"><?php echo e(__('Quantity')); ?></label>
                <input type="number" name="variant_stock_count[]" id="variant_stock_count" class="form-control"
                       step="0.01" <?php if(isset($quantity)): ?> value="<?php echo e($quantity); ?>" <?php endif; ?>>
            </div>
        </div>
        <div class="col-auto">
            <button type="button" class="btn btn-sm btn-success add_variant_info_btn"> +</button>
           <?php if($loop != 1): ?>
                <button type="button"
                        class="btn btn-sm btn-danger remove_this_variant_info_btn <?php if(isset($variantId)): ?> remove_variant <?php endif; ?>"
                        <?php if(isset($isFirst) && $isFirst): ?> readonly <?php endif; ?> > -
                </button>
           <?php endif; ?>
        </div>
    </div>
</div>
<?php endif; ?>
<?php /**PATH /home/mobidvab/public_html/core/resources/views/components/product/variant-info/repeater.blade.php ENDPATH**/ ?>