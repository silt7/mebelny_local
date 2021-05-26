<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @var array $arUrls */
/** @var array $arHeaders */

$bPriceType  = false;
$bDelayColumn  = false;
$bDeleteColumn = false;
$bWeightColumn = false;
$bPropsColumn  = false;
?>
<div id="basket_items_delayed" class="bx_ordercart_order_table_container" style="display:none">
	<table id="delayed_items">
		<thead class="hidden-lg hidden-md">
			<tr>
				<td class="margin"></td>
				<?
				foreach ($arResult["GRID"]["HEADERS"] as $id => $arHeader):
					//
					if($arHeader['id'] == 'PROPERTY_POD_ZAKAZ_VALUE' or $arHeader['id'] == 'PROPERTY_NAL_VALUE' or $arHeader['id'] == 'PROPERTY_ARTNUMBER_VALUE' or $arHeader['id'] == 'DISCOUNT' or $arHeader['id'] == 'QUANTITY'){
						continue;
					}
					//

					if (in_array($arHeader["id"], array("TYPE"))) // some header columns are shown differently
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
						<td class="item" colspan="3">
					<?
					elseif ($arHeader["id"] == "PRICE"):
					?>
						<td class="price">
					<?
					else:
					?>
						<td class="custom">
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

				if ($arItem["DELAY"] == "Y" && $arItem["CAN_BUY"] == "Y"):
			?>
				<tr id="<?=$arItem["ID"]?>">
					<td class="margin"></td>
					<?
					foreach ($arResult["GRID"]["HEADERS"] as $id => $arHeader):
						//
						if($arHeader['id'] == 'PROPERTY_POD_ZAKAZ_VALUE' or $arHeader['id'] == 'PROPERTY_NAL_VALUE' or $arHeader['id'] == 'PROPERTY_ARTNUMBER_VALUE' or $arHeader['id'] == 'DISCOUNT' or $arHeader['id'] == 'QUANTITY'){
							continue;
						}
						//
						if (in_array($arHeader["id"], $skipHeaders)) // some values are not shown in columns in this template
							continue;

						if ($arHeader["id"] == "NAME"):
						?>
							<td class="itemphoto">
								<div class="bx_ordercart_photo_container">
									<?
									if (strlen($arItem["PREVIEW_PICTURE_SRC"]) > 0):
										$url = $arItem["PREVIEW_PICTURE_SRC"];
									elseif (strlen($arItem["DETAIL_PICTURE_SRC"]) > 0):
										$url = $arItem["DETAIL_PICTURE_SRC"];
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
										<span>Артикул: <?= $arItem['PROPERTY_ARTNUMBER_VALUE'] ?></span>
									</div>
								<? endif ?>
								<div>
	                                <? if(isset($arItem['AVAILABLE_QUANTITY']) and !empty($arItem['AVAILABLE_QUANTITY']) and $arItem['AVAILABLE_QUANTITY'] > 0): ?>
                                    <div class="text-ser">В наличии <span class="product-count-green"><?= $arItem['AVAILABLE_QUANTITY'] ?></span></div>
                            		<? endif ?>
                            		<? if(!empty($arItem['PROPERTY_POD_ZAKAZ_VALUE'])): ?>
									<div class="text-ser">Под заказ <span class="product-count-brown"><?= $arItem['PROPERTY_POD_ZAKAZ_VALUE'] ?> дней</span></div>
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

											echo htmlspecialcharsbx($val["NAME"]).":&nbsp;<span>".$val["VALUE"]."<span><br/>";
										endforeach;
									endif;
									?>
								</div>
								<?
								if (is_array($arItem["SKU_DATA"])):
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
											// is image property
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
													if (isset($arVal["PICT"]) && !empty($arVal["PICT"]))
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

											if ($isImgProperty):
											?>
												<div class="bx_item_detail_scu_small_noadaptive <?=$full?>">
													<span class="bx_item_section_name_gray">
														<?=htmlspecialcharsbx($arProp["NAME"])?>:
													</span>
													<div class="bx_scu_scroller_container">
														<div class="bx_scu">
															<ul id="prop_<?=$arProp["CODE"]?>_<?=$arItem["ID"]?>" style="width: 200%; margin-left: <?=$marginLeft; ?>">
															<?
															$counter = 0;
															foreach ($arProp["VALUES"] as $valueId => $arSkuValue):
																$counter++;
																$selected = ($selectedIndex == $counter ? ' class="bx_active"' : '');
															?>
																<li style="width:10%;"<?=$selected?>>
																	<a href="javascript:void(0)" class="cnt"><span class="cnt_item" style="background-image:url(<?=$arSkuValue["PICT"]["SRC"]; ?>)"></span></a>
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
														<?=htmlspecialcharsbx($arProp["NAME"]);?>:
													</span>
													<div class="bx_size_scroller_container">
														<div class="bx_size">
															<ul id="prop_<?=$arProp["CODE"]?>_<?=$arItem["ID"]?>" style="width: 200%; margin-left: <?=$marginLeft; ?>;">
																<?
																$counter = 0;
																foreach ($arProp["VALUES"] as $valueId => $arSkuValue):
																	$counter++;
																	$selected = ($selectedIndex == $counter ? ' class="bx_active"' : '');
																?>
																	<li style="width:10%;"<?=$selected?>>
																		<a href="javascript:void(0);" class="cnt"><?=htmlspecialcharsbx($arSkuValue["NAME"]); ?></a>
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
											endif;
										endforeach;
								endif;
								?>
								<input type="hidden" name="DELAY_<?=$arItem["ID"]?>" value="Y"/>
							</td>
							<td class="custom">
								<div class="__obozn hidden-xs hidden-sm">Скидка</div>

								<span>Скидка:</span>
								<div id="discount_value_<?=$arItem["ID"]?>" class="hidden"><?=$arItem["DISCOUNT_PRICE_PERCENT_FORMATED"]?></div>
								<div class="__sale"><?= explode('%', $arItem["DISCOUNT_PRICE_PERCENT_FORMATED"])[0] ?><div class="__persent">%</div></div>
							</td>
						<?
						elseif ($arHeader["id"] == "QUANTITY"):
						?>
							<td class="custom">
								<span><?=$arHeader["name"]; ?>:</span>
								<div style="text-align: center;">
									<?echo $arItem["QUANTITY"];
										if (isset($arItem["MEASURE_TEXT"]))
											echo "&nbsp;".htmlspecialcharsbx($arItem["MEASURE_TEXT"]);
									?>
								</div>
							</td>
						<?
						elseif ($arHeader["id"] == "PRICE"):
						?>
							<td class="price">
								<div class="__obozn hidden-xs hidden-sm"><?=$arHeader["name"]; ?></div>

								<?if (doubleval($arItem["DISCOUNT_PRICE_PERCENT"]) > 0):?>
									<div class="current_price"><?=$arItem["PRICE_FORMATED"]?></div>
									<div class="old_price"><?=$arItem["FULL_PRICE_FORMATED"]?></div>
								<?else:?>
									<div class="current_price"><?=$arItem["PRICE_FORMATED"];?></div>
								<?endif?>

								<?if ($bPriceType && strlen($arItem["NOTES"]) > 0):?>
									<!-- <div class="type_price"><?=GetMessage("SALE_TYPE")?></div> -->
									<!-- <div class="type_price_value"><?=$arItem["NOTES"]?></div> -->
								<?endif;?>
							</td>
						<?
						elseif ($arHeader["id"] == "DISCOUNT"):
						?>
							<td class="custom">
								<div class="__obozn hidden-xs hidden-sm"><?=$arHeader["name"]; ?></div>

								<span><?=$arHeader["name"]; ?>:</span>
								<?=$arItem["DISCOUNT_PRICE_PERCENT_FORMATED"]?>
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
							<? if(!empty($arHeader["name"])): ?>
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
							<? endif ?>
						<?
						endif;
					endforeach;

					if ($bDelayColumn || $bDeleteColumn):
					?>
						<td class="control">
							<?
							if ($bDeleteColumn):
							?>
								<a class="btn-link delete" href="<?=str_replace("#ID#", $arItem["ID"], $arUrls["delete"])?>">
									<?=GetMessage("SALE_DELETE")?>
									<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M9 17C13.4183 17 17 13.4183 17 9C17 4.58172 13.4183 1 9 1C4.58172 1 1 4.58172 1 9C1 13.4183 4.58172 17 9 17Z" stroke="#4A5060" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
									<path d="M11.4001 6.60001L6.6001 11.4" stroke="#4A5060" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
									<path d="M6.6001 6.60001L11.4001 11.4" stroke="#4A5060" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
									</svg>	
								</a>
							<?
							endif;
							?>
							<a class="btn-link" href="<?=str_replace("#ID#", $arItem["ID"], $arUrls["add"])?>"><?=GetMessage("SALE_ADD_TO_BASKET")?></a>
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