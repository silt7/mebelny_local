<?php
if (!defined('B_PROLOG_INCLUDED')||B_PROLOG_INCLUDED !== true)
    die();



$this->setFrameMode(true);

$TOP_DEPTH = $arResult['SECTION']['DEPTH_LEVEL'];

$CURRENT_DEPTH = $TOP_DEPTH;
$strSectionEdit = CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'SECTION_EDIT');
$strSectionDelete = CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'SECTION_DELETE');
$arSectionDeleteParams = array('CONFIRM' => GetMessage('RS.ONEAIR.ELEMENT_DELETE_CONFIRM'));
?>
<? 
	$arSectName = explode('/',$_SERVER['REDIRECT_URL']);
	$arSectName = array_diff($arSectName, array(''));
	$rsSectName = array_pop($arSectName);
?>
<div class="left-nav">
<?$arSection = '';?>
<? $page = $APPLICATION->GetCurPage();?>

	<?//$rsResult1 = CIBlockSection::GetList(array("SORT" => "ASC"), array("IBLOCK_ID" => "2", "ID" => $arSection['ID']), true, array("UF_SECT_TYPES", "UF_TO_TAGS"));?>
	

	<?$userFields = CUserFieldEnum::GetList(array(), array());?>

	<?$arSection2 = array();?>
	<?foreach($userFields->arResult as $userField) :?>
	<?//$toTags = $rsResult1->arUserFields['UF_TO_TAGS']['ID']?>
		
		<?//if(empty($toTags)):?>
		<?if($userField['ID'] != ''):?>
		<?$arResult['SECTION2']['SECTION_TITLE'][] = $userField['VALUE'];?>
			
			<div class="left-sidebar-item" id="id-<?=$userField['ID'];?>">
			<div class="title"><?=$userField['VALUE'];?></div>
			<?foreach($arResult['SECTIONS'] as $arSect) :?>
				<?if($arSect['UF_SECT_TYPES'] == $userField['ID']) :?>
					<?//dump($arSect['UF_TO_TAGS']);?>
					<?//dump($userField);?>
					<?
						$this->AddEditAction($arSect['ID'], $arSect['EDIT_LINK'], $strSectionEdit);
						$this->AddDeleteAction($arSect['ID'], $arSect['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
						if($CURRENT_DEPTH < $arSect['DEPTH_LEVEL'] || !$CURRENT_DEPTH){
							?><ul class="<?=$CURRENT_DEPTH?> left-menu-depth-<?=$arSect['DEPTH_LEVEL'];?>"><?
						}elseif ($CURRENT_DEPTH == $arSect['DEPTH_LEVEL']){
							?></li><?
						}else {
							while($CURRENT_DEPTH > $arSect['DEPTH_LEVEL']){
								?></li><?//endif;?></ul><?
								$CURRENT_DEPTH--;
							}
							?></li><?
						}
						?>
						<?if($arSect['UF_TO_TAGS'] == 0):?>
						<li id="<?=$this->GetEditAreaId($arSect['ID']);?>" class="first"><?
						
							?>
							<a class="clearfix" href="<?=$arSect['SECTION_PAGE_URL']?>" data-name="<?=$arSect['CODE']?>" style="<?if($page === $arSect['SECTION_PAGE_URL']){ echo 'color: #3983df'; }?>"><?
								?><?=$arSect['NAME'];?><?=$arSection2['UF_SECT_TYPES'];?><?
								if($arParams['COUNT_ELEMENTS']){
									?> <span class="count">(<? echo $arSect['ELEMENT_CNT']?>)</span><?
								}
							?></a><?
						$CURRENT_DEPTH = $arSect['DEPTH_LEVEL'];
						
					?>
				<?endif;?>
				<?endif?>
			<? endforeach ?>
			<?
			while($CURRENT_DEPTH > $TOP_DEPTH){
						?></li></ul><?
						$CURRENT_DEPTH--;
					}
			?>
			</div>
		
		<?endif;?>
		<?//endif;?>
	<?endforeach;?>

</div>
<? 
//if($USER->IsAdmin()) {echo '<pre>'; print_r($arResult); echo '</pre>';} ?>