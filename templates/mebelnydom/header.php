<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();

use \Bitrix\Main\Loader;
use \Bitrix\Main\Page\Asset;
use \Bitrix\Main\Application;
use \Bitrix\Main\Localization\Loc;
use \Bitrix\Main\Context; 

$request = Application::getInstance()->getContext()->getRequest();

$isMain = ($APPLICATION->GetCurPage(true) == SITE_DIR.'index.php') ? 'Y' : 'N';
$isCatalog = (strpos($APPLICATION->GetCurPage(true), SITE_DIR.'catalog/') === false) ? 'N' : 'Y';
$isPersonal = (strpos($APPLICATION->GetCurPage(true), SITE_DIR.'personal/') === false) ? 'N' : 'Y';
$isAuth = (strpos($APPLICATION->GetCurPage(true), SITE_DIR.'auth/') === false) ? 'N' : 'Y';

global $isAjax;
$xFancybox = $request->getQuery('x-fancybox');
$isAjax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) && isset($xFancybox) || (isset($_REQUEST['AJAX_CALL']) && 'Y' == $_REQUEST['AJAX_CALL']);

CJSCore::Init(array('jquery2', 'ajax'));
$asset = Asset::getInstance();

$asset->addCss(SITE_TEMPLATE_PATH.'/libs/reset-css/reset.css');
$asset->addCss(SITE_TEMPLATE_PATH.'/libs/font-awesome/css/font-awesome.min.css');
$asset->addCss(SITE_TEMPLATE_PATH.'/libs/slick-carousel/slick/slick-theme.css');
$asset->addCss(SITE_TEMPLATE_PATH.'/libs/slick-carousel/slick/slick.css');
$asset->addCss(SITE_TEMPLATE_PATH.'/node_modules/select2/dist/css/select2.min.css');
$asset->addCss(SITE_TEMPLATE_PATH.'/static/css/index.css');
$asset->addCss(SITE_TEMPLATE_PATH.'/libs/lightbox/css/lightbox.css');
$asset->addCss(SITE_TEMPLATE_PATH.'/static/css/styles.css');

$asset->addJs(SITE_TEMPLATE_PATH.'/node_modules/select2/dist/js/select2.full.min.js');
$asset->addJs(SITE_TEMPLATE_PATH.'/libs/slick-carousel/slick/slick.min.js');
$asset->addJs(SITE_TEMPLATE_PATH.'/src/js/index.js');
$asset->addJs(SITE_TEMPLATE_PATH.'/src/js/main.js');
$asset->addJs(SITE_TEMPLATE_PATH.'/src/js/script.js');
$asset->addJs(SITE_TEMPLATE_PATH.'/static/js/boots-plugins.js');
$asset->addJs(SITE_TEMPLATE_PATH.'/static/js/newmain.js');
$asset->addJs(SITE_TEMPLATE_PATH.'/libs/lightbox/js/lightbox.js');
$asset->addJs(SITE_TEMPLATE_PATH.'/static/js/counter.js');

// Новое меню
$asset->addCss(SITE_TEMPLATE_PATH.'/menu/style.css');
$asset->addJs(SITE_TEMPLATE_PATH.'/menu/menu.js');

$COMPARE_LIST = array();
if (isset($_SESSION['CATALOG_COMPARE_LIST']) && isset($_SESSION['CATALOG_COMPARE_LIST'][2]) && isset($_SESSION['CATALOG_COMPARE_LIST'][2]['ITEMS'])) {
	foreach ($_SESSION['CATALOG_COMPARE_LIST'][2]['ITEMS'] as $v) {
		$COMPARE_LIST[$v['ID']] = $v['ID'];
	}
}
$asset->addString('<script data-skip-moving="true">var COMPARE_LIST_COUNT = [' . implode(',', $COMPARE_LIST) . ']</script>');

// BEGIN: Корзина
CModule::IncludeModule('sale');
$dbBasketItems = CSaleBasket::GetList(array(), array("FUSER_ID" => CSaleBasket::GetBasketUserID(),"LID" => SITE_ID,"ORDER_ID" => "NULL"), false, false, array("ID", "PRODUCT_ID"));
while ($arItems = $dbBasketItems->Fetch()) $ID_PROD[] = $arItems['PRODUCT_ID'];
$APPLICATION->AddHeadString('<script data-skip-moving="true">var BASKET_ITEMS = [' . implode(',', $ID_PROD) . '];function in_array_basket(ID) { var found = false; for (var i in BASKET_ITEMS) { if (BASKET_ITEMS[i] == ID) { found = true; break; } } return found; }</script>',true);
// END: Корзина

