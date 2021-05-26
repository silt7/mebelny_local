<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
    $this->setFrameMode(true);
    $this->addExternalJs(SITE_TEMPLATE_PATH."/libs/slick.min.js");
    $this->addExternalCss($templateFolder."/css/styles.css");
    $this->addExternalCss($templateFolder."/css/template_styles.css");
    $this->addExternalCss($templateFolder."/css/style.css");
    $this->addExternalCss($templateFolder."/css/swiper-bundle.css");
    $this->addExternalCss($templateFolder."/css/critical.css");
    $this->addExternalCss($templateFolder."/css/front-style.css");
    $this->addExternalCss($templateFolder."/css/delivery.css");
    $this->addExternalCss($templateFolder."/css/product.css");
    $this->addExternalJs($templateFolder."/js/swiper-bundle.js");
    $this->addExternalJs($templateFolder."/js/product.js");
?>
<main class="products">
	<div class="container products-container">
		<!-- Основная информация о товаре (мобильная версия) -->
		<div class="products__info_top mobile">
			<div class="products__info_wrap">
				<!--noindex-->
				<div class="products__info_title"><?=$arResult["NAME"];?></div>
				<!--/noindex-->
				<div class="products__info_wrap products__rating mobile">
					<!-- Рейтинг (data-default-rating для вывода текущего рейтинга) -->
					<span
						class="rating"
						data-stars="5"
						data-default-rating="<?= $arResult['review_avg']?>"
						
					></span>
					<!-- Текстовый вывод рейтинга -->
					<span class="products__rating_rate"><?= $arResult['review_avg'] != 0 ? $arResult['review_avg'] : '';?></span>
				</div>

				<div class="products__info_text-wrapper">
					<span class="products__info_text articul"
						>Артикул:
						<span style="color: #4a5160; margin-top: 3px"
							><?=$arResult["PROPERTIES"]["ARTNUMBER"]["VALUE"]?></span
						></span
					>

					<div class="products__info_store">
					    <?if($arResult['CATALOG_QUANTITY'] > 0):?>
						<p class="products__info_text">
							В наличии <span class="green"><?= $arResult['CATALOG_QUANTITY'];?></span>
						</p>
						<?else:?>
							<?if (!empty($arResult['PROPERTIES']['POD_ZAKAZ']['VALUE'])):?>
    						    <p class="products__info_text">
    								Под заказ <span class="red"><?= $arResult['PROPERTIES']['POD_ZAKAZ']['VALUE']?> дн.</span>
    							</p>
    						<?else:?>
								<p class="products__info_text">
    						    	Нет в наличии
    						    </p>
    						<?endif?>
						<?endif?>
					</div>
				</div>
			</div>
		</div>

		<div class="products__item">
			<div class="products__sliders">
                  <div class="card-places">
                    <? if($arResult["SALE_PERCENT"]) { ?>
                    <? $index = 1; ?>
                    <div class="card-place card-sale">
                      <img loading="lazy" decoding="async" src="/images/icon-sale.svg" alt="sale">
                      <span class="top-<?=$index;?>">Скидка - <?=$arResult["SALE_PERCENT"]?>%</span>
                    </div>
                    <? } else { ?>  
                    <? $index = 0; ?>
                    <? } ?>
                    <? foreach($arResult["STICKERS"] as $key => $st) { $index += 1; ?> 
                        <?if( strpos($st, 'Новинка') !== false){?>
                        <div class="card-place card-new">
                          <img loading="lazy" decoding="async" src="/images/icon-new.svg" alt="new">
                          <span class="top-<?=$index;?>">Новинка</span>
                        </div>
                        <? } elseif(strpos($st, 'Хит') !== false ){ ?>
                        <div class="card-place card-hit">
                          <img loading="lazy" decoding="async" src="/images/icon-hit.svg" alt="promo">
                          <span class="top-<?=$index;?>">Хит</span>
                        </div>
                        <? } elseif(strpos($st, 'Акция') !== false ){ ?>
                        <div class="card-place card-promo">
                          <img loading="lazy" decoding="async" src="/images/icon-promo.svg" alt="promo">
                          <span class="top-<?=$index;?>">Акции</span>
                        </div>
                        <?}?>
                    <? } ?>
                  </div>
				<div class="products__sliders_thumbs">
					<div class="products__arrow products__thumbs_prev">
						<img src="<?= $templateFolder;?>/imgs/arrow-top.svg" alt="" />
					</div>
					<!-- Слайды для управления главной картинкой -->
					<div class="swiper-container products__thumbs">
						<div class="swiper-wrapper products__thumbs_wrapper">
        					<? foreach($arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"] as $key => $PHOTO) { ?>
        					    <?if($isFirst){$isFirst = false;continue;}?>
                                <? $file_wm = CFile::ResizeImageGet($PHOTO, array( "width" => 68, "height" => 48 ), BX_RESIZE_IMAGE_EXACT , false, false)?>
                                <div class="swiper-slide products__thumbs_slide">
                                    <img src="<?=$file_wm["src"]?>" alt="<?=$arResult["NAME"];?>. Фото <?=$key+1?>" title="<?=$arResult["NAME"];?>. Фото <?=$key+1?>">
                                </div>
                            <? } ?> 
                            <div id="count-slide" style="display: none"><?= count($arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"])?></div>
						</div>
					</div>
					<div class="products__arrow products__thumbs_next">
						<img src="<?= $templateFolder;?>/imgs/arrow-bottom.svg" alt="" />
					</div>
				</div>

				<!-- Главный слайдер -->
				<div class="products__sliders_main">
					<div class="swiper-container products__main">
						<div class="swiper-wrapper products__main_wrapper">
    						<? foreach($arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"] as $key => $PHOTO) { ?>
                                <? $file_wm = CFile::ResizeImageGet($PHOTO, array( "width" => 655, "height" => 480 ), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, false, false)?>
                                <div class="swiper-slide products__main_slide">
                                    <img src="<?=$file_wm["src"]?>" alt="<?=$arResult["NAME"];?>. Фото <?=$key+1?>" title="<?=$arResult["NAME"];?>. Фото <?=$key+1?>">
                                </div>
                            <? } ?>
						</div>
					</div>
				</div>
			</div>

			<!-- Основная информация о товаре (большие экраны) -->
			<div class="products__info">
				<div class="products__info_top desktop">
					<div class="products__info_wrap">
						<h1 class="products__info_title"><?=$arResult["NAME"];?></h1>
						<span class="products__info_text">Артикул: <?=$arResult["PROPERTIES"]["ARTNUMBER"]["VALUE"]?></span>

                        <?if($arResult['CATALOG_QUANTITY'] > 0):?>
						<div class="products__info_store">
							<p class="products__info_text">
                                В наличии <span class="green"><?= $arResult['CATALOG_QUANTITY'];?></span>
							</p>
						</div>
						<?else:?>
						<div class="products__info_store">
						    <?if (!empty($arResult['PROPERTIES']['POD_ZAKAZ']['VALUE'])):?>
    						    <p class="products__info_text">
    								Под заказ <span class="red"><?= $arResult['PROPERTIES']['POD_ZAKAZ']['VALUE']?> дн.</span>
    							</p>
    						<?else:?>
								<p class="products__info_text">
    						    	Нет в наличии
    						    </p>
    						<?endif?>
						</div>
						<?endif;?>
					</div>

					<div class="products__info_wrap products__rating">
						<!-- Рейтинг (data-default-rating для вывода текущего рейтинга) -->
						<span
							class="rating"
							data-stars="5"
							data-default-rating="<?= $arResult['review_avg']?>"
							
						></span>
						<span class="products__rating_rate"><?= $arResult['review_avg'] != 0 ? $arResult['review_avg'] : '';?></span>
					</div>
				</div>

                <? $productID = $arResult["ID"];?>
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
                                <span class="del-element"><i class="fa fa-times" aria-hidden="true"></i></span>
                            </div>
                            <?php } ?>
                        </div>
                    </form>
                <?} else {?>
                <div class="products__findcheap">
					<h4 class="products__findcheap_title">Нашли дешевле?</h4>
					<p class="products__info_text">
						пришлите нам ссылку и мы сделаем для Вас скидку!
					</p>

					<!-- Форма для отправки товара дешевле -->
                   <div id="lowcost-form"></div>
				</div>
				<?}?>
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
                        $productID = $offer['ID'];
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
                <? } ?> 
            <? $prop = json_encode($arResult['OFFERS_EXT']); //print_r($arResult['OFFERS_EXT'])?>
				<!-- Кнопки для покупки / ценник -->
				<?if($arResult['CATALOG_QUANTITY'] > 0 || !empty($arResult['PROPERTIES']['POD_ZAKAZ']['VALUE'])):?>
				    <? foreach($arResult["PRICES"] as $code=>$arPrice):?>
                        <? if($arPrice["CAN_ACCESS"]):?>
							<? if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
							    <?$arResult['PRICE'] = $arPrice["PRINT_DISCOUNT_VALUE"]?>
 								<?$arResult['PRICE_DIS'] = $arPrice["PRINT_VALUE_VAT"]?>
                            <? else:?>
                                <? $ndiscount = "1";?>
                                <? $arResult['PRICE'] = $arPrice["PRINT_VALUE"]?>
								<? $arResult['PRICE_DIS'] = $arPrice["PRINT_VALUE_VAT"]?>
                            <? endif;?>
                        <? endif;?>
                    <? endforeach;?>
			    <div id="detailPrice" class="products__btns <?if ($arResult['PRICE_DIS']  > $arResult['PRICE']) echo "price_discount";?>" >
					<?if ($arResult['PRICE_DIS']  > $arResult['PRICE']):?>
					<span class="products__btns_price_old"><?=$arPrice['PRINT_VALUE_VAT']?></span>
					<?endif;?>
					<span class="products__btns_price"><?=$arResult['PRICE']?></span>
					<button class="products__btns_oneclick" onclick="openRecallPopup(click1 = 'Y')">Купить в 1 клик</button>
					<? if (!empty($arResult['NABOR'])):?>
                        <button class="products__btns_cart" onclick="add_basket_nabor()">В корзину</button>
                    <? else: ?>
                        <button class="products__btns_cart" onclick="add_basket(<?= $productID;?>)">В корзину</button>
                    <? endif ?>
                </div>
                <?else:?>
            		<div class="products__btns">
						<button class="products__btns_oneclick" onclick="openRecallPopup2()">
							Сообщить о поступлении
						</button>
					</div>
                <?endif;?>
				<div class="products__add">
					<!-- Добавить в корзину (добавляется класс active к блоку с ID, 
							при загрузке страницы также проверяется на active) -->
					<div id="addToCart" class="products__add_cart" onclick="add_favorite(<?= $arResult["ID"];?>)" data-id="<?= $arResult['ID']?>">
						<img
							src="<?= $templateFolder;?>/imgs/heart.svg"
							width="24"
							height="24"
							alt=""
						/>
						<div class="products__add_block">
							<span class="products__add_cart-btn">
							    Добавить в избранное
							</span>
							<span class="products__add_cart-text"></span>
						</div>
					</div>
					<!-- Добавить в сравнение (добавляется класс active к блоку с ID, 
							при загрузке страницы также проверяется на active) -->
					<div id="addToCompare" class="addToCompare products__add_compare <?= $arResult["COMPARE"]?>" onclick="compare_tov(<?= $arResult["ID"];?>, this)" data-id="<?= $arResult['ID']?>">
						<img
							src="<?= $templateFolder;?>/imgs/weight.svg"
							width="24"
							height="24"
							alt=""
						/>
						<div class="products__add_block">
							<span class="products__add_cart-btn add__title">Добавить в сравнение</span>
							
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Табы (data-tab кнопки должен соответствовать ID контента) -->
		<div class="products__tabs">
			<div class="products__tabs_inner">
				<div class="products__selector_wrapper">
					<div class="products__selector">
					    <?if($arResult['DISPLAY_PROPERTIES']){?>
                        <div data-tab="chars" class="products__selector_item active">
							<img
								src="<?= $templateFolder;?>/imgs/chars.svg"
								width="24"
								height="24"
								alt=""
							/>
							<span>Характеристики</span>
						</div>
                        <?}?>
                        <?if($arResult['PROPERTIES']['visibleinset3']['VALUE']=='Y'):?>
                        <div data-tab="colors" class="products__selector_item">
							<img
								src="<?= $templateFolder;?>/imgs/colors.svg"
								width="24"
								height="24"
								alt=""
							/>
							<span>Цвета</span>
						</div>
                        <?endif?>
                        <?if(!empty($arResult['PROPERTIES']['OBIVKA_TEXT']) && !empty($arResult['PROPERTIES']['OBIVKA_TEXT']['DISPLAY_VALUE'])) { ?>
                        <div data-tab="obivka" class="products__selector_item">
							<img
								src="<?= $templateFolder;?>/imgs/material.svg"
								width="24"
								height="24"
								alt=""
							/>
							<span>Обивка</span>
						</div>
                        <?}?>
                        <?if($arResult["DETAIL_TEXT"]){?>
                        <div data-tab="desc" class="products__selector_item">
							<img
								src="<?= $templateFolder;?>/imgs/docs.svg"
								width="24"
								height="24"
								alt=""
							/>
							<span>Описание</span>
						</div>
                        <?}?>
                        <div data-tab="feedback" class="products__selector_item">
							<img
								src="<?= $templateFolder;?>/imgs/feedback.svg"
								width="24"
								height="24"
								alt=""
							/>
							<span>Отзывы <?= count($arResult["reviews"]) != 0 ? '('.count($arResult["reviews"]).')' : '';?></span>
						</div>
                        <div data-tab="delivery" class="products__selector_item">
							<img
								src="<?= $templateFolder;?>/imgs/delivery.svg"
								width="24"
								height="24"
								alt=""
							/>
							<span>Доставка</span>
						</div>
                        <?if($arResult["PROPERTIES"]["TOVARS_IN_NABOR_REKOMEND"]["VALUE"][0]){?>
                        <div data-tab="collection" class="products__selector_item">
							<img
								src="<?= $templateFolder;?>/imgs/collection.svg"
								width="24"
								height="24"
								alt=""
							/>
							<span>Вся коллекция</span>
						</div>
                        <?}?>
					</div>
				</div>

				<div class="products__content">
					<!-- Вкладка: Характеристики -->
					<div id="chars" class="products__content_item active">
						<table class="products__table">
							<tbody>
							    <?foreach($arResult['DISPLAY_PROPERTIES'] as $code=>$prop){
                                    if (!is_string($prop['DISPLAY_VALUE'])) unset($arResult['DISPLAY_PROPERTIES'][$code]);
                                }?>
                                <?$count = count($arResult['DISPLAY_PROPERTIES']);?>
                                <?php for (reset($arResult['DISPLAY_PROPERTIES']), $i = 0; $i <= $count / 2; $i++) { ?>
                                    <?php list(,$prop) = each($arResult['DISPLAY_PROPERTIES']); ?>
                                    <?php if ($prop['CODE'] == 'jjj') $prop['DISPLAY_VALUE'] = strip_tags($prop['DISPLAY_VALUE']); ?>
                                    <?php if (!is_string($prop['DISPLAY_VALUE'])) continue; ?>
                                    <tr><td><?=$prop['NAME']?></td><td><?=$prop['DISPLAY_VALUE']?></td></tr>
                                <?php } ?>
                                <?php for (; $i < count($arResult['DISPLAY_PROPERTIES']); $i++) { ?>
                                    <?php list(,$prop) = each($arResult['DISPLAY_PROPERTIES']); ?>
                                    <?php if ($prop['CODE'] == 'jjj') $prop['DISPLAY_VALUE'] = strip_tags($prop['DISPLAY_VALUE']); ?>
                                    <?php if (!is_string($prop['DISPLAY_VALUE'])) continue; ?>
                                    <tr><td><?=$prop['NAME']?></td><td><?=$prop['DISPLAY_VALUE']?></td></tr>
                                <?php } ?>
							</tbody>
						</table>
					</div>

					<!-- Вкладка: Цвета -->
					<div id="colors" class="products__content_item">
					     <?if($arResult['PROPERTIES']['visibleinset3']['VALUE']=='Y'){?>
                            <?foreach($arResult['PROPERTIES']['VARKRASH']['VALUE'] as $sectionID):?>
                                <?$arSection=CIBlockSection::GetByID($sectionID)->GetNext();?>
                                <div class="products__color_inner">
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
                                                <a class="products__color_item" style="text-decoration:none" href="<?=CFile::GetPath($arItem['DETAIL_PICTURE'])?>" data-lightbox="det-img">
                                                    <img src="<?=CFile::GetPath($arItem['DETAIL_PICTURE'])?>" alt="<?=$arItem['NAME']?>" />
                    								<span><?=$arItem['NAME']?></span>
                    							</a>
                                                <?
                                            }
                                        }
                                        ?>
                                </div>       
                            <?endforeach?>
                        <?}?>
					</div>
					<!-- Вкладка: Обивка -->
					<?if(!empty($arResult['PROPERTIES']['OBIVKA_TEXT']) && !empty($arResult['PROPERTIES']['OBIVKA_TEXT']['DISPLAY_VALUE'])) { ?>
                        <div id="obivka" class="products__content_item">
    						<div class="products__obivka_inner">
    							<div class="products__obivka_item">
    							     <?=$arResult['PROPERTIES']['OBIVKA_TEXT']['DISPLAY_VALUE']?>
    							</div>
    						</div>
    					</div>
                    <?}?>
					<!-- Вкладка: Описание -->
					<div id="desc" class="products__content_item">
						<div class="products__description">
							<?=$arResult["DETAIL_TEXT"];?>
						</div>
					</div>

					<!-- Вкладка: Отзывы -->
					<div id="feedback" class="products__content_item">
						<div class="products__feedback_inner">
							<div class="products__feedback_general">
								<span>Общий рейтинг</span>
								<div class="products__info_wrap products__rating">
									<!-- Рейтинг (data-default-rating для вывода текущего рейтинга) -->
									<span
										class="rating"
										data-stars="5"
										data-default-rating="<?= $arResult["review_avg"];?>"
										
									></span>
									<!-- Текстовый вывод рейтинга -->
									<span class="products__rating_rate"><?= $arResult["review_avg"];?></span>
								</div>
								<span class="products__feedback_reviews-count">Количество отзывов: <?= count($arResult["reviews"]);?></span>

								<button class="products__feedback_btn" onclick="openSendReview()">
									Оставить отзыв
								</button>
  
							</div>

							<div id="review-block"></div>
						</div>
					</div>

					<!-- Вкладка: Доставка -->
					<?
					$dbEl = CIBlockElement::GetList(array(), array('ID' => $ElementID, "IBLOCK_ID"=>2), false, false, array("ID", "IBLOCK_ID"));
					if ($obEl = $dbEl->GetNextElement())
					{
						$arProps = $obEl->GetProperties();
					}
					if($arProps["DELIVERY_MOSCOW"]["VALUE"]){
						$deliveryMoscow = $arProps["DELIVERY_MOSCOW"]["VALUE"];
					}else{
						$deliveryMoscow = $arProps["DELIVERY_MOSCOW"]["DEFAULT_VALUE"];
					}
					if($arProps["DELIVERY_MO"]["VALUE"]){
						$deliveryMO = $arProps["DELIVERY_MO"]["VALUE"];
					}else{
						$deliveryMO = $arProps["DELIVERY_MO"]["DEFAULT_VALUE"];
					}
					if($arProps["DELIVERY_RUSSIA"]["VALUE"]){
						$deliveryRussia = $arProps["DELIVERY_RUSSIA"]["VALUE"];
					}else{
						$deliveryRussia = $arProps["DELIVERY_RUSSIA"]["DEFAULT_VALUE"];
					}
					if($arProps["LIFT_FIRTS_STR"]["VALUE"]){
						$liftFirst = $arProps["LIFT_FIRTS_STR"]["VALUE"];
					}else{
						$liftFirst = $arProps["LIFT_FIRTS_STR"]["DEFAULT_VALUE"];
					}
					if($arProps["LIFT_SECOND_STR"]["VALUE"]){
						$liftSecond = $arProps["LIFT_SECOND_STR"]["VALUE"];
					}else{
						$liftSecond = $arProps["LIFT_SECOND_STR"]["DEFAULT_VALUE"];
					}
					if($arProps["ASSEMBLY_FIRTS_STR"]["VALUE"]){
						$assemblyFirst = $arProps["ASSEMBLY_FIRTS_STR"]["VALUE"];
					}else{
						$assemblyFirst = $arProps["ASSEMBLY_FIRTS_STR"]["DEFAULT_VALUE"];
					}
					if($arProps["ASSEMBLY_SECOND_STR"]["VALUE"]){
						$assemblySecond = $arProps["ASSEMBLY_SECOND_STR"]["VALUE"];
					}else{
						$assemblySecond = $arProps["ASSEMBLY_SECOND_STR"]["DEFAULT_VALUE"];
					}
					?>
					<div id="delivery" class="products__content_item">
						<div class="products__delivery_inner">
							<!--<div class="products__delivery_btn">
								<button class="products__feedback_btn">Поделиться</button>
							</div>-->

							<div class="products__delivery_cards">
								<div class="products__delivery_card">
									<img src="<?= $templateFolder;?>/imgs/Bdelivery.svg" alt="" />
									<span class="products__delivery_text-title"
										>Доставка по Москве</span
									>
									<span class="products__delivery_text-subtitle"
										><?=$deliveryMoscow?></span
									>

									<span class="products__delivery_text-title"
										>Доставка по МО</span
									>
									<span class="products__delivery_text-subtitle"
										><?=$deliveryMO?></span
									>

									<span class="products__delivery_text-title"
										>Доставка по России</span
									>
									<span class="products__delivery_text-subtitle"
										><?=$deliveryRussia?></span
									>
								</div>

								<div class="products__delivery_card">
									<img src="<?= $templateFolder;?>/imgs/Bupload.svg" alt="" />
									<span class="products__delivery_text-title"
										>Подъем мебели</span
									>
									<span class="products__delivery_text-subtitle"
										><?=$liftFirst?></span
									>
									<span class="products__delivery_text-subtitle"
										><?=$liftSecond?></span
									>
								</div>

								<div class="products__delivery_card">
									<img src="<?= $templateFolder;?>/imgs/Brules.svg" alt="" />
									<span class="products__delivery_text-title"
										>Сборка мебели</span
									>
									<span class="products__delivery_text-subtitle"
										><?=$assemblyFirst?></span
									>
									<span class="products__delivery_text-subtitle"
										><?=$assemblySecond?></span
									>
								</div>

								<div class="products__delivery_card">
									<img src="<?= $templateFolder;?>/imgs/Bcard.svg" alt="" />
									<span class="products__delivery_text-title"
										>Наличными курьеру</span
									>
									<span class="products__delivery_text-title"
										>Банковскими картами</span
									>
									<span class="products__delivery_text-title"
										>Безналичным платежом</span
									>
								</div>

								<div class="products__delivery_card">
									<img src="<?= $templateFolder;?>/imgs/Bsticker.svg" alt="" />
									<span class="products__delivery_text-title"
										>Сертификаты качества</span
									>
									<span class="products__delivery_text-title"
										>Гарантия замены и возврата</span
									>
								</div>
							</div>
						</div>
					</div>

					<!-- Вкладка: Коллекция -->
					<div id="collection" class="products__content_item">
						<div class="products__collection_inner">
							<div class="swiper-button-prev"></div>
							<div class="swiper-container products__collection">
								<div class="swiper-wrapper products__collection_wrapper">
									<!-- слайд -->
									<?foreach($arResult['NABOR'] as $element):?>
									<div class="swiper-slide products__collection_slide">
									    <?$file_wm = CFile::ResizeImageGet($element['PREVIEW_PICTURE'], array( "width" => 655, "height" => 480 ), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, false, false)?>
										<a href="" class="products__collection_img">
											<img src="<?= $file_wm["src"]?>" alt="" />
										</a>

										<div class="products__collection_slide-content">
											<div class="products__collection_info">
												<a href=""><?= $element['NAME']?></a>
												<div class="products__collection_btns">
												    <? $compare = array_key_exists($element['ID'] , $_SESSION["CATALOG_COMPARE_LIST"][$arResult['IBLOCK_ID']]["ITEMS"] )?'active':'';?>
												    <div class="addToCompare products__add_compare <?= $compare?>"
												         onclick="compare_tov(<?= $element['ID']?>, this); 
												                 (this.classList.contains('active')) ? this.classList.remove('active') : this.classList.add('active')" 
												         style="align-items: start;">
													<img
														title="Добавить в сравнение"
														src="<?= $templateFolder;?>/imgs/weight.svg"
														width="16"
														height="16"
														alt=""
													/>
													</div>
													<div class="products__add_cart" 
													     onclick="add_favorite(<?= $element['ID']?>); 
													             (this.classList.contains('active')) ? this.classList.remove('active') : this.classList.add('active')" 
													     style="align-items: start;"
													     data-id="<?= $element['ID']?>">
													<img
														title="Добавить в избранное"
														src="<?= $templateFolder;?>/imgs/heart.svg"
														width="16"
														height="16"
														alt=""
													/>
													</div>
												</div>
											</div>

											<div class="products__collection_price">
												<span class="products__currPrice"><?= number_format($element['PRICE']['DISCOUNT_PRICE'], 0, ',', ' ')?> руб.</span>
											</div>

                                            <?if ($element['QUANTITY'] > 0):?> 
                                                <button class="products__feedback_btn products__collection_add outnabor" data-id="<?= $element['ID']?>">Товар в наборе</button>
											<?else:?>
											    <button class="products__feedback_btn products__collection_add innabor" data-id="<?= $element['ID']?>" data-price="<?= $element['PRICE']['DISCOUNT_PRICE']?>">Добавить в набор</button>
											<?endif?>
										</div>
									</div>
                                    <?endforeach;?>
								</div>
							</div>
							<div class="swiper-button-next"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>

