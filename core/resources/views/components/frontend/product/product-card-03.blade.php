@php
    $model = $model ?? true;
    // check if product is isset and not empty only then those code will work
    if(empty($product)){
        return false;
    }
    $attributes = \Modules\Product\Entities\ProductInventoryDetails::where("product_id",optional($product)->id)->count();

    if (isset($isCampaign) && $isCampaign) {
        $campaign_product = getCampaignProductById(optional($product)->id);

        $campaignItemInfo = getCampaignItemStockInfo($campaign_product);
        $percentage = $campaignItemInfo['sold_count'] / $campaignItemInfo['in_stock_count'] * 100;
        $campaignProductEndDate = optional($product)->campaign->end_date ?? optional($product)->campaign->end_date ?? '';

        $sale_price = $campaign_product ? $campaign_product->campaign_price : $product->sale_price;
        $deleted_price = $campaign_product ? optional($product)->sale_price : optional($product)->price;
        $campaign_percentage = $campaign_product ? getPercentage(optional($product)->sale_price, $sale_price) : false;
    }else{
        $campaign_product = getCampaignProductById($product->id);
        $sale_price = $campaign_product ? $campaign_product->campaign_price : $product->sale_price;
        $deleted_price = $campaign_product ? $product->sale_price : $product->price;
        $campaign_percentage = $campaign_product ? getPercentage($product->sale_price, $sale_price) : false;
    }
@endphp
 <div class="single-product-view-grid-style-03 product_card">
    <div class="product-thumb">
        <a href="{{ route('frontend.products.single', $product->slug) }}" class="img-link">
            @php
                $isAjax = isset($isAjax) && $isAjax ? $isAjax : true;
                $is_lazy = isset($isAjax) && $isAjax ? false : true; // if loaded on product filter or any other ajax, disable lazy loading
            @endphp

            {!! render_image_markup_by_attachment_id($product->image, '', 'grid', $is_lazy, $isAjax) !!}

            @if(isset($campaignProductEndDate) && $campaignProductEndDate)
                <x-counter :countdown-time="$campaignProductEndDate"/>
            @endif
        </a>
        <ul class="other-content">
            @if(!empty($product->badge))
                <li>
                    <span class="badge-tag">{{ $product->badge }}</span>
                </li>
            @endif
            @if(!empty($campaign_percentage))
                <li>
                    <span class="discount-tag">{{ round($campaign_percentage) }}%</span>
                </li>
            @endif
        </ul>
        <div class="hover-content">
            <ul class="hover-element-list">
                {!! view("product::components.product.product_filter_style_two") !!}

                @if(isset($attributes) && $attributes > 0)
                    <li>
                        <a class="product-quick-view-ajax" href="javascript:void(0)"
                           data-action-route="{{ route('frontend.products.single-quick-view', $product->slug) }}">
                            <i class="lar la-heart icon"></i>
                        </a>
                    </li>
                @else
                    <li>
                        <a href="{{ route('frontend.products.single', $product->slug) }}"
                           class="add_to_wishlist_ajax"
                           data-attributes="{{ $product->attributes }}"
                           data-id="{{ $product->id }}"
                        >
                            <i class="lar la-heart icon"></i>
                        </a>
                    </li>
                @endif
                <li>
                    <a href="#" data-id="{{ $product->id }}" class="add_to_compare_ajax">
                        <i class="las la-random icon"></i>
                    </a>
                </li>
                <li>
                    @if(isset($attributes) && $attributes > 0)
                        <a class="product-quick-view-ajax" href="javascript:void(0)"
                           data-action-route="{{ route('frontend.products.single-quick-view', $product->slug) }}">
                            <i class="las la-expand-arrows-alt icon"></i>
                        </a>
                    @else
                        <a href="#" class="quick-view" {!! getQuickViewDataMarkup($product) !!}>
                            <i class="las la-expand-arrows-alt icon"></i>
                        </a>
                    @endif
                </li>
            </ul>
        </div>
    </div>
    <div class="product-content">
        <div class="main-content">
            <h4 class="product-title">
                <a href="{{ route('frontend.products.single', $product->slug) }}">{{ $product->title }}</a>
            </h4>
            <div class="product-meta-and-pricing">
                <span class="product-meta">{{ $product->unit }} {{ $product->uom }}</span>
                <div class="product-pricing">
                    @if($deleted_price > $sale_price)
                        <del>{{ float_amount_with_currency_symbol($deleted_price) }}</del>
                    @endif

                    <span class="price">{{ float_amount_with_currency_symbol($sale_price) }}</span>
                </div>
            </div>
            @if(isset($isCampaign) && $isCampaign)
                <div class="campaign-progress-wrap">
                    <div class="d-flex justify-content-between">
                        <small class="left"><b>{{ __('Sold') }} {{ $campaignItemInfo['sold_count'] }}</b></small>
                        <small class="right"><b>{{ __('Total') }} {{ $campaignItemInfo['in_stock_count'] }}</b></small>
                    </div>
                    <div class="progress campaign_item_progress">
                        <div class="progress-bar" role="progressbar" style="width: {{ $percentage }}%;"
                             aria-valuenow="{{ $percentage }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            @endif
            <div class="btn-wrapper d-flex justify-content-between align-items-center">
                @if(isset($attributes) && $attributes > 0)
                    <a href="{{ route('frontend.products.single', $product->slug) }}" class="add-cart-style-02">
                        {{ __('View Options') }}
                    </a>
                @else
                    <a href="#" data-attributes="{{ $product->attributes }}" data-id="{{ $product->id }}" class="add-cart-style-02 add_to_cart_ajax">
                        {{ __('Add to Bag') }}
                    </a>
                @endif

                <div class="ratings">
                    <span class="icon-wrap">
                        @if($product->ratingCount())
                            {!! ratingMarkup($product->ratingAvg(), $product->ratingCount(), false) !!}
                        @endif
                    </span>
                    @if($product->ratingCount())
                        <span class="total-feedback">({{ $product->ratingCount() }})</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
