<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MobileCampaign extends Model
{
    use HasFactory;
    protected $fillable = ['type','campaign_id'];

    public $timestamps = false;
}
