<? 
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

CModule::IncludeModule('iblock');
CModule::IncludeModule('catalog');
CModule::IncludeModule('sale');
?>

<?
$SEARCH_WORD = $_POST['SEARCH_WORD'];
$IBLOCK_ID = 2; // ID Инфоблока в котором ишем элементы
$SECTION_ID = 119; // ID раздела в котором ишем элементы
$filterItemId = array(); // В этом массиве будут лежать id найденых элементов. Передать как фильтр при вызове компонента
$arResult['ITEMS'] = array();
?>


<?

$arSelect = Array("ID", "IBLOCK_ID", "CODE", "NAME", "DETAIL_PAGE_URL", "PROPERTY_*");

$arFilter = array('IBLOCK_ID' => $IBLOCK_ID, "SECTION_ID"=> $SECTION_ID);
$rsSections = CIBlockSection::GetList(array('LEFT_MARGIN' => 'ASC'), $arFilter);
while ($arSection = $rsSections->Fetch()) {
  $arFieldss[] = $arSection;
}

?>
<!-- PICTURE -->
<?

$arSort = Array("DATE_CREATE" => "DESC");
$arFilter = Array("IBLOCK_ID"=>$IBLOCK_ID, "SECTION_ID"=> $SECTION_ID, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
$arSelect = Array("ID", "IBLOCK_ID", "CODE", "NAME", "DETAIL_PAGE_URL", "PROPERTY_*");
$res = CIblockElement::GetList($arSort, $arFilter, false, false, $arSelect);
while($ob = $res->GetNextElement()) {
  $arFields[$ob->GetFields()['ID']] = $ob->GetFields();
  $arFields[$ob->GetFields()['ID']]['PROPERTIES'] = $ob->GetProperties();
}

foreach ($arFields as $key=>$arItem) {
  if (strripos($arItem['NAME'], $SEARCH_WORD) !== false && !empty($SEARCH_WORD)) {
    $arResult['ITEMS'][] = $arItem;
    $filterItemId[] = $arItem['ID'];
  } else if (empty($SEARCH_WORD)) {
    $arResult['ITEMS'][] = $arItem;
    $filterItemId[] = $arItem['ID'];
  }
}

// Сейчас вывожу карточки перебором, после интеграции верстки с колекиями подключить компонент вместо перебора ниже и передайть ему в качестве фильтра $filterItemId В нем лежат нужные ID элементов

if (count($arResult['ITEMS']) != 0) {
  foreach ($arResult['ITEMS'] as $key=>$item) {?>

  <div class="collection-item" data-id="<?=$item['ID']?>">
    <div class="collection-item__imgs">
      <div class="collection-item__slider">
        <? foreach ($item['PROPERTIES']['IMAGES']['VALUE'] as $key=>$image) {?>
          <a href="<?=$item['DETAIL_PAGE_URL']?>" class="collection-item__slide"> 
            <img src="<?=CFile::GetPath($image)?>" alt="">
          </a> 
          <?}?>
        </div>
      </div>
      <a href="<?=$item['DETAIL_PAGE_URL']?>" class="collection-item__title"><?=$item['NAME']?></a>
    </div>

  <?}} else {?>
    <div class="collections-search__result">Коллекции с именем "<?=$SEARCH_WORD?>" не найдены</div>
  <?}?>

  
  
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>
