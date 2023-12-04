<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMobileFeaturedProductRequest;
use App\MobileFeaturedProduct;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\ProductCategory;

class MobileFeaturedProductController extends Controller
{
    public function __construct(){
        $this->middleware(["auth:admin"]);
    }

    public function index()
    {
        $mobileFeaturedProducts = MobileFeaturedProduct::all();

        return view("backend.mobile-featured-product.list",compact("mobileFeaturedProducts"));
    }

    public function create(){
        // fetch all categories
        // fetch all product
        $categories = ProductCategory::select("id","title as name")->get();
        $products = Product::select("id","title as name")->get();
        $selectedProduct = MobileFeaturedProduct::first();

        return view("backend.mobile-featured-product.create",compact(["products","categories","selectedProduct"]));
    }

    public function store(StoreMobileFeaturedProductRequest $request){
        $bool = MobileFeaturedProduct::updateOrCreate(["id" => 1],$request->validated());

        return back()->with(['msg' => __('Updated Feature Product...'), 'type' => 'success']);
    }

    public function edit(){
        return "This is edit view";
    }

    public function update(){
        return "This is update view";
    }

    public function destroy(){
        return "This is destroy method";
    }
}
