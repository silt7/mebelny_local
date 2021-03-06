<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);?>

<? /*$APPLICATION->SetPageProperty("og:type", "website"); ?>
<? $APPLICATION->SetPageProperty("og:image", "http://".SITE_SERVER_NAME.CFile::GetPath($arResult["PROPERTIES"]['MORE_PHOTO']["VALUE"][0])); ?>
<? $APPLICATION->SetPageProperty("og:title", $arResult["NAME"]); ?>
<? $APPLICATION->SetPageProperty("og:description", $arResult["PREVIEW_TEXT"]); ?>
<? $APPLICATION->SetPageProperty("og:url", "http://".SITE_SERVER_NAME.$arResult["DETAIL_PAGE_URL"]); */?>
<!--    <pre>--><?//print_r($arResult)?><!--</pre>-->
            <div class="product__title">
                <h1 ><?=$arResult["NAME"];?></h1>
                <div class="mobile-count-row">
                    <span>Артикул:<br> <?=$arResult["PROPERTIES"]["ARTNUMBER"]["VALUE"]?></span>
                    <div class="product-count-row">
                        <?
                        $count = 0;
                        if($arResult['CATALOG_QUANTITY']>0){
                            $count = $arResult['CATALOG_QUANTITY'];
                        }
                        ?>
                        <?if($count > 0){?>
                            <div class="product-count-column">
                                В наличии <span class="product-count-green"><?=$count?></span>
                            </div>
                        <?}?>
                        <?if($arResult['PROPERTIES']['POD_ZAKAZ']['VALUE']):?>
                            <div class="product-count-column">
                                Под заказ <span class="product-count-brown"><?=$arResult['PROPERTIES']['POD_ZAKAZ']['VALUE']?> <?=$arResult['PROPERTIES']['POD_ZAKAZ']['DESCRIPTION']?></span>
                            </div>
                        <?endif?>
                    </div>
                </div>
            </div>
            <div class="hero">
                <div class="slider-photo">
                    <div class="slider-photo-small">
                       <? /*if($arResult["DETAIL_PICTURE"]) { ?>
                        <? $file_wm = CFile::ResizeImageGet($arResult["DETAIL_PICTURE"], array( "width" => 69, "height" => 52 ), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, false, false)?>
                        <div class="slider-photo-small__item">
                            <img src="<?=$file_wm["src"]?>" alt="<?=$arResult["DETAIL_PICTURE"]["ALT"]?>" title="<?=$arResult["DETAIL_PICTURE"]["TITLE"]?>">
                        </div>
                       <? } */?>
                       <? foreach($arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"] as $key => $PHOTO) { ?>
                        <? $file_wm = CFile::ResizeImageGet($PHOTO, array( "width" => 68, "height" => 48 ), BX_RESIZE_IMAGE_EXACT , false, false)?>
                        <div class="slider-photo-small__item">
                            <img src="<?=$file_wm["src"]?>" alt="<?=$arResult["NAME"];?>. Фото <?=$key+1?>" title="<?=$arResult["NAME"];?>. Фото <?=$key+1?>">
                        </div>
                       <? } ?> 
                    </div>
                    <div class="slider-photo-main">
                       <? /*if($arResult["DETAIL_PICTURE"]) { ?>
                            <? $file_wm = CFile::ResizeImageGet($arResult["DETAIL_PICTURE"], array( "width" => 655, "height" => 480 ), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, false, false)?>
                            <div class="slider-photo-main__item">
                                <a href="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" data-lightbox="det-img-0"><img src="<?=$file_wm["src"]?>" alt="<?=$arResult["DETAIL_PICTURE"]["ALT"]?>" title="<?=$arResult["DETAIL_PICTURE"]["TITLE"]?>"></a>
                            </div>
                       <? } */?>
                       <? foreach($arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"] as $key => $PHOTO) { ?>
                            <? $file_wm = CFile::ResizeImageGet($PHOTO, array( "width" => 655, "height" => 480 ), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, false, false)?>
                            <div class="slider-photo-main__item">
                                <a href="<?=CFile::GetPath($PHOTO);?>" data-lightbox="det-img-0">
                                    <div class="stickers" style=" z-index:10">
                                        <? if($arResult["SALE_PERCENT"] > 0) { ?>
                                            <? $index = 1; ?>
                                            <div class="top-<?=$index;?> sticker sticker__discount">- <?=$arResult["SALE_PERCENT"]?>%</div>
                                        <? } else { ?>
                                            <? $index = 0; ?>
                                        <? } ?>
                                        <? foreach($arResult["STICKERS"] as $key => $st) { $index += 1; ?>
                                            <div class="top-<?=$index;?> sticker sticker__<?=$key?>"><?=$st?></div>
                                        <? } ?>
                                    </div>
                                    <img src="<?=$file_wm["src"]?>" alt="<?=$arResult["NAME"];?>. Фото <?=$key+1?>" title="<?=$arResult["NAME"];?>. Фото <?=$key+1?>">
                                </a>
                            </div>
                        <? } ?>
                    </div>
                </div>
                <div class="product-desc">
                    <? /*$cpu = explode("/",$arResult["CANONICAL_PAGE_URL"]); 
	                   $cano = "/".$cpu[1]."/".array_pop($cpu); echo $cano;*/?>
                    <?php if (!empty($arResult['NABOR'])) { ?>
                      <form action="#" class="modification-product setting-product" onsubmit="return false;">
                        <p class="setting-title"><span>Элементы коллекции</span></p>
                        <p id="emptyNabor" style="display:none">
	                        Сейчас вы не выбрали не одного товара. Чтобы сделать заказ выберите товары в блоке «Товары коллекции»
	                        и нажмите кнопку «В корзину» или «Купить в один клик»
	                    </p>
                        <div id="soberi_sam" class="count-element">
                            <?php foreach ($arResult['NABOR'] as $nabor) { ?>
                                <div class="count-wrap"
                                    data-id="<?=$nabor['ID']?>"
                                    data-discount="<?=$nabor['PRICE']['DISCOUNT_PRICE']?>"
                                    data-price="<?=$nabor['PRICE']['BASE_PRICE']?>"
                                    <?php if ($nabor['QUANTITY'] <= 0) { ?> style="display:none"<?php } ?>
                                >
                                <div class="quantity active2">
                                  <input type="number" min="0" max="100" step="1" value="<?=$nabor['QUANTITY']?>">
                                </div>
                                <p class="title-element"><a href="<?=$nabor['DETAIL_PAGE_URL']?>" class="title-element"><?=$nabor['NAME']?></a></p>
                                <p class="price-element"><?=number_format($nabor['PRICE']['DISCOUNT_PRICE'] * $nabor['QUANTITY'], 0, ' ', ',')?> руб.</p>
                                <? /*?><a href="<?=$nabor['DETAIL_PAGE_URL']?>" class="desc-element">описание</a><?*/?>
                                <a href="#" class="del-element"><i class="fa fa-times" aria-hidden="true"></i></a>
                            </div>
                            <?php } ?>
                        </div>
                    </form>
                    <?php } else { ?>
                        <? if(count($arResult['OFFERS']) > 0) { ?>
                            <?php $curOffer = $arResult['OFFERS'][0]?>
                                <?php
                                $offerProps = array();
                                $offerPrices = array();
                                foreach ($arResult['OFFERS'] as $offer) {
                                    $offerPrices[$offer['ID']] = array(
                                        'PRICES' => $offer['PRICES'],
                                        'PROP' => array(),
                                    );
                                    foreach ($offer['DISPLAY_PROPERTIES'] as $prop) {
                                        if (!isset($offerProps[$prop['ID']])) {
                                            $offerProps[$prop['ID']] = array(
                                                'ID'   => $prop['ID'],
                                                'NAME' => $prop['NAME'],
                                                'CODE' => $prop['CODE'],
                                                'VALUES' => array(),
                                            );
                                        }
                                        $offerProps[$prop['ID']]['VALUES'][$prop['VALUE']] = $prop['DISPLAY_VALUE'];
                                        $offerPrices[$offer['ID']]['PROPS'][$prop['ID']] = trim($prop['DISPLAY_VALUE']);
                                    }
                                }
                                $arResult['OFFERS_EXT'] = $offerProps;
                                $arResult['OFFERS_PRICES'] = $offerPrices;

                                $arResult['PRICES'] = $arResult['OFFERS'][0]['PRICES'];
                                ?>
                            <form action="#" class="setting-product offer-property-change" onsubmit="return false;">
                                <script>window.catalogOffers = <?=json_encode($arResult['OFFERS_PRICES'])?>;</script>
<!--                                <p class="setting-title"><span>Настройки товара</span></p>-->
                                <?php foreach($arResult['OFFERS_EXT'] as $prop) { ?>
                                <label>
                                    <p><?=$prop['NAME']?>:</p>
                                    <select data-prop="<?=$prop['ID']?>">
                                        <?php foreach ($prop['VALUES'] as $k => $v) { ?>
                                            <?php $slct = ($v == $arResult['OFFERS_PRICES'][$curOffer['ID']]['PROPS'][$prop['ID']]) ? ' selected=""' : ''; ?>
                                        <option<?=$slct?>><?=$v?></option>
                                        <?php } ?>
                                    </select>
                                </label>
                                <?php } ?>

                            </form>
                        <? } else { ?>

                           <? if($arResult['TIMER']) { ?>
                             <div class="product__sale">
                                <span class="h3"><?=$arResult['TIMER']['NAME']?></span>
                                <?php if (!empty($arResult['TIMER']['ONE']['NOTES'])) { ?>
                                <h6><?=$arResult['TIMER']['ONE']['NOTES']?></h6>
                                <?php } ?>
                                <span id="clock" data-final="<?=$arResult['TIMER']['TIMER_DATA']?>"></span>
                             </div>
                            <? //=$arResult['TIMER']; ?>
                           <? } else { ?> 
                           <div class="product__sale">
                            <span class="h3">Нашли дешевле?</span>
                            <h6>пришлите нам ссылку и мы сделаем для Вас скидку!</h6>
                              <? $strEmail = Coption::GetOptionString('main','email_from'); ?>
                              <? $urls = "https://mebelny-dom.com".$arResult["DETAIL_PAGE_URL"];?>
                              <? $APPLICATION->IncludeComponent(
                                "altasib:feedback.form",
                                "lowcost",
                                Array(
                                    "ACTIVE_ELEMENT" => "Y",
                                    "ADD_EVENT_FILES" => "N",
                                    "ADD_HREF_LINK" => "Y",
                                    "ALX_LINK_POPUP" => "N",
                                    "BBC_MAIL" => "",
                                    "CAPTCHA_TYPE" => "default",
                                    "CATEGORY_SELECT_NAME" => "Выберите категорию",
                                    "CHANGE_CAPTCHA" => "N",
                                    "CHECKBOX_TYPE" => "CHECKBOX",
                                    "CHECK_ERROR" => "Y",
                                    "COLOR_OTHER" => "#009688",
                                    "COLOR_SCHEME" => "BRIGHT",
                                    "COLOR_THEME" => "",
                                    "EVENT_TYPE" => "ALX_FEEDBACK_FORM",
                                    "FB_TEXT_NAME" => "",
                                    "FB_TEXT_SOURCE" => "PREVIEW_TEXT",
                                    "FORM_ID" => "1",
                                    "IBLOCK_ID" => "53",
                                    "IBLOCK_TYPE" => "d2mg_orderscall",
                                    "INPUT_APPEARENCE" => array("DEFAULT"),
                                    "JQUERY_EN" => "N",
                                    "LINK_SEND_MORE_TEXT" => "Отправить ещё одно сообщение",
                                    "LOCAL_REDIRECT_ENABLE" => "N",
                                    "MASKED_INPUT_PHONE" => array(),
                                    "MESSAGE_OK" => "Ваше сообщение было успешно отправлено",
                                    "NAME_ELEMENT" => "ALX_DATE",
                                    "NOT_CAPTCHA_AUTH" => "Y",
                                    "PROPERTY_FIELDS" => array("STD", "PHONE", "TSMB"),
                                    "PROPERTY_FIELDS_REQUIRED" => array("STD", "PHONE"),
                                    "PROPS_AUTOCOMPLETE_EMAIL" => array(),
                                    "PROPS_AUTOCOMPLETE_NAME" => array(),
                                    "PROPS_AUTOCOMPLETE_PERSONAL_PHONE" => array(),
                                    "PROPS_AUTOCOMPLETE_VETO" => "N",
                                    "SECTION_FIELDS_ENABLE" => "N",
                                    "SECTION_MAIL_ALL" => $strEmail,
                                    "SEND_IMMEDIATE" => "Y",
                                    "SEND_MAIL" => "N",
                                    "SHOW_LINK_TO_SEND_MORE" => "Y",
                                    "SHOW_MESSAGE_LINK" => "Y",
                                    "USERMAIL_FROM" => "N",
                                    "USER_CONSENT" => "N",
                                    "USER_CONSENT_ID" => "0",
                                    "USER_CONSENT_INPUT_LABEL" => "",
                                    "USER_CONSENT_IS_CHECKED" => "Y",
                                    "USER_CONSENT_IS_LOADED" => "N",
                                    "USE_CAPTCHA" => "N",
                                    "WIDTH_FORM" => "50%",
									"LINK_TOV" => $urls,
                                )
                            );?>
                            </div>
                           <? } ?> 
                          <? } ?>
                    <? } ?> 


                    <div id="detailPrice" class="product__price" >
					    <? foreach($arResult["PRICES"] as $code=>$arPrice):?>
                            <? if($arPrice["CAN_ACCESS"]):?>
								<? if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
                                    <div class="old-price-wrap">
                                        <div class="old-price value">
                                            <?=$arPrice["PRINT_VALUE"]?>
                                        </div>
                                        <p class="price-btn"><?=$arPrice["PRINT_DISCOUNT_VALUE"]?></p>
                                    </div>
                                <? else:?>
                                    <div class="old-price-wrap">
                                        <div class="old-price value" style="display:none">
                                            <span></span>
                                        </div>
                                        <? $ndiscount = "1";?>
                                        <p class="price-btn"><?=$arPrice["PRINT_VALUE"]?></p>
                                    </div>    
                                <? endif;?>
                            <? endif;?>
                        <? endforeach;?>
                        <div id="detailProductBasketButtons" class="bascket-wrap <? if($ndiscount) { ?>nodiscount<? } ?>">
                            <button class="product__buscket detailProductInCart" data-basketcheck="<?=$arResult['ID']?>" data-ids="" data-counts="" onclick="add_to_cart(<?=$arResult['ID']?>, this)">Купить</button>
                            <button class="product__buscket detailProductOutCart" onclick="location.href='/personal/cart/')" style="display:none">В корзине</button>
                            <div class="article">
                               <? /*?>
                                <p>Артикул:</p>
                                <span><?=$arResult["PROPERTIES"]["ARTNUMBER"]["VALUE"]?></span>
                               <? */?> 
                               <button data-toggle="modal" data-name="<?=$arResult["NAME"]?>" data-id="<?=$arResult["ID"]?>" class="openpopup product__buscket detailProductOneClick">Купить в 1 клик</button>
                            </div>
                            <script data-skip-moving="true">
                        var id = '<?=$arElement['ID']?>';
                        if (in_array_basket(id)) {
                            document.getElementById('pib'+id).style.display = "";
                            document.getElementById('pnb'+id).style.display = "none";
                        }
                    </script>

                        </div>                        
                    </div>

                        
                    
                        
                    <div class="add-product">
                        <div class="add_favorites add">
                            <div class="img-wrap">
