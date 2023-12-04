
        <!DOCTYPE html>
<html class="no-js" lang="<?php echo e(get_default_language()); ?>" dir="<?php echo e(get_default_language_direction()); ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
<?php echo render_favicon_by_id(get_static_option('site_favicon')); ?>

    <?php echo load_google_fonts(); ?>

    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/bootstrap.min-v4.6.0.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/line-awesome.min-v1.3.0.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/jquery.fancybox.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/jquery-ui.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/slick.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/flaticon.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/main-style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/responsive.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/dynamic-style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/helpers.css')); ?>">

    <?php echo $__env->make('frontend.partials.css-variable', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->yieldContent('style'); ?>

    <link rel="stylesheet" href="<?php echo e(asset('assets/common/css/toastr.css')); ?>">

    <?php if(!empty(get_static_option('site_rtl_enabled')) || get_user_lang_direction() == 'rtl'): ?>
        <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/rtl.css')); ?>">
    <?php endif; ?>
    <script>let siteurl = "<?php echo e(url('/')); ?>";</script>
    <?php echo get_static_option('site_third_party_tracking_code'); ?>

</head>
<body>
<div class="error-area-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="img-box">
                    <?php echo render_image_markup_by_attachment_id(get_static_option('error_404_page_image')); ?>

                </div>
                <div class="content">
                    <h4 class="title"><?php echo e(get_static_option('error_404_page_title')); ?></h4>
                    <p><?php echo e(get_static_option('error_404_page_paragraph')); ?></p
                    <div class="btn-wrapper">
                        <a href="<?php echo e(route('homepage')); ?>" class="btn-default rounded-btn"><?php echo e(get_static_option('error_404_page_button_text')); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html><?php /**PATH /home/mobidvab/public_html/core/resources/views/errors/404.blade.php ENDPATH**/ ?>