
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('User Dashboard')); ?>

    
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <section class="login-page-wrapper">
        <div class="container custom-container-1318">
            <div class="row">
                <div class="col-lg-12">

                    <div class="user-dashboard-wrapper">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="mobile_nav">
                                <i class="las la-cogs"></i>
                            </li>
                            <li class="nav-item users-style">
                                <a class="nav-link"><i class="las la-user-plus"></i><?php echo e(optional(Auth::guard('web')->user())->name); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php if(request()->routeIs('user.home')): ?> active <?php endif; ?>" href="<?php echo e(route('user.home')); ?>"><?php echo e(__('Dashboard')); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php if(request()->routeIs('user.home.edit.profile')): ?> active <?php endif; ?> " href="<?php echo e(route('user.home.edit.profile')); ?>"><?php echo e(__('Edit Profile')); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php if(request()->routeIs('user.home.change.password')): ?> active <?php endif; ?> " href="<?php echo e(route('user.home.change.password')); ?>"><?php echo e(__('Change Password')); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php if(request()->routeIs('user.product.order.all')): ?> active <?php endif; ?>" href="<?php echo e(route('user.product.order.all')); ?>"><?php echo e(__('My Orders')); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php if(request()->routeIs('user.shipping.address.all')): ?> active <?php endif; ?>" href="<?php echo e(route('user.shipping.address.all')); ?>"><?php echo e(__('Shipping Address')); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php if(request()->routeIs('user.home.support.tickets')): ?> active <?php endif; ?>" href="<?php echo e(route('user.home.support.tickets')); ?>"><?php echo e(__('Support Ticket')); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"  href="<?php echo e(route('user.logout')); ?>"
                                   onclick="event.preventDefault();document.getElementById('logout_submit_btn').dispatchEvent(new MouseEvent('click'));">
                                    <?php echo e(__('Logout')); ?>

                                </a>

                                <form id="logout-form" action="<?php echo e(route('user.logout')); ?>" method="POST" style="display: none;">
                                    <?php echo csrf_field(); ?>
                                    <button id="logout_submit_btn" type="submit"></button>
                                </form>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" role="tabpanel">
                                <div class="message-show">
                                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.msg.success','data' => []]); ?>
<?php $component->withName('msg.success'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.msg.error','data' => []]); ?>
<?php $component->withName('msg.error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                </div>
                                <?php echo $__env->yieldContent('section'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script>
        $(document).ready(function (){
           $('select[name="country"] option[value="<?php echo e(optional(auth()->guard('web')->user())->country); ?>"]').attr('selected',true);
           $(document).on('click','.mobile_nav',function(e){
              e.preventDefault();
               $(this).parent().toggleClass('show');
           });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mobidvab/public_html/core/resources/views/frontend/user/dashboard/user-master.blade.php ENDPATH**/ ?>