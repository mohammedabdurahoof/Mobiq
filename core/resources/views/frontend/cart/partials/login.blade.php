@if(!$user)
    <div class="shortcut-login-wrapper">
        <div class="login-title-wrap" id="login">
            <p class="query">
                {!! filter_static_option_value('returning_customer_text', $setting_text, __('Returning customer?')) !!}
                <span class="click">{!! filter_static_option_value('toggle_login_text', $setting_text, __('Click here to login')) !!}</span>
            </p>
        </div>
        <div class="login-content" style="display: none;">
            <div class="sign-in-area-wrapper">
                <div class="sign-in register">
                    <div class="form-wrapper">
                        <form class="form-wrapper" id="login_form_order_page">
                            <div class="error-wrap">

                            </div>
                            <div class="row">
                                <div class="form-group col-lg-6 col-12">
                                    <input type="text" name="username" class="form-control" id="exampleputEmail1" placeholder="{{ filter_static_option_value('checkout_username', $setting_text, __('Username')) }}">
                                </div>
                                <div class="form-group col-lg-6 col-12">
                                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="{{ filter_static_option_value('checkout_password', $setting_text, __('Password')) }}">
                                </div>
                            </div>
                            <div class="form-group form-check">
                                <div class="box-wrap">
                                    <div class="left">
                                        <input type="checkbox" name="remember" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">
                                            {!! filter_static_option_value('checkout_remember_text', $setting_text, __('Remember me')) !!}
                                        </label>
                                    </div>
                                    <div class="right">
                                        <a href="#">{{ filter_static_option_value('checkout_forgot_password', $setting_text, __('Forgot Password')) }}</a>
                                    </div>
                                </div>
                            </div>
                            <div class="btn-wrapper">
                                <button type="submit" id="login_btn" class="btn-default rounded-btn">
                                    {!! filter_static_option_value('checkout_login_btn_text', $setting_text, __('Sign in')) !!}
                                </button>
                            </div>
                            <div class="sign-in-with">
                                @if(get_static_option('enable_google_login'))
                                    <a href="{{route('login.google.redirect')}}" class="special-account">
                                        <img src="{{ asset('assets/frontend/img/icon/google-icon.svg') }}" alt="icon">
                                    </a>
                                @endif
                                @if(get_static_option('enable_facebook_login'))
                                    <a href="{{route('login.facebook.redirect')}}" class="special-account">
                                        <img src="{{ asset('assets/frontend/img/icon/Facebook-icon.svg') }}" alt="icon">
                                    </a>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
