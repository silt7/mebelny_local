<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
    use Bitrix\Main\Loader;
    use Bitrix\Main\ModuleManager;
    $this->setFrameMode(true);
    


    if($_GET['SORT']){
        $APPLICATION->SetPageProperty('robots', 'noindex, nofollow');
    }
    
    $avaibleSORT = array('PROPERTY_QTY-ASC' => '', 'PROPERTY_QTY-DESC' => '', 'PROPERTY_PRICE-ASC' => '', 'PROPERTY_PRICE-DESC' => '', 'ID-ASC' => '', 'ID-DESC' => '', 'SHOWS-ASC' => '', 'SHOWS-DESC' => '');
    $SORT = isset($_REQUEST['SORT']) && isset($avaibleSORT[$_REQUEST['SORT']]) ? $_REQUEST['SORT'] : 'ID-DESC';
    $arSORT = explode('-', $SORT);
    
    $pageURI = $_SERVER["REQUEST_URI"];

   // ID верхнего раздела
    $resFirstLevelCatID = CIBlockSection::GetByID($arResult['VARIABLES']['SECTION_ID']);
    if($arFirstLevelCat = $resFirstLevelCatID->GetNext()){
        if($arFirstLevelCat['IBLOCK_SECTION_ID']){
            $firstLevelCatID = $arFirstLevelCat['IBLOCK_SECTION_ID'];
        }
        else{
            $firstLevelCatID = $arFirstLevelCat['ID'];
        }
    }
    
    
    //** Rating section
    CModule::IncludeModule('highloadblock');
    use Bitrix\Highloadblock\HighloadBlockTable as HLBT;
    
    $hlblock = HLBT::getById(35)->fetch();
    $entity = HLBT::compileEntity($hlblock);
    
    $rsData = $entity->getDataClass()::getList(array(
       'select' => array('UF_SECTION', 'UF_RATING'),
       'order' => array('UF_SECTION' => 'ASC'),
       'filter' => array('UF_SECTION' => $arResult['VARIABLES']['SECTION_CODE'])
    ))->fetchAll();
    
    $sum = 0;
    $ratingSection = [];
    $ratingSection['count'] = count($rsData);
    $ratingSection['sum'] = 0;
    
    //Накрутка для пустых разделов
    if($ratingSection['count'] == 0){
        for($i = 0; $i < 3; $i++){
            $entity->getDataClass()::add(array(
    		   'UF_SECTION'      => $arResult['VARIABLES']['SECTION_CODE'],
    		   'UF_RATING'         => 5,
    	    ));
        }
        
        $rsData = $entity->getDataClass()::getList(array(
           'select' => array('UF_SECTION', 'UF_RATING'),
           'order' => array('UF_SECTION' => 'ASC'),
           'filter' => array('UF_SECTION' => $arResult['VARIABLES']['SECTION_CODE'])
        ))->fetchAll();
        $ratingSection['count'] = count($rsData);
    }
    
    foreach($rsData as $el){
        $ratingSection['sum'] += $el['UF_RATING'];
    }
    //** END Rating section
?>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>


<?
$res = CIBlockSection::GetByID($arResult['VARIABLES']['SECTION_ID']);
if($ar_ress = $res->GetNext()) {
  $arResult['VARIABLES']['IBLOCK_SECTION_ID'] = $ar_ress['IBLOCK_SECTION_ID'];
  $arResult['VARIABLES']['SECTION_NAME'] = $ar_ress['NAME'];
  $arResult['VARIABLES']['IBLOCK_ID'] = $ar_ress['IBLOCK_ID'];
  $arResult['VARIABLES']['SECTION_ID'] = $ar_ress['ID'];
}

?>
<!-- <pre><?//var_dump($ar_ress)?></pre> -->


