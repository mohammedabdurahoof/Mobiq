@extends('frontend.frontend-page-master')
@section('page-title')
    {{__('Forget Password')}}
@endsection
@section('content')
    <section class="sign-in-area-wrapper padding-top-110 padding-bottom-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="sign-in register">
                        <div class="text-center">
                            <h2 class="margin-bottom-40">{{__('Forget Password ?')}}</h2>
                        </div>
                        <x-msg.error/>
                        <x-msg.success/>
                        <div class="form-wrapper">
                            <form action="{{route('user.forget.password')}}" method="post" enctype="multipart/form-data" class="register-form">
                                @csrf
                                <div class="form-group">
                                    <input type="text" name="username" class="form-control" placeholder="{{__('Username')}}">
                                </div>
                                <div class="form-group btn-wrapper">
                                    <button type="submit" class="btn-default rounded-btn">{{__('Send Reset Mail')}}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
