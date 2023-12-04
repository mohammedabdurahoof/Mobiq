<?php

namespace Modules\Product\Http\Controllers;

use App\Action\CartAction;
use App\Action\CheckoutAction;
use App\Action\RegistrationAction;
use App\Events\ProductOrdered;
use App\Helpers\CartHelper;
use App\Helpers\FlashMsg;
use App\Helpers\PaymentHelper;
use App\Helpers\ProductRequestHelper;
use App\Http\Controllers\Controller;
use App\Shipping\ShippingMethod;
use App\Shipping\ShippingMethodOption;
use App\Shipping\UserShippingAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\ProductSellInfo;
use Modules\Product\Entities\SaleDetails;
use Unicodeveloper\Paystack\Facades\Paystack;
use Xgenious\Paymentgateway\Facades\XgPaymentGateway;
use function __;
use function abort;
use function auth;
use function event;
use function flutterwaverave_gateway;
use function get_static_option;
use function mollie_gateway;
use function optional;
use function paypal_gateway;
use function paytm_gateway;
use function razorpay_gateway;
use function redirect;
use function response;
use function route;
use function session;
use function stripe_gateway;
use App\Helpers\PaymentGatewayRequestHelper;



class ProductSellPaymentController extends Controller
{
    const SUCCESS_ROUTE = 'frontend.products.payment.success';
    const CANCEL_ROUTE = 'frontend.products.payment.cancel';

