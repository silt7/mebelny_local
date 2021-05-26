function disableAddToCart(elementId, mode, text)
{
	var	element = document.getElementById(elementId);
	if (!element)
		return;
	
	if (mode == "detail")
		$(element).html("<span>" + text + "</span>").addClass("bg-green")
			.removeAttr("href").css("cursor", "pointer").bind('click', function(){location="/personal/basket/";});
	else if (mode == "list")
		$(element).html(text).removeClass("catalog-item-buy").addClass("catalog-item-in-the-cart bg-green")
			.css("cursor", "pointer").removeAttr("href").bind('click', function(){location="/personal/basket/";});
}

function addToCart(element, imageToFlyId, mode, text)
{
	if (!element || !element.href)
		return;

	var button = $(element);
	if (mode == "detail")
		button.css("cursor", "pointer").addClass("bg-green").bind('click', function(){location="/personal/basket/";});
	else if (mode == "list")
		button.removeClass("catalog-item-buy").addClass("catalog-item-in-the-cart bg-green").css("cursor", "pointer").bind('click', function(){location="/personal/basket/";});

	$.get(
		element.href + "&ajax_buy=1",
		$.proxy(
			function(data) {

				if (this.mode == "detail")
					this.button.removeAttr("href").html("<span>" + text + "</span>").addClass("bg-green").bind('click', function(){location="/personal/basket/";});
				else if (this.mode == "list")
					this.button.removeAttr("href").html("<span>" + text + "</span>").addClass("bg-green").css("cursor", "pointer").bind('click', function(){location="/personal/basket/";});;

				var imageElement = document.getElementById(this.imageToFlyId);
				if (!imageElement)
				{
					$("#cart_line").html(data);
					$("#cart-line-two").html(data);
					return;
				}

				var hoverClassName = "";
				var wrapper = null;
				if (this.mode == "detail")
				{
					hoverClassName = "catalog-detail-hover";
					wrapper = this.button.parents("div.catalog-detail");
				}
				else if (this.mode == "list")
				{
					hoverClassName = "catalog-item-hover";
					wrapper = this.button.parents("div.catalog-item");
				}

				wrapper.unbind("mouseover").unbind("mouseout").removeClass(hoverClassName);

				var imageToFly = $(imageElement);
				var position = imageToFly.position();
				var flyImage = imageToFly.clone().insertBefore(imageToFly);

				flyImage.css({ "position": "absolute", "left": position.left, "top": position.top });
				flyImage.animate({ width: 10, height: 10, left: 948, top: -58 }, 500, 'linear');
				flyImage.data("hoverClassName", hoverClassName);
				flyImage.queue($.proxy(function() {

					this.flyImage.remove();
					$("#cart_line").html(data);

					if (this.wrapper.data("adminMode") === true)
					{
						var hoverClassName = "";
						if (this.mode == "detail")
							hoverClassName = "catalog-detail-hover";
						else if (this.mode == "list")
							hoverClassName = "catalog-item-hover";

						this.wrapper.addClass(hoverClassName).bind({
							mouseover: function() { $(this).removeClass(hoverClassName).addClass(hoverClassName); },
							mouseout: function() { $(this).removeClass(hoverClassName); }
						});
					}

				}, {"wrapper" : wrapper, "flyImage" : flyImage, "mode": this.mode}));

			}, { "button": button, "mode": mode, "imageToFlyId" : imageToFlyId }
		)
	);

	return false;
}

function disableAddToCompare(elementId, text)
{
	var	element = document.getElementById(elementId);
	if (!element)
		return;

	$(element)
		.removeClass("catalog-item-compare").addClass("catalog-item-compared")
		.text(text).css("cursor", "pointer").bind('click', function(){location="/catalog/compare.php";});

	return false;
}

function addToCompare(element, text)
{
	if (!element || !element.href) 
		return;

	var href = element.href;
	var button = $(element);

	button.removeClass("catalog-item-compare").addClass("catalog-item-compared").css("cursor", "pointer").bind('click', function(){location="/catalog/compare.php";});

	$.get(
		href + '&ajax_compare=1&ajax_action=Y&backurl=' + decodeURIComponent(window.location.pathname),
		$.proxy(
			function(data) {

				var compare = $("#compare");
				compare.html(data);
				
				this.text(text);

				if (compare.css("display") == "none") {
					compare.css({ "display": "block", "height": "0" });
					compare.animate({ "height": "22px" }, 300);
				}
			}, button
		)
	);
	
	return false;
}

