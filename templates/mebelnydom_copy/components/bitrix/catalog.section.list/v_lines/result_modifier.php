<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

if (isset($arResult['SECTION']) && $arResult['SECTION']['DESCRIPTION'] != '') {
	$arSection = $arResult['SECTION'];
	$mxPicture = false;
	$arSection['PICTURE'] = intval($arSection['PICTURE']);
	if (0 < $arSection['PICTURE'])
		$mxPicture = CFile::GetFileArray($arSection['PICTURE']);
	$arSection['PICTURE'] = $mxPicture;
	if ($arSection['PICTURE'])
	{
		$arSection['PICTURE']['ALT'] = $arSection['IPROPERTY_VALUES']['SECTION_PICTURE_FILE_ALT'];
		if ($arSection['PICTURE']['ALT'] == '')
			$arSection['PICTURE']['ALT'] = $arSection['NAME'];
		$arSection['PICTURE']['TITLE'] = $arSection['IPROPERTY_VALUES']['SECTION_PICTURE_FILE_TITLE'];
		if ($arSection['PICTURE']['TITLE'] == '')
			$arSection['PICTURE']['TITLE'] = $arSection['NAME'];
	}
	$arResult['SECTION'] = $arSection;
	$arResult['LEFT_NAV'] = ''; 
}

/* $rsResult1 = CIBlockSection::GetList(array("SORT" => "ASC"), array("IBLOCK_ID" => "2", "ID" => $arSection['ID']), true, array("UF_SECT_TYPES"));
	

	$userFields = CUserFieldEnum::GetList(array(), array());
	$arSection2 = array();
	foreach($userFields->arResult as $userField) {
		
		
		$arResult['SECTION2']['SECTION_TITLE'][] = $userField['VALUE'];
		foreach($arResult['SECTIONS'] as $arSect) {
			if($arSect['UF_SECT_TYPES'] == $userField['ID']) {
				
				$arResult['SECTION2'][] = $arSect;
			}
		}
	} */
?>