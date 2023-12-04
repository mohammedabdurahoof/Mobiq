<div class="row">
    <div class="form-group col-lg-12 col-12">
        <label>{{'Name'}} <span class="text-danger">*</span></label>
        <input type="text" id="f-name" name="name" value="{{ old('name') ?? $user->name ?? '' }}" placeholder="Full Name">
    </div>
    <div class="form-group col-lg-6 col-12">
        <label>{{'Country'}} <span class="text-danger">*</span></label>
        <select name="country" id="country">
            <option value="">{{ __('Select Country') }}</option>
            @foreach ($countries as $country)
                <option value="{{ $country->id }}" @if(isset($user) && isset($user->country) && $user->country == $country->id) selected @endif >
                    {{ $country->name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-lg-6 col-12">
        <label>{{'State'}} <span class="text-danger">*</span></label>
        <select id="state" name="state">
            <option value="">{{ __('Select State') }}</option>
            @if(isset($user) && isset($user->country))
                @php
                    $states = \App\Country\State::select('id', 'name')->where('country_id', $user->country)->get();
                @endphp
                @foreach($states as $state)
                    <option value="{{ $state->id }}" @if($user->state == $state->id) selected @endif>{{ $state->name }}</option>
                @endforeach
            @endif
        </select>
    </div>
    <div class="form-group col-lg-6 col-12">
        <label>{{'City'}} <span class="text-danger">*</span></label>
        <input type="text" id="city" name="city" value="{{ old('city') ?? $user->city ?? '' }}" placeholder="{{ filter_static_option_value('checkout_billing_city', $setting_text,  __('City')) }}">
    </div>
    <div class="form-group col-lg-6 col-12">
        <label>{{'Zipcode'}} <span class="text-danger">*</span></label>
        <input type="text" id="zipcode" name="zipcode" value="{{ old('zipcode') ?? $user->zipcode ?? '' }}" placeholder="{{  filter_static_option_value('checkout_billing_zipcode', $setting_text, __('Zip Code')) }}">
    </div>
    <div class="form-group col-12">
         <label>{{'Adress'}} <span class="text-danger">*</span></label>
        <input type="text" id="address" name="address" value="{{ old('address') ?? $user->address ?? '' }}" placeholder="{{ filter_static_option_value('checkout_billing_address', $setting_text,  __('Address')) }}">
    </div>
    <div class="form-group col-lg-6 col-12">
         <label>{{'Email'}} <span class="text-danger">*</span></label>
        <input type="email" id="email" autocomplete="off" name="email" value="{{ old('email') ?? $user->email ?? '' }}" placeholder="{{  filter_static_option_value('checkout_billing_email', $setting_text, __('Email Address')) }}">
    </div>
    <div class="form-group col-lg-6 col-12">
         <label>{{'Phone'}} <span class="text-danger">*</span></label>
        <input type="text" id="phone" name="phone" value="{{ old('phone') ?? $user->phone ?? '' }}" placeholder="{{  filter_static_option_value('checkout_billing_phone', $setting_text, __('Phone Number')) }}">
    </div>
</div>
<div class="row">
    <div class="form-group col-12">
         <label>{{'Order Note'}}</label>
        <textarea class="form-control" name="order_note" id="order_note" rows="3" value="{{ old('order_note') ?? $user->order_note ?? '' }}" placeholder="{{  filter_static_option_value('checkout_order_note', $setting_text, __('Order Note')) }}"></textarea>
    </div>
</div>
