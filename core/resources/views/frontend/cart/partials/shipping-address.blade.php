<input type="hidden" name="shipping_address_id" id="shipping_address_id">
<div class="row">
    <div class="ship-to-another-address-wrap container">
        <div class="ship-title-wrap">
            <div class="row">
                <div class="form-group form-check col-12">
                    <input type="checkbox" class="form-check-input" id="ship">
                    <label class="form-check-label label-1" for="ship">
                        {!! filter_static_option_value('ship_to_another_text', $setting_text, __('Ship to another address?')) !!}
                    </label>
                </div>
            </div>
        </div>
        <div class="ship-another-address-content" style="display: none;">
            @if ($all_user_shipping)
                @include('frontend.cart.checkout-user-shipping')
            @endif
            <div class="row">
                <div class="form-group col-lg-12 col-12">
                    <input type="text" id="shipping_name" name="shipping_name" placeholder="{{ filter_static_option_value('shipping_name', $setting_text, __('Name')) }}">
                </div>
                <div class="form-group col-lg-6 col-12">
                    <select id="shipping_country" name="shipping_country">
                        <option value="" selected="" disabled="">{{ filter_static_option_value('shipping_country', $setting_text, __('Country')) }}</option>
                        @foreach ($countries as $country)
                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-lg-6 col-12">
                    <select id="shipping_state" name="shipping_state">
                        <option value="" selected="" disabled="">{{ filter_static_option_value('shipping_state', $setting_text, __('Select State')) }}</option>
                    </select>
                </div>
                <div class="form-group col-lg-6 col-12">
                    <input type="text" id="shipping_city" value="" name="shipping_city" placeholder="{{ filter_static_option_value('shipping_city', $setting_text, __('City')) }}">
                </div>
                <div class="form-group col-lg-6 col-12">
                    <input type="text" id="shipping_zipcode" name="shipping_zipcode" placeholder="{{ filter_static_option_value('shipping_zipcode', $setting_text, __('Zip Code')) }}">
                </div>
                <div class="form-group col-12">
                    <label for="address_01">{{ filter_static_option_value('shipping_address', $setting_text, __('Address')) }}</label>
                    <input type="text" id="shipping_address" name="shipping_address" value="">
                </div>
                <div class="form-group col-lg-6 col-12">
                    <input type="email" id="shipping_email" name="shipping_email" placeholder="{{ filter_static_option_value('shipping_email', $setting_text, __('Email Address')) }}">
                </div>
                <div class="form-group col-lg-6 col-12">
                    <input type="text" id="shipping_phone" name="shipping_phone" placeholder="{{ filter_static_option_value('shipping_phone', $setting_text, __('Phone Number')) }}">
                </div>
            </div>
        </div>
    </div>
</div>
