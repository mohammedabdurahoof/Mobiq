<?php

namespace App\Product;

use App\MediaUpload;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;
    protected $with = ["singleImage"];
    protected $fillable = [
        'title',
        'status',
        'image'
    ];

    public function singleImage(){
        return $this->hasOne(MediaUpload::class,"id","image");
    }

    public function subcategory()
    {
        return $this->hasMany(ProductSubCategory::class, 'category_id', 'id');
    }

    public function product(){
        return $this->hasOne(Product::class,"category_id","id");
    }
}
