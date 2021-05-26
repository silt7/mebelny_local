<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php"); ?>

<? CModule::IncludeModule('catalog');
CModule::IncludeModule("sale");                                   

if(!empty($_POST['id'])){
if(!empty($_POST['quant'])){
	$arFields = array(
			"QUANTITY" => $_POST['quant']
	);
	CSaleBasket::Update($_POST['id'], $arFields);
}
elseif($_POST['delete'] == 'Y'){
	CSaleBasket::Delete($_POST['id']);?>
	<script>
	$.ajax({
			type: "POST",
			url: "/ajax/cart_header.php",
			success: function(html){
				$('#cart_line').html(html);				
			}
		});
	</script>
<? }
else{
	$prop = array();
	Add2BasketByProductID(
	$_POST['id'],
	1,
	array(),
	array(
	$prop
	)
	);
}
}
if(!empty($_POST['COUPON'])){
	CCatalogDiscount::SetCoupon($_POST['COUPON']);
}
  ?>
<? $APPLICATION->IncludeComponent(
	"bitrix:sale.basket.basket", 
	".default", 
	array(
		"COMPONENT_TEMPLATE" => ".default",
		"COUNT_DISCOUNT_4_ALL_QUANTITY" => "Y",
		"COLUMNS_LIST" => array(
			0 => "NAME",
			1 => "PROPS",
			2 => "DELETE",
			3 => "PRICE",
			4 => "QUANTITY",
			5 => "SUM",
		),
		"AJAX_MODE" => "Y",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"PATH_TO_ORDER" => "/personal/order/make/",
		"HIDE_COUPON" => "N",
		"QUANTITY_FLOAT" => "N",
		"PRICE_VAT_SHOW_VALUE" => "N",
		"SET_TITLE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"USE_PREPAYMENT" => "N",
		"ACTION_VARIABLE" => "action"
	),
	false
); ?>