<?$images = $arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"]; ?>
<?  $file_wm = CFile::ResizeImageGet(array_shift($images), array( "width" => 160, "height" => 120 ), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, false, false) ?>
<div id="bx_by_product" style="display:none;" class="bx_by_product">
    <div class="modal-busket__container">			
        <div class="modal-busket__title">Товар добавлен в корзину</div>
        <? if (!empty($arResult['NABOR'])):?>
            <?foreach ($arResult['NABOR'] as $nabor): ?>
                <?$active = ($nabor['QUANTITY'] > 0) ? '': 'style="display:none"'?>
                <div class="modal-busket__content" data-id="<?=$nabor['ID']?>" <?= $active?>>
                    <div class="modal-busket__content-left">
                    <div class="modal-busket__img-container">
                        <?$file_wm = CFile::ResizeImageGet($nabor['PREVIEW_PICTURE'], array( "width" => 160, "height" => 120 ), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, false, false)?>

						<img src="<?= empty($file_wm["src"]) ? '/upload/iblock/c3f/obedennaya_gruppa_stol_vizavi_i_2_kh_stulev_klassika_orekh_temnyy.jpg' : $file_wm["src"]?>" style="width:100%" alt="Товар добавлен в корзину">
                    </div>
                    </div>
                    <div class="modal-busket__content-right">
                        <div class="modal-busket__price" data-id="<?=$nabor['ID']?>"></div>
                        <div class="modal-busket__count" data-id="<?=$nabor['ID']?>">Кол-во: 1</div>
                        <div class="modal-busket__subinfo"><?=$nabor['NAME']?></div>
                    </div>
                </div>
            <? endforeach ?>
        <? else: ?>
        	<div class="modal-busket__content">
            <div class="modal-busket__content-left">
                <div class="modal-busket__img-container">
                    <img src="<?= $file_wm["src"]?>" alt="">
                </div>
            </div>
            <div class="modal-busket__content-right">
                <div class="modal-busket__price"><?= $arResult['PRICE']?></div>
                <div class="modal-busket__count">Кол-во: 1</div>
                <div class="modal-busket__subinfo"><?= $arResult["NAME"]?></div>
            </div>
            </div>
        <? endif ?>
        <div class="modal-busket__bottom">
            <a href="#" class="modal-busket__return-btn" onClick="$('.popup-window-overlay, .popup-window').hide()">Продолжить покупки</a>
            <a href="/personal/cart/" class="modal-busket__сheckout-btn btn-def">Оформить заказ</a>
        </div>
    </div>
