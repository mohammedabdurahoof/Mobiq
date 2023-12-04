<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\MobileFeatureProductResource;
use App\Http\Resources\ProductResource;
use App\Product\ProductAttribute;
use App\Product\ProductCategory;
use App\Product\ProductSubCategory;
use App\Product\Tag;
use App\StaticOption;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\ProductRating;
use Modules\Product\Entities\ProductTag;
use Modules\Product\Entities\ProductUnit;
use Modules\Product\Entities\SaleDetails;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function search(){
        $request = request();
        $all_category = ProductCategory::select(["id","title"])->where('status', 'publish')->with('subcategory')->get();
        $all_attributes = ProductAttribute::all();
        $all_tags = Tag::all();
        $maximum_available_price = Product::query()->max('price');
        $sub_cat_details = ProductSubCategory::with('category')->find($request->subcat);
        $cat = optional(optional($sub_cat_details)->category)->id;

        $min_price = $request->pr_min ? $request->pr_min : Product::query()->min('price');
        $max_price = $request->pr_max ? $request->pr_max : $maximum_available_price;

        $style = isset($request->s) && $request->s == 'list' ? 'list' : 'grid';

        $display_item_count = $request->count ?? get_static_option('default_item_count') ?? 5;

        $all_products = Product::with('inventory')
            ->withAvg('rating', 'rating')
            ->where('status', 'publish');

        // search title
        if ($request->q) {
            $all_products->where('title', 'LIKE', "%$request->q%");
        }

        // category search
        if ($request->cat) {
            $all_products->where('category_id', $request->cat);
        }

        // subcategory search
        if ($request->subcat) {
            $all_products->whereJsonContains('sub_category_id', $request->subcat);
        }

        if ($min_price && $min_price > 0) {
            $all_products->where('price', '>=', $min_price);
        }

        if ($max_price) {
            $all_products->where('price', '<=', $max_price);
        }

        // filter by attribute
        if ($request->attr) {
            $filter_attributes = json_decode($request->attr, true);
            if (is_array($filter_attributes)) {
                return $filter_attributes;
                foreach ($filter_attributes as $attr) {
                    if (isset($attr['id']) && isset($attr['attribute'])) {
                        $all_products->where('attributes', 'LIKE', "%{$attr['id']}%{$attr['attribute']}%");
                    }
                }
            }
        }

        // filter by rating
        if ($request->rt) {
            $rating = $request->rt;
            $all_products->whereHas('rating', function ($query) use ($rating) {
                $query->where('rating','<=', $rating);
            });
        }

        // filter by tag
        if ($request->t) {
            $tag = $request->t;
            $all_products->whereHas('tags', function ($query) use ($tag) {
                $query->where('tag', $tag);
            });
        }

        // sort
        $sort_by = $request->sort ?? 'default';

        if ($sort_by == 'popularity') {
            $all_products->orderBy('sold_count', 'DESC');
        }elseif($sort_by == 'latest' || $sort_by == 'default') {
            $all_products->orderBy('created_at', 'DESC');
        }elseif($sort_by == 'price_low') {
            $all_products->orderBy('sale_price', 'ASC');
        }elseif($sort_by == 'price_high') {
            $all_products->orderBy('sale_price','desc');
        }

        // get selected limit data
        $display_item_count = $display_item_count ?? 15;
        $all_products = $all_products->paginate($display_item_count)->withQueryString();

        $pagination = [
            "current_page" => $all_products->currentPage(),
            "last_page" => $all_products->lastPage(),
            "per_page" => $all_products->perPage(),
            "path" => $all_products->path(),
            "links" => $all_products->getUrlRange(0,$all_products->lastPage())
        ];

        return MobileFeatureProductResource::collection($all_products)->response([$pagination])->setStatusCode(201);
    }

    


    public function productDetail($id){
        $product = Product::where('id', $id)
            ->with([
                'additionalInfo',
                'category',
                'tags',
                'inventoryDetails',
                'inventoryDetails.productColor',
                'inventoryDetails.productSize',
                'inventoryDetails.includedAttributes'
            ])
            ->where("status","publish")
            ->firstOrFail();

        $product->image = get_attachment_image_by_id($product->image)["img_url"] ?? null;

        $gallery = [];

        foreach(json_decode($product->product_image_gallery) ?? [] as $image){
            $gallery[] = get_attachment_image_by_id($image)["img_url"] ?? null;
        }
        $product->product_image_gallery = $gallery;
        $product->product_gallery_image = $gallery;
        
        

        $campaign_product = getCampaignProductById($product->id);
        $sale_price = $campaign_product ? $campaign_product->campaign_price : $product->sale_price;
        $deleted_price = $campaign_product ? $product->sale_price : $product->price;
        $campaign_percentage = $campaign_product ? getPercentage($product->sale_price, $sale_price) : false;

        $product->campaign_percentage = number_format($campaign_percentage , 2);
        $product->sale_price = round($sale_price,2);
        $product->price = round($deleted_price,2);
        
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
                    $single_inventory_item['Color'] = optional(optional($inventoryDetails->find($id))->productColor)->color_code;
                    $single_inventory_item['Color_name'] = optional(optional($inventoryDetails->find($id))->productColor)->name;
                }

                if (optional($inventoryDetails->find($id))->productSize) {
                    $single_inventory_item['Size'] = optional(optional($inventoryDetails->find($id))->productSize)->name;
                }
            }

            $item_additional_price = optional(optional($product->inventoryDetails)->find($id))->additional_price ?? 0;
            $image = get_attachment_image_by_id(optional(optional($product->inventoryDetails)->find($id))->image)['img_url'] ?? '';

            $product_inventory_set[] = $single_inventory_item + ["hash" => md5(json_encode($single_inventory_item))];

            $sorted_inventory_item = $single_inventory_item;
            ksort($sorted_inventory_item);

            $additional_info_store[md5(json_encode($single_inventory_item))] = [
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
                        $single_inventory_item['Color'] = optional($inventory->productColor)->color_code;
                        $single_inventory_item['Color_name'] = optional($inventory->productColor)->name;
                    }

                    if (optional($inventoryDetails->find($product_id))->productSize) {
                        $single_inventory_item['Size'] = optional($inventory->productSize)->name;
                    }

                    $product_inventory_set[] = $single_inventory_item + ["hash" => md5(json_encode($single_inventory_item))];

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
        $related_products = MobileFeatureProductResource::collection($related_products);

        // (bool) Check logged-in user bought this item (needed for review)
        $user = auth("sanctum")->user();

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
        $all_category = \Modules\Product\Entities\ProductCategory::where('status', 'publish')->with("subcategory")->get();
        $all_units = ProductUnit::all();
        $maximum_available_price = Product::query()->with('category')->max('price');
        $min_price = request()->pr_min ? request()->pr_min : Product::query()->min('price');
        $max_price = request()->pr_max ? request()->pr_max : $maximum_available_price;
        $all_tags = ProductTag::all();

        return [
            'product' => $product,
            'related_products' => $related_products,
            'user_has_item' => $user_has_item,
            'ratings' => $ratings,
            'avg_rating' => $avg_rating,
            'available_attributes' => $available_attributes,
            'product_inventory_set' => $product_inventory_set,
            'additional_info_store' => $additional_info_store,
            'productColors' => $productColors,
            'productSizes' => $productSizes,
            'setting_text' => $setting_text,
            'user_rated_already' => !($user_rated_already)
        ];
    }
    
    public function priceRange(){
        $max_price = Product::query()->with('category')->max('price');
        $min_price = Product::query()->min('price');
        
        return response()->json(["min_price" => $min_price, "max_price" => $max_price]);
    }

    public function storeReview(Request $request){
        $user = auth('sanctum')->user();
        if (!$user) {
            return response()->json(['msg' => 'Login to submit rating'])->setStatusCode(422);
        }

        $request->validate([
            'id' => 'required|exists:products',
            'rating' => 'required|integer',
            'comment' => 'required|string',
        ]);

        if ($request->rating > 5) {
            $rating = 5;
        }

        // ensure rating not inserted before
        $user_rated_already = !! ProductRating::where('product_id', $request->id)->where('user_id', $user->id)->count();
        if ($user_rated_already) {
            return response()->json(['msg' => __('You have rated before')])->setStatusCode(422);
        }

        $rating = ProductRating::create([
            'product_id' => $request->id,
            'user_id' => $user->id,
            'status' => 1,
            'rating' => $request->rating,
            'review_msg' => $request->comment,
        ]);

        return response()->json(["success" => true,"data" => $rating]);
    }
}
