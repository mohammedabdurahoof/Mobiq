

<div class="category-searchbar " style="display: none">
    <div class="d-block">
        <span class="rounded-circle rounded-circle2 bg-white" id="close_search_dropdown">x</span>
    </div>
    <div class="search-suggestions" id="search_suggestions_wrap">
        <div class="search-inner">
            <div class="category-suggestion item-suggestions">
                <h6 class="item-title"><?php echo e(__('Category Suggestions')); ?></h6>
                <ul class="category-suggestion-list mt-4" id="search_result_categories"></ul>
            </div>
            <div class="product-suggestion item-suggestions">
                <h6 class="item-title d-flex justify-content-between">
                    <span>
                        <?php echo e(__('Product Suggestions')); ?>

                    </span>
                    <a href="#" target="_blank" id="search_result_all" class="showAll"><?php echo e(__('Show all')); ?></a>
                </h6>
                <ul class="product-suggestion-list mt-4">
                    <div class="row" id="search_result_products">
                    </div>
                </ul>
            </div>
            <div class="product-suggestion item-suggestions" style="display:none;" id="no_product_found_div">
                <h6 class="item-title d-flex justify-content-between">
                    <span>
                        <?php echo e(__('No Product Found')); ?>

                    </span>
                </h6>
            </div>
        </div>
    </div>
    <?php
        $categories = getAllCategory();
    ?>
    <div class="category-select">
        <select id="search_selected_category">
            <option value=""><?php echo e(__('All Category')); ?></option>
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($category->id); ?>"><?php echo e($category->title); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
</div>

<?php /**PATH /home/mobidvab/public_html/core/resources/views/frontend/partials/search-result.blade.php ENDPATH**/ ?>