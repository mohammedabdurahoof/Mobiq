@extends('frontend.frontend-page-master')
@section('page-title')
    {{$category_name}}
@endsection
@section('site-title')
    {{__('Subcategory:')}} {{$category_name}}
@endsection

@section('category-url')
    {{ route("frontend.products.category", $subCategory?->category?->id) }}
@endsection

@section('category-title')
    {{ __("Category: ") }} {{ $subCategory?->category?->title }}
@endsection

@section('page-meta-data')
    <meta name="description" content="{{get_static_option('product_page_'.$user_select_lang_slug.'_meta_description')}}">
    <meta name="tags" content="{{get_static_option('product_page_'.$user_select_lang_slug.'_meta_tags')}}">
@endsection
@section('content')
<div class="shop-grid-area-wrapper left-sidebar" id="shop">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    @foreach ($all_products as $product)
                        <div class="col-6 col-sm-6 col-md-6 col-lg-4 py-3">
                            <x-frontend.product.product-card :product="$product" />
                        </div>
                    @endforeach
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="pagination-default">
                            {!! $all_products->links() !!}
                        </div>
                    </div>
                </div>
                
                @if($all_products->total() < 1)
                    <div><h2 class="text-warning">{{__('no product found')}}</h2></div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
