<?php

namespace App\Http\Controllers\Api;

use App\Action\CartAction;
use App\Action\CheckoutAction;
use App\Country\State;
use App\Helpers\CartHelper;
use App\Helpers\FlashMsg;
use App\Http\Requests\Api\Checkout\PaymentStatusUpdateRequest;
use App\Product\Product;
use App\Product\ProductSellInfo;
use App\Shipping\ShippingMethod;
use App\Shipping\UserShippingAddress;
use App\Tax\CountryTax;
use App\Tax\StateTax;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Xgenious\Paymentgateway\Facades\XgPaymentGateway;

class CheckoutController
{
    /** =====================================================================
     *                          AJAX FUNCTIONS
     * ===================================================================== */
    public function getCountryInfo(Request $request)
    {
        $request->validate(['id' => 'required']);

        $country_tax = CountryTax::where('country_id', $request->id)->first();

//        if(empty($country_tax)){
//            return response()->json(["msg" => "Your requested country tax percentage not found on the server"])->setStatusCode(404);
//        }

        $shipping_options = getCountryShippingCost('country', $request->id);
        $default_shipping = CartAction::getDefaultShipping();
        $default_shipping_cost = CartAction::getDefaultShippingCost();
        $states = State::select('id', 'name')->where('country_id', $request->id)->get();


        // $all_cart_items = CartHelper::getItems();
        // $products = Product::whereIn('id', array_keys($all_cart_items))->get();
        $subtotal = $request->sub_total ?? 0; // CartAction::getCartTotalAmount($all_cart_items, $products);

        $tax = $country_tax ? $subtotal / 100 * $country_tax->tax_percentage : 0;

        return response()->json([
            'tax' => $tax,
            'tax_percentage' => optional($country_tax)->tax_percentage,
            'states' => $states,
            'shipping_options' => $shipping_options,
            'default_shipping' => $default_shipping,
            'default_shipping_cost' => $default_shipping_cost,
        ], 200)->setStatusCode(201);
    }

    public function getStateInfo(Request $request)
    {
        $request->validate(['id' => 'required|exists:states']);

        $state_tax = StateTax::where('state_id', $request->id)->first();
        $default_shipping = CartAction::getDefaultShipping();
        $default_shipping_cost = CartAction::getDefaultShippingCost();
        $shipping_options = getCountryShippingCost('state', $request->id);

        // $all_cart_items = CartHelper::getItems();
        // $products = Product::whereIn('id', array_keys($all_cart_items))->get();
        $subtotal = $request->sub_total ?? 0; // CartAction::getCartTotalAmount($all_cart_items, $products);

        $tax = $state_tax ? $subtotal / 100 * $state_tax->tax_percentage : 0;

        return response()->json([
            'tax' => $tax,
            'tax_percentage' => optional($state_tax)->tax_percentage,
            'shipping_options' => $shipping_options,
            'default_shipping' => $default_shipping,
            'default_shipping_cost' => $default_shipping_cost,
        ], 200);
    }