<!--                                <img src="--><?//=SITE_TEMPLATE_PATH?><!--/components/bitrix/catalog/visual/bitrix/catalog.element/visual/img/favor.png" alt="badge">-->
                            </div>
                            <p class="add__title"><a class="addFav" data-id="<?=$arResult["ID"];?>">Добавить в избранное</a>
                                <span>
<!--                                    Товаров (нет)-->
                                </span>
                            </p>
                        </div>
                        <?php $arResult['COMPARE_URL_TEMPLATE'] = str_replace('#ID#', $arResult['ID'], $arResult['COMPARE_URL_TEMPLATE']); ?>
                        <div class="add_comparison add">
                            <div class="img-wrap">
                                <img src="<?=SITE_TEMPLATE_PATH?>/components/bitrix/catalog/visual/bitrix/catalog.element/visual/img/comparison.png" alt="badge">
                            </div>
                            <p class="add__title">
	                            <a href="javascript:;<?php /*/<?=$arResult['COMPARE_URL_TEMPLATE']?>*/ ?>" data-compare="<?=$arResult['ID']?>" class="add__title">Добавить в сравнение</a>
                            	<a href="javascript:;" data-hide="erapmoc"><span>Товаров (нет)</span></a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="description">
                <div class="left-desc">
                    <div class="tabs">
                        <?if($arResult['DISPLAY_PROPERTIES']){?>
                            <label for="characteristics">
                                <span>Характеристики</span>
                            </label>
                            <div class="tabs-item__block">
                                <ul class="product-list" >
                                    <?foreach($arResult['DISPLAY_PROPERTIES'] as $code=>$prop){
                                        if (!is_string($prop['DISPLAY_VALUE'])) unset($arResult['DISPLAY_PROPERTIES'][$code]);
                                    }?>
                                    <?$count = count($arResult['DISPLAY_PROPERTIES']);?>
                                    <?php for (reset($arResult['DISPLAY_PROPERTIES']), $i = 0; $i <= $count / 2; $i++) { ?>
                                        <?php list(,$prop) = each($arResult['DISPLAY_PROPERTIES']); ?>
                                        <?php if ($prop['CODE'] == 'jjj') $prop['DISPLAY_VALUE'] = strip_tags($prop['DISPLAY_VALUE']); ?>
                                        <?php if (!is_string($prop['DISPLAY_VALUE'])) continue; ?>
                                        <li><span><?=$prop['NAME']?></span><span><?=$prop['DISPLAY_VALUE']?></span></li>
                                    <?php } ?>
                                    <?php for (; $i < count($arResult['DISPLAY_PROPERTIES']); $i++) { ?>
                                        <?php list(,$prop) = each($arResult['DISPLAY_PROPERTIES']); ?>
                                        <?php if ($prop['CODE'] == 'jjj') $prop['DISPLAY_VALUE'] = strip_tags($prop['DISPLAY_VALUE']); ?>
                                        <?php if (!is_string($prop['DISPLAY_VALUE'])) continue; ?>
                                        <li><span><?=$prop['NAME']?></span><span><?=$prop['DISPLAY_VALUE']?></span></li>
                                    <?php } ?>
                                </ul>
                            </div>
                        <?}?>
                        <?if($arResult['PROPERTIES']['visibleinset3']['VALUE']=='Y'):?>
                            <label for="coloring"><span>Цвета</span></label>
                            <div class="tabs-item__block">
                                <?foreach($arResult['PROPERTIES']['VARKRASH']['VALUE'] as $sectionID):?>
                                    <?$arSection=CIBlockSection::GetByID($sectionID)->GetNext();?>
                                    <div class="upholstery-wrap">
                                        <div class="upholstery-img">
                                            <?
                                            $arSelect=Array(
                                                'ID',
                                                'NAME',
                                                'DETAIL_PICTURE',
                                                'PREVIEW_PICTURE',
                                            );
                                            $arFilter=Array('IBLOCK_ID'=>20, 'SECTION_ID'=>$sectionID);
                                            $arOrder=Array('SORT'=>'ASC');
                                            $res=CIBlockElement::GetList($arOrder, $arFilter, false, false, $arSelect);
                                            while($arItem=$res->GetNext())
                                            {
                                                if($arItem['DETAIL_PICTURE']){
                                                    ?>
                                                    <a href="<?=CFile::GetPath($arItem['DETAIL_PICTURE'])?>" class="upholstery-img-link-img" data-lightbox="det-img" title="<?=$arItem['NAME']?>">
                                                        <img src="<?=CFile::GetPath($arItem['DETAIL_PICTURE'])?>">
                                                        <div class="upholstery-img-link-title"><?=$arItem['NAME']?></div>
                                                    </a>
                                                    <?
                                                }
                                            }
                                            ?>


                                        </div>
                                    </div>
                                <?endforeach?>
                            </div>
                        <?endif?>
                        <?if(!empty($arResult['PROPERTIES']['OBIVKA_TEXT']) && !empty($arResult['PROPERTIES']['OBIVKA_TEXT']['DISPLAY_VALUE'])) { ?>
                            <label for="upholstery"><span>Обивка</span></label>
                            <div class="tabs-item__block upholstery-upholstery">
                                <?=$arResult['PROPERTIES']['OBIVKA_TEXT']['DISPLAY_VALUE']?>
                            </div>
                        <?}?>
                        <?if($arResult["DETAIL_TEXT"]){?>
                            <label for="desc"><span>Описание</span></label>
                            <div class="tabs-item__block">
                                <div class="detail_text">
                                    <?=$arResult["DETAIL_TEXT"];?>
                                </div>
                            </div>
                        <?}?>








