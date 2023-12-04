@extends('frontend.frontend-page-master')
@section('page-title')
    {{__('Sign In')}}
@endsection
@section('content')
    <section class="sign-in-area-wrapper">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-6">
                    <div class="sign-in register">
                        <h4 class="title">{{ __('sign in') }}</h4>
                        <div class="form-wrapper">
                            <form action="{{route('user.login')}}" method="post" class="register-form" id="login_form_order_page">
                                @csrf
                                <div class="error-wrap"></div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="login_username" name="username" placeholder="{{ __('Username or email') }}">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" id="login_password" name="password" placeholder="{{ __('Password') }}">
                                </div>
                                <div class="form-group form-check">
                                    <div class="box-wrap">
                                        <div class="left">
                                            <input type="checkbox" class="form-check-input" id="login_remember" name="remember">
                                            <label class="form-check-label" for="remember-me">{{ __('Remember me') }}</label>
                                        </div>
                                        <div class="right">
                                            <a href="{{ route('user.forget.password') }}">{{ __('Forgot Password') }}</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="btn-wrapper">
                                    <button type="submit" id="login_btn" class="btn-default rounded-btn">{{ __('sign in') }}</button>
                                </div>
                                <div class="sign-in-with">
                                    @if(get_static_option('enable_google_login'))
                                        <a href="{{ route('login.google.redirect') }}" class="special-account">
                                            <img src="{{ asset('assets/frontend/img/icon/google-icon.svg') }}" alt="icon">
                                        </a>
                                    @endif
                                    @if(get_static_option('enable_facebook_login'))
                                        <a href="{{ route('login.facebook.redirect') }}" class="special-account">
                                            <img src="{{ asset('assets/frontend/img/icon/Facebook-icon.svg') }}" alt="icon">
                                        </a>
                                    @endif
                                </div>
                            </form>
                            <p class="info">{{ __("Don't have an account?") }} <a href="{{ route('user.register') }}" class="active">{{ __('Sign up') }}</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    @include('frontend.partials.google-captcha')
    @include('frontend.partials.gdpr-cookie')
    @include('frontend.partials.inline-script')
    @include('frontend.partials.twakto')
    <x-sweet-alert-msg/>
    <script src="{{ asset('assets/common/js/toastr.min.js') }}"></script>
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

                    el.text('{{__("Please Wait")}}');

                    $.ajax({
                        type: 'post',
                        url: "{{route('user.ajax.login')}}",
                        data: {
                            _token: "{{ csrf_token() }}",
                            username: username,
                            password: password,
                            remember: remember,
                        },
                        success: function (data) {
                            if (data.status === 'invalid') {
                                el.text('{{__("Login")}}');
                                formContainer.find('.error-wrap').html('<div class="alert alert-danger">' + data.msg + '</div>');
                            } else {
                                formContainer.find('.error-wrap').html('');
                                el.text('{{__("Login Success.. Redirecting ..")}}');
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
                            el.text('{{__("Login")}}');
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
@endsection
