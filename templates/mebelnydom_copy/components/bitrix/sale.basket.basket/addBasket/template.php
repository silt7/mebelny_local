<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
/** @var CBitrixBasketComponent $component */

$arItems = $arResult['ITEMS']['AnDelCanBuy'];
?>
<div class="modal-busket__title">Товар добавлен в корзину</div>
<div class="modal-busket__desc">
	Всего в вашей корзине <?=count($arItems)?> товар. <a href="/personal/cart/" class="modal-busket__desc-link">Посмотреть</a>
</div>

<?php foreach ($arItems as $item) { ?>
	<?php if (!in_array($item['PRODUCT_ID'], $arParams['IDS'])) continue; ?>
<div class="modal-busket__content">
    <div class="modal-busket__content-left">
        <div class="modal-busket__img-container">
            <?php if (!empty($item['PREVIEW_PICTURE_SRC'])) { ?>
            <img src="<?=$item['PREVIEW_PICTURE_SRC']?>" alt="img" class="modal-busket__img">
            <?php } ?>
        </div>
    </div>
    <div class="modal-busket__content-right">
        <div class="modal-busket__price"><?=$item['PRICE_FORMATED']?></div>
        <div class="modal-busket__subinfo"><?=$item['NAME']?></div>
        <?php /*<div class="modal-busket__remaining">Осталось в наличии: 2 шт</div>*/ ?>
        <a href="#" data-id="<?=$item['ID']?>" class="modal-busket__delete-item"></a>
    </div>
</div>
<?php } ?>

<div class="modal-busket__bottom">
    <a href="#" data-dismiss="modal" class="modal-busket__return-btn">Продолжить покупки</a>
    <a href="/personal/cart/" class="modal-busket__сheckout-btn btn-def">Оформить заказ</a>
</div>