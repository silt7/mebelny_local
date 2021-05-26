$(function(){
	$('.offer-property-change').change(function(){

		var offer = 0;
		var prop = {};
		$('.offer-property-change select').each(function(){
			prop[$(this).data('prop')] = $(this).val();
		});
		for (var id in window.catalogOffers) {
			var curProp = window.catalogOffers[id].PROPS;
			if(typeof curProp != 'undefined'){
    			console.log(curProp);
    			var eq = $.map(curProp, function(v, k) { return prop[k] && prop[k] == v ? true : false; }).indexOf(false) < 0;
    			if (eq) {
    				offer = id;
    				break;
    			}
			}
		}
		if (offer > 0) {
			var price = window.catalogOffers[id].PRICES.BASE;
			if (price.CAN_BUY == 'Y') {
				if (price.DISCOUNT_VALUE < price.VALUE) {
					$('.products__btns_price').text(price.PRINT_DISCOUNT_VALUE);
					$('.modal-busket__price').text(price.PRINT_DISCOUNT_VALUE);
				} else {
					$('.products__btns_price').text(price.PRINT_VALUE);
					$('.modal-busket__price').text(price.PRINT_VALUE);
				}
			} else {
				$('.products__btns_price').text(price.PRINT_VALUE);
				$('.modal-busket__price').text(price.PRINT_VALUE);
			}
			$('.products__btns_cart').attr('onclick','add_basket('+ offer +')');
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

	if($('#lowcost-form').length > 0) {
		$('#lowcost-form').append($('#lowcost-form-epilog'));
		$('#lowcost-form-epilog').show();
	}
	if($('#review-block').length > 0) {
		$('#review-block').append($('#review-block-epilog'));
		$('#review-block-epilog').show();
	}
});
function add_basket(id, prop){
    var post = {};
    post['id'] = id;
    post['prop'] = prop;
    console.log(post['prop']);
    $.post(
        '/local/ajax/addCart.php',
        post,
        function (result) {
            $("#cart_desc").text(result);
            $(".cart_desc-mobile").text(result);
            openBuyProduct();
        }
    );
}
function add_basket_nabor(){
    $('#soberi_sam').find('.count-wrap:visible').each(function() {
        var id = $(this).attr('data-id');
        var count = $(this).find('input').val();
        for (let i = 0; i < count; i++) { 
            add_basket(id);
        }
        
        var price = $(this).attr('data-discount') * count;
        $('.modal-busket__price[data-id="'+id+'"]').text(price + ' руб.');
        $('.modal-busket__count[data-id="'+id+'"]').text('Кол-во: ' + count);
    });
}
function openSendReview()
{
   var authPopup = BX.PopupWindowManager.create("SendReview", null, {
         autoHide: true,
         offsetLeft: 0,
         offsetTop: 0,
         overlay : true,
         draggable: {restrict:true},
         closeByEsc: true,
         closeIcon: { right : "12px", top : "10px"},
         content: '<div style="width:400px;height:400px; text-align: center;"></div>',
            events: {
               onAfterPopupShow: function()
               {
                     this.setContent(BX("modal_review"));
               }
         }
        });

     authPopup.show();
}
function openRecallPopup2()
{
   var authPopup = BX.PopupWindowManager.create("openRecallPopup2", null, {
         autoHide: true,
         offsetLeft: 0,
         offsetTop: 0,
         overlay : true,
         draggable: {restrict:true},
         closeByEsc: true,
         closeIcon: { right : "12px", top : "10px"},
         content: '<div style="width:300px;height:250; text-align: center;"></div>',
            events: {
               onAfterPopupShow: function()
               {
                     this.setContent(BX("bx_recall_popup_form2"));
               }
         }
        });

     authPopup.show();
     $('#openRecallPopup2').find('form').attr({"onsubmit": "ym(26789943,'reachGoal','sayifavailable', {URL:document.location.href})"});
}
function openBuyProduct()
{
   var authPopup = BX.PopupWindowManager.create("openBuyProduct", null, {
         autoHide: true,
         offsetLeft: 0,
         offsetTop: 0,
         overlay : true,
         draggable: {restrict:true},
         closeByEsc: true,
         closeIcon: { right : "12px", top : "10px"},
         content: '<div style="width:400px;height:400px; text-align: center;"></div>',
            events: {
               onAfterPopupShow: function()
               {
                     this.setContent(BX("bx_by_product"));
               }
         }
        });

     authPopup.show();
}
function popupHide(){
    $('.popup-window-overlay').css('display','none');
    $('.popup-window').css('display','none');
}

/*---------------------Наборы----------------------------*/
$('.del-element').click(function(){
    var dataId = $(this).closest('.count-wrap').attr('data-id');
    $(this).closest('.count-wrap').hide();
    
    $('.modal-busket__content[data-id="'+dataId+'"]').hide();
    $('.products__collection_add[data-id="'+dataId+'"]').text('Добавить в набор');
    $('.products__collection_add[data-id="'+dataId+'"]').removeClass('outnabor');
    $('.products__collection_add[data-id="'+dataId+'"]').addClass('innabor');

    update_priceNabor();
})
function update_priceNabor(){
   var amount = 0;
    if($('#soberi_sam').find('.count-wrap:visible').length == 0){
        $('#emptyNabor').show();
    } else {
        $('#emptyNabor').hide();
    }
   
    $('#soberi_sam').find('.count-wrap:visible').each(function() {
        var count = $(this).find('input').val();
        var price = $(this).attr('data-discount') * count;
        $(this).find('.price-element').text(price.toString().replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1,') + ' руб.');
        amount = amount + price;
    });
    $('#detailPrice').find('.products__btns_price').text(amount.toString().replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1\u202f') + ' руб.');
}
$(document).ready(function(){
// "use strict"
    jQuery('<div class="quantity-nav"><div class="quantity-button quantity-up"><i class="fa fa-angle-up" aria-hidden="true"></i></div><div class="quantity-button quantity-down"><i class="fa fa-angle-down" aria-hidden="true"></i></div></div>').insertAfter('.quantity input');
    jQuery('.quantity').each(function() {
      var spinner = jQuery(this),
        input = spinner.find('input[type="number"]'),
        btnUp = spinner.find('.quantity-up'),
        btnDown = spinner.find('.quantity-down'),
        min = input.attr('min'),
        max = input.attr('max');

      btnUp.click(function() {
        var oldValue = parseFloat(input.val());
        if (oldValue >= max) {
          var newVal = oldValue;
        } else {
          var newVal = oldValue + 1;
        }
        spinner.find("input").val(newVal);
        spinner.find("input").trigger("change");
        
        update_priceNabor();
      });

      btnDown.click(function() {
        var oldValue = parseFloat(input.val());
        if (oldValue <= min) {
          var newVal = oldValue;
        } else {
          var newVal = oldValue - 1;
        }
        spinner.find("input").val(newVal);
        spinner.find("input").trigger("change");
        
        update_priceNabor();
      });
    });
});


$(function(){
    $(document).on('click', '.innabor', function(){
    	var id = $(this).attr('data-id');
    	$('#soberi_sam div.count-wrap[data-id="' + id + '"] input[type="number"]').val(1);
    	$('#soberi_sam div.count-wrap[data-id="' + id + '"]').show();
    	$('.modal-busket__content[data-id="' + id + '"]').show();
        $(this).text('Товар в наборе');
        $(this).removeClass('innabor');
        $(this).addClass('outnabor');
        update_priceNabor();
    });
    $(document).on('click', '.outnabor', function(){
    	var id = $(this).attr('data-id');
    	$('#soberi_sam div.count-wrap[data-id="' + id + '"]').hide();
    	$('.modal-busket__content[data-id="' + id + '"]').hide();
    	$(this).text('Добавить в набор');
        $(this).removeClass('outnabor');
        $(this).addClass('innabor');
        update_priceNabor();
    });
});