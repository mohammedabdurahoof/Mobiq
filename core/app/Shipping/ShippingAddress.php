<?php

namespace App\Shipping;

use App\Country\Country;
use App\Country\State;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'user_id',
        'country_id',
        'state_id',
        'city',
        'zip_code',
        'address',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }
}
