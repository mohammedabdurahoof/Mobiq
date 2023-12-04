<?php

namespace App;

use App\Country\Country;
use App\Country\State;
use App\Shipping\UserShippingAddress;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable,HasFactory, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'image',
        'phone',
        'address',
        'country',
        'state',
        'city',
        'zipcode',
        'email_verified',
        'email_verify_token',
        'facebook_id',
        'google_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function shipping()
    {
        return $this->hasMany(UserShippingAddress::class);
    }

    public function country(){
        return $this->hasOne(Country::class,"id","country");
    }

    public function state(){
        return $this->hasOne(State::class,"id","state");
    }
}
