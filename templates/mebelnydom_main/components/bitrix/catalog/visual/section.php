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
?>
<?
$page = $_SERVER["REQUEST_URI"];
if(strpos($page, 'filter') > -1){
    if(strpos($page, 'price') == false && strpos($page, 'dlina_filter') == false && strpos($page, 'glubina_filter') == false && strpos($page, 'vysota_filter') == false){?>
        <h1 class="title-group"><?$APPLICATION->ShowViewContent('filter-title');?></h1>
    <?}else{?>
        <h1 class="title-group"><?=$APPLICATION->ShowProperty("pageheader");?><?php /* $APPLICATION->ShowTitle(false) */ ?></h1>
    <?}
}else{?>
    <h1 class="title-group"><?=$APPLICATION->ShowProperty("pageheader");?><?php /* $APPLICATION->ShowTitle(false) */ ?></h1>
<?}?>
<?if ($USER->IsAdmin()){?>
<!--    --><?//
//    $section_id = $arResult["VARIABLES"]["SECTION_ID"];
//    $res = CIBlockSection::GetByID($section_id);
//    $ar_res = $res->GetNext();
//    ?>
<!--    <pre>-->
<!--        --><?//print_r($ar_res)?>
<!--    </pre>-->
<?}?>

                <?  // ID верхнего раздела
                $resFirstLevelCatID = CIBlockSection::GetByID($arResult['VARIABLES']['SECTION_ID']);
                if($arFirstLevelCat = $resFirstLevelCatID->GetNext()){
                    if($arFirstLevelCat['IBLOCK_SECTION_ID']){
                        $firstLevelCatID = $arFirstLevelCat['IBLOCK_SECTION_ID'];
                    }
                    else{
                        $firstLevelCatID = $arFirstLevelCat['ID'];
                    }
                }
                ?>
                <div class="wds_relink_mobile">
                    <?
                        if($GLOBALS["ALL_SECTIONS_BY_CODE"]){
                            $component = "mebelny";
                        }else{
                            $component = "bitrix";                            
                        }
                        $APPLICATION->IncludeComponent(
                        $component.":catalog.section.list", 
                        "RelinkTagsMobile",
                        array(
                            "ADD_SECTIONS_CHAIN" => "N",
                            "CACHE_GROUPS" => "N",
                            "CACHE_TIME" => "36000000",
                            "CACHE_TYPE" => "N",
                            "COUNT_ELEMENTS" => "Y",
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
                            "COMPONENT_TEMPLATE" => "RelinkTagsMobile",
                            "COMPOSITE_FRAME_MODE" => "A",
                            "COMPOSITE_FRAME_TYPE" => "AUTO"
                        ),
                        $component
                    );?>
                </div>

                <div id="mobile-filter-opener-wrapper">
                    <button id="mobile-filter-opener">
                        Параметры поиска
                    </button>
                </div>


               <div class="filter filter_catalog<?php if ($FILTER_OPEN) echo ' filter-active'; ?>">

					<? 
                    if (!$arParams["FILTER_VIEW_MODE"])
                        $arParams["FILTER_VIEW_MODE"] = "VERTICAL";
                    
                    if ('Y' == $arParams['USE_FILTER'])
                    {
                        if (CModule::IncludeModule("iblock"))
                        {
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



  <?
//    if($USER->IsAdmin()){
//        $tmpl='seo';
//    }
//    else{
        $tmpl='wds';
    //}
  ?>

<?
$page = $APPLICATION->GetCurPage();
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
?>
                   
            <div class="product-content">

                <?// ► САЙДБАР (левый) ?>
                <div class="left-sidebar left-block">     
                    <?// ► ФИЛЬТР ?>
                    <?$APPLICATION->IncludeComponent(
                        "kombox:filter",
                        $tmpl,
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
                                4 => "vysota_sidenya",
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

				<?/*
					foreach ($GLOBALS[$arParams["FILTER_NAME"]] as $k => $f) {
						if (strpos($k, 'CATALOG_PRICE_1') !== false) {
							unset ($GLOBALS[$arParams["FILTER_NAME"]][$k]);
							$GLOBALS[$arParams["FILTER_NAME"]][str_replace('CATALOG_PRICE_1', 'PROPERTY_PRICE', $k)] = $f;
						}
					}
				*/?>

                <?// ► КОНТЕНТ (справа) ?>
                <div class="right-block">

                    <?// ► Перелинковка - подразделы ?>
                    <div class="wds_relink_desktop">
                        <?

                        if($GLOBALS["ALL_SECTIONS_BY_CODE"]){
                            $component = "mebelny";
                        }else{
                            $component = "bitrix";                            
                        }
                        $APPLICATION->IncludeComponent(
                            $component.":catalog.section.list", 
                            "RelinkTags", 
                            array(
                                "ADD_SECTIONS_CHAIN" => "N",
                                "CACHE_GROUPS" => "N",
                                "CACHE_TIME" => "36000000",
                                "CACHE_TYPE" => "N",
                                "COUNT_ELEMENTS" => "Y",
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
                    </div>

                    <?// ► Сортировка ?>
                    <?
                        $sort_price_order = 'PROPERTY_PRICE-DESC'; 
                        $sort_pop_order = 'SHOWS-DESC';
                        $sort_id_order = 'ID-DESC';
                        $sort_qty_order = 'PROPERTY_QTY-ASC';
                        $sort_price_direction = '<img alt="icon" src="/images/arrow-1.svg" class="sort_up"> <img alt="icon" src="/images/arrow-1.svg" class="sort_down">';
                        $sort_pop_direction = '<img alt="icon" src="/images/arrow-1.svg" class="sort_up"> <img alt="icon" src="/images/arrow-1.svg" class="sort_down">';
                        $sort_id_direction = '<img alt="icon" src="/images/arrow-1.svg" class="sort_up"> <img alt="icon" src="/images/arrow-1.svg" class="sort_down">';
                        $sort_qty_direction = '<img alt="icon" src="/images/arrow-1.svg" class="sort_up"> <img alt="icon" src="/images/arrow-1.svg" class="sort_down">';
                        // По цене
                        if($arSORT['0']=='PROPERTY_PRICE' && $arSORT['1']=='ASC'){
                            $sort_price_direction = '<img alt="icon" src="/images/arrow-1.svg" class="sort_up"> <img alt="icon" src="/images/arrow-2.svg" class="sort_down">';
                            $sort_price_order = 'PROPERTY_PRICE-DESC';
                            $sort_price_active = 'active';
                        }
                        if($arSORT['0']=='PROPERTY_PRICE' && $arSORT['1']=='DESC'){
                            $sort_price_direction = '<img alt="icon" src="/images/arrow-2.svg" class="sort_up"> <img alt="icon" src="/images/arrow-1.svg" class="sort_down">';
                            $sort_price_order = 'PROPERTY_PRICE-ASC';
                            $sort_price_active = 'active';
                        }
                        // По Популярности
                       if($arSORT['0']=='SHOWS' && $arSORT['1']=='ASC'){
                            $sort_pop_direction = '<img alt="icon" src="/images/arrow-1.svg" class="sort_up"> <img alt="icon" src="/images/arrow-2.svg" class="sort_down">';
                            $sort_pop_order = 'SHOWS-DESC';
                            $sort_pop_active = 'active';
                        }
                       if($arSORT['0']=='SHOWS' && $arSORT['1']=='DESC'){
                            $sort_pop_direction = '<img alt="icon" src="/images/arrow-2.svg" class="sort_up"> <img alt="icon" src="/images/arrow-1.svg" class="sort_down">';
                            $sort_pop_order = 'SHOWS-ASC';
                            $sort_pop_active = 'active';
                        }
                        // По новизне
                        if($arSORT['0']=='ID' && $arSORT['1']=='ASC'){
                            $sort_id_direction = '<img alt="icon" src="/images/arrow-1.svg" class="sort_up"> <img alt="icon" src="/images/arrow-2.svg" class="sort_down">';
                            $sort_id_order = 'ID-DESC';
                            $sort_id_active = 'active';
                        }
                        if($arSORT['0']=='ID' && $arSORT['1']=='DESC'){
                            $sort_id_direction = '<img alt="icon" src="/images/arrow-2.svg" class="sort_up"> <img alt="icon" src="/images/arrow-1.svg" class="sort_down">';
                            $sort_id_order = 'ID-ASC';
                            $sort_id_active = 'active';
                        }
                        // По наличию
                        if($arSORT['0']=='PROPERTY_QTY' && $arSORT['1']=='ASC'){
                            $sort_qty_direction = '<img alt="icon" src="/images/arrow-1.svg" class="sort_up"> <img alt="icon" src="/images/arrow-2.svg" class="sort_down">';
                            $sort_qty_order = 'PROPERTY_QTY-DESC';
                            $sort_qty_active = 'active';
                        }
                        if($arSORT['0']=='PROPERTY_QTY' && $arSORT['1']=='DESC'){
                            $sort_qty_direction = '<img alt="icon" src="/images/arrow-2.svg" class="sort_up"> <img alt="icon" src="/images/arrow-1.svg" class="sort_down">';
                            $sort_qty_order = 'PROPERTY_QTY-ASC';
                            $sort_qty_active = 'active';
                        }
                    ?>
                    <div class="wds_catalog_sort">
                        <span class="wds_catalog_sort_name">Сортировка по:</span>
                        <span class="jspan_location <?=$sort_price_active?>" data-location="?SORT=<?=$sort_price_order?>">Цене <?=$sort_price_direction?></span>
                        <span class="separate">|</span>
                        <span class="jspan_location <?=$sort_pop_active?>" data-location="?SORT=<?=$sort_pop_order?>">Популярности <?=$sort_pop_direction?></span>
                        <span class="separate">|</span>
                        <span class="jspan_location <?=$sort_id_active?>" data-location="?SORT=<?=$sort_id_order?>">Новизне <?=$sort_id_direction?></span>
                        <span class="separate">|</span>
                        <span class="jspan_location <?=$sort_qty_active?>" data-location="?SORT=<?=$sort_qty_order?>">Наличию <?=$sort_qty_direction?></span>
                    </div>


                        <div class="wds_sort_mobile">
                            <div class="wds_sort_mobile_text">Сортировка по:</div>
                            <div class="wds_sort_mobile_list">
                                <div class="wds_sort_mobile_item">
                                    <span class="jspan_location <?=$sort_price_active?>" data-location="?SORT=<?=$sort_price_order?>">Цене <?=$sort_price_direction?></span>
                                </div>
                                <div class="wds_sort_mobile_item">
                                    <span class="jspan_location <?=$sort_pop_active?>" data-location="?SORT=<?=$sort_pop_order?>">Популярности <?=$sort_pop_direction?></span>
                                </div>
                                <div class="wds_sort_mobile_item">
                                    <span class="jspan_location <?=$sort_id_active?>" data-location="?SORT=<?=$sort_id_order?>">Новизне <?=$sort_id_direction?></span>
                                </div>
                                <div class="wds_sort_mobile_item">
                                    <span class="jspan_location <?=$sort_qty_active?>" data-location="?SORT=<?=$sort_qty_order?>">Наличию <?=$sort_qty_direction?></span>
                                </div>
                            </div>
                            <div class="wds_sort_mobile_select">
                                <div class="wds_left">
                                    <?if($_GET['SORT']=='PROPERTY_PRICE-ASC'):?>
                                        Цене <img alt="icon" src="/images/arrow-1.svg" class="sort_up"> <img alt="icon" src="/images/arrow-2.svg" class="sort_down">
                                    <?elseif($_GET['SORT']=='PROPERTY_PRICE-DESC'):?>
                                        Цене <img alt="icon" src="/images/arrow-2.svg" class="sort_up"> <img alt="icon" src="/images/arrow-1.svg" class="sort_down">
                                    <?elseif($_GET['SORT']=='SHOWS-ASC'):?>
                                        Популярности <img alt="icon" src="/images/arrow-1.svg" class="sort_up"> <img alt="icon" src="/images/arrow-2.svg" class="sort_down">
                                    <?elseif($_GET['SORT']=='SHOWS-DESC'):?>
                                        Популярности <img alt="icon" src="/images/arrow-2.svg" class="sort_up"> <img alt="icon" src="/images/arrow-1.svg" class="sort_down">
                                    <?elseif($_GET['SORT']=='ID-ASC'):?>
                                        Новизне <img alt="icon" src="/images/arrow-1.svg" class="sort_up"> <img alt="icon" src="/images/arrow-2.svg" class="sort_down">
                                    <?elseif($_GET['SORT']=='ID-DESC'):?>
                                        Новизне <img alt="icon" src="/images/arrow-2.svg" class="sort_up"> <img alt="icon" src="/images/arrow-1.svg" class="sort_down">
                                    <?elseif($_GET['SORT']=='PROPERTY_QTY-ASC'):?>
                                        Наличию <img alt="icon" src="/images/arrow-1.svg" class="sort_up"> <img alt="icon" src="/images/arrow-2.svg" class="sort_down">
                                    <?elseif($_GET['SORT']=='PROPERTY_QTY-DESC'):?>
                                        Наличию <img alt="icon" src="/images/arrow-2.svg" class="sort_up"> <img alt="icon" src="/images/arrow-1.svg" class="sort_down">
                                    <?else:?>
                                        Новизне <img alt="icon" src="/images/arrow-2.svg" class="sort_up"> <img alt="icon" src="/images/arrow-1.svg" class="sort_down">
                                    <?endif?>
                                </div>
                                <div class="wds_right"><img alt="icon" src="/images/arrow.svg" width="20"></div>
                                    </div>
                        </div>
                        <script>
                            $('.wds_sort_mobile_select').click(function() {
                                $('.wds_sort_mobile_list').toggle();
                            });
                        </script>


                    <?// ► Список товаров ?>
                    <?$intSectionID = 0;?>

                    <?
//                    if($section_parent_id){
//                        $arResult["VARIABLES"]["SECTION_ID"] = $section_parent_id;
//                    }
                    ?>

                    <?
                    if($filter_url){
                        $arParams["FILTER_NAME"] = '';
                    }

                    $arParams["ALSO_BUY_ELEMENT_COUNT"] = 4;
                    ?>

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
                </div>    
            </div>
        



				<?/*
                    global $sotbitSeoMetaTitle; 
                    global $sotbitSeoMetaKeywords;
                    global $sotbitSeoMetaDescription;
                    global $sotbitSeoMetaBreadcrumbTitle;
                    global $sotbitSeoMetaH1;
					global $sotbitSeoMetaBottomDesc; 
                    
                    if(!empty($sotbitSeoMetaTitle)) 
                    {
                         $APPLICATION->SetTitle($sotbitSeoMetaH1); 
                    } 
                    if(!empty($sotbitSeoMetaTitle))
                    {
                        $APPLICATION->SetPageProperty("title", $sotbitSeoMetaTitle);
                    }
                    if(!empty($sotbitSeoMetaKeywords))
                    {
                        $APPLICATION->SetPageProperty("keywords", $sotbitSeoMetaKeywords);
                    }
                    if(!empty($sotbitSeoMetaDescription))
                    {
                        $APPLICATION->SetPageProperty("description", $sotbitSeoMetaDescription);
                    } 
                    if(!empty($sotbitSeoMetaBreadcrumbTitle) ) {
                        $APPLICATION->AddChainItem($sotbitSeoMetaBreadcrumbTitle  );
                    } 
                */?>      
                       
                       
                   <? 
                       $arFilter = array('IBLOCK_ID' => $arParams['IBLOCK_ID'], "ID" => $arResult['VARIABLES']['SECTION_ID']);
                       $rsSect = CIBlockSection::GetList(array(),$arFilter,  false, $arSelect = array("UF_*","DESCRIPTION","PICTURE"));
                       while ($arSect = $rsSect->GetNext())
                       {
                          $picurl = CFile::GetPath($arSect["PICTURE"]);
						  $desc = $arSect["DESCRIPTION"];
						  $video = $arSect["UF_VIDEO"];
                       }
                   ?>
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
                                    &nbsp;
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
                                                                <iframe height="394" frameborder="0" width="700" allowfullscreen="" src="https://www.youtube.com/embed/-0JuW75mWu8?rel=0&amp;theme=light"></iframe>
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
                  <? } else { ?>

                  <?  } ?>
                  <? $pos = strpos($APPLICATION->GetCurDir(), "filter");
                  if($pos) {
                      $APPLICATION->AddHeadString('<link rel="canonical" href="https://'.SITE_SERVER_NAME.'/'.$arResult["VARIABLES"]["SECTION_CODE_PATH"].'/"/>',true);
                  } else {
                      //$APPLICATION->AddHeadString('<link rel="canonical" href="https://'.SITE_SERVER_NAME.$APPLICATION->GetCurDir().'"/>',true);
                  }?>
                  <? // $APPLICATION->AddHeadString('<link rel="canonical" href="/'.$arResult["VARIABLES"]["SECTION_CODE_PATH"].'/"/>',true);?>
				  <? //$APPLICATION->SetPageProperty('og:description',$sotbitSeoMetaDescription); ?>

				  <?
                  $url = $_SERVER['REQUEST_URI'];
                  if(strpos($url, '/filter/') > -1){
                      $APPLICATION->AddHeadString('<meta name="robots" content="noindex, nofollow" />',true);
                  }
                  ?>
				  
<?/*** RelinkSection ***/?>
<?
    // Получим ID's перелиноковок текущего раздела
    $sectionID = $arCurSection;
    $rsSectionProps = CIBlockSection::GetList(array(), array('IBLOCK_ID' => 2, 'ID' =>$sectionID), false, array("UF_SSSS"));
    $arSectionProps = $rsSectionProps->GetNext();
    $arRelinkSection = $arSectionProps['UF_SSSS'];
?>
<div id="filter-icon-mobile">
    <div>
        <img alt="icon" src="/local/templates/mebelnydom/icons/filter-mobile.svg">
    </div>
</div>


<?/*if(!empty($arRelinkSection)):?>  
    <div class="w1510_relinking_section" id="spilerRelinkBottom_container">
        <div class="container">
            <div class="w1510_flex">
                <?                    
                    // Получим значения перелинковок по их ID
                    $rsRelinkSection = CIBlockSection::GetList(array('left_margin'=>'asc'), array('IBLOCK_ID' => 2, 'ACTIVE'=>'Y', 'ID' =>$arSectionProps['UF_SSSS']), true, array());
                    $i=0;
                    while($arRelinkSection = $rsRelinkSection->GetNext())
                    {
                        $arRelinkSectionItems[]=$arRelinkSection;
                    }
                    foreach($arRelinkSectionItems as $key => $arRelinkSectionItem){
                        if($arRelinkSectionItem[DEPTH_LEVEL]==1) {
                            if($i!=0){
                                echo '</div>';
                            }
                            echo '<div class="list-wrap">';
                        }

                        if($arRelinkSectionItem['DEPTH_LEVEL']==1)
                        {
                        ?>
                            <div class="w1510_relinking_section_heading">
                                <h2> <a href="<?=$arRelinkSectionItem['SECTION_PAGE_URL']?>"><?=$arRelinkSectionItem['NAME']?></a></h2>
                            </div>
                        <?
                        }
                        else
                        {
                            ?>
                                <div class="w1510_relinking_section_item">
                                    <a href="<?=$arRelinkSectionItem['SECTION_PAGE_URL']?>"><?=$arRelinkSectionItem['NAME']?> (<?=$arRelinkSectionItem['ELEMENT_CNT']?>)</a>
                                </div>
                            <?
                        }
                        if(!next($arRelinkSectionItems)){
                            echo '</div>';
                        }
                        $i++;
                    }
                ?>
            </div>
        </div>
    </div>
    <div class="w1510_footer">
        <div class="w1510_spilerRelinkBottom">
            <a class="spoiler_close" id="spilerRelinkBottom_link">ПОКАЗАТЬ КАТАЛОГ<span class="spilerRelinkBottom_down"></span></a>

<?endif*/?>
        
                                
