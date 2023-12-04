<?php

namespace App\Http\Controllers\Api\V1;

use App\Country\Country;
use App\Country\State;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CountryController extends Controller
{

    /*
    * fetch all country list from database
    */
    public function country()
    {
        $country = Country::select('id', 'name')->orderBy('name', 'asc')->get();

        return response()->json([
            'countries' => $country
        ]);

    }

    /*
    * fetch all state list based on provided country id from database
    */
    public function stateByCountryId($id)
    {
        if(empty($id)){
            return response()->json([
                'message' => __('provide a valid country id')
            ])->setStatusCode(422);
        }

        $state = State::select('id', 'name','country_id')->where('country_id',$id)->orderBy('name', 'asc')->get();

        return response()->json([
            'state' => $state
        ]);

    }
}
