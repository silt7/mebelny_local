<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();


//404 на разделы в которы нет товаров
use Bitrix\Main\Application;

if ($arResult['COUNT'] == 0){
    define("ERROR_404","Y");
}; 

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
?>
<?foreach($arFavorites as $k => $favoriteItem){?>
    <script>
            id = "<?=$favoriteItem?>";
            $('.like_btn[data-id="'+id+'"]').addClass('active');
    </script>
<?}?>

<?if(isset($_SESSION["CATALOG_COMPARE_LIST"][$arParams['IBLOCK_ID']]["ITEMS"])){
    foreach($_SESSION["CATALOG_COMPARE_LIST"][$arParams['IBLOCK_ID']]["ITEMS"] as $k => $v){?>
        <script>
            id = "<?= $k?>";
            $('.compare_btn[data-id="'+id+'"]').addClass('active');
        </script>
        
    <?}
}?>
