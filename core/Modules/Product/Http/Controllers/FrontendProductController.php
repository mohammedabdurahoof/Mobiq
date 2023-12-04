<?php

namespace Modules\Product\Http\Controllers;

use App\Action\CartAction;
use App\Action\CompareAction;
use App\Campaign\Campaign;
use App\Campaign\CampaignProduct;
use App\Helpers\CartHelper;
use App\Helpers\CompareHelper;
use App\Helpers\FlashMsg;
use App\Helpers\WishlistHelper;
use App\Mail\TrackOrder;
use App\Page;
use App\StaticOption;
use Modules\Product\Entities\InventoryDetailsAttribute;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\ProductAttribute;
use Modules\Product\Entities\ProductCategory;
use Modules\Product\Entities\ProductColor;
use Modules\Product\Entities\ProductRating;
use Modules\Product\Entities\ProductSellInfo;
use Modules\Product\Entities\ProductSize;
use Modules\Product\Entities\ProductSubCategory;
use Modules\Product\Entities\ProductTag;
use Modules\Product\Entities\ProductUnit;
use Modules\Product\Entities\SaleDetails;
use Modules\Product\Entities\Tag;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use function GuzzleHttp\Promise\all;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
 
class FrontendProductController extends Controller
{
    public function download_invoice($id){
        $order_details = ProductSellInfo::with("sale_details")->findOrFail($id);

        $db_order_details = json_decode($order_details->order_details, true);
        $db_order_details = is_string($db_order_details) ? json_decode($db_order_details, true) : $db_order_details;
        $products = Product::whereIn('id', array_keys($db_order_details))->get();
        $user_shipping_address = getUserShippingAddress($order_details->shipping_address_id);
        $customPaper = array(0,0,1280,720);
        // todo

//        return view('frontend.partials.product.pdf', compact('order_details', 'products', 'user_shipping_address'));

        $pdf = PDF::loadView('frontend.partials.product.pdf', compact('order_details', 'products', 'user_shipping_address'))->setPaper($customPaper,'landscape');
        return $pdf->download('product-order-invoice.pdf');
    }

