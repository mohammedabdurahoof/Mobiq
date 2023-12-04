
<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('New Product')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.media.css','data' => []]); ?>
<?php $component->withName('media.css'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.product.more-info.css','data' => []]); ?>
<?php $component->withName('product.more-info.css'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.product.variant-info.css','data' => []]); ?>
<?php $component->withName('product.variant-info.css'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.niceselect.css','data' => []]); ?>
<?php $component->withName('niceselect.css'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/bootstrap-tagsinput.css')); ?>">
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.summernote.css','data' => []]); ?>
<?php $component->withName('summernote.css'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
    <style>
        #attribute_price_container {
            display: none;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40">
                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.msg.error','data' => []]); ?>
<?php $component->withName('msg.error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.msg.flash','data' => []]); ?>
<?php $component->withName('msg.flash'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="text-right mb-5">
                    <a href="<?php echo e(route('admin.products.all')); ?>" class="btn btn-primary px-4"><?php echo e(__('All Products')); ?></a>
                </div>
                <form action="<?php echo e(route('admin.products.new')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="row mt-3">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-body p-5">
                                    <h5 class="mb-5"><?php echo e(__('Product Information')); ?></h5>
                                    <div class="form-group">
                                        <label for="title"><?php echo e(__('Name')); ?> <i class="las la-star required-filed"></i></label>
                                        <input type="text" name="title" id="title" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="slug"><?php echo e(__('Slug')); ?> <i class="las la-star required-filed"></i></label>
                                        <input type="text" name="slug" id="slug" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="summary"><?php echo e(__('Summary')); ?> <i class="las la-star required-filed"></i></label>
                                        <textarea class="form-control" name="summary" id="summary" cols="30" rows="3" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="description"><?php echo e(__('Description')); ?> <i class="las la-star required-filed"></i></label>
                                        <textarea class="form-control summernote" name="description" id="description" cols="30" rows="10" required></textarea>
                                    </div>
                                    <div class="form-group " id="blog_tag_list">
                                        <label for="datetimepicker1"><?php echo e(__('Tags')); ?></label>
                                        <input type="text" class="form-control tags_filed"
                                               name="tags" id="datetimepicker1">

                                            <div id="show-autocomplete" style="display: none;">
                                                <ul class="autocomplete-warp" ></ul>
                                            </div>
                                    </div>
                                    <div id="attribute_price_container">
                                        <h5 class="my-3"><?php echo e(__('Attributes')); ?></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card mt-3">
                                <div class="card-body px-5 pb-5">
                                    <div class="additional_info_container">
                                        <h5 class="mb-3"><?php echo e(__('Additional Information')); ?></h5>
                                        <p class="mb-3"><?php echo e(__('This additional info will display between description and reviews.')); ?></p>
                                        <div class="additional_info">
                                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.product.more-info.repeater','data' => ['isFirst' => true]]); ?>
<?php $component->withName('product.more-info.repeater'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['isFirst' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card mt-3">
                                <div class="card-body px-5 pb-5">
                                    <div class="variant_info_container">
                                        <h5 class="mb-3"><?php echo e(__('Inventory')); ?></h5>
                                        <p class="mb-4">
                                            <?php echo e(__('Inventory will be variant of this product.')); ?> <br>
                                            <?php echo e(__('All inventory stock count will be merged and replace to main stock of
                                            this product.')); ?><br>
                                            <?php echo e(__('Stock count filed is required.')); ?>

                                        </p>
                                        <div class="inventory_items_container">
                                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.product.variant-info.repeater','data' => ['isFirst' => true,'colors' => $product_colors,'sizes' => $product_sizes,'allAvailableAttributes' => $all_attribute]]); ?>
<?php $component->withName('product.variant-info.repeater'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['is-first' => true,'colors' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product_colors),'sizes' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product_sizes),'all-available-attributes' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($all_attribute)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5 class="mb-5 mt-3"><?php echo e(__('Stock Information')); ?></h5>
                                    <div class="form-group">
                                        <label for="sku"><?php echo e(__('Product SKU')); ?> <i class="las la-star required-filed"></i></label>
                                        <input type="text" id="sku" name="sku" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="stock_count"><?php echo e(__('Items in Stock')); ?><i class="las la-star required-filed"></i></label>
                                        <input type="number" id="stock_count" name="stock_count" class="form-control" required>
                                        <small><?php echo e(__('This will be replaced with the sum of inventory items if any inventory item is registered.')); ?></small>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="mb-5 mt-3"><?php echo e(__('More Information')); ?></h5>
                                    <div class="form-row mb-3">
                                        <div class="col">
                                            <label for="price"><?php echo e(__('Price')); ?></label>
                                            <input type="number" name="price" id="price" class="form-control" step="0.01">
                                        </div>
                                        <div class="col">
                                            <label for="sale_price"><?php echo e(__('Sale Price')); ?><i class="las la-star required-filed"></i></label>
                                            <input type="number" name="sale_price" id="sale_price" class="form-control" step="0.01" required>
                                        </div>
                                    </div>
                                    <div class="form-row mb-3 d-none">
                                        <div class="col">
                                            <label for="tax_percentage"><?php echo e(__('Tax Percentage')); ?></label>
                                            <input type="number" name="tax_percentage" id="tax_percentage" class="form-control" step="0.01">
                                        </div>
                                    </div>
                                    <div class="form-row mb-3">
                                        <div class="col">
                                            <label for="unit"><?php echo e(__('Quantity')); ?></label>
                                            <input type="number" class="form-control" name="unit" id="unit" step="0.01">
                                        </div>
                                        <div class="col">
                                            <label for="uom"><?php echo e(__('Unit Type')); ?></label>
                                            <select name="uom" id="uom" class="form-control">
                                                <option value=""><?php echo e(__('Select unit of measurement')); ?></option>
                                                <?php $__currentLoopData = $all_measurement_units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($unit->name); ?>"><?php echo e($unit->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="attributes_options"><?php echo e(__('Attributes')); ?></label>
                                        <div class="form-row">
                                            <div class="col">
                                                <select class="form-control" name="attributes_options" id="attributes_options">
                                                    <option value=""><?php echo e(__('Select Attribute')); ?></option>
                                                    <?php $__currentLoopData = $all_attribute; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($attribute->id); ?>" data-terms="<?php echo e($attribute->terms); ?>"><?php echo e($attribute->title); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="attribute_container"></div>
                                    <div class="form-group">
                                        <label for="category_id"><?php echo e(__('Category')); ?><i class="las la-star required-filed"></i></label>
                                        <select class="form-control" name="category_id" id="category_id" required>
                                            <?php $__currentLoopData = $all_category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($category->id); ?>"><?php echo e($category->title); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="sub_category_id"><?php echo e(__('Sub-category')); ?><i class="las la-star required-filed"></i></label>
                                        <select class="form-control nice-select wide" name="sub_category_id[]" id="sub_category_id" multiple required>
                                            <?php $__currentLoopData = $all_sub_category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($subcategory->id); ?>"><?php echo e($subcategory->title); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <span class="text-secondary"><?php echo e(__('Press ')); ?> <kbd><?php echo e(__('Ctrl')); ?></kbd> <?php echo e(__(' and Click to select multiple options')); ?></span>
                                    </div>
                                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.media-upload','data' => ['title' => __('Image'),'name' => 'image','dimentions' => '1280x1280','multiple' => true]]); ?>
<?php $component->withName('media-upload'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Image')),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('image'),'dimentions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('1280x1280'),'multiple' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                    <div class="form-group">
                                        <label for="badge"><?php echo e(__('Badge')); ?></label>
                                        <input type="text" name="badge" id="badge" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="status"><?php echo e(__('Status')); ?> <i class="las la-star required-filed"></i></label>
                                        <select class="form-control" name="status" id="status" required>
                                            <option value="draft"><?php echo e(__('Draft')); ?></option>
                                            <option value="publish"><?php echo e(__('Publish')); ?></option>
                                        </select>
                                    </div>
                                    <div class="text-center mt-5">
                                        <button class="btn btn-primary"><?php echo e(__('Create Product')); ?></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.media.markup','data' => []]); ?>
<?php $component->withName('media.markup'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.media.js','data' => []]); ?>
<?php $component->withName('media.js'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.product.variant-info.js','data' => ['colors' => $product_colors,'sizes' => $product_sizes,'allAttributes' => $all_attribute]]); ?>
<?php $component->withName('product.variant-info.js'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['colors' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product_colors),'sizes' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product_sizes),'all-attributes' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($all_attribute)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.niceselect.js','data' => []]); ?>
<?php $component->withName('niceselect.js'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.summernote.js','data' => []]); ?>
<?php $component->withName('summernote.js'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<script src="<?php echo e(asset('assets/backend/js/bootstrap-tagsinput.js')); ?>"></script>
<script src="<?php echo e(asset('assets/common/js/typeahead.bundle.min.js')); ?>"></script>

<script>
    (function ($) {
        "use strict"
        $(document).ready(function () {
            let inventory_item_id = 0;

            $('.summernote').summernote({
                height: 500,   //set editable area's height
                codemirror: { // codemirror options
                    theme: 'monokai'
                },
                callbacks: {
                    onChange: function(contents, $editable) {
                        $(this).prev('input').val(contents);
                    }
                }
            });

            $('#attributes_options').on('change', function () {
                let attributes_options = $('#attributes_options');
                let title = attributes_options.find(':selected').text();
                let title_id = attributes_options.val();
                let terms = attributes_options.find(':selected').data('terms');
                let options = '';

                terms.forEach(e => {
                    options += `<option value="${e}">${e}</option>`;
                });

                let html =  `<div class="form-group">
                               <label>${title}</label>
                               <select class="form-control" data-attr-id="${title_id}" data-attr-name="${title}" multiple>
                                   ${options}
                               </select>
                               <small class="text-secondary"><?php echo e(__('Double click on an option to add')); ?></small>
                            </div>`;

                $('#attribute_container').html(html);
            });

            let nice_select = $('.nice-select');
            if (nice_select.length) {
                nice_select.niceSelect();
            }

            $('#title').on('keyup', function () {
                let title_text = $(this).val();
                $('#slug').val(convertToSlug(title_text))
            });

            $(document).on('click', '.add_item_attribute', function (e) {
                let container = $(this).closest('.inventory_item');
                let attribute_name_field = container.find('.item_attribute_name');
                let attribute_value_field = container.find('.item_attribute_value');
                let attribute_name = attribute_name_field.find('option:selected').text();
                let attribute_value = attribute_value_field.find('option:selected').text();

                let container_id = container.data('id');

                if (!container_id) {
                    container_id = 0;
                }

                if (attribute_name_field.val().length && attribute_value_field.val().length) {
                    let attribute_repeater = '';
                    attribute_repeater += '<div class="form-row">';
                    attribute_repeater += '<input type="hidden" name="item_attribute_id[' + container_id + '][]" value="">';
                    attribute_repeater += '<div class="col">';
                    attribute_repeater += '<div class="form-group">';
                    attribute_repeater += '<input type="text" class="form-control" name="item_attribute_name[' + container_id + '][]" value="' + attribute_name + '" readonly/>';
                    attribute_repeater += '</div>';
                    attribute_repeater += '</div>';
                    attribute_repeater += '<div class="col">';
                    attribute_repeater += '<div class="form-group">';
                    attribute_repeater += '<input type="text" class="form-control" name="item_attribute_value[' + container_id + '][]" value="' + attribute_value + '" readonly/>';
                    attribute_repeater += '</div>';
                    attribute_repeater += '</div>';
                    attribute_repeater += '<div class="col-auto">';
                    attribute_repeater += '<button class="btn btn-danger remove_details_attribute"> x </button>';
                    attribute_repeater += '</div>';
                    attribute_repeater += '</div>';

                    container.find('.item_selected_attributes').append(attribute_repeater);

                    attribute_name_field.val('');
                    attribute_value_field.val('');
                } else {
                    toastr.warning('<?php echo e(__("Select both attribute name and value")); ?>');
                }
            });

            $(document).on('click', '.repeater_button .add', function (e) {
                let inventory_item = `<?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.product.variant-info.repeater','data' => ['colors' => $product_colors,'sizes' => $product_sizes,'allAvailableAttributes' => $all_attribute]]); ?>
<?php $component->withName('product.variant-info.repeater'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['colors' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product_colors),'sizes' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product_sizes),'all-available-attributes' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($all_attribute)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>`;

                if (inventory_item_id < 1) {
                    inventory_item_id = $('.inventory_items_container .inventory_item').length;
                }

                $('.inventory_items_container').append(inventory_item);
                $('.inventory_items_container .inventory_item:last-child').data('id', inventory_item_id + 1);
            });

            $(document).on('click', '.repeater_button .remove', function (e) {
                $(this).closest('.inventory_item').remove();
            });

            $(document).on('click', '.remove_attribute', function (e) {
                function removeRow(context) {
                    $(context).closest('.row').remove();
                }

                function setContainerVisibility() {
                    if ($('#attribute_price_container .row').length < 1) {
                        $('#attribute_price_container').hide();
                    }
                }

                e.preventDefault();
                let id = $(this).data('id');
                let type = $(this).data('type');
                let value = $(this).data('value');

                if (id) {
                    $.post('<?php echo e(route('admin.products.inventory.attribute.delete')); ?>', {
                        _token: '<?php echo e(csrf_token()); ?>',
                        id: id,
                        type: type,
                        value: value,
                    }).then(function (data) {
                        toastr[data['status']](data['msg']);

                        if (data['status']) {
                            removeRow(this);
                            setContainerVisibility();
                            setTimeout(function () {
                                location.reload();
                            }, 1000);
                        }
                    });
                } else {
                    removeRow(this);
                    setContainerVisibility();
                }
            });

            $(document).on('change', '.item_attribute_name', function () {
                let terms = $(this).find('option:selected').data('terms');
                let terms_html = '<option value=""><?php echo e(__("Select attribute value")); ?></option>';
                terms.map(function (term) {
                    terms_html += '<option value="'+term+'">'+term+'</option>';
                });
                $(this).closest('.inventory_item').find('.item_attribute_value').html(terms_html);
            })

            $(document).on('click', '.remove_details_attribute', function (e) {
                e.preventDefault();
                let id = $(this).data('id');

                function remove_row(context) {
                    $(context).closest('.form-row').remove();
                }

                if (!id) {
                    remove_row(this);
                } else {
                    $.post('<?php echo e(route('admin.products.inventory.details.attribute.delete')); ?>', {id: id, _token: '<?php echo e(csrf_token()); ?>'}).then(function (data) {
                        toastr[data['type']](data['msg']);
                        if (data.msg) {
                            remove_row(this);
                            setTimeout(function () {
                                location.reload();
                            }, 500);
                        }
                    });
                }
            })

            $(document).on('click', '.remove_attribute', function () {
                $(this).closest('.row').remove();
                if ($('#attribute_price_container .row').length < 1) {
                    $('#attribute_price_container').hide();
                }
            });

            $(document).on('dblclick', '#attribute_container select option', function (e) {
                let attribute_title = $(e.target).parent().data('attrName');
                let attribute_id = $(e.target).parent().data('attrId');
                let selected_attribute_value = e.target.value;
                let attribute_price_container = $('#attribute_price_container');

                attribute_price_container.append(
                    `<div class="row attribute_row">
                        <div class="col">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for=""><?php echo e(__('Attribute')); ?></label>
                                        <input type="hidden" name="attribute_id[]" value="${attribute_id}" />
                                        <input type="hidden" name="attribute_selected[]" value="${selected_attribute_value}" />
                                        <input type="hidden" name="attribute_name[]" value="${attribute_title}" />
                                        <input type="text" class="form-control font-weight-bold" value="${attribute_title}: ${selected_attribute_value}" disabled="">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for=""><?php echo e(__('Additional price amount')); ?> <i class="las la-star required-filed"></i></label>
                                        <input type="number" class="form-control" name="attr_additional_price[]" value="0" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto product_image">
                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.media-upload','data' => ['title' => __('Attribute Image'),'name' => 'attribute_image[]','dimentions' => '1280x1280']]); ?>
<?php $component->withName('media-upload'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Attribute Image')),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('attribute_image[]'),'dimentions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('1280x1280')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                        </div>
                        <div class="col-auto">
                            <button class="btn btn-sm btn-danger margin-top-30 remove_attribute">-</button>
                        </div>
                    </div>`
                );
 
                if (attribute_price_container.find('.row').length > 0) {
                    attribute_price_container.show();
                }
            });

            function convertToSlug(text) {
                return text
                    .toLowerCase()
                    .replace(/ /g, '-')
                    .replace(/[^\w-]+/g, '');
            }

            let all_tags = <?php echo json_encode($all_tags->pluck('tag_text')); ?>;

            let bindTagList = function () {
                // Call TagsInput on the input, and set the typeahead source to our data
                $('#tags').tagsinput({
                    typeahead: {
                        source: all_tags
                    }
                });

                $('#tags').on('itemAdded', function (event) {
                    // Hide the suggestions menu
                    $('.typeahead.dropdown-menu').css('display', 'none')
                    // Clear the typed text after a tag is added
                    $('.bootstrap-tagsinput > input').val("");
                });
            }

            bindTagList();

            /** 
             * ----- Tags input -----
             */
            let blogTagInput = $('#blog_tag_list .tags_filed');
            let oldTag = '';
            blogTagInput.tagsinput();
            //For Tags
            $(document).on('keyup', '#blog_tag_list .bootstrap-tagsinput input[type="text"]', function (e) {
                e.preventDefault();
                let el = $(this);
                let inputValue = $(this).val();
                let show_autocomplete = show_autocomplete;
                $.ajax({
                    type: 'get',
                    url: "<?php echo e(route('admin.products.tag.get.ajax')); ?>",
                    async: false,
                    data: {
                        tag_query: inputValue
                    },
                    success: function (data) {
                        oldTag = inputValue;
                        let html = '';
                        let showAutocomplete = '';

                        show_autocomplete.html('<ul class="autocomplete-warp"></ul>');

                        if (el.val() !== '' && data.markup !== '') {
                            data.result.map(function (tag, key) {
                                html += '<li class="tag_option" data-id="' + tag.id + '"  data-val="' + tag.tag + '">' + tag.tag + '</li>'
                            });

                            $('#show-autocomplete ul').html(html);
                            show_autocomplete.show();
                        } else {
                            show_autocomplete.hide();
                            oldTag = '';
                        }
                    },
                    error: function (res) {
                        // 
                    }
                });
            });

            $(document).on('click', '.tag_option', function (e) {
                e.preventDefault();

                let id = $(this).data('id');
                let tag = $(this).data('val');
                blogTagInput.tagsinput('add', tag);
                $(this).parent().remove();
                blogTagInput.tagsinput('remove', oldTag);
            });

            $(document).on('click', '.remove_this_variant_info_btn', function (e) {
                e.preventDefault();
                $(this).closest('.variant_variant_info_repeater').remove();
            });

            $(document).on('click', '.add_more_info_btn', function () {
                let repeater_element = $(this).closest('.form-row').clone();
                $(this).closest('.additional_info_repeater').append(repeater_element);
                $(this).closest('.additional_info_repeater').find('.form-row:last-child').find('input').val('');
                $(this).closest('.additional_info_repeater').find('.remove_this_info_btn').last().removeAttr('disabled');
            });

            $(document).on('click', '.remove_this_info_btn', function (e) {
                e.preventDefault();
                $(this).closest('.form-row').remove();
            });
        });
    })(jQuery)
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mobidvab/public_html/core/resources/views/backend/products/product/new.blade.php ENDPATH**/ ?>