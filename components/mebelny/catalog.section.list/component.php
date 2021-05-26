<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$urls = explode("/",$_SERVER["REQUEST_URI"]);

// echo"<PRE>"; print_r($ex[1]); echo"</PRE>";
$arResult['SECTIONS'] = $GLOBALS["ALL_SECTIONS_BY_CODE"][$urls[1]]["DEPTH_LEVEL2"];
$this->includeComponentTemplate();