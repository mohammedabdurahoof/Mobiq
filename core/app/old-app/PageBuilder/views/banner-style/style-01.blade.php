<div class="product-cart mt-50">
    <div class="container custom-container-1318">
        <div class="row">
            @foreach($banners['title_'] as $key => $banner)
                <x-banner-style.style-one :title="$banner" :sub-title="$banners['sub_title_'][$key]" :image="$banners['image_'][$key]" :bg-color="$banners['bg_color_'][$key]" :loop="$loop"/>
            @endforeach
        </div>
    </div>
</div>
