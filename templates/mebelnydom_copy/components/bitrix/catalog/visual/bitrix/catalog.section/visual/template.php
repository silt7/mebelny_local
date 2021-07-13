<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
$this->addExternalJs(SITE_TEMPLATE_PATH."/libs/slick.min.js");
$this->addExternalCss(SITE_TEMPLATE_PATH."/libs/slick.css");

$this->addExternalJs($templateFolder."/js/card.js");
$this->addExternalCss($templateFolder."/css/product.css");
$this->addExternalJs($templateFolder."/js/product.js");

$this->addExternalJs($templateFolder."/js/swiper-bundle.js");

$APPLICATION->AddHeadString('<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>');
$APPLICATION->AddHeadString('<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>');


// SEO Title кол-во
$elementsCount = CIBlockSection::GetSectionElementsCount($arResult['ID']);
$cnt=str_replace('{CNT}', $elementsCount, $arResult['IPROPERTY_VALUES']['SECTION_META_TITLE']);
$arResult['IPROPERTY_VALUES']['SECTION_META_TITLE'] = $cnt;


$res = CIBlockSection::GetByID($arResult['ID']);
if($ar_ress = $res->GetNext()) {
  $arResult['VARIABLES']['IBLOCK_SECTION_ID'] = $ar_ress['IBLOCK_SECTION_ID'];
}
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
    $GLOBALS['FORJSON_IMG'] = '';