<? if ($arResult['VARIABLES']['SECTION_ID'] == 119 || $arResult['VARIABLES']['SECTION_ID'] == 1287) {?>
        <?$APPLICATION->setTitle($arResult['VARIABLES']['SECTION_NAME'])?>
<div class="page-top collections-top-page">
    <div class="container page-top__wrap with-search">
        <?$APPLICATION->IncludeComponent(
	"bitrix:breadcrumb",
	"",
	Array(
		"PATH" => "",
		"SITE_ID" => "s1",
		"START_FROM" => "0"
	)
);?>
        <?if ($arResult['VARIABLES']['SECTION_ID'] !== 119 || $arResult['VARIABLES']['SECTION_ID'] !== 1287) {?>
        <div class="collections-search">
            <form class="collections-search__form" id="searchCollections">
            <input type="hidden" name="IBLOCK_ID" value="<?=$arResult['VARIABLES']['IBLOCK_ID']?>">
            <input type="hidden" name="COUNT" value="<?=$_REQUEST['COUNT']?>">
            <input type="hidden" name="SECTION_ID" value="<?=$arResult['VARIABLES']['SECTION_ID']?>">
                <input placeholder="Название коллекции" type="text" name="SEARCH_WORD" id="searchCollectionsInput"
                    class="collections-search__input" minlength="4" required> <button type="submit" class="collections-search__btn"> <img
                        src="/upload/icon-search.svg" alt=""></button>
            </form>
        </div>
        <?}?>
        <!-- /.bradcrums -->
        <h1 class="page-top__title collections-page__title">
            <?=$arResult['VARIABLES']['SECTION_NAME']?>
        </h1>
    </div>
</div>
<!-- page-top -->

<?
 $APPLICATION->IncludeComponent(
	"bitrix:catalog.section.list", 
	"collections", 
	array(
		"COMPONENT_TEMPLATE" => "collections",
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => "2",
		"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
		"SECTION_CODE" => "",
		"COUNT_ELEMENTS" => "N",
		"COUNT_ELEMENTS_FILTER" => "CNT_ACTIVE",
		"TOP_DEPTH" => "1",
		"SECTION_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SECTION_URL" => "",
		"CACHE_TYPE" => "N",
		"CACHE_TIME" => "36000000",
		"CACHE_GROUPS" => "Y",
		"CACHE_FILTER" => "N",
		"ADD_SECTIONS_CHAIN" => "Y",
		"VIEW_MODE" => "LINE",
		"SHOW_PARENT_NAME" => "Y",
		"FILTER_NAME" => "arrFilter",
		"INCLUDE_SUBSECTIONS" => "A",
		"SHOW_ALL_WO_SECTION" => "Y",
		"CUSTOM_FILTER" => "{\"CLASS_ID\":\"CondGroup\",\"DATA\":{\"All\":\"AND\",\"True\":\"True\"},\"CHILDREN\":[]}",
		"HIDE_NOT_AVAILABLE" => "N",
		"HIDE_NOT_AVAILABLE_OFFERS" => "N",
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER2" => "desc",
		"OFFERS_SORT_FIELD" => "sort",
		"OFFERS_SORT_ORDER" => "asc",
		"OFFERS_SORT_FIELD2" => "id",
		"OFFERS_SORT_ORDER2" => "desc",
		"PAGE_ELEMENT_COUNT" => "4",
		"LINE_ELEMENT_COUNT" => "3",
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"OFFERS_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"OFFERS_PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"OFFERS_LIMIT" => "5",
		"BACKGROUND_IMAGE" => "-",
		"DETAIL_URL" => "",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SEF_MODE" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"SET_TITLE" => "Y",
		"SET_BROWSER_TITLE" => "Y",
		"BROWSER_TITLE" => "-",
		"SET_META_KEYWORDS" => "Y",
		"META_KEYWORDS" => "-",
		"SET_META_DESCRIPTION" => "Y",
		"META_DESCRIPTION" => "-",
		"SET_LAST_MODIFIED" => "N",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"ACTION_VARIABLE" => "action",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRICE_CODE" => "",
		"USE_PRICE_COUNT" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"PRICE_VAT_INCLUDE" => "Y",
		"CONVERT_CURRENCY" => "N",
		"BASKET_URL" => "/personal/basket.php",
		"USE_PRODUCT_QUANTITY" => "N",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRODUCT_PROPERTIES" => "",
		"OFFERS_CART_PROPERTIES" => "",
		"DISPLAY_COMPARE" => "N",
		"PAGER_TEMPLATE" => "artmix_ajax_pagination",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Колекции",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SET_STATUS_404" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => "",
		"COMPATIBLE_MODE" => "Y",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N"
	),
	false
);?>
<script>
    function slickInit() {
        $('.collection-item__slider').not('.slick-initialized').slick({
            arrows: false,
            dots: true,
            infinite: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            pauseOnHover: false,
            speed: 10,
            fade: true
        });
        // $('.collection-item__slider').slick('slickPause');
        // $('.card').on('mouseenter', function () {
        //   $(this).find('.collection-item__slider').slick('slickPlay');
        // });
        // $('.card').on('mouseleave', function () {
        //   $(this).find('.collection-item__slider').slick('slickPause');
        // });

        //$( ".collection-item__slider" ).mouseleave(function() {
        //   $(this).slick('slickGoTo', 0,  true);
        //});
        $('.collection-item__slider').bind({
            mouseleave: function () {
                $(this).slick('slickGoTo', 0, true);
            }
        });
        $('.collection-item__slider .slick-dots li').on('mouseenter', function () {
            $(this).click();
        });
    }

    $(document).ready(function () {
        slickInit();
    })
    $(document).ajaxComplete(function () {
        slickInit();
    });

    $(document).ready(function () {
        $('#searchCollections').on('submit', function (e) {
            e.preventDefault();
            let collection = $(this).serialize();
            searchCollection(collection);
        });
        $('#searchCollectionsInput').on('keyup', function (e) {
            e.preventDefault();
            let collection = $(this).parents('form').serialize();
            searchCollection(collection);
        });

        function searchCollection(collection = '') {
            if ($('#searchCollectionsInput').val().length >= 4) {
                $('.collections-loader').fadeIn();
                $('.content.collections-page').find('.searchResult').show(0);
                $('.content.collections-page').find('.container-collection').hide(0);
                $.ajax({
                    url: '/local/ajax/searchCollection.php',
                    type: 'POST',
                    data: collection,
                    success: function (data) {
                        if (data != 'false') {
                            $('.container.searchResult').html(data); 
                            slickInit();
                            $('.collections-loader').fadeOut();
                        }
                    }
                });
            } else {
                $('.collections-loader').fadeOut();
                $('.content.collections-page').find('.container-collection').show(0);
                $('.content.collections-page').find('.searchResult').hide(0);
            }
        };
    });
</script>


<?} else {?>
<?if ($arResult['VARIABLES']['IBLOCK_SECTION_ID'] == 119 || $arResult['VARIABLES']['IBLOCK_SECTION_ID'] == 1287) {?>

    <div class="page-top collections-top-page">
        <div class="container page-top__wrap">
            <?$APPLICATION->IncludeComponent(
                "bitrix:breadcrumb",
                "",
                Array(
                    "PATH" => "",
                    "SITE_ID" => "s1",
                    "START_FROM" => "0"
                    )
                );?>
            <!-- /.bradcrums -->
            <h1 class="page-top__title collections-page__title">
            <?=$arResult['VARIABLES']['SECTION_NAME']?>
            </h1>
        </div>
    </div>
    <!-- page-top -->
    <?} else {?>
    <div class="filter filter_catalog<?php if ($FILTER_OPEN) echo ' filter-active'; ?>">

        <? 
            if (!$arParams["FILTER_VIEW_MODE"])
                $arParams["FILTER_VIEW_MODE"] = "VERTICAL";
            
            if ('Y' == $arParams['USE_FILTER']) {
                if (CModule::IncludeModule("iblock")) {
                    $arFilter = array(
                        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                        "ACTIVE" => "Y",
                        "GLOBAL_ACTIVE" => "Y",
                    );
                    if(0 < intval($arResult["VARIABLES"]["SECTION_ID"]))
                    {
                        $arFilter["ID"] = $arResult["VARIABLES"]["SECTION_ID"];
                    }
                    elseif('' != $arResult["VARIABLES"]["SECTION_CODE"])
                    {
                        $arFilter["=CODE"] = $arResult["VARIABLES"]["SECTION_CODE"];
                    }
            
                    $obCache = new CPHPCache();
                    if($obCache->InitCache(36000, serialize($arFilter), "/iblock/catalog"))
                    {
                        $arCurSection = $obCache->GetVars();
                    }
                    else
                    {
                        $arCurSection = array();
                        $dbRes = CIBlockSection::GetList(array(), $arFilter, false, array("ID"));
            
                        if(defined("BX_COMP_MANAGED_CACHE"))
                        {
                            global $CACHE_MANAGER;
                            $CACHE_MANAGER->StartTagCache("/iblock/catalog");
            
                            if ($arCurSection = $dbRes->GetNext())
                            {
                                $CACHE_MANAGER->RegisterTag("iblock_id_".$arParams["IBLOCK_ID"]);
                            }
                            $CACHE_MANAGER->EndTagCache();
                        }
                        else
                        {
                            if(!$arCurSection = $dbRes->GetNext())
                                $arCurSection = array();
                        }
            
                        $obCache->EndDataCache($arCurSection);
                    }
                }

            } 
            ?>
    </div>
    <?$page = $APPLICATION->GetCurPage();
        $arPage = explode('/', $page);
        $code = $arPage[count($arPage) - 2];
        $parent_code = $arPage[count($arPage) - 3];
        
        
        if($parent_code) {
            $arFilter = Array('IBLOCK_ID' => 2, "ACTIVE" => "Y", "CODE" => $parent_code, "DEPTH_LEVEL" => 1);
            $db_list = CIBlockSection::GetList(Array($by => $order), $arFilter, true, array("ID", "UF_URL_FILTER", "NAME", "SECTION_PAGE_URL"));
            while ($ar_result = $db_list->GetNext()) {
                $parentSectionId = $ar_result["ID"];
                $parentPageUrl = $ar_result["SECTION_PAGE_URL"];
            }
        }
        if($parentSectionId){
            $arFilter = Array('IBLOCK_ID' => 2, "ACTIVE" => "Y", "SECTION_ID" => $parentSectionId, "CODE" => $code);
            $db_list = CIBlockSection::GetList(Array($by => $order), $arFilter, true, array("ID", "UF_URL_FILTER", "NAME"));
            while ($ar_result = $db_list->GetNext()) {
                $arSection = $ar_result;
            }
            $filter_url = '';
            $filter_url = $arSection["UF_URL_FILTER"];
        }
        if($filter_url){
            $section_filter_url = $parentPageUrl;
            $section_parent_id = $parentSectionId;
        }
        if($section_parent_id){
            $arCurSection["ID"] = $section_parent_id;
        }
        
        $arFilter = array('IBLOCK_ID' => $arParams['IBLOCK_ID'], "ID" => $arResult['VARIABLES']['SECTION_ID']);
        $rsSect = CIBlockSection::GetList(array(),$arFilter,  false, $arSelect = array("NAME", "UF_*","DESCRIPTION","PICTURE"));
        while ($arSect = $rsSect->GetNext())
        {
            $titleSection = $arSect["NAME"];
            $picurl = CFile::GetPath($arSect["PICTURE"]);
            $desc = $arSect["DESCRIPTION"];
            $video = $arSect["UF_VIDEO"];
        }
    ?>
        <div class="page-top">
            <div class="container page-top__wrap">
                <? $APPLICATION->IncludeComponent("bitrix:breadcrumb","",Array(
                    "START_FROM" => "0", 
                    "PATH" => "", 
                    "SITE_ID" => "s1" 
                    )
                );?>
                <!-- /.bradcrums -->
                <h1 class="page-top__title">
                    <?if(strpos($pageURI, 'filter') > -1){
                    if(strpos($pageURI, 'price') == false && strpos($pageURI, 'dlina_filter') == false && strpos($pageURI, 'glubina_filter') == false && strpos($pageURI, 'vysota_filter') == false){
                        $APPLICATION->ShowViewContent('filter-title');
                    } else {
                        $APPLICATION->ShowProperty("pageheader");
                    }
                } else {
                    $APPLICATION->ShowProperty("pageheader");
                }?>
                </h1>
            </div>
        </div>
        <!-- page-top -->

    <?}?>


  <?// ► Сортировка ?>
            <?
            $sort_price_order = 'PROPERTY_PRICE-ASC'; 
            $sort_pop_order = 'SHOWS-DESC';
            $sort_id_order = 'ID-DESC';
            $sort_qty_order = 'PROPERTY_QTY-DESC';
            $sortActive = [];
            $name = 'Новизне';
            // По цене
            if($arSORT['0']=='PROPERTY_PRICE' && $arSORT['1']=='ASC'){
                $name = 'Цене';
                $sort_price_order = 'PROPERTY_PRICE-DESC';
                $sortActive['price_asc'] = 'sort-arrow__selected';
            }
            if($arSORT['0']=='PROPERTY_PRICE' && $arSORT['1']=='DESC'){
                $name = 'Цене';
                $sort_price_order = 'PROPERTY_PRICE-ASC';
                $sortActive['price_desc'] = 'sort-arrow__selected';
            }
            // По Популярности
           if($arSORT['0']=='SHOWS' && $arSORT['1']=='ASC'){
                $name = 'Популярности';
                $sort_pop_order = 'SHOWS-DESC';
                $sortActive['pop_asc'] = 'sort-arrow__selected';
            }
           if($arSORT['0']=='SHOWS' && $arSORT['1']=='DESC'){
                $name = 'Популярности';
                $sort_pop_order = 'SHOWS-ASC';
                $sortActive['pop_desc'] = 'sort-arrow__selected';
            }
            // По новизне
            if($arSORT['0']=='ID' && $arSORT['1']=='ASC'){
                $name = 'Новизне';
                $sort_id_order = 'ID-DESC';
                
                $arSORT['0'] = 'PROPERTY_NAL_SORT';
                $arSORT['1'] = 'ASC';
                
                $arParams["ELEMENT_SORT_FIELD2"] = 'ID';
                $arParams["ELEMENT_SORT_ORDER2"] = 'ASC';
                
                $sortActive['id_asc'] = 'sort-arrow__selected';
            }
            if($arSORT['0']=='ID' && $arSORT['1']=='DESC'){
                $name = 'Новизне';
                $sort_id_order = 'ID-ASC';
                
                $arSORT['0'] = 'PROPERTY_NAL_SORT';
                $arSORT['1'] = 'DESC';
                
                $arParams["ELEMENT_SORT_FIELD2"] = 'ID';
                $arParams["ELEMENT_SORT_ORDER2"] = 'DESC';
                
                $sortActive['id_desc'] = 'sort-arrow__selected';
            }
            // По наличию
            if($arSORT['0']=='PROPERTY_QTY' && $arSORT['1']=='ASC'){
                $name = 'Наличию';
                $sort_qty_order = 'PROPERTY_QTY-DESC';
                $sortActive['qty_desc'] = 'sort-arrow__selected';
                
                $arParams["ELEMENT_SORT_FIELD2"] = 'PROPERTY_POD_ZAKAZ';
                $arParams["ELEMENT_SORT_ORDER2"] = 'DESC';
            }
            if($arSORT['0']=='PROPERTY_QTY' && $arSORT['1']=='DESC'){
                $name = 'Наличию';
                $sort_qty_order = 'PROPERTY_QTY-ASC';
                $sortActive['qty_asc'] = 'sort-arrow__selected';
                
                $arParams["ELEMENT_SORT_FIELD2"] = 'PROPERTY_POD_ZAKAZ';
                $arParams["ELEMENT_SORT_ORDER2"] = 'DESC';
            }
            if($arSORT['1']=='ASC'){
                $sortActive['down'] = 'sort-arrow__selected';
                $sortActive['url'] = $arSORT['0'].'-DESC';
            } else {
                $sortActive['up'] = 'sort-arrow__selected';
                $sortActive['url'] = $arSORT['0'].'-ASC';
            }
        ?>

<?if ($arResult['VARIABLES']['IBLOCK_SECTION_ID'] != 119 && $arResult['VARIABLES']['IBLOCK_SECTION_ID'] != 1287) {?>

<section class="catalog">
    <a href="#filter" class="filter-icon">
        <img src="/images/icon-filter-white.svg" alt="">
    </a>
    <div class="container catalog__wrap">
        <div id="filter" class="catalog__filter filter">
            <div class="catalog_tags_mob">
            <?$APPLICATION->IncludeComponent(
                "bitrix:catalog.section.list", 
                "RelinkTagsMobile2", 
                array(
                    "ADD_SECTIONS_CHAIN" => "N",
                    "CACHE_GROUPS" => "N",
                    "CACHE_TIME" => "36000000",
                    "CACHE_TYPE" => "N",
                    "COUNT_ELEMENTS" => "Y",
                    "AJAX_MODE" => "Y",
                    "IBLOCK_ID" => "2",
                    "IBLOCK_TYPE" => "catalog",
                    "SECTION_CODE" => "",
                    "SECTION_FIELDS" => array(
                        0 => "",
                        1 => "",
                    ),
                    "SECTION_ID" => $firstLevelCatID,
                    "SECTION_URL" => "",
                    "SECTION_USER_FIELDS" => array(
                        0 => "UF_TO_TAGS",
                        1 => "",
                    ),
                    "SHOW_PARENT_NAME" => "Y",
                    "TOP_DEPTH" => "3",
                    "VIEW_MODE" => "LINE",
                    "COMPONENT_TEMPLATE" => "RelinkTags",
                    "COMPOSITE_FRAME_MODE" => "A",
                    "COMPOSITE_FRAME_TYPE" => "AUTO"
                ),
                $component
            );?>
            </div></div>
            <?// ► ФИЛЬТР ?>
            <?$APPLICATION->IncludeComponent(
            "kombox:filter",
            "wds",
            array(
                "SECTION_FILTER_URL" => $section_filter_url,
                "CACHE_GROUPS" => "Y",
                "CACHE_TIME" => "36000000",
                "CACHE_TYPE" => "A",
                "CLOSED_OFFERS_PROPERTY_CODE" => array(
                    0 => "RAZMER_SPALNOGO_MESTA",
                    1 => "CML2_LINK",
                    2 => "HEIGHT",
                    3 => "KATEGORY_MATERIALA",
                    4 => "KRASHENIE",
                    5 => "NALICHIE_MEHANIZMA",
                    6 => "razmer_izdeliya",
                    7 => "sizematras",
                    8 => "HEHOL",
                    9 => "WIDTH",
                    10 => "",
                ),
                "CLOSED_PROPERTY_CODE" => array(
                    0 => "QTY",
                    1 => "ARTNUMBER",
                    2 => "POD_ZAKAZ",
                    3 => "dlina_vstavka_filter",
                    4 => "PROPERTY_TYPE_CHAIRS",
                    5 => "Fabr",
                    6 => "MATERIAL",
                    7 => "filter_cvet",
                    8 => "STYLE",
                    9 => "cvet_stekla",
                    10 => "NEWPRODUCT",
                    11 => "hitsales",
                    12 => "visibleinset1",
                    13 => "visibleinset2",
                    14 => "visibleinset3",
                    15 => "jostkost_sidenia",
                    16 => "jostkost_spinki",
                    17 => "H1",
                    18 => "H2",
                    19 => "spalnoe_mesto",
                    20 => "ACTION",
                    21 => "NAL",
                    22 => "VARKRASH",
                    23 => "VES",
                    24 => "VIDPOSTAVKI",
                    25 => "H4",
                    26 => "GR_OBIVKA",
                    27 => "dveri",
                    28 => "yashchiki",
                    29 => "ASKARON_REVIEWS_COUNT",
                    30 => "KOL_TOVARS_IN_NABOR",
                    31 => "KLKMEBELI",
                    32 => "konstruktion",
                    33 => "Krasheniye",
                    34 => "MATERIALKARKASA",
                    35 => "jjj",
                    36 => "LIGHT",
                    37 => "nagruzka_na_spalnoye_mesto",
                    38 => "H3",
                    39 => "napolnitel",
                    40 => "NATURAL",
                    41 => "nozhki",
                    42 => "OBIVKA",
                    43 => "OBEMTRANSP",
                    44 => "BASE",
                    45 => "OTDELKA",
                    46 => "podlokotniki",
                    47 => "PODMEX",
                    48 => "PROSV",
                    49 => "pruzhiny",
                    50 => "SIZE_PILLWCASES",
                    51 => "SIZE_QUILTCOVER",
                    52 => "SIZE_SHEETS",
                    53 => "SALE",
                    54 => "rating",
                    55 => "ASKARON_REVIEWS_RATING",
                    56 => "HT",
                    57 => "RECOMMEND",
                    58 => "COMPOSITION",
                    59 => "ASKARON_REVIEWS_AVERAGE",
                    60 => "ZAK",
                    61 => "stoleshnica",
                    62 => "typemebeli",
                    63 => "TOVARS_IN_NABOR",
                    64 => "YGL",
                    65 => "BRCOLOR",
                    66 => "TOVARS_IN_NABOR_REKOMEND",
                    67 => "vote_count",
                    68 => "vote_sum",
                    69 => "vysota_matrasa",
                    70 => "GESKOST",
                    71 => "PRUG_BLOK",
                    72 => "PR",
                    73 => "SPM",
                    74 => "NETTO",
                    75 => "STR",
                    76 => "YEAR",
                    77 => "Manufakter",
                    78 => "",
                ),
                "COMPONENT_TEMPLATE" => "wds",
                "CONVERT_CURRENCY" => "N",
                "DETAIL_PAGE_URL" => "#ELEMENT_CODE#/",
                "FIELDS" => array(
                    0 => "SECTIONS",
                ),
                "FILTER_NAME" => $arParams["FILTER_NAME"],
                "HIDE_NOT_AVAILABLE" => "Y",
                "IBLOCK_ID" => "2",
                "IBLOCK_TYPE" => "catalog",
                "INCLUDE_JQUERY" => "N",
                "IS_SEF" => "N",
                "MESSAGE_ALIGN" => "RIGHT",
                "MESSAGE_TIME" => "0",
                "PAGER_PARAMS_NAME" => "arrPager",
                "PAGE_URL" => "",
                "PRICE_CODE" => array(
                    0 => "BASE",
                ),
                "SAVE_IN_SESSION" => "N",
                "SECTION_CODE" => "",
                "SECTION_ID" => $arCurSection["ID"],
                "SECTION_PAGE_URL" => "#SECTION_CODE_PATH#/",
                "SEF_BASE_URL" => "/",
                "SORT" => "Y",
                "SORT_ORDER" => "ASC",
                "SORT_SECTIONS" => "10",
                "STORES_ID" => array(
                ),
                "TOP_DEPTH_LEVEL" => "0",
                "XML_EXPORT" => "N"
            ),
            $component
        );?>
        </div>
        <!-- /.catalog__filter filter -->
        <div class="catalog__content">

            <?$APPLICATION->IncludeComponent(
            "bitrix:catalog.section.list", 
            "RelinkTags", 
            array(
                "ADD_SECTIONS_CHAIN" => "N",
                "CACHE_GROUPS" => "N",
                "CACHE_TIME" => "36000000",
                "CACHE_TYPE" => "N",
                "COUNT_ELEMENTS" => "Y",
                "AJAX_MODE" => "Y",
                "IBLOCK_ID" => "2",
                "IBLOCK_TYPE" => "catalog",
                "SECTION_CODE" => "",
                "SECTION_FIELDS" => array(
                    0 => "",
                    1 => "",
                ),
                "SECTION_ID" => $firstLevelCatID,
                "SECTION_URL" => "",
                "SECTION_USER_FIELDS" => array(
                    0 => "UF_TO_TAGS",
                    1 => "",
                ),
                "SHOW_PARENT_NAME" => "Y",
                "TOP_DEPTH" => "3",
                "VIEW_MODE" => "LINE",
                "COMPONENT_TEMPLATE" => "RelinkTags",
                "COMPOSITE_FRAME_MODE" => "A",
                "COMPOSITE_FRAME_TYPE" => "AUTO"
            ),
            $component
        );?>
            <div class="catalog__sort sort">
                <span class="sort__title">Сортировка по:</span>
                <div class="sort-item__wrap">
                    <div class="sort-item sort-item__mob">
                        <div class="jspan_location" data-location="?SORT=<?=$sortActive['url']?>"
                            style="display: flex; width:100%; height: 100%; align-items: center;justify-content: start;">
                            <span class="sort-item__name"><?= $name?></span>
                            <i class="sort-arrow sort-arrow__down <?= $sortActive['down'];?>"></i>
                            <i class="sort-arrow sort-arrow__up <?= $sortActive['up'];?>"></i>
                        </div>
                        <div class="sort-item__open">
                            <img src="/images/icon-arrow-down-gray.svg" alt="" class="">
                        </div>
                    </div>
                    <div class="sort-items">
                        <div class="sort-item jspan_location" data-location="?SORT=<?=$sort_price_order?>">
                            <span class="sort-item__name">Цене</span>
                            <i class="sort-arrow sort-arrow__down <?= $sortActive['price_asc']; ?>"></i>
                            <i class="sort-arrow sort-arrow__up <?= $sortActive['price_desc'];?>"></i>
                        </div>
                        <div class="sort-item jspan_location" data-location="?SORT=<?=$sort_pop_order?>">
                            <span class="sort-item__name ">Популярности</span>
                            <i class="sort-arrow sort-arrow__down <?= $sortActive['pop_asc'];?>"></i>
                            <i class="sort-arrow sort-arrow__up <?= $sortActive['pop_desc'];?>"></i>
                        </div>
                        <div class="sort-item jspan_location" data-location="?SORT=<?=$sort_id_order?>">
                            <span class="sort-item__name ">Новизне</span>
                            <i class="sort-arrow sort-arrow__down <?= $sortActive['id_asc'];?>"></i>
                            <i class="sort-arrow sort-arrow__up <?= $sortActive['id_desc'];?>"></i>
                        </div>
                        <div class="sort-item jspan_location" data-location="?SORT=<?=$sort_qty_order?>">
                            <span class="sort-item__name ">Наличию</span>
                            <i class="sort-arrow sort-arrow__down <?= $sortActive['qty_asc'];?>"></i>
                            <i class="sort-arrow sort-arrow__up <?= $sortActive['qty_desc'];?>"></i>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.catalog__sort sort -->
            <?// ► Список товаров ?>
            <?$intSectionID = 0;?>
            <?
        if($filter_url){
            $arParams["FILTER_NAME"] = '';
        }

        $arParams["ALSO_BUY_ELEMENT_COUNT"] = 4;
        ?>
<?} else {?>




    <div class="content collection-page">
        <div class="container">
<pre><?var_dump($arResult['VARIABLES'])?></pre>

            <div class="collection-tags__wrap">
        <?$APPLICATION->IncludeComponent(
            "kombox:filter",
            "collections",
            array(
                "SECTION_FILTER_URL" => $section_filter_url,
                "CACHE_GROUPS" => "Y",
                "CACHE_TIME" => "36000000",
                "CACHE_TYPE" => "A",
                "CLOSED_OFFERS_PROPERTY_CODE" => array(
                    0 => "RAZMER_SPALNOGO_MESTA",
                    1 => "CML2_LINK",
                    2 => "HEIGHT",
                    3 => "KATEGORY_MATERIALA",
                    4 => "KRASHENIE",
                    5 => "NALICHIE_MEHANIZMA",
                    6 => "razmer_izdeliya",
                    7 => "sizematras",
                    8 => "HEHOL",
                    9 => "WIDTH",
                    10 => "",
                    11 => "typemebeli",
                ),
                "CLOSED_PROPERTY_CODE" => array(
                    0 => "SECTIONS",
                    1 => "typemebeli",
                ),
                "COMPONENT_TEMPLATE" => "wds",
                "CONVERT_CURRENCY" => "N",
                "DETAIL_PAGE_URL" => "#ELEMENT_CODE#/",
                "FIELDS" => array(
                    0 => "SECTIONS",
                    1 => "typemebeli",
                ),
                "FILTER_NAME" => $arParams["FILTER_NAME"],
                "HIDE_NOT_AVAILABLE" => "Y",
                "IBLOCK_ID" => "2",
                "IBLOCK_TYPE" => "catalog",
                "INCLUDE_JQUERY" => "N",
                "IS_SEF" => "N",
                "MESSAGE_ALIGN" => "RIGHT",
                "MESSAGE_TIME" => "0",
                "PAGER_PARAMS_NAME" => "arrPager",
                "PAGE_URL" => "",
                "PRICE_CODE" => array(
                    0 => "BASE",
                ),
                "SAVE_IN_SESSION" => "N",
                "SECTION_CODE" => "",
                "SECTION_ID" => $arCurSection["ID"],
                "SECTION_PAGE_URL" => "#SECTION_CODE_PATH#/",
                "SEF_BASE_URL" => "/",
                "SORT" => "Y",
                "SORT_ORDER" => "ASC",
                "SORT_SECTIONS" => "10",
                "STORES_ID" => array(
                ),
                "TOP_DEPTH_LEVEL" => "0",
                "XML_EXPORT" => "N"
            ),
            $component
        );?>
            </div>
    <?}?>

            <?$intSectionID = $APPLICATION->IncludeComponent(
            "bitrix:catalog.section",
            "visual",
            array(
                "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                "ELEMENT_SORT_FIELD" => $arSORT[0],
                "ELEMENT_SORT_ORDER" => $arSORT[1],
                "ELEMENT_SORT_FIELD2" => $arParams["ELEMENT_SORT_FIELD2"],
                "ELEMENT_SORT_ORDER2" => $arParams["ELEMENT_SORT_ORDER2"],
                "PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
                "META_KEYWORDS" => $arParams["LIST_META_KEYWORDS"],
                "META_DESCRIPTION" => $arParams["LIST_META_DESCRIPTION"],
                "BROWSER_TITLE" => $arParams["LIST_BROWSER_TITLE"],
                "INCLUDE_SUBSECTIONS" => $arParams["INCLUDE_SUBSECTIONS"],
                "BASKET_URL" => $arParams["BASKET_URL"],
                "ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
                "PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
                "SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
                "PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
                "PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
                "FILTER_NAME" => $arParams["FILTER_NAME"],
                "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                "CACHE_TIME" => $arParams["CACHE_TIME"],
                "CACHE_FILTER" => $arParams["CACHE_FILTER"],
                "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                "SET_TITLE" => $arParams["SET_TITLE"],
                "SET_STATUS_404" => $arParams["SET_STATUS_404"],
                "DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
                "PAGE_ELEMENT_COUNT" => $arParams["PAGE_ELEMENT_COUNT"],
                "LINE_ELEMENT_COUNT" => $arParams["LINE_ELEMENT_COUNT"],
                "PRICE_CODE" => $arParams["PRICE_CODE"],
                "USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
                "SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],
        
                "PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
                "USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
                "PRODUCT_PROPERTIES" => $arParams["PRODUCT_PROPERTIES"],
        
                "DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
                "DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
                "PAGER_TITLE" => $arParams["PAGER_TITLE"],
                "PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
                "PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
                "PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
                "PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
                "PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
        
                "OFFERS_CART_PROPERTIES" => $arParams["OFFERS_CART_PROPERTIES"],
                "OFFERS_FIELD_CODE" => $arParams["LIST_OFFERS_FIELD_CODE"],
                "OFFERS_PROPERTY_CODE" => $arParams["LIST_OFFERS_PROPERTY_CODE"],
                "OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
                "OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
                "OFFERS_SORT_FIELD2" => $arParams["OFFERS_SORT_FIELD2"],
                "OFFERS_SORT_ORDER2" => $arParams["OFFERS_SORT_ORDER2"],
                "OFFERS_LIMIT" => 4,//$arParams["LIST_OFFERS_LIMIT"],
        
                "ADD_SECTIONS_CHAIN" => $arParams["ADD_SECTIONS_CHAIN"],
                "SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
                "SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
                "SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
                "DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
                'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
                'CURRENCY_ID' => $arParams['CURRENCY_ID'],
                'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
        
                'LABEL_PROP' => $arParams['LABEL_PROP'],
                'ADD_PICT_PROP' => $arParams['ADD_PICT_PROP'],
                'PRODUCT_DISPLAY_MODE' => $arParams['PRODUCT_DISPLAY_MODE'],
        
                'OFFER_ADD_PICT_PROP' => $arParams['OFFER_ADD_PICT_PROP'],
                'OFFER_TREE_PROPS' => $arParams['OFFER_TREE_PROPS'],
                'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
                'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
                'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
                'MESS_BTN_BUY' => $arParams['MESS_BTN_BUY'],
                'MESS_BTN_ADD_TO_BASKET' => $arParams['MESS_BTN_ADD_TO_BASKET'],
                'MESS_BTN_SUBSCRIBE' => $arParams['MESS_BTN_SUBSCRIBE'],
                'MESS_BTN_DETAIL' => $arParams['MESS_BTN_DETAIL'],
                'MESS_NOT_AVAILABLE' => $arParams['MESS_NOT_AVAILABLE'],
                'VIEW' => $_SESSION['VIEW'],
                "AJAX_MODE" => $arParams['AJAX_MODE_PROP'],
                "AJAX_OPTION_JUMP" => $arParams['AJAX_OPTION_JUMP_PROP'],
                "AJAX_OPTION_STYLE" => $arParams['AJAX_OPTION_STYLE_PROP'],
                "AJAX_OPTION_HISTORY" => $arParams['AJAX_OPTION_HISTORY_PROP'],
                "LAZY_LOAD" => "Y",
                "MESS_BTN_LAZY_LOAD" => "Загрузить ещё",
            ),
            $component
        );
        ?>
        


            <?if (!isset($_GET['PAGEN_1'])):?>
            <div class="rating-catalog">
                <div class="rating-catalog-col rating-catalog-col__left">
                    <h3 class="rating-catalog-title">Оцените наш ассортимент в категории
                        <?if(strpos($pageURI, 'filter') > -1){
                            if(strpos($pageURI, 'price') == false && strpos($pageURI, 'dlina_filter') == false && strpos($pageURI, 'glubina_filter') == false && strpos($pageURI, 'vysota_filter') == false){
                                $APPLICATION->ShowViewContent('filter-title');
                            } else {
                                $APPLICATION->ShowProperty("pageheader");
                            }
                        } else {
                            $APPLICATION->ShowProperty("pageheader");
                        }?>
                    </h3>
                    <div class="">
                        <?$average = round($ratingSection['sum']/$ratingSection['count'], 1);?>
                        <span class="rating-catalog-text">Рейтинг: <b> <?= !is_nan($average) ? $average : 0?> /
                                5</b></span>
                        <span class="rating-catalog-text">Голосов: <b class="count">
                                <?= $ratingSection['count']?></b></span>
                    </div>
                </div>
                <form class="rating-catalog-col rating-catalog-col__right">
                    <input type="hidden" class="rating-catalog-input">
                    <div class="rating-catalog-stars">
                        <?for($i = 1; $i < 6; $i++):?>
                        <div data-val="<?= $i?>" data-sect="<?= $arResult['VARIABLES']['SECTION_CODE']?>"
                            class="rating-catalog-star"></div>
                        <?endfor?>
                    </div>
                    <span class="rating-catalog-toltip">Ваша оценка</span>
                </form>
            </div>

            <script>
                let ratingDisable = true;

                let stars = document.querySelectorAll('.rating-catalog-star');
                stars.forEach((star, i) => {
                    star.onclick = e => {
                        if (ratingDisable) {
                            let valStar = e.target.closest('.rating-catalog-star').getAttribute('data-val');
                            document.querySelector('.rating-catalog-input').value = valStar;
                            for (let x = 0; x < stars.length; x++) {
                                stars[x].classList.remove('active');
                            };
                            for (let x = 0; x < i + 1; x++) {
                                stars[x].classList.add('active');
                            };
                            ratingDisable = false;
                            console.log(ratingDisable);
                        }
                    };
                });
                stars.forEach((star, i) => {
                    star.addEventListener('mouseenter', e => {
                        if (ratingDisable) {
                            let valStar = e.target.closest('.rating-catalog-star').getAttribute(
                                'data-val');
                            document.querySelector('.rating-catalog-input').value = valStar;
                            for (let x = 0; x < stars.length; x++) {
                                stars[x].classList.remove('active');
                            };
                            for (let x = 0; x < i + 1; x++) {
                                stars[x].classList.add('active');
                            };
                            console.log(ratingDisable);
                        }
                    });
                });

                $('.rating-catalog-star').click(function () {
                    let data = {};
                    data['rating'] = $(this).attr('data-val');
                    data['section'] = $(this).attr('data-sect');
                    data['session'] = BX.bitrix_sessid();
                    $.get(
                        '/local/ajax/ratingSection.php',
                        data,
                        function (result) {
                            result = JSON.parse(result);
                            if (result[0] == 'success') {
                                let ratingCount = $('.rating-catalog .count').html();
                                $('.rating-catalog .count').html(Number(ratingCount) + 1)
                            }
                            if (result[0] == 'repeat') {
                                $('.rating-catalog-toltip').html('Вы уже оставляли оценку');
                                $('.rating-catalog-star').removeClass('active');
                                for (let i = 0; i <= result[1]; i++) {
                                    $('.rating-catalog-star[data-val="' + i + '"]').addClass('active');
                                }
                            }
                        }
                    );
                });
                	$('.collection-tags').slick({
                    arrows: true,
                    dots: false,
                    infinite: false,
                    slidesToShow: 5,
                    slidesToScroll: 3,
                    pauseOnHover: false,
                    variableWidth: true,
                    appendArrows: $('.collection-tags__wrap'),
                    prevArrow: `<div class="collection-tags__arrow collection-tags__prev"><img src="/upload/chevron-right.svg" alt=""></div>`,
                    nextArrow: `<div class="collection-tags__arrow collection-tags__next"><img src="/upload/chevron-right.svg" alt=""></div>`,
                    responsive: [
                        {
                        breakpoint: 1025,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3,
                        }
                        },
                        {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2,
                        }
                        },
                        {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                        }
                    ]
                });
            </script>
            <?endif?>
            <?if ($arResult['VARIABLES']['IBLOCK_SECTION_ID'] == 119 || $arResult['VARIABLES']['IBLOCK_SECTION_ID'] == 1287) {?>
</div>
</div>
<?} else {?>
            <!-- /.catalog-cards -->
        </div>

        <!-- /.catalog__content -->
    </div>
    <!-- /.container cotalog__wrap -->
</section>
<!-- /.catalog -->
<?}?>