    public function productDetailsPage($slug)
    {
        $product = Product::where('slug', $slug)
                    ->with(
                        'additionalInfo',
                        'category',
                        'tags',
                        'inventoryDetails',
                        'inventoryDetails.productColor',
                        'inventoryDetails.productSize',
                        'inventoryDetails.includedAttributes'
                    )
                    ->where("status","publish")
                    ->firstOrFail();

        // get selected attributes in this product ( $available_attributes )
        $inventoryDetails = optional($product->inventoryDetails);
        $product_inventory_attributes = $inventoryDetails->toArray();

        /* *
         * ========================================================
         * Example of $product_inventory_attributes
         *
         * array:2 [▼
         *     0 => array:15 [▼
         *       'id" => 9
         *       "inventory_id" => 54
         *       "product_id" => 48
         *       "color" => "2"
         *       "size" => "1"
         *       "hash" => null
         *       "additional_price" => 971.0
         *       "image" => "382"
         *       "stock_count" => 92
         *       "sold_count" => 0
         *       "product_color" => array:6 [▼
         *             "id" => 2
         *             "name" => "Dark Green"
         *             "color_code" => "#08781a"
         *             "slug" => "dark-green"
         *             "created_at" => "2022-03-03T11:05:51.000000Z"
         *             "updated_at" => "2022-03-03T11:06:15.000000Z"
         *         ]
         *         "product_size" => array:6 [▼
         *             "id" => 1
         *             "name" => "Exatra Small"
         *             "size_code" => "xs"
         *             "slug" => "extra-small"
         *         ]
         *         "included_attributes" => array:3 [▼
         *             0 => array:7 [▼
         *                   "id" => 16
         *                   "product_id" => 48
         *                   "inventory_details_id" => 9
         *                   "attribute_name" => "Cheese"
         *                   "attribute_value" => "chereme"
         *             ]
         *         ]
         *      ]
         *   ]
         * ========================================================
         * */

        $all_included_attributes = array_filter(array_column($product_inventory_attributes, 'included_attributes', 'id'));
        $all_included_attributes_prd_id = array_keys($all_included_attributes);

        /* *
         * ========================================================
         * Example of $all_included_attributes
         *
         * array:2 [▼
         *     9 => array:3 [▼
         *       0 => array:7 [▼
         *         "id" => 16
         *         "product_id" => 48
         *         "inventory_details_id" => 9
         *         "attribute_name" => "Cheese"
         *         "attribute_value" => "cream"
         *         "created_at" => "2022-03-15T07:44:52.000000Z"
         *         "updated_at" => "2022-03-15T07:44:52.000000Z"
         *       ]
         *     ]
         *   ]
         * ========================================================
         * */

        $available_attributes = [];  // FRONTEND : All displaying attributes
        $product_inventory_set = []; // FRONTEND : attribute_store
        $additional_info_store = []; // FRONTEND : $additional_info_store

        foreach ($all_included_attributes as $id => $included_attributes) {
            $single_inventory_item = [];
            foreach ($included_attributes as $included_attribute_single) {
                /**
                 * Example: (Only data representation, not in code)
                 *      selected_attributes = [
                 *          'Cheese' => ['Mozzarella', 'Cheddar', 'Parmesan'],
                 *          'Sauce' => ['Hot', 'Taco', 'Fish', 'Soy', 'Tartar']
                 *      ];
                 */
                $available_attributes[$included_attribute_single['attribute_name']][$included_attribute_single['attribute_value']] = 1;

                // individual inventory item
                $single_inventory_item[$included_attribute_single['attribute_name']] = $included_attribute_single['attribute_value'];
                /* *
                 * ========================================================
                 * Example of $available_attributes
                 *
                 * array:3 [▼
                 *     "Cheese" => "cream"
                 *     "Color" => "Green"
                 *     "Size" => "M"
                 *   ]
                 * ========================================================
                 * */

                if (optional($inventoryDetails->find($id))->productColor) {
                    $single_inventory_item['Color'] = optional(optional($inventoryDetails->find($id))->productColor)->name;
                }

                if (optional($inventoryDetails->find($id))->productSize) {
                    $single_inventory_item['Size'] = optional(optional($inventoryDetails->find($id))->productSize)->name;
                }
            }

            $item_additional_price = optional(optional($product->inventoryDetails)->find($id))->additional_price ?? 0;
            $image = get_attachment_image_by_id(optional(optional($product->inventoryDetails)->find($id))->image)['img_url'] ?? '';

            $product_inventory_set[] = $single_inventory_item;

            $sorted_inventory_item = $single_inventory_item;
            ksort($sorted_inventory_item);

            $additional_info_store[md5(json_encode($sorted_inventory_item))] = [
                'pid_id' => $id, // ProductInventoryDetails->id
                'additional_price' => $item_additional_price,
                'image' => $image,
            ];
        }

        $productColors = $product->inventoryDetails->pluck('productColor')->unique();
        $productSizes = $product->inventoryDetails->pluck('productSize')->unique();

        if((empty($available_attributes) && !empty($product_inventory_attributes)) || count($all_included_attributes) < $product->inventoryDetails->count()){
            $sorted_inventory_item = [];
            $product_id = $product_inventory_attributes[0]['id'];
            // check inventory color and size exists or not

            if(!empty($product->inventoryDetails)){
                foreach($product->inventoryDetails as $inventory){
                    // if this inventory has attributes then it will fire continue statement
                    if(in_array($inventory->product_id,$all_included_attributes_prd_id)){
                        continue ;
                    }

                    $single_inventory_item = [];

                    if (optional($inventoryDetails->find($product_id))->productColor) {
                        $single_inventory_item['Color'] = optional($inventory->productColor)->name;
                    }

                    if (optional($inventoryDetails->find($product_id))->productSize) {
                        $single_inventory_item['Size'] = optional($inventory->productSize)->name;
                    }


                    $product_inventory_set[] = $single_inventory_item;

                    $item_additional_price = optional(optional($product->inventoryDetails)->find($product_id))->additional_price ?? 0;
                    $image = get_attachment_image_by_id(optional(optional($product->inventoryDetails)->find($product_id))->image)['img_url'] ?? '';

                    $sorted_inventory_item = $single_inventory_item;
                    ksort($sorted_inventory_item);

                    $additional_info_store[md5(json_encode($single_inventory_item))] = [
                        'pid_id' => $product_id,
                        'additional_price' => $item_additional_price,
                        'image' => $image,
                    ];
                }
            }
        }

        $available_attributes = array_map(fn ($i) => array_keys($i), $available_attributes);
        /* *
         * ========================================================
         * Example of $available_attributes
         * [
         *      "Cheese" => ["cream"],
         *      "Color" => ["Green"],
         *      "Size" => ["M", "L"]
         * ]
         * ========================================================
         * */


        $sub_category_arr = json_decode($product->sub_category_id, true);
        $ratings = ProductRating::where('product_id', $product->id)->with('user')->get();
        $avg_rating = $ratings->count() ? round($ratings->sum('rating') / $ratings->count()) : null;

        // related products
        $related_products = Product::whereJsonContains('sub_category_id', $sub_category_arr)
            ->with('campaign', 'rating')
            ->where('id', '!=', $product->id)
            ->get();

        if (!$related_products->count()) {
            $related_products = Product::where('category_id', $product->category_id)
                ->with('campaign', 'rating')
                ->where("status","publish")
                ->where('id', '!=', $product->id)
                ->get();
        }

        // (bool) Check logged-in user bought this item (needed for review)
        $user = getUserByGuard('web');

        $user_has_item = $user
            ? !!SaleDetails::join("product_sell_infos","product_sell_infos.id","=","sale_details.order_id")
                ->where('product_sell_infos.user_id', $user->id)
                ->where('sale_details.item_id', $product->id)->count()
            : null;

        $user_rated_already = !!! ProductRating::where('product_id', optional($product)->id)->where('user_id', optional($user)->id)->count();

        $setting_text = StaticOption::whereIn('option_name', [
            'product_in_stock_text',
            'product_out_of_stock_text',
            'details_tab_text',
            'additional_information_text',
            'reviews_text',
            'your_reviews_text',
            'write_your_feedback_text',
            'post_your_feedback_text',
        ])->get()->mapWithKeys(fn ($item) => [$item->option_name => $item->option_value])->toArray();

        // sidebar data
        $all_category = ProductCategory::where('status', 'publish')->with("subcategory")->get();
        $all_units = ProductUnit::all();
        $maximum_available_price = Product::query()->with('category')->max('price');
        $min_price = request()->pr_min ? request()->pr_min : Product::query()->min('price');
        $max_price = request()->pr_max ? request()->pr_max : $maximum_available_price;
        $all_tags = ProductTag::all();

        return view('frontend.product.details', compact(
            'product',
            'related_products',
            'user_has_item',
            'ratings',
            'avg_rating',
            'available_attributes',
            'product_inventory_set',
            'additional_info_store',
            'all_category',
            'all_units',
            'maximum_available_price',
            'min_price',
            'max_price',
            'all_tags',
            'productColors',
            'productSizes',
            'setting_text',
            'user_rated_already'
        ));
    }

