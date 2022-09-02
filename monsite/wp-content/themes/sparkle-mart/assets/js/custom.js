jQuery(document).ready(function($) {    
    "use strict"; 
    /**
     * Add RTL Class in Body
    */
   var brtl = false;

   if ($("body").hasClass('rtl')) { brtl = true; }
    
    /**
     * WooCommerce Category With Products 
    */
    $('.widget_sparkle_mart_products_widget_area').each(function(){
        
        var ele = $(this);
        var Id = ele.attr('id');
        var NewId = Id;
        var wrapper  = $('#'+Id+" .catwithproduct");
        var type = wrapper.data('layout');
        var column = wrapper.data('column') || 3;
        
        if ( type == 'slider' ){
            NewId = wrapper.lightSlider({
                item: column,
                pager:false,
                loop:true,
                speed:600,
                rtl: brtl,
                controls:false,
                prevHtml:'<i class="icofont-thin-left"></i>',
                nextHtml:'<i class="icofont-thin-right"></i>',
                slideMargin:20,
                onSliderLoad: function() {
                    wrapper.removeClass('cS-hidden');
                },
                responsive : [
                    {
                        breakpoint:1024,
                        settings: {
                            item:3,
                            slideMove:1,
                            slideMargin:15,
                        }
                    },
                    {
                        breakpoint:768,
                        settings: {
                            item:2,
                            slideMove:1,
                            slideMargin:15,
                        }
                    },
                    {
                        breakpoint:480,
                        settings: {
                            item:1,
                            slideMove:1,
                        }
                    }
                ]
            });

            $('#'+Id+' .sparkle-lSPrev').click(function(){
                NewId.goToPrevSlide(); 
            });
            $('#'+Id+' .sparkle-lSNext').click(function(){
                NewId.goToNextSlide(); 
            });
        }

    });
});