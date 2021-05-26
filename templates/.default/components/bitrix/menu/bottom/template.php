<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);

if(!empty($arResult))
{
	?><ul class="main-menu__list"><?
		$index = 0;
		foreach($arResult as $arItem)
		{
			if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) 
				continue;

			$clss = ($index > 4) ? 'nav-list__item block-none' : 'nav-list__item';
			if($arItem["SELECTED"])
			{
				?><li class="<?=$clss?>"><a href="<?=$arItem["LINK"]?>" class="selected"><?=$arItem["TEXT"]?></a></li><?
			} else {
				?><li class="<?=$clss?>"><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li><?
			}
			$index += 1;
		}
	?></ul><?
}