<?
$arSchemaImgs = array();
foreach($arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"] as $key => $PHOTO){
    $arSchemaImgs[] = 'https://mebelny-dom.com' . CFile::GetPath($PHOTO);
}
$brand_name = '';
foreach ($arResult["DISPLAY_PROPERTIES"]["Fabr"]["LINK_ELEMENT_VALUE"] as $key => $value){
    $brand_name = $value["NAME"];
}
$price = $arResult["PRICES"]["BASE"]["DISCOUNT_VALUE"];
$price = number_format($price, 2, '.', '');
$description = strip_tags($arResult["DETAIL_TEXT"]);
$description = str_replace('\n', '', $description);
$description = str_replace('\r', '', $description);
$description = str_replace('\t', '', $description);
$arSchema = array(
    "@context" => "https://schema.org/",
    "@type" => "Product",
    "name" => $arResult['NAME'],
    "image" => $arSchemaImgs,
    "description" => $description,
    "sku" => $arResult["ID"],
    "mpn" => $arResult["PROPERTIES"]["ARTNUMBER"]["VALUE"],
    "brand" => array(
        "@type" => "Brand",
        "name" => $brand_name
    ),
    "offers" => array(
        "@type" => "Offer",
        "url" => 'https://mebelny-dom.com' . $arResult["DETAIL_PAGE_URL"],
        "priceCurrency" => "RUB",
        "price" => $price,
        "itemCondition" => "https://schema.org/NewCondition",
        "availability" => "https://schema.org/InStock",
        "seller" => array(
             "@type" => "Organization",
            "name" => "Мебельный дом"
        )
    )
);
$jsonSchema = json_encode($arSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK );
?>

<script type="application/ld+json">
  <?=$jsonSchema?>
</script>