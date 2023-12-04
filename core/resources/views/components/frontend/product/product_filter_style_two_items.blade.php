@php
    $attributes = \Modules\Product\Entities\ProductInventoryDetails::where("product_id",$item->id)->count();
    if (isset($isCampaign) && $isCampaign) {
        $campaign_product = getCampaignProductById($item->id);
        $campaignItemInfo = getCampaignItemStockInfo($campaign_product);
        $percentage = $campaignItemInfo['sold_count'] / $campaignItemInfo['in_stock_count'] * 100;
        $campaign_percentage = getCampaignPricePercentage($campaign_product, $item->price, 1);
        $campaignProductEndDate = $item->campaign->end_date ?? $item->campaign->end_date->end_date ?? '';
        $sale_price = $campaign_product ? $campaign_product->campaign_price : $item->sale_price;
        $deleted_price = $campaign_product ? $item->sale_price : $item->price;
    }else{
        $campaign_product = getCampaignProductById($item->id);
        $campaignProductEndDate = $item->campaign->end_date ?? $item->campaign->end_date->end_date ?? '';
        $sale_price = $campaign_product ? optional($campaign_product)->campaign_price : $item->sale_price;
        $deleted_price = !is_null($campaign_product) ? $item->sale_price : $item->price;
        $campaign_percentage = !is_null($campaign_product) ? getPercentage($item->sale_price, $sale_price) : false;
    }

    $quick_view_data = getQuickViewDataMarkup($item);
    $quick_view_markup = '<a href="#" id="quickview" class="quick-view" '.$quick_view_data.'}><i class="lar la-eye icon"></i></a>';
@endphp

<div class="single-product-view-grid-style-04">
    <div class="product-thumb">
        <ul class="other-content">
            @if(!empty($item->badge))
                <li>
                    <span class="badge-tag">{{ $item->badge }}</span>
                </li>
            @endif
            @if(!empty($campaign_percentage))
                <li>
                    <span class="discount-tag">{{ round($campaign_percentage) }}%</span>
                </li>
            @endif
        </ul>
        <a href="#" class="img-link">
            {!! render_image_markup_by_attachment_id($item->image) !!}
        </a>
    </div>
    <div class="product-content">
        <div class="main-content">
            <h4 class="product-title">
                <a href="{{ route("frontend.products.single",["slug" => $item->slug]) }}">{{ html_entity_decode($item->title) }}</a>
            </h4>
            <div class="bottom-content">
                <div class="left-content">
                    <div class="ratings">
                        @if($item->ratingCount())
                        {!! ratingMarkup($item->ratingAvg(), $item->ratingCount(), false) !!}
                        @endif
                        </span>
                        @if($item->ratingCount())
                            <span class="total-feedback">({{ $item->ratingCount() }})</span>
                        @endif
                    </div>
                    <div class="product-pricing">
                        <span class="price">{{ float_amount_with_currency_symbol($sale_price) }}</span>
                    </div>
                </div>
                <div class="right-content">
                    @if(isset($attributes) && $attributes > 0)
                        <a href="{{ route('frontend.products.single', $item->slug) }}">
                            <i class="las la-plus-circle icon"></i>
                        </a>
                    @else
                        <a href="javascript:void(0)" data-attributes="{{ $item->attributes }}" data-id="{{ $item->id }}"
                           class="add_to_cart_ajax">
                            <i class="las la-shopping-cart icon"></i>
                        </a>
                    @endif

                    @if(isset($attributes) && $attributes > 0)
                        <a href="{{ route('frontend.products.single', $item->slug) }}">
                            <i class="lar la-heart icon"></i>
                        </a>
                    @else
                        <a href="javascript:void(0)" data-attributes="{{ $item->attributes }}" data-id="{{ $item->id }}"
                           class="add_to_wishlist_ajax">
                            <i class="lar la-heart icon"></i>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>