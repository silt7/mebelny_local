<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if(method_exists($this, 'setFrameMode')) 
	$this->setFrameMode(true);
	
if($arResult["ITEMS_COUNT_SHOW"]):
$arParams['MESSAGE_ALIGN'] = isset($arParams['MESSAGE_ALIGN']) ? $arParams['MESSAGE_ALIGN'] : 'LEFT';
$arParams['MESSAGE_TIME'] = intval($arParams['MESSAGE_TIME']) >= 0 ? intval($arParams['MESSAGE_TIME']) : 5;

include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/functions.php");
include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/choice.php");

CJSCore::Init(array("ajax", "popup"));
//$APPLICATION->AddHeadScript("/bitrix/js/kombox/filter/jquery.filter.js");
$APPLICATION->AddHeadScript("/local/templates/mebelnydom/components/kombox/filter/wds/jquery.filter.js");
$APPLICATION->AddHeadScript("/bitrix/js/kombox/filter/ion.rangeSlider.js");
$APPLICATION->AddHeadScript("/bitrix/js/kombox/filter/jquery.cookie.js");

// SEO Условия (noindex, nofollow) для цены и размеров
if($arResult['REQUEST']['dlina_filter_to'] || $arResult['REQUEST']['dlina_filter_from'] || $arResult['REQUEST']['price_to'] || $arResult['REQUEST']['price_from'] || $arResult['REQUEST']['glubina_filter_to'] || $arResult['REQUEST']['glubina_filter_from'] || $arResult['REQUEST']['vysota_filter_to'] || $arResult['REQUEST']['vysota_filter_from']) {
	$APPLICATION->SetPageProperty("robots", "noindex, nofollow");
}
?>
<?if(count($arResult['REQUEST'])>1){
	$APPLICATION->SetPageProperty("robots", "noindex, nofollow");
}?>
<?
    $sectionId = $arParams["SECTION_ID"];
    $arFilter = Array('IBLOCK_ID' => 2, 'ID' => $sectionId, "ACTIVE" => "Y");
    $db_list = CIBlockSection::GetList(Array($by => $order), $arFilter, true, array("ID", "UF_NO_SHOW_SEC_FILT", "UF_NO_SHOW_SIZES", "NAME"));
    $arSection = array();
    while ($ar_result = $db_list->GetNext()) {
        $arSection = $ar_result;
    }
    $noShowFilterSection = 0;
    if($arSection["UF_NO_SHOW_SEC_FILT"] == 1){
        $noShowFilterSection = 1;
    }
    $noShowFilterSizes = 0;
    if($arSection["UF_NO_SHOW_SIZES"] == 1){
        $noShowFilterSizes = 1;
    }
