<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

use Bitrix\Main\Loader;

if (!Loader::includeModule('catalog'))
	return;

// Обработка параметра "метод трансформации"
if (!empty($arResult) && !empty($arResult['PROPERTIES']['jjj']['VALUE'])) {
	$img = CIBlockElement::GetByID($arResult['PROPERTIES']['jjj']['VALUE'])->Fetch()['PREVIEW_PICTURE'];
	$arResult['PROPERTIES']['jjj']['VALUE'] = CFile::ShowImage($img, 300, 200, '', '', false);
	
}
if (!empty($arResult)) {
	$cpu = explode("/",$arResult["CANONICAL_PAGE_URL"]);
	$arResult['CANONICAL_PAGE_URL'] = "https://".SITE_SERVER_NAME.'/'.$cpu[1]."/".array_pop($cpu);
}
// Добавление вкладки "Варианты обивки"
// Идет привязка по ID для групп для которых эта вкладка видна всегда,
// для других групп выводится в соответствии со значение свойства "visibleinset1"
$catalog_array  = array_merge ($divan_id, array(125, 163, 170, 166, 164,151));

$divan_id = array();
$rsParentSection = CIBlockSection::GetByID(126);
if ($arParentSection = $rsParentSection->GetNext()) {
	$arFilter = array('IBLOCK_ID' => $arParentSection['IBLOCK_ID'],'>LEFT_MARGIN' => $arParentSection['LEFT_MARGIN'],'<RIGHT_MARGIN' => $arParentSection['RIGHT_MARGIN'],'>DEPTH_LEVEL' => $arParentSection['DEPTH_LEVEL']);
	$rsSect = CIBlockSection::GetList(array('left_margin' => 'asc'),$arFilter);
	while($ar_fields = $rsSect->GetNext()) {
		$divan_id[] = $ar_fields['ID'];
	}
}

