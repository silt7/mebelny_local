<?php
if (!defined('B_PROLOG_INCLUDED')||B_PROLOG_INCLUDED !== true)
    die();

$this->setFrameMode(true);

$TOP_DEPTH = $arResult['SECTION']['DEPTH_LEVEL'];
$CURRENT_DEPTH = $TOP_DEPTH;

$strSectionEdit = CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'SECTION_EDIT');
$strSectionDelete = CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'SECTION_DELETE');
$arSectionDeleteParams = array('CONFIRM' => GetMessage('RS.ONEAIR.ELEMENT_DELETE_CONFIRM'));

foreach($arResult['SECTIONS'] as $key => $arSection){
	$this->AddEditAction($arResult['SECTION']['ID'], $arResult['SECTION']['EDIT_LINK'], $strSectionEdit);
	$this->AddDeleteAction($arResult['SECTION']['ID'], $arResult['SECTION']['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
	if($CURRENT_DEPTH < $arSection['DEPTH_LEVEL'] || !$CURRENT_DEPTH){
		?><ul><?
	} elseif ($CURRENT_DEPTH == $arSection['DEPTH_LEVEL']){
		?></li><?
	} else {
		while($CURRENT_DEPTH > $arSection['DEPTH_LEVEL']){
			?></li></ul><?
			$CURRENT_DEPTH--;
		}
		?></li><?
	}
	?><li id="<?=$this->GetEditAreaId($arSection['ID']);?>" class="first"><?
		?><a class="clearfix" href="<?=$arSection['SECTION_PAGE_URL']?>"><?
			?><?=$arSection['NAME'];?><?
			if($arParams['COUNT_ELEMENTS']){
				?> <span class="count">(<? echo $arSection['ELEMENT_CNT']?>)</span><?
			}
		?></a><?
	$CURRENT_DEPTH = $arSection['DEPTH_LEVEL'];
}

while($CURRENT_DEPTH > $TOP_DEPTH){
	?></li></ul><?
	$CURRENT_DEPTH--;
}

//if($USER->IsAdmin()) {echo '<pre>'; print_r($arResult); echo '</pre>';} ?>