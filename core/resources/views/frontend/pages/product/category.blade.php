@extends('frontend.frontend-page-master')
@section('page-title')
    {{__('Category:')}} {{$category_name}}
@endsection
@section('site-title')
    {{__('Category:')}} {{$category_name}}
@endsection
@section('style')
    <style>
        .sub-category-button img{
            width: 40px;
            margin-right: 8px;
        }

        .sub-category-button:hover{
            border: 1.5px solid var(--main-color-one);
        }
    </style>
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
                    <div class="d-flex align-items-center gap-4">
                        @foreach($category->subcategory as $subCat)
                            <a class="btn btn-sm sub-category-button" href="{{ route('frontend.products.subcategory', [
                               'id' => $subCat->id,
                               'any' => \Str::slug($subCat->title ?? '')
                           ]) }}">
                                {!! render_image($subCat->subCategoryImage) !!}
                                {{ $subCat->title }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

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
