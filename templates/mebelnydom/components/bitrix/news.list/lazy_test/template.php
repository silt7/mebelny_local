<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
/*** NEWS_LIST ***/
?>


<div class="load_more_wrap">
	<?foreach($arResult["ITEMS"] as $arItem):?>
		<div class="load_more_item"><?=$arItem['NAME']?></div>
	<?endforeach;?>
</div>

<?=$arResult["NAV_STRING"]?>
