<?
if (CModule::IncludeModule("sale"))
{
    $count = 0;
    $arBasketItems = array();
    $dbBasketItems = CSaleBasket::GetList(
                  array("NAME" => "ASC","ID" => "ASC"),
                  array("FUSER_ID" => CSaleBasket::GetBasketUserID(), "LID" => SITE_ID, "ORDER_ID" => "NULL"),
                  false,
                  false,
                  array("ID","MODULE","PRODUCT_ID","QUANTITY","CAN_BUY","PRICE"));
    while ($arItems=$dbBasketItems->Fetch())
    {
      $arItems=CSaleBasket::GetByID($arItems["ID"]);
      $arBasketItems[]=$arItems;   
      $cart_num+=$arItems['QUANTITY'];
      $cart_sum+=$arItems['PRICE']*$arItems['QUANTITY'];
      $count++;
    }
    if (empty($cart_num))
      $cart_num="0";
    if (empty($cart_sum))
      $cart_sum="0";
    $arResult['cart_num'] = $count;
    $arResult['cart_sum'] = number_format($cart_sum, 0, '', ' ');
   
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
    if($arFavorites){
        $arResult['favorites'] = count($arFavorites);
    }else{
        $arResult['favorites'] = 0;
    }
}
