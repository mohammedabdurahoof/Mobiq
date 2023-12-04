<?php

namespace App\Http\Services\Api;

use App\MobileFeaturedProduct;
use App\Product\Product;
use Illuminate\Database\Eloquent\Collection;
use LaravelIdea\Helper\App\Product\_IH_Product_C;

class MobileFeaturedProductService
{
    public static function get_product(): Collection|array|_IH_Product_C|null
    {
        $selectedProduct = MobileFeaturedProduct::first();
        $product = Product::query();
        $ids = json_decode($selectedProduct->ids);

        if($selectedProduct->type == 'product'){
            return $product->whereIn("id",$ids)->get();
        }elseif ($selectedProduct->type == 'category'){
            return $product->whereIn("category_id",$ids)->get();
        }

        return null;
    }
}