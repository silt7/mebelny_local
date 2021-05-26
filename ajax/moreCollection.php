<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="content collections-page">
	<div class="container">
		<div class="collection-items__wrap">
<?
 $rs = new CDBResult;
  $rs->InitFromArray($arResult['SECTIONS']);
  $rs->NavStart(40);
  if($rs->IsNavPrint()) {
    while ($arSection = $rs->Fetch()):
    $db_list = CIBlockSection::GetList(Array($by=>$order),
    $arFilter = Array("IBLOCK_ID"=>$arSection["IBLOCK_ID"], "ID"=>$arSection["ID"]), true, $arSelect=Array("UF_STRANA"));
    while($ar_result = $db_list->GetNext()) {
      $sectCountry = $ar_result['UF_STRANA'];
    }
    ?>
      <div class="collection-item">
        <div class="collection-item__imgs">
          <div class="collection-item__slider">
            <? if (!empty($arSection['PICTURE']['SRC'])) {?>
              <a href="<?=$arSection['SECTION_PAGE_URL']?>" class="collection-item__slide"> 
                <img src="<?=$arSection['PICTURE']['SRC']?>" alt="<?=$arSection['NAME']?>"> 
              </a>
            <?} else {
              $arSelect = Array("ID", "IBLOCK_ID", "CODE", "NAME", "PROPERTY_HTML_CONTENT");
              $arFilter = Array("ID" => 25554, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", "PROPERTY_MORE_PHOTO");
              $res = CIblockElement::GetList(Array("DATE_CREATE" => "DESC"), $arFilter, false, $arPages, $arSelect);
              while($ob = $res->GetNextElement()) {
                $arFields = $ob->GetFields();
                $arProps = $ob->GetProperties();
                $arResult['ITEMS'][$arFields['ID']] = $arFields;
                $arResult['ITEMS'][$arFields['ID']]['PROPERTIS'] = $arProps;
              }
            }?>
          </div>
        </div>
        <a href="<?=$arSection['SECTION_PAGE_URL']?>" class="collection-item__title"><?=$arSection['NAME']?></a>
      </div>
<?
  endwhile;
  // $rs->NavPrint("", false, false, false);
}
?>
    </div>
<?$NAV_STRING = $rs->GetPageNavStringEx($navComponentObject, "Товары", "artmix_ajax_pagination", 'N');
echo $NAV_STRING."<br>";?>
  </div>
</div>