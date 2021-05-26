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

if($arResult["PICTURE"]["SRC"]) {
    $APPLICATION->SetPageProperty('og:image',$arResult["PICTURE"]["SRC"]);
}

$arResult['BLOGS'] = [];
$arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM","CODE", "PREVIEW_PICTURE", "PROPERTY_TO_CATALOG");
$arFilter = Array("IBLOCK_ID"=>1, "ACTIVE"=>"Y", "=PROPERTY_TO_CATALOG" => $arResult['ID']);
$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
while($ob = $res->GetNextElement())
{
    $arFields = $ob->GetFields();
    $arFields['PREVIEW_PICTURE'] = CFile::ResizeImageGet($arFields["PREVIEW_PICTURE"], array( "width" => 300, "height" => 220 ), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, false, false);
    array_push($arResult['BLOGS'], $arFields);
}

$this->__component->arResult["COUNT"] = count($arResult['ITEMS']);
$this->__component->SetResultCacheKeys(array("IDS", "COUNT"));