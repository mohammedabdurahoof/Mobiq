<?php

namespace App\Shipping;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingMethodOption extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'shipping_method_id',
        'status',
        'tax_status',
        'cost',
        'coupon',
        'setting_preset',
        'minimum_order_amount',
    ];

    protected $casts = [
        'cost' => 'float',
        'minimum_order_amount' => 'float',
    ];
}
