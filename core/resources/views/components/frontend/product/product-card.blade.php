@php
    $attributes = \Modules\Product\Entities\ProductInventoryDetails::where("product_id",$product->id)->count();

    $quick_view_data = getQuickViewDataMarkup($product);
    $quick_view_markup = '<a href="#" id="quickview" class="quick-view" '.$quick_view_data.'}><i class="lar la-eye icon"></i></a>';

    $campaign_product = getCampaignProductById($product->id);
    $campaignProductEndDate = $product->campaign->end_date ?? $product->campaign->end_date->end_date ?? '';

    $sale_price = $campaign_product ? optional($campaign_product)->campaign_price : $product->sale_price;
    $deleted_price = !is_null($campaign_product) ? $product->sale_price : $product->price;
    $campaign_percentage = !is_null($campaign_product) ? getPercentage($product->sale_price, $sale_price) : false;

    $campaignSoldCount = \App\Campaign\CampaignSoldProduct::where("product_id",$product->id)->first();
    $stock_count = $campaign_product ? $campaign_product->units_for_sale - optional($campaignSoldCount)->sold_count ?? 0 : optional($product->inventory)->stock_count;
    $stock_count = $stock_count > 0 ? $stock_count : 0;
@endphp
<div class="single-product-view-grid-style-01 product_card">
    <div class="product-thumb">
        <a href="{{ route('frontend.products.single', $product->slug) }}" class="img-link">
            {!! render_image_markup_by_attachment_id($product->image, '', 'grid', true) !!}
        </a>
        <ul class="other-content">
            @if(!empty($campaign_percentage))
                <li>
                    <span class="badge-tag">{{ round($campaign_percentage) }}%</span>
                </li>
            @endif
            @if(!empty($product->badge))
                <li>
                    <span class="discount-tag">{{ $product->badge }}</span>
                </li>
            @endif
        </ul>
        <ul class="other-content-2">
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
        </ul>
    </div>
    <div class="product-content">
        <div class="main-content">
            @if(!is_null($product->category))
            <a href="{{ route('frontend.products.category', [
                'id' => optional($product->category)->id,
                'slug' => \Str::slug(optional($product->category)->title ?? 'x')
            ]) }}" class="category">{{ optional($product->category)->title }}</a>
            @endif                
            <h4 class="product-title">
                <a href="{{ route('frontend.products.single', $product->slug) }}">{{ $product->title }}</a>
            </h4>
            <span class="quantity">{{ $product->unit }} {{ $product->uom }}</span>

            @if ($stock_count > 0)
                <span class="availability">{{ __('In stock') }} ({{ $stock_count }})</span>
            @else
                <span class="availability text-danger">{{ __('Out of stock') }} ({{ $stock_count }})</span>
            @endif

            <div class="ratings">
                @if($product->ratingCount())
                {!! ratingMarkup($product->ratingAvg(), $product->ratingCount()) !!}
                @endif
            </div>
            <div class="product-pricing">
                @if($deleted_price > $sale_price)
                    <del>{{ float_amount_with_currency_symbol($deleted_price) }}</del>
                @endif

                <span class="price">{{ float_amount_with_currency_symbol($sale_price) }}</span>
            </div>
        </div>
        <div class="hover-content">
            <div class="cart-control">
                <div class="value-button minus decrease"><i class="las la-minus"></i></div>
                <input type="number" name="quantity" class="qty_" value="1" />
                <div class="value-button plus increase"><i class="las la-plus"></i></div>
            </div>
            <div class="btn-wrapper">
                @if(isset($attributes) && $attributes > 0)
                    <a href="{{ route('frontend.products.single', $product->slug) }}" class="add-cart-style-01">{{ __('View Options') }}</a>
                @else
                    <a href="#" data-attributes="{{ $product->attributes }}" data-id="{{ $product->id }}" class="add-cart-style-01 add_to_cart_ajax_with_quantity">{{ __('Add to Bag') }}</a>
                @endif
            </div>
        </div>
    </div>
</div>
