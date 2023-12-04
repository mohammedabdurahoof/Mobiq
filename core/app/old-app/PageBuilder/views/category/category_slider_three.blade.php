{{-- categories Product --}}
<div class="categeries-product-style section-bg-1">
    <div class="container custom-container-1318">
        <div class="row">
            <div class="col-lg-12">
                {{-- Title --}}
                <div class="product-tittle  mb-20">
                    <h5 class="title">{{ $section_title }}</h5>
                </div>
                <div class="categories-product-slider arrow-style-one mb-24">
                    @foreach($categories as $category)
                            <?php
                                $category_route = route('frontend.products.category', [
                                    'id' => optional($category)->id,
                                    'slug' => \Str::slug(optional($category)->title ?? '')
                                ]);
                            ?>
                            <div class="single-cat-style simple-cart">
                                <div class="feature-cat-products mb-10">
                                    <div class="big-product-img imgEffect">
                                        <a href="{{ $category_route }}" class="product-img">
                                            {{-- <img src="{{ asset("assets/frontend/img/new/dress4.png") }}" alt=""> --}}
                                            {!! render_image($category->singleImage) !!}
                                        </a>
                                    </div>
                                </div>
                                <a href="{{ $category_route }}" class="pro-btn m-0">See More</a>
                            </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
{{-- End --}}

{{--<!-- random product area end -->--}}
{{--<div class="random-product-area-wrapper" data-padding-top="{{ $padding_top }}" data-padding-bottom="{{ $padding_bottom }}">--}}
{{--    <div class="container custom-container-1618">--}}
{{--        <div class="row">--}}

{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--<!-- random product area start -->--}}
{{--@foreach($categories as $category)--}}
{{--        <?php--}}
{{--        $category_route = route('frontend.products.category', [--}}
{{--            'id' => optional($category)->id,--}}
{{--            'slug' => \Str::slug(optional($category)->title ?? '')--}}
{{--        ]);--}}
{{--        ?>--}}
{{--    <div class="col-sm-6 col-md-4 col-lg-3">--}}
{{--        <div class="single-random-item">--}}
{{--            <div class="tag-box">--}}
{{--                <a href="{{ $category_route }}" class="tag">{{ html_entity_decode(optional($category)->title) }}</a>--}}
{{--            </div>--}}
{{--            <a href="{{ $category_route }}">--}}
{{--                <span class="product-bg-img bg-size-cover" {!! render_background_image_markup_by_attachment_id(optional($category)->image) !!} data-width="100%" data-height="400"></span>--}}
{{--            </a>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endforeach--}}