<?php
if (!defined('B_PROLOG_INCLUDED')||B_PROLOG_INCLUDED !== true)
    die();
$this->setFrameMode(true);
?>

<?pr($arParams['SECTIONS_TIED'], false, false);?>

<?foreach($arResult['SECTIONS'] as $arSection):?>
	<?if(in_array($arSection['ID'], $arParams['SECTIONS_TIED'])):?>
		<div><?=$arSection['NAME']?></div>
	<?endif?>
<?endforeach?>
