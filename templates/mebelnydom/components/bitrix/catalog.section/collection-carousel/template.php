<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); ?>       
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

            <div class="recomend__product" style="margin-top: 0;">
                <div class="collection-slider" style=" max-width: 100%;">
 
				<? foreach($arResult["ITEMS"] as $cell=>$arElement):?>	

                    <div class="collection__product-slide">
						<?
                        $this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
                        $this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));
                        ?>
                        <div class="product-block">
                            <a href="<?=$arElement["DETAIL_PAGE_URL"]?>" class="image-link">
                                <?
                                if($arElement["PREVIEW_PICTURE"]){
                                    $picture = $arElement["PREVIEW_PICTURE"];
                                }else{
                                    $picture = $arElement["DETAIL_PICTURE"];
                                }
                                ?>
                                <? $file_wm = CFile::ResizeImageGet($picture, array( "width" => 293, "height" => 220 ), BX_RESIZE_IMAGE_EXACT, false, false)?>
                                <img class="img-responsive" src="<?=$file_wm["src"];?>" alt="<?=$arElement["PREVIEW_PICTURE"]["ALT"]?>">
                            </a>
                            <div class="collection__product-slide-bottom">
                                <a class="collection__product-name"  href="<?=$arElement["DETAIL_PAGE_URL"];?>"><?=$arElement["NAME"]?></a>
                                <div class="row">
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
                                        <a class="addFav" data-id="<?=$arElement["~ID"];?>" href="#"><i class="fa fa-heart" aria-hidden="true"></i></a>
                                        <? /*?><a class="WSMFavoritesLink addFav" data-id="<?=$arElement['ID'];?>" href="#">В избранное</a><? */?>
                                    </div>
                                </div>
                                <div class="collection-basket">
                                    <a href="#" class="collection-basket-btn  innabor" data-id="<?=$arElement['ID']?>">Добавить в набор</a>
                                    <a href="#" class="collection-basket-btn  outnabor" style="display:none" data-id="<?=$arElement['ID']?>">Товар в наборе</a>
                                </div>
                            </div>
                        </div>
                    </div>

           <? endforeach?>

        </div>
    </div>    			
<? //if($USER->IsAdmin()) {echo '<pre>'; print_r($arResult["ITEMS"]); echo '</pre>';} ?>

