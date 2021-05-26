<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

$this->setFrameMode(true);
?>



							<? $ElementID = $APPLICATION->IncludeComponent(
                                'bitrix:news.detail',
                                'brands',
                                Array(
                                    'DISPLAY_DATE'				=> $arParams['DISPLAY_DATE'],
                                    'DISPLAY_NAME'				=> $arParams['DISPLAY_NAME'],
                                    'DISPLAY_PICTURE'			=> $arParams['DISPLAY_PICTURE'],
                                    'DISPLAY_PREVIEW_TEXT'		=> $arParams['DISPLAY_PREVIEW_TEXT'],
                                    'IBLOCK_TYPE'				=> $arParams['IBLOCK_TYPE'],
                                    'IBLOCK_ID'					=> $arParams['IBLOCK_ID'],
                                    'FIELD_CODE'				=> $arParams['DETAIL_FIELD_CODE'],
                                    'PROPERTY_CODE'				=> $arParams['DETAIL_PROPERTY_CODE'],
                                    'DETAIL_URL'				=> $arResult['FOLDER'].$arResult['URL_TEMPLATES']['detail'],
                                    'SECTION_URL'				=> $arResult['FOLDER'].$arResult['URL_TEMPLATES']['section'],
                                    'META_KEYWORDS'				=> $arParams['META_KEYWORDS'],
                                    'META_DESCRIPTION'			=> $arParams['META_DESCRIPTION'],
                                    'BROWSER_TITLE'				=> $arParams['BROWSER_TITLE'],
                                    'DISPLAY_PANEL'				=> $arParams['DISPLAY_PANEL'],
                                    'SET_TITLE'					=> $arParams['SET_TITLE'],
                                    'SET_STATUS_404'			=> "N",//$arParams['SET_STATUS_404'],
                                    'INCLUDE_IBLOCK_INTO_CHAIN' => $arParams['INCLUDE_IBLOCK_INTO_CHAIN'],
                                    'ADD_SECTIONS_CHAIN'		=> $arParams['ADD_SECTIONS_CHAIN'],
                                    'ACTIVE_DATE_FORMAT'		=> $arParams['DETAIL_ACTIVE_DATE_FORMAT'],
                                    'CACHE_TYPE'				=> $arParams['CACHE_TYPE'],
                                    'CACHE_TIME'				=> $arParams['CACHE_TIME'],
                                    'CACHE_GROUPS'				=> $arParams['CACHE_GROUPS'],
                                    'USE_PERMISSIONS'			=> $arParams['USE_PERMISSIONS'],
                                    'GROUP_PERMISSIONS'			=> $arParams['GROUP_PERMISSIONS'],
                                    'DISPLAY_TOP_PAGER'			=> $arParams['DETAIL_DISPLAY_TOP_PAGER'],
                                    'DISPLAY_BOTTOM_PAGER'		=> $arParams['DETAIL_DISPLAY_BOTTOM_PAGER'],
                                    'PAGER_TITLE'				=> $arParams['DETAIL_PAGER_TITLE'],
                                    'PAGER_SHOW_ALWAYS'			=> 'N',
                                    'PAGER_TEMPLATE'			=> $arParams['DETAIL_PAGER_TEMPLATE'],
                                    'PAGER_SHOW_ALL'			=> $arParams['DETAIL_PAGER_SHOW_ALL'],
                                    'CHECK_DATES'				=> $arParams['CHECK_DATES'],
                                    'ELEMENT_ID'				=> $arResult['VARIABLES']['ELEMENT_ID'],
                                    'ELEMENT_CODE'				=> $arResult['VARIABLES']['ELEMENT_CODE'],
                                    'IBLOCK_URL'				=> $arResult['FOLDER'].$arResult['URL_TEMPLATES']['news'],
                                    'USE_SHARE' 				=> $arParams['USE_SHARE'],
                                    'SHARE_HIDE' 				=> $arParams['SHARE_HIDE'],
                                    'SHARE_TEMPLATE' 			=> $arParams['SHARE_TEMPLATE'],
                                    'SHARE_HANDLERS' 			=> $arParams['SHARE_HANDLERS'],
                                    'SHARE_SHORTEN_URL_LOGIN'	=> $arParams['SHARE_SHORTEN_URL_LOGIN'],
                                    'SHARE_SHORTEN_URL_KEY'		=> $arParams['SHARE_SHORTEN_URL_KEY'],
                                    'ADD_ELEMENT_CHAIN'			=> (isset($arParams['ADD_ELEMENT_CHAIN']) ? $arParams['ADD_ELEMENT_CHAIN'] : ''),
                                    'ADD_STYLES_FOR_MAIN'		=> $arParams['ADD_STYLES_FOR_MAIN'],
                                    'BRAND_CODE'				=> $arParams['BRAND_CODE'],
                                    'SECTIONS_CODE'				=> $arParams['SECTIONS_CODE'],
                                    'SHOW_BOTTOM_SECTIONS'		=> $arParams['SHOW_BOTTOM_SECTIONS'],
                                    'COUNT_ITEMS'				=>	$arParams['COUNT_ITEMS'],
                                    'CATALOG_FILTER_NAME'		=> $arParams['CATALOG_FILTER_NAME'],
                                    'CATALOG_IBLOCK_ID'			=> $arParams['CATALOG_IBLOCK_ID'],
                                    'CATALOG_BRAND_CODE'		=> $arParams['BRAND_CODE'],
                                    // custom
                                    'CATALOG_FILTER_NAME' => $arParams['CATALOG_FILTER_NAME'],
                                ),
                                $component
                            );?>




                    <div class="p-company__form-container">
                        <div class="p-company__form-top">
                            <div class="p-company__form-left">
                                <div class="p-company__form-title-pink">Выбирайте мебель с нами!</div>
                                <div class="p-company__form-desc">
                                    Оставьте заявку или свяжитесь с нами по телефону. Мы поможем выбрать подходящую мебель, оформим заказ и  доставку в удобное время.
                                </div>
                            </div>
                            <div class="p-company__form-right">
                                <div class="p-company__form-title-blue">менее 5 минут</div>
                                <div class="p-company__form-desc">
                                    нам необходимо чтобы ответить клиенту
                                </div>
                            </div>
                        </div>
						<? $strEmail = Coption::GetOptionString('main','email_from'); ?>
                        <? $APPLICATION->IncludeComponent(
	"altasib:feedback.form", 
	"brand", 
	array(
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
		"IBLOCK_ID" => "4",
		"IBLOCK_TYPE" => "d2mg_orderscall",
		"INPUT_APPEARENCE" => array(
			0 => "DEFAULT",
		),
		"JQUERY_EN" => "N",
		"LINK_SEND_MORE_TEXT" => "Отправить ещё одно сообщение",
		"LOCAL_REDIRECT_ENABLE" => "N",
		"MASKED_INPUT_PHONE" => array(
		),
		"MESSAGE_OK" => "Ваше сообщение было успешно отправлено",
		"NAME_ELEMENT" => "NAME",
		"NOT_CAPTCHA_AUTH" => "Y",
		"PROPERTY_FIELDS" => array(
			0 => "PHONE",
			1 => "NAME",
		),
		"PROPERTY_FIELDS_REQUIRED" => array(
			0 => "PHONE",
			1 => "NAME",
		),
		"PROPS_AUTOCOMPLETE_EMAIL" => array(
		),
		"PROPS_AUTOCOMPLETE_NAME" => array(
		),
		"PROPS_AUTOCOMPLETE_PERSONAL_PHONE" => array(
		),
		"PROPS_AUTOCOMPLETE_VETO" => "N",
		"SECTION_FIELDS_ENABLE" => "N",
		"SECTION_MAIL_ALL" => $strEmail,
		"SEND_IMMEDIATE" => "Y",
		"SEND_MAIL" => "N",
		"SHOW_LINK_TO_SEND_MORE" => "Y",
		"SHOW_MESSAGE_LINK" => "N",
		"USERMAIL_FROM" => "N",
		"USER_CONSENT" => "N",
		"USER_CONSENT_ID" => "0",
		"USER_CONSENT_INPUT_LABEL" => "",
		"USER_CONSENT_IS_CHECKED" => "Y",
		"USER_CONSENT_IS_LOADED" => "N",
		"USE_CAPTCHA" => "N",
		"WIDTH_FORM" => "50%",
		"COMPONENT_TEMPLATE" => "brand",
		"USER_EVENT" => "ALX_FEEDBACK_FORM_SEND_MAIL"
	),
	false
);?>
                        <? /*$APPLICATION->IncludeComponent(
                            "bitrix:form.result.new",
                            "fabrika",
                            Array(
                                "CACHE_TIME" => "3600",
								"AJAX_OPTION_ADDITIONAL" => "INLINEBRAND",
                                "CACHE_TYPE" => "N",
								"AJAX_MODE" => "Y",
								"AJAX_OPTION_JUMP" => "N", 
								"AJAX_OPTION_STYLE" => "N", 
								"AJAX_OPTION_HISTORY" => "N", 
                                "CHAIN_ITEM_LINK" => "",
                                "CHAIN_ITEM_TEXT" => "",
                                "EDIT_URL" => "",
                                "IGNORE_CUSTOM_TEMPLATE" => "N",
                                "LIST_URL" => "",
                                "SUCCESS_URL" => "",
                                "SEF_MODE" => "N",
                                "SEF_FOLDER" => $APPLICATION->GetCurPage(false),
                                "USE_EXTENDED_ERRORS" => "N",
                                "VARIABLE_ALIASES" => Array(
                                    "RESULT_ID" => "RESULT_ID",
                                    "WEB_FORM_ID" => "WEB_FORM_ID"
                                ),
                                "WEB_FORM_ID" => "3"
                            )
                        ); */?>
                    </div>
                </div>
            </div>
        </div>
    
 
<? //if($USER->IsAdmin()) {echo '<pre>'; print_r($arResult); echo '</pre>';} ?>