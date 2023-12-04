{{--@dd($product_types["category_"])--}}


{{-- Featured Product --}}
<div class="featured-product section-bg-1">
    <div class="container custom-container-1318">
        <div class="row">
            <div class="col-lg-12">
                {{-- Title --}}
                <div class="product-tittle  mb-20">
                    <h5 class="title">{{ $section_title }}</h5>
                </div>
                <div class="featured-product-slider3 arrow-style-one  mb-24">
                    @for($i = 0;$i < count($product_types["category_"] ?? []) ?? 0; $i++)
                        @if($product_types["layout_type_"][$i] == 'type_one')
                            @php
                                $category_id = $product_types["category_"][$i];
                                $products = \Modules\Product\Entities\Product::select('id','image','slug','title','status')->with(['singleImage','category'])
                                ->where("status","publish")
                                ->without(['inventory', 'campaign' ,'rating','campaignProduct'])
                                ->when(!empty($product_types["category_"][$i]), function ($query) use ($category_id){
                                    $query->where('category_id', $category_id);
                                })->take(4)->get();
                            @endphp

                            <div class="single-feature-cat simple-cart">
                                <div class="product-tittle flex-content mb-20">
                                    <h5 class="title">{{ $products->first()?->category?->title }}</h5>
                                    <a href="#" class="pro-btn">View All</a>
                                </div>
                                <div class="feature-cat-products flex-content">
                                    <div class="smal-product-img">
                                        @foreach($products as $product)
                                            @if(!$loop->first)
                                                <a href="{{ route("frontend.products.single",$product->slug) }}" class="product-img">
                                                    {!! render_image($product->singleImage) !!}
                                                </a>
                                            @endif
                                        @endforeach
                                    </div>

                                    <div class="big-product-img">
                                        <a href="{{ route("frontend.products.single",$products->first()?->slug) }}" class="product-img">
                                            {!! render_image($products->first()?->singleImage) !!}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @elseif($product_types["layout_type_"][$i] == 'type_two')
                            @php
                                $category_id = $product_types["category_"][$i];
                                $products = \Modules\Product\Entities\Product::select('id','image','slug','title','status')->with(['singleImage','category'])
                                ->where("status","publish")
                                ->without(['inventory', 'campaign' ,'rating','campaignProduct'])
                                ->when(!empty($product_types["category_"][$i]), function ($query) use ($category_id){
                                    $query->where('category_id', $category_id);
                                })->take(9)->get();
                            @endphp

                            <div class="single-feature-cat simple-cart">
                                <div class="product-tittle flex-content mb-20">
                                    <h5 class="title">{{ $products->first()?->category?->title }}</h5>
                                    <a href="#" class="pro-btn">View All</a>
                                </div>
                                <div class="feature-cat-products flex-content">
                                    @foreach($products as $product)
                                        <div class="smal-product-img">
                                            <a href="{{ route("frontend.products.single",$product->slug) }}"
                                               class="product-img">
                                                {!! render_image($product->singleImage) !!}
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @endfor
                </div>
            </div>
        </div>
    </div>
</div>

                    {{-- feature-cat-products --}}
{{--                    <div class="single-feature-cat simple-cart mb-24">--}}
{{--                        <div class="product-tittle flex-content mb-20">--}}
{{--                            <h5 class="title">Sunglasses</h5>--}}
{{--                            <a href="#" class="pro-btn">View All</a>--}}
{{--                        </div>--}}