<?}?>


<div class="seo">
    <div class="container">
        <div class="article">
            <div class="article__floatet-wrap">
                <?=$APPLICATION->ShowProperty("seocontent")?>
            </div>
        </div>
    </div>


    <?if(!isset($_GET['PAGEN_1'])) { ?>
    <div class="seo w1510_seotext">
        <div class="container">
            <div class="left-block">
            </div>
            <div class="article">
                <? if($desc!='') { ?>
                <div class="article__floatet-wrap">
                    <?php if (isset($picurl)): ?>
                    <? if(empty($video)) { ?>
                    <div class="article__img-container">
                        <img src="<?=$picurl?>" alt="<?=$arResult['SECTION']['PICTURE']['ALT']?>" />
                        <? } else { ?>
                        <div class="article__vid-container">
                            <div class="vid">
                                <iframe height="394" frameborder="0" width="700" allowfullscreen=""
                                    src="https://www.youtube.com/embed/-0JuW75mWu8?rel=0&amp;theme=light"></iframe>
                            </div>
                            <? } ?>
                        </div>
                        <?php endif; ?>
                        <?=$desc;?>
                    </div>
                    <? } ?>
                </div>
            </div>
        </div>
    </div>
    <? } 
    $pos = strpos($APPLICATION->GetCurDir(), "filter");
    if($pos) {
      $APPLICATION->AddHeadString('<link rel="canonical" href="https://'.SITE_SERVER_NAME.'/'.$arResult["VARIABLES"]["SECTION_CODE_PATH"].'/"/>',true);
    } 
    $url = $_SERVER['REQUEST_URI'];
    if(strpos($url, '/filter/') > -1){
      $APPLICATION->AddHeadString('<meta name="robots" content="noindex, nofollow" />',true);
    }
				  
    /*** RelinkSection ***/

    // Получим ID's перелиноковок текущего раздела
    $sectionID = $arCurSection;
    $rsSectionProps = CIBlockSection::GetList(array(), array('IBLOCK_ID' => 2, 'ID' =>$sectionID), false, array("UF_SSSS"));
    $arSectionProps = $rsSectionProps->GetNext();
    $arRelinkSection = $arSectionProps['UF_SSSS'];