</div>
<?
$arSchemaImgs = array();
foreach($arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"] as $key => $PHOTO){
    $arSchemaImgs[] = 'https://mebelny-dom.com' . CFile::GetPath($PHOTO);
}
$brand_name = '';
foreach ($arResult["DISPLAY_PROPERTIES"]["Fabr"]["LINK_ELEMENT_VALUE"] as $key => $value){
    $brand_name = $value["NAME"];
}
$reviewsSchema = [];
foreach($arResult["reviews"] as $review){
    $arr['@type'] = "Review";
    $arr['author'] = $review['AUTHOR_NAME'];
    $arr['description'] = $review['TEXT'];
    $arr['reviewRating'] = [
        "@type" => "Rating",
        "bestRating" => "5",
        "ratingValue" => $review['GRADE']
    ];

	if($review['DATE'] != ''){
		$arr['datePublished'] = $review['DATE']->format("Y-m-d");
	}
    array_push($reviewsSchema, $arr);
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
        "priceValidUntil" => date("Y-m-d", mktime(0, 0, 0, date('m'), date('d') + 14, date('Y'))),
        "itemCondition" => "https://schema.org/NewCondition",
        "availability" => "https://schema.org/InStock",
        "seller" => array(
             "@type" => "Organization",
            "name" => "Мебельный дом"
        )
    )
);
if(count($arResult["reviews"]) > 0){
    $arSchema["aggregateRating"] = array(
                          "@type" => "AggregateRating",
                          "worstRating" => "0",
                          "bestRating" => "5",
                          "ratingValue"=> $arResult['review_avg'],
                          "reviewCount" => count($arResult["reviews"])
                        );
     $arSchema["review"] = $reviewsSchema;
}

$jsonSchema = json_encode($arSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK );
?>

<script type="application/ld+json">
  <?=$jsonSchema?>
</script>

<? if($_GET['formresult'] == 'addok'):?>
<script>openRecallPopup2();</script>
<?endif?>
<? if($_GET['new_review_added'] == 'Y'):?>
<script>openSendReview();</script>
<?endif?>