<?php

namespace Modules\Product\Http\Controllers;

use App\Helpers\FlashMsg;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Product\Entities\InventoryDetailsAttribute;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\ProductAdditionalInformation;
use Modules\Product\Entities\ProductAttribute;
use Modules\Product\Entities\ProductCategory;
use Modules\Product\Entities\ProductColor;
use Modules\Product\Entities\ProductInventory;
use Modules\Product\Entities\ProductInventoryDetails;
use Modules\Product\Entities\ProductSize;
use Modules\Product\Entities\ProductSubCategory;
use Modules\Product\Entities\ProductTag;
use Modules\Product\Entities\ProductUnit;
use Modules\Product\Entities\Tag;
use function back;
use function response;
use function sanitize_html;
use function sanitizeArray;
use function view;

class ProductController extends Controller
{
    const BASE_URL = 'backend.products.product.';

    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('permission:product-list|product-create|product-edit|product-delete|product-clone|product-view', ['only', ['index']]);
        $this->middleware('permission:product-create', ['only', ['create', 'store']]);
        $this->middleware('permission:product-edit', ['only', ['edit', 'update']]);
        $this->middleware('permission:product-delete', ['only', ['destroy', 'bulk_action']]);
        $this->middleware('permission:product-clone', ['only', ['clone']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
       if(auth()->user()->role=="editor"){
            
            // check route parameter exists or not
            if(isset(request()->title) && !empty(request()->title)){
                // sanitize title get from route
                $title = htmlentities(htmlspecialchars(filter_var(request()->title,FILTER_SANITIZE_STRING)));
                $all_products = Product::where("title","like",'%' . $title . '%')->with('category')->orderByDesc('id')->paginate(10);
            }else{
                $all_products = Product::with('category')->orderByDesc('id')->paginate(10);
            }
        }else{
            $all_products = Product::with('category')->where('created_by',auth()->user()->id)->orderByDesc('id')->paginate(10);
        }
        return view(self::BASE_URL.'all', compact('all_products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $all_category = ProductCategory::all();
        $all_sub_category = ProductSubCategory::all();
        $all_attribute = ProductAttribute::all()->groupBy('title')->map(fn($query) => $query[0]);
        $all_tags = Tag::all();
        $all_measurement_units = ProductUnit::all();
        $product_colors = ProductColor::all();
        $product_sizes = ProductSize::all();
        return view(self::BASE_URL.'new', compact(
            'all_category',
            'all_sub_category',
            'all_attribute',
            'all_tags',
            'all_measurement_units',
            'product_colors',
            'product_sizes'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|max:191',
            'summary' => 'required|string',
            'description' => 'required|string',
            'category_id' => 'required|string',
            'sub_category_id' => 'nullable|array',
            'image' => 'required|string|max:191',
            'image_gallery' => 'nullable|string',
            'price' => 'nullable|string',
            'sale_price' => 'required|string',
            'badge' => 'nullable|string|max:191',
            'status' => 'required|string|max:191',
            'slug' => 'required|string|max:191',
            'tags' => 'nullable|string',
            'attribute_id' => 'nullable|array',
            'attribute_selected' => 'nullable|array',
            'attribute_name' => 'nullable|array',
            'sku' => 'required|string|max:191',
            'stock_count' => 'required|string|max:191',
            'uom' => 'required|exists:product_units,name',
            'unit' => 'required|numeric',

            'item_size' => 'nullable|array',
            'item_color' => 'nullable|array',
            'item_additional_price' => 'nullable|array',
            'item_stock_count' => 'nullable|array',
            'item_image' => 'nullable|array',
        ]);

        $sku = trim(sanitize_html($request->sku));

        $all_attribute = [];

        if (isset($request->attribute_id) && count($request->attribute_id)) {
            foreach ($request->attribute_id as $key => $attribute_id) {
                $type = $this->getRequestAttributeData('attribute_name', $key);
                $name = $this->getRequestAttributeData('attribute_selected', $key);

                $all_attribute[$attribute_id][] = [
                    'type' => $type,
                    'name' => $name,
                    'additional_price' =>  $this->getRequestAttributeData('attr_additional_price', $key),
                    'attribute_image' => $this->getRequestAttributeData('attribute_image', $key),
                ];
            }
        }

        try {
            DB::beginTransaction();

            $insert_product_data = [
                'title' => $request->sanitize_html('title'),
                'summary' => $request->sanitize_html('summary'),
                'description' => $request->description,
                'category_id' => $request->sanitize_html('category_id'),
                'image' => $request->sanitize_html('image'),
                'price' => (double) $request->sanitize_html('price') ?? 0,
                'sale_price' => $request->sanitize_html('sale_price'),
                'badge' => $request->sanitize_html('badge'),
                'status' => $request->sanitize_html('status'),
                'slug' => $this->getValidSlug($request->sanitize_html('slug')),
                'attributes' => $all_attribute,
                'uom' => sanitize_html($request->uom),
                'unit' => sanitize_html($request->unit),
                'created_by' => auth()->user()->id,
            ];

            if ($request->sub_category_id) {
                $all_sub_category_id = [];
                foreach ($request->sub_category_id as $key => $sub_category_id) {
                    $all_sub_category_id[] = sanitize_html($sub_category_id);
                }
                $insert_product_data['sub_category_id'] = $all_sub_category_id;
            }

            if ($request->image_gallery) {
                $all_product_image_gallery = [];
                $all_gallery_image = explode('|', $request->image_gallery);
                $all_product_image_gallery = sanitizeArray($all_gallery_image);
                $insert_product_data['product_image_gallery'] = $all_product_image_gallery;
            }

            $product = Product::create($insert_product_data);

            $tags = $request->tags ? explode(',', $request->tags) : [];
            if ($tags) {
                foreach ($tags as $tag) {
                    $tag = Tag::firstOrCreate(['tag_text' => $tag]);
                    $product_tag = ProductTag::create([
                        'product_id' => $product->id,
                        'tag' => $tag->tag_text,
                    ]);
                }
            }

//            ddd($request->item_size);

            if ($product->id && $request->info_title) {
                $this->insertAdditionalInformation($product->id, $request);
            }

            $inventory = ProductInventory::create([
                'product_id' => sanitize_html($product->id) ,
                'sku' => $sku,
                'stock_count' => empty($request->item_stock_count[0]) || !isset($request->item_size[0]) ? sanitize_html($request->stock_count) ?? 0 : array_sum($request->item_stock_count),
                'sold_count' => 0,
            ]);

            if(!empty($request->item_size)){
                foreach ($request->item_size as $key => $size) {
                    $this->insertInventoryVariantData($inventory, [
                        'size' => $size ?? '',
                        'color' => $request->item_color[$key] ?? '',
                        'additional_price' => $request->item_additional_price[$key],
                        'stock_count' => $request->item_stock_count[$key],
                        'image' => $request->item_image[$key],
                    ], $request, $key);
                }
            }

            // insert as attribute too ?

            DB::commit();
            return back()->with(FlashMsg::create_succeed('Product'));

        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with(FlashMsg::explain('danger', $th->getMessage() . '(' . $th->getLine() . ')'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Product  $product
     */
    public function edit(Product $item)
    {
        $product = Product::where('id', $item->id)
                        ->with(
                            'additionalInfo',
                            'tags',
                            'inventory',
                            'inventoryDetails',
                            'inventoryDetails.productColor',
                            'inventoryDetails.productSize',
                            'inventoryDetails.includedAttributes',
                        )
                        ->first();
        $all_category = ProductCategory::all();
        $all_sub_category = ProductSubCategory::all();
        $all_attribute = ProductAttribute::all()->groupBy('title')->map(fn($query) => $query[0]);
        $all_tags = Tag::all();
        $all_measurement_units = ProductUnit::all();
        $product_all_inventory = ProductInventory::where('product_id', $item->id)->get();
        $product_colors = ProductColor::all();
        $product_sizes = ProductSize::all();

//        ddd($product);

        return view(self::BASE_URL.'edit', compact(
            'product',
            'all_category',
            'all_sub_category',
            'all_attribute',
            'all_tags',
            'all_measurement_units',
            'product_all_inventory',
            'product_colors',
            'product_sizes',
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Product  $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Product $item)
    {
        $this->validate($request, [
            'title' => 'required|string|max:191',
            'summary' => 'required|string',
            'description' => 'required|string',
            'category_id' => 'required|string',
            'sub_category_id' => 'nullable|array',
            'image' => 'required|string|max:191',
            'image_gallery' => 'nullable|string',
            'price' => 'nullable|string',
            'sale_price' => 'required|string',
            'badge' => 'nullable|string|max:191',
            'status' => 'required|string|max:191',
            'slug' => 'required|string|max:191',
            'tags' => 'nullable|string',
            'attribute_id' => 'nullable|array',
            'attribute_selected' => 'nullable|array',
            'attribute_name' => 'nullable|array',
            'sku' => 'required|string|max:191',
            'stock_count' => 'required|string|max:191',
            'uom' => 'required|exists:product_units,name',
            'unit' => 'required|numeric',
            'item_size' => 'nullable|array',
            'item_color' => 'nullable|array',
            'item_additional_price' => 'nullable|array',
            'item_stock_count' => 'nullable|array',
            'item_image' => 'nullable|array',
        ]);

        $sku = trim(sanitize_html($request->sku));

        $all_attribute = [];
        $attribute_inventory = [];

        if (isset($request->attribute_id) && count($request->attribute_id)) {
            foreach ($request->attribute_id as $key => $attribute_id) {
                $type = $this->getRequestAttributeData('attribute_name', $key);
                $name = $this->getRequestAttributeData('attribute_selected', $key);

                $all_attribute[$attribute_id][] = [
                    'type' => $type,
                    'name' => $name,
                    'additional_price' =>  $this->getRequestAttributeData('attr_additional_price', $key),
                    'attribute_image' => $this->getRequestAttributeData('attribute_image', $key),
                ];
            }
        }

        try {
            DB::beginTransaction();

            $update_product_data = [
                'title' => $request->sanitize_html('title'),
                'summary' => $request->sanitize_html('summary'),
                'description' => $request->description,
                'category_id' => $request->sanitize_html('category_id'),
                'image' => $request->sanitize_html('image'),
                'price' => (double) $request->sanitize_html('price') ?? 0,
                'sale_price' => $request->sanitize_html('sale_price'),
                'badge' => $request->sanitize_html('badge'),
                'status' => $request->sanitize_html('status'),
                'slug' => $this->getValidSlug($request->sanitize_html('slug'), 'update', $item->id),
                'attributes' => $all_attribute,
                'uom' => sanitize_html($request->uom),
                'unit' => sanitize_html($request->unit),
            ];

            if ($request->sub_category_id) {
                $all_sub_category_id = [];
                foreach ($request->sub_category_id as $key => $sub_category_id) {
                    $all_sub_category_id[] = sanitize_html($sub_category_id);
                }
                $update_product_data['sub_category_id'] = $all_sub_category_id;
            }

            if ($request->image_gallery) {
                $all_product_image_gallery = [];
                $all_gallery_image = explode('|', $request->image_gallery);
                $all_product_image_gallery = sanitizeArray($all_gallery_image);
                $update_product_data['product_image_gallery'] = $all_product_image_gallery;
            }

            $updated = $item->update($update_product_data);

            $tags = $request->tags ? explode(',', $request->tags) : [];
            if ($tags) {
                ProductTag::where('product_id', $item->id)->delete();
                foreach ($tags as $tag) {
                    $tag = Tag::firstOrCreate(['tag_text' => $tag]);
                    $product_tag = ProductTag::create([
                        'product_id' => $item->id,
                        'tag' => $tag->tag_text,
                    ]);
                }
            }

            if ($request->info_title) {
                $this->updateAdditionalInformation($item->id, $request);
            }

            // inventory is empty now is time to remove all inventory from the database
            // remove inventory_details_attributes
            InventoryDetailsAttribute::where("product_id",$item->id)->delete();
            ProductInventoryDetails::where("product_id",$item->id)->delete();

            $inventory_data = ProductInventory::where('product_id', $item->id)->first();

            if (!is_null($inventory_data)) {
                $inventory_data->update([
                    'product_id' => $item->id,
                    'sku' => $sku,
                    'stock_count' => empty($request->item_stock_count[0]) || !isset($request->item_size[0])
                        ? sanitize_html($request->stock_count) ?? 0 :
                        array_sum($request->item_stock_count),
                ]);
            } else {
                $inventory_data = ProductInventory::create([
                    'product_id' => $item->id,
                    'sku' => $sku,
                    'stock_count' => empty($request->item_stock_count[0]) || !isset($request->item_size[0])
                        ? sanitize_html($request->stock_count) ?? 0
                        : array_sum($request->item_stock_count),
                ]);
            }

//            if(!empty($request->item_size)){
                foreach ($request->item_size as $key => $size) {
                    $this->updateInventoryVariantData($inventory_data, [
                        'id' => $request->inventory_details_id[$key] ?? 0,
                        'size' => $size ?? '',
                        'color' => $request->item_color[$key] ?? '',
                        'additional_price' => $request->item_additional_price[$key],
                        'stock_count' => $request->item_stock_count[$key],
                        'image' => $request->item_image[$key],
                    ], $request, $key);
                }
//            }else{
//
//                // inventory is empty now is time to remove all inventory from the database
//                // remove inventory_details_attributes
//                InventoryDetailsAttribute::where("product_id",$item->id)->delete();
//                ProductInventoryDetails::where("product_id",$item->id)->delete();
//            }

            // update the product->attributes column too ?

            DB::commit();
            return back()->with(FlashMsg::update_succeed('Product'));
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with(FlashMsg::explain('danger', $th->getMessage()));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Modules\Product\Entities\Product $product
     * @return array
     */
    public function destroy(Product $item)
    {
        return $item->delete()
            ? FlashMsg::delete_succeed('Product')
            : FlashMsg::delete_failed('Product');
    }

    public function clone(Product $item)
    {
        $new_item = $item->replicate();

        $new_item->title = $item->title;
        $new_item->slug = $item->slug;
        $new_item->status = 'draft';
        $new_item->save();

        return $new_item->save()
            ? back()->with(FlashMsg::clone_succeed('Product'))
            : back()->with(FlashMsg::clone_failed('Product'));
    }

    public function bulk_action(Request $request)
    {
        Product::whereIn('id', $request->ids)->delete();
        return 'ok';
    }

    public function getValidSlug(String $slug, String $type = 'insert', $id = null)
    {
        $slug = strtolower(trim($slug));
        $present_slug_taken = Product::where('slug', $slug)->count();

        if ($type == 'insert') {
            if ($present_slug_taken) {
                return $slug . '-' . rand(11111, 99999);
            }
            return $slug;
        }

        if ($type == 'update') {
            if (!$id) return false;

            $slug_changed = ! Product::where('slug', $slug)->where('id', $id)->count();

            if ($slug_changed && $present_slug_taken) {
                $new_slug = $slug . '-' . rand(11111, 99999);
                return $this->getValidSlug($new_slug, 'update', $id);
            }
            return $slug;
        }
    }

    public function getPrice(Request $request)
    {
        $product = Product::findOrFail($request->id);
        return response()->json(['price' => $product->price], 200);
    }

    /**============================================================================
     *                  ADDITIONAL INFORMATION FUNCTIONS
    ============================================================================*/
    public function insertAdditionalInformation($product_id, Request $request)
    {
        $this->validate($request, [
            'info_title' => 'nullable|array',
            'info_text' => 'nullable|array',
            'info_title.*' => 'nullable|string',
            'info_text.*' => 'nullable|string',
        ]);

        $bulk_insert_data = [];

        foreach ($request->info_title as $key => $info_title) {
            $sanitized_info_title = sanitize_html($info_title) ?? '';
            $sanitized_info_text = sanitize_html($request->info_text[$key]) ?? '';

            if (strlen($sanitized_info_title) && strlen($sanitized_info_text)) {
                $bulk_insert_data[] = [
                    'product_id' => $product_id,
                    'title' => $sanitized_info_title,
                    'text' => $sanitized_info_text,
                ];
            }
        }

        ProductAdditionalInformation::insert($bulk_insert_data);
    }

    public function updateAdditionalInformation($product_id, Request $request)
    {
        $d = ProductAdditionalInformation::where('product_id', $product_id)->delete();
        return $this->insertAdditionalInformation($product_id, $request);
    }

    /** ============================================================================
     *                  INVENTORY FUNCTIONS
     * ============================================================================*/
    private function insertInventoryVariantData($inventory, array $variant_data, $request, $key)
    {
        if (is_null($inventory)) return;

        if (!is_null($variant_data['stock_count'])) {
            $variant_inventory = ProductInventoryDetails::create([
                'product_id' => $inventory->product_id,
                'inventory_id' => $inventory->id,
                'color' => $variant_data['color'] ?? '',
                'size' => $variant_data['size'] ?? '',
                'additional_price' => $variant_data['additional_price'] ?? 0,
                'image' => $variant_data['image'] ?? '',
                'stock_count' => $variant_data['stock_count'] ?? 0,
            ]);

            if ($variant_inventory) {
                $i = 0; // custom key since the key from the frontend will not exactly be the sequential
                if ($request->item_attribute_name) {
                    foreach ($request->item_attribute_name as $req_attribute_key => $attribute_names) {
                        if ($key == $i) {
                            foreach ($attribute_names as $req_attribute_key_2 => $attribute_name) {
                                $attribute_value = '';

                                if (!empty($request->item_attribute_value[$req_attribute_key])) {
                                    $attribute_value = $request->item_attribute_value[$req_attribute_key][$req_attribute_key_2] ?? '';
                                }

                                if (!empty($request->item_attribute_id[$req_attribute_key])) {
                                    $attribute_id = $request->item_attribute_id[$req_attribute_key][$req_attribute_key_2] ?? 0;

                                    InventoryDetailsAttribute::create([
                                        'product_id' => $inventory->product_id,
                                        'inventory_details_id' => $variant_inventory->id,
                                        'attribute_name' => $attribute_name,
                                        'attribute_value' => $attribute_value,
                                    ]);
                                }
                            }
                        }

                        $i++;
                    }
                }
            }
        }
    }

    private function updateInventoryVariantData($inventory, array $variant_data, $request, $key)
    {
        if (is_null($inventory)) return;

        $variant_inventory = ProductInventoryDetails::find($variant_data['id'] ?? 0);

        $inventory_details_data = [
            'product_id' => $inventory->product_id,
            'inventory_id' => $inventory->id,
            'color' => $variant_data['color'] ?? '',
            'size' => $variant_data['size'] ?? '',
            'additional_price' => $variant_data['additional_price'] ?? 0,
            'image' => $variant_data['image'] ?? '',
            'stock_count' => $variant_data['stock_count'] ?? 0,
        ];

        if (!is_null($variant_data['stock_count'])) {
            // if existing ProductInventoryDetails
            if (!is_null($variant_inventory)) {
                $variant_inventory->update($inventory_details_data);
            } else {
                $variant_inventory = ProductInventoryDetails::create($inventory_details_data);
            }

            if ($variant_inventory) {
                $i = 0; // custom key since the key from the frontend will not exactly be the sequential
                if ($request->item_attribute_name) {
                    foreach ($request->item_attribute_name as $req_attribute_key => $attribute_names) {
                        if ($key == $i) {
                            foreach ($attribute_names as $req_attribute_key_2 => $attribute_name) {
                                $attribute_value = '';

                                if (!empty($request->item_attribute_value[$req_attribute_key])) {
                                    $attribute_value = $request->item_attribute_value[$req_attribute_key][$req_attribute_key_2] ?? '';
                                }

                                if (!empty($request->item_attribute_id[$req_attribute_key])) {
                                    $attribute_id = $request->item_attribute_id[$req_attribute_key][$req_attribute_key_2] ?? 0;
                                    $inventory_details_attribute = InventoryDetailsAttribute::find($attribute_id);

                                    $inventory_details_attribute_data = [
                                        'product_id' => $inventory->product_id,
                                        'inventory_details_id' => $variant_inventory->id,
                                        'attribute_name' => $attribute_name,
                                        'attribute_value' => $attribute_value,
                                    ];

//                                    if (!is_null($inventory_details_attribute)) {
//                                        $inventory_details_attribute->update($inventory_details_attribute_data);
//                                    } else {
                                        InventoryDetailsAttribute::insert($inventory_details_attribute_data);
//                                    }
                                }
                            }
                        }

                        $i++;
                    }
                }
            }
        }
    }

    private function insertProductAttributesStock($request, $product_id) {
        $all_attribute = [];
        if (isset($request->attribute_id) && count($request->attribute_id)) {
            foreach ($request->attribute_id as $key => $attribute_id) {
                $type = $this->getRequestAttributeData('attribute_name', $key);
                $name = $this->getRequestAttributeData('attribute_selected', $key);

                $all_attribute[$attribute_id][] = [
                    'type' => $type,
                    'name' => $name,
                    'additional_price' =>  $this->getRequestAttributeData('attr_additional_price', $key),
                    'attribute_image' => $this->getRequestAttributeData('attribute_image', $key),
                ];

                InventoryDetailsAttribute::create([
                    'product_id',
                    'inventory_details_id',
                    'attribute_name',
                    'attribute_value',
                ]);
            }
        }
    }

    public function removeInventoryVariant(Request $request) {
        $inventory_details = ProductInventoryDetails::find($request->variant_id);

        if ($inventory_details) {
            $deleted = $inventory_details->delete();
            return response()->json([
                'type' => $deleted ? 'success' : 'error',
                'msg' => $deleted ? __('Variant deleted!') : __('Something went wrong!')]
            );
        }

        return response()->json(['type' => 'error', 'msg' => __('Something went wrong!')]);
    }

    private function getRequestAttributeData($field_name, $key) : string
    {
        return trim(sanitize_html(optional(request()->$field_name)[$key]));
    }
}
