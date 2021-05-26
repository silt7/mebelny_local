<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Localization\Loc;

$this->setFrameMode(true);
?>

        <div class="delivery block-none">
            <div class="h2">Доставка по всей<br><span>России</span></div>
        </div>
 <? if(count($arResult["ITEMS"]) > 0) { ?>    
	<?php foreach ($arResult["ITEMS"] as $arItem): ?>
        <div class="delivery block-none">
            <div class="h2">Доставка по всей<br><span>России</span></div>
        </div>
    <? endforeach;?>
  <? } else { ?>
        <div class="delivery block-none">
            <div class="h2">Доставка по всей<br><span>России</span></div>
        </div>
 <? } ?>       
	