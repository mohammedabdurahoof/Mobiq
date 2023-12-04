<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $table = 'pages';
    protected $fillable = [
        'title',
        'slug',
        'meta_tags',
        'meta_description',
        'content',
        'status',
        'visibility',
        'page_builder_status',
        'page_container_option',
        'navbar_category_dropdown_open',
        'navbar_variant',
        'breadcrumb_status',
    ];
}
