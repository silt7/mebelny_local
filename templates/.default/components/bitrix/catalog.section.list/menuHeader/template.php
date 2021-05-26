<?if(!defined('B_PROLOG_INCLUDED')||B_PROLOG_INCLUDED !== true)
    die();
$this->setFrameMode(true);
?>
<?php $this->addExternalCss($templateFolder."/styles.css");?>
<?php $this->addExternalJs($templateFolder."/scripts.js");?>
<?
    $string = file_get_contents($_SERVER['DOCUMENT_ROOT'].$templateFolder."/menu.json");
    $menu_arr = json_decode($string, true);
?>
<div class="menu-prev">
    <img src="/upload/arrow-left.svg" class="mobile" alt="">
    <span class="mobile">Каталог товаров</span>
</div>
  <?foreach($arResult['SECTIONS'] as $arSection):?>
    <div class="main-menu__item main-menu__item__hero main-menu__item__more">
      <a class="prevent" href="<?=$arSection[SECTION_PAGE_URL]?>">
        <div class="main-menu__icon-wrap">
          <img loading="lazy" decoding="async" src="<?=$arSection[UF_MENU_ICON]?>" alt=""
            class="main-menu__icon">
          <img loading="lazy" decoding="async" src="<?=$arSection[UF_MENU_ICON_HOVER]?>" alt=""
            class="main-menu__icon main-menu__icon__hover">
        </div>
        <span class="main-menu__text"><?=$arSection[NAME]?></span>
      </a>
      <?if(array_key_exists($arSection['ID'], $menu_arr)):?>
          <div class="main-menu__drop__sec">
            <div class="container">

            <?foreach($menu_arr[$arSection[ID]]['link'] as $item):?>
                <div class="main-menu__item main-menu__item__sec main-menu__item__more">
                  <a href="<?=$item[1]?>">
                    <span class="main-menu__text"><?=$item[0]?></span>
                  </a>
                </div>
              <?endforeach?>
                
            <?if(count($menu_arr[$arSection[ID]]['link']) > 9):?>
                <div class="main-menu__show-more menu__show-more__sec">
                    <img src="/upload/chevron-bottom.svg" class="desc" alt="">
                </div>
            <?endif?>
            </div>
          </div>
      <?endif?> 
      </div>
  <?endforeach?>