?>

<div id="bx_recall_popup_form2" style="display:none;" class="bx_login_popup_form">
    <? $APPLICATION->IncludeComponent(
    	"bitrix:form.result.new", 
    	"fb2", 
    	array(
    		"CACHE_TIME" => "3600",
    		"CACHE_TYPE" => "Y",
    		"AJAX_MODE" => "Y",
    		"AJAX_OPTION_JUMP" => "N",
    		"AJAX_OPTION_STYLE" => "N",
    		"AJAX_OPTION_HISTORY" => "N",
    		"CHAIN_ITEM_LINK" => "",
    		"CHAIN_ITEM_TEXT" => "",
    		"EDIT_URL" => "",
    		"IGNORE_CUSTOM_TEMPLATE" => "N",
    		"LIST_URL" => "",
    		"SEF_MODE" => "Y",
    		"SEF_FOLDER" => "/",
    		"SUCCESS_URL" => "",
    		"USE_EXTENDED_ERRORS" => "N",
    		"WEB_FORM_ID" => "7",
    		"COMPONENT_TEMPLATE" => "fb2"
    	),
    	false
    );?>
</div>
<?
$arFilter = array('ACTIVE'=>'Y', "SECTION_ID" => $arResult['VARIABLES']['SECTION_ID']);
$rsSect = CIBlockElement::GetList(["ID"=>"DESC"], $arFilter,  false, []);
$firstEl = $rsSect->fetch();
$file_wm = CFile::ResizeImageGet($firstEl["PREVIEW_PICTURE"], array( "width" => 300, "height" => 220 ), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, false, false);


