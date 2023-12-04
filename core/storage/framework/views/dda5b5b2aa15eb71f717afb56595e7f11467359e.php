<script>
    (function ($) {
        "use strict"
        $(document).ready(function () {
            $(document).on('click', '.add_more_info_btn',function () {
                $(this).closest('.additional_info').append(`<?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.product.more-info.repeater','data' => []]); ?>
<?php $component->withName('product.more-info.repeater'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>`);
            });

            $(document).on('click', '.remove_this_info_btn',function () {
                $(this).closest('.additional_info_repeater').remove();
            });
        });
    })(jQuery);
</script>
<?php /**PATH /home/mobidvab/public_html/core/resources/views/components/product/more-info/js.blade.php ENDPATH**/ ?>