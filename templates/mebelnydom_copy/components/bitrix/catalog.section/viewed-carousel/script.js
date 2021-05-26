$(document).ready(function(){
    $('#owl-carousel-viewed').owlCarousel({
        nav: true,
        responsive:{ 
			0:{
				items:1
			},
			1000:{
				items:5
			}
		}
    });
});