function add_to_cart(id, obj){
	var data = {};
	if (typeof(obj) !== 'undefined') {
		data = $(obj).data();
	}
	data.id = id;

	BX.showWait(obj);
	$.ajax({
		type: "POST",
		url: "/local/ajax/cart_catalog.php",
		data: data,
		dataType: 'json',
		success: function(data){
			var html = data.basket;
			$('#cart_line').html(html);
			$.ajax({
				type: "POST",
				url: "/local/ajax/addbasket.php",
				data: {ids: data.ids},
				success: function(html){
					$('.modal-busket__container').html(html);
					$('.modal-busket').modal('show');
					BX.closeWait(obj);
				}
			});
			if (typeof(obj) !== 'undefined') {
				if ($(obj).next().hasClass('detailProductOutCart')) {
					$(obj).hide();
					$(obj).next().show();
					if (typeof(data.ids) !== 'undefined') {
						top.window.BASKET_ITEMS.push(data.ids * 1);
					} else {
						top.window.BASKET_ITEMS.push(id * 1);
					}
					return true;
				}
			}
		}
	});
}

// Функционал наборов
function numeric_format(val, thSep, dcSep) {
    if (!thSep) thSep = ' ';
    if (!dcSep) dcSep = ',';
 
    var res = val.toString();
    var lZero = (val < 0);
 
    var fLen = res.lastIndexOf('.');
    fLen = (fLen > -1) ? fLen : res.length;
 
    var tmpRes = res.substring(fLen);
    var cnt = -1;
    for (var ind = fLen; ind > 0; ind--) {
        cnt++;
        if (((cnt % 3) === 0) && (ind !== fLen) && (!lZero || (ind > 1))) {
            tmpRes = thSep + tmpRes;
        }
        tmpRes = res.charAt(ind - 1) + tmpRes;
    }

    return tmpRes.replace('.', dcSep);
}

function soberiSamInit() {
	if($('#soberi_sam div.count-wrap input').length == 0) return false;

	var price = 0;
	var discount_price = 0;
	var discount = 0;

	var priceItem, discountItem;
	var countInNabor = 0;
	$('#soberi_sam div.count-wrap input').each(function(){
		var li = $(this).closest('div.count-wrap');
		var count = $(this).val();
		if (count <= 0) {
			$('.innabor[data-id="' + li.data('id') + '"]').show();
			$('.outnabor[data-id="' + li.data('id') + '"]').hide();
			li.hide();
			return true;
		} else {
			countInNabor += 1;
			$('.innabor[data-id="' + li.data('id') + '"]').hide();
			$('.outnabor[data-id="' + li.data('id') + '"]').show();
			li.show();
		}

		var discountItem = li.data('discount') * count;
		li.find('.price-element').html(numeric_format(discountItem, 0, ' ', '.') + ' руб.');

		price += li.data('price') * count;
		discount_price += discountItem;
	});

	if (countInNabor == 0) {
		$('#emptyNabor').show();
		$('.product__buscket.detailProductInCart').attr('disabled','');
		$('.product__buscket.detailProductOneClick').attr('disabled','');
	} else {
		$('#emptyNabor').hide();
		$('.product__buscket.detailProductInCart').removeAttr('disabled');
		$('.product__buscket.detailProductOneClick').removeAttr('disabled');
	}
	console.log(countInNabor);

	discount = price - discount_price;

	$('#detailPrice .price-btn').html(numeric_format(discount_price, 0, ' ', '.') + ' руб.');
	$('#detailPrice .old-price span').html(numeric_format(price, 0, ' ', '.') + ' руб.');
	$('#detailPrice span.discount').html(numeric_format(discount, 0, ' ', '.') + ' руб.');

	if (discount > 0) {
		$('#detailPrice .old-price').closest('tr').show();
		$('#detailPrice span.discount').closest('tr').show();
	} else {
		$('#detailPrice .old-price').closest('tr').hide();
		$('#detailPrice span.discount').closest('tr').hide();
	}

	var products = '';
	var quantity = '';
	$('#soberi_sam div.count-wrap input').each(function(){
		var li = $(this).closest('div.count-wrap');
		var count = $(this).val();
		if (count <= 0) return true;

		products += li.data('id') + ':';
		quantity += count + ':';
	});
	$('.detailProductInCart').data('ids', products).data('counts', quantity);
}

function ajaxReload() {
	$('*[data-compare]').removeClass('active');
	$('.add__title[data-compare]').each(function(){
		$(this).html('Добавить в сравнение');
	});

	var comparison = window.COMPARE_LIST_COUNT.length;
	if (comparison == 0) comparison = 'нет';
	$('.add_comparison .add__title span').html('Товаров (' + comparison + ')');
	for (var i in window.COMPARE_LIST_COUNT) {
		var obj = $('*[data-compare=' + window.COMPARE_LIST_COUNT[i] + ']');
		obj.addClass('active');
		if (obj.hasClass('add__title')) {
			obj.html('Удалить из сравнения');
		}
	}
}

