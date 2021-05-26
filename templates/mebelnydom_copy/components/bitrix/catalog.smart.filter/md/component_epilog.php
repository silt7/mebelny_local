<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $templateData */
/** @var @global CMain $APPLICATION */

CJSCore::Init(array('fx', 'popup'));

global $APPLICATION;
$APPLICATION->SetAdditionalCss("/bitrix/js/main/core/css/core_popup.min.css");

?>