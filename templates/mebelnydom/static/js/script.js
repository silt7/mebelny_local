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
		href + '&ajax_compare=1&backurl=' + decodeURIComponent(window.location.pathname),
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

	$.ajax({
		type: "POST",
		url: "/local/ajax/cart_catalog.php",
		data: data,
		success: function(html){
			$('#cart_line').html(html);
			alert('Товар(ы) добавлены в корзину');
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
	$('#soberi_sam div.count-wrap input').each(function(){
		var li = $(this).closest('div.count-wrap');
		var count = $(this).val();
		if (count <= 0) {
			$('.innabor[data-id="' + li.data('id') + '"]').show();
			$('.outnabor[data-id="' + li.data('id') + '"]').hide();
			li.hide();
			return true;
		} else {
			$('.innabor[data-id="' + li.data('id') + '"]').hide();
			$('.outnabor[data-id="' + li.data('id') + '"]').show();
			li.show();
		}

		var discountItem = li.data('discount') * count;
		li.find('.price-element').html(numeric_format(discountItem, 0, ' ', '.') + ' руб.');

		price += li.data('price') * count;
		discount_price += discountItem;
	});

	discount = price - discount_price;

	$('#detailPrice .price-btn').html(numeric_format(discount_price, 0, ' ', '.') + ' руб.');
	$('#detailPrice .old-price.value span').html(numeric_format(price, 0, ' ', '.') + ' руб.');
	$('#detailPrice span.discount').html(numeric_format(discount, 0, ' ', '.') + ' руб.');

	if (discount > 0) {
		$('#detailPrice .old-price.value').show();
		$('#detailPrice span.discount').closest('tr').show();
	} else {
		$('#detailPrice .old-price.value').hide();
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


	$('#soberi_sam input').change(function(){
		soberiSamInit();
	});
	$('#soberi_sam .del-element').click(function(){
		$(this).closest('div.count-wrap').find('input').val(0);
		soberiSamInit();
		return false;
	});

	soberiSamInit();
});


