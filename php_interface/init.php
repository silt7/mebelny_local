<?
/*** Dump ***/
function pr($var, $die = false, $all = false)
{
    global $USER;
    if(($USER->GetID() == 605) || ($all == true))
    {
        ?>
        <font style="padding:15px;margin:20px 0;white-space:pre-wrap;font:13px/18px monospace,'Courier New';display:block;border:none;border-left:5px solid #ffdb4d;background:#FFF8E8;"><pre><?print_r($var)?></pre></font>
        <?
    }
    if($die)
    {
        die;
    }
}

//вырезаем type="text/javascript" 
AddEventHandler("main", "OnEndBufferContent", "delete_type");
function delete_type(&$content) {
	$content = str_replace(" type=\"text/javascript\"", false, $content);
	$content = str_replace("", false, $content);
	$content = str_replace(" action=\"\"", false, $content);
	$content = str_replace(" name=\"\"", false, $content);
}
//AddEventHandler("main", "OnEndBufferContent", "preload_link");
function preload_link(&$content){
    if(SITE_TEMPLATE_ID == 'mebelnydom_copy'){
        //$content = str_replace('rel="stylesheet"', 'rel="preload" as="style" onload="this.rel=\'stylesheet\'"', $content);
        //$content = preg_replace("/[ \t]+/", " ", $content);
		//$content = str_replace(array("\n \n"), "\n", $content);
    }
}

AddEventHandler("main", "OnEpilog", "error_page");
function error_page()
{
	$page_404 = "/404.php";
	GLOBAL $APPLICATION;
	if(strpos($APPLICATION->GetCurPage(), $page_404) === false && defined("ERROR_404") && ERROR_404 == "Y")
	{
		$APPLICATION->RestartBuffer();
		CHTTP::SetStatus("404 Not Found");
		//include($_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH."/header.php");
		include($_SERVER["DOCUMENT_ROOT"].$page_404);
		//include($_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH."/footer.php");
		die();
	}
}



// При изменении количества товара, запишем в свойство для сортировки по количеству
AddEventHandler("catalog", "OnProductUpdate", array("ProductUpdateClass", "OnProductUpdateHandler"));
AddEventHandler("catalog", "OnProductAdd", array("ProductUpdateClass", "OnProductUpdateHandler"));
AddEventHandler("iblock", "OnAfterIBlockElementUpdate", Array("ProductUpdateClass", "OnAfterIBlockElementUpdateHandler"));