    public function productQuickViewPage($slug)
    {
        $product = Product::where('slug', $slug)
            ->with(
                'additionalInfo',
                'category',
                'tags',
                'inventoryDetails',
                'inventoryDetails.productColor',
                'inventoryDetails.productSize',
                'inventoryDetails.includedAttributes'
            )
            ->where("status","publish")
            ->firstOrFail();

        // get selected attributes in this product ( $available_attributes )
        $inventoryDetails = optional($product->inventoryDetails);
        $product_inventory_attributes = $inventoryDetails->toArray();

        /* *
         * ========================================================
         * Example of $product_inventory_attributes
         *
         * array:2 [▼
         *     0 => array:15 [▼
         *       'id" => 9
         *       "inventory_id" => 54
         *       "product_id" => 48
         *       "color" => "2"
         *       "size" => "1"
         *       "hash" => null
         *       "additional_price" => 971.0
         *       "image" => "382"
         *       "stock_count" => 92
         *       "sold_count" => 0
         *       "product_color" => array:6 [▼
         *             "id" => 2
         *             "name" => "Dark Green"
         *             "color_code" => "#08781a"
         *             "slug" => "dark-green"
         *             "created_at" => "2022-03-03T11:05:51.000000Z"
         *             "updated_at" => "2022-03-03T11:06:15.000000Z"
         *         ]
         *         "product_size" => array:6 [▼
         *             "id" => 1
         *             "name" => "Exatra Small"
         *             "size_code" => "xs"
         *             "slug" => "extra-small"
         *         ]
         *         "included_attributes" => array:3 [▼
         *             0 => array:7 [▼
         *                   "id" => 16
         *                   "product_id" => 48
         *                   "inventory_details_id" => 9
         *                   "attribute_name" => "Cheese"
         *                   "attribute_value" => "chereme"
         *             ]
         *         ]
         *      ]
         *   ]
         * ========================================================
         * */

        $all_included_attributes = array_filter(array_column($product_inventory_attributes, 'included_attributes', 'id'));
        $all_included_attributes_prd_id = array_keys($all_included_attributes);

        /* *
         * ========================================================
         * Example of $all_included_attributes
         *
         * array:2 [▼
         *     9 => array:3 [▼
         *       0 => array:7 [▼
         *         "id" => 16
         *         "product_id" => 48
         *         "inventory_details_id" => 9
         *         "attribute_name" => "Cheese"
         *         "attribute_value" => "cream"
         *         "created_at" => "2022-03-15T07:44:52.000000Z"
         *         "updated_at" => "2022-03-15T07:44:52.000000Z"
         *       ]
         *     ]
         *   ]
         * ========================================================
         * */

        $available_attributes = [];  // FRONTEND : All displaying attributes
        $product_inventory_set = []; // FRONTEND : attribute_store
        $additional_info_store = []; // FRONTEND : $additional_info_store

        foreach ($all_included_attributes as $id => $included_attributes) {
            $single_inventory_item = [];
            foreach ($included_attributes as $included_attribute_single) {
                /**
                 * Example: (Only data representation, not in code)
                 *      selected_attributes = [
                 *          'Cheese' => ['Mozzarella', 'Cheddar', 'Parmesan'],
                 *          'Sauce' => ['Hot', 'Taco', 'Fish', 'Soy', 'Tartar']
                 *      ];
                 */
                $available_attributes[$included_attribute_single['attribute_name']][$included_attribute_single['attribute_value']] = 1;

                // individual inventory item
                $single_inventory_item[$included_attribute_single['attribute_name']] = $included_attribute_single['attribute_value'];
                /* *
                 * ========================================================
                 * Example of $available_attributes
                 *
                 * array:3 [▼
                 *     "Cheese" => "cream"
                 *     "Color" => "Green"
                 *     "Size" => "M"
                 *   ]
                 * ========================================================
                 * */

                if (optional($inventoryDetails->find($id))->productColor) {
                    $single_inventory_item['Color'] = optional(optional($inventoryDetails->find($id))->productColor)->name;
                }

                if (optional($inventoryDetails->find($id))->productSize) {
                    $single_inventory_item['Size'] = optional(optional($inventoryDetails->find($id))->productSize)->name;
                }
            }

            $item_additional_price = optional(optional($product->inventoryDetails)->find($id))->additional_price ?? 0;
            $image = get_attachment_image_by_id(optional(optional($product->inventoryDetails)->find($id))->image)['img_url'] ?? '';

            $product_inventory_set[] = $single_inventory_item;

            $sorted_inventory_item = $single_inventory_item;
            ksort($sorted_inventory_item);

            $additional_info_store[md5(json_encode($sorted_inventory_item))] = [
                'pid_id' => $id, // ProductInventoryDetails->id
                'additional_price' => $item_additional_price,
                'image' => $image,
            ];
        }

        $productColors = $product->inventoryDetails->pluck('productColor')->unique();
        $productSizes = $product->inventoryDetails->pluck('productSize')->unique();

        if((empty($available_attributes) && !empty($product_inventory_attributes)) || count($all_included_attributes) < $product->inventoryDetails->count()){
            $sorted_inventory_item = [];
            $product_id = $product_inventory_attributes[0]['id'];
            // check inventory color and size exists or not

            if(!empty($product->inventoryDetails)){
                foreach($product->inventoryDetails as $inventory){
                    // if this inventory has attributes then it will fire continue statement
                    if(in_array($inventory->product_id,$all_included_attributes_prd_id)){
                        continue ;
                    }

                    $single_inventory_item = [];

                    if (optional($inventoryDetails->find($product_id))->productColor) {
                        $single_inventory_item['Color'] = optional($inventory->productColor)->name;
                    }

                    if (optional($inventoryDetails->find($product_id))->productSize) {
                        $single_inventory_item['Size'] = optional($inventory->productSize)->name;
                    }


                    $product_inventory_set[] = $single_inventory_item;

                    $item_additional_price = optional(optional($product->inventoryDetails)->find($product_id))->additional_price ?? 0;
                    $image = get_attachment_image_by_id(optional(optional($product->inventoryDetails)->find($product_id))->image)['img_url'] ?? '';

                    $sorted_inventory_item = $single_inventory_item;
                    ksort($sorted_inventory_item);

                    $additional_info_store[md5(json_encode($single_inventory_item))] = [
                        'pid_id' => $product_id,
                        'additional_price' => $item_additional_price,
                        'image' => $image,
                    ];
                }
            }
        }

        $available_attributes = array_map(fn ($i) => array_keys($i), $available_attributes);
        /* *
         * ========================================================
         * Example of $available_attributes
         * [
         *      "Cheese" => ["cream"],
         *      "Color" => ["Green"],
         *      "Size" => ["M", "L"]
         * ]
         * ========================================================
         * */


        $sub_category_arr = json_decode($product->sub_category_id, true);
        $ratings = ProductRating::where('product_id', $product->id)->with('user')->get();
        $avg_rating = $ratings->count() ? round($ratings->sum('rating') / $ratings->count()) : null;

        // related products
        $related_products = Product::whereJsonContains('sub_category_id', $sub_category_arr)
            ->with('campaign', 'rating')
            ->where('id', '!=', $product->id)
            ->take(3)
            ->get();

        if (!$related_products->count()) {
            $related_products = Product::where('category_id', $product->category_id)
                ->with('campaign', 'rating')
                ->where("status","publish")
                ->where('id', '!=', $product->id)
                ->take(3)
                ->get();
        }

        // (bool) Check logged-in user bought this item (needed for review)
        $user = getUserByGuard('web');

        $user_has_item = $user
            ? !!SaleDetails::join("product_sell_infos","product_sell_infos.id","=","sale_details.order_id")
                ->where('product_sell_infos.user_id', $user->id)
                ->where('sale_details.item_id', $product->id)->count()
            : null;

        $user_rated_already = !!! ProductRating::where('product_id', optional($product)->id)->where('user_id', optional($user)->id)->count();

        $setting_text = StaticOption::whereIn('option_name', [
            'product_in_stock_text',
            'product_out_of_stock_text',
            'details_tab_text',
            'additional_information_text',
            'reviews_text',
            'your_reviews_text',
            'write_your_feedback_text',
            'post_your_feedback_text',
        ])->get()->mapWithKeys(fn ($item) => [$item->option_name => $item->option_value])->toArray();

        // sidebar data
        $all_category = ProductCategory::where('status', 'publish')->with("subcategory")->get();
        $all_units = ProductUnit::all();
        $maximum_available_price = Product::query()->with('category')->max('price');
        $min_price = request()->pr_min ? request()->pr_min : Product::query()->min('price');
        $max_price = request()->pr_max ? request()->pr_max : $maximum_available_price;
        $all_tags = ProductTag::all();

        return view('frontend.product.quick-view', compact(
            'product',
            'related_products',
            'user_has_item',
            'ratings',
            'avg_rating',
            'available_attributes',
            'product_inventory_set',
            'additional_info_store',
            'all_category',
            'all_units',
            'maximum_available_price',
            'min_price',
            'max_price',
            'all_tags',
            'productColors',
            'productSizes',
            'setting_text',
            'user_rated_already'
        ))->render();
    }

