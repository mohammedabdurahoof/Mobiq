<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductUnit extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['name'];

    protected static function newFactory()
    {
        return \Modules\Product\Database\factories\ProductUnitFactory::new();
    }
}
