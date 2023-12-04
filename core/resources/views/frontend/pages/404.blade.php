{{--@extends('frontend.frontend-page-master')--}}
        <!DOCTYPE html>
<html class="no-js" lang="{{get_default_language()}}" dir="{{get_default_language_direction()}}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {!! load_google_fonts() !!}
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/bootstrap.min-v4.6.0.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/line-awesome.min-v1.3.0.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/jquery.fancybox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/slick.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/main-style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/dynamic-style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/helpers.css') }}">

    @include('frontend.partials.css-variable')

    @yield('style')

    <link rel="stylesheet" href="{{ asset('assets/common/css/toastr.css') }}">

    @if(!empty(get_static_option('site_rtl_enabled')) || get_user_lang_direction() == 'rtl')
        <link rel="stylesheet" href="{{asset('assets/frontend/css/rtl.css')}}">
    @endif
    <script>let siteurl = "{{url('/')}}";</script>
    {!! get_static_option('site_third_party_tracking_code') !!}
</head>
<body>
<div class="error-area-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="img-box">
                    {!! render_image_markup_by_attachment_id(get_static_option('error_404_page_image')) !!}
                </div>
                <div class="content">
                    <h4 class="title">{{ get_static_option('error_404_page_title') }}</h4>
                    <div class="btn-wrapper">
                        <a href="{{ route('homepage') }}"
                           class="btn-default rounded-btn">{{ get_static_option('error_404_page_button_text') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