    public function products(Request $request)
    {
        $page_details = Page::findOrFail(get_static_option('product_page'));
        return view('frontend.frontend-home', compact('page_details'));
    }

    public function getProductAttributeHtml(Request $request)
    {
        $product = Product::where('slug', $request->slug)->first();
        if ($product) {
            return view('frontend.partials.product-attributes', compact('product'));
        }
    }

    public function products_category($id, $any = "")
    {
        $default_item_count = get_static_option('default_item_count');
        $all_products = Product::where(['status' => 'publish', 'category_id' => $id])
            ->with('campaign', 'category', 'rating')
            ->orderBy('id', 'desc')
            ->paginate($default_item_count);

        $category = ProductCategory::with("subcategory","subcategory.subCategoryImage")->findOrFail($id);
        $category_name = $category->title;

        if (empty($category_name)) {
            abort(404);
        }

        return view('frontend.pages.product.category')->with([
            'all_products' => $all_products,
            'category_name' => $category_name,
            'category' => $category,
        ]);
    }

    public function products_subcategory($id, $any = "")
    {
        $default_item_count = get_static_option('default_item_count');
        $all_products = Product::where('status', 'publish')
            ->whereJsonContains('sub_category_id', "$id")
            ->orderBy('id', 'desc')
            ->paginate($default_item_count);

        $subCategory = ProductSubCategory::with("category")->find($id);
        $category_name = $subCategory->title;

        if (empty($category_name)) {
            abort(404);
        }

        return view('frontend.pages.product.subcategory')->with([
            'all_products' => $all_products,
            'subCategory' => $subCategory,
            'category_name' => $category_name,
        ]);
    }

