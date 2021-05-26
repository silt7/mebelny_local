<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$j = 0;
$choiceShow = false;
$choiceHtml  = '<div class="kombox-filter-choice">';
if(is_array($arResult["ITEMS"]) && !empty($arResult["ITEMS"]))
{
    foreach($arResult["ITEMS"] as $k => $arItem){
        
		if($arItem['SETTINGS']['VIEW'] == 'SLIDER'){
			if(!empty($arItem["VALUES"]["MIN"]["HTML_VALUE"]) || !empty($arItem["VALUES"]["MAX"]["HTML_VALUE"])){
				$choiceHtml .= "<ul><li class=\"kombox-filter-choice-item-name\">".$arItem["NAME"].": </li>";
				
				if(!empty($arItem["VALUES"]["MIN"]["HTML_VALUE"])){
					$choiceShow = true;
					$value = $arItem["VALUES"]["MIN"]["HTML_VALUE"];
					$choiceHtml .= "<li><a class=\"kombox-remove-link\" href=\"javascript:void(0)\" data-filter=\"{$arItem["VALUES"]["MIN"]["CONTROL_ID"]}\">";
					$choiceHtml .= GetMessage('KOMBOX_CMP_FILTER_FROM')." {$value}";
					$choiceHtml .= "<span></span></a>";
					$choiceHtml .= "</li>";
					++$j;
				}
				
				if(!empty($arItem["VALUES"]["MAX"]["HTML_VALUE"])){
					$choiceShow = true;
					$value = $arItem["VALUES"]["MAX"]["HTML_VALUE"];
					$choiceHtml .= "<li><a class=\"kombox-remove-link\" href=\"javascript:void(0)\" data-filter=\"{$arItem["VALUES"]["MAX"]["CONTROL_ID"]}\">";
					$choiceHtml .= GetMessage('KOMBOX_CMP_FILTER_TO')." {$value}";
					$choiceHtml .= "<span></span></a>";
					$choiceHtml .= "</li>";
					++$j;
				}
				$choiceHtml .= "</ul>";
			}
		}
		elseif(!empty($arItem["VALUES"])){
            if($arItem["CHECKED"]){
				$choiceHtml .= "<ul><li class=\"kombox-filter-choice-item-name\">".$arItem["NAME"].": </li>";
				foreach($arItem["VALUES"] as $val => $ar)
				{
					if($ar["CHECKED"]){
						$choiceShow = true;
						$value = ($ar['NAME'])? $ar["NAME"] : $ar['VALUE'];
						$choiceHtml .= "<li><a class=\"kombox-remove-link\" href=\"javascript:void(0)\" data-filter=\"{$ar['CONTROL_NAME']}\">";
						$choiceHtml .= "{$value}";
						$choiceHtml .= "<span></span></a>";
						$choiceHtml .= "</li>";
						++$j;
					}
				} 
				$choiceHtml .= "</ul>";
			}			
        }
    }
}


if($j > 1){
    $choiceHtml .= "<ul><li>";
    $choiceHtml .= "<a class=\"kombox-remove-all-link kombox-remove-link\" href=\"{$arResult["DELETE_URL"]}\">".GetMessage('KOMBOX_CMP_ALL_DELETE')."<span></span></a>";
    $choiceHtml .= "</li></ul>";
}
$choiceHtml .= "<div class=\"kombox-filter-choice-count\">".GetMessage('KOMBOX_CMP_CHOICE_COUNT')." ".$arResult['ELEMENT_COUNT']." ".GetMessage('KOMBOX_CMP_CHOICE_COUNT_UNIT')."</div>";
$choiceHtml .= "</div>";

if($choiceShow)
{
    $this->SetViewTarget("kombox-filter-choice");
        echo $choiceHtml;
    $this->EndViewTarget();
}
?>