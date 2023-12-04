<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Page;
use App\StaticOption;
use Illuminate\Http\Request;

class MobileController extends Controller
{
    public function termsAndCondition(){
        $selected_page = get_static_option("checkout_page_terms_link_url");

        $page = Page::where('slug', $selected_page)->select( "title","content")->first();
        return response()->json($page);
    }

    public function privacyPolicy(){
        $selected_page = get_static_option("mobile_privacy_and_policy");

        $page = Page::where('id', $selected_page)->select( "title","content")->first();
        return response()->json($page);
    }

    public function site_currency_symbol(){
        return response()->json(["symbol" => site_currency_symbol()]);
    }
}
