jQuery(document).ready(function ($) {
    var slider_auto, slider_loop, rtl;

    if (fashion_magazine_data.auto == '1') {
        slider_auto = true;
    } else {
        slider_auto = false;
    }

    if (fashion_magazine_data.loop == '1') {
        slider_loop = true;
    } else {
        slider_loop = false;
    }

    if (fashion_magazine_data.rtl == '1') {
        rtl = true;
    } else {
        rtl = false;
    }

    //banner 5
    $('.site-banner.slider-five .banner-wrapper').owlCarousel({
        items: 1,
        loop: slider_loop,
        autoplay: slider_auto,
        dots: false,
        rtl: rtl,
        nav: true,
        autoplaySpeed: 800,
        autoplayTimeout: fashion_magazine_data.speed,
        animateOut:  fashion_magazine_data.animation,
        center: true,
        responsive: {
            0: {
                margin: 10,
                stagePadding: 30,
                center: false,
            },
            768: {
                margin: 10,
                stagePadding: 80,
                center: true,
            },
            1025: {
                margin: 40,
                stagePadding: 150,
            },
            1200: {
                dots: false,
                nav: true,
                margin: 60,
                stagePadding: 200,
            },
            1367: {
                margin: 80,
                stagePadding: 300,
            },
            1501: {

                margin: 90,
                stagePadding: 342,
            }
        }
    });

});