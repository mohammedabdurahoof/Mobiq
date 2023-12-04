<?php

namespace App\Http\Controllers\Admin;

use App\Campaign\Campaign;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MobileSlider\StoreMobileSliderRequest;
use App\MobileSlider;
use App\Product\Product;
use Modules\Product\Entities\ProductCategory;

class MobileSliderController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth:admin");
    }

    public function index(){
        $mobileSliders = MobileSlider::where("type", 1)->paginate(20);
        // now return only view
        return view("backend.mobile-slider.list",compact("mobileSliders"));
    }

    public function create(){
        $campaigns = Campaign::select("id","title as name")->get();
        $categories = ProductCategory::select("id","title as name")->get();
        
        return view("backend.mobile-slider.create",compact("campaigns", "categories"));
    }

    public function store(StoreMobileSliderRequest $request){
        $data = $request->validated();

        $mobileSlider = MobileSlider::create($data + ["type" => 1]);

        return redirect(route("admin.mobile.slider.all"))->with(["success" => $mobileSlider ?? false,"msg" => "Successfully Created Mobile Slider"]);
    }

    public function destroy(MobileSlider $mobileSlider){
        $bool = $mobileSlider->delete();
        return response()->json(["success" => $bool ?? false]);
    }

    public function edit(MobileSlider $mobileSlider){
        $campaigns = Campaign::select("id","title as name")->get();
        $categories = ProductCategory::select("id","title as name")->get();

        return view("backend.mobile-slider.edit", compact("mobileSlider","campaigns", "categories"));
    }

    public function update(MobileSlider $mobileSlider,StoreMobileSliderRequest $request){
        $data = $request->validated();

        $bool = $mobileSlider->update($data);
        return redirect(route("admin.mobile.slider.all"))->with(["success" => $bool ?? false,"msg" => "Successfully updated mobile slider"]);
    }

    public function two_index(){
        $mobileSliders = MobileSlider::where("type", 2)->paginate(20);
        // now return only view
        return view("backend.mobile-slider-two.list",compact("mobileSliders"));
    }

    public function two_create(){
        $campaigns = Campaign::select("id","title as name")->get();
        $categories = ProductCategory::select("id","title as name")->get();
        
        return view("backend.mobile-slider-two.create",compact("campaigns", "categories"));
    }

    public function two_store(StoreMobileSliderRequest $request){
        $data = $request->validated();

        $mobileSlider = MobileSlider::create($data + ["type" => 2]);

        return redirect(route("admin.mobile.slider.two.all"))->with(["success" => $mobileSlider ?? false,"msg" => "Successfully Created Mobile Slider"]);
    }

    public function two_destroy(MobileSlider $mobileSlider){
        $bool = $mobileSlider->delete();
        return response()->json(["success" => $bool ?? false]);
    }

    public function two_edit(MobileSlider $mobileSlider){
        $campaigns = Campaign::select("id","title as name")->get();
        $categories = ProductCategory::select("id","title as name")->get();

        return view("backend.mobile-slider-two.edit", compact("mobileSlider","campaigns","categories"));
    }

    public function two_update(MobileSlider $mobileSlider,StoreMobileSliderRequest $request){
        $data = $request->validated();

        $bool = $mobileSlider->update($data);
        return redirect(route("admin.mobile.slider.two.all"))->with(["success" => $bool ?? false,"msg" => "Successfully updated mobile slider"]);
    }
}
