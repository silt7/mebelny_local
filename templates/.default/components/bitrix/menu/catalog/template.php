<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<? if (!empty($arResult)):?>
<ul class="type-product">
<?
$index = -1;
foreach($arResult as $arItem):
	if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) 
		continue;
?>
    <? $index += 1; if ($index != 0 && $index % 7 == 0) { echo "</ul><ul class='type-product'>"; } ?>
	<? if($arItem["SELECTED"]):?>
		<li><a href="<?=$arItem["LINK"]?>" class="active"><?=$arItem["TEXT"]?></a></li>
	<? else:?>
		<li><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
	<? endif?>
	
<? endforeach?>

</ul>
<? endif?>

<? // echo "<pre>"; print_r($arResult); echo "</pre>"; ?>