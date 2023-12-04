{{-- footer area start --}}
<footer class="footer-area style-01">
    <div class="footer-top">
        <div class="container custom-container-1318">
            <div class="row">
                    {!! render_frontend_sidebar('footer', ['column' => true]) !!}
            </div>
        </div>
    </div>

{{--    <div class="footer-top-bottom">--}}
{{--        <div class="container custom-container-1318">--}}
{{--            <div class="row">--}}
{{--                <div class="col-lg-12">--}}
{{--                    <div class="d-flex align-items-center justify-content-between">--}}
{{--                        <div class="footer-social mt-30">--}}
{{--                            <a href="#" class="wow fadeInUp" data-wow-delay="0.1s"><i class="lab la-facebook-f"></i></a>--}}
{{--                            <a href="#" class="wow fadeInUp" data-wow-delay="0.2s" ><i class="lab la-instagram"></i></a>--}}
{{--                            <a href="#" class="wow fadeInUp" data-wow-delay="0.3s" ><i class="lab la-linkedin-in"></i></a>--}}
{{--                            <a href="#" class="wow fadeInUp" data-wow-delay="0.4s"><i class="lab la-youtube"></i></a>--}}
{{--                        </div>--}}
{{--                        --}}
{{--                        <div class="footer-logo">--}}
{{--                            <a href="http://localhost/shopmart">--}}
{{--                                <img src="http://localhost/shopmart/assets/uploads/media-uploader/logo1637646741.png" alt="">--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-lg-12">--}}
{{--                    <div class="payment-getway mb-20">--}}
{{--                        <img src="{{ asset("assets/frontend/img/new/payment-1.png") }}" alt="img" class="w-100">--}}
{{--                        <img src="{{ asset("assets/frontend/img/new/payment-2.png") }}" alt="img" class="w-100">--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}


    <div class="footer-bottom">
        <div class="copyright-area">
            <div class="container custom-container-1318">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="copyright-area-inner">
                            <div class="single-copyright-item">
                                <p class="copyright">{!! purify_html_raw(get_footer_copyright_text()) !!}</p>
                            </div>
                            <ul class="listing">
                                <li class="listing-items"><a href="#">Privacy</a></li>
                                <li class="listing-items"><a href="#">Terms & Conditions</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</footer>
{{-- footer area end --}}




{{-- please don't tutch those line of code below --}}

{{-- new product modal - start --}}
<div class="modal product-quick-view-bg-color" id="product_quick_view" tabindex="-1" role="dialog" aria-labelledby="productModal"
     aria-hidden="true">

</div>

{{-- new product modal - start --}}
<div class="modal fade" id="quick_view" tabindex="-1" role="dialog" aria-labelledby="productModal" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content p-5">
            <div class="quick-view-close-btn-wrapper">
                <button class="quick-view-close-btn"><i class="las la-times"></i></button>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="product_details">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="product-view-wrap product-img">
                                    <ul class="other-content">
                                        <li>
                                            <span class="badge-tag"></span>
                                        </li>
                                        {{-- <li>
                                            <span class="discount-tag"></span>
                                        </li> --}}
                                    </ul>
                                    <img src="" alt="">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                 <div class="mb-2">
                                    <div class="flash-countdown-wrapper" style="display:none">
                                        <div class="flash-countdown-title-single">
                                            <h6 class="flash-countdown-title"></h6>
                                        </div>
                                        @php $random_str = Str::random(32);  @endphp
                                        <div class="flash-countdown-product-2 flash-countdown-product-quick-view-{{ $random_str }}"
                                             data-date="" id="flash-countdown-product-quick-view-{{ $random_str }}">
                                            <div class="single-box">
                                                <span class="counter-days item"></span>
                                                <span class="label item">{{ __('D') }}</span>
                                            </div>
                                            <div class="single-box">
                                                <span class="counter-hours item"></span>
                                                <span class="label item">{{ __('H') }}</span>
                                            </div>
                                            <div class="single-box">
                                                <span class="counter-minutes item"></span>
                                                <span class="label item">{{ __('M') }}</span>
                                            </div>
                                            <div class="single-box">
                                                <span class="counter-seconds item"></span>
                                                <span class="label item">{{ __('S') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-summery">
                                    <span class="product-meta pricing">
                                         <span id="unit"></span> <span id="uom"></span>
                                    </span>
                                    <h3 class="product-title title"></h3>
                                    <div>
                                        <span class="availability is_available">{{ __('In stock') }} (?)</span>
                                    </div>
                                    <div class="price-wrap">
                                        <span class="price sale_price font-weight-bold">{{amount_with_currency_symbol(0)}}</span>
                                        <del class="del-price del_price">{{amount_with_currency_symbol(0)}}</del>
                                    </div>
                                    <div class="rating-wrap ratings" style="display: none">
                                        <div class="ratings">
                                            <div class="rating-wrapper">
                                                <div class="rating-contents">
                                                    <div class="ratings">
                                                        <span class="hide-rating"></span>
                                                        <span class="show-rating" style="width: 100%"></span>
                                                    </div>
                                                    <p><span class="total-ratings">(0)</span></p>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="total-ratings">(0)</p>
                                    </div>
                                    <div class="short-description">
                                        <p class="info"></p>
                                    </div>
                                    <div class="cart-option"></div>
                                    <div class="category">
                                        <p class="name">{{ __('Category') }}: </p>
                                        <a href="#" class="product_category"></a>
                                    </div>
                                    <div class="product-details-tag-and-social-link">
                                        <div class="tag d-flex">
                                            <p class="name">{{ __('Subcategory') }}: </p>
                                            <div class="subcategory_container"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- new product modal - end --}}

<div class="scroll-to-top">
    <i class="las la-angle-up"></i>
</div>

@if(preg_match('/(xgenious)/',url('/')))
    <div class="buy-now-wrap">
        <ul class="buy-list">
            <li><a target="_blank"href="https://xgenious.com/docs/grenmart-organic-grocery-laravel-ecommerce/" data-container="body" data-toggle="popover" data-placement="left" data-content="{{__('Documentation')}}"><i class="lar la-file-alt"></i></a></li>
            <li><a target="_blank"href="https://1.envato.market/kj2GdL"><i class="las la-shopping-cart"></i></a></li>
            <li><a target="_blank"href="https://xgenious51.freshdesk.com/"><i class="las la-headset"></i></a></li>
        </ul>
    </div>
@endif

<script src="{{ asset('assets/frontend/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/jquery-migrate.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/bootstrap.min-v5.0.2.js') }}"></script>
<script src="{{ asset('assets/frontend/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/slick.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/jquery.fancybox.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/loopcounter.js') }}"></script>
<script src="{{ asset('assets/frontend/js/wow.js') }}"></script>
<script src="{{ asset('assets/frontend/js/lazy.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/lazy.plugin.js') }}"></script>
<script src="{{ asset('assets/frontend/js/main.js') }}"></script>

@include('frontend.partials.google-captcha')
@include('frontend.partials.gdpr-cookie')
@include('frontend.partials.inline-script')
@include('frontend.partials.twakto')
<x-sweet-alert-msg/>
@yield('scripts')

<script src="{{ asset('assets/common/js/toastr.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/jquery.nicescroll.min.js') }}"></script>
@include('frontend.partials.scripts.footer-scripts')

</body>
</html>
