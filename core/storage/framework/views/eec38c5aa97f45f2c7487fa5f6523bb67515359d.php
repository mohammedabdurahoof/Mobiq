<script>
    (function ($) {
        "use strict"
        $(document).ready(function () {
            $(document).on('click', '.add_variant_info_btn', function () {
                $(this).closest('.variant_info').append(`<?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.product.variant-info.repeater','data' => ['colors' => $colors,'sizes' => $sizes,'allAvailableAttributes' => $allAttributes]]); ?>
<?php $component->withName('product.variant-info.repeater'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['colors' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($colors),'sizes' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($sizes),'all-available-attributes' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($allAttributes)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>`);
            });

            $(document).on('click', '.remove_this_variant_info_btn', function () {
                $(this).closest('.variant_info_repeater').remove();
            });
        });
    })(jQuery);
</script>
<?php /**PATH /home/mobidvab/public_html/core/resources/views/components/product/variant-info/js.blade.php ENDPATH**/ ?>