?>
<?
if($arParams["SECTION_FILTER_URL"]){
    $arResult["FORM_ACTION"] = $arParams["SECTION_FILTER_URL"];
    $arResult["DELETE_URL"] = $arParams["SECTION_FILTER_URL"];
}
?>
<div class="kombox-filter" id="kombox-filter">
	<form name="<?echo $arResult["FILTER_NAME"]."_form"?>" action="<?echo $arResult["FORM_ACTION"]?>" method="get"<?if($arResult['IS_SEF']):?> data-sef="yes"<?endif;?>>
		<?foreach($arResult["HIDDEN"] as $arItem):?>
			<input
				type="hidden"
				name="<?echo $arItem["CONTROL_NAME"]?>"
				id="<?echo $arItem["CONTROL_ID"]?>"
				value="<?echo $arItem["HTML_VALUE"]?>"
			/>
		<?endforeach;?>

		<?// ► Цена ?>
		<ul class="wds_filter_block">
		    <li class="wds_filter_header">Цена</li>
			<?foreach($arResult["ITEMS"] as $arItem):?>
				<?if($arItem['NAME']=='Цена'):?>
					<?$showProperty = false;
					if($arItem["SETTINGS"]["VIEW"] == "SLIDER")
					{
						if(isset($arItem["VALUES"]["MIN"]["VALUE"]) && isset($arItem["VALUES"]["MAX"]["VALUE"]) && $arItem["VALUES"]["MAX"]["VALUE"] > $arItem["VALUES"]["MIN"]["VALUE"])
							$showProperty = true;
					}
					elseif(!empty($arItem["VALUES"]) && !isset($arItem["PRICE"]))
					{
						$showProperty = true;
					}
					?>
					<?if($showProperty):?>
							<li class="lvl1<?if($arItem["CLOSED"]):?> kombox-closed<?endif;?>" data-id="<?echo $arItem["CODE_ALT"].'-'.$arItem["ID"]?>">
								<span class="for_modef"></span>	
								<?komboxShowField($arItem);?>
							</li>	
					<?endif;?>
				<?endif?>
			<?endforeach;?>
		</ul>
		
		<?// ► Категории ?>
		<ul class="wds_filter_block">
			<li class="wds_filter_header">Категории (Выбрано <span id="wds_fltr_count"></span>) <a id="invert" href="<?=$arResult["DELETE_URL"]?>">Сбросить</a></li>
			<?foreach($arResult["ITEMS"] as $arItem):?>	
				<?if($arItem['NAME']!='Цена' && $arItem['CODE']!='dlina_filter' && $arItem['CODE']!='glubina_filter' && $arItem['CODE']!='vysota_filter'):?>

					<?$showProperty = false;
					if($arItem["SETTINGS"]["VIEW"] == "SLIDER")
					{
						if(isset($arItem["VALUES"]["MIN"]["VALUE"]) && isset($arItem["VALUES"]["MAX"]["VALUE"]) && $arItem["VALUES"]["MAX"]["VALUE"] > $arItem["VALUES"]["MIN"]["VALUE"])
							$showProperty = true;
					}
					elseif(!empty($arItem["VALUES"]) && !isset($arItem["PRICE"]))
					{
						$showProperty = true;
					}
					?>
					<?if($showProperty):?>
						<?

                            $noShow = '';
                            if($arItem['NAME']=='Раздел' && $noShowFilterSection == 1){
                                $noShow = 'style="display: none"';
                            }
							if($arItem['NAME']=='Раздел'){
								$arItem['NAME']='По типу';
							}
							if($arItem['NAME']=='Производитель'){
								$arItem['NAME']='По производителю';
							}
							if($arItem['NAME']=='Материал'){
								$arItem['NAME']='По материалу';
							}
							if($arItem['NAME']=='Цвет'){
								$arItem['NAME']='По цвету';
							}
						?>
						<?
                        // для разделов неправильно считает количество, если товар прикреплен к разным разделам
                        if($arItem["ID"] == "SECTIONS"){
                            foreach ($arItem["VALUES"] as $key => $arSection){
                                $sectionId = $arSection["VALUE_ID"];
                                $activeElements = CIBlockSection::GetSectionElementsCount($sectionId, Array("CNT_ACTIVE"=>"Y", "ACTIVE"=>"Y"));
                                $arItem["VALUES"][$key]["CNT"] = $activeElements;
                            }
                        }

                        ?>
							<li <?=$noShow?> class="wds_fltr_categories lvl1<?if($arItem["CLOSED"]):?> kombox-closed<?endif;?>" data-id="<?echo $arItem["CODE_ALT"].'-'.$arItem["ID"]?>">
								<div class="kombox-filter-property-head">
									<i class="kombox-filter-property-i"></i>
									<span class="kombox-filter-property-name"><?echo $arItem["NAME"]?> <i>(<?=count($arItem['VALUES']);?>)</i></span>
									<?if(strlen($arItem['HINT'])):?>
									<span class="kombox-filter-property-hint"></span>
									<div class="kombox-filter-property-hint-text"><?echo $arItem['HINT']?></div>
									<?endif;?>
								</div>
								<span class="for_modef"></span>	
								<?komboxShowField($arItem);?>
							</li>	

					<?endif;?>
				<?endif?>

			<?endforeach;?>

		</ul>
        <?if($noShowFilterSizes != 1){?>
		<?// ► Размеры изделий ?>
            <ul class="wds_filter_block">
                <li class="wds_filter_header">Размеры изделий</li>
                <?foreach($arResult["ITEMS"] as $arItem):?>
                    <?if($arItem['CODE']=='dlina_filter' || $arItem['CODE']=='glubina_filter' || $arItem['CODE']=='vysota_filter'):?>
                        <?$showProperty = false;
                        if($arItem["SETTINGS"]["VIEW"] == "SLIDER")
                        {
                            if(isset($arItem["VALUES"]["MIN"]["VALUE"]) && isset($arItem["VALUES"]["MAX"]["VALUE"]) && $arItem["VALUES"]["MAX"]["VALUE"] > $arItem["VALUES"]["MIN"]["VALUE"])
                                $showProperty = true;
                        }
                        elseif(!empty($arItem["VALUES"]) && !isset($arItem["PRICE"]))
                        {
                            $showProperty = true;
                        }
                        ?>
                        <?if($showProperty):?>
                                <li class="lvl1<?if($arItem["CLOSED"]):?> kombox-closed<?endif;?>" data-id="<?echo $arItem["CODE_ALT"].'-'.$arItem["ID"]?>">
                                    <div class="kombox-filter-property-head">
                                        <span class="kombox-filter-property-name"><?echo $arItem["NAME"]?></span>
                                        <?if(strlen($arItem['HINT'])):?>
                                        <span class="kombox-filter-property-hint"></span>
                                        <div class="kombox-filter-property-hint-text"><?echo $arItem['HINT']?></div>
                                        <?endif;?>
                                    </div>
                                    <span class="for_modef"></span>
                                    <?komboxShowField($arItem);?>
                                </li>
                        <?endif;?>
                    <?endif?>
                <?endforeach;?>
            </ul>
        <?}?>

		<input type="submit" id="set_filter" value="<?=GetMessage("KOMBOX_CMP_FILTER_SET_FILTER")?>">
        <a href="" id="set_links_filter">Применить фильтр</a>
		<a href="<?=$arResult["DELETE_URL"]?>" class="kombox-del-filter"><?=GetMessage("KOMBOX_CMP_FILTER_DEL_FILTER")?></a>
		<div class="modef" id="modef" style="display:none">
			<div class="modef-wrap">				
				<a href="<?=$arResult["FILTER_URL"]?>"><?echo GetMessage("KOMBOX_CMP_FILTER_FILTER_SHOW")?></a>
				(<?echo GetMessage("KOMBOX_CMP_FILTER_FILTER_COUNT", array("#ELEMENT_COUNT#" => '<span id="modef_num">'.intval($arResult["ELEMENT_COUNT"]).'</span>'));?>)
				<span class="ecke"></span>
			</div>
		</div>
	</form>
	<div class="kombox-loading"></div>
