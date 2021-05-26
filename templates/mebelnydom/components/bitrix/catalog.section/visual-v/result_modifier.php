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
	
}

$this->__component->SetResultCacheKeys(array("IDS"));


?>