@extends('frontend.frontend-page-master')
@section('site-title')
    {{__('Track Order')}}
@endsection
@section('page-title')
    {{__('Track Order')}}
@endsection

@section('content')
    <div class="sign-in-area-wrapper">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <div class="box-animation" @if(session()->has('info') || session()->has('msg') || $errors->any()) style="min-height: 410px!important;" @endif>
                        <div class="wrap">

                      
                        <div class="sign-in register">
                            <h4 class="title">{{ __('Order Tracking') }}</h4>
                            <div class="form-wrapper">
                                <x-msg.flash />
                                <x-msg.error />

                                @if(session()->has('info'))
                                    <div class="alert alert-{{session('type')}}">
                                        {!! session('info') !!}
                                    </div>
                                @endif
                                <form method="POST" action="{{ route('frontend.products.track.order') }}">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" name="order_id" class="form-control" id="order_id" placeholder="{{__('Order Id')}}">
                                    </div>
{{--                                    <div class="form-group">--}}
{{--                                        <input type="email" name="email" class="form-control" id="email" placeholder="{{__('Billing Email')}}">--}}
{{--                                    </div>--}}
                                    <div class="btn-wrapper">
                                        <button type="submit" class="btn-default rounded-btn">{{ __('Track your order') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
