<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)

    die();



use \Bitrix\Main\Localization\Loc;



$this->setFrameMode(true);



if (empty($arParams['RSGOPRO_PROP_TYPES']) || empty($arParams['RSGOPRO_PROP_COORD']))

    return;

?>



                <div class="contact-detail">

                <div class="col col-md-9 js-shops">

                  <? /*?>

                    <div class="shops2-panel__filters js-filter">

                        <?php foreach ($arResult['FILTER_TYPES'] as $arFilterType): ?>

                            <div class="btn btn1 js-btn" data-filter="<?=htmlspecialcharsbx($arFilterType['XML_ID'])?>"><?=$arFilterType['VALUE']?></div>

                        <?php endforeach; ?>

                        <div class="btn btn1 active js-btn"  data-filter=""><?=Loc::getMessage('SHOP_FILTER_ALL');?></div>

                    </div>

				  <? */?>	

                </div>

                <?php if (is_array($arResult["ITEMS"]) && count($arResult["ITEMS"]) > 0): ?>

                 <div class="shops2__list js-shops_list">

                  <?php foreach ($arResult["ITEMS"] as $arItem): ?>

                    <div class="contact-detail__block shares-article">

                        <div class="title"><?=$arItem['NAME']?></div>

                        <p><?=$arItem['PREVIEW_TEXT']?></p>

                        <p><a href="#" class="more onmap" map-action="map.setOffice" data-id="<?=$arItem["ID"]?>">показать на карте</a>

                    </div>                        

                  <?php endforeach; ?> 

                 </div>  

                <?php endif; ?>





