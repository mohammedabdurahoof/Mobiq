<div class="faq-area-wrapper" data-padding-top="{{ $settings['padding_top'] }}"  data-padding-bottom="{{ $settings['padding_bottom'] }}">
    <div class="container custom-container-1318">
        <div class="row">
            <div class="col-md-6 col-lg-6">
                <div class="faq-accordion">
                    <div class="accordion" id="faq_accordion">
                        @foreach($faq_items as $faq)
                        <div class="card">
                            <div class="card-header" id="heading{{ $faq->id }}">
                                <h5 class="mb-0">
                                    <a href="#" class="accordion-btn btn-link" data-toggle="collapse"
                                       data-target="#collapse{{ $faq->id }}" aria-expanded="<?php echo $loop->first ? "true" : "false"; ?>" aria-controls="collapse{{ $faq->id }}">
                                        {{ $faq->title }}
                                        <span class="color-1">
                                                <i class="las la-plus open"></i>
                                                <i class="las la-minus close"></i>
                                            </span>
                                    </a>
                                </h5>
                            </div>

                            <div id="collapse{{ $faq->id }}" class="collapse @if($loop->first) show @endif" aria-labelledby="heading{{ $faq->id }}"
                                 data-parent="#faq_accordion">
                                <div class="card-body">
                                    <p class="info">{{ $faq->description }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6">
                <div class="faq-form-wrapper">
                    <h3 class="faq-form-title">{{ $ask_question_form_title }}</h3>
                    <div class="faq_container mt-4">
                        {!! $custom_form_markup !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>