function updateSitemapAgent()
{
    file_get_contents('https://mebelny-dom.com/generateSitemap.php');
    return "updateSitemapAgent();";
}
class ProductUpdateClass
{  function OnProductUpdateHandler($ID, $arFields)
   {
       $ar_res = CCatalogProduct::GetByID($ID);
       if($ar_res["TYPE"] == 3){ // товар с торговыми предложениями
           $arOffersIds = array();
           $rsOffers = CIBlockElement::GetList(array(),array('IBLOCK_ID' => 3, 'PROPERTY_CML2_LINK' => $ID));
           while ($arOffer = $rsOffers->GetNext()){
               $arOffersIds[] = $arOffer["ID"];
           }
           $quantity = 0;
           foreach ($arOffersIds as $offersId){
               $offer_res = CCatalogProduct::GetByID($offersId);
               $quantity += $offer_res["QUANTITY"];
           }
           CIBlockElement::SetPropertyValuesEx($ID, false, array('QTY' => $quantity));
       }elseif($ar_res["TYPE"] == 1){ // простой товар
           // смотрим есть ли товары в наборе
           $VALUES = array();
           $db_props = CIBlockElement::GetProperty(2, $ID, array("sort" => "asc"), Array("CODE"=>"TOVARS_IN_NABOR"));
           while ($ob = $db_props->GetNext())
           {
               $VALUES[] = $ob['VALUE'];
           }
           if($VALUES && $VALUES[0] != null){
               $arQuantity = array();
                foreach ($VALUES as $product_id){
                    $ar_res = CCatalogProduct::GetByID($product_id);
                    $arQuantity[] = $ar_res["QUANTITY"];
                }
                $quantity = min($arQuantity);
                CIBlockElement::SetPropertyValuesEx($ID, false, array('QTY' => $quantity));
           }else{
               CIBlockElement::SetPropertyValuesEx($ID, false, array('QTY' => $arFields['QUANTITY']));
               // проверяем входит ли данный товар в какой-нибудь набор
               $arSelect = Array("ID", "NAME");
               $arFilter = Array("IBLOCK_ID"=>2, "ACTIVE"=>"Y", "PROPERTY_TOVARS_IN_NABOR" => $ID);
               $res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
               $arProducts = array();
               while($ob = $res->GetNextElement())
               {
                   $arFields = $ob->GetFields();
                   $arProducts[] = $arFields;
               }
               if($arProducts){
                   foreach ($arProducts as $product){
                       $product_id = $product["ID"];
                       $VALUES = array();
                       $db_props = CIBlockElement::GetProperty(2, $product_id, array("sort" => "asc"), Array("CODE"=>"TOVARS_IN_NABOR"));
                       while ($ob = $db_props->GetNext())
                       {
                           $VALUES[] = $ob['VALUE'];
                       }
                       if($VALUES && $VALUES[0] != null){
                           $arQuantity = array();
                           foreach ($VALUES as $product_inner_id){
                               $ar_res = CCatalogProduct::GetByID($product_inner_id);
                               $arQuantity[] = $ar_res["QUANTITY"];
                           }
                           $quantity = min($arQuantity);
                           CIBlockElement::SetPropertyValuesEx($product_id, false, array('QTY' => $quantity));
                       }
                   }
               }
           }
       }
       
       
       //Разделяем товары по наличию
       $quantity = CIBlockElement::GetProperty(2, $ID, array("sort" => "asc"), Array("CODE"=>"QTY"))->Fetch();
       if($quantity["VALUE"] > 0){
           CIBlockElement::SetPropertyValuesEx($ID, false, array('NAL_SORT' => 1));
       } else {
           $podZakaz = CIBlockElement::GetProperty(2, $ID, array("sort" => "asc"), Array("CODE"=>"POD_ZAKAZ"))->Fetch();
           if(!empty($podZakaz["VALUE"])){
               $days = explode('-', $podZakaz["VALUE"]);
               CIBlockElement::SetPropertyValuesEx($ID, false, array('NAL_SORT' => 1 - $days[0]/100));
           } else {
               CIBlockElement::SetPropertyValuesEx($ID, false, array('NAL_SORT' => 0));
           }
       }
       
   }  
   
   function OnAfterIBlockElementUpdateHandler(&$arFields){
       //$arDiscounts = CCatalogDiscount::GetDiscountByProduct($ID, [],"N",1,"s1");
        /*$products = CIBlockElement::GetList(array(),array('IBLOCK_ID' => 2));
        while ($product = $products->Fetch()){
            $ID = $product["ID"];
        }*/
       
        $ID = $arFields['ID'];
        $price = 0;
       
        $offers = CCatalogSKU::getOffersList($ID, 0, array('ACTIVE' => 'Y'), array('ID', 'NAME', 'CODE'), array());
        if(!empty($offers)){
            $arrPrice = [];
            foreach($offers[$ID] as $offer){
                $arDiscounts = CCatalogProduct::GetOptimalPrice($offer['ID'], 1, $USER, '', '', 's1');
                array_push($arrPrice, $arDiscounts['DISCOUNT_PRICE']);
            }
            $price = min($arrPrice);
        } else {
            $arDiscounts = CCatalogProduct::GetOptimalPrice($ID, 1, $USER, '', '', 's1');
            $price = $arDiscounts['DISCOUNT_PRICE'];
        }
        CIBlockElement::SetPropertyValuesEx($ID, false, array('PRICE' => $price));
   }
}
if (!function_exists('custom_mail') && COption::GetOptionString("webprostor.smtp", "USE_MODULE") == "Y")
{
    function custom_mail($to, $subject, $message, $additional_headers='', $additional_parameters='')
    {
        if(CModule::IncludeModule("webprostor.smtp"))
        {
            $smtp = new CWebprostorSmtp("s1");
            $result = $smtp->SendMail($to, $subject, $message, $additional_headers, $additional_parameters);

            if($result)
                return true;
            else
                return false;
        }
    }
}