{{--                        <div class="feature-cat-products flex-content">--}}
{{--                            <div class="smal-product-img">--}}
{{--                                <a href="#" class="product-img">--}}
{{--                                    <img src="{{ asset("assets/frontend/img/new/sun-glass1.png") }}" alt="">--}}
{{--                                </a>--}}
{{--                                <a href="#" class="product-img">--}}
{{--                                    <img src="{{ asset("assets/frontend/img/new/sun-glass2.png") }}" alt="">--}}
{{--                                </a>--}}
{{--                                <a href="#" class="product-img">--}}
{{--                                    <img src="{{ asset("assets/frontend/img/new/sun-glass3.png") }}" alt="">--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                            <div class="smal-product-img">--}}
{{--                                <a href="#" class="product-img">--}}
{{--                                    <img src="{{ asset("assets/frontend/img/new/sun-glass4.png") }}" alt="">--}}
{{--                                </a>--}}
{{--                                <a href="#" class="product-img">--}}
{{--                                    <img src="{{ asset("assets/frontend/img/new/sun-glass5.png") }}" alt="">--}}
{{--                                </a>--}}
{{--                                <a href="#" class="product-img">--}}
{{--                                    <img src="{{ asset("assets/frontend/img/new/sun-glass6.png") }}" alt="">--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                            <div class="smal-product-img">--}}
{{--                                <a href="#" class="product-img">--}}
{{--                                    <img src="{{ asset("assets/frontend/img/new/sun-glass7.png") }}" alt="">--}}
{{--                                </a>--}}
{{--                                <a href="#" class="product-img">--}}
{{--                                    <img src="{{ asset("assets/frontend/img/new/sun-glass8.png") }}" alt="">--}}
{{--                                </a>--}}
{{--                                <a href="#" class="product-img">--}}
{{--                                    <img src="{{ asset("assets/frontend/img/new/sun-glass9.png") }}" alt="">--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    --}}{{-- feature-cat-products --}}
{{--                    <div class="single-feature-cat simple-cart">--}}
{{--                        <div class="product-tittle flex-content mb-20">--}}
{{--                            <h5 class="title">Dress</h5>--}}
{{--                            <a href="#" class="pro-btn">View All</a>--}}
{{--                        </div>--}}
{{--                        <div class="feature-cat-products flex-content">--}}
{{--                            <div class="smal-product-img">--}}
{{--                                <a href="#" class="product-img">--}}
{{--                                    <img src="{{ asset("assets/frontend/img/new/dress5.png") }}" alt="">--}}
{{--                                </a>--}}
{{--                                <a href="#" class="product-img">--}}
{{--                                    <img src="{{ asset("assets/frontend/img/new/dress6.png") }}" alt="">--}}
{{--                                </a>--}}
{{--                                <a href="#" class="product-img">--}}
{{--                                    <img src="{{ asset("assets/frontend/img/new/dress7.png") }}" alt="">--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                            <div class="big-product-img">--}}
{{--                                <a href="#" class="product-img">--}}
{{--                                    <img src="{{ asset("assets/frontend/img/new/dress8.png") }}" alt="">--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    --}}{{-- feature-cat-products --}}
{{--                    <div class="single-feature-cat simple-cart">--}}
{{--                        <div class="product-tittle flex-content mb-20">--}}
{{--                            <h5 class="title">Loafer</h5>--}}
{{--                            <a href="#" class="pro-btn">View All</a>--}}
{{--                        </div>--}}
{{--                        <div class="feature-cat-products flex-content">--}}
{{--                            <div class="smal-product-img">--}}
{{--                                <a href="#" class="product-img">--}}
{{--                                    <img src="{{ asset("assets/frontend/img/new/loafer1.png") }}" alt="">--}}
{{--                                </a>--}}
{{--                                <a href="#" class="product-img">--}}
{{--                                    <img src="{{ asset("assets/frontend/img/new/loafer2.png") }}" alt="">--}}
{{--                                </a>--}}
{{--                                <a href="#" class="product-img">--}}
{{--                                    <img src="{{ asset("assets/frontend/img/new/loafer3.png") }}" alt="">--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                            <div class="smal-product-img">--}}
{{--                                <a href="#" class="product-img">--}}
{{--                                    <img src="{{ asset("assets/frontend/img/new/loafer4.png") }}" alt="">--}}
{{--                                </a>--}}
{{--                                <a href="#" class="product-img">--}}
{{--                                    <img src="{{ asset("assets/frontend/img/new/loafer5.png") }}" alt="">--}}
{{--                                </a>--}}
{{--                                <a href="#" class="product-img">--}}
{{--                                    <img src="{{ asset("assets/frontend/img/new/loafer6.png") }}" alt="">--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                            <div class="smal-product-img">--}}
{{--                                <a href="#" class="product-img">--}}
{{--                                    <img src="{{ asset("assets/frontend/img/new/loafer7.png") }}" alt="">--}}
{{--                                </a>--}}
{{--                                <a href="#" class="product-img">--}}
{{--                                    <img src="{{ asset("assets/frontend/img/new/loafer8.png") }}" alt="">--}}
{{--                                </a>--}}
{{--                                <a href="#" class="product-img">--}}
{{--                                    <img src="{{ asset("assets/frontend/img/new/loafer9.png") }}" alt="">--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    --}}{{-- feature-cat-products --}}
{{--                    <div class="single-feature-cat simple-cart mb-24">--}}
{{--                        <div class="product-tittle flex-content mb-20">--}}
{{--                            <h5 class="title">Sunglasses</h5>--}}
{{--                            <a href="#" class="pro-btn">View All</a>--}}
{{--                        </div>--}}

{{--                        <div class="feature-cat-products flex-content">--}}
{{--                            <div class="smal-product-img">--}}
{{--                                <a href="#" class="product-img">--}}
{{--                                    <img src="{{ asset("assets/frontend/img/new/sun-glass1.png") }}" alt="">--}}
{{--                                </a>--}}
{{--                                <a href="#" class="product-img">--}}
{{--                                    <img src="{{ asset("assets/frontend/img/new/sun-glass2.png") }}" alt="">--}}
{{--                                </a>--}}
{{--                                <a href="#" class="product-img">--}}
{{--                                    <img src="{{ asset("assets/frontend/img/new/sun-glass3.png") }}" alt="">--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                            <div class="smal-product-img">--}}
{{--                                <a href="#" class="product-img">--}}
{{--                                    <img src="{{ asset("assets/frontend/img/new/sun-glass4.png") }}" alt="">--}}
{{--                                </a>--}}
{{--                                <a href="#" class="product-img">--}}
{{--                                    <img src="{{ asset("assets/frontend/img/new/sun-glass5.png") }}" alt="">--}}
{{--                                </a>--}}
{{--                                <a href="#" class="product-img">--}}
{{--                                    <img src="{{ asset("assets/frontend/img/new/sun-glass6.png") }}" alt="">--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                            <div class="smal-product-img">--}}
{{--                                <a href="#" class="product-img">--}}
{{--                                    <img src="{{ asset("assets/frontend/img/new/sun-glass7.png") }}" alt="">--}}
{{--                                </a>--}}
{{--                                <a href="#" class="product-img">--}}
{{--                                    <img src="{{ asset("assets/frontend/img/new/sun-glass8.png") }}" alt="">--}}
{{--                                </a>--}}
{{--                                <a href="#" class="product-img">--}}
{{--                                    <img src="{{ asset("assets/frontend/img/new/sun-glass9.png") }}" alt="">--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>
            </div>
        </div>
    </div>
</div>
{{-- End --}}