    public function checkout(Request $request)
    {
    
        $this->validate($request, [
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
            'ship_to_another_address' => 'nullable|numeric',
            'tax_amount' => 'nullable|string|max:191',
            'coupon' => 'nullable|string|max:191',
            'bank_transfer_input' => 'nullable|file|mimes:jpg,jpeg,png,gif|max:11000',
            'cheque_payment_input' => 'nullable|file|mimes:jpg,jpeg,png,gif|max:11000',
            // payment info
            'selected_payment_gateway' => 'nullable|string|max:191',
            'agree' => 'required',
            // if register
            'username' => 'required_if:create_account_checkbox,==,on',
            'password' => 'required_if:create_account_checkbox,==,on|nullable|min:8|max:191|confirmed',
            'create_account' => 'nullable|string|max:191',
        ], [
            'agree.required' => __('You need to agree to our Terms & Conditions to complete the order'),
            'username.required_if' => __('Username is already taken'),
        ]);

        // if no items in cart
        if (CartHelper::isEmpty()) {
            return back()->with(FlashMsg::explain('danger', __('No Item in the cart')));
        }

        // if account create
        if ($request->create_account) {
            $registration_action = new RegistrationAction();
            $user = $registration_action->register($request);
            $user_id = optional($user)->id;
        }

        // shipping address
        $address = $request->sanitize_html('address');
        if ($request->shipping_address_id) {
            $user_shipping_address = UserShippingAddress::find($request->shipping_address_id);
            $address = $user_shipping_address && strlen($user_shipping_address->address)
                ? $user_shipping_address->address
                : $request->sanitize_html('address');
        }

        $user_id = auth('web')->check() ? auth('web')->id() : null;

        // calculate product and coupon prices
        $default_shipping_cost = CartAction::getDefaultShippingCost();
        $all_cart_items = CartHelper::getItems();
        $products = Product::whereIn('id', array_keys($all_cart_items))->get();
        $creatid=0;
        foreach($products as $v){
            $creatid=$v->created_by;
            break;
        }
        $subtotal = CartAction::getCartTotalAmount($all_cart_items, $products);
        $coupon_amount = CartAction::calculateCoupon($request, $subtotal, $products, 'DISCOUNT');
        $selected_shipping_cost = $default_shipping_cost;
        $shipment_tax_applicable = false;

        $campaign_prd_stock_error = [];

        foreach($all_cart_items as $key => $items){
            foreach($items as $item){
                $campaign_product = getCampaignProductById($key);
                if(!empty($campaign_product)){
                    $remaining_quantity = $item["quantity"];
                    // if item is in campaign, add number of campaign quantity in the cart
                    $campaign = CartAction::getCampaignQuantity($key, $remaining_quantity);
                    if($campaign["campaign_quantity"] < $item["quantity"]){
                        $error_product = $products->find($key);
                        $campaign_prd_stock_error[] = [
                            "msg" => "You should remove this (<b>$error_product->title</b>) because Requested Campaign quantity not available <br> Your requested quantity is ({$item["quantity"]}) Available quantity is <b>({$campaign['campaign_quantity']})</b>"
                        ];
                    }
                }
            }
        }

        // redirect back with specific product error
        if(!empty($campaign_prd_stock_error)){
            return back()->with(["stock_error" => $campaign_prd_stock_error]);
        }

        // if user selected a shipping option
        if (isset($request->selected_shipping_option)) {
            $shipping_is_valid = CartAction::validateSelectedShipping($request->selected_shipping_option, $request->coupon);

            if (!$shipping_is_valid) {
                $shipping_method = ShippingMethod::with('availableOptions')->find($request->selected_shipping_option); // $request->selected_shipping_option;

                if (is_null($shipping_method)) {
                    return back()->with(FlashMsg::explain('danger', __('Please select valid shipping option')))->withInput();
                }

                if (isset(optional($shipping_method)->availableOptions)) {
                    $minimum_order_amount = optional(optional($shipping_method)->availableOptions)->minimum_order_amount ?? 0;
                    $minimum_order_amount = float_amount_with_currency_symbol($minimum_order_amount);
                    $setting_preset = optional(optional($shipping_method)->availableOptions)->setting_preset;
                    $message = ProductRequestHelper::getShippingOptionMessage($minimum_order_amount, $setting_preset);
                    return back()->with(FlashMsg::explain('danger', $message))->withInput();
                }

                return back()->with(FlashMsg::explain('danger', __('Please select valid shipping option')))->withInput();
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
            'total' => (string)round($total, 2),
            'subtotal' => (string)round($subtotal, 2),
            'shipping_cost' => (string)round($selected_shipping_cost, 2),
            'tax_amount' => (string)round($tax_amount, 2),
            'coupon_amount' => (string)round($coupon_amount, 2),
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
            'shipping_address_id' => '', // insert later
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
            'created_by'=>$creatid,
        ];

        try {
            DB::beginTransaction();
            $shipping_address_id = CheckoutAction::insertShippingAddress($request);
            $product_sell_info['shipping_address_id'] = $shipping_address_id;
            $product_sell_info = ProductSellInfo::create($product_sell_info);
            CheckoutAction::insertOrderDetails($all_cart_items, $products, $product_sell_info->id);

            CartAction::storeItemSoldCount($all_cart_items, $products);
            DB::commit();
            return PaymentHelper::chargeCustomer($product_sell_info, $request);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with(['msg' => $e->getMessage(), 'type' => 'danger']);
        }
    }

    public function checkoutContinuePending(Request $request)
    {
        $this->validate($request, [
            'bank_transfer_input' => 'nullable|file|mimes:jpg,jpeg,png,gif|max:11000',
            'cheque_payment_input' => 'nullable|file|mimes:jpg,jpeg,png,gif|max:11000',
        ]);

        $product_sell_info = ProductSellInfo::findOrFail($request->id);
        return PaymentHelper::chargeCustomer($product_sell_info, $request);
    }

    public function cancelPayment(Request $request)
    {
        $product_sell_info = ProductSellInfo::findOrFail($request->id);
        $product_sell_info->update([
            'status' => 'canceled',
            'payment_status' => 'canceled',
        ]);
        return true;
    }

    public function reorder(Request $request)
    {
        $product_sell_info = ProductSellInfo::findOrFail($request->id);
        $new_sell = $product_sell_info->replicate();
        $new_sell->created_at = Carbon::now();
        $new_sell->updated_at = Carbon::now();
        $new_sell->status = 'pending';
        $new_sell->payment_status = 'pending';
        $new_sell->payment_track = Str::random(10) . Str::random(10);
        $new_sell->transaction_id = Str::random(10) . Str::random(10);
        $new_sell->save();
        return redirect()->to(route('user.product.order.details', $new_sell->id));
    }

    private function returnAppropriateRedirect($payment_data)
    {
        if (isset($payment_data['status']) && $payment_data['status'] === 'complete') {
            event(new ProductOrdered([
                'order_id' => $payment_data['order_id'],
                'transaction_id' => $payment_data['transaction_id']
            ]));
            return redirect()->route(self::SUCCESS_ROUTE, Str::random(6) . $payment_data['order_id'] . Str::random(6));
        }
        return redirect()->route(self::CANCEL_ROUTE, Str::random(6));
    }

    /** ===============================================================================
     *                      IPN/WEBHOOK FUNCTIONS
     * =============================================================================== */
    public function paypal_ipn(Request $request)
    {
        $payment_data = PaymentGatewayRequestHelper::paypal()->ipn_response();
        return $this->returnAppropriateRedirect($payment_data);
    }

    public function razorpay_ipn(Request $request)
    {
        // //Fetch payment information by razorpay_payment_id
        $payment_data = PaymentGatewayRequestHelper::razorpay()->ipn_response();
        return $this->returnAppropriateRedirect($payment_data);
    }

    public function paytm_ipn(Request $request)
    {
        
        if($request->code !='PAYMENT_SUCCESS'){
            $payment_data['status']='failed';
            
        }else{
            $payment_data['status']='complete';
        }
        //  $payment_data['status']='complete';
        $payment_data['order_id']=\Session::get('order_id');
        $payment_data['transaction_id']=$request->transactionId;
        return $this->returnAppropriateRedirect($payment_data);
    }

    public function mollie_ipn()
    {
        $payment_data = PaymentGatewayRequestHelper::mollie()->ipn_response();
        return $this->returnAppropriateRedirect($payment_data);
    }

    public function stripe_ipn(Request $request)
    {
        $payment_data = PaymentGatewayRequestHelper::stripe()->ipn_response();

        return $this->returnAppropriateRedirect($payment_data);
    }

    public function flutterwave_ipn(Request $request)
    {
        $payment_data = PaymentGatewayRequestHelper::flutterwave()->ipn_response();
        return $this->returnAppropriateRedirect($payment_data);
    }


    public function paystack_ipn(Request $request)
    {
        $payment_data = PaymentGatewayRequestHelper::paystack()->ipn_response();
        return $this->returnAppropriateRedirect($payment_data);
    }

    public function midtrans_ipn()
    {
        $payment_data = PaymentGatewayRequestHelper::midtrans()->ipn_response();
        return $this->returnAppropriateRedirect($payment_data);
    }

    public function payfast_ipn()
    {
        $payment_data = PaymentGatewayRequestHelper::payfast()->ipn_response();

        return $this->returnAppropriateRedirect($payment_data);
    }

    public function cashfree_ipn(Request $request)
    {
        $payment_data = PaymentGatewayRequestHelper::cashfree()->ipn_response();
        return $this->returnAppropriateRedirect($payment_data);

    }

    public function instamojo_ipn(Request $request)
    {
        $payment_data = PaymentGatewayRequestHelper::instamojo()->ipn_response();
        return $this->returnAppropriateRedirect($payment_data);
    }

    public function marcadopago_ipn(Request $request)
    {
        $payment_data = PaymentGatewayRequestHelper::marcadopago()->ipn_response();
        return $this->returnAppropriateRedirect($payment_data);
    }
}