    /** ======================================================================
     *                  CART FUNCTIONS
     * ======================================================================*/
    public function cartPage(Request $request)
    {
        $default_shipping_cost = CartAction::getDefaultShippingCost();

        $all_cart_items = CartHelper::getItems();

        // validate stock count here ...
        CartAction::validateItemQuantity();

        $all_cart_items = CartHelper::getItems();

        $products = Product::whereIn('id', array_keys($all_cart_items))->get();

        $subtotal = CartAction::getCartTotalAmount($all_cart_items, $products);
        $subtotal_with_tax = $subtotal + $default_shipping_cost;
        $total = CartAction::calculateCoupon($request, $subtotal_with_tax, $products);

        $cart_item_ids = array_keys($all_cart_items);
        $product_stock_attributes = InventoryDetailsAttribute::where('product_id', $cart_item_ids)->get();

        return view('frontend.cart.all', compact(
            'all_cart_items',
            'products',
            'subtotal',
            'default_shipping_cost',
            'total',
            'product_stock_attributes'
        ));
    }

    /** ======================================================================
     *                  WISHLIST FUNCTIONS
     * ======================================================================*/
    public function wishlistPage(Request $request)
    {
        $all_wishlist_items = WishlistHelper::getItems();
        $products = Product::whereIn('id', array_keys($all_wishlist_items))->get();
        return view('frontend.wishlist.all', compact('all_wishlist_items', 'products'));
    }

