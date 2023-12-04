{{-- Deal Of The Week --}}
<div class="deal-week section-bg-1 pt-50">
    <div class="container custom-container-1318">
        <div class="row">
            <div class="col-lg-12">
                <div class="simple-cart mb-24">
                    {{-- Title --}}
                    <div class="product-tittle  mb-20">
                        <h5 class="title">{{ $section_title }}</h5>
                    </div>

                    {{-- Slider --}}
                    <div class="deal-week-slider arrow-style-one">
                        @foreach($products as $product)
                            <x-product-style.grid-style-one :product="$product" />
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- end --}}