$(function(){
	$(document).on('click', '.innabor', function(){
		var id = $(this).data('id');
		var objNum = $('#soberi_sam div.count-wrap[data-id="' + id + '"] input');
		objNum.val(parseInt(objNum.val()) + 1);

		soberiSamInit();
		return false;
	});
	$(document).on('click', '.outnabor', function(){
		var id = $(this).data('id');
		var objNum = $('#soberi_sam div.count-wrap[data-id="' + id + '"] input');
		objNum.val(0);

		soberiSamInit();
		return false;
	});

	$('*[data-basketcheck]').each(function(){
		var bc = $(this).data('basketcheck');
		if ($.inArray(bc * 1, window.BASKET_ITEMS) >= 0) {
			$(this).hide();
			$(this).next().show();
		} else {
			$(this).show();
			$(this).next().hide();
		}
	});


	$('#soberi_sam input').change(function(){
		soberiSamInit();
	});
	$('#soberi_sam .del-element').click(function(){
		$(this).closest('div.count-wrap').find('input').val(0);
		soberiSamInit();
		return false;
	});

	soberiSamInit();
	ajaxReload();

	$(document).on('click', '*[data-compare]', function(event){
		var obj = $(this);
		var action = $(this).hasClass('active') ? 'DELETE_FROM_COMPARE_RESULT' : 'ADD_TO_COMPARE_LIST';
		var wait = BX.showWait(this);
		$.ajax({
			url: '/compare/?action=' + action + '&ajax_action=Y&id=' + $(this).data('compare'),
			_dataType: 'json',
			success: function(data) {
				var id = obj.data('compare');
				if (action == 'ADD_TO_COMPARE_LIST') {
					window.COMPARE_LIST_COUNT.push(id);
				} else {
					var i = window.COMPARE_LIST_COUNT.indexOf(id);
					if (i >= 0) window.COMPARE_LIST_COUNT.splice(i, 1);
				}
				ajaxReload();
				$.ajax({
					url: '/local/ajax/compare.list.php',
					success: function(html) {
						$('#compare_mini_list').html(html);
					}
				});
				var op = (window.COMPARE_LIST_COUNT.length == 0) ? 'hide' : 'show';
				//$('#compare_mini_list')[op]();
				BX.closeWait(wait);
			}
		});
		return false;
	});

	$(document).on('click', 'a[data-hide]', function(event){
		location.href = '/' + $(this).data('hide').split('').reverse().join('') + '/';
		return false;
	});

	$(document).on('click', '.modal-busket__delete-item', function(event){
		var id = $(this).data('id');
		var obj = $(this);

		var wait = BX.showWait(this);
		$.ajax({
			url: '/local/ajax/cart_catalog.php',
			type: 'POST',
			data: {'id': id, 'del': 'Y'},
			dataType: 'json',
			success: function(data) {
				obj.closest('.modal-busket__content').remove();
				$('#cart_line').html(data.basket);
				BX.closeWait(wait);
			}
		});
		return false;
	});

	$(document).on('click', '.openpopup', function (event){
		var name = (typeof($(this).data('name')) != 'undefined') ? $(this).data('name') : '';
		var id   = (typeof($(this).data('id')) != 'undefined') ? $(this).data('id') : '';
		$('[name="form_hidden_13"]', '.modal-call').val(name);
		$('[name="form_hidden_14"]', '.modal-call').val(id);
		if (name == '') {
			$('.title-html', '.modal-call').html('Получить консультацию');
		} else {
			$('.title-html', '.modal-call').html('Вы заказываете "' + name + '"');
		}
			$('#modal-call').css({'display' : 'block'}).addClass('in');

	});

	
	$(document).on('click', '.modal-call__close-btn', function (event) {
		event.preventDefault();
		var element12 = $(document).find('.modal-thanks__ok-btn');
		if(element12.length){
			window.location.reload();
		} else {
			$('#modal-call').css({
				'display': 'none'
			}).removeClass('in');
		};
	});

	$(document).mouseup(function (e) {
		var elem1 = $('.modal-call__wrap');
		if (!elem1.is(e.target) && elem1.has(e.target).length === 0) {
			var element12 = $(document).find('.modal-thanks__ok-btn');
			if(element12.length){
				window.location.reload();
			} else {
				$('#modal-call').css({
					'display': 'none'
				}).removeClass('in');
			};
		}
	});

	$(document).on('click','.modal-thanks__ok-btn', function (event) {
		event.preventDefault();
		window.location.reload();
	});


	$('.footer .main-menu__catalog ').click(function () {
		$('html, body').animate({
			scrollTop: 100
		}, 500);	
	});	





});