    public function calculateCheckout(Request $request)
    {
//        return $request->all();
        $request->validate([
            'selected_shipping_option' => 'required|numeric',
            'country' => 'required|exists:countries,id',
            'state' => 'nullable|exists:states,id',
            'coupon' => 'nullable|string|max:191',
            'sub_total' => 'required',
            'coupon_amount' => 'nullable',
            'products_ids' => 'required',
        ]);

        // subtotal
        $products = Product::whereIn('id', json_decode($request->products_ids))->get();
        $subtotal = $request->sub_total; //CartAction::getCartTotalAmount($all_cart_items, $products);
        $coupon_amount = $request->coupon_amount; //CartAction::calculateCoupon($request, $subtotal, $products, 'DISCOUNT');

//        return $request->selected_shipping_option;

        // if user selected a shipping option
        if (isset($request->selected_shipping_option)) {
            $shipping_is_valid = CartAction::validateSelectedShippingApi($request->selected_shipping_option, $request->coupon, json_decode($request->products_ids), $request->sub_total);

            if (!$shipping_is_valid) {
                $shipping_method = ShippingMethod::with('availableOptions')->find($request->selected_shipping_option); // $request->selected_shipping_option;

//                return response()->json($shipping_method);

                if (is_null($shipping_method)) {
                    return response()->json(FlashMsg::explain('danger', __('Please select valid shipping option')));
                }

                if (isset(optional($shipping_method)->availableOptions)) {
                    $minimum_order_amount = optional(optional($shipping_method)->availableOptions)->minimum_order_amount ?? 0;
                    $minimum_order_amount = float_amount_with_currency_symbol($minimum_order_amount);

                    $message = __('Minimum total order amount has to be') . ' ' . $minimum_order_amount;

                    if (optional(optional($shipping_method)->availableOptions)->setting_preset === 'min_order_or_coupon') {
                        $message .= ' ' . __('or a valid coupon has to be given.');
                    } elseif (optional(optional($shipping_method)->availableOptions)->setting_preset === 'min_order_and_coupon') {
                        $message .= ' ' . __('and a valid coupon has to be given.');
                    }

                    return response()->json(FlashMsg::explain('danger', $message));
                    return response()->json(FlashMsg::explain('danger', $message));
                }

                return response()->json(FlashMsg::explain('danger', __('Please select valid shipping option')));
            }

            $shipping_info = CartAction::getSelectedShippingCost($request->selected_shipping_option, $subtotal, $request->coupon);
            $selected_shipping_cost = $shipping_info['cost'];
            $shipment_tax_applicable = $shipping_info['is_taxable'];

            // check if shipping is taxable
            if ($shipment_tax_applicable) {
                // if shipment is taxable (is_taxable), calculate tax with shipping
                $subtotal_with_shipping = $subtotal + $selected_shipping_cost;
                $tax_amount = CartAction::getCheckoutTaxAmount($subtotal_with_shipping, $request->country, $request->state);
            } else {
                // else, only calculate subtotal
                $tax_amount = CartAction::getCheckoutTaxAmount($subtotal, $request->country, $request->state);
            }

            $total = $subtotal + $selected_shipping_cost + $tax_amount - $coupon_amount;

            return response()->json([
                'subtotal' => (string)round($subtotal, 2),
                'selected_shipping_cost' => (string)round($selected_shipping_cost, 2),
                'tax_amount' => (string)round($tax_amount, 2),
                'coupon_amount' => (string)round($coupon_amount, 2),
                'total' => (string)round($total, 2),
            ]);
        }
    }


