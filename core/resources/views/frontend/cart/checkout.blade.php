@extends('frontend.frontend-page-master')
@section('page-title')
    {{ __('Checkout') }}
@endsection
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/common/css/toastr.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/payment.css') }}">
    <style>
        .error-wrap li {
            text-transform: capitalize;
        }
    </style>
    <x-loader.css />
@endsection
@section('content')
    @if (!empty($all_cart_items) && count($all_cart_items))
        <div class="checkout-area-wrapper">
            <div class="container custom-container-1318">
                <div class="row">
                    <div class="col-md-7 col-lg-7">
                        <x-msg.stock_error />
                        <x-msg.flash />
                        <x-msg.error />

                        <div class="checkout-inner-content">
                            @include('frontend.cart.partials.login')
                            @include('frontend.cart.partials.coupon')
                            <div class="billing-details-area-wrapper">
                                <h3 class="title">{{ filter_static_option_value('checkout_billing_section_title', $setting_text, __('Billing details')) }}</h3>
                                <form action="{{ route('frontend.checkout') }}"
                                      class="billing-form"
                                      method="POST"
                                      id="billing_info"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="coupon" id="coupon_code" value="{{ old('coupon') ?? request()->coupon }}">
                                    <input type="hidden" name="tax_amount">
                                    <input type="hidden" name="ship_to_another_address" id="ship_to_another_address">
                                    <input type="hidden" name="selected_shipping_option" value="{{ $default_shipping->id }}">
                                    <input type="hidden" name="selected_payment_gateway" value="{{ get_static_option('site_default_payment_gateway') }}">
                                    <input type="hidden" name="agree" id="term_agree">
                                    <input type="file" name="cheque_payment_input" id="cheque_payment" class="d-none">
                                    <input type="file" name="bank_transfer_input" id="bank_transfer" class="d-none">
                                    @include('frontend.cart.partials.billing-info')
                                    @include('frontend.cart.partials.create-account')
                                    @include('frontend.cart.partials.shipping-address')
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5 col-lg-5">
                        @include('frontend.cart.partials.order-summary')
                    </div>
                </div>
            </div>
        </div>
    @else
        <x-frontend.page.empty
                :image="get_static_option('empty_cart_image')"
                :text="filter_static_option_value('checkout_page_no_product_text', $setting_text, __('No products in your cart!'))"
        />
    @endif
    <x-loader.html />
@endsection
@section('scripts')
    @include('frontend.partials.scripts.checkout-scripts')
@endsection
