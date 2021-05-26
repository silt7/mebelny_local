<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

/**
 * @var array $arParams
 * @var array $arResult
 * @var $APPLICATION CMain
 * @var $USER CUser
 * @var $component SaleOrderAjax
 */

if (empty($arParams['TEMPLATE_THEME']))
{
	$arParams['TEMPLATE_THEME'] = \Bitrix\Main\ModuleManager::isModuleInstalled('bitrix.eshop') ? 'site' : 'blue';
}

if ($arParams['TEMPLATE_THEME'] == 'site')
{
	$templateId = \Bitrix\Main\Config\Option::get("main", "wizard_template_id", "eshop_bootstrap", SITE_ID);
	$templateId = preg_match("/^eshop_adapt/", $templateId) ? "eshop_adapt" : $templateId;
	$arParams['TEMPLATE_THEME'] = \Bitrix\Main\Config\Option::get('main', 'wizard_' . $templateId . '_theme_id', 'blue', SITE_ID);
}

if (!empty($arParams['TEMPLATE_THEME']))
{
	if (!is_file($_SERVER['DOCUMENT_ROOT'].'/bitrix/css/main/themes/'.$arParams['TEMPLATE_THEME'].'/style.css'))
		$arParams['TEMPLATE_THEME'] = 'blue';
}

$arParams["ALLOW_USER_PROFILES"] = $arParams["ALLOW_USER_PROFILES"] == "Y" ? "Y" : "N";
$arParams["SKIP_USELESS_BLOCK"] = $arParams["SKIP_USELESS_BLOCK"] == "N" ? "N" : "Y";
if (!isset($arParams['SHOW_ORDER_BUTTON']))
	$arParams['SHOW_ORDER_BUTTON'] = 'final_step';
$arParams["SHOW_TOTAL_ORDER_BUTTON"] = $arParams["SHOW_TOTAL_ORDER_BUTTON"] == "Y" ? "Y" : "N";
$arParams['SHOW_PAY_SYSTEM_LIST_NAMES'] = $arParams['SHOW_PAY_SYSTEM_LIST_NAMES'] == 'N' ? 'N' : 'Y';
$arParams['SHOW_PAY_SYSTEM_INFO_NAME'] = $arParams['SHOW_PAY_SYSTEM_INFO_NAME'] == 'N' ? 'N' : 'Y';
$arParams['SHOW_DELIVERY_LIST_NAMES'] = $arParams['SHOW_DELIVERY_LIST_NAMES'] == 'N' ? 'N' : 'Y';
$arParams['SHOW_DELIVERY_INFO_NAME'] = $arParams['SHOW_DELIVERY_INFO_NAME'] == 'N' ? 'N' : 'Y';
$arParams['SHOW_DELIVERY_PARENT_NAMES'] = $arParams['SHOW_DELIVERY_PARENT_NAMES'] == 'N' ? 'N' : 'Y';
$arParams['SHOW_STORES_IMAGES'] = $arParams['SHOW_STORES_IMAGES'] == 'N' ? 'N' : 'Y';
if (!isset($arParams['BASKET_POSITION']))
	$arParams['BASKET_POSITION'] = 'after';
$arParams['SHOW_BASKET_HEADERS'] = $arParams['SHOW_BASKET_HEADERS'] == 'Y' ? 'Y' : 'N';
$arParams['DELIVERY_FADE_EXTRA_SERVICES'] = $arParams['DELIVERY_FADE_EXTRA_SERVICES'] == 'Y' ? 'Y' : 'N';
$arParams['SHOW_COUPONS_BASKET'] = $arParams['SHOW_COUPONS_BASKET'] == 'N' ? 'N' : 'Y';
$arParams['SHOW_COUPONS_DELIVERY'] = $arParams['SHOW_COUPONS_DELIVERY'] == 'N' ? 'N' : 'Y';
$arParams['SHOW_COUPONS_PAY_SYSTEM'] = $arParams['SHOW_COUPONS_PAY_SYSTEM'] == 'Y' ? 'Y' : 'N';
$arParams['SHOW_NEAREST_PICKUP'] = $arParams['SHOW_NEAREST_PICKUP'] == 'Y' ? 'Y' : 'N';
$arParams['DELIVERIES_PER_PAGE'] = isset($arParams['DELIVERIES_PER_PAGE']) ? intval($arParams['DELIVERIES_PER_PAGE']) : 8;
$arParams['PAY_SYSTEMS_PER_PAGE'] = isset($arParams['PAY_SYSTEMS_PER_PAGE']) ? intval($arParams['PAY_SYSTEMS_PER_PAGE']) : 8;
$arParams['PICKUPS_PER_PAGE'] = isset($arParams['PICKUPS_PER_PAGE']) ? intval($arParams['PICKUPS_PER_PAGE']) : 5;
$arParams['SHOW_MAP_IN_PROPS'] = $arParams['SHOW_MAP_IN_PROPS'] == 'Y' ? 'Y' : 'N';
$arParams['USE_YM_GOALS'] = $arParams['USE_YM_GOALS'] == 'Y' ? 'Y' : 'N';

