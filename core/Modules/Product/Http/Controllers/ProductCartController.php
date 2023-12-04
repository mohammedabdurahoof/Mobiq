<?php

namespace Modules\Product\Http\Controllers;

use App\Action\CartAction;
use App\Campaign\CampaignSoldProduct;
use App\Helpers\CartHelper;
use App\Helpers\FlashMsg;
use App\Helpers\ProductRequestHelper;
use App\Http\Controllers\Controller;
use App\Shipping\ShippingMethod;
use App\Shipping\ShippingMethodOption;
use Illuminate\Http\Request;
use Modules\Product\Entities\InventoryDetailsAttribute;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\ProductInventoryDetails;
use Modules\Product\Entities\ProductColor;
use function __;
use function getUserByGuard;
use function optional;
use function response;
use function view;

class ProductCartController extends Controller
{
    /**
     * Top-bar mini-cart info
     * @return array
     */
    public function getCartInfoAjax() : array
    {
        $all_cart_items = CartHelper::getItems();
        $cart_item_ids = array_keys($all_cart_items);
        $product_stock_attributes = InventoryDetailsAttribute::where('product_id', $cart_item_ids)->get();
        $products = Product::whereIn('id', $cart_item_ids)->get();
        $subtotal = CartAction::getCartTotalAmount($all_cart_items, $products);

        return [
            'item_total' => CartHelper::getTotalQuantity(),
            'cart' => view('frontend.partials.mini-cart', compact(
                'all_cart_items',
                'products',
                'subtotal',
                'product_stock_attributes'
            ))->render()
        ];
    }

    public function addToCartAjax(Request $request) : \Illuminate\Http\JsonResponse
    {
        $this->validate($request, [
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|numeric|min:1',
            'pid_id' => 'nullable|numeric',
            'product_variant' => 'nullable|exists:product_inventory_details,id',
            'selected_size' => 'nullable|exists:product_sizes,id',
            'selected_color' => 'nullable|exists:product_colors,id',
        ]);

        // todo selected_size
        // todo selected_color

        $product = Product::find($request->product_id);

        $formatted_product_attributes = ProductRequestHelper::getRequestedProductAttributes($product, $request->pid_id);
        $attributes = $formatted_product_attributes['attributes'];
        $product_price = $formatted_product_attributes['price'];
        $additional_price = $formatted_product_attributes['additional_price'];
        
        $product_variant = ProductInventoryDetails::find($request->product_variant ?? 0);
        
        if (!is_null($product_variant)) {
            $attributes['_color'] = optional($product_variant->productColor)->name;
            $attributes['_size'] = optional($product_variant->productSize)->name;

            
        }
        // dd($attributes);
        if($request->selected_color !=null){
            $colors=ProductColor::where('id',$request->selected_color)->first();
        $attributes['_color']=$colors->name;
        $check['_color']=$colors->name;
        }
        
        
        $remaining_quantity = $request->quantity;

        // if item is in campaign, add number of campaign quantity in the cart
        $campaign = CartAction::getCampaignQuantity($request->product_id, $remaining_quantity);
        
        if(array_key_exists($request->product_id,CartHelper::getItems()) && CartHelper::isItemExists($request->product_id,$attributes)==true){
            $old_cart_item = CartHelper::getItems($request->product_id)[$request->product_id][0];
            $old_quantity = $old_cart_item["quantity"];
            
        }else{
            $old_quantity = 0;
        }
        
        $campaign_product = getCampaignProductById($request->product_id);
        $sold_campaign_product = CampaignSoldProduct::select("sold_count")->where("product_id",optional($campaign_product)->product_id)->first();

        if(!empty($campaign_product)) {
            // check campaign product date validity
            $campaign_end_date = optional($campaign_product)->end_date;

            if ((strtotime($campaign_end_date) >= time()) == false) {
                $response_data = FlashMsg::explain('danger', __('Item can not be added to cart.'));
                $response_data['quantity_msg'] = __('The products of this campaign have expired');
                return response()->json($response_data);
            }

            // check availability of campaign product
            $available_campaign_quantity = $campaign_product->units_for_sale - optional($sold_campaign_product)->sold_count ?? 0;
            if ($available_campaign_quantity == 0) {
                $response_data = FlashMsg::explain('danger', __('Item can not be added to cart.'));
                $response_data['quantity_msg'] = __('The quantity of this campaign has been exceeded');
                return response()->json($response_data);
            }

            // check campaign product availability quantity and cart quantity with requested quantity
            if ($available_campaign_quantity < ($request->quantity + $old_quantity)) {
                $response_data = FlashMsg::explain('danger', __('Item can not be added to cart.'));
                $response_data['quantity_msg'] = __('Your requested quantity is not available.<br/> Only available quantity is (' . $available_campaign_quantity . ')');
                return response()->json($response_data);
            }
        }
        
        if ($campaign['campaign_quantity'] > 0) {
            $attributes['type'] = 'Campaign Product';
            $attributes['price'] = $campaign['campaign_price'] + $additional_price;

            CartHelper::add(
                $request->product_id,
                $request->quantity,
                $attributes
            );

            $remaining_quantity = $campaign['remaining_quantity'];

            $response_data = FlashMsg::explain('success', __('Item added to cart'));
            $response_data['cart_info'] = CartAction::getCartInfo();

            return response()->json($response_data, 200);
        }

        $remaining_quantity = $remaining_quantity + CartAction::getCartItemQuantity([$request->product_id]);
        $available_quantity = (int) CartAction::getAvailableQuantity($request->product_id);

        if($available_quantity >= $remaining_quantity) {
            // if remaining or non-campaign quantity
            if ($remaining_quantity) {
                // adjust attribute to normal product
                unset($attributes['type']);
                $attributes['price'] = $product->sale_price + $additional_price;

                if ($available_quantity > 0) {
                    CartHelper::add(
                        $request->product_id,
                        $request->quantity,
                        $attributes
                    );
                }
            }

            $response_data = FlashMsg::explain('success', __('Item added to cart'));
            $response_data['cart_info'] = CartAction::getCartInfo();

            return response()->json($response_data, 200);
        }

        $response_data = FlashMsg::explain('danger', __('Item quantity not available'));
        $response_data['cart_info'] = CartAction::getCartInfo();
        $response_data['quantity_msg'] = __('Requested quantity is not available. Only available quantity is added to cart');

        return response()->json($response_data, 200);
    }

