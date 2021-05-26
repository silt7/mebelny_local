<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/**
 * @global CMain $APPLICATION
 */

global $APPLICATION;
//print_r($arResult);
foreach ($arResult as $key => $arItem){
	if($key != 0){ // не учитываем главную
		if($key == 1){ // верхний раздел
			$code = $arItem["LINK"];
			$code = substr($code, 1);
			$code = substr($code, 0, -1);
			$parentId = 0;
			$parentSectionId = 0;
			if(CModule::IncludeModule("iblock")){
				$dbSection = CIBlockSection::GetList(
					array("SORT"=>"ASC"),//сортировка по возрастанию. нам все равно
					array(
						"IBLOCK_ID" => 2,
						"CODE" => $code//и по найденному SECTION_CODE
					),
					false,
					array("ID", "NAME", "UF_BREADCRUMBS_NAME")
				);
				if ($arSection = $dbSection->GetNext()){
					$parentId = $arSection["ID"];
					$parentSectionId = $arSection["ID"];
					if($arSection["UF_BREADCRUMBS_NAME"]){
						$arResult[$key]["TITLE"] = $arSection["UF_BREADCRUMBS_NAME"];
					}
				}
			}
		}else{ // не верхний раздел
			if($parentId && $arItem["LINK"]){
				$arLink = explode('/', $arItem["LINK"]);
				$codeChild = $arLink[count($arLink) -2];
				if(CModule::IncludeModule("iblock")){
					$dbSection = CIBlockSection::GetList(
						array("SORT"=>"ASC"),//сортировка по возрастанию. нам все равно
						array(
							"IBLOCK_ID" => 2,
							"CODE" => $codeChild,
							"SECTION_ID" => $parentId
						),
						false,
						array("ID", "NAME", "UF_BREADCRUMBS_NAME")
					);
					if ($arSectionChild = $dbSection->GetNext()){
						$parentId = $arSectionChild["ID"];
						if($arSectionChild["UF_BREADCRUMBS_NAME"]){
							$arResult[$key]["TITLE"] = $arSectionChild["UF_BREADCRUMBS_NAME"];
						}
					}
				}
			}
		}
	}
}

//delayed function must return a string
if(empty($arResult))
	return "";

$strReturn = '';

//we can't use $APPLICATION->SetAdditionalCSS() here because we are inside the buffered function GetNavChain()
$css = $APPLICATION->GetCSSArray();

$strReturn .= '<div class="breadcrums page-top__breadcrums"><div class="breadcrums__wrap">';

$itemSize = count($arResult);
for($index = 0; $index < $itemSize; $index++)
{
	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);

	$nextRef = ($index < $itemSize-2 && $arResult[$index+1]["LINK"] <> ""? ' itemref="bx_breadcrumb_'.($index+1).'"' : '');
	$child = ($index > 0? ' itemprop="child"' : '');
	if($arResult[$index]["LINK"] <> "" && $index != $itemSize-1)
	{
		if (($index == 2) && ($GLOBALS["FOR_BREADCRUMB"] == 'detail')){       
            $db_list = \Bitrix\Iblock\SectionTable::GetList([
                'order' =>  ["SORT"=>"ASC"],
                'select' => ['ID', 'NAME', 'CODE'],
                'filter' => ['ACTIVE'=>'Y', 'IBLOCK_SECTION_ID'=>$parentSectionId],
                'limit' => 5
            ])->fetchAll();
            if(!empty($db_list)){
                $strReturn .= '<div class="breadcrums__item breadcrums__item-drop" style="position:relative">';
    		    $strReturn .= '<a href="'.$arResult[$index]["LINK"].'" class="breadcrums__link breadcrums__link-drop">'.$title.'</a>';
                $strReturn .= '<div class="breadcrums__item-list" style="display: none;">';
                foreach($db_list as $item){
                    $strReturn .= '<a href="/'.$code.'/'.$item['CODE'].'/" class="breadcrums__link breadcrums__link">'.$item['NAME'].'</a>';
                }
                $strReturn .= '</div>';
    			$strReturn .= '</div>';
            } else {
                $strReturn .= '<a href="'.$arResult[$index]["LINK"].'" class="breadcrums__link">'.$title.'</a>';
            }
		} else {
		    $strReturn .= '<a href="'.$arResult[$index]["LINK"].'" class="breadcrums__link">'.$title.'</a>';
		}
	}
	else
	{
		$strReturn .= '
			<span class="breadcrums__link breadcrums__link__last">'.$title.'</span>';
	}
}

$strReturn .= '</div></div>';?>
<?//print_r($arResult)?>
<?
$arSchemaLinks = array();
foreach ($arResult as $key => $item){
    $arSchemaLinks[] = array(
        "@type" => "ListItem",
        "position" => $key +1,
        "name" => $item["TITLE"],
        "item" => "https://mebelny-dom.com" . $item["LINK"]
    );
}
// удаляем последнюю ссылку
$contItems = count($arSchemaLinks);
unset($arSchemaLinks[$contItems-1]["item"]);
$arSchema = array(
    "@context" => "https://schema.org",
    "@type" => "BreadcrumbList",
    "itemListElement" => $arSchemaLinks
);

$jsonSchema = json_encode($arSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK );

$jsonSchema = '<script type="application/ld+json">' . $jsonSchema . '</script>';

$strReturn .= $jsonSchema;
?>
<?
    $strReturn .= '
    	<script>
    		$(".breadcrums__link-drop").on("click", function(e) {
    			e.preventDefault();
    			$(this).toggleClass("active");
    			if ($(this).hasClass("active")) {
    				$(this).parents(".breadcrums__item").find(".breadcrums__item-list").animate({"height": "show"}, 300);
    			} else {
    				$(this).parents(".breadcrums__item").find(".breadcrums__item-list").animate({"height": "hide"}, 300);
    			}
    		});
    		$("body").on("click", function(e) {
    			if (!e.target.closest(".breadcrums__item-list") && !e.target.closest(".breadcrums__item-drop")) {
    				$(".breadcrums__link-drop").toggleClass("active");
    				$(".breadcrums__item-list").animate({"height": "hide"}, 300);
    			}
    		});
    	</script>';
?>
<?return $strReturn;?>
