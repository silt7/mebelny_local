<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();




/* 
function dump($var = null)
    {
        if($_GET['dump'] == 'off'){
            $_SESSION['DUMP'] = 'N';
        }
        elseif($_GET['dump'] == 'on' || $_SESSION['DUMP'] == 'Y'){
            $_SESSION['DUMP'] = 'Y';
            if ($var == null) $var = 'Show test message';
            echo '<pre style="position: relative;z-index: 100;background: #ccc;clear: both; text-align: left; font: 12px Courier New, monospace; color: green;">';
            print_r($var);
            echo '</pre>';
        }
    } */

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
/*

$rsResult2 = CIBlockSection::GetList(array("SORT" => "ASC"), array("IBLOCK_ID" => "2"), true);

	while($arResult2 = $rsResult2->GetNext()) {

		$arResult['RESULT2'] = array($arResult2);
	}
*/


?>