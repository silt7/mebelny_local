<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

if (!CModule::IncludeModule('redsign.devfunc'))
	return;

$maxSizeWidth = 227;
$maxSizeHeight = 171;

foreach ($arResult['SECTIONS'] as $key1 => $arSection) {

	if (!empty($arSection['PICTURE']['SRC'])) {

		$arFileTmp = CFile::ResizeImageGet(
			$arSection['PICTURE']['ID'],
			array('width' => $maxSizeWidth, 'height' => $maxSizeHeight),
			BX_RESIZE_IMAGE_PROPORTIONAL,
			true,
			array()
		);

		$arResult['SECTIONS'][$key1]['PICTURE']['SRC'] = $arFileTmp['src'];
	} else {
    	$arResult['SECTIONS'][$key1]['PICTURE']['SRC'] = '/no_photo.png';
	}
}
