
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Register')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <section class="sign-in-area-wrapper">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-6">
                    <div class="sign-in register">
                        <h4 class="title"><?php echo e(__('Create Account')); ?></h4>
                        <div class="form-wrapper">
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
                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.msg.flash','data' => []]); ?>
<?php $component->withName('msg.flash'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                            <form action="<?php echo e(route('user.register')); ?>" method="post" enctype="multipart/form-data" class="account-form">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="captcha_token" id="gcaptcha_token">
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control" placeholder="<?php echo e(__('Name')); ?>">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="username" class="form-control" placeholder="<?php echo e(__('Username')); ?>">
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control" placeholder="<?php echo e(__('Email')); ?>">
                                </div>
                                <div class="form-group">
                                    <select id="country" class="form-control" name="country">
                                        <option value=""><?php echo e(__("Select Country")); ?></option>
                                        <?php $__currentLoopData = $all_country; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($country->id); ?>"><?php echo e($country->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select id="state" class="form-control" name="state">
                                        <option value=""><?php echo e(__("Select State")); ?></option>
                                    </select>
                                </div>
                                <!--<div class="form-group">-->
                                <!--    <input type="text" name="city" class="form-control" placeholder="<?php echo e(__('City')); ?>">-->
                                <!--</div>-->
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control" placeholder="<?php echo e(__('Password')); ?>">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password_confirmation" class="form-control" placeholder="<?php echo e(__('Confirm Password')); ?>">
                                </div>
                                <div class="form-group form-check">
                                    <div class="box-wrap">
                                        <div class="left">
                                            <input type="checkbox" class="form-check-input" id="toc_and_privacy" name="agree_terms" required>
                                            <label class="form-check-label" for="toc_and_privacy">
                                                <?php echo e(__('Accept all')); ?>

                                                <a href="<?php echo e(get_static_option('toc_page_link')); ?>" class="text-active"><?php echo e(__('Terms and Conditions')); ?></a> &amp;
                                                <a href="<?php echo e(get_static_option('privacy_policy_link')); ?>" class="text-active"><?php echo e(__('Privacy Policy')); ?></a>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="btn-wrapper">
                                    <button type="submit" class="btn-default rounded-btn"><?php echo e(__('Create Account')); ?></button>
                                </div>
                            </form>
                            <p class="info"><?php echo e(__('Already Have account?')); ?> <a href="<?php echo e(route('user.login')); ?>" class="active"><?php echo e(__('Sign in')); ?></a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script src="https://www.google.com/recaptcha/api.js?render=<?php echo e(get_static_option('site_google_captcha_v3_site_key')); ?>"></script>
    <script>
        $(document).on("change","#country", function (e){
            $.ajax({
                url: '<?php echo e(route("country.state.info.ajax")); ?>',
                type: 'GET',
                data: {
                    id: $(this).val(),
                    _token: '<?php echo e(csrf_token()); ?>'
                },
                success: function (data) {
                    $("#state").html(data);
                },
                erorr: function (err) {
                    toastr.error('<?php echo e(__("An error occurred")); ?>');
                }
            });
        })
    
        grecaptcha.ready(function() {
            grecaptcha.execute("<?php echo e(get_static_option('site_google_captcha_v3_site_key')); ?>", {action: 'homepage'}).then(function(token) {
                document.getElementById('gcaptcha_token').value = token;
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mobiq\core\resources\views/frontend/user/register.blade.php ENDPATH**/ ?>