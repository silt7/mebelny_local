<?php
	if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

	foreach($arResult['ITEMS'] as &$arElement) {
		if (!empty($arElement['OFFERS'])) {
			$arElement['PRICES'] = $arElement['OFFERS'][0]['PRICES'];
			$arElement['CAN_BUY'] = $arElement['PRICES']['BASE']['CAN_BUY'] == 'Y';
			$arElement['ID'] = $arElement['OFFERS'][0]['ID'];
		}
	}
	unset ($arElement);

	if (CModule::IncludeModule('orion.infinitescroll')) {
		$sBeginMark = COrionInfiniteScroll::GetBeginMark($arResult['NAV_RESULT']->NavNum);
		$sEndMark = COrionInfiniteScroll::GetEndMark($arResult['NAV_RESULT']->NavNum);	
	}

	if ($arParams["DISPLAY_TOP_PAGER"]) {
		echo $arResult["NAV_STRING"];
	}
?> 
<div class="recomend__product collection-product">
    <div class="collection__top">
        <span class="h2">Товары коллекции</span>
        <p class="collection__desc">Вы можете отметить только нужные вам элементы коллекции. Все товары будут
        изготовлены из одних материалов и не будут отличаться по качеству и цвету!</p>
    </div>
    <div class="recomend-slider">
				<? foreach($arResult["ITEMS"] as $cell=>$arElement):?>
                    <div class="w_tovar-in-nabor product-wrap">
                    	<?
                        $this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
                        $this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));
                        ?>
                        <div class="w_tovar-in-nabor product-block">
                            <div class="stickers">
                              <? if($arElement["SALE_PERCENT"]) { ?>
                                <? $index = 1; ?>
                                <div class="top-<?=$index;?> sticker sticker__discount">- <?=$arElement["SALE_PERCENT"]?>%</div>
                              <? } elseif($arElement['OFFERS'][0]["MIN_PRICE"]["DISCOUNT_DIFF_PERCENT"]) { ?>
                                <? $index = 1; ?>
                                <div class="top-<?=$index;?> sticker sticker__discount">- <?=$arElement['OFFERS'][0]["MIN_PRICE"]["DISCOUNT_DIFF_PERCENT"]?>%</div>  
                              <? } else { ?>  
                                <? $index = 0; ?>
                              <? } ?>
                              <? foreach($arElement["STICKERS"] as $key => $st) { $index += 1; ?> 
                               <div class="top-<?=$index;?> sticker sticker__<?=$key?>"><?=$st?></div>
                              <? } ?>
                            </div>
                            <a href="<?=$arElement["DETAIL_PAGE_URL"]?>">
                                <? $file_wm = CFile::ResizeImageGet($arElement["PREVIEW_PICTURE"], array( "width" => 520, "height" => 440 ), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, false, false)?>
                                <img class="img-responsive" src="<?=$file_wm["src"];?>" alt="<?=$arElement["PREVIEW_PICTURE"]["ALT"]?>">
                            </a>
                            <div class="row" style="padding: 0 5px !important;">
                                <div class="price">
                                	<? foreach($arElement["PRICES"] as $code=>$arPrice):?>
                                        <? if($arPrice["CAN_ACCESS"]):?>
                                                <? if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
                                                    <span class="old-price"><?=$arPrice["PRINT_VALUE"]?></span><br><?=$arPrice["PRINT_DISCOUNT_VALUE"]?>
                                                <? else:?><?=$arPrice["PRINT_VALUE"]?><? endif;?>     
                                        <? endif;?>
                                    <? endforeach;?>
                                </div>
                                <div class="like">
                                    <i class="fa fa-retweet" data-compare="<?=$arElement['ID']?>" aria-hidden="true"></i>
                                    <a class="addFav" data-id="<?=$arElement["~ID"];?>" href="#"><i class="fa fa-heart" aria-hidden="true"></i></a>
                                </div>
                            </div>
                            <p class="desc-product">
                                <a href="<?=$arElement["DETAIL_PAGE_URL"];?>"><?=$arElement["NAME"]?></a>
                            </p>
                            <a href="#" class="buscket innabor" data-id="<?=$arElement['ID']?>">Добавить в набор</a>
                            <a href="#" class="buscket outnabor" style="display:none" data-id="<?=$arElement['ID']?>">Товар в наборе</a>
                        </div>
                    </div>
           <? endforeach?>
    </div>
</div>