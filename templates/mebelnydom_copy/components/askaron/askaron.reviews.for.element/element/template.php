<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$this->setFrameMode(true);

$arParams["NEW_REVIEW_FORM"] = ($arParams["NEW_REVIEW_FORM"] != "N") ? "Y": "N";
$arParams["SCHEMA_ORG_INSIDE_PRODUCT"] = ($arParams["SCHEMA_ORG_INSIDE_PRODUCT"] != "Y") ? "N": "Y";
?>

<?

if(count($arResult["ITEMS"]) > 0){
    $count_reviews = count($arResult["ITEMS"]);
}else{
    $count_reviews = 0;
}
$APPLICATION->SetPageProperty("count_reviews", $count_reviews);
?>


<div class="products__feedback_body">           
    <? foreach ( $arResult["ITEMS"] as $key => $arItem ):?>
        <div class="products__feedback_item">
    		<div class="products__feedback_item-top">
    			<span class="products__feedback_item-name"><?= $arItem['AUTHOR_NAME']?></span>
    			<span class="products__feedback_item-date"><?= $arItem['DATE']?></span>
    			<span
    				class="rating"
    				data-stars="5"
    				data-default-rating="<?= $arItem['GRADE']?>"
    			></span>
    		</div>
            <? if ( $arParams["MODULE_RIGHT"] >= "W" ):?>
                <p class="setting-title">
                    <? if ( $arItem["ACTIVE"] !== "Y" ):?>
                        <?=$arItem["URL"]["SHOW"]?>
                    <? else:?>
                        <?=$arItem["URL"]["HIDE"]?>
                    <? endif?>
    
                    <?=$arItem["URL"]["EDIT"]?>
                    <?=$arItem["URL"]["DELETE"]?>
                </p>
            <? endif?>
    
            <div class="products__feedback_item-marks">
    			<p class="green">
    				Достоинства
    				<span style="padding-left: 16px"><?= $arItem['PRO']?></span>
    			</p>
    			<p class="red">
    				Недостатки
    				<span style="padding-left: 23px"><?= $arItem['CONTRA']?></span>
    			</p>
    		</div>
    
    		<div class="products__feedback_item-desc">
                <?= $arItem['TEXT']?>
    		</div>
    	</div>
    <? endforeach?>
</div>             
        
            <?if(count($arResult["ITEMS"]) > 4){?>
                <div class="revews-show-more">
                    <a href="#" id="revews-show-more-btn">показать еще</a>
                </div>
            <?}?>

	<? if ( count( $arResult["ITEMS"] ) == 0 ):?>
        <div class="article" style="padding:0px !important; margin:0px !important;">
            <p> К этому товару ещё нет отзывов. Вы можете оставить своё мнение, указав плюсы и минусы товара, а также свой небольшой комментарий.
        </div>
    <? endif;?>

	<? if ( $arParams["DISPLAY_BOTTOM_PAGER"] ):?>
		<?=$arResult["NAV_STRING"]?>
	<? endif?>
	

<? //echo "<pre>"; print_r($arResult); "</pre>"; ?>