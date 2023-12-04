



{{-- Count Down Area --}}

<div class="count-down-area-wrapper mb-50  bg section-bg-1 wow fadeInUp" data-wow-delay="0.0s" data-padding-top="{{ $settings['padding_top'] }}"  data-padding-bottom="{{ $settings['padding_bottom'] }}"
        {{-- {!! render_background_image_markup_by_attachment_id($background_image, 'full', false) !!} --}}
>
    {{-- <div class="top-shape" style="background-image: url({{ asset('assets/frontend/img/banner/countdown-top.png') }})"></div>
    <div class="bottom-shape" style="background-image: url({{ asset('assets/frontend/img/banner/countdown-bottom.png') }})">
    </div> --}}
    {{-- <div class="left-shape">
        {!! render_image_markup_by_attachment_id($left_front_image, '', 'full', true) !!}
    </div> --}}
    {{-- <div class="right-shape">
        {!! render_image_markup_by_attachment_id($right_front_image, '', 'full', true) !!}
    </div> --}}
    <div class="container custom-container-1318">
        <div class="row align-items-start">
            <div class="col-xl-8 col-lg-5">
                <div class="row align-items-end justify-content-between">
                    <div class="col-xl-7 col-lg-12 col-md-6">
                        <div class="count-down-inner mb-40">
                            <div class="content">
                                <span class="offer wow fadeInUp" data-wow-delay="0.0s">{{ $subtitle }}</span>
                                <h3 class="title wow fadeInUp" data-wow-delay="0.1s">{{ str_replace('[brk]', '<br/>', $title) }}</h3>

                                <div class="flash-countdown-1 flash-countdown-style-1 wow fadeInUp" data-wow-delay="0.2s" data-date="{{\Carbon\Carbon::parse($end_date)->format('Y-m-d h:i:s')}}">
                                    <div class="single-box">
                                        <span class="counter-days item time">00</span>
                                        <span class="label item">{{__('Day')}}</span>
                                    </div>
                                    <div class="colon-wrap">
                                        <span class="colon">:</span>
                                    </div>
                                    <div class="single-box">
                                        <span class="counter-hours item time">00</span>
                                        <span class="label item">{{ __('Hour') }}</span>
                                    </div>
                                    <div class="colon-wrap">
                                        <span class="colon">:</span>
                                    </div>
                                    <div class="single-box">
                                        <span class="counter-minutes item time">00</span>
                                        <span class="label item">{{ __('Min') }}</span>
                                    </div>
                                    <div class="colon-wrap">
                                        <span class="colon">:</span>
                                    </div>
                                    <div class="single-box">
                                        <span class="counter-seconds item time">00</span>
                                        <span class="label item">{{ __('Sec') }}</span>
                                    </div>
                                </div>
                                <div class="btn-wrapper wow fadeInUp" data-wow-delay="0.4s">
                                    <a href="{{ \App\traits\URL_PARSE::url($button_url) }}" class="btnBorder2 big-btn">{{ $button_text }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-4 col-md-6 position-relative">
                        <div class="right-shape f-right wow fadeInRight" data-wow-delay="0.3s">
                            {!! render_image_markup_by_attachment_id($right_front_image, '', 'full', true) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6">
                @foreach($products as $product)
                    @php
                        // campaign data check
                        $campaign_product = !is_null($product->campaignProduct) ? $product->campaignProduct : getCampaignProductById($product->id);
                        $sale_price = $campaign_product ? optional($campaign_product)->campaign_price : $product->sale_price;
                        $deleted_price = !is_null($campaign_product) ? $product->sale_price : $product->price;
                        $campaign_percentage = !is_null($campaign_product) ? getPercentage($product->sale_price, $sale_price) : false;
                    @endphp
                    <div class="singleCart singleCartTwo mb-20 white-bg tilt-effect wow fadeInLeft" data-wow-delay="0.{{ $loop->iteration }}s" style="visibility: visible; animation-delay: 0s; animation-name: fadeInLeft;">
                        <div class="itemsCaption">
                            <p class="itemsCap">{{ round($campaign_percentage,2) }}% off</p>
                            <h5><a href="{{ route("frontend.products.single", $product->slug) }}" class="itemsTittle">{{ $product->title }}</a></h5>
                        </div>
                        <div class="itemsImg wow fadeInUp h-0" data-wow-delay="0.0s" style="visibility: visible; animation-delay: 0s; animation-name: fadeInUp;">
                            {!! render_image($product->singleImage) !!}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>