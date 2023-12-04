<div class="shop-wrapper category_filter_section" data-items="{{ $items }}" data-padding-top="{{ $settings['padding_top'] }}"  data-padding-bottom="{{ $settings['padding_bottom'] }}">
    <div class="container custom-container-1318">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-wrapper">
                    <h2 class="section-title">{{ $section_title }}</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="btn-list-wrapper">
                    <ul class="btn-list btn-wrapper">
                        @foreach($categories as $category)
                            <li class="category_item" data-catid="{{ $category->id }}">{{ $category->title }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="grid-wrapper category_filter_section_product_container">
            @foreach($all_products as $product)
                <div class="single-grid">
                    <x-product-style.grid-style-one :product="$product" />
                </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="btn-wrapper text-center margin-top-40">
                    <a href="{{ url("shop-page") }}" class="btnBorder2 big-btn">Explore  all</a>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- script location: components/frontend/page-builder/product-category-filter-one --}}
