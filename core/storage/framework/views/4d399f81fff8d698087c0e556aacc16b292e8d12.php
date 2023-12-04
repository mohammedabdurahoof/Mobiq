<!-- branding-product S t a r t -->
<section class="branding-product pt-50 pb-40 mt-50 section-bg-1">
    <div class="container custom-container-1318">
        <div class="row">
            <div class="col-xl-5 col-lg-7 ">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="section-title-wrapper-03">
                            <h2 class="section-title"><?php echo e($left_category->title); ?></h2>
                        </div>

                        <?php $__currentLoopData = $left_category->product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.product-style.list-style-one','data' => ['product' => $product]]); ?>
<?php $component->withName('product-style.list-style-one'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['product' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>

            </div>
            <div class="col-xl-7 col-lg-5">
                <div class="section-title-wrapper-03">
                    <h2 class="section-title"><?php echo e($right_category->title); ?></h2>
                </div>
                <div class="row">
                    <?php $__currentLoopData = $right_category->product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-xl-4">
                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.product-style.grid-style-one','data' => ['product' => $product]]); ?>
<?php $component->withName('product-style.grid-style-one'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['product' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($product)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

            </div>
        </div>
    </div>
</section>
<!-- End-of branding-product -->
<?php /**PATH /home/mobidvab/public_html/core/app/Providers/../PageBuilder/views/product-style/style-01.blade.php ENDPATH**/ ?>