    /** ======================================================================
     *                  COMPARE FUNCTIONS
     * ======================================================================*/
    public function productsComparePage(Request $request)
    {
        $request->validate(['index' => 'nullable|numeric']);

        $all_compare_items = CompareHelper::getItems();
        $all_compare_items = array_reverse($all_compare_items);

        $index = isset($request->index) ? (int) $request->index : 1;
        $index = $index > 0 ? $index - 1 : 0; // array index

        $display_compare_items = [];

        if (isset($all_compare_items[$index])) {
            $display_compare_items = [
                $all_compare_items[$index]
            ];
        }

        if (isset($all_compare_items[$index + 1])) {
            $display_compare_items[] = $all_compare_items[$index + 1];
        }

        $products = Product::with('additionalInfo', 'category', 'inventory','rating')
            ->withAvg('rating', 'rating')
            ->whereIn('id', $display_compare_items)
            ->get();
        $product_ids = $products->pluck('id')->toArray();

        $categories = CompareAction::getCategories($products);
        $all_ratings = CompareAction::getRatings($products);

        return view('frontend.compare.all', compact(
            'display_compare_items',
            'products',
            'product_ids',
            'categories',
            'all_ratings'
        ));
    }

    /** ======================================================================
     *                  PRODUCTS FILTER FUNCTIONS
     * ======================================================================*/
    public function topRatedProducts()
    {
        $products = Product::where('status', 'publish')
            ->withAvg('rating', 'rating')
            ->with('rating')
            ->orderBy('rating_avg_rating', 'DESC')
            ->take(5)
            ->get();

        return view('frontend.partials.filter-item', compact('products'));
    }

    public function topSellingProducts()
    {
        $products = Product::where('status', 'publish')
            ->withAvg('rating', 'rating')
            ->with('rating')
            ->orderBy('sold_count', 'DESC')
            ->take(5)
            ->get();

        return view('frontend.partials.filter-item', compact('products'));
    }

    public function newProducts()
    {
        $products = Product::where('status', 'publish')
            ->withAvg('rating', 'rating')
            ->with('rating')
            ->orderBy('created_at', 'DESC')
            ->take(5)
            ->get();

        return view('frontend.partials.filter-item', compact('products'));
    }

    function filterCategoryProducts (Request $request) {
        $request->validate([
            'id' => 'required|exists:product_categories',
            'item_count' => 'required|numeric'
        ]);

        $products = Product::where('status', 'publish')
            ->where('category_id', $request->id)
            ->withAvg('rating', 'rating')
            ->with('rating')
            ->take($request->item_count)
            ->get();

        return view('frontend.partials.filter-item', compact('products'));
    }

