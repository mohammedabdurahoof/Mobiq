<?php

use App\Http\Controllers\Api\CampaignController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CheckoutController;
use App\Http\Controllers\Api\CouponController;
use App\Http\Controllers\Api\FeaturedProductController;
use App\Http\Controllers\Api\MobileSliderController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\SiteSettingsController;
use App\Http\Controllers\Api\SubCategoryController;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Api\V1\CountryController;
use App\Http\Controllers\Api\MobileController;
use Illuminate\Http\Request;
use App\Language;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register',[UserController::class,'register']);
Route::post('/login',[UserController::class,'login']);
Route::post('social/login',[UserController::class,'socialLogin']);

Route::get('/country',[CountryController::class,'country']);
Route::get('/state/{country_id}',[CountryController::class,'stateByCountryId']);
Route::get('/mobile-slider/{type}',[MobileSliderController::class,"index"]);
Route::post('/send-otp-in-mail',[UserController::class,'sendOTP']);
Route::post('/reset-password',[UserController::class,'resetPassword']);
Route::post('change-password',[UserController::class,'changePassword']);

Route::group(['prefix' => 'user/','middleware' => 'auth:sanctum'],function (){
    Route::post('logout',[UserController::class,'logout']);
    Route::get('profile',[UserController::class,'profile']);

    Route::post('change-password',[UserController::class,'changePassword']);
    Route::post('update-profile',[UserController::class,'updateProfile']);
    Route::group(['prefix' => 'support-tickets'],function(){
        Route::post('/',[UserController::class,'allTickets']);
        Route::post('/{id}',[UserController::class,'viewTickets']);
    });

    /* Add shipping method */
    Route::get("/all-shipping-address",[UserController::class,"get_all_shipping_address"]);
    Route::get("/shipping-address/delete/{shipping}",[UserController::class,"delete_shipping_address"]);
    Route::post("/store-shipping-address",[UserController::class,"storeShippingAddress"]);
    Route::get("/get-department",[UserController::class,"get_department"]);
    Route::get("ticket",[UserController::class,"get_all_tickets"]);
    Route::get("ticket/{id}",[UserController::class,"single_ticket"]);
    Route::get("ticket/chat/{ticket_id}",[UserController::class,"fetch_support_chat"]);
    Route::post("ticket/chat/send/{ticket_id}",[UserController::class,"send_support_chat"]);
    Route::post('ticket/message-send',[UserController::class,'sendMessage']);
    Route::post('ticket/create',[UserController::class,'createTicket']);
    Route::post('ticket/priority-change', [UserController::class,'priority_change']);
    Route::post('ticket/status-change', [UserController::class,'status_change']);
    Route::get("/payment-gateway-list",[SiteSettingsController::class,"payment_gateway_list"]);
    Route::get("order-list",[CheckoutController::class,"order_list"]);
    Route::get("order-list/{ProductSellInfo}",[\App\Http\Controllers\Api\OrderController::class,"details"]);

    // Checkout routes
    Route::post("checkout",[CheckoutController::class,"checkout"]);
    Route::post("checkout-paytm",[CheckoutController::class,"checkoutPaytm"]);
    // Update payment status
    Route::post("checkout/payment/update",[CheckoutController::class,"payment_status_update"]);
    Route::post("checkout/payment/failed",[CheckoutController::class,"failed_payment"]);
});

Route::post('/track-order', [UserController::class,"trackOrder"]);

// Product Route
// Fetch feature product
Route::get("featured/product", [FeaturedProductController::class,'index']);
Route::get("campaign/product/{id?}", [FeaturedProductController::class,'campaign']);
Route::get("campaign", [CampaignController::class,'index']);
Route::get("product", [ProductController::class,'search']);
Route::get("product/price-range", [ProductController::class,'priceRange']);
Route::get("product/{id}", [ProductController::class,'productDetail']);
Route::post("product-review", [ProductController::class,'storeReview']);
Route::post('/category/{id}',[ProductController::class,'singleProducts']);
Route::post('/subcategory/{id}',[ProductController::class,'singleProducts']);
Route::get('terms-and-condition-page', [MobileController::class, 'termsAndCondition']);
Route::get('privacy-policy-page', [MobileController::class, 'privacyPolicy']);
Route::get('site_currency_symbol', [MobileController::class, 'site_currency_symbol']);

/* Coupon Route */
Route::post('coupon',[CouponController::class,"index"]);

/* category */
Route::group(['prefix' => 'category'],function(){
    Route::get('/',[CategoryController::class,'allCategory']);
    Route::get('/{id}',[CategoryController::class,'singleCategory']);
});

/* sub category */
Route::group(['prefix' => 'subcategory'],function(){
    Route::get('/',[SubCategoryController::class,'allSubCategory']);
    Route::get('/{id}',[SubCategoryController::class,'singleSubCategory']);
});

Route::get('country-info', [CheckoutController::class,"getCountryInfo"]);
Route::get('state-info',  [CheckoutController::class,"getStateInfo"]);
Route::get('checkout-calculate', [CheckoutController::class,"calculateCheckout"]);

    
Route::get("default-lang", function (){
    return response()->json(["success" => true, "lang_info" => Language::select(["name","direction"])->where("default", 1)->first()]);
});

Route::fallback(function(){
    return response()->json(['message' => 'Page Not Found.'], 404);
});