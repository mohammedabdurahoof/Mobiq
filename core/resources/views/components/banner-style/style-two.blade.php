<style>
    .bannerBgColor{{ $loop->iteration }} {
        background: {{ $bgColor }};
    }
</style>

<div class="col-xxl-4 col-xl-4 col-lg-6">
    <div class="singleCart singleCartTwo mb-24 bannerBgColor{{ $loop->iteration }} tilt-effect wow fadeInLeft" data-wow-delay="0.{{ $loop->iteration }}s">
        <div class="itemsCaption">
            <p class="itemsCap">{{ $title }}</p>
            <h5><a href="#" class="itemsTittle">{{ $subTitle }}</a></h5>
            <div class="btn-wrapper">
                <a href="{{ $btnUrl }}" class="btnBorder">{{ $btnText }}</a>
            </div>
        </div>
        <div class="itemsImg wow fadeInUp d-flex justify-content-center align-items-center" data-wow-delay="0.{{ $loop->iteration }}s">
            {!! render_image_markup_by_attachment_id($image) !!}
        </div>
    </div>
</div>