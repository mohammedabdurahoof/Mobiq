<?php
    $selected_megamenu = get_static_option("megamenu");
?>

<div class="nav-area-wrapper">
    <div class="container custom-container-1318">
        <div class="row nav-reverse">
            <div class="col-md-12 col-lg-3">
                <div class="side-menu-wrapper position-relative">
                    <nav class="navbar navbar-area nav-style-03 side-menu">
                        <div class="container nav-container max-width-with-padding-1318">
                            <div class="responsive-mobile-menu">
                                <button class="navbar-toggler <?php if(request()->routeIs('homepage')): ?> collapsed <?php endif; ?>" type="button" data-toggle="collapse"
                                        data-target="#bizcoxx_main_menu_two" aria-expanded="false"
                                        aria-label="Toggle navigation">
                                    <i class="las la-bars icon"></i>
                                    <span class="text"><?php echo e(__('all categories')); ?></span>
                                    <i class="las la-caret-down icon"></i>
                                </button>
                            </div>
                            <?php
                                $dropdown_status = '';
                                if (isset($page_details->navbar_category_dropdown_open) && $page_details->navbar_category_dropdown_open) {
                                    $dropdown_status = 'show';
                                }
                            ?>
                            <div class="navbar-collapse mobile-style collapse <?php echo e($dropdown_status); ?>" id="bizcoxx_main_menu_two">
                                <ul class="navbar-nav">
                                    <?php echo render_frontend_menu($selected_megamenu,'category_menu'); ?>

                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
            <div class="col-lg-9">
                <nav class="navbar navbar-area navbar-expand-lg has-topbar nav-style-01 index-01 only-menu">
                    <div class="container nav-container max-width-with-padding-1318">
                        <div class="responsive-mobile-menu">
                            <div class="logo-wrapper">
                                <div class="logo">
                                    <a href="<?php echo e(route('homepage')); ?>">
                                        <?php if(!empty(filter_static_option_value('site_logo', $global_static_field_data))): ?>
                                            <?php echo render_image_markup_by_attachment_id(filter_static_option_value('site_logo', $global_static_field_data)); ?>

                                        <?php else: ?>
                                            <h2 class="site-title"><?php echo e(filter_static_option_value('site_title', $global_static_field_data)); ?></h2>
                                        <?php endif; ?>
                                    </a>
                                </div>
                            </div>
                            <button class="navbar-toggler collapsed" type="button" data-toggle="collapse"
                                    data-target="#bizcoxx_main_menu" aria-expanded="false"
                                    aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                        </div>
                        <div class="navbar-collapse collapse" id="bizcoxx_main_menu">
                            <ul class="navbar-nav">
                                <?php echo render_frontend_menu($primary_menu); ?>

                            </ul>
                            <div class="nav-right-content">
                                <ul>
                                    <li>
                                        <a href="#">
                                            <i class="<?php echo e(get_static_option('navbar_right_icon')); ?> icon"></i>
                                            <span class="text"><?php echo e(get_static_option('navbar_right_info')); ?></span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\mobiq\core\resources\views/frontend/partials/navbar-partial-01.blade.php ENDPATH**/ ?>