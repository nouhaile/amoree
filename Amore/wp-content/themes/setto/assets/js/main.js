(function($) {
    "use strict";

    $(window).scroll(function() {
        var sticky = $('.header-kaj'),
            scroll = $(window).scrollTop();
        if (scroll >= 150) {
            sticky.addClass('is-sticky');
        } else {
            sticky.removeClass('is-sticky');
        }
    });

    $(document).ready(function(){
        $(`a[data-bs-toggle="collapse"]`).click(function(){
		$(this).next().children().toggleClass("show");
		if($(this).attr("aria-expanded")== "false"|| $(this).attr("aria-expanded")== undefined ){
			$(this).attr("aria-expanded","true");
		}else{
			$(this).attr("aria-expanded","false");
		}
		$(this).toggleClass("collapsed");
		});

        $('.megamenu-li').parent('ul').parent('.dropdown-submenu').addClass('mega-menu');
        $('.menu-banner').parent('ul').parent('.dropdown-submenu').addClass('banner-menu');
        $('.submenu-li').parent('ul').parent('.dropdown-submenu').addClass('sub-menu');

        $('.main-menu').find( 'a' ).on( 'focus blur', function() {
            $( this ).parents( 'ul, li' ).toggleClass( 'focus' );
        });

        $(".search-rap .search-crap").on("click", function(n) {
            if ($(".crap-search.modal").attr('role','dialog')) {
                n.preventDefault();
                $(".crap-search.modal input[type='search']").focus();
                var t, a, c, o = document.querySelector(".crap-search.modal");
                let e = 'button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])',
                    m = document.querySelector(".crap-search.modal input[type='search']"),
                    u = o.querySelectorAll(e),
                    r = u[u.length - 1];
                if (!o) return !1;
                for (a = 0, c = (t = o.getElementsByTagName("button")).length; a < c; a++) t[a].addEventListener("focus", l, !0), t[a].addEventListener("blur", l, !0);

                function l() {
                    for (var e = this; - 1 === e.className.indexOf("modal-body");) "*" === e.tagName.toLowerCase() && (-1 !== e.className.indexOf("focus") ? e.className = e.className.replace("focus", "") : e.className += " focus"), e = e.parentElement
                }
                document.addEventListener("keydown", function(e) {
                    ("Tab" === e.key || 9 === e.keyCode) && (e.shiftKey ? document.activeElement === m && (r.focus(), e.preventDefault()) : document.activeElement === r && (m.focus(), e.preventDefault()))
                });
            } else {                
                $(".search-rap .search-crap:not(.modal)").focus();
            }
        });

        var swiper1 = new Swiper('#home-slider_one', {
            slidesPerColumn: 1,
            slidesPerView: 1,
            spaceBetween: 30,
            observer: true,
            loop: true,
            observeParents: true,
            navigation: {
                nextEl: '.single-next-slider',
                prevEl: '.single-prev-slider',
            }
        });
        var swiper3 = new Swiper('#category-slider', {
            slidesPerColumn: 1,
            slidesPerView: 5,
            loop: true,
            spaceBetween: 30,
            observer: true,
            observeParents: true,
            navigation: {
                nextEl: '.single-next',
                prevEl: '.single-prev',
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            breakpoints: {
                0: {
                    slidesPerView: 2,
                    spaceBetween: 15
                },
                479: {
                    slidesPerView: 2,
                    spaceBetween: 15
                },
                768: {
                    slidesPerView: 3
                },
                979: {
                    slidesPerView: 4
                },
                1199: {
                    slidesPerView: 4
                }
            }
        });
        var swiper4 = new Swiper('#feture_pro_tab', {
            slidesPerColumn: 2,
            slidesPerView: 4,
            spaceBetween: 30,
            observer: true,
            observeParents: true,
            breakpoints: {
                0: {
                    slidesPerView: 2,
                    spaceBetween: 15
                },
                640: {
                    slidesPerView: 2,
                    spaceBetween: 15
                },
                768: {
                    slidesPerView: 2
                },
                1024: {
                    slidesPerView: 3
                },
                1599: {
                    slidesPerView: 4
                }
            }
        });        
        $('#blog-slider').owlCarousel({
            loop: false,
            rewind: true,
            margin: 30,
            nav: false,
            dots: false,responsive:{
                0:{
                    items: 1,
                    margin: 15
                },
                479:{
                    items: 1,
                    margin: 15
                },
                768:{
                    items: 2
                },
                979:{
                    items: 2
                },
                1199: {
                    items: 3
                }
            }
        });

    });
})(jQuery);