?>
<div class="catalog__cards js-ax-ajax-pagination-content-container">
<!--ax-ajax-pagination-separator-->
  <?$i_element = 0;?>
  <?foreach($arResult["ITEMS"] as $cell=>$arElement):?>
      <?$i_element++;?>
      <?
        if($GLOBALS['FORJSON_IMG'] == ''){
            $GLOBALS['FORJSON_IMG'] = $arElement['PREVIEW_PICTURE'];
        }
      ?>
      <?if (($i_element == 15)&&(!empty($arResult['BLOGS']))):?>
          <div class="catalog-new__wrap mobile">
            <div class="catalog-new__slider">
                <?foreach ($arResult['BLOGS'] as $item):?>
                  <div class="catalog-new">
                    <div class="catalog-new__text">
                      <span class="catalog-new__toltip">Полезное по теме</span>
                      <a href="/stati/<?= $item['CODE']?>/" style="text-decoration: none;"><h3 class="catalog-new__title"><?= $item['NAME']?></h3></a>
                    </div>
                    <a href="/stati/<?= $item['CODE']?>/"><img src="<?= $item['PREVIEW_PICTURE']['src']?>" alt="" class="catalog-new__img"></a>
                  </div>
                <?endforeach;?>
            </div>
          </div>
      <?endif;?>
      <?if (($i_element == 16)&&(!empty($arResult['BLOGS']))):?>
          <div class="catalog-new__wrap display">
            <div class="catalog-new__slider">
                <?foreach ($arResult['BLOGS'] as $item):?>
                  <div class="catalog-new">
                    <div class="catalog-new__text">
                      <span class="catalog-new__toltip">Полезное по теме</span>
                      <a href="/stati/<?= $item['CODE']?>/" style="text-decoration: none;"><h3 class="catalog-new__title"><?= $item['NAME']?></h3></a>
                    </div>
                    <a href="/stati/<?= $item['CODE']?>/"><img src="<?= $item['PREVIEW_PICTURE']['src']?>" alt="" class="catalog-new__img"></a>
                  </div>
                <?endforeach;?>
            </div>
          </div>
      <?endif;?>
      <div id="<?= $arElement["ID"]?>" class="<?echo $arResult['VARIABLES']['IBLOCK_SECTION_ID'] == 119 || $arResult['VARIABLES']['IBLOCK_SECTION_ID'] == 1287 ? 'collection__card' : ''?> card catalog__card page-ajax load_more_item">
        <?if(($arElement['CATALOG_QUANTITY'] == 0)&&(empty($arElement['PROPERTIES']['POD_ZAKAZ']['VALUE']))):?>
            <div class="card-imgs">
                <? $file_wm = CFile::ResizeImageGet($arElement["PREVIEW_PICTURE"], array( "width" => 300, "height" => 220 ), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, false, false)?>
                <img loading="lazy" decoding="async" src="<?=$file_wm["src"];?>" alt="<?=$arElement["PREVIEW_PICTURE"]["ALT"]?>" class="card-img" style="opacity:0.4">
            </div>
        <?else:?>
            <div class="card-imgs">
              <div class="card-places">
                <? if($arElement["SALE_PERCENT"]) { ?>
                <? $index = 1; ?>
                <div class="card-place card-sale">
                  <img loading="lazy" decoding="async" src="<?= $templateFolder;?>/img/icon-sale.svg" alt="sale">
                  <span class="top-<?=$index;?>">Скидка - <?=$arElement["SALE_PERCENT"]?>%</span>
                </div>
                <? } else { ?>  
                <? $index = 0; ?>
                <? } ?>
                <? foreach($arElement["STICKERS"] as $key => $st) { $index += 1; ?> 
                    <?if( strpos($st, 'Новинка') !== false){?>
                    <div class="card-place card-new">
                      <img loading="lazy" decoding="async" src="<?= $templateFolder;?>/img/icon-new.svg" alt="new">
                      <span class="top-<?=$index;?>">Новинка</span>
                    </div>
                    <? } elseif(strpos($st, 'Хит') !== false ){ ?>
                    <div class="card-place card-hit">
                      <img loading="lazy" decoding="async" src="<?= $templateFolder;?>/img/icon-hit.svg" alt="promo">
                      <span class="top-<?=$index;?>">Хит</span>
                    </div>
                    <? } elseif(strpos($st, 'Акция') !== false ){ ?>
                    <div class="card-place card-promo">
                      <img loading="lazy" decoding="async" src="<?= $templateFolder;?>/img/icon-promo.svg" alt="promo">
                      <span class="top-<?=$index;?>">Акции</span>
                    </div>
                    <?}?>
                <? } ?>
              </div>
              <div class="card-imgs__slider">
                <a href="<?=$arElement["DETAIL_PAGE_URL"];?>" class="card-img__wrap">
                  <? $file_wm = CFile::ResizeImageGet($arElement["PREVIEW_PICTURE"], array( "width" => 300, "height" => 220 ), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, false, false)?>
                  <img loading="lazy" decoding="async" src="<?=$file_wm["src"];?>"
                    alt="<?=$arElement["PREVIEW_PICTURE"]["ALT"]?>" class="card-img">
                </a>
                <?$isFirst = true;?>
                <? foreach($arElement["PROPERTIES"]["MORE_PHOTO"]["VALUE"] as $key => $PHOTO) { ?>
                    <?if($isFirst){$isFirst = false;continue;}?>
                    <? $file_wm = CFile::ResizeImageGet($PHOTO, array( "width" => 300, "height" => 220 ), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, false, false)?>
                    <a href="<?=$arElement["DETAIL_PAGE_URL"];?>" class="card-img__wrap">
                      <img loading="lazy" decoding="async" src="<?=$file_wm["src"];?>"
                        alt="<?=$arElement["PREVIEW_PICTURE"]["ALT"]?>" class="card-img">
                    </a>
                <? } ?>
              </div>
            </div>
        <?endif?>
        <div class="card-price__wrap">
            <?if(!$_REQUEST["no_price"]){
                // Получение коллекции
                $arElement['NABOR'] = array();
                $arNaborAll = $arElement['PROPERTIES']['TOVARS_IN_NABOR_REKOMEND']['VALUE'];
                $price = 0;
                $discount_price = 0;
                $discount_diff = 0;
                if (count($arNaborAll) > 0 && $arNaborAll[0] > 0) {
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
                        $discount_price_formated = number_format($discount_price, 0, '', ' ');
                        $discount_price = $price_formated;
                        $price = $discount_price_formated;
                    } else {
                       $price = $price_formated;
                    }
                    if($discount_diff == 0)$discount_price = 0;
                }
                else{
                    foreach($arElement["PRICES"] as $code=>$arPrice){
                        if($arPrice["CAN_ACCESS"]){
                            if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]){
                                $discount_price = $arPrice["PRINT_VALUE"];
                                $price = $arPrice["PRINT_DISCOUNT_VALUE"];
    
                            } else {
                                $price = $arPrice["PRINT_VALUE"];
                            }
                       }
                    }
                }
            }?> 
          <div class="card-price">
            <span class="card-price__price"><?= str_replace('руб.', '', $price);?> ₽</span>
            <? if(str_replace('руб.', '', $discount_price)!= 0):?>
            <s class="card-price__sale"><?= str_replace('руб.', '', $discount_price);?> ₽</s>
            <? endif;?>
          </div>
          <div class="card-price__like">
            <button class="card-price__btn compare_btn" title="Сравнить" onclick="compare_tov(<?= $arElement['ID']?>, this)" data-id="<?= $arElement['ID']?>">
              <i class="card-compare"></i>
            </button>
            <button class="card-price__btn like_btn" title="Добавить в избранное" onclick="add_favorite(<?= $arElement['ID']?>)" data-id="<?= $arElement['ID']?>">
              <i class="card-like"></i>
            </button>
          </div>
        </div>
        <a href="<?=$arElement["DETAIL_PAGE_URL"];?>" class="card__title">
            <?
                if($arElement["PREFIX"]){
                    echo $arElement["PREFIX"] . ' ';
                }
            ?>
            <?=$arElement["NAME"]?>
        </a>
        <?if($arElement['CATALOG_QUANTITY'] > 0){?>
            <span class="card__meta">В наличии <span class="count"><?= $arElement['CATALOG_QUANTITY'];?></span></span>
        <?} else {?>
            <?if (!empty($arElement['PROPERTIES']['POD_ZAKAZ']['VALUE'])):?>
                <span class="card__meta">Под заказ <?= $arElement['PROPERTIES']['POD_ZAKAZ']['VALUE'];?> дн.</span>
            <?else:?>  
                <span class="card__meta">Нет в наличии</span>
            <?endif?>
        <?}?>
        <?
        if(CModule::IncludeModule("askaron.reviews")){
            $arParameters = array(
                'order' => array(
                    "GRADE" => "DESC",
                    'DATE' => 'DESC'
                ),
                "filter" => array(
                    "=ELEMENT_ID" => $arElement["ID"],
                    "ACTIVE" => "Y",
                ),
                'select' => array(
                    "*",
                    "AUTHOR_USER.NAME",
                ),
                'limit' => 100,
            );
        
            $res = \Askaron\Reviews\ReviewTable::getList( $arParameters );
            $arReviews = array();
            $grade = 0;
            while ( $arFields = $res->fetch() )
            {
                $arReviews[] = $arFields;
                $grade += $arFields['GRADE'];
            }
            $count_reviews = 0;
            $count_reviews = count($arReviews);
            $gradeAvg = round($grade/$count_reviews, 1);
            if(is_nan($gradeAvg)) $gradeAvg = 0;
        }
        ?>
        
        <div class="card-rating">
          <div class="card-stars">
            <?for($i=0; $i<5; $i++){?>
                <?if($i < $gradeAvg){?>
                <img loading="lazy" decoding="async" src="<?= $templateFolder;?>/img/icon-star.svg" alt="">
                <?} else {?>
                <img loading="lazy" decoding="async" src="<?= $templateFolder;?>/img/icon-star-fill.svg" alt="">
                <?}?>
            <?}?>
          </div>
          <?if($gradeAvg > 0):?>
          <span class="card-rating__rating"><?= $gradeAvg;?></span>
          <?else:?>
          <span class="card-rating__rating"></span>
          <?endif;?>
          <a class="card-rating__feedback"><?= $count_reviews;?> отзыв(a)</a>
        </div>
        <div class="card-info">
          <div class="card-info__row">
            <?if($arElement['PROPERTIES']['dlina_filter']['VALUE']):?>
            <span class="card-info__label">Длина</span>
            <span class="card-info__val"><?=$arElement['PROPERTIES']['dlina_filter']['VALUE']?> см</span>
            <?endif?>
          </div>
          <div class="card-info__row">
            <?if($arElement['PROPERTIES']['glubina_filter']['VALUE']):?>
            <span class="card-info__label">Глубина</span>
            <span class="card-info__val"><?=$arElement['PROPERTIES']['glubina_filter']['VALUE']?> см</span>
            <?endif?>
          </div>
          <div class="card-info__row">
            <?if($arElement['PROPERTIES']['vysota_filter']['VALUE']):?>
            <span class="card-info__label">Высота</span>
            <span class="card-info__val"><?=$arElement['PROPERTIES']['vysota_filter']['VALUE']?> см</span>
            <?endif?>
          </div>
          <?/* global $USER;
          if ($USER->IsAdmin()) {*/?>
          <div class="card-btns">
            <?if(($arElement['CATALOG_QUANTITY'] > 0)||($arElement['PROPERTIES']['POD_ZAKAZ']['VALUE']) != ''):?>
            <button class="card__btn card__btn__bay products__btns_cart" onclick="add_basket(<?=$arElement['ID'];?>)">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M11.5001 2.89998C9.78801 2.89998 8.4001 4.28789 8.4001 5.99998V8.09998H14.6001V5.99998C14.6001 4.28789 13.2122 2.89998 11.5001 2.89998ZM16.4001 8.09998V5.99998C16.4001 3.29378 14.2063 1.09998 11.5001 1.09998C8.7939 1.09998 6.6001 3.29378 6.6001 5.99998V8.09998H5.0001C3.95076 8.09998 3.1001 8.95063 3.1001 9.99998V21C3.1001 22.0493 3.95076 22.9 5.0001 22.9H18.0001C19.0494 22.9 19.9001 22.0493 19.9001 21V9.99998C19.9001 8.95063 19.0494 8.09998 18.0001 8.09998H16.4001ZM5.0001 9.89998C4.94487 9.89998 4.9001 9.94475 4.9001 9.99998V21C4.9001 21.0552 4.94487 21.1 5.0001 21.1H18.0001C18.0553 21.1 18.1001 21.0552 18.1001 21V9.99998C18.1001 9.94475 18.0553 9.89998 18.0001 9.89998H5.0001ZM8.5001 12C8.5001 12.5523 8.05238 13 7.5001 13C6.94781 13 6.5001 12.5523 6.5001 12C6.5001 11.4477 6.94781 11 7.5001 11C8.05238 11 8.5001 11.4477 8.5001 12ZM15.5001 13C16.0524 13 16.5001 12.5523 16.5001 12C16.5001 11.4477 16.0524 11 15.5001 11C14.9478 11 14.5001 11.4477 14.5001 12C14.5001 12.5523 14.9478 13 15.5001 13Z" fill="#3E85DC"/>
              </svg>
              Купить
            </button>
            <? $file_wm = CFile::ResizeImageGet($arElement["PREVIEW_PICTURE"], array( "width" => 300, "height" => 220 ), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, false, false)?>
            <button class="card__btn products__btns_oneclick" onclick="openClick1Popup('<?= $arElement["NAME"].':'.$file_wm['src'];?>')">В 1 клик</button>
            <?else:?>
            <button class="card__btn products__btns_arrival" onclick="openRecallPopup2('<?=$arElement['NAME'];?>')">Сообщить о поступлении</button>
            <?endif?>
            <?/* global $USER;
          if ($USER->IsAdmin()) {?>
            <button class="card__btn products__btns_oneclick" href="javascript:void(0)" onclick="openRecallPopup2()">Сообщить о поступлении</button>
            <?}*/?>
          </div>
        </div>
      </div>
  <?endforeach;?>
  <?=$arResult['NAV_STRING'];?>
  <!--ax-ajax-pagination-separator-->
  
</div>
<div id="bx_by_product" style="display:none;" class="bx_by_product">
    <div class="modal-busket__container">			
        <div class="modal-busket__title">Товар добавлен в корзину</div>
        	<div class="modal-busket__content">
            <div class="modal-busket__content-left">
                <div class="modal-busket__img-container">
                    <img src="/upload/iblock/c3f/obedennaya_gruppa_stol_vizavi_i_2_kh_stulev_klassika_orekh_temnyy.jpg" style="width:100%" alt="Товар добавлен в корзину">
                </div>
            </div>
            <div class="modal-busket__content-right">
                <div class="modal-busket__price"></div>
                <div class="modal-busket__count"></div>
                <div class="modal-busket__subinfo"></div>
            </div>
            </div>
        <div class="modal-busket__bottom">
            <a href="#" class="modal-busket__return-btn" onClick="$('.popup-window-overlay, .popup-window').hide()">Продолжить покупки</a>
            <a href="/personal/cart/" class="modal-busket__сheckout-btn btn-def">Оформить заказ</a>
        </div>
    </div>
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


