<?php
if (!defined('B_PROLOG_INCLUDED')||B_PROLOG_INCLUDED !== true)
    die();

//$this->setFrameMode(true);
//$this->addExternalJS($templateFolder."/js/tags.js");

$arIds = array();
$countSection = 0;
foreach($arResult["SECTIONS"] as $section){
    $arIds[] = $section["ID"];
    if($section['UF_TO_TAGS']==1 && $section["ACTIVE"]=="Y"){
        $countSection++;
    }
}
$arFilterCodes = array();
$arFilter = Array('IBLOCK_ID' => 2, 'ID' => $arIds, "ACTIVE" => "Y");
$db_list = CIBlockSection::GetList(Array($by => $order), $arFilter, true, array("ID", "UF_URL_FILTER", "NAME"));
while ($ar_result = $db_list->GetNext()) {
    $arFilterCodes[$ar_result['ID']] = $ar_result;
}

foreach($arResult['SECTIONS'] as $k => $v){
    $subArr[$k] = $v["NAME"];
}
natsort($subArr);
$subArrTmp = $arResult['SECTIONS'];
unset($arResult['SECTIONS']);
foreach($subArr as $k => $v) {
    $arResult['SECTIONS'][$k] = $subArrTmp[$k];
}
?>
<?if($arResult['SECTIONS']):?>

    <?/*** RelinkMenuTags ***/?>
    <div class="catalog__tags tags">
        <?$page = $APPLICATION->GetCurPage(); $i=0;?>
        <?foreach($arResult['SECTIONS'] as $arSection):
            $active = '';
            if($page == $arSection["SECTION_PAGE_URL"]){
                $active = 'active';
            }
            if($arSection['UF_TO_TAGS']==1 && $arSection["ACTIVE"]=="Y"):?>
                <?if($i == 0){?>
                    <div class="tags-items_1">
                <?} elseif($i == intval($countSection/2)){?>
                    </div><div class="tags-items_2">
                <?}?>
                <a href="<?=$arSection['SECTION_PAGE_URL']?>" class='tags-item w1510_menuTags_item <?= $active?>' data-filter="<?=$arFilterCodes[$arSection["ID"]]["UF_URL_FILTER"]?>">
                    <span class="tags-item__text"><?=$arSection['NAME']?></span>
                    <span class="tags-item__count"><?=$arSection['ELEMENT_CNT']?></span>
                </a>
				<?if($i == $countSection):?>
                    </div>
                <?endif?>
                <? $i++;?>
            <?endif?>
        <?endforeach?>
    </div>                       
<?endif?>