<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

$arResult['ITEMS'] = array();
foreach ($arResult['SECTIONS'] as $item) {
    if ($item['IBLOCK_SECTION_ID'] > 0) {
        $arResult['ITEMS'][$item['IBLOCK_SECTION_ID']]['CHILD'][] = $item;
    } else {
        $item['CHILD'] = array();
        $arResult['ITEMS'][$item['ID']] = $item;
    }
}

$this->setFrameMode(true);
?>

<?php
    $index = 0;
    foreach ($arResult['ITEMS'] as $item) {
        if ($index >= 3) break;
        $index += 1;
?>
<div class="content-wrap">
    <div class="left-sidebar">
        <div class="w2017">
            <div class="h3"><a href="<?=$item['SECTION_PAGE_URL']?>"><?=$item['NAME']?></a> 
				<?if($item['ELEMENT_CNT']):?><span>(<?=$item['ELEMENT_CNT']?>)</span><?endif;?>
            </div>
        </div>
        <ul class="sidebar-list">
            <li class="pc-block"><a href="<?=$item["SECTION_PAGE_URL"]?>" class="show-all mob">Показать все</a></li>
            <?php $childIndex = 0; foreach ($item['CHILD'] as $child) { ?>
                <?php if (++$childIndex > 12) break; ?>
            <li><a href="<?=$child['SECTION_PAGE_URL']?>"><?=$child['NAME']?></a></li>
            <?php } ?>
            <li><a href="<?=$item["SECTION_PAGE_URL"]?>" class="show-all">Показать все</a></li>
        </ul>
    </div>
<? $APPLICATION->IncludeComponent(
    "bitrix:catalog.section",
    "main",
    Array(
        "ACTION_VARIABLE" => "action",
        "ADD_PICT_PROP" => "MORE_PHOTO",
        "ADD_PROPERTIES_TO_BASKET" => "Y",
        "ADD_SECTIONS_CHAIN" => "N",
        "ADD_TO_BASKET_ACTION" => "ADD",
        "AJAX_MODE" => "N",
        "AJAX_OPTION_ADDITIONAL" => "",
        "AJAX_OPTION_HISTORY" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "BACKGROUND_IMAGE" => "UF_BACKGROUND_IMAGE",
        "BASKET_URL" => "/personal/basket.php",
        "BRAND_PROPERTY" => "BRAND_REF",
        "BROWSER_TITLE" => "-",
        "CACHE_FILTER" => "N",
        "CACHE_GROUPS" => "Y",
        "CACHE_TIME" => "36000000",
        "CACHE_TYPE" => "A",
        "COMPATIBLE_MODE" => "Y",
        "CONVERT_CURRENCY" => "Y",
        "CURRENCY_ID" => "RUB",
        "CUSTOM_FILTER" => "",
        "DATA_LAYER_NAME" => "dataLayer",
        "DETAIL_URL" => "",
        "DISABLE_INIT_JS_IN_COMPONENT" => "N",
        "DISCOUNT_PERCENT_POSITION" => "bottom-right",
        "DISPLAY_BOTTOM_PAGER" => "Y",
        "DISPLAY_TOP_PAGER" => "N",
        "ELEMENT_SORT_FIELD" => "sort",
        "ELEMENT_SORT_FIELD2" => "id",
        "ELEMENT_SORT_ORDER" => "asc",
        "ELEMENT_SORT_ORDER2" => "desc",
        "ENLARGE_PRODUCT" => "PROP",
        "ENLARGE_PROP" => "NEWPRODUCT",
        "FILTER_NAME" => "arrFilter",
        "HIDE_NOT_AVAILABLE" => "N",
        "HIDE_NOT_AVAILABLE_OFFERS" => "N",
        "IBLOCK_ID" => $arParams['IBLOCK_ID'],
        "IBLOCK_TYPE" => $arParams['IBLOCK_TYPE'],
        "INCLUDE_SUBSECTIONS" => "Y",
        "LABEL_PROP" => array(),
        "LABEL_PROP_MOBILE" => array(),
        "LABEL_PROP_POSITION" => "top-left",
        "LAZY_LOAD" => "Y",
        "LINE_ELEMENT_COUNT" => "3",
        "LOAD_ON_SCROLL" => "N",
        "MESSAGE_404" => "",
        "MESS_BTN_ADD_TO_BASKET" => "В корзину",
        "MESS_BTN_BUY" => "Купить",
        "MESS_BTN_DETAIL" => "Подробнее",
        "MESS_BTN_LAZY_LOAD" => "Показать ещё",
        "MESS_BTN_SUBSCRIBE" => "Подписаться",
        "MESS_NOT_AVAILABLE" => "Нет в наличии",
        "META_DESCRIPTION" => "-",
        "META_KEYWORDS" => "-",
        "OFFERS_CART_PROPERTIES" => array(),
        "OFFERS_FIELD_CODE" => array(),
        "OFFERS_LIMIT" => "5",
        "OFFERS_PROPERTY_CODE" => array(),
        "OFFERS_SORT_FIELD" => "sort",
        "OFFERS_SORT_FIELD2" => "id",
        "OFFERS_SORT_ORDER" => "asc",
        "OFFERS_SORT_ORDER2" => "desc",
        "OFFER_ADD_PICT_PROP" => "MORE_PHOTO",
        "OFFER_TREE_PROPS" => array(),
        "PAGER_BASE_LINK_ENABLE" => "N",
        "PAGER_DESC_NUMBERING" => "N",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
        "PAGER_SHOW_ALL" => "N",
        "PAGER_SHOW_ALWAYS" => "N",
        "PAGER_TEMPLATE" => ".default",
        "PAGER_TITLE" => "Товары",
        "PAGE_ELEMENT_COUNT" => "5",
        "PARTIAL_PRODUCT_PROPERTIES" => "N",
        "PRICE_CODE" => array("BASE"),
        "PRICE_VAT_INCLUDE" => "Y",
        "PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons,compare",
        "PRODUCT_DISPLAY_MODE" => "Y",
        "PRODUCT_ID_VARIABLE" => "id",
        "PRODUCT_PROPERTIES" => array(),
        "PRODUCT_PROPS_VARIABLE" => "prop",
        "PRODUCT_QUANTITY_VARIABLE" => "",
        "PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':true}]",
        "PRODUCT_SUBSCRIPTION" => "Y",
        "PROPERTY_CODE" => array(),
        "PROPERTY_CODE_MOBILE" => array(),
        "RCM_PROD_ID" => "",
        "RCM_TYPE" => "personal",
        "SECTION_CODE" => "",
        "SECTION_ID" => $item["ID"],
        "SECTION_ID_VARIABLE" => "",
        "SECTION_URL" => "",
        "SECTION_USER_FIELDS" => array("",""),
        "SEF_MODE" => "N",
        "SET_BROWSER_TITLE" => "Y",
        "SET_LAST_MODIFIED" => "N",
        "SET_META_DESCRIPTION" => "Y",
        "SET_META_KEYWORDS" => "Y",
        "SET_STATUS_404" => "N",
        "SET_TITLE" => "Y",
        "SHOW_404" => "N",
        "SHOW_ALL_WO_SECTION" => "N",
        "SHOW_CLOSE_POPUP" => "N",
        "SHOW_DISCOUNT_PERCENT" => "Y",
        "SHOW_FROM_SECTION" => "N",
        "SHOW_MAX_QUANTITY" => "N",
        "SHOW_OLD_PRICE" => "N",
        "SHOW_PRICE_COUNT" => "1",
        "SHOW_SLIDER" => "Y",
        "SLIDER_INTERVAL" => "3000",
        "SLIDER_PROGRESS" => "N",
        "TEMPLATE_THEME" => "blue",
        "USE_ENHANCED_ECOMMERCE" => "Y",
        "USE_MAIN_ELEMENT_SECTION" => "N",
        "USE_PRICE_COUNT" => "N",
        "USE_PRODUCT_QUANTITY" => "N"
    ),
    $component
); ?>
</div>
<?php } ?>


