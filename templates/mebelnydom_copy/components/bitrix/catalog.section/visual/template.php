<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
// SEO Title кол-во
$elementsCount = CIBlockSection::GetSectionElementsCount($arResult['ID']);
$cnt=str_replace('{CNT}', $elementsCount, $arResult['IPROPERTY_VALUES']['SECTION_META_TITLE']);
$arResult['IPROPERTY_VALUES']['SECTION_META_TITLE'] = $cnt;
?>



<?
	foreach($arResult['ITEMS'] as &$arElement) {
		if (!empty($arElement['OFFERS'])) {
			$arElement['PRICES'] = $arElement['OFFERS'][0]['PRICES'];
			$arElement['CAN_BUY'] = $arElement['PRICES']['BASE']['CAN_BUY'] == 'Y';
			$arElement['ID'] = $arElement['OFFERS'][0]['ID'];
		}
	}
	unset ($arElement);
?> 

<?
    // if($arResult['DEPTH_LEVEL']==2)
    // $sectionId = $arResult['IBLOCK_SECTION_ID'];
    // else $sectionId = $arResult['ID'];
?>




    <div class="js-ax-ajax-pagination-content-container">
    <!--ax-ajax-pagination-separator-->
        <div class="product-flex-box load_more_wrap" id="wrap-news">
            <?foreach($arResult["ITEMS"] as $cell=>$arElement):?>	
                <div class="product-wrap page-ajax load_more_item" >
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
                            <? $file_wm = CFile::ResizeImageGet($arElement["PREVIEW_PICTURE"], array( "width" => 520, "height" => 440 ), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, false, false, false, 90)?>
                            <img class="img-responsive" src="<?=$file_wm["src"];?>" alt="<?=$arElement["PREVIEW_PICTURE"]["ALT"]?>">
                        </a>
                        <div class="row">
                            <?if(!$_REQUEST["no_price"]){?>
                            <div class="price" >
                                <?
                                // Получение коллекции
                                $arElement['NABOR'] = array();
                                $arNaborAll = $arElement['PROPERTIES']['TOVARS_IN_NABOR_REKOMEND']['VALUE'];
                                if (count($arNaborAll) > 0 && $arNaborAll[0] > 0) {
                                    $price = 0;
                                    $discount_price = 0;
                                    $discount_diff = 0;


                                    $arParams['USE_PRODUCT_QUANTITY'] = false;
                                    $arNaborStart = $arElement['PROPERTIES']['TOVARS_IN_NABOR']['VALUE'];
                                    $arNaborStartCount = $arElement['PROPERTIES']['KOL_TOVARS_IN_NABOR']['VALUE'];

                                    $arSelect = Array('ID', 'IBLOCK_ID', 'NAME', 'DETAIL_PAGE_URL');
                                    $arFilter = Array('ID' => $arNaborAll, 'ACTIVE_DATE' => 'Y', 'ACTIVE' => 'Y');
                                    $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
                                    while ($row = $res->GetNext()) {
                                        $url = explode('/', $row['DETAIL_PAGE_URL']);
                                        $element = array_pop($url);
                                        $section = $url[1];
                                        $row['DETAIL_PAGE_URL'] = '/' . $section . '/' . $element;
                                        $row['ID_MAIN'] = $row['ID'];

                                        if($GLOBALS["ALL_PRICES"][$row['ID']]['PRICE']){
                                                $row['PRICE'] = $GLOBALS["ALL_PRICES"][$row['ID']]['PRICE'];
                                        }else{
                                            if ($row['PRICE'] = CCatalogProduct::GetOptimalPrice($row['ID'])) {
                                                $row['PRICE'] = $row['PRICE']['RESULT_PRICE'];
                                            } else {
                                                $off_price = array();
                                                $ob_off = CIBlockElement::GetList(Array("SORT"=>"ASC"),Array('ACTIVE'=>'Y','CATALOG_AVAILABLE'=>'Y','PROPERTY_CML2_LINK.ID'=>$row['ID']),false,false,Array('ID'));
                                                while ($ar_fields = $ob_off->GetNext()) {
                                                    $off_price[$ar_fields['ID']]=CCatalogProduct::GetOptimalPrice($ar_fields['ID'])['RESULT_PRICE'];
                                                }
                                                uasort($off_price, function ($a, $b) {
                                                    if ($a['DISCOUNT_PRICE'] == $b['DISCOUNT_PRICE']) {
                                                        return 0;
                                                    }
                                                    return ($a['DISCOUNT_PRICE'] < $b['DISCOUNT_PRICE']) ? -1 : 1;
                                                });
                                                $row['ID'] = key($off_price);
                                                $off_price = array_shift($off_price);
                                                $row['PRICE'] = $off_price;
                                            }
                                        }

                                        $row['QUANTITY'] = 0;
                                        if (false !== ($find = array_search($row['ID_MAIN'], $arNaborStart))) {
                                            $row['QUANTITY'] = $arNaborStartCount[$find];
                                        }

                                        $price          += $row['PRICE']['BASE_PRICE'] * $row['QUANTITY'];
                                        $discount_price += $row['PRICE']['DISCOUNT_PRICE'] * $row['QUANTITY'];

                                        $arResult['NABOR'][] = $row;
                                    }

                                    $discount_diff = $price - $discount_price;
                                    $price_formated = number_format($price, 0, '', ' ');
                                    if($discount_diff){
                                        $discount_price_formated = number_format($discount_price, 0, '', ' ');?>
                                        <div class="old-price"><?=$price_formated?> руб.</div>
                                        <? echo $discount_price_formated . ' руб.';?>
                                    <?}else {
                                        echo $price_formated . ' руб.';
                                    }
                                }
                                else{
                                ?>
                                    <? foreach($arElement["PRICES"] as $code=>$arPrice):?>
                                        <? if($arPrice["CAN_ACCESS"]):?>
                                                <? if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
                                                    <div class="old-price"><?=$arPrice["PRINT_VALUE"]?></div>
                                                    <?=$arPrice["PRINT_DISCOUNT_VALUE"]?>

                                                <? else:?><?=$arPrice["PRINT_VALUE"]?>

                                                <? endif;?>
                                        <? endif;?>
                                    <? endforeach;?>
                            <?}?>
                            </div>
                            <?}?>
                            <div class="like">
                                <i class="fa fa-retweet" data-compare="<?=$arElement['ID']?>" aria-hidden="true"></i>
                                <a class="addFav" data-id="<?=$arElement["~ID"];?>" href="#"><i class="fa fa-heart" aria-hidden="true"></i></a>
                                <? /*?><a class="WSMFavoritesLink addFav" data-id="<?=$arElement['ID'];?>" href="#">В избранное</a><? */?>
                            </div>
                        </div>
                        <p class="desc-product">
                            <a href="<?=$arElement["DETAIL_PAGE_URL"];?>">
                                <?
                                if($arElement["PREFIX"]){
                                    echo $arElement["PREFIX"] . ' ';
                                }
                                ?>
                                <?=$arElement["NAME"]?>
                            </a>
                        </p>

                            
                            <?//if($USER->IsAdmin()):?>
                            <div class="wds_gab">
                                <?if($arElement['PROPERTIES']['dlina_filter']['VALUE']):?>
                                    <div class="wds_gab_item w_dlina">
                                        <div class="wds_gab_name">Длина</div>
                                        <div class="wds_gab_dottes"></div>
                                        <div class="wds_gab_value"><?=$arElement['PROPERTIES']['dlina_filter']['VALUE']?> см</div>
                                    </div>
                                <?endif?>
                                <?if($arElement['PROPERTIES']['glubina_filter']['VALUE']):?>
                                    <div class="wds_gab_item w_glubina">
                                        <div class="wds_gab_name">Глубина</div>
                                        <div class="wds_gab_dottes"></div>
                                        <div class="wds_gab_value"><?=$arElement['PROPERTIES']['glubina_filter']['VALUE']?> см</div>
                                    </div>
                                <?if($arElement['PROPERTIES']['vysota_filter']['VALUE']):?> 
                                <?endif?>
                                    <div class="wds_gab_item w_vysota">
                                        <div class="wds_gab_name">Высота</div>
                                        <div class="wds_gab_dottes"></div>
                                        <div class="wds_gab_value"><?=$arElement['PROPERTIES']['vysota_filter']['VALUE']?> см</div>
                                    </div>
                                <?endif?>
                            </div>
                            <?//endif?>

                            <span class="js_span_location buscket" data-location="<?=$arElement["DETAIL_PAGE_URL"];?>"><span>Подробнее</span></span>

                    </div>
                </div>
                <script data-skip-moving="true">
                    /*var id = <?=$arElement['ID']?>;
                    if (in_array_basket(id)) {
                        document.getElementById('pib'+id).style.display = "";
                        document.getElementById('pnb'+id).style.display = "none";
                    }*/
                </script>
            <?endforeach?>
        </div>
         <?=$arResult['NAV_STRING'];?>
    <!--ax-ajax-pagination-separator-->
    </div>


  <script>
    if (typeof(jQuery) != 'undefined' && jQuery().axpajax) {
        $(document).ready(function () {
            $('.js-ax-ajax-pagination-content-container').axpajax({
                lazyDynamic: false,
                lazyDynamicTimeout: 0,
                lazyDynamicOffset: -300,
                lazyDynamicDelayedStart: false,
                pagination: '.js-ax-ajax-pagination-container a.js-ax-pager-link',
                lazyLoad: '.js-ax-ajax-pagination-container .js-ax-show-more-pagination',
                lazyContainer: '.js-ax-ajax-pagination-container',
                specialParams: {
                    ajax_page: true
                },
                callbacks: {
                    beforeLoad: function (obj) { },
                    afterLoad: function (obj) { },
                    onError: function (err) { }
                }
            });
        });
    }
</script>
