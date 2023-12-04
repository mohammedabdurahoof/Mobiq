@extends('frontend.frontend-page-master')
@section('page-title')
    {{ __('Products')  }}
@endsection

@section('site-title')
    {{ __('Product Page')  }}
@endsection

@section("style")
    <style>
        a.reset-search-form-button.btn.btn-danger {
            position: relative;
            top: -3px;
        }
    </style>
@endsection

@section('content')
    @php $item_width = 'col-lg-4'; @endphp

    <div class="shop-grid-area-wrapper left-sidebar padding-100">
        <div class="container custom-container-1318">
            <div class="row flex-row-reverse">
                <div class="col-md-4 col-lg-3">
                    @include('frontend.partials.product.product-filter-sidebar')
                </div>
                <div class="col-md-8 col-lg-9">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="toolbox-wrapper toolbox-wrapper01">
                                <div class="toolbox-left">
                                    <div class="toolbox-item">
                                        @php
                                            $pagination_summary = getPaginationSummaryText($all_products);
                                        @endphp

                                        @if($pagination_summary['end'] > 0)
                                            <p class="showing">{{ __('Showing') }} {{ $pagination_summary['start'] }}–{{ $pagination_summary['end'] }}
                                                {{ __('of') }} {{ $pagination_summary['total'] }} {{ __('results') }}</p>
                                        @else
                                            <p class="showing">{{ __("No result found") }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="toolbox-right">
                                    <div class="toolbox-item toolbox-sort">
                                        <select id="set_item_sort_by" class="select-box">
                                            <option value="default" @if(isset($sort_by) && $sort_by == 'default') selected @endif>{{ __('Default sorting') }}</option>
                                            <option value="popularity" @if(isset($sort_by) && $sort_by == 'popularity') selected @endif>{{ __('Sort by popularity') }}</option>
                                            <option value="rating" @if(isset($sort_by) && $sort_by == 'rating') selected @endif>{{ __('Sort by rating') }}</option>
                                            <option value="latest" @if(isset($sort_by) && $sort_by == 'latest') selected @endif>{{ __('Sort by latest') }}</option>
                                            <option value="price_low" @if(isset($sort_by) && $sort_by == 'price_low') selected @endif>{{ __('Sort by price: low to high') }}</option>
                                            <option value="price_high" @if(isset($sort_by) && $sort_by == 'price_high') selected @endif>{{ __('Sort by price: high to low') }}</option>
                                        </select>
                                    </div>
                                    <div class="toolbox-item toolbox-layout">
                                        <ul class="layout-list">
                                            <li class="layout-item">
                                                <a href="{{ route('frontend.products.all', ['s' => 'grid']) }}"
                                                   class="grid-layout @if($item_style == 'grid') current @endif"
                                                   data-style="grid"
                                                >
                                                    <i class="las la-border-all icon"></i>
                                                </a>
                                            </li>
                                            <li class="layout-item">
                                                <a href="{{ route('frontend.products.all', ['s' => 'list']) }}" class="list-layout @if($item_style == 'list') current @endif" data-style="list">
                                                    <i class="las la-list icon"></i>
                                                </a>
                                            </li>
                                            <li class="layout-item">
                                                <a href="javascript:void(0)"
                                                   class="reset-search-form-button btn btn-danger"
                                                >
                                                    <i class="las la-redo-alt icon"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach($all_products as $product)
                            @if($item_style == 'grid')
                                <div class="col-6 col-sm-3 col-md-4">
                                    <x-product-style.grid-style-one :product="$product" />
                                </div>
                            @else
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <x-product-style.list-style-one :product="$product" />
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="pagination margin-top-30">
                                @if($all_products->count() > 0)
                                    {!! $all_products->withQueryString()->links() !!}
                                @else
                                    <h1 class="no-product-found-title text-danger">
                                        {{ __("No product found") }}
                                    </h1>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- searched values --}}
    @include('frontend.partials.product.product-filter-form')
@endsection
@section('scripts')
    @include('frontend.partials.product.product-filter-script')
@endsection
