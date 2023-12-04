<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductInventoryDetails extends Model
{
    use HasFactory;
    protected $fillable = [
        'inventory_id',
        'product_id',
        'hash', // used to find product based on selected attributes
        'color',
        'size',
        'additional_price',
        'image',
        'stock_count',
        'sold_count',
    ];

    public function productColor() {
        return $this->belongsTo(ProductColor::class, 'color', 'id');
    }

    public function productSize() {
        return $this->belongsTo(ProductSize::class, 'size', 'id');
    }

    public function includedAttributes()
    {
        return $this->hasMany(InventoryDetailsAttribute::class, 'inventory_details_id', 'id');
    }
}
