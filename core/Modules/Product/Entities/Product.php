<?php

namespace Modules\Product\Entities;

use App\Campaign\CampaignProduct;
use App\MediaUpload;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'summary',
        'description',
        'category_id',
        'sub_category_id', // JSON
        'image',
        'product_image_gallery', // ===> Different Table | JSON <===
        'price',
        'sale_price',
        'tax_percentage',
        'uom',
        'unit',
        'badge',
        'status',
        'attributes', // JSON
        'sold_count',
        'created_by',
    ];

    protected $attributes = [];
    protected $with = ['inventory', 'campaign', 'category', 'rating','campaignProduct','singleImage'];
    protected $withCount = ['inventoryDetails'];

    public function singleImage(): hasOne
    {
        return $this->hasOne(MediaUpload::class,"id","image");
    }

    /** ======================================================
     *                      MUTATORs
      ====================================================== */
    public function setSubCategoryIdAttribute($value)
    {
        $this->attributes['sub_category_id'] = json_encode($value);
    }

    public function setProductImageGalleryAttribute($value)
    {
        $this->attributes['product_image_gallery'] = json_encode($value);
    }

    public function setAttributesAttribute($value)
    {
        $this->attributes['attributes'] = json_encode($value);
    }

    /** ======================================================
     *                      SCOPEs / FUNCTIONs
      ====================================================== */
    public function getSubcategory()
    {
        $all_subcategories = [];
        $subcategory_id_arr = (array) json_decode($this->sub_category_id, true);

        foreach ($subcategory_id_arr as $subcategory_id) {
            $subcategory = ProductSubCategory::find($subcategory_id);

            if ($subcategory) {
                $all_subcategories[] = $subcategory;
            }
        }
        return $all_subcategories;
    }

    function ratingAvg() {
        return $this->rating->avg('rating');
    }

    function ratingTotal() {
        return $this->rating->sum('rating');
    }

    function ratingCount() {
        return $this->rating->count();
    }



    /** ======================================================
     *                      RELATIONs
      ====================================================== */
    public function category()
    {
        return $this->belongsTo(ProductCategory::class,"category_id","id");
    }

    public function additionalInfo()
    {
        return $this->hasMany(ProductAdditionalInformation::class);
    }

    public function inventory()
    {
        return $this->hasOne(ProductInventory::class);
    }

    public function inventoryDetails()
    {
        return $this->hasMany(ProductInventoryDetails::class);
    }

    public function rating()
    {
        return $this->hasMany(ProductRating::class);
    }

    public function tags()
    {
        return $this->hasMany(ProductTag::class);
    }

    public function sold()
    {
        return $this->hasMany(ProductSellInfo::class, 'product_id', 'id');
    }

    public function campaign() {
        return $this->hasOne(CampaignProduct::class, 'product_id', 'id');
    }

    public function SaleDetails(){
        return $this->hasOne(SaleDetails::class, 'id', 'item_id');
    }

    public function campaignProduct()
    {
        return $this->hasOne(CampaignProduct::class, 'product_id', 'id');
    }
}
