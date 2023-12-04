<div class="header-area-wrapper index-02" data-padding-top="{{ $padding_top }}" data-padding-bottom="{{ $padding_bottom }}">
    <div class="header-slider-inst-index-02">
        <div class="single-slider-item bg-index-02 lazy"
                {!! render_background_image_markup_by_attachment_id($background_image, 'full', true) !!}
        >
            <div class="shape" style="background-image: url('{{ asset('assets/frontend/img/header/shape.png') }}')"></div>
            <div class="container custom-container-1318">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="header-area">
                            <div class="content">
                                <h5 class="sub-title">{{ html_entity_decode($subtitle) }}</h5>
                                <h1 class="title">{{ html_entity_decode($title) }}</h1>
                                <p class="info">{!! $description !!}</p>
                                <div class="btn-wrapper">
                                    <a href="{{ $button_url }}" class="cmn-btn0">{{ $button_text }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
