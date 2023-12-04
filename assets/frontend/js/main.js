(function ($) {
    "use strict";



    jQuery(document).ready(function ($) {

        var rtlEnabled = $('html').attr('dir');
        var rtlEnable = !(typeof rtlEnabled === 'undefined' || rtlEnabled === 'ltr');

        $(".lazy").Lazy({
            scrollDirection: 'vertical',
            effect: "fadeIn",
            effectTime: 1000,
            threshold: 0,
            visibleOnly: false,
            onError: function (element) {
                console.log('error loading ' + element.data('src'));
            }
        });
		
        /*-------------------------------
		
		
        /*--------------------------------
           All category menu control
        --------------------------------*/
        if ($(window).width() < 992) {
            $(".mobile-style").removeClass("show");
        }

        if ($(window).width() < 768) {
            $(".index-03-catg").removeClass("show");
        }

        /*------------------
            back to top
        ------------------*/
        $(document).on('click', '.scroll-to-top', function() {
            $("html,body").animate({
                scrollTop: 0
            }, 1500);
        });
        
        /*--------------------------------
            Cart Quantity Control
        --------------------------------*/
        $(document).on('click', '.decrease', function (event) {
            event.preventDefault();
            let el = $(this);
            let parentWrap = el.parent();
            let qty = parentWrap.find('.qty_');
            let qtyVal = qty.val();
            if (qtyVal > 1) {
                qty.val(parseInt(qtyVal) - 1);
            }
        });

        $(document).on('click', '.increase', function (event) {
            event.preventDefault();
            let el = $(this);
            let parentWrap = el.parent();
            let qty = parentWrap.find('.qty_');
            let qtyVal = qty.val();
            if (qtyVal > 0) {
                qty.val(parseInt(qtyVal) + 1);
            }
        });

         /*------  fancybox ---*/
        /*--------------------------------*/
        $('[data-fancybox]').fancybox({
            toolbar: false,
            smallBtn: true,
            animationEffect: "zoom-in-out",
        });

            /* 4. WOW active */
            new WOW().init();
           
            
        /*------------------------------
            Header Slick Slider
        -------------------------------*/
        $('.header-slider-inst-index-01')
        .on('init', function(slick) {
            console.log('init')
            $('.header-slider-inst-index-01').css("overflow","visible");
        })
        .slick({
            infinite: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            lazyLoad: 'ondemand',
            speed: 1000,
            fade: true,
			dots: true,
            arrows: false,
            autoplay: true,
            rtl:rtlEnable,
            cssEase: 'linear',
            prevArrow: '<div class="prev-arrow"><i class="las la-angle-left"></i></div>',
            nextArrow: '<div class="next-arrow"> <i class="las la-angle-right"></i></div>',
        });

        /*------------------------------
            Category slider
        -------------------------------*/
        $('.category-slider-inst').slick({
            infinite: true,
            slidesToShow: 7,
            slidesToScroll: 1,
            speed: 800,
            arrows: true,
            autoplay: false,
            dots: false,
            rtl:rtlEnable,
            prevArrow: '<div class="prev-arrow"> <i class="las la-arrow-left"></i> </div>',
            nextArrow: '<div class="next-arrow"> <i class="las la-arrow-right"></i> </div>',
            responsive: [{
                breakpoint: 992,
                settings: {
                    slidesToShow: 5,
                    slidesToScroll: 1,
                }
            },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 1,
                    }
                },
//                {
//                    breakpoint: 576,
//                    settings: {
//                        slidesToShow: 2,
//                        slidesToScroll: 1,
//                    }
//                }
            ]
        });


        // Home Page 3 Slider
        function mainSlider() {
            var BasicSlider = $('.slider-active');
            BasicSlider.on('init', function (e, slick) {
            var $firstAnimatingElements = $('.single-slider:first-child').find('[data-animation]');
            doAnimations($firstAnimatingElements);
            });
            BasicSlider.on('beforeChange', function (e, slick, currentSlide, nextSlide) {
            var $animatingElements = $('.single-slider[data-slick-index="' + nextSlide + '"]').find('[data-animation]');
            doAnimations($animatingElements);
            });
            BasicSlider.slick({
            autoplay: true,
            autoplaySpeed: 4000,
            dots: true,
            fade: true,
            arrows: true, 
            prevArrow: '<button type="button" class="slick-prev"><i class="las la-long-arrow-alt-left"></i></button>',
            nextArrow: '<button type="button" class="slick-next"><i class="las la-long-arrow-alt-right"></i></button>',
            responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: true,
                }
                },
                {
                breakpoint: 991,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: true
                }
                },
                {
                breakpoint: 767,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: false,
                    dots: false
                }
                }
            ]
            });
    
            function doAnimations(elements) {
            var animationEndEvents = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
            elements.each(function () {
                var $this = $(this);
                var $animationDelay = $this.data('delay');
                var $animationType = 'animated ' + $this.data('animation');
                $this.css({
                'animation-delay': $animationDelay,
                '-webkit-animation-delay': $animationDelay
                });
                $this.addClass($animationType).one(animationEndEvents, function () {
                $this.removeClass($animationType);
                });
            });
            }
        }
      mainSlider();

      
        /*------------------------------
            Deal of the week index-02
        -------------------------------*/
        $('.deal-of-the-week-slider-inst-index-02').slick({
            infinite: true,
            slidesToShow: 5,
            slidesToScroll: 1,
            speed: 800,
            rtl:rtlEnable,
            arrows: true,
            autoplay: true,
            dots: false,
            prevArrow: '<div class="prev-arrow"> <i class="las la-chevron-left"></i> </div>',
            nextArrow: '<div class="next-arrow"> <i class="las la-chevron-right"></i> </div>',
            responsive: [{
                breakpoint: 1199,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 1,
                }
            },
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1,
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1,
                    }
                },
                {
                    breakpoint: 451,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                    }
                }

            ]
        });

        /*------------------------------
            custom product slider
        -------------------------------*/
        $('.custom-product-slider-inst').slick({
            infinite: true,
            slidesToShow: 4,
            slidesToScroll: 1,
            speed: 800,
            arrows: true,
            autoplay: false,
            rtl:rtlEnable,
            dots: false,
            prevArrow: '<div class="prev-arrow"> <i class="las la-chevron-left"></i> </div>',
            nextArrow: '<div class="next-arrow"> <i class="las la-chevron-right"></i> </div>',
            responsive: [{
                breakpoint: 1200,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                }
            },
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1,
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                    }
                }

            ]
        });

        /*------------------------------
           new-brand-slider
        -------------------------------*/
        $('.new-brand-slider').slick({
            infinite: true,
            slidesToShow: 3,
            slidesToScroll: 1,
            speed: 800,
            arrows: true,
            autoplay: false,
            dots: false,
            rtl:rtlEnable,
            prevArrow: '<div class="prev-arrow"> <i class="las la-long-arrow-alt-left"></i> </div>',
            nextArrow: '<div class="next-arrow"> <i class="las la-long-arrow-alt-right"></i> </div>',
            responsive: [{
                breakpoint: 992,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                }
            },
                {
                    breakpoint: 800,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1,
                    }
                },
                {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1,
                    }
                },
                {
                    breakpoint: 450,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1,
                    }
                }

            ]
        });

        /*------------------------------
           new-brand-slider 2
        -------------------------------*/
        $('.new-brand-slider2').slick({
            infinite: true,
            slidesToShow: 2,
            slidesToScroll: 1,
            speed: 800,
            arrows: true,
            autoplay: false,
            dots: false,
            rtl:rtlEnable,
            prevArrow: '<div class="prev-arrow"> <i class="las la-long-arrow-alt-left"></i> </div>',
            nextArrow: '<div class="next-arrow"> <i class="las la-long-arrow-alt-right"></i> </div>',
            responsive: [{
                breakpoint: 992,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                }
            },
                {
                    breakpoint: 800,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1,
                    }
                },
                {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                    }
                },
                {
                    breakpoint: 450,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                    }
                }

            ]
        });
        /*------------------------------
           new-brand-slider 3
        -------------------------------*/
        $('.featured-product-slider3').slick({
            infinite: true,
            slidesToShow: 4,
            slidesToScroll: 1,
            speed: 800,
            arrows: true,
            autoplay: false,
            dots: false,
            rtl:rtlEnable,
            prevArrow: '<div class="prev-arrow"> <i class="las la-long-arrow-alt-left"></i> </div>',
            nextArrow: '<div class="next-arrow"> <i class="las la-long-arrow-alt-right"></i> </div>',
            responsive: [{
                breakpoint: 992,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                }
            },
                {
                    breakpoint: 800,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1,
                    }
                },
                {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                    }
                },
                {
                    breakpoint: 450,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                    }
                }

            ]
        });

        /*------------------------------
          categories-product-slider
        -------------------------------*/
        $('.categories-product-slider').slick({
            infinite: true,
            slidesToShow: 5,
            slidesToScroll: 1,
            speed: 800,
            arrows: true,
            autoplay: false,
            dots: false,
            rtl:rtlEnable,
            prevArrow: '<div class="prev-arrow"> <i class="las la-long-arrow-alt-left"></i> </div>',
            nextArrow: '<div class="next-arrow"> <i class="las la-long-arrow-alt-right"></i> </div>',
            responsive: [{
                breakpoint: 992,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                }
            },
                {
                    breakpoint: 800,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1,
                    }
                },
                {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                    }
                },
                {
                    breakpoint: 450,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                    }
                }

            ]
        });


                /*------------------------------
           new-brand-slider
        -------------------------------*/
        $('.deal-week-slider').slick({
            infinite: true,
            slidesToShow: 5,
            slidesToScroll: 1,
            speed: 800,
            arrows: true,
            autoplay: false,
            dots: false,
            rtl:rtlEnable,
            prevArrow: '<div class="prev-arrow"> <i class="las la-long-arrow-alt-left"></i> </div>',
            nextArrow: '<div class="next-arrow"> <i class="las la-long-arrow-alt-right"></i> </div>',
            responsive: [{
                breakpoint: 992,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                }
            },
                {
                    breakpoint: 800,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1,
                    }
                },
                {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1,
                    }
                },
                {
                    breakpoint: 450,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1,
                    }
                }

            ]
        });

        /*------------------------------
           top-brand-slider
        -------------------------------*/
        $('.top-brand-slider').slick({
            vertical: true,
            verticalSwiping: true,

            infinite: true,
            slidesToShow: 4,
            slidesToScroll: 1,
            // speed: 800,
            arrows: true,
            autoplay: false,
            dots: false,
            rtl:rtlEnable,
            prevArrow: '<div class="prev-arrow"> <i class="las la-long-arrow-alt-down"></i> </div>',
            nextArrow: '<div class="next-arrow"> <i class="las la-long-arrow-alt-up"></i> </div>',
            responsive: [{
                breakpoint: 992,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                }
            },
                {
                    breakpoint: 800,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1,
                    }
                },
                {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1,
                    }
                },
                {
                    breakpoint: 450,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1,
                    }
                }

            ]
        });

        /*------------------------------
            brand item slider
        -------------------------------*/
        $('.brand-slider-active').slick({
            infinite: true,
            slidesToShow: 5,
            slidesToScroll: 1,
            speed: 800,
            arrows: false,
            autoplay: false,
            dots: false,
            rtl:rtlEnable,
            responsive: [{
                breakpoint: 992,
                settings: {
                    slidesToShow: 5,
                    slidesToScroll: 1,
                }
            },
                {
                    breakpoint: 800,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 1,
                    }
                },
                {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1,
                    }
                },
                {
                    breakpoint: 450,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1,
                    }
                }

            ]
        });

        /*------------------------------
            brand item slider
        -------------------------------*/
        $('.brand-item-slider-inst').slick({
            infinite: true,
            slidesToShow: 7,
            slidesToScroll: 1,
            speed: 800,
            arrows: false,
            autoplay: false,
            dots: false,
            rtl:rtlEnable,
            responsive: [{
                breakpoint: 992,
                settings: {
                    slidesToShow: 6,
                    slidesToScroll: 1,
                }
            },
                {
                    breakpoint: 800,
                    settings: {
                        slidesToShow: 5,
                        slidesToScroll: 1,
                    }
                },
                {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 1,
                    }
                },
                {
                    breakpoint: 450,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1,
                    }
                }

            ]
        });

        /*------------------------------
            Shop Details Slick Slider
        -------------------------------*/
        $('.shop-details-gallery-slider').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: true,
            rtl:rtlEnable,
            asNavFor: '.shop-details-gallery-nav'
        });

        $('.shop-details-gallery-nav').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            asNavFor: '.shop-details-gallery-slider',
            dots: false,
            rtl:rtlEnable,
            arrows: false,
            focusOnSelect: true,
        });

        /*------------------------------
            payment gateway selection
        -------------------------------*/
        $(".payment-gateway-list li").on('click', function () {
            $(".payment-gateway-list li").removeClass("selected");
            $(this).addClass("selected");
        });



        /*------------------------------
            Countdown
        -------------------------------*/
        loopcounter('flash-countdown-1');
        loopcounter('flash-countdown-3');
        loopcounter('flash-countdown-camp');
        loopcounter('flash-countdown-product');

        /*------------------------------
            Header Slider index-04
        -------------------------------*/

        $('.testimonial-slider-inst').slick({
            dots: false,
            infinite: true,
            speed: 500,
            arrows: false,
            autoplay: true,
            cssEase: 'linear',
            slidesToShow: 3,
            slidesToScroll: 1,
            centerMode: true,
            centerPadding: '0px',
            rtl:rtlEnable,
            responsive: [{
                breakpoint: 992,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                }
            },
                {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                    }
                }
            ]
        });

        // JS for rtl

        var sliderRtlValue = !(typeof rtlEnable === 'undefined' || rtlEnable === 'ltr');
        var OwlRtlValue = !(typeof rtlEnable === 'undefined' || rtlEnable === 'ltr');
        var slickRtlValue = !(typeof rtlEnable === 'undefined' || rtlEnable === 'ltr');

        /*------------------------------------
            search popup
        -----------------------------------*/
        $(document).on('click', '#search_icon', function (e) {
            e.preventDefault();
            $('#search_popup').addClass('show');
        });
        $(document).on('click', '#search-popup-close-btn', function (e) {
            e.preventDefault();
            $('#search_popup').removeClass('show');
        });

        /*------------------------------------
        user account
        -----------------------------------*/
        $(".navigation-button-x").on('click', function () {
            $(".user-account-widget").slideToggle("1000");
        });
        if ($(window).width() < 768) {
            $(".user-account-widget").hide();
        }
        
         /*------------------------------
        Product Filter One Button
        ------------------------------*/
        $(document).on("click",".product_filter_style_one_btn_list li",function (){
            $(".product_filter_style_one_btn_list li").removeClass("active");
            $(this).addClass("active");
        });
        
        
    });

   

    /*------------------------------
           Scroll to top
    -------------------------------*/
    $(window).on('scroll',function () {
        if ($(this).scrollTop() > 800) {
            $(".scroll-to-top").fadeIn();
        } else {
            $(".scroll-to-top").fadeOut();
        }
    })
    
    /*------------------------------
           Resize 
    -------------------------------*/
    $(window).on('resize',function () {
        if ($(window).width() < 992) {
            $(".mobile-style").removeClass("show");
        }

        if ($(window).width() < 768) {
            $(".index-03-catg").removeClass("show");
        }
    })

   
}(jQuery));


