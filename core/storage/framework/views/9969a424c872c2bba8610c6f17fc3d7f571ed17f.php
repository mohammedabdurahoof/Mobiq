<div class="nav-area-wrapper nav-two-bg">
    <div class="container custom-container-1720">
        <div class="row nav-reverse">
            <div class="col-lg-12">
                <nav class="navbar navbar-area navbar-expand-lg has-topbar nav-style-01 index-01 only-menu extra">
                    <div class="container nav-container custom-container-1720 padding-x-0">
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
                        </div>
                        <div class="right-content extra-menu-right-content">
                            <ul class="short-control">
                                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components..frontend.user-menu','data' => []]); ?>
<?php $component->withName('.frontend.user-menu'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                <li class=" cart cart2">
                                    <span class="cart-badge" id="wishlist_badge">0</span>
                                    <a href="#">
                                        <i class="lar la-heart icon"></i>
                                    </a>
                                    <div class="mini-cart-wrapper" id="top_wishlist_container"></div>
                                </li>
                                <li class="cart">
                                    <span class="cart-badge" id="cart_badge">0</span>
                                    <a href="<?php echo e(route('frontend.products.cart')); ?>" class="active">
                                        <i class="las la-shopping-bag icon"></i>
                                    </a>
                                    <div class="mini-cart-wrapper" id="top_minicart_container"></div>
                                </li>
                            </ul>
                            <div class="search-form style-02">
                                <form action="<?php echo e(route('frontend.products.all')); ?>">
                                    <div class="form-group">
                                        <input type="text"
                                               name="q"
                                               class="form-control"
                                               id="search_form_input"
                                               placeholder="<?php echo e(__('Search...')); ?>"
                                               autocomplete="off"
                                        >
                                    </div>
                                    <button class="search-btn" type="submit">
                                        <i class="las la-search"></i>
                                    </button>
                                    <?php echo $__env->make('frontend.partials.search-result', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </form>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /home/mobidvab/public_html/core/resources/views/frontend/partials/navbar-partial-02.blade.php ENDPATH**/ ?>