</div>
<script>
	$(function(){
		komboxFilterJsInit();
		$('#kombox-filter').komboxSmartFilter({
			ajaxURL: '<?echo CUtil::JSEscape($arResult["FORM_ACTION"])?>',
			urlDelete: '<?echo CUtil::JSEscape($arResult["DELETE_URL"])?>',
			align: '<?echo $arParams['MESSAGE_ALIGN']?>',
			modeftimeout: <?echo $arParams['MESSAGE_TIME']?>
		});
	});
</script>
<?endif;?>

<?
unset($arResult["ITEMS"]["SECTIONS"]);
$arValuesChecked = array();
foreach ($arResult["ITEMS"] as $arProp){
    foreach ($arProp["VALUES"] as $arValue){
        if($arValue["CHECKED"] == 1){
            $arValuesChecked[] = $arValue;
        }
    }
}
$countChecked = 0;
if($arValuesChecked){
    $countChecked = count($arValuesChecked);
}
if($countChecked >= 2){
    $filter_title = 'Ваша подборка по критериям: ';
    foreach ($arValuesChecked as $arValue){
        $filter_title .= strtolower($arValue["VALUE"]) . ', ';
    }
    $filter_title = substr($filter_title, 0, -2);
    $APPLICATION->AddViewContent('filter-title', $filter_title);
}
?>

