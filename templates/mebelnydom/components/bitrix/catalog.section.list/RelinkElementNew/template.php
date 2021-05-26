<?php
if (!defined('B_PROLOG_INCLUDED')||B_PROLOG_INCLUDED !== true)
    die();
$this->setFrameMode(true);
?>
<?pr($arParams['SECTIONS_TIED'], false, false);?>

<div class="w1510_relinking_section" id="spilerRelinkElement_container">
	<div class="container">
		<div class="w1510_flex"> 
			<?
			$TOP_DEPTH = $arResult['SECTION']['DEPTH_LEVEL'];
			$CURRENT_DEPTH = $TOP_DEPTH;
			$strSectionEdit = CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'SECTION_EDIT');
			$strSectionDelete = CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'SECTION_DELETE');
			$arSectionDeleteParams = array('CONFIRM' => GetMessage('RS.ONEAIR.ELEMENT_DELETE_CONFIRM'));
			$arSectName = explode('/',$_SERVER['REDIRECT_URL']);
			$arSectName = array_diff($arSectName, array(''));
			$rsSectName = array_pop($arSectName);
			$arSection = '';
			$page = $APPLICATION->GetCurPage();
			?>

			<?$rsResult1 = CIBlockSection::GetList(array("SORT" => "ASC"), array("IBLOCK_ID" => "2", "ID" => $arSection['ID']), true, array("UF_SECT_TYPES"));?>

				<?$userFields = CUserFieldEnum::GetList(array(), array());?>
				<?$arSection2 = array();?>
				<?foreach($userFields->arResult as $userField) :?>
					
					<?if($userField['ID'] != ''):?>
					<?$arResult['SECTION2']['SECTION_TITLE'][] = $userField['VALUE'];?>
						
						<div class="list-wrap">
						<div class="w1510_relinking_section_heading"><h2><a><?=$userField['VALUE'];?></a></h2></div>

						<?foreach($arResult['SECTIONS'] as $arSect):?>

							<?if(in_array($arSect['ID'], $arParams['SECTIONS_TIED'])):?>
							
								<?if($arSect['UF_SECT_TYPES'] == $userField['ID']):?>
									<?if($CURRENT_DEPTH < $arSect['DEPTH_LEVEL'] || !$CURRENT_DEPTH){
											?><ul><?
										}elseif ($CURRENT_DEPTH == $arSect['DEPTH_LEVEL']){
											?></li><?
										}else {
											while($CURRENT_DEPTH > $arSect['DEPTH_LEVEL']){
												?></li></ul><?
												$CURRENT_DEPTH--;
											}
											?></li><?
										}
										?><li class="w1510_relinking_section_item">
											<a href="<?=$arSect['SECTION_PAGE_URL']?>">
												<?=$arSect['NAME'];?><?=$arSection2['UF_SECT_TYPES'];?><?
												if($arParams['COUNT_ELEMENTS']){
													?> <span class="count">(<? echo $arSect['ELEMENT_CNT']?>)</span>

											</a><?
												
										$CURRENT_DEPTH = $arSect['DEPTH_LEVEL'];
									?>
								<?endif?>

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
				<?endforeach?>


		</div>
	</div>
</div>