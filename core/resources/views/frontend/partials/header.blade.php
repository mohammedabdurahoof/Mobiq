<!DOCTYPE html>
<html class="no-js" lang="{{App\Helpers\LanguageHelper::user_lang_slug()}}"  dir="{{App\Helpers\LanguageHelper::user_lang_dir()}}">

<head>
    @include('frontend.partials.google-analytics')

    @if(empty($global_static_field_data))
        @php
            $global_static_field_data = [];
        @endphp
    @endif

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @if(request()->routeIs('homepage'))
        <meta name="description" content="{{filter_static_option_value('site_meta_description', $global_static_field_data)}}">
        <meta name="tags" content="{{filter_static_option_value('site_meta_tags', $global_static_field_data)}}">
    @else
        @yield('page-meta-data')
    @endif
    {!! render_favicon_by_id(filter_static_option_value('site_favicon', $global_static_field_data)) !!}
    {!! load_google_fonts() !!}
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/bootstrap.min-v5.0.2.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/animated.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/line-awesome.min-v1.3.0.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/jquery.fancybox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/slick.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/main-style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/main-style-two.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/dynamic-style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/helpers.css') }}">

    @include('frontend.partials.css-variable')

    @yield('style')

    <link rel="stylesheet" href="{{ asset('assets/common/css/toastr.css') }}">

    @if(!empty(filter_static_option_value('site_rtl_enabled', $global_static_field_data)) || get_user_lang_direction() == 'rtl')
        <link rel="stylesheet" href="{{asset('assets/frontend/css/rtl.css')}}">
    @endif
    @include('frontend.partials.og-meta')
    <script>var siteurl = "{{url('/')}}";</script>
    {!! filter_static_option_value('site_third_party_tracking_code', $global_static_field_data) !!}
</head>

@php
    $home_page_variant = $home_page ?? filter_static_option_value('home_page_variant', $global_static_field_data);
@endphp

<body>
    @include('frontend.partials.preloader')
    @include('frontend.partials.topbar')
    @include('frontend.partials.navbar')
