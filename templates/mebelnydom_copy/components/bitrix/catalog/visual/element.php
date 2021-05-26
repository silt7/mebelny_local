<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
$this->addExternalCss(SITE_TEMPLATE_PATH.'/libs/owlcarousel/owl.carousel.min.css');
$this->addExternalCss(SITE_TEMPLATE_PATH.'/libs/owlcarousel/owl.theme.default.min.css');
$this->addExternalJs(SITE_TEMPLATE_PATH.'/libs/owlcarousel/owl.carousel.min.js');
echo "<div class='container'>";

$GLOBALS["FOR_BREADCRUMB"] = 'detail';
$APPLICATION->IncludeComponent("bitrix:breadcrumb","",Array(
        "START_FROM" => "0", 
        "PATH" => "", 
        "SITE_ID" => "s1" 
    )
);
echo "</div>";
$ElementID = $APPLICATION->IncludeComponent(
"bitrix:catalog.element",
"visual",
array(
	"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
	"IBLOCK_ID" => $arParams["IBLOCK_ID"],
	"PROPERTY_CODE" => $arParams["DETAIL_PROPERTY_CODE"],
	"META_KEYWORDS" => $arParams["DETAIL_META_KEYWORDS"],
	"META_DESCRIPTION" => $arParams["DETAIL_META_DESCRIPTION"],
	"BROWSER_TITLE" => $arParams["DETAIL_BROWSER_TITLE"],
	"BASKET_URL" => $arParams["BASKET_URL"],
	"ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
	"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
	"SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
	"PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
	"PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
	"CACHE_TYPE" => $arParams["CACHE_TYPE"],
	"CACHE_TIME" => $arParams["CACHE_TIME"],
	"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
	"SET_TITLE" => $arParams["SET_TITLE"],
	"SET_STATUS_404" => $arParams["SET_STATUS_404"],
	"PRICE_CODE" => $arParams["PRICE_CODE"],
	"USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
	"SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],
	"PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
	"PRICE_VAT_SHOW_VALUE" => $arParams["PRICE_VAT_SHOW_VALUE"],
	"USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
	"PRODUCT_PROPERTIES" => $arParams["PRODUCT_PROPERTIES"],
	"LINK_IBLOCK_TYPE" => $arParams["LINK_IBLOCK_TYPE"],
	"LINK_IBLOCK_ID" => $arParams["LINK_IBLOCK_ID"],
	"LINK_PROPERTY_SID" => $arParams["LINK_PROPERTY_SID"],
	"LINK_ELEMENTS_URL" => $arParams["LINK_ELEMENTS_URL"],

	"OFFERS_CART_PROPERTIES" => $arParams["OFFERS_CART_PROPERTIES"],
	"OFFERS_FIELD_CODE" => $arParams["DETAIL_OFFERS_FIELD_CODE"],
	"OFFERS_PROPERTY_CODE" => $arParams["DETAIL_OFFERS_PROPERTY_CODE"],
	"OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
	"OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
	"OFFERS_SORT_FIELD2" => $arParams["OFFERS_SORT_FIELD2"],
	"OFFERS_SORT_ORDER2" => $arParams["OFFERS_SORT_ORDER2"],

	"ELEMENT_ID" => $arResult["VARIABLES"]["ELEMENT_ID"],
	"ELEMENT_CODE" => $arResult["VARIABLES"]["ELEMENT_CODE"],
	"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
	"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
	"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
	"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],

	"ADD_ELEMENT_CHAIN" => $arParams["ADD_ELEMENT_CHAIN"],
	"ADD_SECTIONS_CHAIN" => $arParams["ADD_SECTIONS_CHAIN"],
	"DISPLAY_COMPARE" => "Y",
	"COMPARE_PATH" => $arParams["SEF_URL_TEMPLATES"]["compare"],

	'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
	'CURRENCY_ID' => $arParams['CURRENCY_ID'],
	'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
	'USE_ELEMENT_COUNTER' => $arParams['USE_ELEMENT_COUNTER'],

	'LABEL_PROP' => $arParams['LABEL_PROP'],
	'OFFER_ADD_PICT_PROP' => $arParams['OFFER_ADD_PICT_PROP'],
	'OFFER_TREE_PROPS' => $arParams['OFFER_TREE_PROPS'],
	'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
	'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
	'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
	'SHOW_MAX_QUANTITY' => $arParams['DETAIL_SHOW_MAX_QUANTITY'],
	'MESS_BTN_BUY' => $arParams['MESS_BTN_BUY'],
	'SET_CANONICAL_URL' => $arParams['DETAIL_SET_CANONICAL_URL'],
	'MESS_BTN_ADD_TO_BASKET' => $arParams['MESS_BTN_ADD_TO_BASKET'],
	'MESS_BTN_SUBSCRIBE' => $arParams['MESS_BTN_SUBSCRIBE'],
	'MESS_BTN_COMPARE' => $arParams['MESS_BTN_COMPARE'],
	'MESS_NOT_AVAILABLE' => $arParams['MESS_NOT_AVAILABLE'],
	'USE_VOTE_RATING' => $arParams['DETAIL_USE_VOTE_RATING'],
	'VOTE_DISPLAY_AS_RATING' => (isset($arParams['DETAIL_VOTE_DISPLAY_AS_RATING']) ? $arParams['DETAIL_VOTE_DISPLAY_AS_RATING'] : ''),
	'USE_COMMENTS' => $arParams['DETAIL_USE_COMMENTS'],
	'BLOG_USE' => (isset($arParams['DETAIL_BLOG_USE']) ? $arParams['DETAIL_BLOG_USE'] : ''),
	'VK_USE' => (isset($arParams['DETAIL_VK_USE']) ? $arParams['DETAIL_VK_USE'] : ''),
	'VK_API_ID' => (isset($arParams['DETAIL_VK_API_ID']) ? $arParams['DETAIL_VK_API_ID'] : 'API_ID'),
	'FB_USE' => (isset($arParams['DETAIL_FB_USE']) ? $arParams['DETAIL_FB_USE'] : ''),
	'FB_APP_ID' => (isset($arParams['DETAIL_FB_APP_ID']) ? $arParams['DETAIL_FB_APP_ID'] : ''),
),
$component);
?>

