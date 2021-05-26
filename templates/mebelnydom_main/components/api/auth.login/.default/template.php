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
                        
	<div id="api_auth_login_<?=$arResult['FORM_ID']?>" class="api_auth_login" data-css="<?=$dataCss?>" data-js="<?=$dataJs?>">
		<form id="api_auth_login_form_<?=$arResult['FORM_ID']?>"
		      name="api_auth_login_form_<?=$arResult['FORM_ID']?>"
		      method="post"
		      class="api_form">
			<div class="api_error"></div>
			<div class="api_row">
				<input type="text" name="LOGIN" value="" maxlength="50" class="api_field" placeholder="<?=$arResult['LOGIN_PLACEHOLDER']?>">
			</div>
			<div class="api_row">
				<input type="password" name="PASSWORD" value="" maxlength="50" autocomplete="off" class="api_field" placeholder="<?=$arResult['PASSWORD_PLACEHOLDER']?>">
				<? if($arResult["SECURE_AUTH"]): ?>
					<div class="api_password_protected">
						<div class="api_password_protected_desc"><span></span><?=Loc::getMessage('API_AUTH_LOGIN_SECURE_NOTE')?>
						</div>
					</div>
				<? endif ?>
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
				<button type="button" class="api_button api_button_primary api_button_large api_button_wait api_width_1_1"><?=Loc::getMessage('API_AUTH_LOGIN_BUTTON')?></button>
			</div>
			<div class="api_row api_grid api_grid_width_1_2">
				<div>
					<a class="api_link api_auth_restore_url"
					   href="<?=$arParams['RESTORE_URL']?>"
					   data-header="<?=CUtil::JSEscape($arParams['RESTORE_MESS_HEADER'])?>"><?=Loc::getMessage('API_AUTH_LOGIN_RESTORE_URL')?></a>
				</div>
				<div class="api_text_right">
					<a class="api_link api_auth_register_url"
					   href="<?=$arParams['REGISTER_URL']?>"
					   data-header="<?=CUtil::JSEscape($arParams['REGISTER_MESS_HEADER'])?>"><?=Loc::getMessage('API_AUTH_LOGIN_REGISTER_URL')?></a>
				</div>
			</div>
		</form>
		<? if($arResult['AUTH_SERVICES']): ?>
			<div class="api_soc_auth api_text_center">
				<div class="api_soc_auth_title"><?=Loc::getMessage('API_SOC_AUTH_TITLE')?></div>
				<?
				$APPLICATION->IncludeComponent(
					 'bitrix:socserv.auth.form',
					 'login',
					 array(
							'AUTH_SERVICES' => $arResult['AUTH_SERVICES'],
							'AUTH_URL'      => $arResult['AUTH_URL'],
							'POST'          => $arResult['POST'],
							'POPUP'         => 'Y',
					 ),
					 false,
					 array('HIDE_ICONS' => 'Y')
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
			$.fn.apiAuthLogin({
				wrapperId: '#api_auth_login_<?=$arResult['FORM_ID']?>',
				formId: '#api_auth_login_form_<?=$arResult['FORM_ID']?>',
				secureAuth: <?=($arResult["SECURE_AUTH"] ? 'true' : 'false')?>,
				secureData: <?=Json::encode($arResult['SECURE_DATA'])?>,
				messLogin: '<?=$arResult['LOGIN_PLACEHOLDER']?>',
				messSuccess: '<?=CUtil::JSEscape($arParams['~LOGIN_MESS_SUCCESS'])?>',
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