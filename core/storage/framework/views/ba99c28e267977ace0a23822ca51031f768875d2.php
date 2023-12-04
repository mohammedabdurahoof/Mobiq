<?php

    $page_details = $page_details ?? $page_post ?? '';

    $navbar_type = $page_details->navbar_variant ?? get_static_option('global_navbar_variant') ?? 1;

    $page_container = $navbar_type == 1 ? 'custom-container-1318' : 'custom-container-1720';

?>

<div class="topbar-area">

    <div class="container <?php echo e($page_container); ?>">

        <div class="row">

            <div class="col-lg-12">

                <div class="topbar-inner">

                    <div class="left-content">

                        <div class="topbar-item">

                            <div class="social-icon">

                                <ul class="social-link-list">

                                    <?php if(!empty($all_social_item) && $all_social_item->count()): ?>

                                        <?php $__currentLoopData = $all_social_item; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $social_item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                            <li class="link-item"><a href="<?php echo e($social_item->url); ?>">
                                                <i class="<?php echo e($social_item->icon); ?> icon"></i></a>
                                            </li>

                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    <?php endif; ?>

                                </ul>

                            </div>

                        </div>

                        <div class="topbar-item">

                            <div class="info">

                                <ul class="list">

                                    <?php echo render_frontend_menu(get_static_option('topbar_menu')); ?>


                                </ul>

                            </div>

                        </div>

                    </div>

                    <div class="right-content">

                        <div class="topbar-item">

                            <div class="track-order">

                                <a href="<?php echo e(route('frontend.products.track.order')); ?>" class="sign-in">

                                    <span class="login"><?php echo e(__('Track Order')); ?></span>

                                </a>

                            </div>

                        </div>

                        <div class="topbar-item">

                            <div class="select-option">

                                <div class="single-select">

                                    <select class="lang" id="change_site_language">

                                        <?php if($all_language && $all_language->count()): ?>

                                            <?php $__currentLoopData = $all_language; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                <?php

                                                    $lang_name = explode('(',$lang->name);

                                                    $data = array_shift($lang_name);

                                                ?>

                                                <option <?php if(get_user_lang() == $lang->slug): ?> selected <?php endif; ?> value="<?php echo e($lang->slug); ?>"><?php echo e($data); ?></option>

                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        <?php endif; ?>

                                    </select>

                                </div>

                            </div>

                        </div>

                        <div class="topbar-item">

                            <div class="account-control d-none">

                                <a href="<?php echo e(route('user.login')); ?>" class="sign-in"><i class="lar la-user icon"></i><span class="login"><?php echo e(__('log in')); ?></span></a>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<?php /**PATH /home/mobidvab/public_html/core/resources/views/frontend/partials/topbar.blade.php ENDPATH**/ ?>