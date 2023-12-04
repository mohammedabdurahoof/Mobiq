<div class="order-summery-wrap">
    <h4 class="title">{!! filter_static_option_value('order_summary_title', $setting_text, __('your order')) !!}</h4>

    <ul class="order-summery-list">
        <li class="single-order-summery border-bottom">
            <div class="content">
                <span class="subject text-deep">{{ __('product') }}</span>
                <span class="object text-deep">{!! filter_static_option_value('subtotal_text', $setting_text, __('subtotal')) !!}</span>
            </div>
            <ul class="internal-order-summery-list">
                @foreach ($all_cart_items as $key => $item)
                    @php $product = $products->find($key); @endphp
                    @foreach ($item as $cart_item)
                        @php
                            $price = $cart_item['attributes']['price'] ?? $product->sale_price;
                        @endphp
                        <li class="internal-single-order-summery">
                            <span class="internal-subject">
                                {{ $product->title }} {{ getItemAttributesName($cart_item['attributes']) }}
                                <i class="las la-times icon"></i>
                                <span class="times text-deep">{{ $cart_item['quantity'] }}</span>
                            </span>
                            <span class="internal-object">{{ float_amount_with_currency_symbol($price * $cart_item['quantity']) }}</span>
                        </li>
                    @endforeach
                @endforeach
            </ul>
        </li>
        <li class="single-order-summery border-bottom">
            <div class="content">
                <span class="subject text-deep">{{ __('subtotal') }}</span>
                <span class="object text-deep" id="subtotal" data-amount="{{ $subtotal }}">
                    {{ float_amount_with_currency_symbol($subtotal) }}
                </span>
            </div>
        </li>
        @php
            $default_shipping_cost_amount = isset($default_shipping) && $default_shipping->id ? $default_shipping_cost : 0;
        @endphp
        <li class="single-order-summery border-bottom">
            <div class="c-o-n-t-e-n-t">{{--     todo edit class here       --}}
                <span class="subject text-deep">{{ __('Shipping') }}</span>
                <div class="shipping-option-container">
                    @if (isset($default_shipping) && $default_shipping->id)
                        <div class="cost-name-amount all-shipping-options">
                            <span class="same sub">
                                <input type="radio" class="mr-2 mt-1 d-inline-block shipping-option"
                                       {{-- name="selected_shipping_option" --}}
                                       name="display_shipping_option"
                                       data-minimum-amt="{{ optional($default_shipping->availableOptions)->minimum_order_amount ?? 0 }}"
                                       data-amount="{{ optional($default_shipping->availableOptions)->cost ?? 0 }}"
                                       value="{{ $default_shipping->id }}"
                                       @if($default_shipping_cost_amount) checked @endif >
                                    {{ $default_shipping->name }}

                                @if(optional($default_shipping->availableOptions)->minimum_order_amount ?? 0)
                                    <small class="min-order-text">{{ __("Minimum order amount: ") }}
                                        {{ optional($default_shipping->availableOptions)->minimum_order_amount ?? 0 }}

                                        @if(optional($default_shipping->availableOptions)->setting_preset == 'min_order_and_coupon')
                                            {{ __("And coupon needed.") }}
                                        @elseif(optional($default_shipping->availableOptions)->setting_preset == 'min_order_or_coupon')
                                            {{ __("Or coupon needed.") }}
                                        @endif
                                    </small>
                                @endif
                            </span>
                            <span class="same sub-amount">{{ float_amount_with_currency_symbol(optional($default_shipping->availableOptions)->cost ?? 0) }}</span>
                        </div>
                    @endif
                </div>

            </div>
        </li>

        <li class="single-order-summery">
            <div class="content">
                <span class="subject text-deep">{!! filter_static_option_value('discount_text', $setting_text, __('coupon discount')) !!}</span>
                <span class="object" id="coupon_amount">
                    -{{ float_amount_with_currency_symbol($coupon_amount) }}
                </span>
            </div>
        </li>
        <li class="single-order-summery">
            <div class="content">
                <span class="subject text-deep">{!! filter_static_option_value('vat_text', $setting_text, __('Tax')) !!}</span>
                <span class="object" id="tax_amount">
                    +{{ float_amount_with_currency_symbol($tax) }}
                </span>
            </div>
        </li>
        <li class="single-order-summery border-bottom">
            <div class="content">
                <span class="subject text-deep">{!! filter_static_option_value('shipping_text', $setting_text, __('shipping cost')) !!}</span>
                <span class="object" id="shipping_charge">
                    +{{ float_amount_with_currency_symbol($default_shipping_cost) }}
                </span>
            </div>
        </li>
        <li class="single-order-summery border-bottom">
            <div class="content total">
                <span class="subject text-deep color-main">{!! filter_static_option_value('total_text', $setting_text, __('Total')) !!}</span>
                <span class="object text-deep color-main" id="total_amount">
                    {{ float_amount_with_currency_symbol($total) }}
                </span>
            </div>
        </li>
        <li class="single-order-summery border-bottom" id="payment_method_input">
            <div class="order-form">
                <div class="form-group form-check col-12">
                    {{--   Todo: [MARKUP CHANGED] Fix Markup + CSS in this (Payment options) block   --}}
                    {!! render_payment_gateway_for_form() !!}
                    @if(!empty(get_static_option('manual_payment_gateway')))
                        <div class="form-group manual_payment_transaction_field" style="display: none">
                            <div class="label">{{__('Transaction ID')}}</div>
                            <input type="text" name="transaction_id" placeholder="{{__('Transaction ID')}}"
                                   class="form-control">
                            <span class="help-info">{!! get_manual_payment_description() !!}</span>
                        </div>
                    @endif
                    @if(!empty(get_static_option('bank_transfer_gateway')))
                        <div class="form-group bank_transfer_transaction_field" style="display: none">
                            <div class="label">{{__('Bank Transfer Image')}}</div>
                            <input type="file" name="bank_transfer_input" class="form-control-file" id="bank_transfer_input">
                            <span class="help-info">{!! get_manual_payment_description('bank_transfer') !!}</span>
                        </div>
                    @endif
                    @if(!empty(get_static_option('cheque_payment_gateway')))
                        <div class="form-group cheque_payment_transaction_field" style="display: none">
                            <div class="label">{{__('Cheque Payment Image')}}</div>
                            <input type="file" name="cheque_payment_input" class="form-control-file" id="cheque_payment_input">
                            <span class="help-info">{!! get_manual_payment_description('cheque_payment') !!}</span>
                        </div>
                    @endif
                </div>
                <div class="border-bottom"></div>
                <div class="form-group form-check col-12 ex-padding">
                    @php
                        $checkout_page_terms_text = get_static_option('checkout_page_terms_text');
                        $checkout_page_terms_link_url = get_static_option('checkout_page_terms_link_url');
                        $checkout_page_terms_link_url = $checkout_page_terms_link_url ? url($checkout_page_terms_link_url) : "#";

                        $terms_text = str_replace(['[lnk]', '[/lnk]'], ["<a class='terms' href='$checkout_page_terms_link_url'>", "</a>"], $checkout_page_terms_text);
                    @endphp
                    <input type="checkbox" class="form-check-input" id="terms_check" required>
                    <label class="form-check-label terms-and-cond" for="terms_check">{!! $terms_text !!}</label>
                </div>
                <div class="btn-wrapper">
                    <button class="btn btn-block btn-default" id="place_order">{{ filter_static_option_value('checkout_place_order', $setting_text, __('place order')) }}</button>
                    <a href="{{ route('frontend.products.cart') }}" class="btn-default">{{ filter_static_option_value('checkout_return_cart', $setting_text, __('Return to cart')) }}</a>
                </div>
            </div>
        </li>
    </ul>
</div>