    public function checkout(Request $request)
    {
        
        $request->validate([
            // user info
            'name' => 'required|string|max:191',
            'email' => 'required|email',
            'country' => 'required|exists:countries,id',
            'address' => 'nullable|string|max:191',
            'city' => 'required|string|max:191',
            'state' => 'required|exists:states,id',
            'zipcode' => 'required|string',
            'phone' => 'required|string',
            'shipping_address_id' => 'nullable|string|max:191',
            'selected_shipping_option' => 'nullable|string|max:191',
            'tax_amount' => 'nullable|string|max:191',
            'coupon' => 'nullable|string|max:191',
            'bank_transfer_input' => 'nullable|file|mimes:jpg,jpeg,png,gif|max:11000',
            'cheque_payment_input' => 'nullable|file|mimes:jpg,jpeg,png,gif|max:11000',
            // payment info
            'selected_payment_gateway' => 'nullable|string|max:191',
            'agree' => 'required',
            // if register
            'password' => 'sometimes|nullable|min:8|confirmed',
            'create_account' => 'nullable|string|max:191',
        ], ['agree.required' => __('You need to agree to our Terms & Conditions to complete the order')]);

        // shipping address
        $address = $request->sanitize_html('address');
        if ($request->shipping_address_id) {
            $user_shipping_address = UserShippingAddress::find($request->shipping_address_id);

            $address = $user_shipping_address && strlen($user_shipping_address->address)
                ? $user_shipping_address->address
                : $request->sanitize_html('address');
        }

        $user_id = auth('sanctum')->check() ? auth('sanctum')->id() : null;

        // calculate product and coupon prices
        $default_shipping_cost = CartAction::getDefaultShippingCost();

        $all_cart_items = (array)json_decode($request->all_cart_items);

        $products = Product::whereIn('id', json_decode($request->products_ids))->get();

        $subtotal =  $request->sub_total; //CartAction::getCartTotalAmount($all_cart_items, $products);
        $coupon_amount = $request->coupon_amount;// CartAction::calculateApiCoupon($request, $subtotal, $products, 'DISCOUNT'); //CartAction::calculateCoupon($request, $subtotal, $products, 'DISCOUNT');
        $selected_shipping_cost = $default_shipping_cost;
        $shipment_tax_applicable = false;

        // if user selected a shipping option
        if (isset($request->selected_shipping_option)) {
            $shipping_is_valid = CartAction::validateSelectedShippingApi($request->selected_shipping_option, $request->coupon, json_decode($request->products_ids), $request->sub_total);

            if (!$shipping_is_valid) {
                $shipping_method = ShippingMethod::with('availableOptions')->find($request->selected_shipping_option); // $request->selected_shipping_option;

                if (is_null($shipping_method)) {
                    return response()->json(FlashMsg::explain('danger', __('Please select valid shipping option')))->setStatusCode(422);
                }

                if (isset(optional($shipping_method)->availableOptions)) {
                    $minimum_order_amount = optional(optional($shipping_method)->availableOptions)->minimum_order_amount ?? 0;
                    $minimum_order_amount = float_amount_with_currency_symbol($minimum_order_amount);

                    $message = __('Minimum total order amount has to be')
                        . ' ' . $minimum_order_amount;

                    if (optional(optional($shipping_method)->availableOptions)->setting_preset === 'min_order_or_coupon') {
                        $message .= ' ' . __('or a valid coupon has to be given.');
                    } elseif (optional(optional($shipping_method)->availableOptions)->setting_preset === 'min_order_and_coupon') {
                        $message .= ' ' . __('and a valid coupon has to be given.');
                    }

                    return response()->json(FlashMsg::explain('danger', $message))->setStatusCode(422);
                }

                return response()->json(FlashMsg::explain('danger', __('Please select valid shipping option')))->setStatusCode(422);
            }

            $shipping_info = CartAction::getSelectedShippingCost($request->selected_shipping_option, $subtotal, $request->coupon);
            $selected_shipping_cost = $shipping_info['cost'];
            $shipment_tax_applicable = $shipping_info['is_taxable'];
        }

        $checkout_image_path = "";
        // check if shipping is taxable
        if ($shipment_tax_applicable) {
            // if shipment is taxable (is_taxable), calculate tax with shipping
            $subtotal_with_shipping = $subtotal + $selected_shipping_cost;
            $tax_amount = CartAction::getCheckoutTaxAmount($subtotal_with_shipping, $request->country, $request->state);
        } else {
            // else, only calculate subtotal
            $tax_amount = CartAction::getCheckoutTaxAmount($subtotal, $request->country, $request->state);
        }

        $total = $subtotal + $selected_shipping_cost + $tax_amount - $coupon_amount;

        $payment_meta = [
            'total' => (string) round($total, 2),
            'subtotal' => (string) round($subtotal, 2),
            'shipping_cost' => (string) round($selected_shipping_cost, 2),
            'tax_amount' => (string) round($tax_amount, 2),
            'coupon_amount' => (string) round($coupon_amount, 2),
        ];

        $product_sell_info = [
            // user
            'name' => $request->sanitize_html('name'),
            'email' => $request->sanitize_html('email'),
            'user_id' => $user_id,
            // billing address
            'country' => $request->sanitize_html('country'),
            'address' => $address,
            'city' => $request->sanitize_html('city'),
            'state' => $request->sanitize_html('state'),
            'zipcode' => $request->sanitize_html('zipcode'),
            'phone' => $request->sanitize_html('phone'),
            // shipping address
            'shipping_address_id' => $request->sanitize_html('shipping_address_id') ?? '',
            'selected_shipping_option' => $selected_shipping_cost,
            // product
            'coupon' => $request->coupon,
            'coupon_discounted' => $payment_meta['coupon_amount'],
            'total_amount' => $payment_meta['total'],
            'order_details' => json_encode($all_cart_items),
            'payment_meta' => json_encode($payment_meta),
            // payment
            'payment_gateway' => $request->sanitize_html('selected_payment_gateway'),
            'payment_track' => Str::random(10) . Str::random(10),
            'transaction_id' => Str::random(10) . Str::random(10),
            'payment_status' => 'pending',
            'status' => 'pending',
            'checkout_image_path' => $checkout_image_path,
        ];

        $product_sell_info = ProductSellInfo::create($product_sell_info);

        CheckoutAction::insertOrderDetailsApi($all_cart_items, $products, $product_sell_info->id);

        CartAction::storeApiItemSoldCount($all_cart_items, $products);

        return $product_sell_info;
    }

