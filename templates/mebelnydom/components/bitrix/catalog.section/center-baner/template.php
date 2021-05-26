<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
$this->setFrameMode(true);
?>

  <div class="banner-wrap banner-wrap_<?=$arResult['ITEMS'][0]["ID"]?> block-none" style="background-image:url(<?=CFile::GetPath($arResult['ITEMS'][0]['PROPERTIES']['FORHOME']['VALUE'])?>);" onClick="return location.href = '<?=$arResult['ITEMS'][0]['DETAIL_PAGE_URL']?>'">
      <div class="text-wrap">
        <? if(count($arResult['ITEMS'][0]["OFFERS"]) > 0) { ?>
          <?php if ($arResult['ITEMS'][0]["OFFERS"][0]['MIN_PRICE']['DISCOUNT_DIFF'] > 0) { ?>
          <p class="no-price"><?=$arResult['ITEMS'][0]["OFFERS"][0]['MIN_PRICE']['PRINT_VALUE']?></p>
          <?php } ?>
          <p class="price"><?=$arResult['ITEMS'][0]["OFFERS"][0]['MIN_PRICE']['PRINT_DISCOUNT_VALUE']?></p>
        <? } else { ?>
          <?php if ($arResult['ITEMS'][0]['MIN_PRICE']['DISCOUNT_DIFF'] > 0) { ?>
          <p class="no-price"><?=$arResult['ITEMS'][0]['MIN_PRICE']['PRINT_VALUE']?></p>
          <?php } ?>
          <p class="price"><?=$arResult['ITEMS'][0]['MIN_PRICE']['PRINT_DISCOUNT_VALUE']?></p>
        <? } ?>         
          <p class="desc"><?=$arResult['ITEMS'][0]['NAME']?></p>
      </div>
      <div class="bg-price"></div>
  </div>