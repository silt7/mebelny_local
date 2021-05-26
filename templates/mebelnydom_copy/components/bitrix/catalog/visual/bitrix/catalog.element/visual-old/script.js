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
				$('.old-price.value span').html(price.PRINT_VALUE);
				if (price.DISCOUNT_VALUE < price.VALUE) {
					$('.old-price.value span').show();
				} else {
					$('.old-price.value span').hide();
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
})
