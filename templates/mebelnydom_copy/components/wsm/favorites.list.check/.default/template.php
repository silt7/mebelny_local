<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	die();

/**
 * @var $arParams array
 * @var $arResult array
 */

?>

<div id="wsm-favorites-list-container" class="article">
	<?
    $frame = $this->createFrame("wsm-favorites-list-container", false)->begin();
	
	if(!empty($arResult["ITEMS"]))
	{ 
       	

   $fav = array();
   foreach($arResult["ITEMS"] as $arItem):
     $fav[] = $arItem["ELEMENT_ID"];
   endforeach;   

	global $arrFilterE;
	$arrFilterE['ID'] = $fav; ?>
	<? $APPLICATION->IncludeComponent(
	"bitrix:catalog.section", 
	"visual", 
	array(
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => "2",
		"SECTION_ID" => "",
		"SECTION_CODE" => "",
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"ELEMENT_SORT_FIELD" => "CATALOG_PRICE_1",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_FIELD2" => "timestamp_x",
		"ELEMENT_SORT_ORDER2" => "asc",
		"FILTER_NAME" => "arrFilterE",
		"INCLUDE_SUBSECTIONS" => "A",
		"SHOW_ALL_WO_SECTION" => "Y",
		"HIDE_NOT_AVAILABLE" => "Y",
		"PAGE_ELEMENT_COUNT" => "15",
		"LINE_ELEMENT_COUNT" => "3",
		"PROPERTY_CODE" => array(
			0 => "YEAR",
			1 => "CML2_ARTICLE",
			2 => "BRAND",
			3 => "CUSTOM_STORE_INFO",
			4 => "",
		),
		"OFFERS_LIMIT" => "0",
		"TEMPLATE_THEME" => "",
		"PRODUCT_SUBSCRIPTION" => "N",
		"SHOW_DISCOUNT_PERCENT" => "N",
		"SHOW_OLD_PRICE" => "N",
		"MESS_BTN_BUY" => "Купить",
		"MESS_BTN_ADD_TO_BASKET" => "В корзину",
		"MESS_BTN_SUBSCRIBE" => "Подписаться",
		"MESS_BTN_DETAIL" => "Подробнее",
		"MESS_NOT_AVAILABLE" => "Нет в наличии",
		"SECTION_URL" => "",
		"DETAIL_URL" => "/#SECTION_CODE_PATH#/#ELEMENT_CODE#.html",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"AJAX_MODE" => "Y",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "N",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_GROUPS" => "Y",
		"SET_META_KEYWORDS" => "N",
		"META_KEYWORDS" => "",
		"SET_META_DESCRIPTION" => "N",
		"META_DESCRIPTION" => "",
		"BROWSER_TITLE" => "-",
		"ADD_SECTIONS_CHAIN" => "N",
		"DISPLAY_COMPARE" => "Y",
		"SET_TITLE" => "Y",
		"SET_STATUS_404" => "N",
		"CACHE_FILTER" => "N",
		"PRICE_CODE" => array(
			0 => "BASE",
		),
		"USE_PRICE_COUNT" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"PRICE_VAT_INCLUDE" => "Y",
		"CONVERT_CURRENCY" => "N",
		"BASKET_URL" => "/personal/cart/",
		"ACTION_VARIABLE" => "action",
		"PRODUCT_ID_VARIABLE" => "id",
		"USE_PRODUCT_QUANTITY" => "Y",
		"ADD_PROPERTIES_TO_BASKET" => "N",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRODUCT_PROPERTIES" => array(
		),
		"PAGER_TEMPLATE" => "",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Товары",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "Y",
		"OFFERS_FIELD_CODE" => array(
			0 => "ID",
			1 => "CODE",
			2 => "XML_ID",
			3 => "NAME",
			4 => "TAGS",
			5 => "SORT",
			6 => "PREVIEW_TEXT",
			7 => "PREVIEW_PICTURE",
			8 => "DETAIL_TEXT",
			9 => "DETAIL_PICTURE",
			10 => "DATE_ACTIVE_FROM",
			11 => "ACTIVE_FROM",
			12 => "DATE_ACTIVE_TO",
			13 => "ACTIVE_TO",
			14 => "SHOW_COUNTER",
			15 => "SHOW_COUNTER_START",
			16 => "IBLOCK_TYPE_ID",
			17 => "IBLOCK_ID",
			18 => "IBLOCK_CODE",
			19 => "IBLOCK_NAME",
			20 => "IBLOCK_EXTERNAL_ID",
			21 => "DATE_CREATE",
			22 => "CREATED_BY",
			23 => "CREATED_USER_NAME",
			24 => "TIMESTAMP_X",
			25 => "MODIFIED_BY",
			26 => "USER_NAME",
			27 => "",
		),
		"OFFERS_PROPERTY_CODE" => array(
			0 => "MORE_PHOTO",
			1 => "COLOR_DIRECTORY",
			2 => "CML2_ARTICLE",
			3 => "SKU_SIZE_MEMORY",
			4 => "SKY_SIZE_WEIGHT",
			5 => "",
		),
		"OFFERS_SORT_FIELD" => "CATALOG_PRICE_1",
		"OFFERS_SORT_ORDER" => "asc",
		"OFFERS_SORT_FIELD2" => "id",
		"OFFERS_SORT_ORDER2" => "asc",
		"PROP_MORE_PHOTO" => "MORE_PHOTO",
		"PROP_ARTICLE" => "-",
		"PROP_ACCESSORIES" => "-",
		"USE_FAVORITE" => "Y",
		"USE_SHARE" => "Y",
		"SHOW_ERROR_EMPTY_ITEMS" => "Y",
		"DONT_SHOW_LINKS" => "N",
		"USE_STORE" => "N",
		"USE_MIN_AMOUNT" => "Y",
		"MIN_AMOUNT" => "10",
		"MAIN_TITLE" => "Наличие на складах",
		"PROP_SKU_MORE_PHOTO" => "MORE_PHOTO",
		"PROP_SKU_ARTICLE" => "-",
		"PROPS_ATTRIBUTES" => "",
		"OFFERS_CART_PROPERTIES" => array(
		),
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"AJAXPAGESID" => "ajaxpages_main",
		"IS_AJAXPAGES" => $isAjaxPages,
		"IS_SORTERCHANGE" => $isSorterChange,
		"AJAX_OPTION_ADDITIONAL" => "",
		"VIEW" => $alfaCTemplate,
		"COLUMNS5" => "Y",
		"SET_BROWSER_TITLE" => "N",
		"USE_AUTO_AJAXPAGES" => "N",
		"PROPS_ATTRIBUTES_COLOR" => "",
		"COMPARE_PATH" => "",
		"OFF_SMALLPOPUP" => "N",
		"COMPONENT_TEMPLATE" => "search",
		"BACKGROUND_IMAGE" => "-",
		"SEF_MODE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"EMPTY_ITEMS_HIDE_FIL_SORT" => "Y",
		"OFF_MEASURE_RATION" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => "",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"USE_SHADOW_ON_HOVER" => "N",
		"STICKERS_PROPS" => "",
		"STICKERS_DISCOUNT_VALUE" => "Y",
		"CUSTOM_FILTER" => "",
		"HIDE_NOT_AVAILABLE_OFFERS" => "N",
		"HIDE_IN_LIST" => "N",
		"PROP_STORE_REPLACE_SECTION" => "0",
		"COMPATIBLE_MODE" => "Y",
		"PRODUCT_DISPLAY_MODE" => "N",
		"ADD_PICT_PROP" => "-",
		"LABEL_PROP" => "-",
		"OFFER_ADD_PICT_PROP" => "-",
		"OFFER_TREE_PROPS" => array(
			0 => "",
			1 => "-",
			2 => "",
		)
	),
	false
); 

	/*if(!empty($arResult["ITEMS"]))
	{
		if($arParams["DISPLAY_TOP_PAGER"])
			echo $arResult["NAV_STRING"].'<br/>';
			
		?>
		<form action="" class="user-favorites" method="POST" id="user-favorites">
			<input type="hidden" name="SAVE_TO" value="<?=$arResult["SAVE_TO"]?>"/>

			<table class="responsive fav">
                <thead>
                    <tr>
                        <th>Действия</th>
                        <th>Дата</th>
                        <th>Изображение</th>
                        <th>Название товара</th>
                    </tr>
                </thead>
			<? foreach($arResult["ITEMS"] as $arItem):?>
				<tr>
					<td class="cb">
                    
                    <label class="checkbox__label">
                        <input type="checkbox" class="checkbox" name="favorite[]" value="<?=$arItem['ELEMENT_ID']?>">
                        <span class="checkbox__text">Удалить</span>
                    </label>
                    </td>
					<? if($arParams["DISPLAY_DATE_CREATE"]):?>
					<td class="date">
						<? echo $arItem["DISPLAY_DATE_CREATE"]?>
					</td>
					<?endif?>
					<?if($arParams["DISPLAY_IMAGE"]):?>
					<?
					$img = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], array('width'=>30, 'height'=>30), BX_RESIZE_IMAGE_EXACT, true); 
					//BX_RESIZE_IMAGE_PROPORTIONAL	
					?>
					<td class="image">
						<? if($img): ?>
						<img src="<?=$img['src']?>" width="<?=$img['width']?>" height="<?=$img['height']?>" class="auto"/>
						<? endif; ?>
					</td>
					<?endif?>
					<td class="desc-product">
						<a href="<?=$arItem["DETAIL_URL"];?>"><?=$arItem["NAME"];?></a>
						<?
						/*
						<button type="submit" value="<?=$arItem['ELEMENT_ID']?>" onClick="if(!confirm('<?=GetMessage('WSM_FAVORITES_DEL_CONFIRM_ONE');?>')) return false;" name="removeFavID" value="<?=$arItem['ELEMENT_ID']?>"><?=GetMessage("WSM_FAVORITES_REMOVE")?></button>
						*/
						?>
    <? /*?>                 
					</td>
				</tr>
			<?endforeach;?>
			</table>
            <br>
			<input type="submit" onClick="if(!confirm('<?=GetMessage('WSM_FAVORITES_DEL_CONFIRM');?>')) return false;" name="removeFav" value="<?=GetMessage("WSM_FAVORITES_REMOVE")?>" class="btn-def"/>
		</form>
		<?

		if($arParams["DISPLAY_BOTTOM_PAGER"])
			echo '<br />'.$arResult["NAV_STRING"]; */
	}
	else
	{ ?>
		<div class="article" style="min-height:150px;"><p><? echo GetMessage("WSM_FAVORITES_NOT_FOUND"); ?></div>
	<? }
	
	$frame->beginStub(); 
	
		echo 'Загрузка...';

	$frame->end();
	?>
</div>

<? //echo "<pre>"; print_r($arResult); echo "</pre>"; ?>