    /**
     * @throws \Exception
     */
    public function checkoutPaytm(Request $request)
    {
        $request->validate([
            // user info
            'name' => 'required|string|max:191',
            'email' => 'required|email',
            'country' => 'required|exists:countries,id',
            'address' => 'nullable|string|max:191',
            'city' => 'required|string|max:191',
            'state' => 'required|exists:states,id',
            'zipcode' => 'required|string',
            'phone' => 'required|string',
            'shipping_address_id' => 'nullable|string|max:191',
            'selected_shipping_option' => 'nullable|string|max:191',
            'tax_amount' => 'nullable|string|max:191',
            'coupon' => 'nullable|string|max:191',
            'bank_transfer_input' => 'nullable|file|mimes:jpg,jpeg,png,gif|max:11000',
            'cheque_payment_input' => 'nullable|file|mimes:jpg,jpeg,png,gif|max:11000',
            // payment info
            'selected_payment_gateway' => 'nullable|string|max:191',
            'agree' => 'required',
            // if register
            'password' => 'sometimes|nullable|min:8|confirmed',
            'create_account' => 'nullable|string|max:191',
        ], ['agree.required' => __('You need to agree to our Terms & Conditions to complete the order')]);

        // shipping address
        $address = $request->sanitize_html('address');
        if ($request->shipping_address_id) {
            $user_shipping_address = UserShippingAddress::find($request->shipping_address_id);

            $address = $user_shipping_address && strlen($user_shipping_address->address)
                ? $user_shipping_address->address
                : $request->sanitize_html('address');
        }

        $user_id = auth('sanctum')->check() ? auth('sanctum')->id() : null;

        // calculate product and coupon prices
        $default_shipping_cost = CartAction::getDefaultShippingCost();

        $all_cart_items = (array)json_decode($request->all_cart_items);

        $products = Product::whereIn('id', json_decode($request->products_ids))->get();

        $subtotal =  $request->sub_total; //CartAction::getCartTotalAmount($all_cart_items, $products);
        $coupon_amount = $request->coupon_amount;// CartAction::calculateApiCoupon($request, $subtotal, $products, 'DISCOUNT'); //CartAction::calculateCoupon($request, $subtotal, $products, 'DISCOUNT');
        $selected_shipping_cost = $default_shipping_cost;
        $shipment_tax_applicable = false;


        // if user selected a shipping option
        if (isset($request->selected_shipping_option)) {
            $shipping_is_valid = CartAction::validateSelectedShippingApi($request->selected_shipping_option, $request->coupon, json_decode($request->products_ids), $request->sub_total);

            if (!$shipping_is_valid) {
                $shipping_method = ShippingMethod::with('availableOptions')->find($request->selected_shipping_option); // $request->selected_shipping_option;

                if (is_null($shipping_method)) {
                    return response()->json(FlashMsg::explain('danger', __('Please select valid shipping option')))->setStatusCode(422);
                }

                if (isset(optional($shipping_method)->availableOptions)) {
                    $minimum_order_amount = optional(optional($shipping_method)->availableOptions)->minimum_order_amount ?? 0;
                    $minimum_order_amount = float_amount_with_currency_symbol($minimum_order_amount);

                    $message = __('Minimum total order amount has to be')
                        . ' ' . $minimum_order_amount;

                    if (optional(optional($shipping_method)->availableOptions)->setting_preset === 'min_order_or_coupon') {
                        $message .= ' ' . __('or a valid coupon has to be given.');
                    } elseif (optional(optional($shipping_method)->availableOptions)->setting_preset === 'min_order_and_coupon') {
                        $message .= ' ' . __('and a valid coupon has to be given.');
                    }

                    return response()->json(FlashMsg::explain('danger', $message))->setStatusCode(422);
                }

                return response()->json(FlashMsg::explain('danger', __('Please select valid shipping option')))->setStatusCode(422);
            }

            $shipping_info = CartAction::getSelectedShippingCost($request->selected_shipping_option, $subtotal, $request->coupon);
            $selected_shipping_cost = $shipping_info['cost'];
            $shipment_tax_applicable = $shipping_info['is_taxable'];
        }

        $checkout_image_path = "";
        // check if shipping is taxable
        if ($shipment_tax_applicable) {
            // if shipment is taxable (is_taxable), calculate tax with shipping
            $subtotal_with_shipping = $subtotal + $selected_shipping_cost;
            $tax_amount = CartAction::getCheckoutTaxAmount($subtotal_with_shipping, $request->country, $request->state);
        } else {
            // else, only calculate subtotal
            $tax_amount = CartAction::getCheckoutTaxAmount($subtotal, $request->country, $request->state);
        }

        $total = $subtotal + $selected_shipping_cost + $tax_amount - $coupon_amount;

        $payment_meta = [
            'total' => (string) round($total, 2),
            'subtotal' => (string) round($subtotal, 2),
            'shipping_cost' => (string) round($selected_shipping_cost, 2),
            'tax_amount' => (string) round($tax_amount, 2),
            'coupon_amount' => (string) round($coupon_amount, 2),
        ];

        $product_sell_info = [
            // user
            'name' => $request->sanitize_html('name'),
            'email' => $request->sanitize_html('email'),
            'user_id' => $user_id,
            // billing address
            'country' => $request->sanitize_html('country'),
            'address' => $address,
            'city' => $request->sanitize_html('city'),
            'state' => $request->sanitize_html('state'),
            'zipcode' => $request->sanitize_html('zipcode'),
            'phone' => $request->sanitize_html('phone'),
            // shipping address
            'shipping_address_id' => $request->sanitize_html('shipping_address_id') ?? '',
            'selected_shipping_option' => $selected_shipping_cost,
            // product
            'coupon' => $request->coupon,
            'coupon_discounted' => $payment_meta['coupon_amount'],
            'total_amount' => $payment_meta['total'],
            'order_details' => json_encode($all_cart_items),
            'payment_meta' => json_encode($payment_meta),
            // payment
            'payment_gateway' => $request->sanitize_html('selected_payment_gateway'),
            'payment_track' => Str::random(10) . Str::random(10),
            'transaction_id' => Str::random(10) . Str::random(10),
            'payment_status' => 'pending',
            'status' => 'pending',
            'checkout_image_path' => $checkout_image_path,
        ];

        $product_sell_info = ProductSellInfo::create($product_sell_info);

        CheckoutAction::insertOrderDetailsApi($all_cart_items, $products, $product_sell_info->id);

        CartAction::storeApiItemSoldCount($all_cart_items, $products);

        $html = XgPaymentGateway::paytm()->charge_customer(
            (new self)->formatPaymentInfo($product_sell_info, route("frontend.products.paytm.ipn"))
        );

        return $html;
    }

