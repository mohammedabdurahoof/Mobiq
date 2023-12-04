<!-- branding-product S t a r t -->
<section class="branding-product pt-50 pb-40 mt-50 section-bg-1">
    <div class="container custom-container-1318">
        <div class="row">
            <div class="col-xl-5 col-lg-7 ">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="section-title-wrapper-03">
                            <h2 class="section-title">{{ $left_category->title }}</h2>
                        </div>

                        @foreach($left_category->product as $product)
                            <x-product-style.list-style-one :product="$product"/>
                        @endforeach
                    </div>
                </div>

            </div>
            <div class="col-xl-7 col-lg-5">
                <div class="section-title-wrapper-03">
                    <h2 class="section-title">{{ $right_category->title }}</h2>
                </div>
                <div class="row">
                    @foreach($right_category->product as $product)
                        <div class="col-xl-4">
                            <x-product-style.grid-style-one :product="$product"/>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
</section>
<!-- End-of branding-product -->
