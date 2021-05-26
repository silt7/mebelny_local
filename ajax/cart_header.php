<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

CModule::IncludeModule('catalog');
CModule::IncludeModule("sale"); 

$APPLICATION->IncludeComponent(
                            "bitrix:sale.basket.basket.small",
                            "template1",
                            Array(
                                "PATH_TO_BASKET" => "/personal/cart/",
                                "PATH_TO_ORDER" => "/personal/order/make/"
                            )
                      );