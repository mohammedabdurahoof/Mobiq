
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Sign In')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <section class="sign-in-area-wrapper">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-6">
                    <div class="sign-in register">
                        <h4 class="title"><?php echo e(__('sign in')); ?></h4>
                        <div class="form-wrapper">
                            <form action="<?php echo e(route('user.login')); ?>" method="post" class="register-form" id="login_form_order_page">
                                <?php echo csrf_field(); ?>
                                <div class="error-wrap"></div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="login_username" name="username" placeholder="<?php echo e(__('Username or email')); ?>">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" id="login_password" name="password" placeholder="<?php echo e(__('Password')); ?>">
                                </div>
                                <div class="form-group form-check">
                                    <div class="box-wrap">
                                        <div class="left">
                                            <input type="checkbox" class="form-check-input" id="login_remember" name="remember">
                                            <label class="form-check-label" for="remember-me"><?php echo e(__('Remember me')); ?></label>
                                        </div>
                                        <div class="right">
                                            <a href="<?php echo e(route('user.forget.password')); ?>"><?php echo e(__('Forgot Password')); ?></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="btn-wrapper">
                                    <button type="submit" id="login_btn" class="btn-default rounded-btn"><?php echo e(__('sign in')); ?></button>
                                </div>
                                <div class="sign-in-with">
                                    <?php if(get_static_option('enable_google_login')): ?>
                                        <a href="<?php echo e(route('login.google.redirect')); ?>" class="special-account">
                                            <img src="<?php echo e(asset('assets/frontend/img/icon/google-icon.svg')); ?>" alt="icon">
                                        </a>
                                    <?php endif; ?>
                                    <?php if(get_static_option('enable_facebook_login')): ?>
                                        <a href="<?php echo e(route('login.facebook.redirect')); ?>" class="special-account">
                                            <img src="<?php echo e(asset('assets/frontend/img/icon/Facebook-icon.svg')); ?>" alt="icon">
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </form>
                            <p class="info"><?php echo e(__("Don't have an account?")); ?> <a href="<?php echo e(route('user.register')); ?>" class="active"><?php echo e(__('Sign up')); ?></a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <?php echo $__env->make('frontend.partials.google-captcha', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('frontend.partials.gdpr-cookie', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('frontend.partials.inline-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('frontend.partials.twakto', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.sweet-alert-msg','data' => []]); ?>
<?php $component->withName('sweet-alert-msg'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
    <script src="<?php echo e(asset('assets/common/js/toastr.min.js')); ?>"></script>
    <script>
        (function ($) {
            "use strict";
            $(document).ready(function () {
                $(document).on('click', '#login_btn', function (e) {
                    e.preventDefault();
                    let formContainer = $('#login_form_order_page');
                    let el = $(this);
                    let username = $('#login_form_order_page #login_username').val();
                    let password = $('#login_form_order_page #login_password').val();
                    let remember = $('#login_form_order_page #login_remember').val();

                    el.text('<?php echo e(__("Please Wait")); ?>');

                    $.ajax({
                        type: 'post',
                        url: "<?php echo e(route('user.ajax.login')); ?>",
                        data: {
                            _token: "<?php echo e(csrf_token()); ?>",
                            username: username,
                            password: password,
                            remember: remember,
                        },
                        success: function (data) {
                            if (data.status === 'invalid') {
                                el.text('<?php echo e(__("Login")); ?>');
                                formContainer.find('.error-wrap').html('<div class="alert alert-danger">' + data.msg + '</div>');
                            } else {
                                formContainer.find('.error-wrap').html('');
                                el.text('<?php echo e(__("Login Success.. Redirecting ..")); ?>');
                                setTimeout(function () {
                                    location.reload();
                                }, 500);
                            }
                        },
                        error: function (data) {
                            let response = data['responseJSON']['errors'];
                            console.log(response)
                            formContainer.find('.error-wrap').html('<ul class="alert alert-danger"></ul>');
                            $.each(response, function (value, index) {
                                formContainer.find('.error-wrap ul').append('<li>' + capitalizeFirstLetter(index[0]) + '</li>');
                            });
                            el.text('<?php echo e(__("Login")); ?>');
                        }
                    });
                });

                $('.nav-item .nav-link').on('click', function () {
                    $('#forgot-password').removeClass('active');
                });
            });
        })(jQuery)

        function capitalizeFirstLetter(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mobidvab/public_html/core/resources/views/frontend/user/login.blade.php ENDPATH**/ ?>