<div class="container">
<?// Рекомендуемые товары
$arSelect = Array("ID", "PROPERTY_RECOMMEND");
$arFilter = Array("IBLOCK_ID"=>"2", "ID" => $ElementID);
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);
while($ob = $res->GetNextElement()) {
	$arFields = $ob->GetFields();
	if(!empty($arFields["PROPERTY_RECOMMEND_VALUE"])){
		$rec[] = $arFields["PROPERTY_RECOMMEND_VALUE"];
	}
}
if(isset($rec)){
	global $arrFilterV; $arrFilterV = array('ID' => $rec);
	$APPLICATION->IncludeComponent(
		"bitrix:catalog.section",
		"popular-carousel",
		array(
		"ACTION_VARIABLE" => "action",
		"ADD_PICT_PROP" => "-",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BACKGROUND_IMAGE" => "-",
		"BASKET_URL" => "/personal/cart/",
		"BROWSER_TITLE" => "-",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COMPONENT_TEMPLATE" => "popular-carousel",
		"CONVERT_CURRENCY" => "N",
		"CUSTOM_FILTER" => "",
		"DETAIL_URL" => "",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_COMPARE" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_SORT_FIELD" => "SORT",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_ORDER2" => "desc",
		"FILTER_NAME" => "arrFilterV",
		"HIDE_NOT_AVAILABLE" => "N",
		"HIDE_NOT_AVAILABLE_OFFERS" => "N",
		"IBLOCK_ID" => "2",
		"IBLOCK_TYPE" => "catalog",
		"INCLUDE_SUBSECTIONS" => "Y",
		"LABEL_PROP" => "-",
		"LINE_ELEMENT_COUNT" => "3",
		"MESSAGE_404" => "",
		"MESS_BTN_ADD_TO_BASKET" => "В корзину",
		"MESS_BTN_BUY" => "Купить",
		"MESS_BTN_DETAIL" => "Подробнее",
		"MESS_BTN_SUBSCRIBE" => "Подписаться",
		"MESS_NOT_AVAILABLE" => "Нет в наличии",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"OFFERS_LIMIT" => "5",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "bootstrap",
		"PAGER_TITLE" => "Товары",
		"PAGE_ELEMENT_COUNT" => "10",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRICE_CODE" => array(
			0 => "BASE",
		),
		"PRICE_VAT_INCLUDE" => "Y",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_PROPERTIES" => array(
		),
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"PRODUCT_SUBSCRIPTION" => "N",
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"SECTION_CODE" => "",
		"SECTION_ID" => "",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SECTION_URL" => "",
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SEF_MODE" => "N",
		"SET_BROWSER_TITLE" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "Y",
		"SHOW_404" => "N",
		"SHOW_ALL_WO_SECTION" => "Y",
		"SHOW_DISCOUNT_PERCENT" => "N",
		"SHOW_OLD_PRICE" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"USE_PRICE_COUNT" => "N",
		"USE_PRODUCT_QUANTITY" => "N",
		"BLOCK_TITLE" => "Популярные",
		"OFFERS_SORT_FIELD" => "CATALOG_PRICE_1",
		"OFFERS_SORT_ORDER" => "asc",
		"OFFERS_SORT_FIELD2" => "id",
		"OFFERS_SORT_ORDER2" => "desc",
		"OFFERS_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"OFFERS_PROPERTY_CODE" => array(
			0 => "RAZMER_SPALNOGO_MESTA",
			1 => "HEIGHT",
			2 => "KATEGORY_MATERIALA",
			3 => "KRASHENIE",
			4 => "NALICHIE_MEHANIZMA",
			5 => "HEHOL",
			6 => "WIDTH",
			7 => "",
		),
		"PRODUCT_DISPLAY_MODE" => "N",
		"OFFER_ADD_PICT_PROP" => "-",
		"OFFER_TREE_PROPS" => array(
			0 => "",
			1 => "-",
			2 => "",
		),
		"OFFERS_CART_PROPERTIES" => array(
		),
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
		),
		$component
	);
}?>
</div>

