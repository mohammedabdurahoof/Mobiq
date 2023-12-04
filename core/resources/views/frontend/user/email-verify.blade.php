@extends('frontend.frontend-page-master')
@section('page-title')
    {{__('Verify Your Account')}}
@endsection
@section('content')
    <section class="sign-in-area-wrapper">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-6">
                    <div class="sign-in register">
                        <h4 class="title">{{ __('Verify Your Account') }}</h4>
                        <div class="error-container">
                            <x-msg.error/>
                            <x-msg.success/>
                        </div>
                        <div class="form-wrapper">
                            <form action="{{route('user.email.verify')}}" method="post" enctype="multipart/form-data" class="register-form verify-mail">
                                @csrf
                                <div class="form-group">
                                    <input type="text" name="verification_code" class="form-control" placeholder="{{__('Verify Code')}}">
                                </div>
                                <div class="btn-wrapper">
                                    <button type="submit" class="btn-default rounded-btn">{{__('Verify Email')}}</button>
                                </div>
                                <div class="btn-pair btn-wrapper btn-top">
                                    <div class="col-12 text-center mt-3">
                                        <a href="{{route('user.resend.verify.mail')}}" class="forgot-btn" style="text-transform: initial">{{__('Send verify code again?')}}</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
