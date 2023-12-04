<?php

namespace App\Http\Controllers;

use App\Campaign\Campaign;
use App\MobileCampaign;
use Illuminate\Http\Request;

class MobileCampaignController extends Controller
{
    public function __construct(){
        $this->middleware(["auth:admin"]);
    }

    public function index(){
        $campaigns = Campaign::select('title as name','id')->get();
        $selectedCampaign = MobileCampaign::first();
        return view("backend.mobile-campaign.create",compact('campaigns','selectedCampaign'));
    }

    public function update(Request $request){
        $data = $request->validate(["campaign" => 'required']);

        MobileCampaign::updateOrCreate(['id' => 1] ,['type' => '1', 'campaign_id' => $data['campaign']]);

        return back()->with(["type" => 'success' , 'msg' => "Successfully campaign updated"]);
    }
}