$arSchema = array(
    "@context" => "https://schema.org/",
    "@type" => "Product",
    "name" => $titleSection,
    "image" => "https://mebelny-dom.com".$file_wm['src'],
    "description" => $APPLICATION->GetPageProperty("description"),
    "category" => "",
    "url" => "https://mebelny-dom.com".$_SERVER['REQUEST_URI'],
    "aggregateRating" => array(
        "@type" => "AggregateRating",
        "worstRating" => "0",
        "bestRating" => "5",
        "ratingValue"=> round($ratingSection['sum']/$ratingSection['count'], 1),
        "reviewCount" => $ratingSection['count']
    ),
    "offers" => array(
        "@type" => "AggregateOffer",
        "priceCurrency" =>	"RUB",
        "availability" => "http://schema.org/InStock",
        "lowPrice"	=> $GLOBALS['MIN_PRICE_FROM_KOMBOX'],
        "highPrice" => $GLOBALS['MAX_PRICE_FROM_KOMBOX'],
        "offerCount" => $rsSect->SelectedRowsCount()
    )
);
$section = CIBlockSection::GetList([], ["ID" => $arResult['VARIABLES']['SECTION_ID']], false, ["NAME", "DEPTH_LEVEL", "IBLOCK_SECTION_ID"], false) -> fetch();
$arSchema['category'] = $section["NAME"];
if($section["DEPTH_LEVEL"] == 2){
	//$section = CIBlockSection::GetList([], ["ID" => $section["IBLOCK_SECTION_ID"]], false, ["NAME"], false) -> fetch();
	$ipropValues = new \Bitrix\Iblock\InheritedProperty\SectionValues(2,$arResult['VARIABLES']['SECTION_ID']);
	$SEO  = $ipropValues->getValues();
    $arSchema['category'] = $SEO['SECTION_PAGE_TITLE'];
	$arSchema['name'] = $SEO['SECTION_PAGE_TITLE'];
}

