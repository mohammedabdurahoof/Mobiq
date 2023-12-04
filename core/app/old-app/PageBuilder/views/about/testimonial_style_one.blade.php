<div class="testimonial-area-wrapper" data-padding-top="{{ $padding_top }}"  data-padding-bottom="{{ $padding_bottom }}">
    <div class="container custom-container-1318">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-wrapper">
                    <h2 class="section-title">{{ $title }}</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="testimonial-slider-inst">
                    @foreach($testimonials['review_'] as $review)
                        <div class="single-testimonial-item">
                            <div class="top-box">
                                <p class="info">{{ $review }}</p>
                            </div>
                            <div class="bottom-box">
                                <div class="img-box">
                                    {!! render_image_markup_by_attachment_id($testimonials['image_'][$loop->index]) !!}
                                </div>
                                <h4 class="name">{{ $testimonials['name_'][$loop->index] }}</h4>
                                <p class="post">{{ $testimonials['position_'][$loop->index] }}, {{ $testimonials['institution_'][$loop->index] }}</p>
                                <div class="icon-wrap">
                                    {!! ratingMarkup($testimonials['rating_'][$loop->index], '', false) !!}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