if(isset($_GET['bxajaxid'])){
   $request = Context::getCurrent()->getRequest();
   if($request->isAjaxRequest() !== true){
        $uri = explode('?', $_SERVER['REQUEST_URI'], 2);
        header('Location: '.$uri[0]);
        exit;    
   }
}
if(isset($_GET['PAGEN_2'])){
    $APPLICATION->AddHeadString('<meta name="robots" content="noindex">');
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta name="yandex-verification" content="5f03a673f5fa8f27" />
	<meta name="google-site-verification" content="y3JuyXJ9IrFc8ub2fV_M3sR8ya-c1RXwJIqCiMMpViM" />
    <?php $APPLICATION->ShowHead(); ?>
    <title><?php $APPLICATION->ShowTitle(); ?></title>
	<?if($_GET['SIZEN_1'] || $_GET['SIZEN_2']):?>
		<meta name='robots' content='noindex,nofollow'>
	<?else:?>
		<link rel="canonical" href="https://mebelny-dom.com<?php echo $APPLICATION->GetCurPage();?>"/>
	<?endif?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<?if($_REQUEST["server"]){
echo"<PRE>"; print_r("НОВЫЙ САЙТ"); echo"</PRE>";
}?>
<? if ($APPLICATION->GetCurDir() != "/compare/") { ?>
    <div id="compare_mini_list"><? $APPLICATION->IncludeComponent(
	"bitrix:catalog.compare.list", 
	".default", 
	array(
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
		"PRODUCT_ID_VARIABLE" => "id",
		"COMPONENT_TEMPLATE" => ".default",
		"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);?></div>
<? } ?>
    <?$APPLICATION->IncludeComponent(
    	"mebelny:header",
    	"",
    	Array(
    		"ADD_SECTIONS_CHAIN" => "N",
    		"CACHE_GROUPS" => "Y",
    		"CACHE_TIME" => "36000000",
    		"CACHE_TYPE" => "A"
    	)
    );?>


    <? if($isMain == "Y") { ?>
	
    <div class="content">
        <div class="container">
			<!--noindex-->
            	<div class="banner">
                    <? $APPLICATION->IncludeComponent(
						"bitrix:news.list", 
						"gopro_banners", 
						array(
							"RSGOPRO_LINK" => "LINK",
							"RSGOPRO_ALONE" => "ALONE",
							"RSGOPRO_BLANK" => "BLANK",
							"RSGOPRO_TITLE1" => "TITLE1",
							"RSGOPRO_TITLE2" => "TITLE2",
							"RSGOPRO_TEXT" => "TEXT",
							"RSGOPRO_CHANGE_SPEED" => "2000",
							"RSGOPRO_CHANGE_DELAY" => "8000000",
							"RSGOPRO_BANNER_HEIGHT" => "",
							"AJAX_MODE" => "N",
							"IBLOCK_TYPE" => "presscenter",
							"IBLOCK_ID" => "42",
							"NEWS_COUNT" => "20",
							"SORT_BY1" => "SORT",
							"SORT_ORDER1" => "ASC",
							"SORT_BY2" => "TIMESTAMP_X",
							"SORT_ORDER2" => "ASC",
							"FILTER_NAME" => "",
							"FIELD_CODE" => array(
								0 => "ID",
								1 => "CODE",
								2 => "XML_ID",
								3 => "NAME",
								4 => "TAGS",
								5 => "SORT",
								6 => "PREVIEW_TEXT",
								7 => "PREVIEW_PICTURE",
								8 => "DETAIL_TEXT",
								9 => "DETAIL_PICTURE",
								10 => "DATE_ACTIVE_FROM",
								11 => "ACTIVE_FROM",
								12 => "DATE_ACTIVE_TO",
								13 => "ACTIVE_TO",
								14 => "SHOW_COUNTER",
								15 => "SHOW_COUNTER_START",
								16 => "IBLOCK_TYPE_ID",
								17 => "IBLOCK_ID",
								18 => "IBLOCK_CODE",
								19 => "IBLOCK_NAME",
								20 => "IBLOCK_EXTERNAL_ID",
								21 => "DATE_CREATE",
								22 => "CREATED_BY",
								23 => "CREATED_USER_NAME",
								24 => "TIMESTAMP_X",
								25 => "MODIFIED_BY",
								26 => "USER_NAME",
								27 => "",
							),
							"PROPERTY_CODE" => array(
								0 => "LINK",
								1 => "BANNER_TYPE",
								2 => "BLANK",
								3 => "TITLE1",
								4 => "TITLE2",
								5 => "TEXT",
								6 => "",
							),
							"CHECK_DATES" => "Y",
							"DETAIL_URL" => "",
							"PREVIEW_TRUNCATE_LEN" => "",
							"ACTIVE_DATE_FORMAT" => "d.m.Y",
							"SET_TITLE" => "N",
							"SET_STATUS_404" => "N",
							"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
							"ADD_SECTIONS_CHAIN" => "Y",
							"HIDE_LINK_WHEN_NO_DETAIL" => "N",
							"PARENT_SECTION" => "1233",
							"PARENT_SECTION_CODE" => "",
							"INCLUDE_SUBSECTIONS" => "Y",
							"CACHE_TYPE" => "A",
							"CACHE_TIME" => "36000000",
							"CACHE_FILTER" => "N",
							"CACHE_GROUPS" => "Y",
							"PAGER_TEMPLATE" => ".default",
							"DISPLAY_TOP_PAGER" => "N",
							"DISPLAY_BOTTOM_PAGER" => "Y",
							"PAGER_TITLE" => "Новости",
							"PAGER_SHOW_ALWAYS" => "Y",
							"PAGER_DESC_NUMBERING" => "N",
							"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
							"PAGER_SHOW_ALL" => "Y",
							"AJAX_OPTION_JUMP" => "N",
							"AJAX_OPTION_STYLE" => "Y",
							"AJAX_OPTION_HISTORY" => "N",
							"RSGOPRO_BANNER_TYPE" => "BANNER_TYPE",
							"AJAX_OPTION_ADDITIONAL" => "",
							"RSGOPRO_BANNER_VIDEO_MP4" => "VIDEO_MP4",
							"RSGOPRO_BANNER_VIDEO_WEBM" => "VIDEO_WEBM",
							"RSGOPRO_BANNER_VIDEO_PIC" => "VIDEO_PIC",
							"COMPONENT_TEMPLATE" => "gopro_banners",
							"SET_BROWSER_TITLE" => "N",
							"SET_META_KEYWORDS" => "N",
							"SET_META_DESCRIPTION" => "N",
							"SET_LAST_MODIFIED" => "N",
							"RSGOPRO_PRICE" => "-",
							"PAGER_BASE_LINK_ENABLE" => "N",
							"SHOW_404" => "N",
							"MESSAGE_404" => "",
							"RSGOPRO_PROP_LINE1" => "TITLE1",
							"RSGOPRO_PROP_LINE2" => "TITLE2",
							"RSGOPRO_PROP_LINE3" => "TEXT",
							"STRICT_SECTION_CHECK" => "N",
							"COMPOSITE_FRAME_MODE" => "A",
							"COMPOSITE_FRAME_TYPE" => "AUTO"
						),
						false
					);?> 

                	<div class="banner-right">
						<?
						$arSelect = Array("ID", "NAME", "PROPERTY_LINK","PREVIEW_PICTURE");
						$arFilter = Array("IBLOCK_ID"=>"42", "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", "SECTION_ID" => "1231");
						$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("ntopCount"=>1), $arSelect);
						if(intval($res->SelectedRowsCount())>0) {
						while($ob = $res->GetNextElement())
						{
						$arFields = $ob->GetFields();
						?>
							<div onclick="return location.href = '<?=$arFields["PROPERTY_LINK_VALUE"]?>'" class="delivery block-none" style="background-image:url('<?=CFile::GetPath($arFields["PREVIEW_PICTURE"])?>'); cursor:pointer;">
								<div class="h2"><?=$arFields["NAME"]?></div>
							</div>

						<? } ?>
						<? } else { ?>
							<div class="delivery block-none">
								<div class="h2">Доставка по всей<br><span>России</span></div>
							</div>
						<? } ?> 
						<div class="imgertising">
						<?
						$arSelect = Array("ID", "NAME", "PROPERTY_LINK","PREVIEW_PICTURE");
						$arFilter = Array("IBLOCK_ID"=>"42", "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", "SECTION_ID" => "1232");
						$res = CIBlockElement::GetList(Array("SORT" => "ASC"), $arFilter, false, Array("nTopCount"=>3), $arSelect);
						if(intval($res->SelectedRowsCount())>0) {
							while($ob = $res->GetNextElement())
							{
							$arFields = $ob->GetFields();
							?>
								<div class="imgertising-block" style="background-image:url('<?=CFile::GetPath($arFields["PREVIEW_PICTURE"])?>');">
									<p><?=$arFields["NAME"]?></p>
									<a href="<?=$arFields["PROPERTY_LINK_VALUE"]?>"></a>
								</div>
							<? } ?>
						<? } else {?>
								<div class="imgertising-block imgertising-block_1">
									<p>Оплата картами и наличными</p>
									<a href="/oplata/"></a>
								</div>
								<div class="imgertising-block imgertising-block_2">
									<p>Гарантия на товары до 36 месяцев</p>
									<a href="/garantii/"></a>
								</div>
								<div class="imgertising-block imgertising-block_3">
									<p>Быстрое оформление заказа и отгрузка</p>
									<a href="/dostavka/"></a>
								</div>
						<? } ?>                    
                    </div>      
                </div>
        	</div>	
		<!--/noindex-->
       <? } ?>      


