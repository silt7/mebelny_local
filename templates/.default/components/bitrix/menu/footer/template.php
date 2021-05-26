<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
<ul class="footer-list">

<?
foreach($arResult as $arItem):
	if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) 
		continue;
?>
	<?if($arItem["TEXT"]=="Оплата" || $arItem["TEXT"]=="Гарантия и возврат" || $arItem["TEXT"]=="Мебель в рассрочку" || $arItem["TEXT"]=="Доставка" || $arItem["TEXT"]=="Подъём" || $arItem["TEXT"]=="Сборка" || $arItem["TEXT"]=="Другие услуги" || $arItem["TEXT"]=="Акционные товары" || $arItem["TEXT"]=="Распродажи" || $arItem["TEXT"]=="Популярное" || $arItem["TEXT"]=="Новинки"):?>
		<?if($arItem["SELECTED"]):?>
			<!--<li><span data-location="<?=$arItem["LINK"]?>" class="js_span_location selected"><?=$arItem["TEXT"]?></span></li>-->
		<?else:?>
			<!--<li><span data-location="<?=$arItem["LINK"]?>" class="js_span_location"><?=$arItem["TEXT"]?></span></li>-->
		<?endif?>
		<li><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
	<?else:?>
		<?if($arItem["SELECTED"]):?>
			<li><a href="<?=$arItem["LINK"]?>" class="selected"><?=$arItem["TEXT"]?></a></li>
		<?else:?>
			<li><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
		<?endif?>
	<?endif?>
<?endforeach?>

</ul>
<?endif?>