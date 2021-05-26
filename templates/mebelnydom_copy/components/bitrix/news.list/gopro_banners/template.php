<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Localization\Loc;

$this->setFrameMode(true);
?>
<div class="banner-slider">
  <?php foreach ($arResult["ITEMS"] as $key => $arItem): ?>
          <? $file_wm = CFile::ResizeImageGet( 
			 $arItem["DETAIL_PICTURE"],  
			 array("width" => "754", "height" => "360"),  
			 BX_RESIZE_IMAGE_EXACT, 
			  false,  false) 
          ?> 

          <div class="banner-slider__item" style="background-image:url(/local/templates/mebelnydom/static/img/gradient3.png),url(<?=$file_wm["src"]?>);">
                 <? if(!empty($arItem['PROPERTIES']["BREND"]["VALUE"])) {
                  $arSelect = Array("ID", "NAME", "PREVIEW_PICTURE");
                  $arFilter = Array("IBLOCK_ID"=>"11", "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y","ID" => $arItem['PROPERTIES']["BREND"]["VALUE"]);
                  $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
                  while($ob = $res->GetNextElement())
                  {
                   $arFields = $ob->GetFields();
                   } ?>
                  <img src="<?=CFile::GetPath($arFields["PREVIEW_PICTURE"])?>" alt="<?=$arFields["NAME"]?>">
                 <? } else { ?>
                  <img src="<?=SITE_TEMPLATE_PATH?>/src/img/nobrend.png" alt="<?=$arFields["NAME"]?>"> 
                 <? } ?>

                 <div class="h1"><?=$arItem['PROPERTIES']["TITLE1"]["VALUE"]?></div>
                 <p><?=$arItem['PROPERTIES']["TITLE2"]["VALUE"]?></p>
                 <button onclick="return location.href = '<?=$arItem['PROPERTIES']["LINK"]["VALUE"]?>'">Подробнее</button>
           </div> 
  <? endforeach;?>  
</div>