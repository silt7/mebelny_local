<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

// cache hack to use items list in component_epilog.php
$this->__component->arResult["IDS"] = array();

if(isset($arParams["DETAIL_URL"]) && strlen($arParams["DETAIL_URL"]) > 0)
	$urlTemplate = $arParams["DETAIL_URL"];
else
	$urlTemplate = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "DETAIL_PAGE_URL");

//2 Sections subtree
$arSections = array();
$rsSections = CIBlockSection::GetList(
	array(), 
	array(
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"LEFT_MARGIN" => $arResult["LEFT_MARGIN"],
		"RIGHT_MARGIN" => $arResult["RIGHT_MARGIN"],
	), 
	false, 
	array("ID", "DEPTH_LEVEL", "SECTION_PAGE_URL")
);

while($arSection = $rsSections->Fetch())
	$arSections[$arSection["ID"]] = $arSection;

foreach ($arResult["ITEMS"] as $key => $arElement) 
{
	$this->__component->arResult["IDS"][] = $arElement["ID"];
		
	$section_id = $arElement["~IBLOCK_SECTION_ID"];

	/*
	$section_id = false;
	$rsSections = CIBlockElement::GetElementGroups($arElement["ID"]);
	while($arSection = $rsSections->Fetch())
	{
		if(array_key_exists($arSection["ID"], $arSections))
		{
			if(
				$section_id === false
				|| $arSections[$arSection["ID"]]["DEPTH_LEVEL"] > $arSections[$section_id]["DEPTH_LEVEL"]
			)
			{
				$section_id = $arSection["ID"];
			}
		}
	}*/
	
	if(array_key_exists($section_id, $arSections))
	{
		$urlSection = str_replace(
			array("#SECTION_ID#", "#SECTION_CODE#"),
			array($arSections[$section_id]["ID"], $arSections[$section_id]["CODE"]),
			$urlTemplate
		);

		$arResult["ITEMS"][$key]["DETAIL_PAGE_URL"] = CIBlock::ReplaceDetailUrl(
			$urlSection,
			$arElement,
			true,
			"E"
		);
	}	
	
	$dpu = explode("/",$arElement["DETAIL_PAGE_URL"]);
	$arResult['ITEMS'][$key]['DETAIL_PAGE_URL'] = "/".$dpu[1]."/".array_pop($dpu);
	
	$arDiscounts = CCatalogDiscount::GetDiscountByProduct($arElement['ID'],$USER->GetUserGroupArray(),'N', array(), 's1');
	if (empty($arDiscounts)) {
		foreach ($arElement['OFFERS'] as $_offer) {
			$arDiscounts = CCatalogDiscount::GetDiscountByProduct($_offer['ID'],$USER->GetUserGroupArray(),'N', array(), 's1');
			if (!empty($arDiscounts)) break;
		}
	}
	$arResult['ITEMS'][$key]['SALE_PERCENT'] = round($arDiscounts[0]["VALUE"]);
	if($arElement["PROPERTIES"]["ACTION"]["VALUE"]) { $arResult['ITEMS'][$key]['STICKERS']["action"] = "Акция"; }
	if($arElement["PROPERTIES"]["NEWPRODUCT"]["VALUE"]) { $arResult['ITEMS'][$key]['STICKERS']["new"] = "Новинка"; }
	if($arElement["PROPERTIES"]["SALE"]["VALUE"]) { $arResult['ITEMS'][$key]['STICKERS']["sale"] = "Распродажа"; }
	if($arElement["PROPERTIES"]["hitsales"]["VALUE"]) { $arResult['ITEMS'][$key]['STICKERS']["hit"] = "Хит"; }

	$arResult['ITEMS'][$key]['PRICE'] = [];
	$arResult['ITEMS'][$key]['PRICE_DISCOUNT'] = 0;
	$price = 0;
	$discount_price = 0;
	$discount_diff = 0;

	$arNaborAll = $arElement['PROPERTIES']['TOVARS_IN_NABOR_REKOMEND']['VALUE'];
	if (count($arNaborAll) > 0 && $arNaborAll[0] > 0) {
		$arElement['USE_PRODUCT_QUANTITY'] = false;
		$arNaborStart = $arElement['PROPERTIES']['TOVARS_IN_NABOR']['VALUE'];
		$arNaborStartCount = $arElement['PROPERTIES']['KOL_TOVARS_IN_NABOR']['VALUE'];
		
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
	
			$arElement['NABOR'][] = $row;
		}
	
		$discount_diff = $price - $discount_price;
		/*
		foreach ($arElement["PRICES"] as $code=>$arPrice) {
			$arElement["PRICES"][$code]['PRINT_DISCOUNT_VALUE'] = number_format($discount_price, 0, ',', ' ') . ' руб.';
			$arElement["PRICES"][$code]['DISCOUNT_DIFF'] = number_format($discount_diff, 0, ',', ' ') . ' руб.';
			$arElement["PRICES"][$code]['PRINT_VALUE'] = number_format($price, 0, ',', ' ') . ' руб.';
			$arElement["PRICES"][$code]['PRINT_DISCOUNT_DIFF'] = number_format($discount_diff, 0, ',', ' ') . ' руб.';
		}
	
		foreach ($arElement['PRICE_MATRIX']['COLS'] as $typeID => $arType) {
			$arElement['PRICE_MATRIX']['COLS'][$typeID]['PRINT_DISCOUNT_VALUE'] = number_format($discount_price, 0, ' ', ',');
			$arElement['PRICE_MATRIX']['COLS'][$typeID]['DISCOUNT_DIFF'] = $discount_diff;
			$arElement['PRICE_MATRIX']['COLS'][$typeID]['PRINT_VALUE'] = number_format($price, 0, ' ', ',');
			$arElement['PRICE_MATRIX']['COLS'][$typeID]['PRINT_DISCOUNT_DIFF'] = number_format($discount_diff, 0, ' ', ',');
		}*/
	} else {
		$price = CCatalogProduct::GetOptimalPrice($arElement["ID"])['PRICE'];
		if(empty($price)){
			foreach($arElement['OFFERS'] as $item){
			   $price = $item['MIN_PRICE']['DISCOUNT_VALUE'];
				break;  
			}
		} else {
			$price = $price['PRICE'];
			if(!empty($arElement['PRICES']['BASE']['DISCOUNT_DIFF'])){
				$discount_price = $price - $arElement['PRICES']['BASE']['DISCOUNT_DIFF'];
			}
		}
	}

	$arResult['ITEMS'][$key]['PRICE'] = $price;
	$arResult['ITEMS'][$key]['PRICE_DISCOUNT'] = $discount_price;
}

$this->__component->SetResultCacheKeys(array("IDS"));


?>