<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
$this->setFrameMode(false);

global $APPLICATION;
$arFavorites = array();
if(!$USER->IsAuthorized())
{
    $arFavorites = unserialize($_COOKIE["favorites"]);
    //print_r($arFavorites);
}
else {
    $idUser = $USER->GetID();
    $rsUser = CUser::GetByID($idUser);
    $arUser = $rsUser->Fetch();
    $arFavorites = $arUser['UF_FAVORITES'];  // Достаём избранное пользователя
}
count($arFavorites);
/* Меняем отображение сердечка товара */?>
<!--    <script>-->
<!--        alert(12)-->
<!--    </script>-->
<?foreach($arFavorites as $k => $favoriteItem){?>
    <script>
        // alert(1);
            id = "<?=$favoriteItem?>";
            $('.add-product .addFav[data-id="'+id+'"]').closest('.add_favorites ').addClass('active');
            $('.add-product .addFav[data-id="'+id+'"]').text('Убрать из избранного');
            $('.addFav[data-id="'+id+'"]').find('i').addClass('active');
    </script>
<?}?>

<div id="lowcost-form-epilog">
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