class mebel
{

	/**
	 * @param string $name - Имя кэша - Имя папки на севере
	 * @param string $params - переметры для кеша (в одной папке может лежать много кеша скажем для каждого города и категори...)
	 *
	 */
	public static function Make_cache_ID_PATH($name = "", $params = array()){

		if($params && !is_array($params)){
			$params = array($params);
		}

		if(!$params){
			$cache_id = $name;
		}else{
			$cache_id = $name."__".implode("_", $params);
		}

		$cache_path = "/" . $name . "/";

		//$cache_id = $name."__".implode("_", $params);
		//$cache_path = "/" . $name . "/";

		return array(
			"CHACHE_ID" => $cache_id,
			"CACHE_PATH" => $cache_path
		);

	}


	/**
	 * @param string $initDir
	 * Чистим кэш
	 */
	public static function Clear_cache($name = "", $params = array()){

		$cache = \Bitrix\Main\Data\Cache::createInstance();

		$cache_id = self::Make_cache_ID_PATH($name, $params)["CHACHE_ID"];
		$cache_path = self::Make_cache_ID_PATH($name, $params)["CACHE_PATH"];

		$cache->clean($cache_id, $cache_path);
	}


	/**
	 * @param $name_function
	 * @param $name
	 * @param array $params
	 * @param array $params_for_function
	 * @param int $cache_time
	 * Создаем кеш для массива
	 * @return mixed
	 */
	public static function make_chache_main($name_function, $name, $params = array(), $params_for_function = array(), $cache_time = 3600, $CLEAR_CHACHE = "N"){

		$cache = \Bitrix\Main\Data\Cache::createInstance();
		//$cache_time = 3600;

		$cache_id = self::Make_cache_ID_PATH($name, $params)["CHACHE_ID"];
		$cache_path = self::Make_cache_ID_PATH($name, $params)["CACHE_PATH"];

		if($CLEAR_CHACHE == "Y"){
			self::Clear_cache($name, $params);
		}

		if($cache->initCache($cache_time, $cache_id, $cache_path)){

			return $cache->getVars();

			//return $result;

		}elseif($cache->startDataCache($cache_time, $cache_id, $cache_path)){

			/*if(is_array($params_for_function)){
				$make_mass = call_user_func_array($name_function, $params_for_function);
			}else{
				$make_mass = call_user_func($name_function, $params_for_function);
			}*/
			//self::start();
			$make_mass = call_user_func($name_function, $params_for_function);
			$cache->endDataCache($make_mass);

			//global $USER;
			/*
			if($USER->IsAdmin() && $USER->GetID() == "1180"){

			}
			*/

			/*if(date("H") > 7 && date("H") < 23){
				$arRes["FUNC_LOG"] = array(
					"INT_NAME_FUNC" => $name_function,
					"INT_NAME" => $name,
					"INT_PARAMS" => $params,
					"INT_PARAMS_FUNC" => $params_for_function,
					"INT_TIME_CHACHE" => $cache_time,
					"MAK_CHACHE_ID" => $cache_id,
					"MAK_CHACHE_PATH" => $cache_path,
					"TIME" => date("d.m.Y H:i:s"),
					"SCRIPT_URL" => $_SERVER["SCRIPT_URL"],
					"HTTP_X_REAL_IP" => $_SERVER["HTTP_X_REAL_IP"],
					"HTTP_REFERER" => $_SERVER["HTTP_REFERER"],
					"REQUEST" => $_REQUEST,
					"REQUEST_TIME" => self::finish()
				);
				log_to_file($arRes["FUNC_LOG"], "/test_chek.log");
			}*/

			return $make_mass;
		}

	}


	/**
	 * @param $name_function
	 * @param $name
	 * @param array $params
	 * @param array $params_for_function
	 * @param int $cache_time
	 * Создаем кеш для массива
	 * @return mixed
	 */
	public static function get_chache_main($name_function, $name, $params = array(), $params_for_function = array(), $cache_time = 3600, $CLEAR_CHACHE = "N"){

		$cache = \Bitrix\Main\Data\Cache::createInstance();
		$cache_id = self::Make_cache_ID_PATH($name, $params)["CHACHE_ID"];
		$cache_path = self::Make_cache_ID_PATH($name, $params)["CACHE_PATH"];

		if($cache->initCache($cache_time, $cache_id, $cache_path)){
			return $cache->getVars();
		}else{
			return false;
		}

	}

