<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>       
<?
foreach($arResult['ITEMS'] as &$arElement) {
	if (!empty($arElement['OFFERS'])) {
		$arElement['PRICES'] = $arElement['OFFERS'][0]['PRICES'];
		$arElement['CAN_BUY'] = $arElement['PRICES']['BASE']['CAN_BUY'] == 'Y';
		$arElement['ID'] = $arElement['OFFERS'][0]['ID'];
	}
}
unset ($arElement);

if($arParams["DISPLAY_TOP_PAGER"]):
	echo $arResult["NAV_STRING"];
endif;
?> 

            <div class="recomend__product">
<span class="h3">Рекомендуемые товары</span>
                <div class='owl-carousel recomend-slider' id="owl-carousel-popular">    
 
				<? foreach($arResult["ITEMS"] as $cell=>$arElement):?>	

                    <div class="page-ajax  carousel-item">
						<?
                        $this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
                        $this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));
                        ?>
                        <div class="product-block">
                        <div class="stickers">
                          <? if($arElement["SALE_PERCENT"]) { ?>
                            <? $index = 1; ?>
                            <div class="top-<?=$index;?> sticker sticker__discount">
                                <img loading="lazy" decoding="async" class="sticker-img" src="/images/icon-sale.svg" alt="promo" >
                                Скидка - <?=$arElement["SALE_PERCENT"]?>%</div>
                          <? } elseif($arElement['OFFERS'][0]["MIN_PRICE"]["DISCOUNT_DIFF_PERCENT"]) { ?>
                            <? $index = 1; ?>
                            <div class="top-<?=$index;?> sticker sticker__discount">- <?=$arElement['OFFERS'][0]["MIN_PRICE"]["DISCOUNT_DIFF_PERCENT"]?>%</div>  
                          <? } else { ?>  
                            <? $index = 0; ?>
                          <? } ?>
                          <? foreach($arElement["STICKERS"] as $key => $st) { $index += 1; ?> 
                              <?if(strpos($st, 'Хит') !== false ){ ?>
                                    <div class="top-<?=$index;?> sticker sticker__<?=$key?>">
                                        <img loading="lazy" decoding="async" class="sticker-img" src="/images/icon-hit.svg" alt="promo" style="width: 5px !important">
                                        <?=$st?>
                                    </div>
                               <? } elseif(strpos($st, 'Акция') !== false ){ ?>
                                    <div class="top-<?=$index;?> sticker sticker__<?=$key?>">
                                        <img loading="lazy" decoding="async" class="sticker-img" src="/images/icon-promo.svg" alt="promo">
                                        <?=$st?>
                                    </div>
                               <?}?>
                          <? } ?>
                        </div>
                            <? //echo '<pre>'; print_r($stickers); echo '</pre>'; ?>
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
                                <? $compare = array_key_exists($arElement['ID'] , $_SESSION["CATALOG_COMPARE_LIST"][$arResult['IBLOCK_ID']]["ITEMS"] )?'active':'';?>
                                <div class="like">
                                    <i class="fa fa-retweet addToCompare <?= $compare?>" data-compare="<?=$arElement['ID']?>" aria-hidden="true" onclick="compare_tov(<?=$arElement['ID']?>, this)"></i>
                                    <a class="addFav" data-id="<?=$arElement["~ID"];?>" onclick="add_favorite(<?=$arElement["~ID"];?>)"><i class="fa fa-heart" aria-hidden="true"></i></a>
                                    <? /*?><a class="WSMFavoritesLink addFav" data-id="<?=$arElement['ID'];?>" href="#">В избранное</a><? */?>
                                </div>
                            </div>
                            <p class="desc-product">
                                <a href="<?=$arElement["DETAIL_PAGE_URL"];?>"><?=$arElement["NAME"]?></a>
                            </p>
							 <? /*if($arElement["CAN_BUY"]):?>
                               <a href="javascript:void(0);" id="pnb<?=$arElement['ID']?>" class="buscket btn-buy comrarno" rel="nofollow" onclick="add_to_cart('<?=$arElement['ID']?>');$(this).hide().next().show();"><span>Купить</span></a>
                               <a href="/personal/cart/" id="pib<?=$arElement['ID']?>" style="display:none;width:96px;" class="buscket btn-buy" rel="nofollow"><span>Товар в корзине</span></a> 
                              <? else:?>
                                <? if($arElement["PROPERTIES"]["ORDER"]["VALUE"]):?>
                                 <span class="text-success">Под заказ: <?=$arElement["PROPERTIES"]["ORDER"]["VALUE"]?></span>
                                <? else:?>
                                 <span class="text-info">Нет в наличии</span>
                                <? endif;?>  
                              <? endif;*/?>
                              <a href="<?=$arElement["DETAIL_PAGE_URL"];?>" class="buscket" rel="nofollow"><span>Подробнее</span></a>
                        </div>
                    </div>

           <? endforeach?>

        </div>
    </div>    			
<? //if($USER->IsAdmin()) {echo '<pre>'; print_r($arResult["ITEMS"]); echo '</pre>';} ?>