/*------------------------------
       Shop View Details
-------------------------------*/

var sandwiches = document.querySelectorAll('.zoom-js-handle');

sandwiches.forEach(function (sandwich, index) {
    sandwich.addEventListener('mousemove', function (e) {
        zoomin(e)
    })
    sandwich.addEventListener('mouseleave', function (e) {
        var zoomer = e.currentTarget;
        zoomer.style.backgroundImage = '';
    })
});

function zoomin(e) {
    var zoomer = e.currentTarget;
    zoomer.style.backgroundImage = 'url(' + zoomer.getAttribute('data-src') + ')';
    e.offsetX ? offsetX = e.offsetX : offsetX = e.touches[0].pageX
    e.offsetY ? offsetY = e.offsetY : offsetX = e.touches[0].pageX
    x = offsetX / zoomer.offsetWidth * 100
    y = offsetY / zoomer.offsetHeight * 100
    zoomer.style.backgroundPosition = x + '% ' + y + '%';
}

function hash(obj) {
    return MD5(encodeURIComponent(obj));
}

/*------------------------------
       MD5
-------------------------------*/
var MD5 = function (d) {
    var r = M(V(Y(X(d), 8 * d.length)));
    return r.toLowerCase()
};

function M(d) {
    for (var _, m = "0123456789ABCDEF", f = "", r = 0; r < d.length; r++) _ = d.charCodeAt(r), f += m.charAt(_ >>> 4 & 15) + m.charAt(15 & _);
    return f
}

