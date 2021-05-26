<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/**
 * @var array $arParams
 * @var array $arResult
 * @var SaleOrderAjax $component
 */

$component = $this->__component;
$component::scaleImages($arResult['JS_DATA'], $arParams['SERVICES_IMAGES_SCALING']);

//$arResult['JS_DATA']["ORDER_PROP"]["properties"]["5"]["VALUE"]["0"]="";
?>
<!--<pre>--><?//print_r($arResult['JS_DATA'])?><!--</pre>-->