	/**
	 * Создаем пул цен для всех товаров
	 * @return mixed
	 */
	public static function all_prices(){

		$prices = array();
		CModule::IncludeModule("iblock");
		$arSelect = Array("ID");//IBLOCK_ID и ID обязательно должны быть указаны, см. описание arSelectFields выше
		$arFilter = Array("IBLOCK_ID"=>2);
		$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
		while($ob = $res->Fetch()){ 
			$prices[$ob["ID"]] = self::price_by_id($ob["ID"]);
		}

		return $prices;
	}

	/**
	 * Цена товара
	 * @return mixed
	 */
	public static function price_by_id($id){

		if(CModule::IncludeModule("catalog") && CModule::IncludeModule("iblock")){

		$row = array();

		$row['ID'] = $id;

		if ($row['PRICE'] = CCatalogProduct::GetOptimalPrice($row['ID'])) {
            $row['PRICE'] = $row['PRICE']['RESULT_PRICE'];
        } else {
            $off_price = array();
            $ob_off = CIBlockElement::GetList(Array("SORT"=>"ASC"),Array('ACTIVE'=>'Y','CATALOG_AVAILABLE'=>'Y','PROPERTY_CML2_LINK.ID'=>$row['ID']),false,false,Array('ID'));
            while ($ar_fields = $ob_off->GetNext()) {
                $off_price[$ar_fields['ID']]=CCatalogProduct::GetOptimalPrice($ar_fields['ID'])['RESULT_PRICE'];
            }
            uasort($off_price, function ($a, $b) {
                if ($a['DISCOUNT_PRICE'] == $b['DISCOUNT_PRICE']) {
                    return 0;
                }
                return ($a['DISCOUNT_PRICE'] < $b['DISCOUNT_PRICE']) ? -1 : 1;
            });
            $row['ID'] = key($off_price);
            $off_price = array_shift($off_price);
            $row['PRICE'] = $off_price;
        }

    	}

		return $row;
	}



	/**
	 * Все категории
	 * @return mixed
	 */
	public static function all_sections(){

		if(CModule::IncludeModule("iblock")){
			$arFilter = array('IBLOCK_ID' => 2, 'ACTIVE' => "Y", 'CNT_ACTIVE'=>true);
		   $rsSect = CIBlockSection::GetList(array('left_margin' => 'asc'),$arFilter,true,array("ID","NAME","CODE","DEPTH_LEVEL","ACTIVE","SECTION_PAGE_URL","IBLOCK_SECTION_ID","UF_TO_TAGS","UF_URL_FILTER"));
		   while ($arSect = $rsSect->GetNext())
		   {
		   	if($arSect["IBLOCK_SECTION_ID"]){
		   		$sections[$arSect["IBLOCK_SECTION_ID"]]["DEPTH_LEVEL2"][$arSect["ID"]] = $arSect;
		   	}else{
		   		$sections[$arSect["ID"]] = $arSect;
		   	}
		   }
    	}

		return $sections;
	}


	/**
	 * Все категории
	 * @return mixed
	 */
	public static function all_sections_by_code(){

		$sections = self::all_sections();

		$sections_by_code = array();

		foreach ($sections as $key => $item) {
			if($item["DEPTH_LEVEL2"]){
				$sections_by_code[$item["CODE"]] = $item;
			}
		}

		return $sections_by_code;
	}
}
$GLOBALS["ALL_PRICES"] = mebel::get_chache_main("mebel::all_prices", "ALL_PRICES", "", array("ID"), 86400000);
$GLOBALS["ALL_SECTIONS"] = mebel::get_chache_main("mebel::all_sections", "ALL_SECTIONS", "", array("ID"), 864000);
$GLOBALS["ALL_SECTIONS_BY_CODE"] = mebel::get_chache_main("mebel::all_sections_by_code", "ALL_SECTIONS_BY_CODE", "", array("ID"), 864000);