function X(d) {
    for (var _ = Array(d.length >> 2), m = 0; m < _.length; m++) _[m] = 0;
    for (m = 0; m < 8 * d.length; m += 8) _[m >> 5] |= (255 & d.charCodeAt(m / 8)) << m % 32;
    return _
}

function V(d) {
    for (var _ = "", m = 0; m < 32 * d.length; m += 8) _ += String.fromCharCode(d[m >> 5] >>> m % 32 & 255);
    return _
}

function Y(d, _) {
    d[_ >> 5] |= 128 << _ % 32, d[14 + (_ + 64 >>> 9 << 4)] = _;
    for (var m = 1732584193, f = -271733879, r = -1732584194, i = 271733878, n = 0; n < d.length; n += 16) {
        var h = m, t = f, g = r, e = i;
        f = md5_ii(f = md5_ii(f = md5_ii(f = md5_ii(f = md5_hh(f = md5_hh(f = md5_hh(f = md5_hh(f = md5_gg(f = md5_gg(f = md5_gg(f = md5_gg(f = md5_ff(f = md5_ff(f = md5_ff(f = md5_ff(f, r = md5_ff(r, i = md5_ff(i, m = md5_ff(m, f, r, i, d[n + 0], 7, -680876936), f, r, d[n + 1], 12, -389564586), m, f, d[n + 2], 17, 606105819), i, m, d[n + 3], 22, -1044525330), r = md5_ff(r, i = md5_ff(i, m = md5_ff(m, f, r, i, d[n + 4], 7, -176418897), f, r, d[n + 5], 12, 1200080426), m, f, d[n + 6], 17, -1473231341), i, m, d[n + 7], 22, -45705983), r = md5_ff(r, i = md5_ff(i, m = md5_ff(m, f, r, i, d[n + 8], 7, 1770035416), f, r, d[n + 9], 12, -1958414417), m, f, d[n + 10], 17, -42063), i, m, d[n + 11], 22, -1990404162), r = md5_ff(r, i = md5_ff(i, m = md5_ff(m, f, r, i, d[n + 12], 7, 1804603682), f, r, d[n + 13], 12, -40341101), m, f, d[n + 14], 17, -1502002290), i, m, d[n + 15], 22, 1236535329), r = md5_gg(r, i = md5_gg(i, m = md5_gg(m, f, r, i, d[n + 1], 5, -165796510), f, r, d[n + 6], 9, -1069501632), m, f, d[n + 11], 14, 643717713), i, m, d[n + 0], 20, -373897302), r = md5_gg(r, i = md5_gg(i, m = md5_gg(m, f, r, i, d[n + 5], 5, -701558691), f, r, d[n + 10], 9, 38016083), m, f, d[n + 15], 14, -660478335), i, m, d[n + 4], 20, -405537848), r = md5_gg(r, i = md5_gg(i, m = md5_gg(m, f, r, i, d[n + 9], 5, 568446438), f, r, d[n + 14], 9, -1019803690), m, f, d[n + 3], 14, -187363961), i, m, d[n + 8], 20, 1163531501), r = md5_gg(r, i = md5_gg(i, m = md5_gg(m, f, r, i, d[n + 13], 5, -1444681467), f, r, d[n + 2], 9, -51403784), m, f, d[n + 7], 14, 1735328473), i, m, d[n + 12], 20, -1926607734), r = md5_hh(r, i = md5_hh(i, m = md5_hh(m, f, r, i, d[n + 5], 4, -378558), f, r, d[n + 8], 11, -2022574463), m, f, d[n + 11], 16, 1839030562), i, m, d[n + 14], 23, -35309556), r = md5_hh(r, i = md5_hh(i, m = md5_hh(m, f, r, i, d[n + 1], 4, -1530992060), f, r, d[n + 4], 11, 1272893353), m, f, d[n + 7], 16, -155497632), i, m, d[n + 10], 23, -1094730640), r = md5_hh(r, i = md5_hh(i, m = md5_hh(m, f, r, i, d[n + 13], 4, 681279174), f, r, d[n + 0], 11, -358537222), m, f, d[n + 3], 16, -722521979), i, m, d[n + 6], 23, 76029189), r = md5_hh(r, i = md5_hh(i, m = md5_hh(m, f, r, i, d[n + 9], 4, -640364487), f, r, d[n + 12], 11, -421815835), m, f, d[n + 15], 16, 530742520), i, m, d[n + 2], 23, -995338651), r = md5_ii(r, i = md5_ii(i, m = md5_ii(m, f, r, i, d[n + 0], 6, -198630844), f, r, d[n + 7], 10, 1126891415), m, f, d[n + 14], 15, -1416354905), i, m, d[n + 5], 21, -57434055), r = md5_ii(r, i = md5_ii(i, m = md5_ii(m, f, r, i, d[n + 12], 6, 1700485571), f, r, d[n + 3], 10, -1894986606), m, f, d[n + 10], 15, -1051523), i, m, d[n + 1], 21, -2054922799), r = md5_ii(r, i = md5_ii(i, m = md5_ii(m, f, r, i, d[n + 8], 6, 1873313359), f, r, d[n + 15], 10, -30611744), m, f, d[n + 6], 15, -1560198380), i, m, d[n + 13], 21, 1309151649), r = md5_ii(r, i = md5_ii(i, m = md5_ii(m, f, r, i, d[n + 4], 6, -145523070), f, r, d[n + 11], 10, -1120210379), m, f, d[n + 2], 15, 718787259), i, m, d[n + 9], 21, -343485551), m = safe_add(m, h), f = safe_add(f, t), r = safe_add(r, g), i = safe_add(i, e)
    }
    return Array(m, f, r, i)
}

function md5_cmn(d, _, m, f, r, i) {
    return safe_add(bit_rol(safe_add(safe_add(_, d), safe_add(f, i)), r), m)
}

function md5_ff(d, _, m, f, r, i, n) {
    return md5_cmn(_ & m | ~_ & f, d, _, r, i, n)
}

function md5_gg(d, _, m, f, r, i, n) {
    return md5_cmn(_ & f | m & ~f, d, _, r, i, n)
}

function md5_hh(d, _, m, f, r, i, n) {
    return md5_cmn(_ ^ m ^ f, d, _, r, i, n)
}

function md5_ii(d, _, m, f, r, i, n) {
    return md5_cmn(m ^ (_ | ~f), d, _, r, i, n)
}

function safe_add(d, _) {
    var m = (65535 & d) + (65535 & _);
    return (d >> 16) + (_ >> 16) + (m >> 16) << 16 | 65535 & m
}

function bit_rol(d, _) {
    return d << _ | d >>> 32 - _
}
