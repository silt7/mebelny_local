<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(false);
__IncludeLang($_SERVER["DOCUMENT_ROOT"].$templateFolder."/lang/".LANGUAGE_ID."/template.php");

if (count($arResult['IDS']) > 0 && CModule::IncludeModule('sale'))
{
	$arItemsInCompare = array();
	foreach ($arResult['IDS'] as $ID)
	{
		if (isset(
			$_SESSION[$arParams["COMPARE_NAME"]][$arParams["IBLOCK_ID"]]["ITEMS"][$ID]
		))
			$arItemsInCompare[] = $ID;
	}

	$dbBasketItems = CSaleBasket::GetList(
		array(
			"ID" => "ASC"
		),
		array(
			"FUSER_ID" => CSaleBasket::GetBasketUserID(),
			"LID" => SITE_ID,
			"ORDER_ID" => "NULL",
			),
		false,
		false,
		array()
	);
	$arPageItems = array();
	$arPageItemsDelay = array();
	while ($arItem = $dbBasketItems->Fetch())
	{
		if (in_array($arItem['PRODUCT_ID'], $arResult['IDS']))
		{
			if($arItem["DELAY"] == "Y")
				$arPageItemsDelay[] = $arItem['PRODUCT_ID'];
			else
				$arPageItems[] = $arItem['PRODUCT_ID'];
		}
	}
	
	if (count($arPageItems) > 0 || count($arPageItemsDelay) > 0)
	{
		echo '<script type="text/javascript">$(function(){'."\r\n";
		foreach ($arPageItems as $id) 
		{
			echo "disableAddToCart('catalog_add2cart_link_".$id."', 'list', '<span>".GetMessage("CATALOG_IN_CART")."</span>');\r\n";
		}
		foreach ($arPageItemsDelay as $id) 
		{
			echo "disableAddToCart('catalog_add2cart_link_".$id."', 'list', '".GetMessage("CATALOG_IN_CART_DELAY")."');\r\n";
		}
		echo '})</script>';
	}
	
	if (count($arItemsInCompare) > 0)
	{
		echo '<script type="text/javascript">$(function(){'."\r\n";
		foreach ($arItemsInCompare as $id) 
		{
			echo "disableAddToCompare('catalog_add2compare_link_".$id."', '".GetMessage("CATALOG_IN_COMPARE")."');\r\n";
		}
		echo '})</script>';
	}
}

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
/* Меняем отображение сердечка товара */
foreach($arFavorites as $k => $favoriteItem){?>
    <script>
        $(document).ready(function() {
            id = "<?=$favoriteItem?>";
            $('.addFav[data-id="'+id+'"]').find('i').addClass('active');
        });
    </script>
<?}?>