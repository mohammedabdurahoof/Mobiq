<?php

namespace App\Http\Controllers\Campaign;

use App\Campaign\CampaignSoldProduct;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CampaignSoldProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // TODO:
        // Remove from Inventory
        // Add in CampaignSoldProduct
        //      - product_id
        //      - sold_count
        //      - total_amount : $CampaignProduct->campaign_price * sold_count
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Campaign\CampaignSoldProduct  $campaignSoldProduct
     * @return \Illuminate\Http\Response
     */
    public function show(CampaignSoldProduct $campaignSoldProduct)
    {
        // TODO:
        //  @input CampaignProduct->id [or] Product->id  --- [?]
        // Show Detail of a CampaignProduct's sell details
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Campaign\CampaignSoldProduct  $campaignSoldProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CampaignSoldProduct $campaignSoldProduct)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Campaign\CampaignSoldProduct  $campaignSoldProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(CampaignSoldProduct $campaignSoldProduct)
    {
        // TODO: delete a particular sell
    }
}
