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



<div class="askaron-reviews-for-element testimonials-block">

	<div class="reviews-wrap">
            <a href="#" id="add-review-btn">Оставить отзыв</a>
            <div class="reviews-block-row">
                <? foreach ( $arResult["ITEMS"] as $key => $arItem ):?>
                    <div class="reviews-block ask-review<? if ( $arItem["ACTIVE"] == "N" ) echo ' ask-not-active';?> <?if($key >= 4) echo 'reviews-block-noshow'?>">

                        <div class="reviews__title">
                            <p class="name"><?=$arItem["DISPLAY_NAME"];?><span class="date"><?=$arItem["DATE_SHORT"];?></span>

                            <? if ( $arParams["MODULE_RIGHT"] >= "R" ):?>

                                <? if ( $arItem["ACTIVE"] !== "Y" ):?>
                                    <span><?=GetMessage("ASKARON_REVIEWS_FOR_ELEMENT_T_NOT_PUBLIC")?></span>
                                <? endif?>

                            <? endif?>

                            <div class="stars"><?
                                for ( $i=1; $i<=5; $i++ )
                                {
                                    if( $arItem["GRADE"] >= $i )
                                    {
                                        ?><img src="/local/templates/mebelnydom/components/askaron/askaron.reviews.new/img/star-yello.png" alt=""/><?
                                    }
                                    else
                                    {
                                        ?><img src="/local/templates/mebelnydom/components/askaron/askaron.reviews.new/img/star-grey.png" alt=""/><?
                                    }
                                }
                            ?>
                            </div>

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


                        <? if ( strlen( $arItem["PRO"] ) > 0 ):?>
                                <p class="plus">Достоинства<span class="desc"><?=$arItem["PRO"]?></span>
                        <? endif?>

                        <? if ( strlen( $arItem["CONTRA"] ) > 0 ):?>
                                <p class="minus">Недостатки<span class="desc"><?=$arItem["CONTRA"]?></span>
                        <? endif?>

                        <? if ( strlen( $arItem["TEXT"] ) > 0 ):?>
                        <p><?=$arItem["TEXT"]?></p>
                        <? endif?>

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
	
    </div>
    
	<? if ( $arParams["NEW_REVIEW_FORM"] == "Y"):?>
    

		<? if ( count( $arResult["ITEMS"] ) > 0 ):?>
			<div class="ask-new-interval">&nbsp;</div>
		<? endif?>
	
            <div class="modal fade modal-review-form">
                <div class="modal-call__wrap">
                    <div class="modal-busket__dialog">
                        <a href="#" class="modal-call__close-btn" id="review-modal-close-btn"></a>
                        <? $APPLICATION->IncludeComponent(
	"askaron:askaron.reviews.new", 
	"md", 
	array(
		"ELEMENT_ID" => $arParams["ELEMENT_ID"],
		"COMPONENT_TEMPLATE" => "md",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);?>
                    </div>
                </div>
            </div>

	<? endif?>
</div>

<? //echo "<pre>"; print_r($arResult); "</pre>"; ?>