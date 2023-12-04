{{-- New Brand --}}
<div class="new-brand section-bg-1 pt-50 pb-50">
    <div class="container custom-container-1318">
        <div class="row">
            <div class="col-lg-7">
                <div class="simple-cart">

                    {{-- Title --}}
                    <div class="product-tittle  mb-20">
                        <h5 class="title">{{ $category_one_prd->title }}</h5>
                    </div>

                    {{-- Slider --}}
                    <div class="new-brand-slider arrow-style-one mb-40">
                        @foreach($category_one_prd?->product as $product)
                            <x-product-style.grid-style-one :product="$product" />
                        @endforeach
                    </div>

                    {{-- Slider --}}
                    {{-- Title --}}
                    <div class="product-tittle  mb-20">
                        <h5 class="title">{{ $category_three_prd->title }}</h5>
                    </div>
                    <div class="new-brand-slider2 arrow-style-one">
                        @php
                            // first I need to get all total product number
                            $products = $category_three_prd?->product;
                            $product_count = $products?->count() ?? 0;
                            // get separated items
                            $separated_items = round($product_count / 9);
                        @endphp

                        @for($i = 0; $i < $separated_items; $i++)
                            <div class="single-feature-cat simple-cart">
                                <div class="feature-cat-products flex-content">
                                    @foreach($products->skip($i * 9)->take(($i * 9) + 9) as $product)
                                        <div class="smal-product-img">
                                            <a href="{{ route('frontend.products.single',$product->slug) }}" class="product-img">
                                                {!! render_image($product->singleImage) !!}
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>


            </div>
            <div class="col-lg-5">
                <div class="simple-cart height-480 mb-24">
                    {{-- Title --}}
                    <div class="product-tittle  mb-20">
                        <h5 class="title">{{ $category_two_prd->title }}</h5>
                    </div>

                    {{-- Slider --}}
                    <div class="top-brand-slider arrow-style-one ">
                        @foreach($category_two_prd?->product as $product)
                            <x-product-style.list-style-one :product="$product" />
                        @endforeach
                    </div>
                </div>


                <div class="singleCart singleCartTwo mb-24 bgColorFour tilt-effect wow fadeInLeft" data-wow-delay="0.0s" style="visibility: visible; animation-delay: 0s; animation-name: fadeInLeft;">
                    <div class="itemsCaption">
                        <p class="itemsCap">{{ $banner["title"] }}</p>
                        <h5><a href="#" class="itemsTittle">{{ $banner["sub_title"] }}</a></h5>
                        <div class="btn-wrapper">
                            <a href="{{ $banner["btn_url"] }}" class="cmn-btn0">{{ $banner["btn_text"] }}</a>
                        </div>
                    </div>
                    <div class="itemsImg wow fadeInUp h-0" data-wow-delay="0.0s" style="visibility: visible; animation-delay: 0s; animation-name: fadeInUp;">
                        {!! render_image_markup_by_attachment_id($banner["image"]) !!}
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
