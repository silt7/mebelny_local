$(function(){
	$('.offer-property-change').change(function(){

		var offer = 0;
		var prop = {};
		$('.offer-property-change select').each(function(){
			prop[$(this).data('prop')] = $(this).val();
		});
		for (var id in window.catalogOffers) {
			var curProp = window.catalogOffers[id].PROPS;
			var eq = $.map(curProp, function(v, k) { return prop[k] && prop[k] == v ? true : false; }).indexOf(false) < 0;
			if (eq) {
				offer = id;
				break;
			}
		}
		if (offer > 0) {
			$('.add_comparison *[data-compare]').attr('data-compare', offer).removeClass('active');
			var price = window.catalogOffers[id].PRICES.BASE;
			if (price.CAN_BUY == 'Y') {
				console.log(price);
				$('#detailPrice').show();
				$('.old-price-wrap .price-btn').html(price.PRINT_DISCOUNT_VALUE);
				$('.old-price.value').html(price.PRINT_VALUE);
				if (price.DISCOUNT_VALUE < price.VALUE) {
					$('.old-price.value').show();
				} else {
					$('.old-price.value').hide();
				}
				$('.detailProductInCart').data('ids', offer).data('counts', 1);
			} else {
				$('#detailPrice').hide();
			}

			console.log(offer);
			console.log(window.BASKET_ITEMS);
			if (jQuery.inArray(offer * 1, window.BASKET_ITEMS) >= 0) {
				$('#detailProductBasketButtons .detailProductInCart').hide();
				$('#detailProductBasketButtons .detailProductOutCart').show();
			} else {
				$('#detailProductBasketButtons .detailProductInCart').show();
				$('#detailProductBasketButtons .detailProductOutCart').hide();
			}
		}
	}).change();

	$('.description .tabs label:first').addClass('active');
	$('.description .tabs-item input[name="tabs"]:first').attr('checked', 'checked');


	$(".collection-slider").slick({
		slidesToShow: 5,
		slidesToScroll: 1,
		// autoplay: !0,
		// autoplaySpeed: 5e3,
		dots: !1,
		responsive: [{breakpoint: 1025, settings: {slidesToShow: 3}}, {
			breakpoint: 737,
			settings: {arrows: !1, centerMode: !0, centerPadding: "60px", slidesToShow: 1}
		}]
	});

	$('label[for="collection"]').on('click', function () {
		setTimeout(function () {
			$(".collection-slider").slick('setPosition');
		}, 300);
	});

	$('#add-review-btn').on('click', function (e) {
		e.preventDefault();
		$('.modal-review-form').show().addClass('in');
	});

	$('.askaron-reviews-for-element .modal-review-form').on('click', function (e) {
		var div = $(".askaron-reviews-for-element .modal-busket__dialog"); // тут указываем ID элемента
		if (!div.is(e.target) && div.has(e.target).length === 0) {
			$('.modal-review-form').hide().removeClass('in');
		}
	});

	$('.add_reviews_stars .checkbox__label').on('click', function () {
		var index = $(this).index();
		index += 1;
		$('.add_reviews_stars .checkbox__label').removeClass('active');
        $('.add_reviews_stars .checkbox__label').slice(0, index).addClass('active');
	});

	$('#revews-show-more-btn').on('click', function (e) {
		e.preventDefault();
		$('.reviews-block').removeClass('reviews-block-noshow');
		$(this).hide();
	});

	$(".tabs label").on("click", function () {
		$(".tabs label").hasClass("active") && $(".tabs label").removeClass("active"), $(this).addClass("active")
	});
});
