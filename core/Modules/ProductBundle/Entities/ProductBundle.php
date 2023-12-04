<?php

namespace Modules\ProductBundle\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductBundle extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category'
    ];
    
    protected static function newFactory()
    {
        return \Modules\ProductBundle\Database\factories\ProductBundleFactory::new();
    }
}
