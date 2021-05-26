<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Localization\Loc;

$this->setFrameMode(true);
?>


            <div class="brend-title">
                    <div class="logo-brend">
                        <div class="h1"><a href="/brands/">Бренды</a></div>
                    </div>
                    <div class="desc-brend block-none-mob">
                        <p>На сайте мебельного магазина Вы найдете много интересных моделей, а также  последние новинки
                            мебельного рынка от производителей Малайзии и Белоруссии. </p>
                    </div>
            </div>
            <div class="brend-logo">
              <?php foreach ($arResult["ITEMS"] as $arItem): ?>
                <a href="<?=$arItem["DETAIL_PAGE_URL"];?>"><img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"];?>" alt="<?=$arItem["NAME"];?>"></a>
              <? endforeach;?>
            </div>