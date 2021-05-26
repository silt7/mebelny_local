<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

/**
 * Bitrix vars
 *
 * @var CBitrixComponent         $component
 * @var CBitrixComponentTemplate $this
 * @var array                    $arParams
 * @var array                    $arResult
 * @var array                    $arLangMessages
 * @var array                    $templateData
 *
 * @var string                   $templateFile
 * @var string                   $templateFolder
 * @var string                   $parentTemplateFolder
 * @var string                   $templateName
 * @var string                   $componentPath
 *
 * @var CDatabase                $DB
 * @var CUser                    $USER
 * @var CMain                    $APPLICATION
 */
if(method_exists($this, 'setFrameMode'))
	$this->setFrameMode(true);

if($arParams['INCLUDE_CSS'] == 'Y')
?>
<div class="api-search-catalog tpl-default" id="<?=$arResult['COMPONENT_ID']?>">
	<?
	if($arParams['IBLOCK_ID'])
	{
		if(strlen($arResult['q']) >= API_SEARCH_CHAR_LENGTH)
		{
			$APPLICATION->IncludeComponent(
				"bitrix:catalog.section",
				"visual",
				$arParams,
				$arResult['THEME_COMPONENT'],
				array('HIDE_ICONS' => 'Y')
			);
		}
	}
	?>
</div>