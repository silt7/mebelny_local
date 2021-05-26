<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();

    use \Bitrix\Main\Page\Asset;
    use \Bitrix\Main\Application;

    $request = Application::getInstance()->getContext()->getRequest();

//global $isAjax;
//$xFancybox = $request->getQuery('x-fancybox');
//$isAjax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) && isset($xFancybox) || (isset($_POST['AJAX_CALL']) && 'Y' == $_POST['AJAX_CALL']);
    CJSCore::Init(array('jquery2', 'ajax'));

    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH.'/static/css/reset.css');
	  Asset::getInstance()->addCss(SITE_TEMPLATE_PATH.'/static/css/index.css');
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH.'/static/css/styles.css');
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH.'/static/css/template_styles.css');
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH.'/static/css/style.css');
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH.'/static/css/swiper-bundle.css');
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH.'/static/css/critical.css');
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH.'/static/css/front-style.css');
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH.'/static/css/front-style.css');

    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH.'/static/js/swiper-bundle.js');
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH.'/static/js/menu.js');
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH.'/static/js/readmore.js');
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH.'/static/js/front.js');
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH.'/static/js/script.js');

	//Asset::getInstance()->addString('<script data-skip-moving="true">var COMPARE_LIST_COUNT = [' . implode(',', $COMPARE_LIST) . ']</script>');
?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta name="yandex-verification" content="5f03a673f5fa8f27" />
	<meta name="google-site-verification" content="y3JuyXJ9IrFc8ub2fV_M3sR8ya-c1RXwJIqCiMMpViM" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>
		<? $APPLICATION->ShowTitle();?>
    </title>
    <?php if($USER->IsAuthorized()){
			$APPLICATION->ShowHead();
		}else{
			$APPLICATION->ShowHeadStrings(); 
			$APPLICATION->ShowHeadScripts();
			$APPLICATION->ShowMeta("keywords");
			$APPLICATION->ShowMeta("description");
		}?>
    <?if($_GET['SIZEN_1'] || $_GET['SIZEN_2']):?>
		<meta name='robots' content='noindex,nofollow'>
	<?else:?>
		<link rel="canonical" href="https://mebelny-dom.com<?php echo $APPLICATION->GetCurPage();?>"/>
	<?endif?>
    <!--<link rel="stylesheet" "https://fonts.googleapis.com/css?family=Open+Sans:400,700&display=swap"/>-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
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
    );?>
	