$jsonSchema = json_encode($arSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK );
$jsonSchema = str_replace('category2', 'category', $jsonSchema);

?>

<?if (!isset($_GET['PAGEN_1'])):?>
<script type="application/ld+json">
    <?= $jsonSchema ?>
</script>
<?endif?>

<script>
$(document).ready(function () {

    $('.catalog__cards').on('click', '.ax-show-more-pagination', function () {

        var targetContainer = $('.js-ax-ajax-pagination-content-container');    //  Контейнер, в котором хранятся элементы
        let url;
        if ($('.ax-show-more-pagination').attr('href')) {
            url = $('.ax-show-more-pagination').attr('href');    //  URL, из которого будем брать элементы
        } else {
            url = $('.ax-show-more-pagination').attr('data-href');    //  URL, из которого будем брать элементы
        }
        if (url !== undefined) {
            $.ajax({
                type: 'GET',
                url: url,
                dataType: 'html',
                success: function (data) {

                    //  Удаляем старую навигацию
                    $('.ax-pagination').remove();

                    var elements = $(data).find('.load_more_item'),  //  Ищем элементы
                        pagination = $(data).find('.ax-pagination');//  Ищем навигацию

                    targetContainer.append(elements);   //  Добавляем посты в конец контейнера
                    targetContainer.append(pagination);
                    slickInit();
                }
            })
        }

        
    });

    $('.container-collection').on('click', '.ax-show-more-pagination', function () {

        var targetContainer = $('.collection-items__wrap'),    //  Контейнер, в котором хранятся элементы
            url = $('.ax-show-more-pagination').attr('href');    //  URL, из которого будем брать элементы

        if (url !== undefined) {
            $.ajax({
                type: 'GET',
                url: url,
                dataType: 'html',
                success: function (data) {

                    //  Удаляем старую навигацию
                    $('.ax-pagination').remove();

                    var elements = $(data).find('.collection-item'),  //  Ищем элементы
                        pagination = $(data).find('.ax-pagination');//  Ищем навигацию

                    targetContainer.append(elements);   //  Добавляем посты в конец контейнера
                    targetContainer.append(pagination);
                    slickInit();
                }
            })
        }

        
    });
    
    
});
</script>