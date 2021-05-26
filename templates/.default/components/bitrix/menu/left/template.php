<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);

if(!empty($arResult))
{
	?><ul class="contside__list"><?
		$index = 0;
		foreach($arResult as $arItem)
		{
			if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) 
				continue;

			$clss = ($index > 4) ? 'nav-list__item block-none' : 'nav-list__item';
			if($arItem["SELECTED"])
			{
				?><li class="contside__item active"><a href="<?=$arItem["LINK"]?>" class="contside__link"><?=$arItem["TEXT"]?></a></li><?
			} else {
				?><li class="contside__item"><a href="<?=$arItem["LINK"]?>" class="contside__link"><?=$arItem["TEXT"]?></a></li><?
			}
			$index += 1;
		}
	?></ul><?
}