<div class="container">
<?
// Похожие товары
// Получим ID раздела текущего элемента
$arElement=CIBlockElement::GetByID($ElementID)->GetNext();
$curSectionID=$arElement['IBLOCK_SECTION_ID'];
$res = CIBlockElement::GetProperty(2, $ElementID, array("sort" => "asc"), Array());
while ($ob = $res->GetNext()) {
    $arElProps[$ob["CODE"]]=$ob;
}
if($arParams['DETAIL_PROPS_ANALOG']) {
    // сделаем вывод похожих товаров
    $arSelect = Array(
        "ID",
        "NAME"
    );
    // для выборки свойств по которым будем сравнивать
    foreach($arParams['DETAIL_PROPS_ANALOG'] as $det_props) {
        if($det_props != ''){
            $arSelect[] = 'PROPERTY_'.$det_props;
        }

    }
    // фильтрование, в данном случае из того же инфоблока , раздела, активные
    $arFilter = Array(
        "IBLOCK_ID"=>2,
        "SECTION_ID" => $curSectionID,
        "ACTIVE"=>"Y" ,
        "!ID" => $ElementID
    );
    $arr_analogs = CIBlockElement::GetList(Array("RAND" => "ASC"), $arFilter, false, false, $arSelect);

    $analog_count_id = array();
    while($arr_analog = $arr_analogs->GetNextElement())
    {
        $element = $arr_analog->GetFields();
        // теперь сравним товарары
        $i = 0;
        foreach($arParams['DETAIL_PROPS_ANALOG'] as $analog_propers) {
            $analog_propers_up = mb_strtoupper($analog_propers);
            if($arElProps[$analog_propers]['VALUE_ENUM'] == $element['PROPERTY_'.$analog_propers_up.'_VALUE'] || $arElProps[$analog_propers]['VALUE'] == $element['PROPERTY_'.$analog_propers_up.'_VALUE']) {
                $i++;
            }
        }
        $analog_count_id[$element['ID']] = $i;
        $analog[$element['ID']] = $element;
    }
    arsort($analog_count_id);
    $analog_count_id = array_slice($analog_count_id, 0, 7, true);
    $arSimilarIds = array();
    foreach ($analog_count_id as $key => $value){
        $arSimilarIds[] = $key;
    }
}
if($arSimilarIds){
    global $arrFilterSimilar; $arrFilterSimilar = array('ID' => $arSimilarIds);
    $APPLICATION->IncludeComponent(
    	"bitrix:catalog.section",
    	"similar-carousel",
	array(
    	"ACTION_VARIABLE" => "action",
    	"ADD_PICT_PROP" => "-",
    	"ADD_PROPERTIES_TO_BASKET" => "Y",
    	"ADD_SECTIONS_CHAIN" => "N",
    	"AJAX_MODE" => "N",
    	"AJAX_OPTION_ADDITIONAL" => "",
    	"AJAX_OPTION_HISTORY" => "N",
    	"AJAX_OPTION_JUMP" => "N",
    	"AJAX_OPTION_STYLE" => "Y",
    	"BACKGROUND_IMAGE" => "-",
    	"BASKET_URL" => "/personal/cart/",
    	"BROWSER_TITLE" => "-",
    	"CACHE_FILTER" => "N",
    	"CACHE_GROUPS" => "Y",
    	"CACHE_TIME" => "36000000",
    	"CACHE_TYPE" => "A",
    	"COMPATIBLE_MODE" => "Y",
    	"COMPONENT_TEMPLATE" => "popular-carousel",
    	"CONVERT_CURRENCY" => "N",
    	"CUSTOM_FILTER" => "",
    	"DETAIL_URL" => "",
    	"DISABLE_INIT_JS_IN_COMPONENT" => "N",
    	"DISPLAY_BOTTOM_PAGER" => "Y",
    	"DISPLAY_COMPARE" => "N",
    	"DISPLAY_TOP_PAGER" => "N",
    	"ELEMENT_SORT_FIELD" => "SORT",
    	"ELEMENT_SORT_FIELD2" => "id",
    	"ELEMENT_SORT_ORDER" => "asc",
    	"ELEMENT_SORT_ORDER2" => "desc",
    	"FILTER_NAME" => "arrFilterSimilar",
    	"HIDE_NOT_AVAILABLE" => "N",
    	"HIDE_NOT_AVAILABLE_OFFERS" => "N",
    	"IBLOCK_ID" => "2",
    	"IBLOCK_TYPE" => "catalog",
    	"INCLUDE_SUBSECTIONS" => "Y",
    	"LABEL_PROP" => "-",
    	"LINE_ELEMENT_COUNT" => "3",
    	"MESSAGE_404" => "",
    	"MESS_BTN_ADD_TO_BASKET" => "В корзину",
    	"MESS_BTN_BUY" => "Купить",
    	"MESS_BTN_DETAIL" => "Подробнее",
    	"MESS_BTN_SUBSCRIBE" => "Подписаться",
    	"MESS_NOT_AVAILABLE" => "Нет в наличии",
    	"META_DESCRIPTION" => "-",
    	"META_KEYWORDS" => "-",
    	"OFFERS_LIMIT" => "5",
    	"PAGER_BASE_LINK_ENABLE" => "N",
    	"PAGER_DESC_NUMBERING" => "N",
    	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
    	"PAGER_SHOW_ALL" => "N",
    	"PAGER_SHOW_ALWAYS" => "N",
    	"PAGER_TEMPLATE" => "bootstrap",
    	"PAGER_TITLE" => "Товары",
    	"PAGE_ELEMENT_COUNT" => "10",
    	"PARTIAL_PRODUCT_PROPERTIES" => "N",
    	"PRICE_CODE" => array(
    		0 => "BASE",
    	),
    	"PRICE_VAT_INCLUDE" => "Y",
    	"PRODUCT_ID_VARIABLE" => "id",
    	"PRODUCT_PROPERTIES" => array(
    	),
    	"PRODUCT_PROPS_VARIABLE" => "prop",
    	"PRODUCT_QUANTITY_VARIABLE" => "quantity",
    	"PRODUCT_SUBSCRIPTION" => "N",
    	"PROPERTY_CODE" => array(
    		0 => "",
    		1 => "",
    	),
    	"SECTION_CODE" => "",
    	"SECTION_ID" => "",
    	"SECTION_ID_VARIABLE" => "SECTION_ID",
    	"SECTION_URL" => "",
    	"SECTION_USER_FIELDS" => array(
    		0 => "",
    		1 => "",
    	),
    	"SEF_MODE" => "N",
    	"SET_BROWSER_TITLE" => "Y",
    	"SET_LAST_MODIFIED" => "N",
    	"SET_META_DESCRIPTION" => "Y",
    	"SET_META_KEYWORDS" => "Y",
    	"SET_STATUS_404" => "N",
    	"SET_TITLE" => "Y",
    	"SHOW_404" => "N",
    	"SHOW_ALL_WO_SECTION" => "Y",
    	"SHOW_DISCOUNT_PERCENT" => "N",
    	"SHOW_OLD_PRICE" => "N",
    	"SHOW_PRICE_COUNT" => "1",
    	"USE_MAIN_ELEMENT_SECTION" => "N",
    	"USE_PRICE_COUNT" => "N",
    	"USE_PRODUCT_QUANTITY" => "N",
    	"BLOCK_TITLE" => "Популярные",
    	"OFFERS_SORT_FIELD" => "CATALOG_PRICE_1",
    	"OFFERS_SORT_ORDER" => "asc",
    	"OFFERS_SORT_FIELD2" => "id",
    	"OFFERS_SORT_ORDER2" => "desc",
    	"OFFERS_FIELD_CODE" => array(
    		0 => "",
    		1 => "",
    	),
    	"OFFERS_PROPERTY_CODE" => array(
    		0 => "RAZMER_SPALNOGO_MESTA",
    		1 => "HEIGHT",
    		2 => "KATEGORY_MATERIALA",
    		3 => "KRASHENIE",
    		4 => "NALICHIE_MEHANIZMA",
    		5 => "HEHOL",
    		6 => "WIDTH",
    		7 => "",
    	),
    	"PRODUCT_DISPLAY_MODE" => "N",
    	"OFFER_ADD_PICT_PROP" => "-",
    	"OFFER_TREE_PROPS" => array(
    		0 => "",
    		1 => "-",
    		2 => "",
    	),
    	"OFFERS_CART_PROPERTIES" => array(
    	),
    	"COMPOSITE_FRAME_MODE" => "A",
    	"COMPOSITE_FRAME_TYPE" => "AUTO"
    	),
    	$component
    );
}
?>
</div>

