<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);

?>

            <div class="content-flex">
                <aside class="contside p-news">
                    <div class="contside-container">
                            <ul class="contside__list">
                                 <? CModule::IncludeModule("iblock");
                                    $arSelect = Array("ID", "NAME", "PROPERTY_LINK","PREVIEW_PICTURE","PROPERTY_STRANA","DETAIL_PAGE_URL");
                                    $arFilter = Array("IBLOCK_ID"=>11, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
                                    $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
                                    while($ob = $res->GetNextElement())
                                    {
                                     $arFields = $ob->GetFields(); ?>
                                         <li class="contside__item"><a class="contside__link" href="<?=$arFields["DETAIL_PAGE_URL"]?>"><?=$arFields["NAME"];?> - <?=$arFields["PROPERTY_STRANA_VALUE"]?></a></li>
                                    <? }
                                ?>
                            </ul>
                    </div>
                </aside>
                <div class="contmain p-news">
                    <section class="news">
                        <div class="news__title"><? $APPLICATION->ShowTitle(false)?></div>

							<? $APPLICATION->IncludeComponent(
                                'bitrix:news.list',
                                'brands',
                                Array(
                                    'IBLOCK_TYPE'				=> $arParams['IBLOCK_TYPE'],
                                    'IBLOCK_ID'					=> $arParams['IBLOCK_ID'],
                                    'NEWS_COUNT'				=> $arParams['NEWS_COUNT'],
                                    'SORT_BY1'					=> $arParams['SORT_BY1'],
                                    'SORT_ORDER1'				=> $arParams['SORT_ORDER1'],
                                    'SORT_BY2'					=> $arParams['SORT_BY2'],
                                    'SORT_ORDER2'				=> $arParams['SORT_ORDER2'],
                                    'FIELD_CODE'				=> $arParams['LIST_FIELD_CODE'],
                                    'PROPERTY_CODE'				=> $arParams['LIST_PROPERTY_CODE'],
                                    'DETAIL_URL'				=> $arResult['FOLDER'].$arResult['URL_TEMPLATES']['detail'],
                                    'SECTION_URL'				=> $arResult['FOLDER'].$arResult['URL_TEMPLATES']['section'],
                                    'IBLOCK_URL'				=> $arResult['FOLDER'].$arResult['URL_TEMPLATES']['news'],
                                    'DISPLAY_PANEL'				=> $arParams['DISPLAY_PANEL'],
                                    'SET_TITLE'					=> $arParams['SET_TITLE'],
                                    'SET_STATUS_404'			=> $arParams['SET_STATUS_404'],
                                    'INCLUDE_IBLOCK_INTO_CHAIN'	=> $arParams['INCLUDE_IBLOCK_INTO_CHAIN'],
                                    'CACHE_TYPE'				=> $arParams['CACHE_TYPE'],
                                    'CACHE_TIME'				=> $arParams['CACHE_TIME'],
                                    'CACHE_FILTER'				=> $arParams['CACHE_FILTER'],
                                    'CACHE_GROUPS'				=> $arParams['CACHE_GROUPS'],
                                    'DISPLAY_TOP_PAGER'			=> $arParams['DISPLAY_TOP_PAGER'],
                                    'DISPLAY_BOTTOM_PAGER'		=> $arParams['DISPLAY_BOTTOM_PAGER'],
                                    'PAGER_TITLE'				=> $arParams['PAGER_TITLE'],
                                    'PAGER_TEMPLATE'			=> $arParams['PAGER_TEMPLATE'],
                                    'PAGER_SHOW_ALWAYS'			=> $arParams['PAGER_SHOW_ALWAYS'],
                                    'PAGER_DESC_NUMBERING'		=> $arParams['PAGER_DESC_NUMBERING'],
                                    'PAGER_DESC_NUMBERING_CACHE_TIME'	=> $arParams['PAGER_DESC_NUMBERING_CACHE_TIME'],
                                    'PAGER_SHOW_ALL'			=> $arParams['PAGER_SHOW_ALL'],
                                    'DISPLAY_DATE'				=> $arParams['DISPLAY_DATE'],
                                    'DISPLAY_NAME'				=> 'Y',
                                    'DISPLAY_PICTURE'			=> $arParams['DISPLAY_PICTURE'],
                                    'DISPLAY_PREVIEW_TEXT'		=> $arParams['DISPLAY_PREVIEW_TEXT'],
                                    'PREVIEW_TRUNCATE_LEN'		=> $arParams['PREVIEW_TRUNCATE_LEN'],
                                    'ACTIVE_DATE_FORMAT'		=> $arParams['LIST_ACTIVE_DATE_FORMAT'],
                                    'USE_PERMISSIONS'			=> $arParams['USE_PERMISSIONS'],
                                    'GROUP_PERMISSIONS'			=> $arParams['GROUP_PERMISSIONS'],
                                    'FILTER_NAME'				=> $arParams['FILTER_NAME'],
                                    'HIDE_LINK_WHEN_NO_DETAIL'	=> $arParams['HIDE_LINK_WHEN_NO_DETAIL'],
                                    'CHECK_DATES'				=> $arParams['CHECK_DATES'],
                                    'SEF_FOLDER'				=> $arParams['SEF_FOLDER'],
                                    'ADD_STYLES_FOR_MAIN'		=> $arParams['ADD_STYLES_FOR_MAIN'],
                                    'BRAND_CODE'				=> $arParams['BRAND_CODE'],
                                    'SECTIONS_CODE'				=> $arParams['SECTIONS_CODE'],
                                    'SHOW_BOTTOM_SECTIONS'		=> $arParams['SHOW_BOTTOM_SECTIONS'],
                                    'COUNT_ITEMS'				=> $arParams['COUNT_ITEMS'],
                                    'CATALOG_FILTER_NAME'		=> $arParams['CATALOG_FILTER_NAME'],
                                    'CATALOG_IBLOCK_ID'			=> $arParams['CATALOG_IBLOCK_ID'],
                                    'CATALOG_BRAND_CODE'		=> $arParams['CATALOG_BRAND_CODE'],
                                ),
                                $component,
                                array('HIDE_ICONS'=>'Y')
                            );?>
                    </section>
                </div>
            </div>

<? $APPLICATION->SetTitle("Бренды");?>