if ($arParams["USE_CUSTOM_MAIN_MESSAGES"] != "Y")
{
	$arParams['MESS_AUTH_BLOCK_NAME'] = Loc::getMessage("AUTH_BLOCK_NAME_DEFAULT");
	$arParams['MESS_REG_BLOCK_NAME'] = Loc::getMessage("REG_BLOCK_NAME_DEFAULT");
	$arParams['MESS_BASKET_BLOCK_NAME'] = Loc::getMessage("BASKET_BLOCK_NAME_DEFAULT");
	$arParams['MESS_REGION_BLOCK_NAME'] = Loc::getMessage("REGION_BLOCK_NAME_DEFAULT");
	$arParams['MESS_PAYMENT_BLOCK_NAME'] = Loc::getMessage("PAYMENT_BLOCK_NAME_DEFAULT");
	$arParams['MESS_DELIVERY_BLOCK_NAME'] = Loc::getMessage("DELIVERY_BLOCK_NAME_DEFAULT");
	$arParams['MESS_BUYER_BLOCK_NAME'] = Loc::getMessage("BUYER_BLOCK_NAME_DEFAULT");
	$arParams['MESS_BACK'] = Loc::getMessage("BACK_DEFAULT");
	$arParams['MESS_FURTHER'] = Loc::getMessage("FURTHER_DEFAULT");
	$arParams['MESS_EDIT'] = Loc::getMessage("EDIT_DEFAULT");
	$arParams['MESS_ORDER'] = Loc::getMessage("ORDER_DEFAULT");
	$arParams['MESS_PRICE'] = Loc::getMessage("PRICE_DEFAULT");
	$arParams['MESS_PERIOD'] = Loc::getMessage("PERIOD_DEFAULT");
	$arParams['MESS_NAV_BACK'] = Loc::getMessage("NAV_BACK_DEFAULT");
	$arParams['MESS_NAV_FORWARD'] = Loc::getMessage("NAV_FORWARD_DEFAULT");
}

if ($arParams["USE_CUSTOM_ADDITIONAL_MESSAGES"] != "Y")
{
	$arParams['MESS_REGISTRATION_REFERENCE'] = Loc::getMessage("REGISTRATION_REFERENCE_DEFAULT");
	$arParams['MESS_AUTH_REFERENCE_1'] = Loc::getMessage("AUTH_REFERENCE_1_DEFAULT");
	$arParams['MESS_AUTH_REFERENCE_2'] = Loc::getMessage("AUTH_REFERENCE_2_DEFAULT");
	$arParams['MESS_AUTH_REFERENCE_3'] = Loc::getMessage("AUTH_REFERENCE_3_DEFAULT");
	$arParams['MESS_ADDITIONAL_PROPS'] = Loc::getMessage("ADDITIONAL_PROPS_DEFAULT");
	$arParams['MESS_USE_COUPON'] = Loc::getMessage("USE_COUPON_DEFAULT");
	$arParams['MESS_COUPON'] = Loc::getMessage("COUPON_DEFAULT");
	$arParams['MESS_PERSON_TYPE'] = Loc::getMessage("PERSON_TYPE_DEFAULT");
	$arParams['MESS_SELECT_PROFILE'] = Loc::getMessage("SELECT_PROFILE_DEFAULT");
	$arParams['MESS_REGION_REFERENCE'] = Loc::getMessage("REGION_REFERENCE_DEFAULT");
	$arParams['MESS_PICKUP_LIST'] = Loc::getMessage("PICKUP_LIST_DEFAULT");
	$arParams['MESS_NEAREST_PICKUP_LIST'] = Loc::getMessage("NEAREST_PICKUP_LIST_DEFAULT");
	$arParams['MESS_SELECT_PICKUP'] = Loc::getMessage("SELECT_PICKUP_DEFAULT");
	$arParams['MESS_INNER_PS_BALANCE'] = Loc::getMessage("INNER_PS_BALANCE_DEFAULT");
	$arParams['MESS_ORDER_DESC'] = Loc::getMessage("ORDER_DESC_DEFAULT");
}

