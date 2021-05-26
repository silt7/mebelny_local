<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
	$this->setFrameMode(true);
	CJSCore::Init(array("ajax", "popup"));?>

<?
    $uri = explode('/', $_SERVER['REQUEST_URI']);
    if( isset($uri[2]) ){
        $res = CIBlockSection::GetList(array(), array('IBLOCK_ID' => $arItem["IBLOCK_ID"], 'CODE' => $uri[2]));
        $sectionUri = $res->Fetch();
        
        $elements = CIBlockElement::GetList (
           Array("SORT" => "ASC"),
           Array("SECTION_ID" => $sectionUri["ID"], array("LOGIC" => "OR", ">PROPERTY_POD_ZAKAZ" => 0, ">PROPERTY_QTY" => 0))
        );
        
        $sectionArr = [];
           
        global $arrFilter;
        
        if( isset($arrFilter['ID']) ){
            $arrFilter = [];
        }
        while ($element = $elements->GetNext()){
            $sections = CIBlockElement::GetElementGroups($element['ID'], false, ["CODE", "NAME", "PROPERTY_QTY"]);
            while ($section = $sections->GetNext()){
                if($uri[3] == 'filter'){
                    $filter = explode('-', $uri[4]);
                    $filter = $filter[1];
                    if($section['CODE'] == $filter){
                        $arrFilter['ID'][$element['ID']] = $element['ID'];
                    }
                }
                
                $sectionArr[$section['CODE']] = $section;
            }
        } 
    }
?>
<div class="collection-tags__wrap">
	<div class="collection-tags">
	<?foreach($arResult["ITEMS"] as $arItem) {
		if($arItem["ID"] == "SECTIONS"){
			foreach ($arItem["VALUES"] as $key => $arValue){
					$sectionId = $arValue["VALUE_ID"];
					
					$activeElements = CIBlockSection::GetSectionElementsCount($sectionId, Array("CNT_ACTIVE"=>"Y", "ACTIVE"=>"Y"));
					$arItem["VALUES"][$key]["CNT"] = $activeElements;?>
					
                <?if(array_key_exists($arValue['CONTROL_NAME_ALT'], $sectionArr)):?>
    				<div data-id="<?=$arItem['ID']?>" class="collection-tag__item <?echo $arValue['CHECKED'] ? 'selected' : ''?>">
    				    <?//print_r($key)?>
    					<?if ($arValue['CHECKED']) {?>
    						<a href="/<?=$arParams['VARS']["SECTION_CODE_PATH"]?>" class="collection-tag__back"><img src="/upload/close.png" width="16" alt=""></a>
    					<?}?>
    					<a href="/<?echo $arParams['VARS']["SECTION_CODE_PATH"].'/filter/sections-'.$arValue['CONTROL_NAME_ALT'].'/'?>"><?=$arValue['VALUE']?> 
    						<!-- <span><?=$arValue['CNT']?></span> -->
    					</a>
    				</div>
    			<?endif?>
			<?}?>
		<?}?>
	<?}?>
</div>
</div>

<!-- <pre><?//var_dump($arParams['VARS'])?></pre> -->