@extends('backend.admin-master')
@section('style')
    <x-media.css/>
@endsection
@section('site-title')
    {{__('Login/Register Page Settings')}}
@endsection
@section('content')
    @can('page-settings-login-register-page')
        <div class="col-lg-12 col-ml-12 padding-bottom-30">
            <div class="row">
                <div class="col-lg-12">
                    <div class="margin-top-40"></div>
                    <x-msg.success/>
                    <x-msg.error/>
                </div>
                <div class="col-lg-12 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">{{__('Login/Register Page Settings')}}</h4>
                            <form action="{{ route('admin.page.settings.user.auth') }}" method="POST">
                                @csrf
                                
                                <div class="form-group">
                                    <label for="toc_page_link">{{ __('Terms of Service and Conditions Link') }}</label>
                                    <input type="text" class="form-control" id="toc_page_link" name="toc_page_link"
                                           value="{{ get_static_option('toc_page_link') }}">
                                </div>
                                <div class="form-group">
                                    <label for="privacy_policy_link">{{ __('Privacy Policy Link') }}</label>
                                    <input type="text" class="form-control" id="privacy_policy_link"
                                           name="privacy_policy_link"
                                           value="{{ get_static_option('privacy_policy_link') }}">
                                </div>
                               
                                <button class="btn btn-primary">{{ __('Save Settings') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <x-media.markup/>
    @endcan
@endsection
@section('script')
    @can('page-settings-login-register-page')
        <x-media.js/>
        <x-iconpicker.js/>
        <script>
            (function ($) {
                'use script'
                $(document).ready(function () {
                    
                });
            })(jQuery)
        </script>
    @endcan
@endsection
