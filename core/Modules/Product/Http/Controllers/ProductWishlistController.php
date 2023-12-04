<?php

namespace Modules\Product\Http\Controllers;

use App\Action\CartAction;
use App\Helpers\CartHelper;
use App\Helpers\FlashMsg;
use App\Helpers\ProductRequestHelper;
use App\Helpers\WishlistHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Product\Entities\Product;
use function __;
use function auth;
use function back;
use function response;

class ProductWishlistController extends Controller
{
    public function getWishlistInfoAjax() : array
    {
        $all_wishlist_items = WishlistHelper::getItems();
        $products = Product::whereIn('id', array_keys($all_wishlist_items))->get();

        return [
            'item_total' => WishlistHelper::getTotalItem(),
            'wishlist' => view('frontend.partials.mini-wishlist', compact('all_wishlist_items', 'products'))->render()
        ];
    }

    public function getTotalItem()
    {
        return response()->json([
            'total' => WishlistHelper::getTotalItem()
        ], 200);
    }

    public function addToWishlist(Request $request)
    {
        $this->validate($request, [
            'product_id' => 'required|exists:products,id',
            'product_attributes' => 'nullable|array',
        ]);

        $attributes = (array) $request->product_attributes;
        $attributes['user_id'] = auth('web')->check() ? auth('web')->id() : null;

        WishlistHelper::add($request->product_id, 1, $attributes);

        return back()->with(FlashMsg::explain('success', __('Item added to wishlist')));
    }

    public function addToWishlistAjax(Request $request)
    {
        $this->validate($request, [
            'product_id' => 'required|exists:products,id',
            'pid_id' => 'nullable|numeric',
        ]);

        $product = Product::find($request->product_id);

        $formatted_product_attributes = ProductRequestHelper::getRequestedProductAttributes($product, $request->pid_id);
        $attributes = $formatted_product_attributes['attributes'];
        $product_price = $formatted_product_attributes['price'];
        $additional_price = $formatted_product_attributes['additional_price'];

        $remaining_quantity = $request->quantity;

        // if item is in campaign, add number of campaign quantity in the cart
        $campaign = CartAction::getCampaignQuantity($request->product_id, $remaining_quantity);

        if ($campaign['campaign_quantity'] > 0) {
            $attributes['type'] = 'Campaign Product';
            $attributes['price'] = $campaign['campaign_price'] + $additional_price;

            WishlistHelper::add(
                $request->product_id,
                $campaign['campaign_quantity'],
                $attributes
            );

            $remaining_quantity = $campaign['remaining_quantity'];
        }

        $available_quantity = (int) CartAction::getAvailableQuantity($request->product_id, $remaining_quantity);

        // if remaining or non-campaign quantity
        if ($remaining_quantity) {
            // adjust attribute to normal product
            unset($attributes['type']);
            $attributes['price'] = $product_price + $additional_price;

            if ($available_quantity > 0) {
                WishlistHelper::add(
                    $request->product_id,
                    $available_quantity,
                    $attributes
                );
            }
        }

        $response_data = FlashMsg::explain('success', __('Item added to wishlist'));
        $response_data['cart_info'] = CartAction::getCartInfo();

        if ($available_quantity != $remaining_quantity) {
            $response_data['quantity_msg'] = __('Requested quantity is not available. Only available quantity is added to wishlist');
        }

        return response()->json($response_data, 200);
    }

    public function removeWishlistItem(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|string',
            'product_attributes' => 'nullable',
        ]);

        $attributes = is_array($request->product_attributes) ? $this->formatProductAttribute($request->product_attributes) : [];
        WishlistHelper::remove($request->id, $attributes);

        return response()->json(FlashMsg::explain('success', __('Item removed from wishlist')), 200);
    }

    public function clearWishlist(Request $request)
    {
        WishlistHelper::clear();
        return response()->json(FlashMsg::explain('success', __('Wishlist cleared')), 200);
    }

    public function sendToCartAjax(Request $request)
    {
        $wishlist_items = WishlistHelper::getItems();

        foreach ($wishlist_items as $wishlist_item) {
            foreach ($wishlist_item as $item) {
                CartHelper::add($item['id'], $item['quantity'], $item['attributes']);
            }
        }

        WishlistHelper::clear();

        return back()->with(FlashMsg::explain('success', __('All items are sent to cart')));
    }

    public function sendSingleItemToCartAjax(Request $request) :  \Illuminate\Http\JsonResponse
    {
        $this->validate($request, [
            'id' => 'required|string',
            'quantity' => 'required|numeric',
            'product_attributes' => 'nullable',
        ]);

        $attributes = $this->formatProductAttribute($request->product_attributes);
        WishlistHelper::remove($request->id, $attributes);
        CartHelper::add($request->id, $request->quantity, $request->product_attributes);

        return response()->json(FlashMsg::explain('success', __('Item sent to cart')), 200);
    }

    private function formatProductAttribute(array $attributes) : array
    {
        if (isset($attributes['price'])) {
            $attributes['price'] = floatval($attributes['price']);
        }
        return $attributes;
    }
}