if ($arParams["USE_CUSTOM_ERROR_MESSAGES"] != "Y")
{
	$arParams['MESS_PRELOAD_ORDER_TITLE'] = Loc::getMessage("PRELOAD_ORDER_TITLE_DEFAULT");
	$arParams['MESS_SUCCESS_PRELOAD_TEXT'] = Loc::getMessage("SUCCESS_PRELOAD_TEXT_DEFAULT");
	$arParams['MESS_FAIL_PRELOAD_TEXT'] = Loc::getMessage("FAIL_PRELOAD_TEXT_DEFAULT");
	$arParams['MESS_DELIVERY_CALC_ERROR_TITLE'] = Loc::getMessage("DELIVERY_CALC_ERROR_TITLE_DEFAULT");
	$arParams['MESS_DELIVERY_CALC_ERROR_TEXT'] = Loc::getMessage("DELIVERY_CALC_ERROR_TEXT_DEFAULT");
}

$scheme = \Bitrix\Main\Context::getCurrent()->getRequest()->isHttps() ? 'https' : 'http';
switch (LANGUAGE_ID)
{
	case 'ru':
		$locale = 'ru-RU'; break;
	case 'ua':
		$locale = 'ru-UA'; break;
	case 'tk':
		$locale = 'tr-TR'; break;
	default:
		$locale = 'en-US'; break;
}

$this->addExternalCss("/local/templates/mebelnydom/libs/bootstrap/bootstrap2.css");
$this->addExternalCss('/bitrix/components/bitrix/sale.location.selector.search/templates/.default/style.css');
$this->addExternalCss('/bitrix/components/bitrix/sale.location.selector.steps/templates/.default/style.css');
$APPLICATION->SetAdditionalCSS('/bitrix/css/main/themes/'.$arParams['TEMPLATE_THEME'].'/style.css', true);
$APPLICATION->SetAdditionalCSS($templateFolder.'/style.css', true);
$this->addExternalJs($templateFolder.'/vue.js');
$this->addExternalJs($templateFolder.'/axios.js');
$this->addExternalJs($templateFolder.'/theia-sticky-sidebar.js');
$this->addExternalJs($templateFolder.'/jquery.mask.js');
$this->addExternalJs($templateFolder.'/script.js');
\Bitrix\Sale\PropertyValueCollection::initJs();
?>
<NOSCRIPT>
	<div style="color:red"><?=Loc::getMessage("SOA_NO_JS")?></div>
</NOSCRIPT>
<?
$context = Bitrix\Main\Application::getInstance()->getContext();
if (strlen($context->getRequest()->get('ORDER_ID')) > 0):
	include($context->getServer()->getDocumentRoot().$templateFolder."/confirm.php");
elseif ($arParams["DISABLE_BASKET_REDIRECT"] == 'Y' && $arResult["SHOW_EMPTY_BASKET"]):
	include($context->getServer()->getDocumentRoot().$templateFolder."/empty.php");
else:
	$hideDelivery = empty($arResult["DELIVERY"]);
?>



<div id="bx-soa-order" class="row bx-<?=$arParams['TEMPLATE_THEME']?> custom">

	<form action="<?=$APPLICATION->GetCurPage();?>" method="POST" id="bx-soa-order-form">
		<?=bitrix_sessid_post()?>
		<?
		if (strlen($arResult["PREPAY_ADIT_FIELDS"]) > 0)
			echo $arResult["PREPAY_ADIT_FIELDS"];
		?>

		<!-- INPUTS -->
		<div id="bx-soa-inputs">
			<input type="hidden" name="action" value="saveOrderAjax">
			<input type="hidden" name="location_type" value="code">
			<input type="hidden" name="BUYER_STORE" id="BUYER_STORE" value="<?=$arResult["BUYER_STORE"]?>">
			<input type="hidden" name="PAY_SYSTEM_ID" :value="paySystemValue()">
			<input type="hidden" name="DELIVERY_ID" :value="deliveryValue()">
			<input type="hidden" name="ORDER_DESCRIPTION" :value="description">
			<template v-for="item in properties">
				<input type="hidden" :name="'ORDER_PROP_'+item.ID" :value="item.VALUE">
			</template>	
		</div>

	</form>