<div class="container">
<? // Просмотренные товары
	$arViewedID=$_SESSION['VIEWED_ID'];
	$arViewedID[] = $ElementID;
	$arViewedID=array_unique($arViewedID);
	session_start();
	$_SESSION['VIEWED_ID']=$arViewedID;

global $arrFilterViewed; $arrFilterViewed = array('ID' => $arViewedID);
$APPLICATION->IncludeComponent(
	"bitrix:catalog.section",
	"viewed-carousel",
	array(
	"ACTION_VARIABLE" => "action",
	"ADD_PICT_PROP" => "-",
	"ADD_PROPERTIES_TO_BASKET" => "Y",
	"ADD_SECTIONS_CHAIN" => "N",
	"AJAX_MODE" => "N",
	"AJAX_OPTION_ADDITIONAL" => "",
	"AJAX_OPTION_HISTORY" => "N",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"BACKGROUND_IMAGE" => "-",
	"BASKET_URL" => "/personal/cart/",
	"BROWSER_TITLE" => "-",
	"CACHE_FILTER" => "N",
	"CACHE_GROUPS" => "Y",
	"CACHE_TIME" => "36000000",
	"CACHE_TYPE" => "A",
	"COMPATIBLE_MODE" => "Y",
	"COMPONENT_TEMPLATE" => "popular-carousel",
	"CONVERT_CURRENCY" => "N",
	"CUSTOM_FILTER" => "",
	"DETAIL_URL" => "",
	"DISABLE_INIT_JS_IN_COMPONENT" => "N",
	"DISPLAY_BOTTOM_PAGER" => "Y",
	"DISPLAY_COMPARE" => "N",
	"DISPLAY_TOP_PAGER" => "N",
	"ELEMENT_SORT_FIELD" => "SORT",
	"ELEMENT_SORT_FIELD2" => "id",
	"ELEMENT_SORT_ORDER" => "asc",
	"ELEMENT_SORT_ORDER2" => "desc",
	"FILTER_NAME" => "arrFilterViewed",
	"HIDE_NOT_AVAILABLE" => "N",
	"HIDE_NOT_AVAILABLE_OFFERS" => "N",
	"IBLOCK_ID" => "2",
	"IBLOCK_TYPE" => "catalog",
	"INCLUDE_SUBSECTIONS" => "Y",
	"LABEL_PROP" => "-",
	"LINE_ELEMENT_COUNT" => "3",
	"MESSAGE_404" => "",
	"MESS_BTN_ADD_TO_BASKET" => "В корзину",
	"MESS_BTN_BUY" => "Купить",
	"MESS_BTN_DETAIL" => "Подробнее",
	"MESS_BTN_SUBSCRIBE" => "Подписаться",
	"MESS_NOT_AVAILABLE" => "Нет в наличии",
	"META_DESCRIPTION" => "-",
	"META_KEYWORDS" => "-",
	"OFFERS_LIMIT" => "5",
	"PAGER_BASE_LINK_ENABLE" => "N",
	"PAGER_DESC_NUMBERING" => "N",
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
	"PAGER_SHOW_ALL" => "N",
	"PAGER_SHOW_ALWAYS" => "N",
	"PAGER_TEMPLATE" => "bootstrap",
	"PAGER_TITLE" => "Товары",
	"PAGE_ELEMENT_COUNT" => "10",
	"PARTIAL_PRODUCT_PROPERTIES" => "N",
	"PRICE_CODE" => array(
		0 => "BASE",
	),
	"PRICE_VAT_INCLUDE" => "Y",
	"PRODUCT_ID_VARIABLE" => "id",
	"PRODUCT_PROPERTIES" => array(
	),
	"PRODUCT_PROPS_VARIABLE" => "prop",
	"PRODUCT_QUANTITY_VARIABLE" => "quantity",
	"PRODUCT_SUBSCRIPTION" => "N",
	"PROPERTY_CODE" => array(
		0 => "",
		1 => "",
	),
	"SECTION_CODE" => "",
	"SECTION_ID" => "",
	"SECTION_ID_VARIABLE" => "SECTION_ID",
	"SECTION_URL" => "",
	"SECTION_USER_FIELDS" => array(
		0 => "",
		1 => "",
	),
	"SEF_MODE" => "N",
	"SET_BROWSER_TITLE" => "Y",
	"SET_LAST_MODIFIED" => "N",
	"SET_META_DESCRIPTION" => "Y",
	"SET_META_KEYWORDS" => "Y",
	"SET_STATUS_404" => "N",
	"SET_TITLE" => "Y",
	"SHOW_404" => "N",
	"SHOW_ALL_WO_SECTION" => "Y",
	"SHOW_DISCOUNT_PERCENT" => "N",
	"SHOW_OLD_PRICE" => "N",
	"SHOW_PRICE_COUNT" => "1",
	"USE_MAIN_ELEMENT_SECTION" => "N",
	"USE_PRICE_COUNT" => "N",
	"USE_PRODUCT_QUANTITY" => "N",
	"BLOCK_TITLE" => "Популярные",
	"OFFERS_SORT_FIELD" => "CATALOG_PRICE_1",
	"OFFERS_SORT_ORDER" => "asc",
	"OFFERS_SORT_FIELD2" => "id",
	"OFFERS_SORT_ORDER2" => "desc",
	"OFFERS_FIELD_CODE" => array(
		0 => "",
		1 => "",
	),
	"OFFERS_PROPERTY_CODE" => array(
		0 => "RAZMER_SPALNOGO_MESTA",
		1 => "HEIGHT",
		2 => "KATEGORY_MATERIALA",
		3 => "KRASHENIE",
		4 => "NALICHIE_MEHANIZMA",
		5 => "HEHOL",
		6 => "WIDTH",
		7 => "",
	),
	"PRODUCT_DISPLAY_MODE" => "N",
	"OFFER_ADD_PICT_PROP" => "-",
	"OFFER_TREE_PROPS" => array(
		0 => "",
		1 => "-",
		2 => "",
	),
	"OFFERS_CART_PROPERTIES" => array(
	),
	"COMPATIBLE_MODE" => "Y",
	"COMPOSITE_FRAME_MODE" => "A",
	"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	$component
);?>
</div>


<div class="container">
	<div class="recomend__product w1510_Element">
        <span class="h3">Популярные разделы</span>
	</div>
    <?
    // Получим привязанные разделы текущего элемента
    if(!CModule::IncludeModule("iblock"))
    return;
    {
        $dbGroups = CIBlockElement::GetElementGroups($ElementID, true);
        while($arGroups = $dbGroups->Fetch())
        {
            if($arGroups['DEPTH_LEVEL']>=2){
                $arSectionsTiedID[] = $arGroups['ID'];
            }
        }
	}

    ?>
	<div class="w1510_menuTags w1510_Element">
        <div class="w1510_menuTags_wrap">
            <div class="w1510_menuTags_left">
				<?foreach($arSectionsTiedID as $arSectionID):?>
				<?
				$arSection=CIBlockSection::GetByID($arSectionID)->GetNext();
				$activeElements = CIBlockSection::GetSectionElementsCount($arSectionID, Array("CNT_ACTIVE"=>"Y"));
				$arSectIdArr[$arSectionID]=$arSection['NAME'];
				endforeach;
				//print_r($arSectIdArr);
				uasort($arSectIdArr, function($a, $b) {
					$difference =  strlen($a) - strlen($b);

					return $difference ?: strcmp($a, $b);
				});
				//print_r($arSectIdArr);

				?>
				<?foreach($arSectionsTiedID as $arSectionID):?>
					<?
						$arSection=CIBlockSection::GetByID($arSectionID)->GetNext();
						//$activeElements = CIBlockSection::GetSectionElementsCount($arSectionID, Array("CNT_ACTIVE"=>"Y", "PROPERTY"=>array("NAME" => 'Зеркало «Йорк» 80, Белый')));
						$arOrder = Array("SORT"=>"ASC");
						$arFilter = Array("SECTION_ID" => $arSectionID, "ACTIVE"=>"Y", array("LOGIC" => "OR", ">PROPERTY_POD_ZAKAZ" => 0, ">PROPERTY_QTY" => 0));
						$activeElements = CIBlockElement::GetList($arOrder,$arFilter)->SelectedRowsCount();
					?>
					<?if(($arSection["ACTIVE"]=="Y") && ($arSection["GLOBAL_ACTIVE"]=="Y") && ($activeElements > 0)):?>
					<div class="w1510_menuTags_item">
						<a href="<?=$arSection['SECTION_PAGE_URL']?>"><?=$arSection['NAME']?> <span>(<?=$activeElements?>)</span></a>
					</div>
					<?endif;?>
                <?endforeach?>
            </div>

        </div>
    </div>
</div>
<div id="modal_review" style="display:none; padding:10px" class="bx_login_popup_form">
    <? $APPLICATION->IncludeComponent(
	"askaron:askaron.reviews.new", 
	"md", 
	array(
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"ELEMENT_ID" => $ElementID,
		"COMPONENT_TEMPLATE" => "md",
		"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);?>
</div>
<? $res = CIBlockElement::GetByID($ElementID);?>
<? if($ar_res = $res->GetNext()) {$GLOBALS['PRODUCT_NAME'] = $ar_res['NAME'];}?>
<div id="bx_recall_popup_form2" style="display:none;" class="bx_login_popup_form" >
	<? $APPLICATION->IncludeComponent(
    	"bitrix:form.result.new", 
    	"fb2", 
    	array(
    		"CACHE_TIME" => "3600",
    		"CACHE_TYPE" => "Y",
    		"AJAX_MODE" => "Y",
    		"AJAX_OPTION_JUMP" => "N",
    		"AJAX_OPTION_STYLE" => "N",
    		"AJAX_OPTION_HISTORY" => "N",
    		"CHAIN_ITEM_LINK" => "",
    		"CHAIN_ITEM_TEXT" => "",
    		"EDIT_URL" => "",
    		"IGNORE_CUSTOM_TEMPLATE" => "N",
    		"LIST_URL" => "",
    		"SEF_MODE" => "Y",
    		"SEF_FOLDER" => "/",
    		"SUCCESS_URL" => "",
    		"USE_EXTENDED_ERRORS" => "N",
    		"WEB_FORM_ID" => "7",
    		"COMPONENT_TEMPLATE" => "fb2"
    	),
    	false
    );?>
</div>
<script>
    $('input[name="form_hidden_21"]').val("<?= $ar_res['NAME'];?>");
    $('input[name="form_hidden_22"]').val("<?= $ElementID;?>");
</script>