if (in_array($arResult["IBLOCK_SECTION_ID"], $catalog_array) || $arResult['PROPERTIES']['visibleinset1']['VALUE'] == 'Y') {
	ob_start();
	if (count($arResult['PROPERTIES']['OBIVKA']['VALUE']) > 0 && $arResult['PROPERTIES']['OBIVKA']['VALUE'][0] != '') {
		foreach ($arResult['PROPERTIES']['OBIVKA']['VALUE'] as $val)
		{
			$ids[]=$val;
		}
		$ob_obivka=CIBlockElement::GetList(Array("SORT"=>"ASC"), Array('ID'=>$ids),false,false,Array('IBLOCK_SECTION_ID','NAME','ID','PREVIEW_PICTURE'));
		while($ar_fields =$ob_obivka->GetNext())
		{
			$arOBIVKA[]=$ar_fields;
		} ?>
			<ul class="item_coll obivka">
				<? foreach ($arOBIVKA as $obivka){?>
					<li>
					<?
					$min_img=CFile::ResizeImageGet( $obivka['PREVIEW_PICTURE'], array('width'=>85, 'height'=>55), BX_RESIZE_IMAGE_EXACT);
					?>
						!<a href="<?=CFile::GetPath($obivka['PREVIEW_PICTURE']);?>" data-lightbox="det-img" title="<?=$obivka['NAME']?>" style="background: url(<?=$min_img['src']?>);" alt=""></a>
					</li>
				<? } ?>
			</ul>
	<? }
	elseif(count($arResult['PROPERTIES']['GR_OBIVKA']['VALUE'])>0&&$arResult['PROPERTIES']['GR_OBIVKA']['VALUE'][0]!='')
	{
		$ids=array();
		foreach ($arResult['PROPERTIES']['GR_OBIVKA']['VALUE'] as $val)
		{
			$ids[]=$val;
		}
		$ob_section=CIBlockSection::GetList(Array("SORT"=>"ASC"),Array('ID'=>$ids),false,Array('NAME','ID'),false);
		while($ar_fields =$ob_section->GetNext())
		{
			$ar_section_OBIVKA[$ar_fields['ID']]=$ar_fields['NAME'];
		}
		$ob_obivka=CIBlockElement::GetList(Array("SORT"=>"ASC"),Array('SECTION_ID'=>$ids),false,false,Array('IBLOCK_SECTION_ID','NAME','ID','PREVIEW_PICTURE'));
		while($ar_fields =$ob_obivka->GetNext())
		{
			$arOBIVKA[$ar_fields['IBLOCK_SECTION_ID']][]=$ar_fields;
		}
		foreach ($ar_section_OBIVKA as $key=>$val){?>
			<div class="upholstery-wrap">
				<span class="h3"><?=$val?></span>
				<div class="upholstery-img">
				<? foreach ($arOBIVKA[$key] as $obivka) { ?>
					<? $min_img = CFile::ResizeImageGet( $obivka['PREVIEW_PICTURE'], array('width'=>55, 'height'=>55), BX_RESIZE_IMAGE_EXACT); ?>
					<a href="<?=CFile::GetPath($obivka['PREVIEW_PICTURE']);?>" data-lightbox="det-img" title="<?=$obivka['NAME']?>"><img src="<?=$min_img['src']?>" alt=""></a>
				<?php } ?>
				</div>
			</div>
		<? }
	}
	elseif($arResult['PROPERTIES']['Fabr']['VALUE']!='')
	{ 
	    $arSelect = Array("ID", "PREVIEW_PICTURE");
		$arFilter = Array("IBLOCK_ID"=>"11", "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
		$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
		while($ob = $res->GetNextElement())
		{
		 $arFields = $ob->GetFields();
		}
		$ids=array();
		$ob_obivka=CIBlockElement::GetList(Array("SORT"=>"ASC"),Array("IBLOCK_ID" =>12,'PROPERTY_FABRICA'=>$arResult['PROPERTIES']['Fabr']['VALUE']),false,false,Array('IBLOCK_SECTION_ID','NAME','ID','PREVIEW_PICTURE'));
		while($ar_fields =$ob_obivka->GetNext())
		{$ids[]=$ar_fields['IBLOCK_SECTION_ID'];
			$arOBIVKA[$ar_fields['IBLOCK_SECTION_ID']][]=$ar_fields;
		}
		if($ids){
		$ob_section=CIBlockSection::GetList(Array("SORT"=>"ASC"),Array("IBLOCK_ID" =>12,'ID'=>$ids),false,Array('NAME','ID'),false);
		while($ar_fields =$ob_section->GetNext())
		{
			$ar_section_OBIVKA[$ar_fields['ID']]=$ar_fields['NAME'];
		}
		foreach ($ar_section_OBIVKA as $key=>$val){?>
			<div class="upholstery-wrap">
				<span class="h3"><?=$val?></span>
				<div class="upholstery-img">
				<? foreach ($arOBIVKA[$key] as $obivka) { ?>
					<? $min_img = CFile::ResizeImageGet( $obivka['PREVIEW_PICTURE'], array('width'=>55, 'height'=>55), BX_RESIZE_IMAGE_EXACT); ?>
					<a href="<?=CFile::GetPath($obivka['PREVIEW_PICTURE']);?>" data-lightbox="det-img" title="<?=$obivka['NAME']?>"><img src="<?=$min_img['src']?>" alt=""></a>&nbsp;&nbsp;
				<?php } ?>
				</div>
			</div><br />
		<? }}
	}

	$arResult['PROPERTIES']['OBIVKA_TEXT'] = array(
		'NAME' => 'Варианты обивки',
		'DISPLAY_VALUE' => ob_get_contents(),
	);
	//$arResult['DISPLAY_PROPERTIES']['OBIVKA_TEXT'] = $arResult['PROPERTIES']['OBIVKA_TEXT'];

	$arResult['TABS']['PROPS_TABS'] = $arResult['PROPERTIES']['OBIVKA_TEXT'] != '';
	$arParams['PROPS_TABS'] = array('OBIVKA_TEXT');
	ob_end_clean();
}
// END

// Формирование таймера до окончания акции
$arDiscounts = CCatalogDiscount::GetDiscountByProduct($arResult['ID'],$USER->GetUserGroupArray(),'N', array(), 's1');
if (empty($arDiscounts)) {
	foreach ($arResult['OFFERS'] as $_offer) {
		$arDiscounts = CCatalogDiscount::GetDiscountByProduct($_offer['ID'],$USER->GetUserGroupArray(),'N', array(), 's1');
		if (!empty($arDiscounts)) break;
	}
}

$max='';
$max_discount = false;
$max_discount_id=0;
foreach ($arDiscounts as $one)
{
	$minus=0;
	if($one['VALUE_TYPE'])
	{
		$minus=$arResult['MIN_PRICE']['VALUE']*$one['VALUE']/100;
	}
	else
	{
		$minus=$one['VALUE'];
	}
	if($max==''||$max<$minus)
	{
		$max=$minus;
		$max_discount_id=$one['ID'];
		$max_discount = $one;
	}
}

if(!empty($max_discount['ACTIVE_TO'])) {
	$max_discount['ONE'] = CCatalogDiscount::GetList(array(),array('ID'=>$max_discount['ID']),false,false,array())->Fetch();
	$max_discount['TIMER_DATA'] = date('Y/m/d H:i:s', strtotime($max_discount['ACTIVE_TO']));
} else {
	$max_discount = false;
}

$arResult['TIMER'] = $max_discount;
$arResult['SALE_PERCENT'] = round($arDiscounts[0]["VALUE"]);
// END

// Получение коллекции
$arResult['NABOR'] = array();
$arNaborAll = $arResult['PROPERTIES']['TOVARS_IN_NABOR_REKOMEND']['VALUE'];
if (count($arNaborAll) > 0 && $arNaborAll[0] > 0) {
	$price = 0;
	$discount_price = 0;
	$discount_diff = 0;

	
	$arParams['USE_PRODUCT_QUANTITY'] = false;
	$arNaborStart = $arResult['PROPERTIES']['TOVARS_IN_NABOR']['VALUE'];
	$arNaborStartCount = $arResult['PROPERTIES']['KOL_TOVARS_IN_NABOR']['VALUE'];
	
	$arSelect = Array('ID', 'IBLOCK_ID', 'NAME', 'DETAIL_PAGE_URL');
	$arFilter = Array('ID' => $arNaborAll, 'ACTIVE_DATE' => 'Y', 'ACTIVE' => 'Y');
	$res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
	while ($row = $res->GetNext()) {
		$url = explode('/', $row['DETAIL_PAGE_URL']);
		$element = array_pop($url);
		$section = $url[1];
		$row['DETAIL_PAGE_URL'] = '/' . $section . '/' . $element;
		$row['ID_MAIN'] = $row['ID'];
		
		if ($row['PRICE'] = CCatalogProduct::GetOptimalPrice($row['ID'])) {
			$row['PRICE'] = $row['PRICE']['RESULT_PRICE'];
		} else {
			$off_price = array();
			$ob_off = CIBlockElement::GetList(Array("SORT"=>"ASC"),Array('ACTIVE'=>'Y','CATALOG_AVAILABLE'=>'Y','PROPERTY_CML2_LINK.ID'=>$row['ID']),false,false,Array('ID'));
			while ($ar_fields = $ob_off->GetNext()) {
				$off_price[$ar_fields['ID']]=CCatalogProduct::GetOptimalPrice($ar_fields['ID'])['RESULT_PRICE'];
			}
			uasort($off_price, function ($a, $b) {
				if ($a['DISCOUNT_PRICE'] == $b['DISCOUNT_PRICE']) {
					return 0;
				}
				return ($a['DISCOUNT_PRICE'] < $b['DISCOUNT_PRICE']) ? -1 : 1;
			});
			$row['ID'] = key($off_price);
			$off_price = array_shift($off_price);
			$row['PRICE'] = $off_price;
		}

		$row['QUANTITY'] = 0;
		if (false !== ($find = array_search($row['ID_MAIN'], $arNaborStart))) {
			$row['QUANTITY'] = $arNaborStartCount[$find];
		}

		$price          += $row['PRICE']['BASE_PRICE'] * $row['QUANTITY'];
		$discount_price += $row['PRICE']['DISCOUNT_PRICE'] * $row['QUANTITY'];

		$arResult['NABOR'][] = $row;
	}

	$discount_diff = $price - $discount_price;

	foreach ($arResult["PRICES"] as $code=>$arPrice) {
    	$arResult["PRICES"][$code]['PRINT_DISCOUNT_VALUE'] = number_format($discount_price, 0, ',', ' ') . ' руб.';
    	$arResult["PRICES"][$code]['DISCOUNT_DIFF'] = number_format($discount_diff, 0, ',', ' ') . ' руб.';
    	$arResult["PRICES"][$code]['PRINT_VALUE'] = number_format($price, 0, ',', ' ') . ' руб.';
    	$arResult["PRICES"][$code]['PRINT_DISCOUNT_DIFF'] = number_format($discount_diff, 0, ',', ' ') . ' руб.';
	}

	foreach ($arResult['PRICE_MATRIX']['COLS'] as $typeID => $arType) {
		$arResult['PRICE_MATRIX']['COLS'][$typeID]['PRINT_DISCOUNT_VALUE'] = number_format($discount_price, 0, ' ', ',');
		$arResult['PRICE_MATRIX']['COLS'][$typeID]['DISCOUNT_DIFF'] = $discount_diff;
		$arResult['PRICE_MATRIX']['COLS'][$typeID]['PRINT_VALUE'] = number_format($price, 0, ' ', ',');
		$arResult['PRICE_MATRIX']['COLS'][$typeID]['PRINT_DISCOUNT_DIFF'] = number_format($discount_diff, 0, ' ', ',');
	}
}

$shareIcons = "";
foreach ($arParams["SOC_SHARE_ICON"] as $arShare) {
	$shareIcons .= $arShare.",";
}
$arResult["SHARE_SOC"] = $shareIcons;
if($arResult['PROPERTIES']['Fabr']['VALUE']!='')
{ 
	$arSelect = Array("ID", "PREVIEW_PICTURE");
	$arFilter = Array("IBLOCK_ID"=>"11", "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y","ID" => $arResult['PROPERTIES']['Fabr']['VALUE']);
	$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
	while($ob = $res->GetNextElement())
	{
	 $arFields = $ob->GetFields();
	 $arResult["FABR_IMG"] = CFile::GetPath($arFields["PREVIEW_PICTURE"]);
	}
}

if($arResult["PROPERTIES"]["ACTION"]["VALUE"]) { $arResult['STICKERS']["action"] = "Акция"; }
if($arResult["PROPERTIES"]["NEWPRODUCT"]["VALUE"]) { $arResult['STICKERS']["new"] = "Новинка"; }
if($arResult["PROPERTIES"]["SALE"]["VALUE"]) { $arResult['STICKERS']["sale"] = "Распродажа"; }
if($arResult["PROPERTIES"]["hitsales"]["VALUE"]) { $arResult['STICKERS']["hit"] = "Хит"; }

if($arResult["DETAIL_PICTURE"]) {
    $APPLICATION->SetPageProperty('og:image',$arResult["DETAIL_PICTURE"]["SRC"]);
}
$arF = array("NAME","SECTION_PAGE_URL","ACTIVE");
$db_old_groups = CIBlockElement::GetElementGroups($arResult['ID'], true, $arF);
  while($ar_group = $db_old_groups->Fetch()) {

      $res = CIBlockSection::GetByID($ar_group["ID"]); 
	  if($ar_res = $res->GetNext())
	   if($ar_res["ACTIVE"] == 'Y') { 
	   $arResult["ALL_SECTIONS"][$ar_group["ID"]]["NAME"] = $ar_group["NAME"];
	   $arResult["ALL_SECTIONS"][$ar_group["ID"]]["URL"] = $ar_res["SECTION_PAGE_URL"];
	   }

  }
// из-за этой строки крошилась вся детальная страница
// Получить список всех SEO - ссылок
//$arResult['SEO_URLS'] = CMyClass::getProductURLs($arResult['ID']);
