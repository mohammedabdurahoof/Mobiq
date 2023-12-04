@extends('frontend.frontend-master')
@section('page-title')
    {{__('Payment Success')}}
@endsection
@section('content-s')
<div class="patment-success-area padding-top-100 padding-bottom-100">
    <div class="container">
        <div class="payment-success-wrapper">
            <div class="payment-contents">
                <h4 class="title"> {{ __('Payment Successful') }} </h4>
                <div class="icon">
                    <i class="las la-check"></i>
                </div>
                <ul class="payment-list margin-top-40">
                    <li>{{ __('Payment Gateway') }} <span class="payment-strong">{{ $payment_details->payment_gateway}}</span></li>
                    <li>{{ __('Phone') }} <span class="payment-strong">{{ $payment_details->phone }}</span></li>
                    <li>{{ __('Name') }} <span class="payment-strong">{{ $payment_details->name }}</span></li>
                    <li>{{ __('Email') }} <span class="payment-strong">{{ $payment_details->email }}</span></li>
                </ul>
                <ul class="payment-list payment-list-two margin-top-30">
                    <li><span class="list-bold">{{ __('Amount Paid') }}</span> <span class="payment-strong payment-bold">{{ float_amount_with_currency_symbol($payment_details->total_amount) }}</span></li>
                    <li>{{ __('Transaction ID') }}<span class="payment-strong">{{ $payment_details->transaction_id }}</span></li>
                </ul>
                <div class="btn-wrapper margin-top-40">
                    @if(auth('web')->check())
                        <a href="{{ route('user.home') }}" class="default-btn color-one">{{ __('Go to Dashboard') }}</a>
                    @else
                        <a href="{{ route('homepage') }}" class="default-btn outline-one">{{ __('Back to Home') }}</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
    <div class="order-completed-area-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="content text-center">
                        <img src="{{ asset('assets/frontend/img/icon/check-icon.svg') }}" alt="icon">
                        <h2 class="page-status-title">{{ __('Your order is Completed!') }}</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="order-data">
                        <table>
                            <thead>
                                <tr>
                                    <th>{{ __('order number') }}</th>
                                    <th>{{ __('date') }}</th>
                                    <th>{{ __('total') }}</th>
                                    <th>{{ __('payment method') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>#{{ $payment_details->id }}</td>
                                    <td>{{ $payment_details->created_at->format('d/m/Y') }}</td>
                                    <td>{{ float_amount_with_currency_symbol($payment_details->total_amount) }}</td>
                                    <td>{{ str_replace('_', ' ', $payment_details->payment_gateway) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="order-complete-wrap">
                        <h4 class="title">{{ __('order details') }}</h4>

                        <ul class="order-summery-list">
                            @php
                                $payment_meta = json_decode($payment_details->payment_meta, true);
                            @endphp
                            <li class="single-order-summery border-bottom">
                                <div class="content border-bottom ex">
                                    <span class="subject text-deep">{{ __('product') }}</span>
                                    <span class="object text-deep">{{ __('subtotal') }}</span>
                                </div>
                                <ul class="internal-order-summery-list">
                                    @foreach($order_details as $order_detail)
                                        @php
                                            $product = $products->find($order_detail->item_id);
                                        @endphp
                                        @if($products->find($order_detail->item_id))
                                            <li class="internal-single-order-summery">
                                                <span class="internal-subject">
                                                    {{ optional($product)->title }} {{ getItemAttributesName($order_detail['attributes']) }}
                                                    <i class="las la-times icon"></i>
                                                    <span class="times text-deep">{{ $order_detail->quantity }}</span>
                                                </span>
                                                <span class="internal-object">
                                                    {{ float_amount_with_currency_symbol($order_detail->price * $order_detail->quantity) }}
                                                </span>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </li>
                            <li class="single-order-summery border-bottom">
                                <div class="content">
                                    <span class="subject text-deep">{{ __('Subtotal') }}</span>
                                    <span class="object text-deep">{{ float_amount_with_currency_symbol($payment_meta['subtotal']) }}</span>
                                </div>
                            </li>
                            <li class="single-order-summery">
                                <div class="content">
                                    <span class="subject text-deep">
                                        {{ __('coupon discount') }}
                                    </span>
                                    <span class="object">
                                        (-) {{ float_amount_with_currency_symbol($payment_meta['coupon_amount']) }}
                                    </span>
                                </div>
                            </li>
                            <li class="single-order-summery">
                                <div class="content">
                                    <span class="subject text-deep">{{ __('tax') }}</span>
                                    <span class="object">(+) {{ float_amount_with_currency_symbol($payment_meta['tax_amount']) }}</span>
                                </div>
                            </li>
                            <li class="single-order-summery border-bottom">
                                <div class="content">
                                    <span class="subject text-deep">{{ __('shipping cost') }}</span>
                                    <span class="object">(+) {{ float_amount_with_currency_symbol($payment_meta['shipping_cost']) }}</span>
                                </div>
                            </li>
                            <li class="single-order-summery border-bottom">
                                <div class="content total">
                                    <span class="subject text-deep color-main">{{ __('total') }}</span>
                                    <span class="object text-deep color-main">{{ float_amount_with_currency_symbol($payment_meta['total']) }}</span>
                                </div>
                            </li>
                            <li class="single-order-summery">
                                <div class="content total">
                                    <span class="subject text-deep">{{ __('payment method') }}</span>
                                    <span class="object">{{ str_replace('_', ' ', render_payment_gateway_name($payment_details->payment_gateway)) }}</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="btn-wrapper text-right">
                        <a href="{{ route('homepage') }}" class="btn-default rounded-btn semi-bold">{{ __('back to home') }}</a>
                        <a href="{{ route('frontend.products.download-invoice',["id" => $payment_details->id]) }}" class="btn-default rounded-btn semi-bold">download invoice</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection