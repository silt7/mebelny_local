<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

$arFilter = [
		'IBLOCK_ID' => 2,
		'UF_SHOW' => 1
	];
$arSelect = [
		'UF_SHOW',
		'UF_LINK_MAIN',
		'UF_IMG_MAIN',
		'CODE',
		'NAME'
	];
$sections = CIBlockSection::getList(['SORT' => 'ASC'], $arFilter, false, $arSelect);

$arParams['SECTIONS'] = $sections;
