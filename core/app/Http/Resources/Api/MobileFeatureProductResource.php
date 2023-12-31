<?php

namespace App\Http\Resources\Api;

use App\Http\Services\Api\ProductServices;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MobileFeatureProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        // campaign data check
        $campaign_product = !is_null($this->campaignProduct) ? $this->campaignProduct : getCampaignProductById($this->id);
        $sale_price = $campaign_product ? optional($campaign_product)->campaign_price : $this->sale_price;
        $deleted_price = !is_null($campaign_product) ? $this->sale_price : $this->price;
        $campaign_percentage = !is_null($campaign_product) ? getPercentage($this->sale_price, $sale_price) : false;

        $attributes = $this->attributes ? json_decode($this->attributes, true) : null;
        $add_to_cart = \Modules\Product\Entities\ProductInventoryDetails::where("product_id",$this->id)->count();

        return [
            "prd_id" => $this->id,
            "title" => html_entity_decode(htmlspecialchars_decode($this->title)),
            "img_url" => get_attachment_image_by_id($this->image)["img_url"] ?? null,
            "campaign_percentage" => round($campaign_percentage,2),
            "price" => round($deleted_price,2),
            "discount_price" => round($sale_price,0),
            "attributes" => ProductServices::prepare_attributes($attributes),
            "badge" => $this->badge ?? null,
            "campaign_product" => !empty($campaign_product),
            "stock_count" => (int) optional($this->inventory)->stock_count,
            "avg_ratting" => $this->rating_avg_rating,
            "is_cart_able" => !$add_to_cart
        ];
    }
}
