@if(!$user)
<div class="row">
    <div class="creat-account container">
        <div class="create-account-title-wrap">
            <div class="row">
                <div class="form-group form-check col-12">
                    <input type="hidden" class="form-check-input" name="create_account_checkbox" id="able_to_create_account" value="off">
                    <input type="checkbox" class="form-check-input create_account_checkbox" id="Check1" name="create_account_checkbox">
                    <label class="form-check-label label-1" for="Check1">
                        {!! filter_static_option_value('create_account_text', $setting_text, __('Create an Account with above details?')) !!}
                    </label>
                </div>
            </div>
        </div>
{{--        <div class="creat-account-content-wrap" style="display: none;">--}}
        <div class="creat-account-content-wrap d-block">
            <div class="row">
                <div class="form-group col-lg-12 col-12">
                    <label for="create_account_username">{{ filter_static_option_value('create_account_username', $setting_text, __('Username')) }}</label>
                    <input type="text" autocomplete="off" name="username" class="form-control" id="create_account_username" value="">
                </div>
                <div class="form-group col-lg-6 col-12">
                    <label for="create_account_password">{{ filter_static_option_value('create_account_password', $setting_text, __('Password')) }}</label>
                    <input type="password" autocomplete="off" name="password" class="form-control" id="create_account_password" value="">
                </div>
                <div class="form-group col-lg-6 col-12">
                    <label for="create_account_password_confirmation">{{ filter_static_option_value('create_account_confirmed_password', $setting_text, __('Confirmed Password')) }}</label>
                    <input type="password" autocomplete="off" name="password_confirmation" class="form-control" id="create_account_password_confirmation" value="">
                </div>
            </div>
        </div>
    </div>
</div>
@endif
