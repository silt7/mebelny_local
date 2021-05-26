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


$section = array();
$rs_sections = CIBlockSection::GetList(
    array(),
    array(
        "IBLOCK_ID" => 2,
        "ID" => $arResult["ID"]
    ),
    false,
    array("ID", "UF_PREFIX_NAME", "UF_COUNT_PREFIX")
);
while($section = $rs_sections->Fetch()){
    $prefix_name = $section["UF_PREFIX_NAME"];
    $prefix_count = $section["UF_COUNT_PREFIX"];
}

foreach ($arResult["ITEMS"] as $key => $arElement) 
{
    if($prefix_name && $prefix_count) {
        if ($key + 1 <= $prefix_count) {
            $arResult["ITEMS"][$key]["PREFIX"] = $prefix_name;
            $name = $arResult["ITEMS"][$key]["NAME"];
            $char = mb_strtolower(substr($name,0,2), "utf-8");
            $name[0] = $char[0];
            $name[1] = $char[1];
            $arResult["ITEMS"][$key]["NAME"] = $name;
        }
    }
	$this->__component->arResult["IDS"][] = $arElement["ID"];
		
	$section_id = $arElement["~IBLOCK_SECTION_ID"];

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
	
	// Дисконт закомментил пока что
	//$arDiscounts = CCatalogDiscount::GetDiscountByProduct($arElement['ID'],$USER->GetUserGroupArray(),'N', array(), 's1');
	//if (empty($arDiscounts)) {
	//foreach ($arElement['OFFERS'] as $_offer) {
	//$arDiscounts = CCatalogDiscount::GetDiscountByProduct($_offer['ID'],$USER->GetUserGroupArray(),'N', array(), 's1');
	//if (!empty($arDiscounts)) break;
	//}
	//}
	
	//$arResult['ITEMS'][$key]['SALE_PERCENT'] = ($GLOBALS["ALL_PRICES"][$arElement['ID']]["PRICE"]["PERCENT"])?$GLOBALS["ALL_PRICES"][$arElement['ID']]["PRICE"]["PERCENT"]:round($arDiscounts[0]["VALUE"]);

	// Формирование таймера до окончания акции
	$arDiscounts = CCatalogDiscount::GetDiscountByProduct($arElement['ID'],$USER->GetUserGroupArray(),'N', array(), 's1');
	if (empty($arDiscounts)) {
		foreach ($arElement['OFFERS'] as $_offer) {
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
			$minus=$arElement['MIN_PRICE']['VALUE']*$one['VALUE']/100;
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
	
	$arResult['ITEMS'][$key]['TIMER'] = $max_discount;
	$arResult['ITEMS'][$key]['SALE_PERCENT'] = round($arDiscounts[0]["VALUE"]);
	// END

	if($arElement["PROPERTIES"]["ACTION"]["VALUE"]) { $arResult['ITEMS'][$key]['STICKERS']["action"] = "Акция"; }
	if($arElement["PROPERTIES"]["NEWPRODUCT"]["VALUE"]) { $arResult['ITEMS'][$key]['STICKERS']["new"] = "Новинка"; }
	if($arElement["PROPERTIES"]["SALE"]["VALUE"]) { $arResult['ITEMS'][$key]['STICKERS']["sale"] = "Распродажа"; }
	if($arElement["PROPERTIES"]["hitsales"]["VALUE"]) { $arResult['ITEMS'][$key]['STICKERS']["hit"] = "Хит"; }
	
}

$this->__component->SetResultCacheKeys(array("IDS"));

if($arResult["PICTURE"]["SRC"]) {
    $APPLICATION->SetPageProperty('og:image',$arResult["PICTURE"]["SRC"]);
}