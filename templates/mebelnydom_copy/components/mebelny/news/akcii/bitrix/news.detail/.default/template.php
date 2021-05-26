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
<div class="article">
 <div class="article__floatet-wrap">
  <div class="article__img-container">
    <img src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" alt="<?=$arResult["DETAIL_PICTURE"]["ALT"]?>">
  </div>
    <div class="news__item-desc-wrap">
        <? $end = FormatDate("Q", MakeTimeStamp($arResult["PROPERTIES"]["END"]["VALUE"]));?>
        <? if($end < 0) { ?>
            <div class="news__item-rest">Осталось <? echo str_replace ('-','', $end);?></div>
            <div class="news__item-desc news__item-desc_inline">с <?=FormatDate("d M Y", MakeTimeStamp($arResult["PROPERTIES"]["BEGIN"]["VALUE"]));?> по <?=FormatDate("d M Y", MakeTimeStamp($arResult["PROPERTIES"]["END"]["VALUE"]));?></div>
        <? } else { ?>
        <div class="news__item-rest news__item-ended"><? echo "Завершена ", $end," назад"; ?></div>
        <? } ?>
    </div>
  <?=$arResult["DETAIL_TEXT"]?>
 </div> 
</div>