    public function cartStatus() : \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'total_price' => CartHelper::getAttributeTotal('price'),
            'all_items' => CartHelper::getItems(),
        ], 200);
    }

    public function updateCart(Request $request)
    {
        $this->validate($request, [
            'cart_data' => 'required|array',
            'cart_data.*.id' => 'required|exists:products,id',
            'cart_data.*.product_attribute' => 'nullable|array',
            'cart_data.*.quantity' => 'required|numeric',
        ]);

        $quantity_msg = [];

        foreach ($request->cart_data as $cart_item) {
            $product_attribute = isset($cart_item['product_attribute']) ? $this->formatAttributes($cart_item['product_attribute']) : [];
            $available_quantity = (int) CartAction::getAvailableQuantity($cart_item['id'], $cart_item['quantity']);

            $requested_quantity = $cart_item['quantity'];

            // if item is campaign product
            if (isset($product_attribute['type']) && $product_attribute['type'] == 'Campaign Product') {
                /**
                 * @note Requested campaign quantity that goes over the campaign quantity will be ignored
                 */
                $campaign = CartAction::getCampaignQuantity($cart_item['id'], $requested_quantity);

                if ($campaign['campaign_quantity'] > 0) {
                    CartHelper::update(
                        $cart_item['id'],
                        $campaign['campaign_quantity'],
                        $product_attribute
                    );
                }

                $requested_quantity = $campaign['remaining_quantity'];
            } else {
                // handle non-campaign quantity
                $update_available_quantity = $available_quantity - $requested_quantity;

                if ($update_available_quantity > 0) {
                    CartHelper::update(
                        $cart_item['id'],
                        $requested_quantity,
                        $product_attribute
                    );
                }
            }

            $update_available_quantity = $available_quantity - $requested_quantity;

            // if item quantity is not available in stock show message
            if ($update_available_quantity <= 0) {
                $product = Product::find($cart_item['id']);
                $single_product_msg = $product->title ? __("of") . " <b>$product->title</b>" : "";
                $quantity_msg[] = __("Requested quantity $single_product_msg is not available. Only available quantity is added to cart");
            }
        }

        // response view
        $default_shipping_cost = CartAction::getDefaultShippingCost();

        $all_cart_items = CartHelper::getItems();
        $products = Product::whereIn('id', array_keys($all_cart_items))->get();

        $subtotal = CartAction::getCartTotalAmount($all_cart_items, $products);
        $subtotal_with_tax = $subtotal + $default_shipping_cost;
        $total = CartAction::calculateCoupon($request, $subtotal_with_tax, $products);

        $cart_item_ids = array_keys($all_cart_items);
        $product_stock_attributes = InventoryDetailsAttribute::where('product_id', $cart_item_ids)->get();

        return view('frontend.cart.cart-partial', compact(
            'all_cart_items',
            'products',
            'subtotal',
            'default_shipping_cost',
            'total',
            'quantity_msg',
            'product_stock_attributes'
        ));
    }

    public function removeCartItem(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|string',
            'product_attributes' => 'nullable',
        ]);

        $product_attributes = isset($request->product_attributes) && is_array($request->product_attributes) ? $request->product_attributes : [];
        $attribute = $this->formatAttributes($product_attributes);

        CartHelper::remove($request->id, $attribute);

        // response view
        $default_shipping_cost = CartAction::getDefaultShippingCost();
        $all_cart_items = CartHelper::getItems();

        if (empty($all_cart_items) || empty($all_cart_items[0])) {
            return 0;
        }

        $products = Product::whereIn('id', array_keys($all_cart_items))->get();
        $subtotal = CartAction::getCartTotalAmount($all_cart_items, $products);
        $subtotal_with_tax = $subtotal + $default_shipping_cost;
        $total = CartAction::calculateCoupon($request, $subtotal_with_tax, $products);

        return view('frontend.cart.cart-partial', compact('all_cart_items', 'products', 'subtotal', 'default_shipping_cost', 'total'));
    }

    public function clearCart() : \Illuminate\Http\JsonResponse
    {
        CartHelper::clear();
        return response()->json(FlashMsg::explain('success', __('Cart cleared')), 200);
    }

    public function cartPageApplyCouponAjax(Request $request) : \Illuminate\Http\JsonResponse
    {
        $default_shipping_cost = CartAction::getDefaultShippingCost();

        $all_cart_items = CartHelper::getItems();
        $products = Product::whereIn('id', array_keys($all_cart_items))->get();

        $subtotal = CartAction::getCartTotalAmount($all_cart_items, $products);
        $total = $subtotal - CartAction::calculateCoupon($request, $subtotal, $products, 'DISCOUNT');

        $is_changed = $subtotal > $total;
        $status = $is_changed ? 'success' : 'fail';
        $msg = $is_changed
            ? __('Coupon applied')
            : __('Coupon invalid');

        return response()->json([
            'type' => $status,
            'msg' => $msg,
            'details' => view('frontend.cart.cart-partial', [
                'all_cart_items' => $all_cart_items,
                'products' => $products,
                'subtotal' => $subtotal,
                'total' => $total,
            ])->render()
        ]);
    }

    /** ==============================================================================
     *                  Checkout Page
     * ============================================================================== */
    public function checkoutPageApplyCouponAjax(Request $request)
    {
        $all_cart_items = CartHelper::getItems();
        $products = Product::whereIn('id', array_keys($all_cart_items))->get();
        $subtotal = CartAction::getCartTotalAmount($all_cart_items, $products);

        $coupon_amount = CartAction::calculateCoupon($request, $subtotal, $products, 'DISCOUNT');

        // if coupon is valid ProductCoupon,
        // or is shipping coupon
        if ($coupon_amount) {
            return response()->json([
                'type' => 'success',
                'coupon_amount' => round($coupon_amount, 2)
            ]);
        } else {
            $shipping_option = ShippingMethodOption::where('coupon', $request->coupon)->first();

            if (!is_null($shipping_option)) {
                return response()->json([
                    'type' => 'failed',
                    'coupon_amount' => 0
                ]);
            }
        }

        return response()->json(['type' => 'danger', 'coupon_amount' => 0]);
    }

    public function calculateCheckout(Request $request)
    {
        $request->validate([
            'selected_shipping_option' => 'required|numeric',
            'country' => 'required|exists:countries,id',
            'state' => 'nullable|exists:states,id',
            'coupon' => 'nullable|string|max:191',
        ]);

        // subtotal
        $all_cart_items = CartHelper::getItems();
        $products = Product::whereIn('id', array_keys($all_cart_items))->get();
        $subtotal = CartAction::getCartTotalAmount($all_cart_items, $products);
        $coupon_amount = CartAction::calculateCoupon($request, $subtotal, $products, 'DISCOUNT');

        // if user selected a shipping option
        if (isset($request->selected_shipping_option)) {
            $shipping_is_valid = CartAction::validateSelectedShipping($request->selected_shipping_option, $request->coupon);


            if (!$shipping_is_valid) {
                $shipping_method = ShippingMethod::with('availableOptions')->find($request->selected_shipping_option); // $request->selected_shipping_option;

                if (is_null($shipping_method)) {
                    return response()->json(FlashMsg::explain('danger', __('Please select valid shipping option')));
                }

                if (isset(optional($shipping_method)->availableOptions)) {
                    $minimum_order_amount = optional(optional($shipping_method)->availableOptions)->minimum_order_amount ?? 0;
                    $minimum_order_amount = float_amount_with_currency_symbol($minimum_order_amount);
                    $setting_preset = optional(optional($shipping_method)->availableOptions)->setting_preset;
                    $message = ProductRequestHelper::getShippingOptionMessage($setting_preset, $minimum_order_amount);
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
                'subtotal' => (string) round($subtotal, 2),
                'selected_shipping_cost' => (string) round($selected_shipping_cost, 2),
                'tax_amount' => (string) round($tax_amount, 2),
                'coupon_amount' => (string) round($coupon_amount, 2),
                'total' => (string) round($total, 2),
            ]);
        }
    }

    /** ==============================================================================
     *                  HELPER FUNCTIONS
     * ============================================================================== */
    public function formatAttributes($product_attributes)
    {
        $attribute = $product_attributes;
        if (isset($attribute['price'])) {
            $attribute['price'] = floatval($attribute['price']);
        }
        return $attribute;
    }
}
