<?php

namespace App\Http\Controllers\Api;

use App\Campaign\Campaign;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\CampaignResource;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    public function index(){
        // fetch all campaign those are active and those are eligible
        $campaigns = Campaign::where("status","publish")->whereDate("end_date" , '>', Carbon::now())->get();
        return CampaignResource::collection($campaigns);
    }
}