<!--MAIN BLOCK	-->
	<template v-if="is_load">
		<xml version="1.0" encoding="utf-8">
		<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto; background: rgb(248, 249, 252); display: block; shape-rendering: auto;" width="291px" height="291px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
		<g transform="rotate(0 50 50)">
		  <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#ffb800">
		    <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.9166666666666666s" repeatCount="indefinite"></animate>
		  </rect>
		</g><g transform="rotate(30 50 50)">
		  <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#ffb800">
		    <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.8333333333333334s" repeatCount="indefinite"></animate>
		  </rect>
		</g><g transform="rotate(60 50 50)">
		  <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#ffb800">
		    <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.75s" repeatCount="indefinite"></animate>
		  </rect>
		</g><g transform="rotate(90 50 50)">
		  <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#ffb800">
		    <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.6666666666666666s" repeatCount="indefinite"></animate>
		  </rect>
		</g><g transform="rotate(120 50 50)">
		  <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#ffb800">
		    <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.5833333333333334s" repeatCount="indefinite"></animate>
		  </rect>
		</g><g transform="rotate(150 50 50)">
		  <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#ffb800">
		    <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.5s" repeatCount="indefinite"></animate>
		  </rect>
		</g><g transform="rotate(180 50 50)">
		  <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#ffb800">
		    <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.4166666666666667s" repeatCount="indefinite"></animate>
		  </rect>
		</g><g transform="rotate(210 50 50)">
		  <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#ffb800">
		    <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.3333333333333333s" repeatCount="indefinite"></animate>
		  </rect>
		</g><g transform="rotate(240 50 50)">
		  <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#ffb800">
		    <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.25s" repeatCount="indefinite"></animate>
		  </rect>
		</g><g transform="rotate(270 50 50)">
		  <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#ffb800">
		    <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.16666666666666666s" repeatCount="indefinite"></animate>
		  </rect>
		</g><g transform="rotate(300 50 50)">
		  <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#ffb800">
		    <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="-0.08333333333333333s" repeatCount="indefinite"></animate>
		  </rect>
		</g><g transform="rotate(330 50 50)">
		  <rect x="47" y="24" rx="3" ry="6" width="6" height="12" fill="#ffb800">
		    <animate attributeName="opacity" values="1;0" keyTimes="0;1" dur="1s" begin="0s" repeatCount="indefinite"></animate>
		  </rect>
		</g>
		<!-- [ldio] generated by https://loading.io/ --></svg>
	</template>
	<template v-else>
	<div class="col-sm-12 mb-10 bx-soa-sidebar theiaStickySidebar hidden-md hidden-lg"  v-if="active_step.id != 4">
		<div class="bx-soa-cart-total _card">
			<div class="__title">
				Ваш заказ:
			</div>
			<div class="__items">
				<div class="__products">
					<div class="row mb-10">
						<div class="col-xs-6">
							<div>
								Товаров <span>({{ products_in_cart.length }})</span>
							</div>
						</div>
						<div class="col-xs-6">
							<div class="text-right">
								<span v-if="total.ORDER_PRICE_FORMATED != undefined" class="fw-600" id="ORDER_SUM">{{ total.ORDER_PRICE_FORMATED }}</span>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
					<div v-if="total.DISCOUNT_PRICE != undefined && total.DISCOUNT_PRICE != '0'" class="row">
						<div class="col-xs-6">
							<div>
								Скидка
							</div>
						</div>
						<div class="col-xs-6">
							<div class="text-right">
								<span v-if="total.DISCOUNT_PRICE_FORMATED != undefined" class="fw-600 text-danger" id="ORDER_SALE">{{ total.DISCOUNT_PRICE_FORMATED }}</span>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
				<div class="__products">
					<div class="row">
						<div class="col-xs-6">
							<div>
								Доставка
							</div>
						</div>
						<div class="col-xs-6">
							<div class="text-right">
								<span v-if="total.DELIVERY_PRICE_FORMATED != undefined" class="fw-600" id="ORDER_DOST">{{ total.DELIVERY_PRICE_FORMATED }}</span>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
				<div class="__itogo">
					<div class="row">
						<div class="col-xs-6">
							<div>
								Итого:
							</div>
						</div>
						<div class="col-xs-6">
							<div class="text-right">
								<span v-if="total.ORDER_TOTAL_PRICE_FORMATED != undefined" id="ORDER_ITOG">{{ total.ORDER_TOTAL_PRICE_FORMATED }}</span>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-sm-12">
		<div id="main-steps" class="__steps _card">
			<div class="row">
				<div v-for="(step, key) in steps" class="col-xs-3">
					<div class="__step" :class="[checkActiveClass(step.id) ? 'active' : '']">
						<div class="__circle">
							{{ step.id }}
						</div>
						<div class="__title hidden-xs hidden-sm">
							{{ step.title }}
						</div>

						<div v-if="(key + 1) != steps.length" class="__sparrow hidden-xs hidden-sm">
							<svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd" clip-rule="evenodd" d="M0.146894 0.146894C0.193339 0.100331 0.248515 0.0633878 0.30926 0.0381813C0.370005 0.0129749 0.435126 0 0.500894 0C0.566661 0 0.631782 0.0129749 0.692527 0.0381813C0.753272 0.0633878 0.808448 0.100331 0.854894 0.146894L6.85489 6.14689C6.90146 6.19334 6.9384 6.24852 6.96361 6.30926C6.98881 6.37001 7.00179 6.43513 7.00179 6.50089C7.00179 6.56666 6.98881 6.63178 6.96361 6.69253C6.9384 6.75327 6.90146 6.80845 6.85489 6.85489L0.854894 12.8549C0.761007 12.9488 0.633669 13.0015 0.500894 13.0015C0.368118 13.0015 0.24078 12.9488 0.146894 12.8549C0.0530069 12.761 0.000261784 12.6337 0.000261784 12.5009C0.000261784 12.3681 0.0530069 12.2408 0.146894 12.1469L5.79389 6.50089L0.146894 0.854894C0.10033 0.808448 0.0633873 0.753273 0.0381808 0.692528C0.0129744 0.631782 0 0.566661 0 0.500894C0 0.435127 0.0129744 0.370005 0.0381808 0.30926C0.0633873 0.248515 0.10033 0.19334 0.146894 0.146894Z" fill="#C4C4C4"/>
							</svg>	
						</div>
						
					</div>		
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	<div class="clearfix"></div>

	<div class="col-sm-8 bx-soa" v-if="active_step.id != 4">
		<div class="__main_content _card">
		
			<div v-for="(step, key) in steps" class="__step" v-if="step.active">
				<!-- HEAD -->
				<div class="__head_box">
					<div class="__circle">{{ step.id }}</div><div class="__title">{{ step.title }}</div>
				</div>
				<!-- BODY -->
				<div class="__body_box">
					<!-- STEP ID 1 -->
					<div v-show="step.id == 1">

						<template v-for="item in properties">
							<div v-if="item.ACTIVE == 'Y' && item.PROPS_GROUP_ID != '2'">
								<div v-if="item.TYPE == 'STRING'" class="form-group" :class="[(item.ERROR != undefined && item.ERROR) ? 'error' : '']">
									<label :for="'input-'+item.ID">{{ item.NAME }} <span v-if="item.REQUIRED == 'Y'" class="text-danger">*</span></label>
									<input 
										class="form-control" 
										:id="'input-'+item.ID" 
										:type="setType(item)" 
										v-model="item.VALUE" 
									>
								</div>		
							</div>
							
						</template>
						
						<div class="form-group">
							<label for="input-4">Комментарий к заказу</label>
							<textarea class="form-control" id="input-4" v-model="description"></textarea>
						</div>

						<div v-if="checkCheckbox()" class="form-group form-additionally">
							<label>Дополнительно</label>

							<template v-for="item in properties">
								<div v-if="item.ACTIVE == 'Y' && item.TYPE == 'Y/N'">
									<div class="custom-checkbox" :class="[item.VALUE == 'Y' ? 'checked' : '']" @click="setCheckbox(item)">
								        <svg width="12" height="9" viewBox="0 0 12 9" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M1.66675 5.76917L3.60521 7.5647L10.0667 1.57959" stroke="#269437" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
										</svg>

										<span class="custom-control-label" :for="'input-'+item.ID">{{ item.NAME }}</span>
								    </div>	
								</div>
							</template>
						</div>
					</div>
					<!-- STEP ID 2 -->
					<div v-show="step.id == 2">
						<div class="tabs">
							
							<div v-for="item in delivery" class="tab" :class="[item.CHECKED == 'Y' ? 'active' : '']" @click="setDelivery(item)">
								<span>{{ item.NAME }}</span>
							</div>
						</div>

						<div class="step_2_content">
							<div v-if="delivery_item != null && delivery_item.DESCRIPTION != undefined" class="__item">
								<div v-html="delivery_item.DESCRIPTION"></div>
							</div>
							
							<!-- Картинки для транспортных -->
							<div v-if="delivery_item != null && delivery_item.ID == '4'" class="__item">
								<div class="row">
									<div v-for="del in custom_delivery" class="col-md-4">
										<div class="__tr" :class="[del.active ? 'active' : '']" @click="setCustomDelivery(del.id)">
											<img :title="del.name" :src="del.img">
										</div>
									</div>
								</div>

								<div class="info">
									Стоимость доставки до офиса ТК ПЭК или Деловые линии, составляет 500 рублей. При согласовании другой ТК, стоимость доставки до нее будет составлять 1500 рублей. Стоимость доставки до вашего местоположения рассчитывается отдельно по тарифу выбранной ТК, после оформления заказа
								</div>
							</div>
							
							<template v-if="delivery_item != null && delivery_item.CUSTOM_FIELDS != null && delivery_item.CUSTOM_FIELDS.items.length > 1">
								<div class="__item">
									<div v-for="it in delivery_item.CUSTOM_FIELDS.items" class="custom-radio" @click="setRadio(it.id)"><span class="circle" :class="it.active ? 'active' : ''"></span> <span class="custom-control-label">{{ it.name }}</span></div>
								</div>
								
								<div class="__item" v-if="delivery_item.ID != '2'">
									<template v-for="item in properties">
										<div v-if="item.ACTIVE == 'Y' && item.CODE == 'CITY'">
											<div class="form-group" :class="[(item.ERROR != undefined && item.ERROR) ? 'error' : '']">
												<label :for="'input-'+item.ID">{{ item.NAME }} <span v-if="item.REQUIRED == 'Y'" class="text-danger">*</span></label>
												<input 
													class="form-control" 
													:id="'input-'+item.ID" 
													:type="setType(item)" 
													v-model="item.VALUE"
													@input="searchCity(item)"
													placeholder="Введите название" 
												>

												<!-- CITYS -->
												<div v-if="item.CODE == 'CITY' && search_citys.length > 0" class="hidden-lists">
													<div v-for="city in search_citys" class="hidden-list-item" @click="setCityValue(item, city)" v-click-outside="deleteCityText">{{ city }}</div>
												</div>

												<!--  -->
												<div class="info">
													Выберите свой город в списке. Если вы не нашли свой город, выберите "другое местоположение", а город впишите в поле "Город
												</div>
											</div>		
										</div>
										
									</template>
									<div v-for="it in delivery_item.CUSTOM_FIELDS.items" v-if="it.active && it.fields.length > 0">
										<div class="row">
											<template v-for="field in it.fields">
												<div :class="[field.CLASS]">
													<div v-if="field.TYPE == 'STRING'" class="form-group" :class="[(field.ERROR != undefined && field.ERROR) ? 'error' : '']">
														<label :for="'input-'+field.SLUG">{{ field.NAME }} <span v-if="field.REQUIRED == 'Y'" class="text-danger">*</span></label>
														<input 
															class="form-control" 
															:id="'input-'+field.SLUG"
															v-model="field.VALUE"
															:placeholder="field.PLACEHOLDER"
														>
													</div>	
													<div v-if="field.TYPE == 'Y/N'" class="form-group form-additionally" :class="[(field.ERROR != undefined && field.ERROR) ? 'error' : '']">
														<div class="custom-checkbox m-0" :class="[field.VALUE == 'Y' ? 'checked' : '']" @click="setFieldCheckbox(field)">
													        <svg width="12" height="9" viewBox="0 0 12 9" fill="none" xmlns="http://www.w3.org/2000/svg">
																<path d="M1.66675 5.76917L3.60521 7.5647L10.0667 1.57959" stroke="#269437" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
															</svg>

															<span class="custom-control-label" :for="'input-'+field.SLUG">{{ field.NAME }}</span>
													    </div>
													</div>
												</div>
											</template>
										</div>
									</div>	
								</div>
							</template>

							<!-- Карта для самовывоза  -->
							<div v-if="delivery_item != null && delivery_item.ID == '2'" class="__item">
								<iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3A59dd265e9582cf7095b84fe12929e4e69fead91fd956c0f489e3b60eb94dfc3a&amp;source=constructor" width="100%" height="350" frameborder="0"></iframe>
							</div>
							
						</div>
					</div>
					<!-- STEP ID 3 -->
					<div v-show="step.id == 3">
						<div class="step_3_content">
							<div class="row">
								<div v-for="item in pay_system" class="col-md-4">
									<div class="__item" :class="[item.CHECKED == 'Y' ? 'active' : '', checkPaySystemDisabled(item) ? 'disabled' : '']" @click="setPaySystem(item)">
										<img :src="item.PSA_LOGOTIP_SRC"> <span>{{ item.NAME }}</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- STEP ID 4 -->
					<div v-show="step.id == 4">
						4
					</div>
				</div>
				<!-- FOOT -->
				<div class="__foot_box">
					<div class="row">
						<div class="col-md-6">
							<div>
								<a v-if="key != 0" class="__prev" @click="setStep('prev')" href="javascript:void(0)">Назад</a>
							</div>
						</div>
						<div class="col-md-6">
							<div class="text-right">
								<a v-if="(key + 1) != steps.length" class="__next" @click="setStep('next')" href="javascript:void(0)">Вперед</a>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>		

		</div>
	</div>

	<!-- SIDEBAR BLOCK	-->
	<div id="bx-soa-total" class="col-sm-4 bx-soa-sidebar theiaStickySidebar hidden-xs hidden-sm"  v-if="active_step.id != 4">
		<div class="bx-soa-cart-total-ghost"></div>
			<div class="bx-soa-cart-total _card">
				<div class="__title">
					Ваш заказ:
				</div>
				<div class="__items">
					<div class="__products">
						<div class="row mb-10">
							<div class="col-xs-6">
								<div>
									Товаров <span>({{ products_in_cart.length }})</span>
								</div>
							</div>
							<div class="col-xs-6">
								<div class="text-right">
									<span v-if="total.ORDER_PRICE_FORMATED != undefined" class="fw-600" id="ORDER_SUM">{{ total.ORDER_PRICE_FORMATED }}</span>
								</div>
							</div>
							<div class="clearfix"></div>
						</div>
						<div v-if="total.DISCOUNT_PRICE != undefined && total.DISCOUNT_PRICE != '0'" class="row">
							<div class="col-xs-6">
								<div>
									Скидка
								</div>
							</div>
							<div class="col-xs-6">
								<div class="text-right">
									<span v-if="total.DISCOUNT_PRICE_FORMATED != undefined" class="fw-600 text-danger" id="ORDER_SALE">{{ total.DISCOUNT_PRICE_FORMATED }}</span>
								</div>
							</div>
							<div class="clearfix"></div>
						</div>
					</div>
					<div class="__products">
						<div class="row">
							<div class="col-xs-6">
								<div>
									Доставка
								</div>
							</div>
							<div class="col-xs-6">
								<div class="text-right">
									<span v-if="total.DELIVERY_PRICE_FORMATED != undefined" class="fw-600" id="ORDER_DOST">{{ total.DELIVERY_PRICE_FORMATED }}</span>
								</div>
							</div>
							<div class="clearfix"></div>
						</div>
					</div>
					<div class="__itogo">
						<div class="row">
							<div class="col-xs-6">
								<div>
									Итого:
								</div>
							</div>
							<div class="col-xs-6">
								<div class="text-right">
									<span v-if="total.ORDER_TOTAL_PRICE_FORMATED != undefined" id="ORDER_ITOG">{{ total.ORDER_TOTAL_PRICE_FORMATED }}</span>
								</div>
							</div>
							<div class="clearfix"></div>
						</div>
					</div>
					<div class="__btn_block">
						 <a class="btn-order" href="javascript:void(0)" @click="submit()" :class="[main_validate ? '' : 'disabled']">Оформить заказ</a>
					</div>
				</div>
			</div>
		</div>	
	

		<div v-if="active_step.id == 4" class="col-xs-12">
			<div class="__step_4">
				<div class="__title">
					Спасибо за покупку!
				</div>	
				<div class="__desc">
					Мы получили ваш заказ и позвоним в течение 5 минут в рабочее время
				</div>
				<div class="__time">
					Работаем с 9:00 до 21:00 по МСК, без выходных
				</div>
				<div class="__number">
					Номер вашего заказа: <span v-if="result != null && result.order != undefined" class="text-danger">№{{ result.order.ID }}</span>
				</div>
				<div class="__p">
					Полную информацию о заказе мы отправили на вашу почту
				</div>
			</div>
		</div>
	</template>
	
