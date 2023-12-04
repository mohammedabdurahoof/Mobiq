<?php
    $page_details = $page_details ?? $page_post ?? '';
    $navbar_type = $page_details->navbar_variant ?? get_static_option('global_navbar_variant') ?? 1;
?>

<?php if($navbar_type == 1): ?>
    <?php echo $__env->make('frontend.partials.supportbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('frontend.partials.navbar-partial-01', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php elseif($navbar_type == 2): ?>
    <?php echo $__env->make('frontend.partials.navbar-partial-02', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<?php /**PATH /home/mobidvab/public_html/core/resources/views/frontend/partials/navbar.blade.php ENDPATH**/ ?>