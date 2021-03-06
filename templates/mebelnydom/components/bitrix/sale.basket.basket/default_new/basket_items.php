<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @var array $arUrls */
/** @var array $arHeaders */
use Bitrix\Sale\DiscountCouponsManager;

if (!empty($arResult["ERROR_MESSAGE"]))
	ShowError($arResult["ERROR_MESSAGE"]);

$bDelayColumn  = false;
$bDeleteColumn = false;
$bWeightColumn = false;
$bPropsColumn  = false;
$bPriceType    = false;

if ($normalCount > 0):
?>
<div id="basket_items_list">
	<div class="bx_ordercart_order_table_container">
		<table id="basket_items">
			<thead class="hidden-lg hidden-md">
				<tr>
					<td class="margin"></td>
					<?
					foreach ($arResult["GRID"]["HEADERS"] as $id => $arHeader):
						//
						if($arHeader['id'] == 'PROPERTY_POD_ZAKAZ_VALUE' or $arHeader['id'] == 'PROPERTY_NAL_VALUE' or $arHeader['id'] == 'PROPERTY_ARTNUMBER_VALUE'){
							continue;
						}
						//
						$arHeaders[] = $arHeader["id"];

						// remember which values should be shown not in the separate columns, but inside other columns
						if (in_array($arHeader["id"], array("TYPE")))
						{
							$bPriceType = true;
							continue;
						}
						elseif ($arHeader["id"] == "PROPS")
						{
							$bPropsColumn = true;
							continue;
						}
						elseif ($arHeader["id"] == "DELAY")
						{
							$bDelayColumn = true;
							continue;
						}
						elseif ($arHeader["id"] == "DELETE")
						{
							$bDeleteColumn = true;
							continue;
						}
						elseif ($arHeader["id"] == "WEIGHT")
						{
							$bWeightColumn = true;
						}
						elseif ($arHeader["id"] == "PREVIEW_PICTURE")
						{
							continue;
						}

						if ($arHeader["id"] == "NAME"):
						?>
							<td class="item" colspan="4" id="col_<?=$arHeader["id"];?>">
						<?
						elseif ($arHeader["id"] == "PRICE"):
						?>
							<td class="price" id="col_<?=$arHeader["id"];?>">
						<?
						else:
						?>
							<td class="custom" id="col_<?=$arHeader["id"];?>">
						<?
						endif;
						?>
							<?=$arHeader["name"]; ?>
							</td>
					<?
					endforeach;

					if ($bDeleteColumn || $bDelayColumn):
					?>
						<td class="custom"></td>
					<?
					endif;
					?>
						<td class="margin"></td>
				</tr>
			</thead>
			<tbody>
				<?
				$skipHeaders = array('PROPS', 'DELAY', 'DELETE', 'TYPE');

				foreach ($arResult["GRID"]["ROWS"] as $k => $arItem):

					if ($arItem["DELAY"] == "N" && $arItem["CAN_BUY"] == "Y")

					if ($arItem["DELAY"] == "N" && $arItem["CAN_BUY"] == "Y"):
					?>
					<tr id="<?=$arItem["ID"]?>"
						 data-item-name="<?=$arItem["NAME"]?>"
						 data-item-brand="<?=$arItem[$arParams['BRAND_PROPERTY']."_VALUE"]?>"
						 data-item-price="<?=$arItem["PRICE"]?>"
						 data-item-currency="<?=$arItem["CURRENCY"]?>"
					>
						<td class="margin"></td>
						<?
						foreach ($arResult["GRID"]["HEADERS"] as $id => $arHeader):
							//
							if($arHeader['id'] == 'PROPERTY_POD_ZAKAZ_VALUE' or $arHeader['id'] == 'PROPERTY_NAL_VALUE' or $arHeader['id'] == 'PROPERTY_ARTNUMBER_VALUE' or $arHeader['id'] == 'DISCOUNT' or $arHeader['id'] == 'QUANTITY'){
								continue;
							}
							//
							if (in_array($arHeader["id"], $skipHeaders)) // some values are not shown in the columns in this template
								continue;
							if ($arHeader["id"] == "PREVIEW_PICTURE") // some values are not shown in the columns in this template
								continue;

							if ($arHeader["name"] == '')
								$arHeader["name"] = GetMessage("SALE_".$arHeader["id"]);

							if ($arHeader["id"] == "NAME"):
							?>
								<td class="itemphoto">
									<div class="bx_ordercart_photo_container">
										<?
										if (strlen($arItem["PREVIEW_PICTURE_SRC_ORIGINAL"]) > 0):
											$url = $arItem["PREVIEW_PICTURE_SRC_ORIGINAL"];
										elseif (strlen($arItem["DETAIL_PICTURE_SRC_ORIGINAL"]) > 0):
											$url = $arItem["DETAIL_PICTURE_SRC_ORIGINAL"];
										else:
											$url = $templateFolder."/images/no_photo.png";
										endif;

										if (strlen($arItem["DETAIL_PAGE_URL"]) > 0):?><a href="<?=$arItem["DETAIL_PAGE_URL"] ?>"><?endif;?>
											<div class="bx_ordercart_photo" style="background-image:url('<?=$url?>')"></div>
										<?if (strlen($arItem["DETAIL_PAGE_URL"]) > 0):?></a><?endif;?>
									</div>
									<?
									if (!empty($arItem["BRAND"])):
									?>
									<div class="bx_ordercart_brand">
										<img alt="" src="<?=$arItem["BRAND"]?>" />
									</div>
									<?
									endif;
									?>
								</td>
								<td class="item td-name">
									<div class="__obozn hidden-xs hidden-sm"><?=$arHeader["name"]; ?></div>

									<h2 class="bx_ordercart_itemtitle">
										<?if (strlen($arItem["DETAIL_PAGE_URL"]) > 0):?><a href="<?=$arItem["DETAIL_PAGE_URL"] ?>"><?endif;?>
											<?=$arItem["NAME"]?>
										<?if (strlen($arItem["DETAIL_PAGE_URL"]) > 0):?></a><?endif;?>
									</h2>
									<? if(!empty($arItem['PROPERTY_ARTNUMBER_VALUE'])): ?>
										<div class="text-ser text-uppercase">
											<span>??????????????: <?= $arItem['PROPERTY_ARTNUMBER_VALUE'] ?></span>
										</div>
									<? endif ?>
									<div>
		                                <? if(isset($arItem['AVAILABLE_QUANTITY']) and !empty($arItem['AVAILABLE_QUANTITY']) and $arItem['AVAILABLE_QUANTITY'] > 0): ?>
	                                    <div class="text-ser">?? ?????????????? <span class="product-count-blue"><?= $arItem['AVAILABLE_QUANTITY'] ?></span></div>
                                		<? endif ?>
                                		<? if(!empty($arItem['PROPERTY_POD_ZAKAZ_VALUE'])): ?>
										<div class="text-ser">?????? ?????????? <span class="product-count-brown"><?= $arItem['PROPERTY_POD_ZAKAZ_VALUE'] ?> ????????</span></div>
										<? endif ?>
									</div>
									<div class="bx_ordercart_itemart">
										<?
										if ($bPropsColumn):
											foreach ($arItem["PROPS"] as $val):

												if (is_array($arItem["SKU_DATA"]))
												{
													$bSkip = false;
													foreach ($arItem["SKU_DATA"] as $propId => $arProp)
													{
														if ($arProp["CODE"] == $val["CODE"])
														{
															$bSkip = true;
															break;
														}
													}
													if ($bSkip)
														continue;
												}

												echo htmlspecialcharsbx($val["NAME"]).":&nbsp;<span>".$val["VALUE"]."</span><br/>";
											endforeach;
										endif;
										?>
									</div>
									<?
									if (is_array($arItem["SKU_DATA"]) && !empty($arItem["SKU_DATA"])):
										$propsMap = array();
										foreach ($arItem["PROPS"] as $propValue)
										{
											if (empty($propValue) || !is_array($propValue))
												continue;
											$propsMap[$propValue['CODE']] = (isset($propValue['~VALUE']) ? $propValue['~VALUE'] : $propValue['VALUE']);
										}
										unset($propValue);

										foreach ($arItem["SKU_DATA"] as $propId => $arProp):
											$selectedIndex = 0;
											// if property contains images or values
											$isImgProperty = false;
											if (!empty($arProp["VALUES"]) && is_array($arProp["VALUES"]))
											{
												$counter = 0;
												foreach ($arProp["VALUES"] as $id => $arVal)
												{
													$counter++;
													if (isset($propsMap[$arProp['CODE']]))
													{
														if ($propsMap[$arProp['CODE']] == $arVal['NAME'] || $propsMap[$arProp['CODE']] == $arVal['XML_ID'])
															$selectedIndex = $counter;
													}
													if (!empty($arVal["PICT"]) && is_array($arVal["PICT"])
														&& !empty($arVal["PICT"]['SRC']))
													{
														$isImgProperty = true;
													}
												}
												unset($counter);
											}
											$countValues = count($arProp["VALUES"]);
											$full = ($countValues > 5) ? "full" : "";

											$marginLeft = 0;
											if ($countValues > 5 && $selectedIndex > 5)
												$marginLeft = ((5 - $selectedIndex)*20).'%';

											if ($isImgProperty): // iblock element relation property
											?>
												<div class="bx_item_detail_scu_small_noadaptive <?=$full?>">
													<span class="bx_item_section_name_gray">
														<?=htmlspecialcharsbx($arProp["NAME"])?>:
													</span>
													<div class="bx_scu_scroller_container">

														<div class="bx_scu">
															<ul id="prop_<?=$arProp["CODE"]?>_<?=$arItem["ID"]?>"
																style="width: 200%; margin-left: <?=$marginLeft; ?>"
																class="sku_prop_list"
																>
																<?
																$counter = 0;
																foreach ($arProp["VALUES"] as $valueId => $arSkuValue):
																	$counter++;
																	$selected = ($selectedIndex == $counter ? ' bx_active' : '');
																?>
																	<li style="width:10%;"
																		class="sku_prop<?=$selected?>"
																		data-sku-selector="Y"
																		data-value-id="<?=$arSkuValue["XML_ID"]?>"
																		data-sku-name="<?=htmlspecialcharsbx($arSkuValue["NAME"]); ?>"
																		data-element="<?=$arItem["ID"]?>"
																		data-property="<?=$arProp["CODE"]?>"
																	>
																		<a href="javascript:void(0)" class="cnt"><span class="cnt_item" style="background-image:url(<?=$arSkuValue["PICT"]["SRC"];?>)"></span></a>
																	</li>
																<?
																endforeach;
																unset($counter);
																?>
															</ul>
														</div>

														<div class="bx_slide_left" onclick="leftScroll('<?=$arProp["CODE"]?>', <?=$arItem["ID"]?>, <?=$countValues?>);"></div>
														<div class="bx_slide_right" onclick="rightScroll('<?=$arProp["CODE"]?>', <?=$arItem["ID"]?>, <?=$countValues?>);"></div>
													</div>

												</div>
											<?
											else:
											?>
												<div class="bx_item_detail_size_small_noadaptive <?=$full?>">
													<span class="bx_item_section_name_gray">
														<?=htmlspecialcharsbx($arProp["NAME"])?>:
													</span>
													<div class="bx_size_scroller_container">
														<div class="bx_size">
															<ul id="prop_<?=$arProp["CODE"]?>_<?=$arItem["ID"]?>"
																style="width: 200%; margin-left: <?=$marginLeft; ?>;"
																class="sku_prop_list"
																>
																<?
																if (!empty($arProp["VALUES"]))
																{
																	$counter = 0;
																	foreach ($arProp["VALUES"] as $valueId => $arSkuValue):
																		$counter++;
																		$selected = ($selectedIndex == $counter ? ' bx_active' : '');
																		$skuValueName = htmlspecialcharsbx($arSkuValue['NAME']);
																	?>
																		<li style="width:10%;"
																			class="sku_prop<?=$selected?>"
																			data-sku-selector="Y"
																			data-value-id="<?=($arProp['TYPE'] == 'S' && $arProp['USER_TYPE'] == 'directory' ? $arSkuValue['XML_ID'] : $skuValueName); ?>"
																			data-sku-name="<?=$skuValueName; ?>"
																			data-element="<?=$arItem["ID"]?>"
																			data-property="<?=$arProp["CODE"]?>"
																		>
																			<a href="javascript:void(0)" class="cnt"><?=$skuValueName; ?></a>
																		</li>
																	<?
																		unset($skuValueName);
																	endforeach;
																	unset($counter);
																}
																?>
															</ul>
														</div>
														<div class="bx_slide_left" onclick="leftScroll('<?=$arProp["CODE"]?>', <?=$arItem["ID"]?>, <?=$countValues?>);"></div>
														<div class="bx_slide_right" onclick="rightScroll('<?=$arProp["CODE"]?>', <?=$arItem["ID"]?>, <?=$countValues?>);"></div>
													</div>

												</div>
											<?
											endif;
										endforeach;
									endif;
									?>
								</td>
								<td class="custom">
									<div class="__obozn hidden-xs hidden-sm">????????????</div>

									<span>????????????:</span>
									<div id="discount_value_<?=$arItem["ID"]?>" class="hidden"><?=$arItem["DISCOUNT_PRICE_PERCENT_FORMATED"]?></div>
									<div class="__sale"><?= explode('%', $arItem["DISCOUNT_PRICE_PERCENT_FORMATED"])[0] ?><div class="__persent">%</div></div>
								</td>
								<td class="custom">
									<div class="__obozn hidden-xs hidden-sm">??????????????????????</div>

									<span>??????????????????????:</span>
									<div class="centered">
										<!--
										<table cellspacing="0" cellpadding="0" class="counter">
											<tr>
												<td>
													<?
													$ratio = isset($arItem["MEASURE_RATIO"]) ? $arItem["MEASURE_RATIO"] : 0;
													$useFloatQuantity = ($arParams["QUANTITY_FLOAT"] == "Y") ? true : false;
													$useFloatQuantityJS = ($useFloatQuantity ? "true" : "false");
													?>
													<input
														type="text"
														size="3"
														id="QUANTITY_INPUT_<?=$arItem["ID"]?>"
														name="QUANTITY_INPUT_<?=$arItem["ID"]?>"
														maxlength="18"
														style="max-width: 50px"
														value="<?=$arItem["QUANTITY"]?>"
														onchange="updateQuantity('QUANTITY_INPUT_<?=$arItem["ID"]?>', '<?=$arItem["ID"]?>', <?=$ratio?>, <?=$useFloatQuantityJS?>)"
													>
												</td>
												<?
												if (!isset($arItem["MEASURE_RATIO"]))
												{
													$arItem["MEASURE_RATIO"] = 1;
												}

												if (
													floatval($arItem["MEASURE_RATIO"]) != 0
												):
												?>
													<td id="basket_quantity_control">
														<div class="basket_quantity_control">
															<a href="javascript:void(0);" class="plus" onclick="setQuantity(<?=$arItem["ID"]?>, <?=$arItem["MEASURE_RATIO"]?>, 'up', <?=$useFloatQuantityJS?>);"></a>
															<a href="javascript:void(0);" class="minus" onclick="setQuantity(<?=$arItem["ID"]?>, <?=$arItem["MEASURE_RATIO"]?>, 'down', <?=$useFloatQuantityJS?>);"></a>
														</div>
													</td>
												<?
												endif;
												if (isset($arItem["MEASURE_TEXT"]))
												{
													?>
														<td style="text-align: left"><?=htmlspecialcharsbx($arItem["MEASURE_TEXT"])?></td>
													<?
												}
												?>
											</tr>
										</table>
										-->
										<div class="btn-group">
			                                <button type="button" class="btn left" onclick="setQuantity(<?=$arItem["ID"]?>, <?=$arItem["MEASURE_RATIO"]?>, 'down', <?=$useFloatQuantityJS?>);">-</button>
			                                <input
													type="text"
													class="btn center"
													size="1"
													id="QUANTITY_INPUT_<?=$arItem["ID"]?>"
													name="QUANTITY_INPUT_<?=$arItem["ID"]?>"
													style="max-width: 42px"
													value="<?=$arItem["QUANTITY"]?>"
													onchange="updateQuantity('QUANTITY_INPUT_<?=$arItem["ID"]?>', '<?=$arItem["ID"]?>', <?=$ratio?>, <?=$useFloatQuantityJS?>)"
												>
			                                <button type="button" class="btn right" onclick="setQuantity(<?=$arItem["ID"]?>, <?=$arItem["MEASURE_RATIO"]?>, 'up', <?=$useFloatQuantityJS?>);">+</button>
			                            </div>
									</div>
									<input type="hidden" id="QUANTITY_<?=$arItem['ID']?>" name="QUANTITY_<?=$arItem['ID']?>" value="<?=$arItem["QUANTITY"]?>" />
								</td>
							<?
							elseif ($arHeader["id"] == "PRICE"):
							?>
								<td class="price">
										<div class="__obozn hidden-xs hidden-sm"><?=$arHeader["name"]; ?></div>

										<div class="current_price" id="current_price_<?=$arItem["ID"]?>">
											<?=$arItem["PRICE_FORMATED"]?>
										</div>
										<div class="old_price" id="old_price_<?=$arItem["ID"]?>">
											<?if (floatval($arItem["DISCOUNT_PRICE_PERCENT"]) > 0):?>
												<?=$arItem["FULL_PRICE_FORMATED"]?>
											<?endif;?>
										</div>

									<?if ($bPriceType && strlen($arItem["NOTES"]) > 0):?>
										<!-- <div class="type_price"><?=GetMessage("SALE_TYPE")?></div> -->
										<!-- <div class="type_price_value"><?=$arItem["NOTES"]?></div> -->
									<?endif;?>
								</td>	
							<?
							elseif ($arHeader["id"] == "WEIGHT"):
							?>
								<td class="custom">
									<div class="__obozn hidden-xs hidden-sm"><?=$arHeader["name"]; ?></div>

									<span><?=$arHeader["name"]; ?>:</span>
									<?=$arItem["WEIGHT_FORMATED"]?>
								</td>
							<?
							else:
							?>
								<td class="custom">
									<div class="__obozn hidden-xs hidden-sm"><?=$arHeader["name"]; ?></div>

									<span><?=$arHeader["name"]; ?>:</span>
									<?
									if ($arHeader["id"] == "SUM"):
									?>
										<div id="sum_<?=$arItem["ID"]?>" class="current_price">
									<?
									endif;

									echo $arItem[$arHeader["id"]];

									if ($arHeader["id"] == "SUM"):
									?>
										</div>
									<?
									endif;
									?>
								</td>
							<?
							endif;
						endforeach;

						if ($bDelayColumn || $bDeleteColumn):
						?>
							<td class="control">
								<div class="m-control"></div>
								<?
								if ($bDeleteColumn):
									?>
									<a class="btn-link delete" href="<?=str_replace("#ID#", $arItem["ID"], $arUrls["delete"])?>"
										onclick="return deleteProductRow(this)">
										<?=GetMessage("SALE_DELETE")?>
										<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M9 17C13.4183 17 17 13.4183 17 9C17 4.58172 13.4183 1 9 1C4.58172 1 1 4.58172 1 9C1 13.4183 4.58172 17 9 17Z" stroke="#4A5060" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
										<path d="M11.4001 6.60001L6.6001 11.4" stroke="#4A5060" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
										<path d="M6.6001 6.60001L11.4001 11.4" stroke="#4A5060" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
										</svg>

									</a>
									<?
								endif;
								if ($bDelayColumn):
								?>
									<a class="btn-link" href="<?=str_replace("#ID#", $arItem["ID"], $arUrls["delay"])?>"><?=GetMessage("SALE_DELAY")?></a>
								<?
								endif;
								?>
							</td>
						<?
						endif;
						?>
							<td class="margin"></td>
					</tr>
					<?
					endif;
				endforeach;
				?>
			</tbody>
		</table>

		

	</div>
	<input type="hidden" id="column_headers" value="<?=htmlspecialcharsbx(implode($arHeaders, ","))?>" />
	<input type="hidden" id="offers_props" value="<?=htmlspecialcharsbx(implode($arParams["OFFERS_PROPS"], ","))?>" />
	<input type="hidden" id="action_var" value="<?=htmlspecialcharsbx($arParams["ACTION_VARIABLE"])?>" />
	<input type="hidden" id="quantity_float" value="<?=($arParams["QUANTITY_FLOAT"] == "Y") ? "Y" : "N"?>" />
	<input type="hidden" id="price_vat_show_value" value="<?=($arParams["PRICE_VAT_SHOW_VALUE"] == "Y") ? "Y" : "N"?>" />
	<input type="hidden" id="hide_coupon" value="<?=($arParams["HIDE_COUPON"] == "Y") ? "Y" : "N"?>" />
	<input type="hidden" id="use_prepayment" value="<?=($arParams["USE_PREPAYMENT"] == "Y") ? "Y" : "N"?>" />
	<input type="hidden" id="auto_calculation" value="<?=($arParams["AUTO_CALCULATION"] == "N") ? "N" : "Y"?>" />
	
	<!-- ?????????? -->
	<div class="bx_ordercart_order_pay">
		<div class="__itogo">
			<table class="bx_ordercart_order_sum">
				<?if ($bWeightColumn && floatval($arResult['allWeight']) > 0):?>
					<tr>
						<td class="custom_t1"><?=GetMessage("SALE_TOTAL_WEIGHT")?></td>
						<td class="custom_t2" id="allWeight_FORMATED"><?=$arResult["allWeight_FORMATED"]?>
						</td>
					</tr>
				<?endif;?>
				<?if ($arParams["PRICE_VAT_SHOW_VALUE"] == "Y"):?>
					<tr>
						<td><?echo GetMessage('SALE_VAT_EXCLUDED')?></td>
						<td id="allSum_wVAT_FORMATED"><?=$arResult["allSum_wVAT_FORMATED"]?></td>
					</tr>
					<?
					$showTotalPrice = (float)$arResult["DISCOUNT_PRICE_ALL"] > 0;
					?>
						<tr style="display: <?=($showTotalPrice ? 'table-row' : 'none'); ?>;">
							<td class="custom_t1"></td>
							<td class="custom_t2" style="text-decoration:line-through; color:#828282;" id="PRICE_WITHOUT_DISCOUNT">
								<?=($showTotalPrice ? $arResult["PRICE_WITHOUT_DISCOUNT"] : ''); ?>
							</td>
						</tr>
					<?
					if (floatval($arResult['allVATSum']) > 0):
						?>
						<tr>
							<td><?echo GetMessage('SALE_VAT')?></td>
							<td id="allVATSum_FORMATED"><?=$arResult["allVATSum_FORMATED"]?></td>
						</tr>
						<?
					endif;
					?>
				<?endif;?>
					<tr>
						<td class="fwb"><?=GetMessage("SALE_TOTAL")?></td>
						<td class="fwb" id="allSum_FORMATED"><?=str_replace(" ", "&nbsp;", $arResult["allSum_FORMATED"])?></td>
					</tr>


			</table>
			<div style="clear:both;"></div>
		</div>
		<div class="__dops">
			<div id="coupons_block" class="w-50">
			<?
			if ($arParams["HIDE_COUPON"] != "Y")
			{
			?>
				<div class="bx_ordercart_coupon">
					<span><?=GetMessage("STB_COUPON_PROMT")?></span><input type="text" id="coupon" name="COUPON" value="" onchange="enterCoupon();">&nbsp;<a class="submit-basket-btn" href="javascript:void(0)" onclick="enterCoupon();" title="<?=GetMessage('SALE_COUPON_APPLY_TITLE'); ?>"><?=GetMessage('SALE_COUPON_APPLY'); ?></a>
				</div><?
					if (!empty($arResult['COUPON_LIST']))
					{
						foreach ($arResult['COUPON_LIST'] as $oneCoupon)
						{
							$couponClass = 'disabled';
							switch ($oneCoupon['STATUS'])
							{
								case DiscountCouponsManager::STATUS_NOT_FOUND:
								case DiscountCouponsManager::STATUS_FREEZE:
									$couponClass = 'bad';
									break;
								case DiscountCouponsManager::STATUS_APPLYED:
									$couponClass = 'good';
									break;
							}
							?><div class="bx_ordercart_coupon"><input disabled readonly type="text" name="OLD_COUPON[]" value="<?=htmlspecialcharsbx($oneCoupon['COUPON']);?>" class="<? echo $couponClass; ?>"><span class="<? echo $couponClass; ?>" data-coupon="<? echo htmlspecialcharsbx($oneCoupon['COUPON']); ?>"></span><div class="bx_ordercart_coupon_notes"><?
							if (isset($oneCoupon['CHECK_CODE_TEXT']))
							{
								echo (is_array($oneCoupon['CHECK_CODE_TEXT']) ? implode('<br>', $oneCoupon['CHECK_CODE_TEXT']) : $oneCoupon['CHECK_CODE_TEXT']);
							}
							?></div></div><?
						}
						unset($couponClass, $oneCoupon);
					}
			}
			else
			{
				?>&nbsp;<?
			}
	?>
			</div>
			<div class="w-50">
				<div class="__max_skidka">
					?????????? ???? ??????????????????: <span id="PRICE_WITHOUT_DISCOUNT_CUSTOM"><?=str_replace(" ", "&nbsp;", $arResult["DISCOUNT_PRICE_FORMATED"])?></span>
				</div>
				<div class="bx_ordercart_order_pay_center">

					<?if ($arParams["USE_PREPAYMENT"] == "Y" && strlen($arResult["PREPAY_BUTTON"]) > 0):?>
						<?=$arResult["PREPAY_BUTTON"]?>
						<span><?=GetMessage("SALE_OR")?></span>
					<?endif;?>
					<?
					if ($arParams["AUTO_CALCULATION"] != "Y")
					{
						?>
						<a href="javascript:void(0)" onclick="updateBasket();" class="checkout refresh"><?=GetMessage("SALE_REFRESH")?></a>
						<?
					}
					?>
		            <a href="" class="btn-clear btn" id="clear-basket-btn">???????????????? ??????????????</a>
					<a href="javascript:void(0)"  onclick="checkOut();" class="submit-basket-btn"><?=GetMessage("SALE_ORDER")?></a>
				</div>	
			</div>	
			
		</div>
		
		<div style="clear:both;"></div>
	</div>
</div>
<?
else:
?>
<div id="basket_items_list">
	<table>
		<tbody>
			<tr>
				<td style="text-align:center">
					<div class=""><?=GetMessage("SALE_NO_ITEMS");?></div>
				</td>
			</tr>
		</tbody>
	</table>
</div>
<?
endif;?>

<div class="modal fade modal-clearbasket">
    <div class="modal-call__wrap">
        <div class="modal-busket__dialog">
            <a href="#" data-dismiss="modal" class="modal-call__close-btn"></a>
            <div class="modal-busket__container">
                <div class="modal-busket__title">???? ??????????????, ?????? ???????????? ?????????????? ?????? ???????????? ???? ???????????????</div>
                <div class="modal-busket__bottom">
                    <a href="" class="btn-def" id="delet-basket-btn">????</a>
                    <a href="" class="btn-def" id="close-deleted-basket">??????</a>
                </div>
            </div>
        </div>
    </div>
</div>