</div>

<div id="bx-soa-saved-files" style="display:none"></div>
<div id="bx-soa-soc-auth-services" style="display:none">
	<?
	$arServices = false;
	$arResult["ALLOW_SOCSERV_AUTHORIZATION"] = \Bitrix\Main\Config\Option::get("main", "allow_socserv_authorization", "Y") != "N" ? "Y" : "N";
	$arResult["FOR_INTRANET"] = false;

	if (\Bitrix\Main\ModuleManager::isModuleInstalled("intranet") || \Bitrix\Main\ModuleManager::isModuleInstalled("rest"))
		$arResult["FOR_INTRANET"] = true;

	if (\Bitrix\Main\Loader::includeModule("socialservices") && $arResult["ALLOW_SOCSERV_AUTHORIZATION"] == 'Y')
	{
		$oAuthManager = new CSocServAuthManager();
		$arServices = $oAuthManager->GetActiveAuthServices(array(
			'BACKURL' => $this->arParams['~CURRENT_PAGE'],
			'FOR_INTRANET' => $arResult['FOR_INTRANET'],
		));

		if (!empty($arServices))
		{
			$APPLICATION->IncludeComponent("bitrix:socserv.auth.form", "flat",
				array(
					"AUTH_SERVICES" => $arServices,
					"AUTH_URL" => $arParams["~CURRENT_PAGE"],
					"POST" => $arResult["POST"],
				),
				$component,
				array("HIDE_ICONS" => "Y")
			);
		}
	}
	?>