    const SUCCESS_ROUTE = 'frontend.products.payment.success';
    const CANCEL_ROUTE = 'frontend.products.payment.cancel';

    private static function formatPaymentInfo($product_payment_info, $ipn) : array
    {
        $description = __('Payment For Order Id: #') . $product_payment_info->id . ' '
            . __('Package Name:') . ' ' . $product_payment_info->package_name . ' '
            . __('Payer Name:') . ' ' . $product_payment_info->name . ' '
            . __('Payer Email:') . ' ' . $product_payment_info->email;

        return [
            'title' => __('Payment for order'),
            'name' => $product_payment_info->name, // user's name
            'email' => $product_payment_info->email, // user's email
            'description' => $description,
            'amount' => $product_payment_info->total_amount,
            'order_id' => $product_payment_info->id,
            'track' => $product_payment_info->payment_track,
            'payment_type' => 'order', // which kind of payment you are receiving
            'ipn_url' => $ipn,
            'success_url' => route(self::SUCCESS_ROUTE, Str::random(6) . $product_payment_info->id . Str::random(6)),
            'cancel_url' => route(self::CANCEL_ROUTE, Str::random(6) . $product_payment_info->id . Str::random(6)),
        ];
    }

    public function payment_status_update(PaymentStatusUpdateRequest $request)
    {
        // make a validation check user , transaction id and order id need to be matched before proceed
        $user_id = auth('sanctum')->check() ? auth('sanctum')->id() : null;

        if (!$user_id) {
            return response()->json(["msg" => "You need to login first"])->setStatusCode(500);
        }

        $sell_info = ProductSellInfo::where("id", $request->order_id)->where("user_id", $user_id)->firstOrFail();

        // check payment status is complete or not
        if ($sell_info->payment_status == "complete") {
            return response()->json(["msg" => "Failed to update This status is updated before."]);
        }elseif ($sell_info->payment_status == "failed"){
            return response()->json(['msg' => "You can't update this status because this order is failed."]);
        }

        $status = "";
        
        if($request->payment_status == 1){
            $status = "complete";
        }else if($request->payment_status == 2){
            $status = "failed";
        }else{
            $status = "pending";
        }

        $update = $sell_info->update(["payment_status" => $status]);

        return $update ? $sell_info ?? [] : [];
    }

