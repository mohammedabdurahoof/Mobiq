@extends('backend.admin-master')
@section('site-title')
    {{__('Product Details Page Settings')}}
@endsection
@section('style')
    <x-media.css/>
@endsection
@section('content')
    @can('page-settings-product-details-page')
        <div class="col-lg-12 col-ml-12 padding-bottom-30">
            <div class="row">
                <div class="col-lg-12">
                    <div class="margin-top-40"></div>
                    <x-msg.success/>
                    <x-msg.error/>
                </div>
                <div class="col-lg-12 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">{{__('Product Details Page Settings')}}</h4>
                            <form action="{{ route('admin.page.settings.product.detail.page') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="product_in_stock_text">{{ __('Product In Stock Text') }}</label>
                                    <input type="text" name="product_in_stock_text" class="form-control"
                                           value="{{ get_static_option('product_in_stock_text') }}">
                                </div>
                                <div class="form-group">
                                    <label for="product_out_of_stock_text">{{ __('Product Out of Stock Text') }}</label>
                                    <input type="text" name="product_out_of_stock_text" class="form-control"
                                           value="{{ get_static_option('product_out_of_stock_text') }}">
                                </div>
                                <div class="form-group">
                                    <label for="add_to_cart_text">{{ __('Add to Cart Text') }}</label>
                                    <input type="text" name="add_to_cart_text" class="form-control"
                                           value="{{ get_static_option('add_to_cart_text') }}">
                                </div>
                                <div class="form-group">
                                    <label for="description_tab_text">{{ __('Description Tab Text') }}</label>
                                    <input type="text" name="description_tab_text" class="form-control"
                                           value="{{ get_static_option('description_tab_text') }}">
                                </div>
                                <div class="form-group">
                                    <label for="additional_information_text">{{ __('Additional Information Tab Text') }}</label>
                                    <input type="text" name="additional_information_text" class="form-control"
                                           value="{{ get_static_option('additional_information_text') }}">
                                </div>
                                <div class="form-group">
                                    <label for="reviews_text">{{ __('Reviews Tab Text') }}</label>
                                    <input type="text" name="reviews_text" class="form-control"
                                           value="{{ get_static_option('reviews_text') }}">
                                </div>

                                <div class="form-group">
                                    <label for="your_reviews_text">{{ __('Your Review Text') }}</label>
                                    <input type="text" name="your_reviews_text" class="form-control"
                                           value="{{ get_static_option('your_reviews_text') }}">
                                </div>
                                <div class="form-group">
                                    <label for="write_your_feedback_text">{{ __('Write Your Feedback Text') }}</label>
                                    <input type="text" name="write_your_feedback_text" class="form-control"
                                           value="{{ get_static_option('write_your_feedback_text') }}">
                                </div>
                                <div class="form-group">
                                    <label for="post_your_feedback_text">{{ __('Post Your Feedback Text') }}</label>
                                    <input type="text" name="post_your_feedback_text" class="form-control"
                                           value="{{ get_static_option('post_your_feedback_text') }}">
                                </div>
                                <div class="form-group">
                                    <label for="no_rating_text">{{ __('No Rating Text') }}</label>
                                    <input type="text" name="no_rating_text" class="form-control"
                                           value="{{ get_static_option('no_rating_text') }}">
                                </div>
                                <div class="form-group">
                                    <label for="related_product_text">{{ __('Related Product Section Title Text') }}</label>
                                    <input type="text" name="related_product_text" class="form-control"
                                           value="{{ get_static_option('related_product_text') }}">
                                </div>
                                <div class="form-group">
                                    <x-media-upload :name="'related_product_image'"
                                                    :id="get_static_option('related_product_image')"
                                                    :title="__('Related Product Section Image')"/>
                                </div>
                                <div class="form-group">
                                    <label for="">{{ __('Sidebar status') }}</label>
                                    <label class="switch">
                                        <input type="checkbox"
                                               name="sidebar_status" {{ !empty(get_static_option('sidebar_status')) ? 'checked' : '' }}><span
                                                class="slider"></span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label for="sidebar_position">{{ __('Sidebar Position') }}</label>
                                    <select class="form-control" name="sidebar_position" id="sidebar_position">
                                        <option value="left"
                                                @if(get_static_option('sidebar_position') == 'left') selected @endif>{{ __('Left') }}</option>
                                        <option value="right"
                                                @if(get_static_option('sidebar_position') == 'right') selected @endif>{{ __('Right') }}</option>
                                    </select>
                                </div>

                                <button class="btn btn-primary">{{ __('Save Settings') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <x-media.markup/>
    @endcan
@endsection
@section('script')
    <x-media.js/>
@endsection
