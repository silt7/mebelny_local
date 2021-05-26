<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
$this->setFrameMode(false);

global $APPLICATION;

if(isset($_SESSION["CATALOG_COMPARE_LIST"][$arResult['IBLOCK_ID']]["ITEMS"][$arResult['ID']])){?>
    <script>
      id = "<?=$arResult['ID']?>";
      $('.products__add_compare[data-id="'+id+'"]').addClass('active');
      $('.products__add_compare[data-id="'+id+'"]').find('span').text('Удалить из сравнения');
    </script>
<?}
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
/* Меняем отображение сердечка товара */?>
<?foreach($arFavorites as $k => $favoriteItem){?>
    <script>
            id = "<?=$favoriteItem?>";
            $('.add-product .addFav[data-id="'+id+'"]').closest('.add_favorites ').addClass('active');
            $('.add-product .addFav[data-id="'+id+'"]').text('Убрать из избранного');
            $('.addFav[data-id="'+id+'"]').find('i').addClass('active');
            $('.products__add_cart[data-id="'+id+'"]').addClass('active');
    </script>
<?}?>

<div style="display:none">
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
            "LINK_TOV" => $_SERVER['REQUEST_URI'],
        )
    );?>
</div>
</div>
<div style="display:none">
<div id="review-block-epilog">
 <? 
 $APPLICATION->IncludeComponent(
    "askaron:askaron.reviews.for.element",
    "element",
    array(
        "ELEMENT_ID" => $arResult['ID'],
        "CACHE_TYPE" => "N",
        "CACHE_TIME" => "0",
        "PAGE_ELEMENT_COUNT" => "50",
        "AJAX_MODE" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "AJAX_OPTION_HISTORY" => "N",
        "PAGER_TEMPLATE" => "visual",
        "DISPLAY_BOTTOM_PAGER" => "Y",
        "COMPONENT_TEMPLATE" => ".default",
        "NEW_REVIEW_FORM" => "Y",
        "AJAX_OPTION_ADDITIONAL" => "undefined"
    ),
    false
);?>
</div>
</div>