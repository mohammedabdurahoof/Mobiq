<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MobileSlider\MobileSliderResource;
use App\MobileSlider;
use Illuminate\Http\Request;

class MobileSliderController extends Controller
{
    public function index($type){
         return MobileSliderResource::collection(MobileSlider::where("type",$type)->paginate(5))->withQueryString();
    }
}
