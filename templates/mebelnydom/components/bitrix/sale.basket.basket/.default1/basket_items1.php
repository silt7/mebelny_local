<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
<div id="basket_items_list" class="mt5">
	<div class="bx_ordercart_order_table_container">
      <div class="table-responsive">
		<table id="basket_items" class="table table-cart table-responsive">
			<thead>
				<tr>
                    <th></th>
					<?
					foreach ($arResult["GRID"]["HEADERS"] as $id => $arHeader):
						$arHeader["name"] = (isset($arHeader["name"]) ? (string)$arHeader["name"] : '');
						if ($arHeader["name"] == '')
							$arHeader["name"] = GetMessage("SALE_".$arHeader["id"]);
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

						if ($arHeader["id"] == "NAME"):
						?>
							<th id="col_<?=$arHeader["id"];?>">
						<?
						elseif ($arHeader["id"] == "PRICE"):
						?>
							<th  id="col_<?=$arHeader["id"];?>">
						<?
						else:
						?>
							<th id="col_<?=$arHeader["id"];?>">
						<?
						endif;
						?>
							<?=$arHeader["name"]; ?>
							</th>
					<?
					endforeach;

					if ($bDeleteColumn || $bDelayColumn):
					?>
						<th></th>
					<?
					endif;
					?>
				</tr>
			</thead>
			<tbody>
				<?
				foreach ($arResult["GRID"]["ROWS"] as $k => $arItem):

					if ($arItem["DELAY"] == "N" && $arItem["CAN_BUY"] == "Y"):
				?>
					<tr id="<?=$arItem["ID"]?>" class="item">
						<?
						foreach ($arResult["GRID"]["HEADERS"] as $id => $arHeader):

							if (in_array($arHeader["id"], array("PROPS", "DELAY", "DELETE", "TYPE"))) // some values are not shown in the columns in this template
								continue;

							if ($arHeader["id"] == "NAME"):
							?>
								     <td>
                                     <figure>
										<?
										if (strlen($arItem["PREVIEW_PICTURE"]) > 0):
											$url = $arItem["PREVIEW_PICTURE_SRC"];
										elseif (strlen($arItem["DETAIL_PICTURE"]) > 0):
											$url = $arItem["DETAIL_PICTURE_SRC"];
										else:
											$url = $templateFolder."/images/no_photo.png";
										endif;
										?>
										<? if (strlen($arItem["DETAIL_PAGE_URL"]) > 0):?><a href="<?=$arItem["DETAIL_PAGE_URL"] ?>"><? endif;?>
											<img src="<?=$url?>" alt="<?=$arItem["NAME"]?>" style="max-height:80px;">
										<? if (strlen($arItem["DETAIL_PAGE_URL"]) > 0):?></a><? endif;?>
                                      </figure>
                                      </td>
								      <td>
                                      <? if (strlen($arItem["DETAIL_PAGE_URL"]) > 0):?><a href="<?=$arItem["DETAIL_PAGE_URL"] ?>"><?endif;?>
											<?=$arItem["NAME"]?>
									  <? if (strlen($arItem["DETAIL_PAGE_URL"]) > 0):?></a><? endif;?>
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
    
                                                    echo $val["NAME"].":&nbsp;<span>".$val["VALUE"]."<span><br/>";
                                                endforeach;
                                            endif;
                                            ?>
                                        </div>
									<?
									if (is_array($arItem["SKU_DATA"]) && !empty($arItem["SKU_DATA"])):
										foreach ($arItem["SKU_DATA"] as $propId => $arProp):

											// if property contains images or values
											$isImgProperty = false;
											if (!empty($arProp["VALUES"]) && is_array($arProp["VALUES"]))
											{
												foreach ($arProp["VALUES"] as $id => $arVal)
												{
													if (!empty($arVal["PICT"]) && is_array($arVal["PICT"])
														&& !empty($arVal["PICT"]['SRC']))
													{
														$isImgProperty = true;
														break;
													}
												}
											}
											$countValues = count($arProp["VALUES"]);
											$full = ($countValues > 5) ? "full" : "";

											if ($isImgProperty): // iblock element relation property
											?>
												<div class="bx_item_detail_scu_small_noadaptive <?=$full?>">

													<span class="bx_item_section_name_gray">
														<?=$arProp["NAME"]?>:
													</span>

													<div class="bx_scu_scroller_container">

														<div class="bx_scu">
															<ul id="prop_<?=$arProp["CODE"]?>_<?=$arItem["ID"]?>"
																style="width: 200%; margin-left:0%;"
																class="sku_prop_list"
																>
																<?
																foreach ($arProp["VALUES"] as $valueId => $arSkuValue):

																	$selected = "";
																	foreach ($arItem["PROPS"] as $arItemProp):
																		if ($arItemProp["CODE"] == $arItem["SKU_DATA"][$propId]["CODE"])
																		{
																			if ($arItemProp["VALUE"] == $arSkuValue["NAME"] || $arItemProp["VALUE"] == $arSkuValue["XML_ID"])
																				$selected = "bx_active";
																		}
																	endforeach;
																?>
																	<li style="width:10%;"
																		class="sku_prop <?=$selected?>"
																		data-value-id="<?=$arSkuValue["XML_ID"]?>"
																		data-element="<?=$arItem["ID"]?>"
																		data-property="<?=$arProp["CODE"]?>"
																		>
																		<a href="javascript:void(0);">
																			<span style="background-image:url(<?=$arSkuValue["PICT"]["SRC"]?>)"></span>
																		</a>
																	</li>
																<?
																endforeach;
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
														<?=$arProp["NAME"]?>:
													</span>

													<div class="bx_size_scroller_container">
														<div class="bx_size">
															<ul id="prop_<?=$arProp["CODE"]?>_<?=$arItem["ID"]?>"
																style="width: 200%; margin-left:0%;"
																class="sku_prop_list"
																>
																<?
																foreach ($arProp["VALUES"] as $valueId => $arSkuValue):

																	$selected = "";
																	foreach ($arItem["PROPS"] as $arItemProp):
																		if ($arItemProp["CODE"] == $arItem["SKU_DATA"][$propId]["CODE"])
																		{
																			if ($arItemProp["VALUE"] == $arSkuValue["NAME"])
																				$selected = "bx_active";
																		}
																	endforeach;
																?>
																	<li style="width:10%;"
																		class="sku_prop <?=$selected?>"
																		data-value-id="<?=($arProp['TYPE'] == 'S' && $arProp['USER_TYPE'] == 'directory' ? $arSkuValue['XML_ID'] : $arSkuValue['NAME']); ?>"
																		data-element="<?=$arItem["ID"]?>"
																		data-property="<?=$arProp["CODE"]?>"
																		>
																		<a href="javascript:void(0);"><?=$arSkuValue["NAME"]?></a>
																	</li>
																<?
																endforeach;
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
							<?
							elseif ($arHeader["id"] == "QUANTITY"):
							?>
								<td>
									<div class="custom-quantity-input" style="min-width:100px !important;">
													<?
													$ratio = isset($arItem["MEASURE_RATIO"]) ? $arItem["MEASURE_RATIO"] : 0;
													$max = isset($arItem["AVAILABLE_QUANTITY"]) ? "max=\"".$arItem["AVAILABLE_QUANTITY"]."\"" : "";
													$useFloatQuantity = ($arParams["QUANTITY_FLOAT"] == "Y") ? true : false;
													$useFloatQuantityJS = ($useFloatQuantity ? "true" : "false");
													?>
                                                    <a class="incr-btn" href="javascript:void(0);" onclick="setQuantity(<?=$arItem["ID"]?>, <?=$arItem["MEASURE_RATIO"]?>, 'down', <?=$useFloatQuantityJS?>);" style="top:6px; position:relative;"><i class="fa fa-minus-circle"></i></a>
													<input class="quantity form-control" style="width:60px !important; display:inline;"
														type="text"
														id="QUANTITY_INPUT_<?=$arItem["ID"]?>"
														name="QUANTITY_INPUT_<?=$arItem["ID"]?>"
														min="0"
														<?=$max?>
														step="<?=$ratio?>"
														value="<?=$arItem["QUANTITY"]?>"
														onchange="updateQuantity('QUANTITY_INPUT_<?=$arItem["ID"]?>', '<?=$arItem["ID"]?>', <?=$ratio?>, <?=$useFloatQuantityJS?>)"
													><a class="incr-btn" href="javascript:void(0);" onclick="setQuantity(<?=$arItem["ID"]?>, <?=$arItem["MEASURE_RATIO"]?>, 'up', <?=$useFloatQuantityJS?>);" style="top:6px; position:relative;"><i class="fa fa-plus-circle"></i></a>

									</div>
									<input type="hidden" id="QUANTITY_<?=$arItem['ID']?>" name="QUANTITY_<?=$arItem['ID']?>" value="<?=$arItem["QUANTITY"]?>" />
								</td>
							<?
							elseif ($arHeader["id"] == "PRICE"):
							?>
								<td class="price" style="min-width:90px !important;">
                                    <div class="current_price" id="current_price_<?=$arItem["ID"]?>">
                                            <?=$arItem["PRICE_FORMATED"]?>
                                    </div>
                                    <div class="old_price" id="old_price_<?=$arItem["ID"]?>">
                                        <?if (floatval($arItem["DISCOUNT_PRICE_PERCENT"]) > 0):?>
                                            <?=$arItem["FULL_PRICE_FORMATED"]?>
                                        <?endif;?>
                                    </div>

									<?if ($bPriceType && strlen($arItem["NOTES"]) > 0):?>
										<div class="type_price"><?=GetMessage("SALE_TYPE")?></div>
										<div class="type_price_value"><?=$arItem["NOTES"]?></div>
									<?endif;?>
								</td>
							<?
							elseif ($arHeader["id"] == "DISCOUNT"):
							?>
								<td class="custom">
									<span><?=$arHeader["name"]; ?>:</span>
									<div id="discount_value_<?=$arItem["ID"]?>"><?=$arItem["DISCOUNT_PRICE_PERCENT_FORMATED"]?></div>
								</td>
							<?
							elseif ($arHeader["id"] == "WEIGHT"):
							?>
								<td class="custom">
									<span><?=$arHeader["name"]; ?>:</span>
									<?=$arItem["WEIGHT_FORMATED"]?>
								</td>
							<?
							else:
							?>
								<td class="product-total-col" style="min-width:100px !important;">
									<?
									if ($arHeader["id"] == "SUM"):
									?>
										<div id="sum_<?=$arItem["ID"]?>" class="product-price-special">
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
							<td class="delete">
								<?
								if ($bDeleteColumn):
								?>
									<a style="top:10px; position:relative;" class="cart-delete-item cart-remove close-button" href="<?=str_replace("#ID#", $arItem["ID"], $arUrls["delete"])?>"><i class="fa fa-times-circle fa-2x"></i></a><br />
								<?
								endif;
								if ($bDelayColumn):
								?>
									<a href="<?=str_replace("#ID#", $arItem["ID"], $arUrls["delay"])?>"><?=GetMessage("SALE_DELAY")?></a>
								<?
								endif;
								?>
							</td>
						<?
						endif;
						?>
					</tr>
					<?
					endif;
				endforeach;
				?>
			</tbody>
		</table>
	</div>
	<input type="hidden" id="column_headers" value="<?=CUtil::JSEscape(implode($arHeaders, ","))?>" />
	<input type="hidden" id="offers_props" value="<?=CUtil::JSEscape(implode($arParams["OFFERS_PROPS"], ","))?>" />
	<input type="hidden" id="action_var" value="<?=CUtil::JSEscape($arParams["ACTION_VARIABLE"])?>" />
	<input type="hidden" id="quantity_float" value="<?=$arParams["QUANTITY_FLOAT"]?>" />
	<input type="hidden" id="count_discount_4_all_quantity" value="<?=($arParams["COUNT_DISCOUNT_4_ALL_QUANTITY"] == "Y") ? "Y" : "N"?>" />
	<input type="hidden" id="price_vat_show_value" value="<?=($arParams["PRICE_VAT_SHOW_VALUE"] == "Y") ? "Y" : "N"?>" />
	<input type="hidden" id="hide_coupon" value="<?=($arParams["HIDE_COUPON"] == "Y") ? "Y" : "N"?>" />
	<input type="hidden" id="use_prepayment" value="<?=($arParams["USE_PREPAYMENT"] == "Y") ? "Y" : "N"?>" />

    </div>
    <div class="md-margin"></div><!-- space -->
      <div class="row">
                            <div class="col-md-7">
                                
                                <div class="coupone-block left clearfix" id="coupons_block" style="border-color:#e0eded;">
                                     <h5>Купон или подарочный сертификат</h5>
                                     <p>Уважаемый покупатель! Если у Вас есть акционный купон или код подарочного сертификата, нужно ввести его в этом поле.
											<?
                                                    if ($arParams["HIDE_COUPON"] != "Y")
                                                    {
                                                    ?>
                                                        <div class="coupon">
                                                            <label class="sr-only" for="coupon-code"><?=GetMessage("STB_COUPON_PROMT")?></label><input placeholder="введите код здесь..." type="text" id="coupon" name="COUPON" value="" onchange="enterCoupon();" class="form-control input-lg">
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
                                                                    ?><div class="bx_ordercart_coupon mt10"><input disabled readonly type="text" name="OLD_COUPON[]" value="<?=htmlspecialcharsbx($oneCoupon['COUPON']);?>" class="<? echo $couponClass; ?>"><span class="<? echo $couponClass; ?>" data-coupon="<? echo htmlspecialcharsbx($oneCoupon['COUPON']); ?>"></span><div class="bx_ordercart_coupon_notes"><?
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

                                </div><!-- End .tab-container -->

                                <div class="md-margin"></div><!-- space -->
                                
                            </div><!-- End .col-md-8 -->

                            <div class="md-margin visible-sm visible-xs clearfix"></div><!-- clear sm-xs -->


                            <div class="col-md-5">
                            	<div class="bx_ordercart_order_pay">

                                    <div class="bx_ordercart_order_pay_left" id="coupons_block">
                                    <div class="bx_ordercart_order_pay_right cart-totals">
                                        <table class="bx_ordercart_order_sum table total-table">
                                            <?if ($bWeightColumn):?>
                                                <tr>
                                                    <td class="custom_t1 total-table-title"><?=GetMessage("SALE_TOTAL_WEIGHT")?></td>
                                                    <td class="custom_t2" id="allWeight_FORMATED"><?=$arResult["allWeight_FORMATED"]?></td>
                                                </tr>
                                            <?endif;?>
                                            <?if ($arParams["PRICE_VAT_SHOW_VALUE"] == "Y"):?>
                                                <tr>
                                                    <td class="total-table-title"><? echo GetMessage('SALE_VAT_EXCLUDED')?></td>
                                                    <td id="allSum_wVAT_FORMATED"><?=$arResult["allSum_wVAT_FORMATED"]?></td>
                                                </tr>
                                                <tr>
                                                    <td class="total-table-title"><?echo GetMessage('SALE_VAT_INCLUDED')?></td>
                                                    <td id="allVATSum_FORMATED"><?=$arResult["allVATSum_FORMATED"]?></td>
                                                </tr>
                                            <?endif;?>
                       
                                                <tfoot>
                                                    <tr>
                                                        <td class="fwb">Сумма к оплате</td>
                                                        <td class="fwb allsum" id="allSum_FORMATED"><?=$arResult["allSum_FORMATED"]?></td>
                                                    </tr>
                                                </tfoot>
												<? if (floatval($arResult["DISCOUNT_PRICE_ALL"]) > 0):?>
                                                <tr>
                                                    <td class="custom_t1 total-table-title">Без скидки</td>
                                                    <td class="custom_t2" style="text-decoration:line-through; color:#828282;" id="PRICE_WITHOUT_DISCOUNT">
                                                            <?=$arResult["PRICE_WITHOUT_DISCOUNT"]?>
                                                    </td>
                                                </tr>
                                              <? endif;?>
                                        </table>
                                    </div>
                            
                                    <div class="bx_ordercart_order_pay_center">
                            
                                        <? if ($arParams["USE_PREPAYMENT"] == "Y" && strlen($arResult["PREPAY_BUTTON"]) > 0):?>
                                            <?=$arResult["PREPAY_BUTTON"]?>
                                            <span><?=GetMessage("SALE_OR")?></span>
                                        <? endif;?>
                            
                                        <!--<a href="javascript:void(0)" onclick="checkOut();" class="checkout btn btn-success btn-block"><?=GetMessage("SALE_ORDER")?></a>-->
                                    </div>
                                </div>
                            </div>
                                
                               <!-- <table class="table total-table">
                                    <tbody>
                                        <tr>
                                            <td class="total-table-title">Subtotal:</td>
                                            <td>$434.50</td>
                                        </tr>
                                        <tr>
                                            <td class="total-table-title">Shipping:</td>
                                            <td>$6.00</td>
                                        </tr>
                                        <tr>
                                            <td class="total-table-title">TAX (0%):</td>
                                            <td>$0.00</td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td>Total:</td>
                                            <td>$440.50</td>
                                        </tr>
                                    </tfoot>
                                </table>-->

                                <div class="md-margin"></div><!-- space -->
                            </div><!-- End .col-md-4 -->
                        </div><!-- End .row -->
    
            
            
</div>
<?
else:
?>
<div id="basket_items_list">
	<table>
		<tbody>
			<tr>
				<td colspan="<?=$numCells?>" style="text-align:center">
					<div class=""><?=GetMessage("SALE_NO_ITEMS");?></div>
				</td>
			</tr>
		</tbody>
	</table>
</div>
<?
endif;
?>

<? //if($USER->IsAdmin()) {echo '<pre>'; print_r($arResult); echo '</pre>';} ?>