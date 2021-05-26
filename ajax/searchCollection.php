<? 
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

CModule::IncludeModule('iblock');
CModule::IncludeModule('catalog');
CModule::IncludeModule('sale');
?>

<?
$SEARCH_WORD = $_POST['SEARCH_WORD'];
$IBLOCK_ID = 2; // ID Инфоблока в котором ишем элементы
$SECTION_ID = [119, 1287]; // ID разделов в котором ишем элементы
$filterItemId = array(); // В этом массиве будут лежать id найденых элементов. Передать как фильтр при вызове компонента
$arResult['ITEMS'] = array();
?>


<?

$arFilter = array('IBLOCK_ID' => $IBLOCK_ID, "SECTION_ID"=> $SECTION_ID, "ACTIVE"=>"Y");
$rsSections = CIBlockSection::GetList(array('LEFT_MARGIN' => 'ASC'), $arFilter);
while ($arSection = $rsSections->Fetch()) {
  $arFields[] = $arSection;
}
//echo count($arFields);

foreach ($arFields as $key=>$arItem) {
   $rsSection = CIBlockSection::GetList(array(), array('ID' => $arItem["ID"], 'ELEMENT_SUBSECTIONS' => 'N'), true, array());
   if ($arSection = $rsSection->GetNext()) {
     if ($arSection['ELEMENT_CNT'] !=0) {
       if (strripos($arItem['NAME'], $SEARCH_WORD) !== false && !empty($SEARCH_WORD)) {
         $arResult['ITEMS'][] = $arItem;
         $filterItemId[] = $arItem['ID'];
        } else if (empty($SEARCH_WORD)) {
          $arResult['ITEMS'][] = $arItem;
          $filterItemId[] = $arItem['ID'];
        }
      }
    }
}

?>
<div class="collection-items__wrap">
<?
if (count($arResult['ITEMS']) != 0) {
  foreach ($arResult['ITEMS'] as $key=>$item) {?>
  <div class="collection-item" data-id="<?=$item['ID']?>">
    <div class="collection-item__imgs">
      <div class="collection-item__slider">
        <? if (!empty($item['PICTURE'])) {?>
          <a href="/collections/<?=$item['CODE']?>" class="collection-item__slide"> 
            <?$renderImage = CFile::ResizeImageGet($item['PICTURE'], Array("width" => 270, "height" => 270));
            echo CFile::ShowImage($renderImage['src'], $newWidth, $newHeight, 'alt="'. $arSection['NAME'] .'"', "", true);?>
          </a> 
          <?
          $i = 0;
          $arSelect = Array("ID", "IBLOCK_ID", "CODE", "NAME", "PROPERTY_MORE_PHOTO");
          $arFilter = Array("SECTION_ID" => $item['ID'], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
          $res = CIblockElement::GetList(Array("DATE_CREATE" => "DESC"), $arFilter, false, Array("nPageSize"=>3), $arSelect);
          while ($ob = $res->Fetch()) {
            if ($i < 3) {
              $i++;?>
            <a href="/collections/<?=$item['CODE']?>" class="collection-item__slide"> 
              <?$renderImage = CFile::ResizeImageGet($ob['PROPERTY_MORE_PHOTO_VALUE'], Array("width" => 270, "height" => 270));
              echo CFile::ShowImage($renderImage['src'], $newWidth, $newHeight, 'alt="'. $arSection['NAME'] .'"', "", true);?>
            </a>
            <?} else {
              break;
            }
            }?>
        <?} else {
          $i = 0;
          $arSelect = Array("ID", "IBLOCK_ID", "CODE", "NAME", "PROPERTY_MORE_PHOTO");
          $arFilter = Array("SECTION_ID" => $item['ID'], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
          $res = CIblockElement::GetList(Array("DATE_CREATE" => "DESC"), $arFilter, false, Array("nPageSize"=>4), $arSelect);
          while ($ob = $res->Fetch()) {
            if ($i < 4) {
              $i++;?>
            <a href="/collections/<?=$item['CODE']?>" class="collection-item__slide"> 
              <?$renderImage = CFile::ResizeImageGet($ob['PROPERTY_MORE_PHOTO_VALUE'], Array("width" => 270, "height" => 270));
              echo CFile::ShowImage($renderImage['src'], $newWidth, $newHeight, 'alt="'. $arSection['NAME'] .'"', "", true);?>
            </a>
            <?} else {
              break;
            }
            }?>
          <?}?>
        </div>
      </div>
      <a href="/collections/<?=$item['CODE']?>" class="collection-item__title"><?=$item['NAME']?></a>
    </div>

  <?}} else {?>
    <div class="collections-search__result">Коллекции с именем "<?=$SEARCH_WORD?>" не найдены</div>
  <?}?>

  </div>

  
  
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>
