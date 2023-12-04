@extends('frontend.user.dashboard.user-master')
@section('style')
    <x-loader.css />
@endsection
@section('section')
<h5 class="mb-3">{{ __('Add Shipping Address') }}</h5>
<div class="text-right btn-wrapper">
    <a href="{{ route('user.shipping.address.all') }}" class="btn-default rounded-btn semi-bold">{{ __('All Shipping Address') }}</a>
</div>
<form action="{{ route("user.shipping.address.new") }}" method="POST" id="new_user_shipping_address_form">
    @csrf
    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="name">{{ __('Name') }}</label>
            <input type="text" class="form-control" name="name" id="name">
        </div>
        <div class="form-group col-md-6">
            <label for="email">{{ __('Email') }}</label>
            <input type="text" class="form-control" name="email" id="email">
        </div>
        <div class="form-group col-md-6">
            <label for="phone">{{ __('Phone') }}</label>
            <input type="text" class="form-control" name="phone" id="phone">
        </div>
        <div class="form-group col-md-6">
            <label for="country">{{ __('Country') }}</label>
            <select class="form-control" name="country" id="country">
                <option value="">{{ __('Select Country') }}</option>
                @foreach($all_country as $country)
                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-6">
            <label for="state">{{ __('State') }}</label>
            <select class="form-control" name="state" id="state">
                <option value="">{{ __('Select State') }}</option>
            </select>
        </div>
        <div class="form-group col-md-6">
            <label for="city">{{ __('City') }}</label>
            <input type="text" class="form-control" name="city" id="city">
        </div>
        <div class="form-group col-md-6">
            <label for="zipcode">{{ __('Zipcode') }}</label>
            <input type="text" class="form-control" name="zipcode" id="zipcode">
        </div>
        <div class="form-group col-md-12">
            <label for="address">{{ __('Address') }}</label>
            <input type="text" class="form-control" name="address" id="address" cols="30" rows="5">
        </div>
        <div class="col-md-6">
            <div class="btn-wrapper mt-4">
                <button class="btn-default rounded-btn semi-bold">{{ __('Submit') }}</button>
            </div>
        </div>
    </div>
</form>
<x-loader.html />
@endsection
@section('scripts')
    <script>
        (function($) {
            "use strict";
            $(document).ready(function ($) {
                $('#country').on('change', function() {
                    let id = $(this).val();
                    $('.lds-ellipsis').show();
                    $.get('{{ route('country.info.ajax') }}', {id: id}).then(function (data) {
                        $('.lds-ellipsis').hide();
                        $('#state').html('<option value="">{{ __('Select State') }}</option>');
                        data.states.map(function (e) {
                            $('#state').append('<option value="' + e.id + '">' + e.name + '</option>');
                        });
                    });
                });
            });
        })(jQuery);
    </script>
@endsection