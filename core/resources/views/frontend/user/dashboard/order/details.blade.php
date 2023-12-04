@extends('frontend.user.dashboard.user-master')
@section('style')
    <x-datatable.css />
    <style>
        .max-width-100 {
            max-width: 100px;
        }
        
    </style>
@endsection
@section('site-title')
    {{ __('My Orders') }}
@endsection
@section('section')
    <div class="form-header-wrap margin-bottom-50 d-flex justify-content-between">
        <h3 class="mb-3">{{ __('Order Details') }}</h3>
    </div>
    <div class="row">
        <div class="col-md-12">
            <ul>
                <li><b>{{ __('Order Id:') }}</b> #{{ $item->id }}</li>
                <li><b>{{ __('Payment Method:') }}</b> {{ ucwords(str_replace('_', ' ', render_payment_gateway_name($item->payment_gateway))) }}</li>
                <li><b>{{ __('Payment Status:') }}</b> {{ ucwords($item->payment_status) }}</li>
                <li><b>{{ __('Order Status:') }}</b> {{ ucwords($item->status) }}</li>
                <li><b>{{ __('Transaction ID:') }}</b> {{ $item->transaction_id }}</li>
            </ul>
        </div>
         <div class="row">
            <div class="col-lg-12">
                <div class="btn-wrapper text-right my-2">
                    <a href="{{ route('frontend.products.download-invoice',["id" => $item->id]) }}" class="btn-default rounded-btn semi-bold">download invoice</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-12 my-5">
            <h3 class="mb-3">{{ __('Ordered Products') }}</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>{{ __('Image') }}</th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Quantity') }}</th>
                        <th>{{ __('Price') }}</th>
                        <th>{{ __('Total') }}</th>
                    </tr>
                </thead>
                @php $cart_items = json_decode($item->order_details, true); @endphp
                <tbody>
                    @foreach($cart_items as $id => $items)
                        @php
                            $product = \Modules\Product\Entities\Product::withTrashed()->find($id); 
                            if(is_null($product)){
                                continue;
                            }
                        @endphp
                        
                        @foreach ($items as $cart_item)
                        <tr>
                            <x-table.td-image :image="$product->image" />
                            <td>
                                <a class="text" href="{{ route("frontend.products.single", $product->slug) }}">
                                    {{ $product->title }} {{ getItemAttributesName($cart_item['attributes']) }}
                                </a>

                                @if($item->status == 'complete')
                                    <br>
                                    <b class="mb-2 mt-1 d-inline-block">{{ __("Now you're eligible to make a review") }}</b>
                                    <br>
                                    <a class="btn btn-sm btn-info" href="{{ route("frontend.products.single", $product->slug) }}">
                                        {{ __("Please give us your feedback") }}
                                    </a>
                                @endif
                            </td>
                            <td>{{ $cart_item['quantity'] ?? 0 }}</td>
                            @php
                                $price = $cart_item['attributes']['price'] ?? $product->sale_price;
                            @endphp
                            <td>{{  float_amount_with_currency_symbol($price) }}</td>
                            <td>
                                {{ float_amount_with_currency_symbol($cart_item['quantity'] * $price)  }}
                            </td>
                        </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-md-6 my-2">
            <h3 class="mb-3">{{ __('Order Summary') }}</h3>
            @php
                $payment_meta = json_decode($item->payment_meta,true);
            @endphp
            
            <table class="table table-bordered">
                <tbody>
                    @if($item->coupon)
                        <tr>
                            <th>{{ __('Coupon') }}</th>
                            <td>{{ float_amount_with_currency_symbol($item->coupon) }}</td>
                        </tr>
                    @endif
                    @if($item->coupon_discounted)
                        <tr>
                            <th>{{ __('Coupon Discount') }}</th>
                            <td>{{ float_amount_with_currency_symbol($item->coupon_discounted) }}</td>
                        </tr>
                    @endif
                    <tr>
                        <th>{{ __('Tax') }}</th>
                        <td>(+) {{ float_amount_with_currency_symbol($payment_meta['tax_amount']) }}</td>
                    </tr>
                   <tr>
                        <th>{{ __('Shipping cost') }}</th>
                        <td>(+) {{ float_amount_with_currency_symbol($payment_meta['shipping_cost']) }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Total Amount') }}</th>
                        <td>{{ float_amount_with_currency_symbol($item->total_amount) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/backend/js/sweetalert2.js') }}"></script>
    <x-datatable.js />
    <script>
        (function($) {
            "use strict";
            $(document).ready(function() {
                $(document).on('click', '.mobile_nav', function(e) {
                    e.preventDefault();
                    $(this).parent().toggleClass('show');
                });
                $(document).on('click', '.swal_delete_button', function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: '{{ __('Are you sure?') }}',
                        text: '{{ __('You would not be able to revert this item!') }}',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $(this).next().find('.swal_form_submit_btn').trigger('click');
                        }
                    });
                });
            })
        })(jQuery)
    </script>
@endsection
