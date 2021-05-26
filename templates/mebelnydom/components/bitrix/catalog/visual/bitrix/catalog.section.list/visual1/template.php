<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

$strSectionEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT");
$strSectionDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE");
$arSectionDeleteParams = array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM'));

?>
<div class="<? echo $arCurView['CONT']; ?> container content-sm">
           <div class="row category margin-bottom-20">
				<!-- Info Blocks -->



<?
if ('Y' == $arParams['SHOW_PARENT_NAME'] && 0 < $arResult['SECTION']['ID'])
{
	$this->AddEditAction($arResult['SECTION']['ID'], $arResult['SECTION']['EDIT_LINK'], $strSectionEdit);
	$this->AddDeleteAction($arResult['SECTION']['ID'], $arResult['SECTION']['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);

	?><h1
		class="<? echo $arCurView['TITLE']; ?>"
		id="<? echo $this->GetEditAreaId($arResult['SECTION']['ID']); ?>"
	><a href="<? echo $arResult['SECTION']['SECTION_PAGE_URL']; ?>"><?
		echo (
			isset($arResult['SECTION']["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"]) && $arResult['SECTION']["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"] != ""
			? $arResult['SECTION']["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"]
			: $arResult['SECTION']['NAME']
		);
	?></a></h1><?
}
if (0 < $arResult["SECTIONS_COUNT"])
{
?>
		       
<div class="row">
<?
	switch ($arParams['VIEW_MODE'])
	{
		case 'LINE':
			foreach ($arResult['SECTIONS'] as $key => &$arSection)
			{
				$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
				$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);

				?>
                
                  <?  $arFilter = array("IBLOCK_ID"=>"23", "ID"=>$arSection['ID']);       
					  $rsResult = CIBlockSection::GetList(array("SORT" => "ASC"), $arFilter, false, array("UF_*")); 
					  while ($ar = $rsResult -> GetNext()) 
					  {
							$color = $ar["UF_COLOR"];
					  }
				   ?>  
                   	<a href="<? echo $arSection['SECTION_PAGE_URL']; ?>"><div class="col-xs-12 col-md-6 col-lg-4">
                        <ul class="event-list">
                            <li class="bs_cat">
                                <? if(!empty($arSection['PICTURE']["SRC"])):?>
                                 <img alt="<? echo $arSection['NAME']; ?>" src="<? echo $arSection['PICTURE']["SRC"]; ?>" class=" hidden-xs"/>
                                <? else:?>
                                 <img alt="<? echo $arSection['NAME']; ?>" src="<?= SITE_TEMPLATE_PATH."/images/ni1.jpg" ?>" class=" hidden-xs"/>
                                <? endif;?> 
                                <div class="info">
                                    <h2 class="title"><? echo $arSection['NAME']; ?></h2>
                                    <p class="desc">Товаров в разделе: <? echo $arSection['ELEMENT_CNT']; ?>.</p>
                                </div>
                            </li>
        
                        </ul>
                    </div></a>
<?
			}
			unset($arSection);
			break;

	}
}
?>
				</div>
				<!-- End Info Blocks -->

			</div>
			<!-- End Section-Block -->
</div> 
<? /*?>
<script type="text/javascript">
    (function ($) {
        $(function () {
            $('#section').autocolumnlist({
                columns: 3,
				classname: "col-md-4 col-sm-6"
            });
        })
    })(jQuery)
</script><? */?>
<? //if($USER->IsAdmin()) {echo '<pre>'; print_r($arResult); echo '</pre>';} ?>