<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);

if(!empty($arResult))
{
	?><ul><?
	$index = 0;
	foreach($arResult as $arItem)
		{
			if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) 
			continue;
			
			$clss = ($index > 4) ? 'nav-list__item block-none' : 'nav-list__item';
			if($arItem['TEXT']=='Покупателям' || $arItem['TEXT']=='Акции' || $arItem['TEXT']=='Новости' || $arItem['TEXT']=='Оплата' || $arItem['TEXT']=='Мебель в рассрочку')
			{
				if($arItem["SELECTED"])
				{
					?><li><a href="<?=$arItem["LINK"]?>" class="selected top-menu__item"><?=$arItem["TEXT"]?></a></li><?
				} else {
					?><li><a href="<?=$arItem["LINK"]?>" class="selected top-menu__item"><?=$arItem["TEXT"]?></a></li><?
				}
			}
			else
			{
				if($arItem["SELECTED"])
				{
					?><li><a href="<?=$arItem["LINK"]?>" class="selected top-menu__item"><?=$arItem["TEXT"]?></a></li><?
				} else {
					?><li><a class="top-menu__item" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li><?
				}
			}
			
			$index += 1;
		}
		?></ul><?
}