<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>


<div class="content collections-page">
	<div class="container">
		<div class="collection-items__wrap">
      <? foreach ($arResult['SECTIONS'] as $arItem) {?>
        <div class="collection-item">
          <div class="collection-item__imgs">
            <div class="collection-item__slider">
              <? if (!empty($arItem['PICTURE']['SRC'])) {?>
                <a href="/collections<?=$arItem['SECTION_PAGE_URL']?>" class="collection-item__slide"> 
                  <img src="<?=$arItem['PICTURE']['SRC']?>" alt="<?=$arItem['NAME']?>"> 
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
                ?>
              }?>
            </div>
          </div>
          <a href="/collections<?=$arItem['SECTION_PAGE_URL']?>" class="collection-item__title"><?=$arItem['NAME']?></a>
        </div>
      <?}?>
    </div>
  </div>
</div>
  <?=$arResult['NAV_STRING'];?>



<!-- MORE_PHOTO -->