<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();








$rsResult2 = CIBlockSection::GetList(array("SORT" => "ASC"), array("IBLOCK_ID" => "2"), true);

	while($arResult2 = $rsResult2->GetNext()) {

		$arResult['RESULT2'] = array($arResult2);
	}

	

?>