<div class="product-slider">
<?php
    $index = 0;
    foreach ($arResult['ITEMS'] as $item) {
        $index += 1;
        if ($index <= 3) continue;
		if ($index == 9) break;
?>
    <div class="product-slider__item">
        <div class="item-wrap">
            <?php if (!empty($item['PICTURE']['SRC'])) { ?>
            <img src="<?=$item['PICTURE']['SRC']?>" alt="<?=$item['PICTURE']['ALT']?>" title="<?=$item['PICTURE']['TITLE']?>" />
            <?php } ?>
            <div class="h5"><a href="<?=$item['SECTION_PAGE_URL']?>"><?=$item['NAME']?></a> 
<?if($item['ELEMENT_CNT']):?><span>(<?=$item['ELEMENT_CNT']?>)</span>
<?endif;?>
</div>
            <ul class="slider-list slider-list-1">
            <?php foreach ($item['CHILD'] as $child) { ?>
                <li><a href="<?=$child['SECTION_PAGE_URL']?>"><?=$child['NAME']?></a></li>
            <?php } ?>
            </ul>
            <a href="<?=$item["SECTION_PAGE_URL"]?>" class="show-all"><span></span><span></span><span></span></a>
        </div>
    </div>
<?php } ?>
</div>

<? //if($USER->IsAdmin()) {echo '<pre>'; print_r($arResult); echo '</pre>'; }