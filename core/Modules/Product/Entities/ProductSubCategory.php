<?php

namespace Modules\Product\Entities;

use App\MediaUpload;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ProductSubCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'status',
        'image',
        'category_id'
    ];

    public function subCategoryImage(): HasOne
    {
        return $this->hasOne(MediaUpload::class, "id","image");
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class);
    }
}
