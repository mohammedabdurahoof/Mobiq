<div class="sidebar-menu">

    <div class="sidebar-header">

        <div class="logo">

            <a href="<?php echo e(route('admin.home')); ?>">

                <?php if(get_static_option('site_admin_dark_mode') == 'off'): ?>

                    <?php echo render_image_markup_by_attachment_id(get_static_option('site_logo')); ?>


                <?php else: ?>

                    <?php echo render_image_markup_by_attachment_id(get_static_option('site_white_logo')); ?>


                <?php endif; ?>

            </a>

        </div>

    </div>

    <div class="main-menu">

        <div class="menu-inner">

            <nav>

                <ul class="metismenu" id="menu">

                    <li class="<?php echo e(active_menu('admin-home')); ?>">

                        <a href="<?php echo e(route('admin.home')); ?>" aria-expanded="true">

                            <i class="ti-layout-grid2"></i>

                            <span><?php echo app('translator')->get('dashboard'); ?></span>

                        </a>

                    </li>

                    <?php if(auth('admin')->user()->role =='Super Admin'): ?>

                        <li class="main_dropdown <?php if(request()->is(['admin-home/admin/*'])): ?> active <?php endif; ?>">

                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-user"></i>

                                <span><?php echo e(__('Admin Manage')); ?></span></a>

                            <ul class="collapse">

                                <li class="<?php echo e(active_menu('admin-home/admin/all-user')); ?>"><a

                                            href="<?php echo e(route('admin.all.user')); ?>"><?php echo e(__('All Admin')); ?></a></li>

                                <li class="<?php echo e(active_menu('admin-home/admin/new-user')); ?>"><a

                                            href="<?php echo e(route('admin.new.user')); ?>"><?php echo e(__('Add New Admin')); ?></a></li>

                                <li class="<?php echo e(active_menu('admin-home/admin/role')); ?> "><a

                                            href="<?php echo e(route('admin.all.admin.role')); ?>"><?php echo e(__('All Admin Role')); ?></a>

                                </li>

                            </ul>

                        </li>

                    <?php endif; ?>



                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['user-list', 'user-create'])): ?>

                        <li

                                class="main_dropdown

                        <?php if(request()->is(['admin-home/frontend/new-user', 'admin-home/frontend/all-user', 'admin-home/frontend/all-user/role'])): ?> active <?php endif; ?>

                                        ">

                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-user"></i>

                                <span><?php echo e(__('Users Manage')); ?></span></a>

                            <ul class="collapse">

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user-list')): ?>

                                    <li class="<?php echo e(active_menu('admin-home/frontend/all-user')); ?>"><a

                                                href="<?php echo e(route('admin.all.frontend.user')); ?>"><?php echo e(__('All Users')); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user-create')): ?>

                                    <li class="<?php echo e(active_menu('admin-home/frontend/new-user')); ?>"><a

                                                href="<?php echo e(route('admin.frontend.new.user')); ?>"><?php echo e(__('Add New User')); ?></a>

                                    </li>

                                <?php endif; ?>

                            </ul>

                        </li>

                    <?php endif; ?>
                    

                    <?php if(auth('admin')->user()->hasRole('Super Admin')): ?>

                        <li class="main_dropdown <?php if(request()->is(['admin-home/mobile-slider-two/*','admin-home/mobile-featured-product/*','admin-home/mobile-campaign/*','admin-home/mobile-settings/*'])): ?> active <?php endif; ?>">

                            <a href="javascript:void(0)" aria-expanded="true"><i class="fas fa-mobile-alt"></i>

                                <span><?php echo e(__('Mobile Modules')); ?></span></a>

                            <ul class="collapse">

                                <li class="<?php echo e(active_menu('admin-home/mobile-slider/create')); ?>"><a

                                            href="<?php echo e(route('admin.mobile.slider.create')); ?>"><?php echo e(__('Slider Create')); ?></a></li>

                                <li class="<?php echo e(active_menu('admin-home/mobile-slider/list')); ?>"><a

                                            href="<?php echo e(route('admin.mobile.slider.all')); ?>"><?php echo e(__('Slider List')); ?></a></li>

                                </li>

                                <li class="<?php echo e(active_menu('admin-home/mobile-slider-two/create')); ?>"><a

                                            href="<?php echo e(route('admin.mobile.slider.two.create')); ?>"><?php echo e(__('Slider two Create')); ?></a></li>

                                <li class="<?php echo e(active_menu('admin-home/mobile-slider-two/list')); ?>"><a

                                            href="<?php echo e(route('admin.mobile.slider.two.all')); ?>"><?php echo e(__('Slider two List')); ?></a></li>

                                </li>

                                <li class="<?php echo e(active_menu('admin-home/mobile-campaign/create')); ?>">

                                    <a href="<?php echo e(route('admin.mobile.campaign.create')); ?>"><?php echo e(__('Campaign Update')); ?></a>

                                </li>

                                <li class="<?php echo e(active_menu('admin-home/mobile-featured-product/new')); ?>">

                                    <a href="<?php echo e(route('admin.featured.product.create')); ?>"><?php echo e(__('Featured Product Update')); ?></a>

                                </li>

                                <li class="<?php echo e(active_menu('admin-home/mobile-settings/terms-and-controller')); ?>">

                                    <a href="<?php echo e(route('admin.mobile.settings.terms_and_condition')); ?>"><?php echo e(__('Terms and condition page')); ?></a>

                                </li>

                                <li class="<?php echo e(active_menu('admin-home/mobile-settings/privacy-policy')); ?>">

                                    <a href="<?php echo e(route('admin.mobile.settings.privacy.policy')); ?>"><?php echo e(__('Privacy and policy page')); ?></a>

                                </li>

                            </ul>

                        </li>

                    <?php endif; ?>



                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['newsletter-list', 'newsletter-mail-send'])): ?>

                        <li class="main_dropdown <?php if(request()->is(['admin-home/newsletter/*', 'admin-home/newsletter'])): ?> active <?php endif; ?> ">

                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-email"></i>

                                <span><?php echo e(__('Newsletter Manage')); ?></span>

                            </a>

                            <ul class="collapse">

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('newsletter-list')): ?>

                                    <li class="<?php echo e(active_menu('admin-home/newsletter')); ?>">

                                        <a href="<?php echo e(route('admin.newsletter')); ?>"><?php echo e(__('All Subscriber')); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('newsletter-mail-send')): ?>

                                    <li class="<?php echo e(active_menu('admin-home/newsletter/all')); ?>">

                                        <a href="<?php echo e(route('admin.newsletter.mail')); ?>"><?php echo e(__('Send Mail To All')); ?></a>

                                    </li>

                                <?php endif; ?>

                            </ul>

                        </li>

                    <?php endif; ?>



                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['support-ticket-list', 'support-ticket-create', 'support-ticket-department-list',

                        'support-ticket-page-settings'])): ?>

                        <li class="main_dropdown <?php echo e(active_menu('admin-home/support-tickets')); ?> <?php if(request()->is('admin-home/support-tickets/*')): ?> active <?php endif; ?>">

                            <a href="javascript:void(0)" aria-expanded="true">

                                <i class="ti-headphone-alt"></i>

                                <span><?php echo e(__('Support Tickets')); ?></span>

                            </a>

                            <ul class="collapse">

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('support-ticket-list')): ?>

                                    <li class="<?php echo e(active_menu('admin-home/support-tickets')); ?>">

                                        <a href="<?php echo e(route('admin.support.ticket.all')); ?>"><?php echo e(__('All Tickets')); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('support-ticket-create')): ?>

                                    <li class="<?php echo e(active_menu('admin-home/support-tickets/new')); ?>">

                                        <a href="<?php echo e(route('admin.support.ticket.new')); ?>"><?php echo e(__('Add New Ticket')); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('support-ticket-department-list')): ?>

                                    <li class="<?php echo e(active_menu('admin-home/support-tickets/department')); ?>">

                                        <a href="<?php echo e(route('admin.support.ticket.department')); ?>"><?php echo e(__('Departments')); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('support-ticket-page-settings')): ?>

                                    <li class="<?php echo e(active_menu('admin-home/support-tickets/page-settings')); ?>">

                                        <a

                                                href="<?php echo e(route('admin.support.ticket.page.settings')); ?>"><?php echo e(__('Page Settings')); ?></a>

                                    </li>

                                <?php endif; ?>

                            </ul>

                        </li>

                    <?php endif; ?>



                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['country-list', 'state-list'])): ?>

                        <li class="main_dropdown <?php if(request()->is(['admin-home/country', 'admin-home/country/*', 'admin-home/state', 'admin-home/state/*'])): ?> active <?php endif; ?> ">

                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-settings"></i>

                                <span><?php echo e(__('Country Manage')); ?></span></a>

                            <ul class="collapse">

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('country-list')): ?>

                                    <li class="<?php echo e(active_menu('admin-home/country')); ?>">

                                        <a href="<?php echo e(route('admin.country.all')); ?>"><?php echo e(__('Country')); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('state-list')): ?>

                                    <li class="<?php echo e(active_menu('admin-home/state')); ?>">

                                        <a href="<?php echo e(route('admin.state.all')); ?>"><?php echo e(__('State')); ?></a>

                                    </li>

                                <?php endif; ?>

                            </ul>

                        </li>

                    <?php endif; ?>



                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['country-tax-list', 'state-tax-list'])): ?>

                        <li class="main_dropdown <?php if(request()->is(['admin-home/tax/*'])): ?> active <?php endif; ?> ">

                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-settings"></i>

                                <span><?php echo e(__('Tax Settings')); ?></span></a>

                            <ul class="collapse">

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('country-tax-list')): ?>

                                    <li class="<?php echo e(active_menu('admin-home/tax/country')); ?>">

                                        <a href="<?php echo e(route('admin.tax.country.all')); ?>"><?php echo e(__('Country Tax')); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('state-tax-list')): ?>

                                    <li class="<?php echo e(active_menu('admin-home/tax/state')); ?>">

                                        <a href="<?php echo e(route('admin.tax.state.all')); ?>"><?php echo e(__('State Tax')); ?></a>

                                    </li>

                                <?php endif; ?>

                            </ul>

                        </li>

                    <?php endif; ?>



                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['product-list', 'deleted-product-list', 'product-category-list', 'product-subcategory-list', 'product-tag-list', 'product-unit-list'])): ?>

                        <li class="main_dropdown

                            <?php if(

                                request()->is([

                                    'admin-home/products',

                                    'admin-home/products/*'

                                ])

                                &&

                                !request()->is([

                                    'admin-home/products/coupons',

                                    'admin-home/products/attributes',

                                    'admin-home/products/ratings',

                                    'admin-home/products/product-inventory',

                                    'admin-home/products/product-order',

                                    'admin-home/products/product-order/*',

                                ])

                            ): ?>

                                active

                            <?php endif; ?>"

                        >

                            <a href="javascript:void(0)" aria-expanded="true"><i

                                        class="ti-package"></i><span><?php echo e(__('Product Module')); ?></span></a>

                            <ul class="collapse">

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product-list')): ?>

                                    <li class="<?php echo e(active_menu('admin-home/products/all')); ?>">

                                        <a href="<?php echo e(route('admin.products.all')); ?>"><?php echo e(__('Products')); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('deleted-product-list')): ?>

                                    <li class="<?php echo e(active_menu('admin-home/products/deleted')); ?>">

                                        <a href="<?php echo e(route('admin.products.deleted.all')); ?>"><?php echo e(__('Deleted Products')); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product-category-list')): ?>

                                    <li class="<?php echo e(active_menu('admin-home/products/categories')); ?>">

                                        <a href="<?php echo e(route('admin.products.category.all')); ?>"><?php echo e(__('Category')); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product-subcategory-list')): ?>

                                    <li class="<?php echo e(active_menu('admin-home/products/sub-categories')); ?>">

                                        <a href="<?php echo e(route('admin.products.subcategory.all')); ?>"><?php echo e(__('Sub-Category')); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product-unit-list')): ?>

                                    <li class="<?php echo e(active_menu('admin-home/products/units')); ?>">

                                        <a href="<?php echo e(route('admin.products.units.all')); ?>"><?php echo e(__('Units')); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product-tag-list')): ?>

                                    <li class="<?php echo e(active_menu('admin-home/products/tags')); ?>">

                                        <a href="<?php echo e(route('admin.products.tag.all')); ?>"><?php echo e(__('Tag')); ?></a>

                                    </li>

                                <?php endif; ?>

                            </ul>

                        </li>

                    <?php endif; ?>



                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product-coupon-list')): ?>

                        <li class="<?php echo e(active_menu('admin-home/products/coupons')); ?>">

                            <a href="<?php echo e(route('admin.products.coupon.all')); ?>">

                                <i class="ti-ticket"></i>

                                <span><?php echo e(__('Coupon')); ?></span>

                            </a>

                        </li>

                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product-color-list')): ?>

                        <li class="<?php echo e(active_menu('admin-home/products/colors')); ?>">

                            <a href="<?php echo e(route('admin.products.color.all')); ?>">

                                <i class="ti-palette"></i>

                                <span><?php echo e(__('Color')); ?></span>

                            </a>

                        </li>

                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product-size-list')): ?>

                        <li class="<?php echo e(active_menu('admin-home/products/sizes')); ?>">

                            <a href="<?php echo e(route('admin.products.size.all')); ?>">

                                <i class="ti-ruler"></i>

                                <span><?php echo e(__('Size')); ?></span>

                            </a>

                        </li>

                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product-attribute-list')): ?>

                        <li class="<?php echo e(active_menu('admin-home/products/attributes')); ?>">

                            <a href="<?php echo e(route('admin.products.attributes.all')); ?>">

                                <i class="ti-menu"></i>

                                <span><?php echo e(__('Custom Attribute')); ?></span>

                            </a>

                        </li>

                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product-rating-list')): ?>

                        <li class="<?php echo e(active_menu('admin-home/products/ratings')); ?>">

                            <a href="<?php echo e(route('admin.products.ratings.all')); ?>">

                                <i class="ti-star"></i>

                                <span><?php echo e(__('Ratings')); ?></span>

                            </a>

                        </li>

                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product-inventory-list')): ?>

                        <li class="<?php echo e(active_menu('admin-home/products/product-inventory')); ?>">

                            <a href="<?php echo e(route('admin.products.inventory.all')); ?>">

                                <i class="ti-package"></i>

                                <span><?php echo e(__('Inventory')); ?></span>

                            </a>

                        </li>

                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product-order-list')): ?>

                        <li class="<?php if(request()->is(['admin-home/products/product-order', 'admin-home/products/product-order/*'])): ?> active <?php endif; ?>">

                            <a href="<?php echo e(route('admin.product.order.logs')); ?>">

                                <i class="ti-notepad"></i>

                                <span><?php echo e(__('Order Log')); ?></span>

                            </a>

                        </li>

                    <?php endif; ?>



                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('campaign-list')): ?>

                        <li class="main_dropdown <?php echo e(active_menu('admin-home/campaigns')); ?>">

                            <a href="<?php echo e(route('admin.campaigns.all')); ?>" aria-expanded="true"><i

                                        class="ti-announcement"></i>

                                <span><?php echo e(__('Campaign Module')); ?></span></a>

                        </li>

                    <?php endif; ?>



                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['shipping-zone-list', 'shipping-method-list',])): ?>

                        <li class="main_dropdown <?php if(request()->is(['admin-home/shipping/*', 'admin-home/shipping'])): ?> active <?php endif; ?> ">

                            <a href="javascript:void(0)" aria-expanded="true"><i

                                        class="ti-truck"></i><span><?php echo e(__('Shipping Module')); ?></span></a>

                            <ul class="collapse">

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('shipping-zone-list')): ?>

                                    <li class="<?php echo e(active_menu('admin-home/shipping/zone')); ?>">

                                        <a href="<?php echo e(route('admin.shipping.zone.all')); ?>"><?php echo e(__('Shipping Zones')); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('shipping-method-list')): ?>

                                    <li class="<?php echo e(active_menu('admin-home/shipping/method')); ?>">

                                        <a href="<?php echo e(route('admin.shipping.method.all')); ?>"><?php echo e(__('Shipping Methods')); ?></a>

                                    </li>

                                <?php endif; ?>

                            </ul>

                        </li>

                    <?php endif; ?>



                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['blog-list', 'blog-category-list', 'blog-create', 'blog-page-settings', 'blog-single-page-settings'])): ?>

                        <li class="main_dropdown <?php if(request()->is(['admin-home/blog/*', 'admin-home/blog'])): ?> active <?php endif; ?> ">

                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-write"></i>

                                <span><?php echo e(__('Blogs')); ?></span></a>

                            <ul class="collapse">

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('blog-list')): ?>

                                    <li class="<?php echo e(active_menu('admin-home/blog')); ?>"><a

                                                href="<?php echo e(route('admin.blog')); ?>"><?php echo e(__('All Blog')); ?></a></li>

                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('blog-category-list')): ?>

                                    <li class="<?php echo e(active_menu('admin-home/blog/category')); ?>"><a

                                                href="<?php echo e(route('admin.blog.category')); ?>"><?php echo e(__('Category')); ?></a></li>

                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('blog-create')): ?>

                                    <li class="<?php echo e(active_menu('admin-home/blog/new')); ?>"><a

                                                href="<?php echo e(route('admin.blog.new')); ?>"><?php echo e(__('Add New Post')); ?></a></li>

                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('blog-page-settings')): ?>

                                    <li class="<?php echo e(active_menu('admin-home/blog/page-settings')); ?>"><a

                                                href="<?php echo e(route('admin.blog.page.settings')); ?>"><?php echo e(__('Blog Page Settings')); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('blog-single-page-settings')): ?>

                                    <li class="<?php echo e(active_menu('admin-home/blog/single-settings')); ?>"><a

                                                href="<?php echo e(route('admin.blog.single.settings')); ?>"><?php echo e(__('Blog Single Settings')); ?></a>

                                    </li>

                                <?php endif; ?>

                            </ul>

                        </li>

                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('faq-list')): ?>

                        <li class="main_dropdown <?php echo e(active_menu('admin-home/faq')); ?>">

                            <a href="<?php echo e(route('admin.faq')); ?>" aria-expanded="true"><i class="ti-control-forward"></i>

                                <span><?php echo e(__('FAQ')); ?></span></a>

                        </li>

                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['page-list', 'page-create'])): ?>

                        <li class="main_dropdown <?php if(request()->is(['admin-home/page-edit/*', 'admin-home/page/edit/*', 'admin-home/page/all', 'admin-home/page/new'])): ?> active <?php endif; ?> ">

                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-write"></i>

                                <span><?php echo e(__('Pages')); ?></span></a>

                            <ul class="collapse">

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('page-list')): ?>

                                    <li class="<?php echo e(active_menu('admin-home/page/all')); ?>"><a

                                                href="<?php echo e(route('admin.page')); ?>"><?php echo e(__('All Pages')); ?></a></li>

                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('page-create')): ?>

                                    <li class="<?php echo e(active_menu('admin-home/page/new')); ?>"><a

                                                href="<?php echo e(route('admin.page.new')); ?>"><?php echo e(__('Add New Page')); ?></a></li>

                                <?php endif; ?>

                            </ul>

                        </li>

                    <?php endif; ?>



                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['appearance-topbar-settings', 'appearance-navbar-settings', 'appearance-home-variant',

                        'appearance-menu-manage-list', 'appearance-widget-manage', 'appearance-form-builder',

                        'appearance-media-image'])): ?>

                        <li class="main_dropdown

                    <?php if(request()->is(['admin-home/appearance-settings/topbar/*', 'admin-home/appearance-settings/navbar/*', 'admin-home/appearance-settings/home-variant/*', 'admin-home/media-upload/page', 'admin-home/menu', 'admin-home/menu-edit/*', 'admin-home/widgets', 'admin-home/widgets/*', 'admin-home/popup-builder/*', 'admin-home/form-builder/*'])): ?> active <?php endif; ?> ">

                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-settings"></i>

                                <span><?php echo e(__('Appearance Settings')); ?></span></a>

                            <ul class="collapse ">

                                

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['top-bar-menu-list', 'top-bar-social-icon-list'])): ?>

                                    <li class="main_dropdown <?php echo e(active_menu('admin-home/appearance-settings/topbar/all')); ?>">

                                        <a href="<?php echo e(route('admin.topbar.settings')); ?>" aria-expanded="true">

                                            <?php echo e(__('Topbar Manage')); ?>


                                        </a>

                                    </li>

                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('appearance-menu-manage-list')): ?>

                                    <li class="main_dropdown

                                        <?php echo e(active_menu('admin-home/menu')); ?>


                                    <?php if(request()->is('admin-home/menu-edit/*')): ?> active <?php endif; ?>

                                            "

                                    >

                                        <a href="javascript:void(0)" aria-expanded="true"><?php echo e(__('Menus Manage')); ?></a>

                                        <ul class="collapse">

                                            <li class="<?php echo e(active_menu('admin-home/menu')); ?>">

                                                <a href="<?php echo e(route('admin.menu')); ?>"><?php echo e(__('All Menus')); ?></a>

                                            </li>

                                        </ul>

                                    </li>





                                    <li

                                            class="main_dropdown <?php echo e(active_menu('admin-home/appearance-settings/category-menu')); ?>">

                                        <a href="<?php echo e(route('admin.category.menu.settings')); ?>" aria-expanded="true">

                                            <?php echo e(__('Category Menu Manage')); ?>


                                        </a>

                                    </li>

                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('appearance-widget-manage')): ?>

                                    <li class="main_dropdown

                                            <?php echo e(active_menu('admin-home/widgets')); ?>


                                    <?php if(request()->is('admin-home/widgets/*')): ?> active <?php endif; ?>"

                                    >

                                        <a href="javascript:void(0)" aria-expanded="true">

                                            <?php echo e(__('Widgets Manage')); ?></a>

                                        <ul class="collapse">

                                            <li class="<?php echo e(active_menu('admin-home/widgets')); ?>"><a

                                                        href="<?php echo e(route('admin.widgets')); ?>"><?php echo e(__('All Widgets')); ?></a>

                                            </li>

                                        </ul>

                                    </li>

                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('appearance-form-builder')): ?>

                                    <li class="main_dropdown <?php if(request()->is('admin-home/form-builder/*')): ?> active <?php endif; ?>">

                                        <a href="javascript:void(0)" aria-expanded="true">

                                            <?php echo e(__('Form Builder')); ?>


                                        </a>

                                        <ul class="collapse">

                                            <li class="<?php echo e(active_menu('admin-home/form-builder/custom/all')); ?>">

                                                <a href="<?php echo e(route('admin.form.builder.all')); ?>"><?php echo e(__('Custom Form')); ?></a>

                                            </li>

                                        </ul>

                                    </li>

                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('appearance-media-image')): ?>

                                    <li class="main_dropdown <?php echo e(active_menu('admin-home/media-upload/page')); ?>">

                                        <a href="<?php echo e(route('admin.upload.media.images.page')); ?>" aria-expanded="true">

                                            <?php echo e(__('Media Images Manage')); ?>


                                        </a>

                                    </li>

                                <?php endif; ?>

                            </ul>

                        </li>

                    <?php endif; ?>



                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any([

                        'page-settings-error-page-manage', 'page-settings-maintain-page-manage',

                        'page-settings-wishlist-page',

                        'page-settings-cart-page',

                        'page-settings-checkout-page',

                        'page-settings-compare-page',

                        'page-settings-login-register-page',

                        'page-settings-shop-page',

                        'page-settings-product-details-page',

                    ])): ?>

                        <li class="main_dropdown

                        <?php if(request()->is(['admin-home/home-page-01/*', 'admin-home/header', 'admin-home/keyfeatures', 'admin-home/about-page/*', 'admin-home/404-page-manage', 'admin-home/maintains-page/settings', 'admin-home/page-builder/home-page', 'admin-home/page-settings/*', 'admin-home/page-settings/wishlist', 'admin-home/page-settings/cart', 'admin-home/page-settings/compare', 'admin-home/page-builder/contact-page', 'admin-home/page-builder/about-page', 'admin-home/page-builder/faq-page'])): ?> active <?php endif; ?>">

                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-settings"></i>

                                <span><?php echo e(__('All Page Settings')); ?></span>

                            </a>

                            <ul class="collapse">



                                    <li class="<?php echo e(active_menu('admin-home/general-settings/database-upgrade')); ?>">

                                        <a href="<?php echo e(route('admin.general.database.upgrade')); ?>"><?php echo e(__('Database Upgrade')); ?></a>

                                    </li>



                                    <li class="main_dropdown

                                            <?php if(request()->is([

                                                'admin-home/page-settings/*',

                                                'admin-home/page-settings/wishlist',

                                                'admin-home/page-settings/cart',

                                                'admin-home/page-settings/compare'

                                            ])): ?> active <?php endif; ?>

                                            ">

                                        <a href="javascript:void(0)" aria-expanded="true">

                                            <?php echo e(__('Module Page Settings')); ?>


                                        </a>

                                        <ul class="collapse">

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('page-settings-wishlist-page')): ?>

                                                <li class="<?php echo e(active_menu('admin-home/page-settings/wishlist')); ?>">

                                                    <a href="<?php echo e(route('admin.page.settings.wishlist')); ?>">

                                                        <?php echo e(__('Wishlist Page')); ?>


                                                    </a>

                                                </li>

                                            <?php endif; ?>

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('page-settings-cart-page')): ?>

                                                <li class="<?php echo e(active_menu('admin-home/page-settings/cart')); ?>">

                                                    <a href="<?php echo e(route('admin.page.settings.cart')); ?>">

                                                        <?php echo e(__('Cart Page')); ?>


                                                    </a>

                                                </li>

                                            <?php endif; ?>

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('page-settings-checkout-page')): ?>

                                                <li class="<?php echo e(active_menu('admin-home/page-settings/checkout')); ?>">

                                                    <a href="<?php echo e(route('admin.page.settings.checkout')); ?>">

                                                        <?php echo e(__('Checkout Page')); ?>


                                                    </a>

                                                </li>

                                            <?php endif; ?>

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('page-settings-compare-page')): ?>

                                                <li class="<?php echo e(active_menu('admin-home/page-settings/compare')); ?>">

                                                    <a href="<?php echo e(route('admin.page.settings.compare')); ?>">

                                                        <?php echo e(__('Compare Page')); ?>


                                                    </a>

                                                </li>

                                            <?php endif; ?>

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('page-settings-login-register-page')): ?>

                                                <li class="<?php echo e(active_menu('admin-home/page-settings/login-register')); ?>">

                                                    <a href="<?php echo e(route('admin.page.settings.user.auth')); ?>">

                                                        <?php echo e(__('Login/Register Page')); ?>


                                                    </a>

                                                </li>

                                            <?php endif; ?>

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('page-settings-shop-page')): ?>

                                                <li class="<?php echo e(active_menu('admin-home/page-settings/shop-page')); ?>">

                                                    <a href="<?php echo e(route('admin.page.settings.shop.page')); ?>">

                                                        <?php echo e(__('Shop Page')); ?>


                                                    </a>

                                                </li>

                                            <?php endif; ?>

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('page-settings-product-details-page')): ?>

                                                <li class="<?php echo e(active_menu('admin-home/page-settings/product-details-page')); ?>">

                                                    <a href="<?php echo e(route('admin.page.settings.product.detail.page')); ?>">

                                                        <?php echo e(__('Product Details Page')); ?>


                                                    </a>

                                                </li>

                                            <?php endif; ?>

                                        </ul>

                                    </li>



                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('page-settings-error-page-manage')): ?>

                                    <li class="main_dropdown <?php echo e(active_menu('admin-home/404-page-manage')); ?>">

                                        <a href="<?php echo e(route('admin.404.page.settings')); ?>" aria-expanded="true">

                                            <?php echo e(__('404 Page Manage')); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('page-settings-maintain-page-manage')): ?>

                                    <li class="main_dropdown <?php echo e(active_menu('admin-home/maintains-page/settings')); ?>">

                                        <a href="<?php echo e(route('admin.maintains.page.settings')); ?>" aria-expanded="true">

                                            <?php echo e(__('Maintain Page Manage')); ?>


                                        </a>

                                    </li>

                                <?php endif; ?>

                            </ul>

                        </li>

                    <?php endif; ?>



                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any([

                        'general-settings-site-identity', 'general-settings-basic-settings',

                        'general-settings-color-settings', 'general-settings-typography', 'general-settings-seo-settings',

                        'general-settings-third-party-script', 'general-settings-email-template',

                        'general-settings-smtp-settings', 'general-settings-page-settings',

                        'general-settings-payment-gateway', 'general-settings-custom-css', 'general-settings-custom-js',

                        'general-settings-cache-settings', 'general-settings-gdpr-settings', 'general-settings-sitemap',

                        'general-settings-rss-feed', 'general-settings-license', 'general-settings-reading-settings',

                        'general-settings-global-navbar-settings', 'general-settings-navbar-category-dropdown',

                    ])): ?>

                        <li class="main_dropdown <?php if(request()->is('admin-home/general-settings/*')): ?> active <?php endif; ?>">

                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-settings"></i>

                                <span><?php echo e(__('General Settings')); ?></span></a>

                            <ul class="collapse ">

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('general-settings-reading-settings')): ?>

                                    <li class="<?php echo e(active_menu('admin-home/general-settings/reading')); ?>"><a

                                                href="<?php echo e(route('admin.general.reading')); ?>"><?php echo e(__('Reading')); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('general-settings-global-navbar-settings')): ?>

                                    <li class="<?php echo e(active_menu('admin-home/general-settings/global-variant-navbar')); ?>"><a

                                                href="<?php echo e(route('admin.general.global.variant.navbar')); ?>"><?php echo e(__('Navbar Global Variant')); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('general-settings-site-identity')): ?>

                                    <li class="<?php echo e(active_menu('admin-home/general-settings/site-identity')); ?>"><a

                                                href="<?php echo e(route('admin.general.site.identity')); ?>"><?php echo e(__('Site Identity')); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('general-settings-basic-settings')): ?>

                                    <li class="<?php echo e(active_menu('admin-home/general-settings/basic-settings')); ?>"><a

                                                href="<?php echo e(route('admin.general.basic.settings')); ?>"><?php echo e(__('Basic Settings')); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('general-settings-color-settings')): ?>

                                    <li class="<?php echo e(active_menu('admin-home/general-settings/color-settings')); ?>"><a

                                                href="<?php echo e(route('admin.general.color.settings')); ?>"><?php echo e(__('Color Settings')); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('general-settings-typography')): ?>

                                    <li class="<?php echo e(active_menu('admin-home/general-settings/typography-settings')); ?>"><a

                                                href="<?php echo e(route('admin.general.typography.settings')); ?>"><?php echo e(__('Typography Settings')); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('general-settings-seo-settings')): ?>

                                    <li class="<?php echo e(active_menu('admin-home/general-settings/seo-settings')); ?>"><a

                                                href="<?php echo e(route('admin.general.seo.settings')); ?>"><?php echo e(__('SEO Settings')); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('general-settings-third-party-script')): ?>

                                    <li class="<?php echo e(active_menu('admin-home/general-settings/scripts')); ?>"><a

                                                href="<?php echo e(route('admin.general.scripts.settings')); ?>"><?php echo e(__('Third Party Scripts')); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('general-settings-email-template')): ?>

                                    <li class="<?php echo e(active_menu('admin-home/general-settings/email-template')); ?>"><a

                                                href="<?php echo e(route('admin.general.email.template')); ?>"><?php echo e(__('Email Template')); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('general-settings-smtp-settings')): ?>

                                    <li class="<?php echo e(active_menu('admin-home/general-settings/smtp-settings')); ?>"><a

                                                href="<?php echo e(route('admin.general.smtp.settings')); ?>"><?php echo e(__('SMTP Settings')); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('general-settings-payment-gateway')): ?>

                                    <?php if(!empty(get_static_option('site_payment_gateway'))): ?>

                                        <li class="<?php echo e(active_menu('admin-home/general-settings/payment-settings')); ?>"><a

                                                    href="<?php echo e(route('admin.general.payment.settings')); ?>"><?php echo e(__('Payment Gateway Settings')); ?></a>

                                        </li>

                                    <?php endif; ?>

                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('general-settings-custom-css')): ?>

                                    <li class="<?php echo e(active_menu('admin-home/general-settings/custom-css')); ?>"><a

                                                href="<?php echo e(route('admin.general.custom.css')); ?>"><?php echo e(__('Custom CSS')); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('general-settings-custom-js')): ?>

                                    <li class="<?php echo e(active_menu('admin-home/general-settings/custom-js')); ?>"><a

                                                href="<?php echo e(route('admin.general.custom.js')); ?>"><?php echo e(__('Custom JS')); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('general-settings-cache-settings')): ?>

                                    <li class="<?php echo e(active_menu('admin-home/general-settings/cache-settings')); ?>"><a

                                                href="<?php echo e(route('admin.general.cache.settings')); ?>"><?php echo e(__('Cache Settings')); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('general-settings-gdpr-settings')): ?>

                                    <li class="<?php echo e(active_menu('admin-home/general-settings/gdpr-settings')); ?>"><a

                                                href="<?php echo e(route('admin.general.gdpr.settings')); ?>"><?php echo e(__('GDPR Compliant Cookies Settings')); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('general-settings-sitemap')): ?>

                                    <li class="<?php echo e(active_menu('admin-home/general-settings/sitemap-settings')); ?>"><a

                                                href="<?php echo e(route('admin.general.sitemap.settings')); ?>"><?php echo e(__('Sitemap Settings')); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('general-settings-rss-feed')): ?>

                                    <li class="<?php echo e(active_menu('admin-home/general-settings/rss-settings')); ?>"><a

                                                href="<?php echo e(route('admin.general.rss.feed.settings')); ?>"><?php echo e(__('RSS Feed Settings')); ?></a>

                                    </li>

                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('general-settings-license')): ?>

                                    <li class="<?php echo e(active_menu('admin-home/general-settings/license-setting')); ?>"><a

                                                href="<?php echo e(route('admin.general.license.settings')); ?>"><?php echo e(__('Licence Settings')); ?></a>

                                    </li>

                                <?php endif; ?>

                            </ul>

                        </li>

                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('language-list')): ?>

                        <li class="<?php if(request()->is('admin-home/languages/*') || request()->is('admin-home/languages')): ?> active <?php endif; ?>">

                            <a href="<?php echo e(route('admin.languages')); ?>" aria-expanded="true"><i class="ti-signal"></i>

                                <span><?php echo e(__('Languages')); ?></span></a>

                        </li>

                    <?php endif; ?>

                </ul>

            </nav>

        </div>

    </div>

</div>

<?php /**PATH C:\xampp\htdocs\mobiq\core\resources\views/backend/partials/sidebar.blade.php ENDPATH**/ ?>