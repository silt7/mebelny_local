<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Localization\Loc;

$this->setFrameMode(true);

if (empty($arParams['RSGOPRO_PROP_TYPES']) || empty($arParams['RSGOPRO_PROP_COORD']))
    return;
?>

<style>
@media screen and (min-width: 1025px) {
  #WSM_MapOffice_YMAP{ 
	width: 100%; height: 80vh !important; 
	}
}
@media screen and (max-width: 1024px) {
	.contact-maps{width:100%; padding:0 10px}
	  #WSM_MapOffice_YMAP{ 
	height: 23vh !important; 
	}
}
@media screen and (max-width: 480px) {
	  #WSM_MapOffice_YMAP{ 
	height: 40vh !important; 
	}
}
</style>
                
                        <div class="contacts-left">
								<?php
                                $APPLICATION->IncludeComponent(
                                    "bitrix:main.include", "", Array(
                                        "AREA_FILE_SHOW" => "file",
                                        "PATH" => $APPLICATION->GetTemplatePath("/include/kontakty.php"),
                                        "EDIT_TEMPLATE" => ""
                                    )
                                );
                                ?>
                        </div>
                        <div class="contacts-right">
                            <div class="contact-maps">
                               <?  /*$APPLICATION->IncludeComponent(
	"wsm:offices.yandexmap", 
	".default", 
	array(
		"IBLOCK_TYPE" => "presscenter",
		"IBLOCK_ID" => "51",
		"POINT_POSITION" => "SHOP_MAP_COORDS",
		"CITY" => "N",
		"USE_GEOIP" => "N",
		"INCLUDE_YMAP_SCRIPT" => "Y",
		"SHOW_TRAFFIC" => "Y",
		"MAP_SET_CENTER_AUTO" => "N",
		"MAP_POINT_PRESET" => "red",
		"MAP_POINT_PRESET_TYPE" => "Dot",
		"BALOON_BODY" => array(
			0 => "NAME2",
			1 => "",
		),
		"OFFICES_WITHOUT_SHOWING_POSITIONS" => "Y",
		"CHECK_PERMISSIONS" => "N",
		"FILTER_NAME" => "",
		"SORT_BY1" => "NAME",
		"SORT_ORDER1" => "ASC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"PROPERTIES" => array(
			0 => "NAME2",
			1 => "ADRES",
			2 => "WORK_TIME",
			3 => "PHONE",
			4 => "",
		),
		"PARENT_SECTION" => "0",
		"PARENT_SECTION_CODE" => "",
		"DETAIL_URL" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"PREVIEW_TRUNCATE_LEN" => "",
		"SORT_CITY_BY1" => "NAME",
		"SORT_CITY_ORDER1" => "ASC",
		"COMPONENT_TEMPLATE" => ".default",
		"MAP_CENTER" => "55.753215,37.622504",
		"MAP_ZOOM" => "12",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
); */?>
                            </div>
                        
                        </div>