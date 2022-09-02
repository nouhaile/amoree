(function($) {
  'use strict';
		
	 $('#home-slider_five').owlCarousel({
		items:1,
		loop:true,
		rewind: true,dots: false,
		margin:10,
		responsive:{
			0:{
				stagePadding: 0,
				margin: 30
			},
			479:{
				stagePadding:0,
				margin: 30
			},
			768:{
				stagePadding: 0,
				margin: 30
			},
			979:{
				stagePadding: 100,
				margin: 30
			},
			1199:{
				stagePadding: 150,
				margin: 30
			},
			1599:{
				stagePadding: 306,
				margin: 30
			}
		}
	});
}(jQuery));


