@php
    // campaign data check
    $campaign_product = !is_null($product->campaignProduct) ? $product->campaignProduct : getCampaignProductById($product->id);
    $sale_price = $campaign_product ? optional($campaign_product)->campaign_price : $product->sale_price;
    $deleted_price = !is_null($campaign_product) ? $product->sale_price : $product->price;
    $campaign_percentage = !is_null($campaign_product) ? getPercentage($product->sale_price, $sale_price) : false;
    $buttons = \App\PageBuilder\Services\ProductItemServices::product_hover_button($product);

    $attributes = \Modules\Product\Entities\ProductInventoryDetails::where("product_id",$product->id)->count();
    $quick_view_data = getQuickViewDataMarkup($product);
    $quick_view_markup = '<a href="#" id="quickview" class="quick-view" '.$quick_view_data.'}><i class="lar la-eye icon"></i></a>';
@endphp
        <!-- Single -->
<div class="single-branding-product col-lg-6" data-wow-delay="0.0s">
    <div class="top-items-img">
        <span class="tag-box-new top-right">
            @if(!empty($item->badge))
                <span class="tag-new bg-dark border-radius">
                    {{$item->badge}}
                </span>
            @endif
            @if(!empty($campaign_percentage))
                <span class="tag-new bg-orange border-radius">
                    {{round($campaign_percentage)}}%
                </span>
            @endif
        </span>
        <a href="{{ route("frontend.products.single",$product->slug) }}">{!! render_image($product->singleImage) !!}</a>
    </div>
    <div class="cat-caption">
        <h5><a href="{{ route("frontend.products.single",$product->slug) }}" class="title">{{ $product->title }}</a></h5>
        <div class="product-price d-flex align-items-center mb-1">
            <div class="mr-20 mb-10">
                <strong class="price">{{ float_amount_with_currency_symbol($sale_price) }}</strong>
                @if($deleted_price > $sale_price)
                    <span class="offer-price">{{ float_amount_with_currency_symbol($deleted_price) }}</span>
                @endif
            </div>
            <ul class="ratting mb-10">
                @if($product->ratingCount())
                    {!! ratingMarkup($product->ratingAvg(), $product->ratingCount()) !!}
                @endif
            </ul>
        </div>
        <ul class="cart-icon mt-15">
            <li>
                @if(isset($attributes) && $attributes > 0)
                    <a href="{{ route('frontend.products.single', $product->slug) }}">
{{--                        <i class="las la-shopping-cart icon"></i>--}}
                        <i class="las la-plus-circle icon"></i>
                    </a>
                @else
                    <a href="#" data-attributes="{{ $product->attributes }}" data-id="{{ $product->id }}"
                       class="add_to_cart_ajax">
                        <i class="las la-shopping-cart icon"></i>
                    </a>
                @endif
            </li>
            <li>
                @if(isset($attributes) && $attributes > 0)
                    <a href="{{ route('frontend.products.single', $product->slug) }}">
                        <i class="lar la-heart icon"></i>
                    </a>
                @else
                    <a href="#" data-attributes="{{ $product->attributes }}" data-id="{{ $product->id }}"
                       class="add_to_wishlist_ajax">
                        <i class="lar la-heart icon"></i></a>
                    </a>
                @endif
            </li>
            <li>
                <a href="#" data-id="{{$product->id}}" class="add_to_compare_ajax"> <i class="las la-retweet icon"></i></a>
            </li>
            <li>
                @if(isset($attributes) && $attributes > 0)
                    <a class="product-quick-view-ajax" href="javascript:void(0)" data-action-route="{{ route('frontend.products.single-quick-view', $product->slug) }}">
                        <i class="las la-expand-arrows-alt icon"></i>
                    </a>
                @else
                    {!! $quick_view_markup !!}
                @endif
            </li>
{{--            <li><a href="#"> <i class="lar la-heart icon regular"></i> </a></li>--}}
{{--            <li><a href="#"><i class="lar la-eye icon hover"></i></a></li>--}}
{{--            <li><a href="#"> <i class="lar la-plus-square icon regular"></i></a></li>--}}
        </ul>
    </div>
</div>
<!-- Single -->