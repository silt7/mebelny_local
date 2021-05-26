<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
use Bitrix\Main\Application;
$request = Application::getInstance()->getContext()->getRequest();
if(($request->isAjaxRequest() == 1) && !empty($request->getPost('id'))){
    $fields = [
        'PRODUCT_ID' => $request->getPost('id'), // ID товара, обязательно
        'QUANTITY' => 1, // количество, обязательно
    ];
    $basketResult = Bitrix\Catalog\Product\Basket::addProduct($fields);
    if ($basketResult->isSuccess())
    {
        $basket = \Bitrix\Sale\Basket::loadItemsForFUser(
            \Bitrix\Sale\Fuser::getId(), 
            \Bitrix\Main\Context::getCurrent()->getSite()
        );
    }
    
    $APPLICATION->RestartBuffer();
    $result = count($basket->getQuantityList()).' тов., '.number_format($basket->getPrice(), 0, ',', ' ').' руб.';
    echo $result;
    die(); 
}
