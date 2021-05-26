<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>

  <? if($arResult["DETAIL_PICTURE"]["SRC"]) { ?>
   <div class="article__floatet-wrap">
      <div class="article__img-container">
        <img src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" alt="<?=$arResult["DETAIL_PICTURE"]["ALT"]?>">
      </div>
  <? } else { ?>
  <div>      
  <? } ?>
  <? if($arParams["DISPLAY_DATE"]!="N" && $arResult["DISPLAY_ACTIVE_FROM"]):?>
        <div class="news__item-desc">Опубликовано <?=$arResult["DISPLAY_ACTIVE_FROM"]?> г.</div>
  <? endif;?>
  <?=$arResult["DETAIL_TEXT"]?>
 </div> 