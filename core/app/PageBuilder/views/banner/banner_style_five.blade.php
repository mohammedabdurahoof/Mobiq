<div class="add-banner-y-area-wrapper index-02" data-padding-top="{{ $settings['padding_top'] }}"  data-padding-bottom="{{ $settings['padding_bottom'] }}">
    <div class="container custom-container-1318">
        <div class="row">
            @foreach($settings['banner_style_five']['background_image_'] as $key => $image)
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="add-banner-y-style-01">
                        <a href="{{ \App\traits\URL_PARSE::url($settings['banner_style_five']['button_url_'][$key]) }}">
                            {!! render_image_markup_by_attachment_id($image, '', 'full', true, false) !!}
                        </a>
                        <div class="content">
                            <span class="sub-title">{{ $settings['banner_style_five']['subtitle_'][$key] }}</span>
                            <h4 class="title">{{ $settings['banner_style_five']['title_'][$key] }}</h4>
                            <h5 class="offer-title">{{ $settings['banner_style_five']['discount_text_'][$key] }}</h5>
                            <div class="btn-wrapper">
                                <a href="{{ \App\traits\URL_PARSE::url($settings['banner_style_five']['button_url_'][$key]) }}" class="shop-now-btn-style-01">{{ $settings['banner_style_five']['button_text_'][$key] }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
