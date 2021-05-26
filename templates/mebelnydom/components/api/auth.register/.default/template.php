<?php
use Bitrix\Main\Web\Json,
	 Bitrix\Main\Page\Asset,
	 Bitrix\Main\Page\AssetLocation,
	 Bitrix\Main\Localization\Loc;

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

/**
 * Bitrix vars
 *
 * @var CBitrixComponentTemplate $this
 * @var ApiQaList                $component
 *
 * @var array                    $arParams
 * @var array                    $arResult
 *
 * @var string                   $templateName
 * @var string                   $templateFile
 * @var string                   $templateFolder
 * @var array                    $templateData
 *
 * @var string                   $componentPath
 * @var string                   $parentTemplateFolder
 *
 * @var CDatabase                $DB
 * @var CUser                    $USER
 * @var CMain                    $APPLICATION
 */

Loc::loadMessages(__FILE__);

if(method_exists($this, 'setFrameMode'))
	$this->setFrameMode(true);

$dataCss = $templateFolder . '/styles.css';
$dataJs  = $templateFolder . '/scripts.js';

$this->addExternalCss($dataCss);
$this->addExternalJs($dataJs);

?>
	<div id="api_auth_register_<?=$arResult['FORM_ID']?>" class="api_auth_register" data-css="<?=$dataCss?>" data-js="<?=$dataJs?>">
		<form id="api_auth_register_form_<?=$arResult['FORM_ID']?>"
		      name="api_auth_register_form_<?=$arResult['FORM_ID']?>"
		      method="post"
		      class="api_form">
			<div class="api_error"></div>

			<? if($arResult['GROUP_ID']): ?>
				<div class="api_row">
					<div class="api_controls">
						<div class="api_label"><?=Loc::getMessage('REGISTER_FIELD_GROUP_ID')?></div>
						<? foreach($arResult['GROUP_ID'] as $groupId => $groupName): ?>
							<label class="api_label_inline">
								<input type="radio" class="api_radio" name="FIELDS[GROUP_ID][]" value="<?=$groupId?>"> <?=$groupName?>&nbsp;
							</label>
						<? endforeach ?>
					</div>
				</div>
			<? endif ?>

			<? if($arParams['SHOW_FIELDS']): ?>
				<? foreach($arParams["SHOW_FIELDS"] as $FIELD): ?>
					<? $placeholder = Loc::getMessage('REGISTER_FIELD_' . $FIELD) . (in_array($FIELD, $arParams["REQUIRED_FIELDS"]) ? ' *' : '') ?>
					<? if($FIELD == "AUTO_TIME_ZONE" && $arResult["TIME_ZONE_ENABLED"] == true): ?>
						<tr>
							<td><?=Loc::getMessage("main_profile_time_zones_auto")?><? if($arResult["REQUIRED_FIELDS_FLAGS"][ $FIELD ] == "Y"): ?>
									<span class="starrequired">*</span><? endif ?></td>
							<td>
								<select name="FIELDS[AUTO_TIME_ZONE]" onchange="this.form.elements['FIELDS[TIME_ZONE]'].disabled=(this.value != 'N')">
									<option value=""><? echo Loc::getMessage("main_profile_time_zones_auto_def") ?></option>
									<option value="Y"<?=$arResult["VALUES"][ $FIELD ] == "Y" ? " selected=\"selected\"" : ""?>><?=Loc::getMessage("main_profile_time_zones_auto_yes")?></option>
									<option value="N"<?=$arResult["VALUES"][ $FIELD ] == "N" ? " selected=\"selected\"" : ""?>><?=Loc::getMessage("main_profile_time_zones_auto_no")?></option>
								</select>
							</td>
						</tr>
						<tr>
							<td><? echo Loc::getMessage("main_profile_time_zones_zones") ?></td>
							<td>
								<select name="FIELDS[TIME_ZONE]"<? if(!isset($_REQUEST["FIELDS"]["TIME_ZONE"]))
									echo 'disabled="disabled"' ?>>
									<? foreach($arResult["TIME_ZONE_LIST"] as $tz => $tz_name): ?>
										<option value="<?=htmlspecialcharsbx($tz)?>"<?=$arResult["VALUES"]["TIME_ZONE"] == $tz ? " selected=\"selected\"" : ""?>><?=htmlspecialcharsbx($tz_name)?></option>
									<? endforeach ?>
								</select>
							</td>
						</tr>
					<? else: ?>
						<div class="api_row">
							<div class="api_controls">
								<?
								switch($FIELD) {
									case "PASSWORD":
										?>
										<input type="password" name="FIELDS[<?=$FIELD?>]" value="<?=$arResult["VALUES"][ $FIELD ]?>" placeholder="<?=$placeholder?>" autocomplete="off" class="api_field">
										<? if($arResult["SECURE_AUTH"]): ?>
										<div class="api_password_protected">
											<div class="api_password_protected_desc"><span></span><?=Loc::getMessage('AUTH_SECURE_NOTE')?>
											</div>
										</div>
									<? endif ?>
										<?
										break;
									case "CONFIRM_PASSWORD":
										?>
										<input type="password" name="FIELDS[<?=$FIELD?>]" value="<?=$arResult["VALUES"][ $FIELD ]?>" autocomplete="off" placeholder="<?=$placeholder?>" class="api_field">
										<? if($arResult["SECURE_AUTH"]): ?>
										<div class="api_password_protected">
											<div class="api_password_protected_desc"><span></span><?=Loc::getMessage('AUTH_SECURE_NOTE')?>
											</div>
										</div>
									<? endif ?>
										<?
										break;

									case "PERSONAL_GENDER":
										?>
										<div class="api_label"><?=$placeholder?></div>
										<label class="api_label_inline">
											<input type="radio" class="api_radio" name="FIELDS[<?=$FIELD?>]" value="M"> <?=Loc::getMessage("REGISTER_USER_MALE")?>
										</label>
										<label class="api_label_inline">
											<input type="radio" class="api_radio" name="FIELDS[<?=$FIELD?>]" value="F"> <?=Loc::getMessage("REGISTER_USER_FEMALE")?>
										</label>
										<?
										break;

									case "PERSONAL_COUNTRY":
									case "WORK_COUNTRY":
										?>
										<?if(\Bitrix\Main\Loader::includeModule('sale')):?>
											<?
											CSaleLocation::proxySaleAjaxLocationsComponent(
												 array(
														"LOCATION_VALUE"  => "",
														"CITY_INPUT_NAME" => "FIELDS[$FIELD]",
														//"CODE"  => "",
														//"INPUT_NAME"  => "FIELDS[$FIELD]",
														"SITE_ID"         => SITE_ID,
												 ),
												 array(),
												 '',
												 true,
												 'api_location'
											);
											?>
										<?else:?>
											<select name="FIELDS[<?=$FIELD?>]" placeholder="<?=$placeholder?>" class="api_field">
												<? foreach($arResult["COUNTRIES"]["reference_id"] as $key => $value):?>
													<option value="<?=$value?>"<? if($value == $arResult["VALUES"][ $FIELD ]): ?> selected="selected"<? endif ?>><?=$arResult["COUNTRIES"]["reference"][ $key ]?></option>
												<?endforeach; ?>
											</select>
										<?endif?>
										<?
										break;

									case "PERSONAL_PHOTO":
									case "WORK_LOGO":
										?>
										<div class="api_label"><?=$placeholder?></div>
										<input size="30" type="file" name="REGISTER_FILES_<?=$FIELD?>" placeholder="<?=$placeholder?>" class="api_field"><?
										break;

									case "PERSONAL_NOTES":
									case "WORK_NOTES":
										?>
										<textarea cols="30" rows="5" name="FIELDS[<?=$FIELD?>]" placeholder="<?=$placeholder?>" class="api_field"><?=$arResult["VALUES"][ $FIELD ]?></textarea><?
										break;
									default:
										if($FIELD == "PERSONAL_BIRTHDAY"):?>
											<small><?=$arResult["DATE_FORMAT"]?></small><br/><?endif;
										?>
										<input type="text" name="FIELDS[<?=$FIELD?>]" value="<?=$arResult["VALUES"][ $FIELD ]?>" placeholder="<?=$placeholder?>" class="api_field"><?
										if($FIELD == "PERSONAL_BIRTHDAY")
											$APPLICATION->IncludeComponent(
												 'bitrix:main.calendar',
												 '',
												 array(
														'SHOW_INPUT' => 'N',
														'FORM_NAME'  => 'regform',
														'INPUT_NAME' => 'FIELDS[PERSONAL_BIRTHDAY]',
														'SHOW_TIME'  => 'N',
												 ),
												 null,
												 array("HIDE_ICONS" => "Y")
											);
										?><?
								} ?>
							</div>
						</div>
					<? endif ?>
				<? endforeach ?>
			<? endif ?>

			<? // ********************* User properties ***************************************************?>
			<? if($arResult["USER_PROPERTIES"]["SHOW"] == "Y"): ?>
				<tr>
					<td colspan="2"><?=strlen(trim($arParams["USER_PROPERTY_NAME"])) > 0 ? $arParams["USER_PROPERTY_NAME"] : GetMessage("USER_TYPE_EDIT_TAB")?></td>
				</tr>
				<? foreach($arResult["USER_PROPERTIES"]["DATA"] as $FIELD_NAME => $arUserField): ?>
					<tr>
						<td><?=$arUserField["EDIT_FORM_LABEL"]?>:<? if($arUserField["MANDATORY"] == "Y"): ?>
								<span class="starrequired">*</span><? endif; ?></td>
						<td>
							<? $APPLICATION->IncludeComponent(
								 "bitrix:system.field.edit",
								 $arUserField["USER_TYPE"]["USER_TYPE_ID"],
								 array("bVarsFromForm" => $arResult["bVarsFromForm"], "arUserField" => $arUserField, "form_name" => "regform"), null, array("HIDE_ICONS" => "Y")); ?></td>
					</tr>
				<? endforeach; ?>
			<? endif; ?>
			<? // ******************** /User properties ***************************************************?>

			<div class="api_row">
				<div class="api_req"><?=GetMessage("API_AUTH_REGISTER_REQ")?></div>
			</div>
			<? if($arParams['USE_PRIVACY'] == 'Y' && $arParams['MESS_PRIVACY']): ?>
				<div class="api_row api_privacy" style="display:none;">
					<input type="checkbox" name="PRIVACY_ACCEPTED" value="Y" class="api_field" <?=$arResult['PRIVACY_ACCEPTED'] == 'Y' ? ' checked' : ''?>>
					<? if($arParams['MESS_PRIVACY_LINK']): ?>
						<a href="<?=$arParams['~MESS_PRIVACY_LINK']?>" target="_blank"><?=$arParams['~MESS_PRIVACY']?></a>
					<? else: ?>
						<?=$arParams['~MESS_PRIVACY']?>
					<? endif ?>
				</div>
			<? endif ?>
			<div class="api_row">
				<button type="button" class="api_button api_button_primary api_button_large api_button_wait api_width_1_1"><?=Loc::getMessage('API_AUTH_REGISTER_BUTTON')?></button>
			</div>
			<? /* if($arResult["SECURE_AUTH"]): ?>
				<div class="api_password_protected">
					<div class="api_password_protected_desc"><span></span><?=Loc::Loc::getMessage('API_AUTH_LOGIN_SECURE_NOTE')?>
					</div>
				</div>
			<? endif */ ?>
			<div class="api_row api_grid api_grid_width_1_2">
				<div>
					<a class="api_link api_auth_register_url"
					   href="<?=$arParams['LOGIN_URL']?>"
					   data-header="<?=CUtil::JSEscape($arParams['~LOGIN_MESS_HEADER'])?>"><?=Loc::getMessage('API_AUTH_REGISTER_LOGIN_URL')?></a>
				</div>
				<div class="api_text_right">
					<a class="api_link api_auth_restore_url"
					   href="<?=$arParams['RESTORE_URL']?>"
					   data-header="<?=CUtil::JSEscape($arParams['~RESTORE_MESS_HEADER'])?>"><?=Loc::getMessage('API_AUTH_REGISTER_RESTORE_URL')?></a>
				</div>
			</div>
		</form>
		<? if($arResult['AUTH_SERVICES']): ?>
			<div class="api_soc_auth api_text_center">
				<div class="api_soc_auth_title"><?=Loc::getMessage('API_SOC_AUTH_TITLE')?></div>
				<?
				$APPLICATION->IncludeComponent(
					 "bitrix:socserv.auth.form",
					 "flat",
					 array(
							"AUTH_SERVICES" => $arResult["AUTH_SERVICES"],
							"AUTH_URL"      => $arResult["AUTH_URL"],
							"POST"          => $arResult["POST"],
							"POPUP"         => "Y",
					 ),
					 false,
					 array("HIDE_ICONS" => "Y")
				);
				?>
			</div>
		<? endif ?>
	</div>
<?
ob_start();
?>
	<script type="text/javascript">
		jQuery(document).ready(function ($) {
			$.fn.apiAuthRegister({
				wrapperId: '#api_auth_register_<?=$arResult['FORM_ID']?>',
				formId: '#api_auth_register_form_<?=$arResult['FORM_ID']?>',
				secureAuth: <?=($arResult["SECURE_AUTH"] ? 'true' : 'false')?>,
				secureData: <?=Json::encode($arResult['SECURE_DATA'])?>,
				REQUIRED_FIELDS: <?=Json::encode($arParams['REQUIRED_FIELDS'])?>,
				usePrivacy: '<?=$arParams['USE_PRIVACY'] == 'Y'?>',
				mess: {
					'PRIVACY_CONFIRM': '<?=CUtil::JSEscape($arParams['MESS_PRIVACY_CONFIRM'])?>',
				}
			});
		});
	</script>
<?
$script = ob_get_contents();
ob_end_clean();
Asset::getInstance()->addString($script, true, AssetLocation::AFTER_JS);
?>