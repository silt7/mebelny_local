<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Localization\Loc;

$this->setFrameMode(false);
?>

<div class="advertising">
   <? if(count($arResult["ITEMS"]) > 0) { ?>      
     <?php foreach ($arResult["ITEMS"] as $arItem): ?>                   
            <div class="advertising-block advertising-block_1">
                <p>Оплата картами и наличными</p>
                <a href="/oplata/"></a>
            </div>
     <? endforeach;?>
   <? } else { ?>  
           <div class="advertising-block advertising-block_1">
                <p>Оплата картами и наличными</p>
                <a href="/oplata/"></a>
            </div>
            <div class="advertising-block advertising-block_2">
                <p>Гарантия на товары до 36 месяцев</p>
                <a href="/garantii/"></a>
            </div>
            <div class="advertising-block advertising-block_3">
                <p>Быстрое оформление заказа и отгрузка</p>
                <a href="/dostavka/"></a>
            </div>
            
   <? } ?>  
</div>