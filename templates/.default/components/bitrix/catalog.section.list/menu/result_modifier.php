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
}


foreach($arResult['SECTIONS'] as $key=>$arSectionItem)
{
	$rsSect=CIBlockSection::GetList(array('name'=>'asc'), array('IBLOCK_ID'=>2, 'ID'=>$arSectionItem['ID'], "DEPTH_LEVEL"=>1), false, Array('UF_MENU_ICON', 'UF_MENU_ICON_HOVER'));
	while($arSect = $rsSect->Fetch())
	{
		$arResult['SECTIONS'][$key]['UF_MENU_ICON'] = CFile::GetPath($arSect[UF_MENU_ICON]);
		$arResult['SECTIONS'][$key]['UF_MENU_ICON_HOVER'] = CFile::GetPath($arSect[UF_MENU_ICON_HOVER]);
	}

}

