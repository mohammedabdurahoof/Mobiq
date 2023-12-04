<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MobileSlider extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ["title","description","image_id","button_text","url","type","campaign","category"];
}
