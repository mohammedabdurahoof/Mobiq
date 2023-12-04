<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'status',
        'image'
    ];

    public function subcategory(): HasMany
    {
        return $this->hasMany(ProductSubCategory::class, 'category_id', 'id');
    }

    function product(): HasMany
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
}