    /** ======================================================================
     *                          CAMPAIGN PAGE
     * ======================================================================*/
    public function campaignPage($id, $any = "")
    {
        $campaign = Campaign::with(['products', 'products.product'])->findOrFail($id);
        $campaign_product_ids = optional($campaign->products)->pluck('id')->toArray();
        $campaign_products =  CampaignProduct::whereIn('id', $campaign_product_ids)->with('product.rating')->paginate();

        return view('frontend.campaign.index', compact('campaign', 'campaign_products'));
    }

    public function flashSalePage()
    {
        # code...
    }

    /** ======================================================================
     *                  PAYMENT STATUS FUNCTIONS
     * ======================================================================*/
    public function product_payment_success($id)
    {
        $extract_id = substr($id, 6);
        $extract_id = substr($extract_id, 0, -6);

        $payment_details = ProductSellInfo::findOrFail($extract_id);

        $order_details = SaleDetails::where('order_id', $extract_id)->get();

        $product_ids = $order_details->pluck('item_id')->toArray();
        $products = Product::whereIn('id', $product_ids)->get();
        CartHelper::clear();
        return view('frontend.payment.payment-success')->with([
            'payment_details' => $payment_details,
            'order_details' => $order_details,
            'products' => $products,
        ]);
    }

    public function product_payment_cancel()
    {
        return view('frontend.payment.payment-cancel');
    }

    /** ======================================================================
     *                  ORDER TRACKING PAGE
     * ======================================================================*/
    public function trackOrderPage()
    {
        return view('frontend.pages.track-order');
    }

    public function trackOrder(Request $request)
    {
        $request->validate([
            'order_id' => 'required|numeric',
//            'email' => 'required|email'
        ]);

        $sell_info = ProductSellInfo::where('id', $request->order_id)
                        ->first();

        if (!empty($sell_info)) {
            try {
                // \Mail::to($sell_info->email)->send(new TrackOrder(
                //     $sell_info
                // ));

                $message = "Your order is now <b>" . ucwords($sell_info->status) . "</b> <br>" . "Your payment status is <b>". ucwords($sell_info->payment_status) . "</b>";

                return back()->with(FlashMsg::explain('success', __('Order status is mailed to the billing email.')) + ["info" => $message]);
            } catch (\Exception $e) {
                echo "Server error";
            }
        }

        return back()->with(FlashMsg::explain('danger', __('No order found for the given information.')));
    }

    /** ======================================================================
     *                  AJAX SEARCH FUNCTION
     * ======================================================================*/
    public function search(Request $request) {
        $request->validate([
            'category_id' => 'nullable|exists:product_categories',
            'search_query' => 'nullable|string|max:191'
        ]);

        $category_data = [];
        $product_data = [];
        $product_url = route('frontend.products.all', ['q' => $request->search_query]);

        $products = Product::query()->withAvg("rating", "rating")->where('status', 'publish');

        if (isset($request->search_query)) {
            $products->where('title', 'LIKE', "%{$request->search_query}%");
        }

        if (isset($request->category_id)) {
            $category_id = $request->category_id;
            $products->where('category_id', function ($query) use ($category_id) {
                $query->query('category_id', $category_id);
            });
        }

        $products = $products->get();
        $categories = $products->pluck('category')->unique('id');
        // prepare response category API data
        foreach ($categories as $category) {
            if(!empty($category)){
                $category_data[] = [
                    'title' => $category->title,
                    'url' => route('frontend.products.category', $category->id)
                ];
            }
        }

        $html_products = "";
        // prepare response products API data
        foreach ($products as $product) {
            $html_products .= view("components.product-style.list-style-one", compact("product"))->render();
//            $sale_price = optional($product->campaign)->campaign_price ?? $product->sale_price;
//            $deleted_price = optional($product->campaign)->campaign_price ? $product->sale_price : $product->price;
//            $product_data[] = [
//                'name' => $product->title,
//                'image' => get_attachment_image_by_id($product->image, 'grid')['img_url'],
//                'url' => route('frontend.products.single', $product->slug),
//                'sale_price' => $sale_price,
//                'deleted_price' => $deleted_price,
//                'is_stock' => !!optional($product->inventory)->sum('stock_count'),
//                'rating' => ($product->ratingCount())? ratingMarkup($product->ratingAvg(), $product->ratingCount()) : ''
//            ];
        }

        return response()->json([
            'products' => $html_products,
            'categories' => $category_data,
            'product_url' => $product_url
        ]);
    }
}
