@php
    $attributes = \Modules\Product\Entities\ProductInventoryDetails::where("product_id",$product->id)->count();
@endphp

@if(isset($isCampaign) && $isCampaign)
    @php
        // campaign data check
        $campaign_product = !is_null($product->campaignProduct) ? $product->campaignProduct : getCampaignProductById($product->id);
        $sale_price = $campaign_product ? optional($campaign_product)->campaign_price : $product->sale_price;
        $deleted_price = !is_null($campaign_product) ? $product->sale_price : $product->price;
        $campaign_percentage = !is_null($campaign_product) ? getPercentage($product->sale_price, $sale_price) : false;
    @endphp
@else
    @php
        // campaign data check
        $campaign_product = !is_null($product->campaignProduct) ? $product->campaignProduct : getCampaignProductById($product->id);
        $sale_price = $campaign_product ? optional($campaign_product)->campaign_price : $product->sale_price;
        $deleted_price = !is_null($campaign_product) ? $product->sale_price : $product->price;
        $campaign_percentage = !is_null($campaign_product) ? getPercentage($product->sale_price, $sale_price) : false;
    @endphp
@endif

<!-- Single -->
<div class="single-branding-product wow fadeInLeft" data-wow-delay="0.0s">
    <div class="top-items-img">
        <a href="#"><img src="https://img.freepik.com/free-psd/digital-devices-screen-editable_53876-113669.jpg?w=1060&t=st=1662361996~exp=1662362596~hmac=fb407097f87f034b8fa396b8a51d0c5025bda5313e8ea8d0ffec6fa0d8df1959" alt=""></a>
    </div>
    <div class="cat-caption">
        <h5><a href="#" class="title">concept with laptop</a></h5>
        <div class="product-price d-flex align-items-center mb-1">
            <div class="mr-20 mb-10">
               <strong class="price">$201.00</strong>
                <span class="offer-price">$307.00</span>
            </div>
            <ul class="ratting mb-10">
                <li><i class="las la-star"></i></li>
                <li><i class="las la-star"></i></li>
                <li><i class="las la-star"></i></li>
                <li><i class="las la-star"></i></li>
                <li><i class="las la-star"></i></li>
                <li><p>(15)</p></li>
            </ul>
        </div>
        <ul class="cart-icon mt-15">
            <li><a href="#"> <i class="lar la-heart icon regular"></i> </a></li>
            <li><a href="#"><i class="lar la-eye icon hover"></i></a></li>
            <li><a href="#"> <i class="lar la-plus-square icon regular"></i></a></li>
        </ul>
    </div>
</div>