    public function failed_payment(PaymentStatusUpdateRequest $request)
    {
        // make a validation check user , transaction id and order id need to be matched before proceed
        $user_id = auth('sanctum')->check() ? auth('sanctum')->id() : null;

        if (!$user_id) {
            return response()->json(["msg" => "You need to login first"])->setStatusCode(500);
        }

        $sell_info = ProductSellInfo::where("id", $request->order_id)->where("user_id", $user_id)->firstOrFail();

        // check payment status is complete or not
        if ($sell_info->payment_status == "complete") {
            return response()->json(["msg" => "Failed to update This status is completed."]);
        }elseif ($sell_info->payment_status == "failed"){
            return response()->json(['msg' => "You can't update this status because this order is failed."]);
        }

        $deleted_sell_info = $sell_info->delete();

        return response()->json(["success" => (bool)$deleted_sell_info,"msg" => $deleted_sell_info ? "Successfully deleted order" : "Failed to delete this order"]);
    }

    public function order_list(){
        // make a validation check user , transaction id and order id need to be matched before proceed
        $user_id = auth('sanctum')->check() ? auth('sanctum')->id() : null;

        if (!$user_id) {
            return response()->json(["msg" => "You need to login first"])->setStatusCode(500);
        }

        return ProductSellInfo::where([
            ["user_id", "=", $user_id]
        ])->paginate(20)->withQueryString();
    }


}