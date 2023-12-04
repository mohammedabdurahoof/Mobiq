{{-- Feature Categories --}}
<div class="feature-categories-product section-bg-1 mt-30 pt-50 pb-50">
    <div class="container custom-container-1318">
        <div class="row">
            <div class="col-lg-3">
                <div class="single-feature-cat simple-cart mb-24">
                    <div class="product-tittle flex-content mb-20">
                        <h5 class="title">{{ $category_one_prd->title }}</h5>
                        <a href="{{ route('frontend.products.category',$category_one_prd->id) }}" class="pro-btn">View All</a>
                    </div>

                    <div class="feature-cat-products flex-content">
                        @php
                            $category_one_product = $category_one_prd?->product?->first();
                        @endphp
                        <div class="smal-product-img">
                            @foreach($category_one_prd?->product as $product)
                                @if($loop->iteration > 1)
                                    <a href="{{ route('frontend.products.single',$product->slug) }}" class="product-img">
                                        {!! render_image($product->singleImage) !!}
                                    </a>
                                @endif
                            @endforeach
                        </div>
                        <div class="big-product-img">

                            <a href="{{ route('frontend.products.single',$category_one_product->slug) }}" class="product-img">
                                {!! render_image($category_one_product->singleImage) !!}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="single-feature-cat simple-cart mb-24">
                    <div class="product-tittle flex-content mb-20">
                        <h5 class="title">{{ $category_two_prd->title }}</h5>
                        <a href="{{ route('frontend.products.category',$category_two_prd->id) }}" class="pro-btn">View All</a>
                    </div>

                    <div class="feature-cat-products flex-content">
                        @foreach($category_two_prd?->product as $product)
                            <div class="smal-product-img  mb-2">
                                <a href="{{ route('frontend.products.single',$product->slug) }}" class="product-img">
                                    {!! render_image($product->singleImage) !!}
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="single-feature-cat simple-cart mb-24">
                    <div class="product-tittle flex-content mb-20">
                        <h5 class="title">{{ $category_three_prd->title }}</h5>
                        <a href="{{ route('frontend.products.category',$category_three_prd->id) }}" class="pro-btn">View All</a>
                    </div>

                    <div class="feature-cat-products flex-content">
                        @php
                            $category_three_product = $category_three_prd?->product?->first();
                        @endphp
                        <div class="smal-product-img">
                            @foreach($category_three_prd?->product as $product)
                                @if($loop->iteration > 1)
                                    <a href="{{ route('frontend.products.single',$product->slug) }}" class="product-img">
                                        {!! render_image($product->singleImage) !!}
                                    </a>
                                @endif
                            @endforeach
                        </div>
                        <div class="big-product-img">

                            <a href="{{ route('frontend.products.single',$category_three_product->slug) }}" class="product-img">
                                {!! render_image($category_three_product->singleImage) !!}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="single-feature-cat simple-cart mb-24">
                    <div class="product-tittle flex-content mb-20">
                        <h5 class="title">{{ $category_for_prd->title }}</h5>
                        <a href="{{ route('frontend.products.category',$category_for_prd->id) }}" class="pro-btn">View All</a>
                    </div>

                    <div class="feature-cat-products flex-content">
                        @foreach($category_for_prd?->product as $product)
                            <div class="smal-product-img  mb-2">
                                <a href="{{ route('frontend.products.single',$product->slug) }}" class="product-img">
                                    {!! render_image($product->singleImage) !!}
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach($banners['title_'] as $key => $banner)
                <x-banner-style.style-two  :btn_text="$banners['btn_text_'][$key]" :btn_url="$banners['btn_url_'][$key]"
                        :title="$banner" :sub-title="$banners['sub_title_'][$key]"
                                          :image="$banners['image_'][$key]" :bg-color="$banners['bg_color_'][$key]" :loop="$loop"/>
            @endforeach
        </div>

    </div>
</div>
