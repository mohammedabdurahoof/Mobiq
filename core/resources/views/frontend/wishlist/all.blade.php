@extends('frontend.frontend-page-master')

@section('page-title')
    {{ __('Wishlist') }}
@endsection

@section('content')
@if (empty($all_wishlist_items))
    <div class="row justify-content-center my-5">
        <x-frontend.page.empty
                :text="get_static_option('empty_wishlist_text')"
                :image="get_static_option('empty_wishlist_image')"
        />
    </div>
@else
    <div class="wishlist-area-wrapper">
        <div class="container custom-container-1318">
            <div class="row">
                <div class="col-lg-12">
                    <div class="wishlist-inner-content">
                        <table>
                            <thead>
                            <tr>
                                <th>{{ __('product name') }}</th>
                                <th>{{ __('unit price') }}</th>
                                <th>{{ __('quantity') }}</th>
                                <th>{{ __('total') }}</th>
                                <th>{{ __('action') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($all_wishlist_items as $key => $item)
                                    @php
                                        $product = $products->find($key);
                                    @endphp
                                    @foreach ($item as $wishlist_item)
                                        <tr class="in-stock">
                                            <td class="product-info product-mane ">
                                                <span class="product-info-wrap">
                                                    {!! render_image_markup_by_attachment_id($product->image, 'product-title', 'grid') !!}
                                                    <a href="{{ route('frontend.products.single', ['slug' => $product->slug]) }}">
                                                        <span class="product-title"> {{ $product->title }} {{ getItemAttributesName($wishlist_item['attributes']) }}</span>
                                                    </a>
                                                </span>
                                            </td>
                                            <td class="unit-price">{{ float_amount_with_currency_symbol($wishlist_item['attributes']['price'] ?? $product->sale_price) }}</td>
                                            <td class="status">
                                                <input type="number" class="form-control item_quantity" value="{{ $wishlist_item['quantity'] ?? 0 }}">
                                            </td>
                                            <td class="add-to-cart-btn">
                                                @php
                                                $cart_price = $wishlist_item['attributes']['price'] ?? $product->sale_price;
                                                $total_price = $cart_price * $wishlist_item['quantity'];
                                                @endphp
                                                {{ float_amount_with_currency_symbol($total_price) }}
                                            </td>
                                            <td class="trash">
                                                <a href="#" class="remove_wishlist_item trash" data-id="{{ $wishlist_item['id'] }}" data-attr="{{ json_encode($wishlist_item['attributes']) }}">
                                                    <i class="las la-trash icon"></i>
                                                </a>
                                                <a href="#" data-attributes="{{ json_encode($wishlist_item['attributes']) }}" data-id="{{ $product->id }}" class="add-cart-style-01 add_to_cart_ajax_with_attributes">
                                                    <i class="las la-shopping-bag icon"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="wishlist-btn-box">
                        <div class="coupon-and-btn">
                            <div class="btn-wrapper">
                                <a href="#" class="btn-default rounded-btn disable clear_wishlist">{{ __('Clear Wishlist') }}</a>
                            </div>
                            <div class="btn-wrapper">
                                <form action="{{ route('frontend.products.wishlist.send.to.cart') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn-default rounded-btn">{{ __('Add to cart all') }}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
@endsection
@section('scripts')
<script>
    (function ($) {
        'use script'
        $(document).ready(function () {
            toastr.options.progressBar = true;

            $('.remove_wishlist_item').on('click', function (e) {
                e.preventDefault();
                let id = $(this).data('id');
                let attributes = $(this).data('attr');
                $.ajax({
                    url: '{{ route("frontend.products.wishlist.ajax.remove") }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: id,
                        product_attributes: attributes
                    },
                    success: function (data) {
                        if (data.type === 'success') {
                            toastr.success(data.msg);
                            setTimeout(function () {
                                location.reload();
                            }, 500);
                        }
                    },
                    error: function (err) {
                        toastr.error('{{ __("Something went wrong") }}');
                    }
                });
            });
    
            $('.clear_wishlist').on('click', function (e) {
                e.preventDefault();
                $.ajax({
                    url: '{{ route("frontend.products.wishlist.ajax.clear") }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function (data) {
                        if (data.type === 'success') {
                            toastr.success(data.msg);
                            setTimeout(function () {
                                location.reload();
                            }, 500);
                        }
                    },
                    error: function (err) {
                        toastr.error('{{ __("Something went wrong") }}');
                    }
                });
            });

            $('.add_to_cart_ajax_with_attributes').on('click', function (e) {
                e.preventDefault();
                let data = $(this).data();
                let id = data['id'];
                let attributes = data['attributes'];
                let quantity = $(this).closest('tr').find('.item_quantity').val();
                $.ajax({
                    url: '{{ route("frontend.products.wishlist.send.to.cart.single") }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: id,
                        product_attributes: attributes,
                        quantity: quantity,
                    },
                    success: function (data) {
                        if (data['type'] === 'success') {
                            toastr.success(data['msg']);
                            setTimeout(function () {
                                location.reload();
                            }, 500);
                        }
                    },
                    error: function (err) {
                        toastr.error('{{ __("Something went wrong") }}');
                    }
                });
            });
        });
    })(jQuery)
    </script>
@endsection
