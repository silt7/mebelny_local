<?if(!defined('B_PROLOG_INCLUDED')||B_PROLOG_INCLUDED !== true)
    die();
$this->setFrameMode(true);
?>


				<ul class="categ__list menu-list">
					<?foreach($arResult['SECTIONS'] as $arSection):?>
						<li class="menu-list__item">
							<a href="<?=$arSection[SECTION_PAGE_URL]?>" class="menu-list__link">
								<i class="menu-list__icon menu-list__default menu-list__icon--1" style="background-image: url(<?=$arSection[UF_MENU_ICON]?>);"></i>
								<i class="menu-list__icon menu-list__hover menu-list__icon--1" style="background-image: url(<?=$arSection[UF_MENU_ICON_HOVER]?>);"></i>
								<?=$arSection[NAME]?>
							</a>
						</li>
					<?endforeach?>
				</ul>
