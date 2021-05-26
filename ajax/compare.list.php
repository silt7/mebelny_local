<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php"); ?>
<? $APPLICATION->IncludeComponent("bitrix:catalog.compare.list","",
    Array(
            "AJAX_MODE" => "Y",
            "IBLOCK_TYPE" => "catalog",
            "IBLOCK_ID" => "2",
            "POSITION_FIXED" => "Y",
            "POSITION" => "bottom right",
            "DETAIL_URL" => "",
            "COMPARE_URL" => "/compare/",
            "NAME" => "CATALOG_COMPARE_LIST",
            "AJAX_OPTION_JUMP" => "N",
            "AJAX_OPTION_STYLE" => "Y",
            "AJAX_OPTION_HISTORY" => "N",
            "ACTION_VARIABLE" => "action",
            "PRODUCT_ID_VARIABLE" => "id"
        )
);?>