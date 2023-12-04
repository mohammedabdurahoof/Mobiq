<?php

namespace App\Http\Controllers\Api;

use App\Campaign\Campaign;
use App\Campaign\CampaignProduct;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\MobileFeatureProductResource;
use App\Http\Services\Api\MobileFeaturedProductService;
use App\MobileCampaign;
use App\Product\Product;
use JetBrains\PhpStorm\ArrayShape;

class FeaturedProductController extends Controller
{
    public function index(){
        $product = MobileFeaturedProductService::get_product();

        return MobileFeatureProductResource::collection($product);
    }

    #[ArrayShape(["products" => "array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable", "campaign_info" => "array"])]
    public function campaign($id = null){
        // fetch all product id from selected campaign
        if(!empty($id)){
            $campaignId = $id;
        }else{
            $mobileCampaign =MobileCampaign::first();
            $campaignId = $mobileCampaign->campaign_id;
        }

        $campaign = Campaign::where("id" , $campaignId)->first();
        $selectedCampaignProductId = CampaignProduct::select("product_id")->where("campaign_id", $campaignId)->get()->pluck("product_id")->toArray();
        // get all product from this campaign
        $products = Product::whereIn('id',$selectedCampaignProductId)->get();

        $products = MobileFeatureProductResource::collection($products)->toArray($products);

        return ["products" => $products ,"campaign_info" => optional($campaign)->toArray()];
    }
}