</div>

<?
$signer = new \Bitrix\Main\Security\Sign\Signer;
$signedParams = $signer->sign(base64_encode(serialize($arParams)), 'sale.order.ajax');
$messages = \Bitrix\Main\Localization\Loc::loadLanguageFile(__FILE__);
?>

<?
	$citys = [];
    $db_vars = CSaleLocation::GetList(
        array(
                "SORT" => "ASC",
                "COUNTRY_NAME_LANG" => "ASC",
                "CITY_NAME_LANG" => "ASC"
            ),
        array("LID" => LANGUAGE_ID),
        false,
        false,
        array()
    );
   	while($vars = $db_vars->Fetch()){
      if(!empty($vars["CITY_NAME"])){
      	$citys[] = $vars["CITY_NAME"];
      }
    }
   	?>

<script type="text/javascript">

	var Parametrs = {
		result: <?=CUtil::PhpToJSObject($arResult['JS_DATA'])?>,
		locations: <?=CUtil::PhpToJSObject($arResult['LOCATIONS'])?>,
		params: <?=CUtil::PhpToJSObject($arParams)?>,
		signedParamsString: '<?=CUtil::JSEscape($signedParams)?>',
		siteID: '<?=CUtil::JSEscape(SITE_ID)?>',
		ajaxUrl: '<?=CUtil::JSEscape($this->__component->GetPath().'/ajax.php')?>',
		templateFolder: '<?=CUtil::JSEscape($templateFolder)?>',
		propertyValidation: true,
		showWarnings: true,
		pickUpMap: {
			defaultMapPosition: {
				lat: 55.76,
				lon: 37.64,
				zoom: 7
			},
			secureGeoLocation: false,
			geoLocationMaxTime: 5000,
			minToShowNearestBlock: 3,
			nearestPickUpsToShow: 3
		},
		propertyMap: {
			defaultMapPosition: {
				lat: 55.76,
				lon: 37.64,
				zoom: 7
			}
		},
		orderBlockId: 'bx-soa-order',
		authBlockId: 'bx-soa-auth',
		basketBlockId: 'bx-soa-basket',
		regionBlockId: 'bx-soa-region',
		paySystemBlockId: 'bx-soa-paysystem',
		deliveryBlockId: 'bx-soa-delivery',
		pickUpBlockId: 'bx-soa-pickup',
		propsBlockId: 'bx-soa-properties',
		totalBlockId: 'bx-soa-total',
		citys: <?=CUtil::PhpToJSObject($citys)?>
	};
</script>

<? endif ?>