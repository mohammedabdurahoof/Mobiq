@extends('frontend.frontend-page-master')
@section('page-title')
    {{__('Register')}}
@endsection
@section('content')
    <section class="sign-in-area-wrapper">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-6">
                    <div class="sign-in register">
                        <h4 class="title">{{ __('Create Account') }}</h4>
                        <div class="form-wrapper">
                            <x-msg.error />
                            <x-msg.flash />
                            <form action="{{route('user.register')}}" method="post" enctype="multipart/form-data" class="account-form">
                                @csrf
                                <input type="hidden" name="captcha_token" id="gcaptcha_token">
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control" placeholder="{{__('Name')}}">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="username" class="form-control" placeholder="{{__('Username')}}">
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control" placeholder="{{__('Email')}}">
                                </div>
                                <div class="form-group">
                                    <select id="country" class="form-control" name="country">
                                        <option value="">{{ __("Select Country") }}</option>
                                        @foreach ($all_country as $country)
                                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select id="state" class="form-control" name="state">
                                        <option value="">{{ __("Select State") }}</option>
                                    </select>
                                </div>
                                <!--<div class="form-group">-->
                                <!--    <input type="text" name="city" class="form-control" placeholder="{{__('City')}}">-->
                                <!--</div>-->
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control" placeholder="{{__('Password')}}">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password_confirmation" class="form-control" placeholder="{{__('Confirm Password')}}">
                                </div>
                                <div class="form-group form-check">
                                    <div class="box-wrap">
                                        <div class="left">
                                            <input type="checkbox" class="form-check-input" id="toc_and_privacy" name="agree_terms" required>
                                            <label class="form-check-label" for="toc_and_privacy">
                                                {{ __('Accept all') }}
                                                <a href="{{ get_static_option('toc_page_link') }}" class="text-active">{{ __('Terms and Conditions') }}</a> &amp;
                                                <a href="{{ get_static_option('privacy_policy_link') }}" class="text-active">{{ __('Privacy Policy') }}</a>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="btn-wrapper">
                                    <button type="submit" class="btn-default rounded-btn">{{ __('Create Account') }}</button>
                                </div>
                            </form>
                            <p class="info">{{__('Already Have account?')}} <a href="{{route('user.login')}}" class="active">{{ __('Sign in') }}</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script src="https://www.google.com/recaptcha/api.js?render={{get_static_option('site_google_captcha_v3_site_key')}}"></script>
    <script>
        $(document).on("change","#country", function (e){
            $.ajax({
                url: '{{ route("country.state.info.ajax") }}',
                type: 'GET',
                data: {
                    id: $(this).val(),
                    _token: '{{ csrf_token() }}'
                },
                success: function (data) {
                    $("#state").html(data);
                },
                erorr: function (err) {
                    toastr.error('{{ __("An error occurred") }}');
                }
            });
        })
    
        grecaptcha.ready(function() {
            grecaptcha.execute("{{get_static_option('site_google_captcha_v3_site_key')}}", {action: 'homepage'}).then(function(token) {
                document.getElementById('gcaptcha_token').value = token;
            });
        });
    </script>
@endsection
