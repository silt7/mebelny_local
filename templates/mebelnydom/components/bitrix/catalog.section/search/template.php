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

	if ($arParams["DISPLAY_TOP_PAGER"]) {
		echo $arResult["NAV_STRING"];
	}
?> 
 <div class="product-content visual"> 
  <div id="wrap-news"> 
         
             <div class="product-flex-box">
 
				<? foreach($arResult["ITEMS"] as $cell=>$arElement):?>	
                    <div class="product-wrap page-ajax">
                    	<?
							$this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
							$this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));
                        ?>
                        <div class="product-block">
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
                                                    <div class="old-price"><?=$arPrice["PRINT_VALUE"]?></div>
													<?=$arPrice["PRINT_DISCOUNT_VALUE"]?>
                                                <? else:?><?=$arPrice["PRINT_VALUE"]?><? endif;?>     
                                        <? endif;?>
                                    <? endforeach;?>
                                </div>
                                <div class="like">
                                    <i class="fa fa-retweet" data-compare="<?=$arElement['ID']?>" aria-hidden="true"></i>
                                    <a class="addFav" data-id="<?=$arElement["ID"];?>" href="#"><i class="fa fa-heart" aria-hidden="true"></i></a>
                                </div>
                            </div>
                            <p class="desc-product">
                                <a href="<?=$arElement["DETAIL_PAGE_URL"];?>"><?=$arElement["NAME"]?></a>
                            </p>
                              <? if($arElement["CAN_BUY"]):?>
                               <a href="javascript:void(0);" id="pnb<?=$arElement['~ID']?>" class="buscket btn-buy comrarno" rel="nofollow" onclick="add_to_cart('<?=$arElement['ID']?>');$(this).hide().next().show();"><span>Купить</span></a>
<a href="/personal/cart/" id="pib<?=$arElement['ID']?>" style="display:none;width:96px;" class="buscket btn-buy" rel="nofollow"><span>Товар в корзине</span></a> 
                              <? else:?>
                                <? if($arElement["PROPERTIES"]["ORDER"]["VALUE"]):?>
                                 <span class="text-success">Под заказ: <?=$arElement["PROPERTIES"]["ORDER"]["VALUE"]?></span>
                                <? else:?>
                                 <span class="text-info">Нет в наличии</span>
                                <? endif;?>  
                              <? endif;?>
                        </div>
                    </div>
                    <script data-skip-moving="true">
                        var id = <?=$arElement['ID']?>;
                        if (in_array_basket(id)) {
                            document.getElementById('pib'+id).style.display = "";
                            document.getElementById('pnb'+id).style.display = "none";
                        }
                    </script>
                    
           <? endforeach?>
           

    <?
           if($arParams["DISPLAY_BOTTOM_PAGER"]):
				echo $arResult["NAV_STRING"];
			endif;
		   ?>
     </div>   
    </div>
    
</div>    
<script src="/bitrix/js/fgsoft.autoloader/autoloader.plugin.js"></script>  
<script>
	(function($){
		if ($('#wrap-news').length && $('#wrap-news font.text').length) {
			$('#wrap-news').showMorePlugin({
				item: '.page-ajax',
				//wrapNavigation: '.pagination',
				buttonClass: 'load',
				//divButtonClass: 'div-show-more',
			});
		}
	})(jQuery);
</script>
<? //if($USER->IsAdmin()) {echo '<pre>'; print_r($arResult); echo '</pre>'; } ?>