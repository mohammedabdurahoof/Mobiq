<!-- Our Branding S t a r t-->
<div class="ourBranding section-padding2 mt-50 mb-50">
    <div class="container custom-container-1318">
        <div class="row justify-content-center">
            <div class="col-xl-7 col-lg-10 col-md-10 col-sm-10">
                <div class="section-tittle section-tittle2 text-center mb-40">
                    <h2 class="tittle">{{ $title }}</h2>
                </div>
            </div>
        </div>
        <div class="row ">
            <div class="col-xl-12">
                <div class="brandWrapper wrapperStyleOne brand-slider-active">
                    @foreach($brands["image_"] as $brand)
                        <div class="client-single wow fadeInLeft" data-wow-delay="0.{{ $loop->iteration }}s">
                            {!! render_image_markup_by_attachment_id($brand) !!}
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<!--  End-of Branding-->