<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();
use \Bitrix\Main\Page\Asset;
use \Bitrix\Main\Context; 

$asset = Asset::getInstance();
$asset->addCss(SITE_TEMPLATE_PATH.'/libs/font-awesome/css/font-awesome.min.css');

$asset->addCss(SITE_TEMPLATE_PATH.'/libs/lightbox/css/lightbox.css');
$asset->addJs(SITE_TEMPLATE_PATH.'/libs/lightbox/js/lightbox.js');
CJSCore::Init(array('jquery2', 'ajax'));

if(isset($_GET['bxajaxid'])){
   if($_REQUEST['AJAX_CALL']!='Y'){
        $uri = explode('?', $_SERVER['REQUEST_URI'], 2);
        header('Location: '.$uri[0]);
        exit;    
   }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta name="yandex-verification" content="5f03a673f5fa8f27" />
	<meta name="google-site-verification" content="y3JuyXJ9IrFc8ub2fV_M3sR8ya-c1RXwJIqCiMMpViM" />
	<title><?php $APPLICATION->ShowTitle(); ?></title>
	<?if($_GET['SIZEN_1'] || $_GET['SIZEN_2'] || $_GET['PAGEN_2']):?>
		<meta name='robots' content='noindex,nofollow'>
	<?else:?>
		<link rel="canonical" href="https://mebelny-dom.com<?php echo $APPLICATION->GetCurPage();?>"/>
	<?endif?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?if (stripos(@$_SERVER['HTTP_USER_AGENT'], 'Lighthouse') === false){
    	$APPLICATION->ShowHead();
    } else {
        $APPLICATION->ShowCSS();
    	$APPLICATION->ShowMeta("keywords");
    	$APPLICATION->ShowMeta("description");
    }?>
</head>
<body>
<?$APPLICATION->IncludeComponent(
	"mebelny:header",
	"",
	Array(
		"ADD_SECTIONS_CHAIN" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A"
	)
)?>
