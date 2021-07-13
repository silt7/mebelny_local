<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use Bitrix\Main\Application;
$request = Application::getInstance()->getContext()->getRequest();

foreach ($arResult['SECTIONS'] as $arSection) {
 $rsSection = CIBlockSection::GetList(array(), array('ID' => $arSection["ID"], 'ELEMENT_SUBSECTIONS' => 'N'), true, array());
   if ($arSection = $rsSection->GetNext()) {
     if ($arSection['ELEMENT_CNT'] !=0) {
        $arResult['ITEMS'][] = $arSection;
    }
  }
}
// arrFilter
    if (count($arResult['SECTIONS']) <= +$_REQUEST['COUNT']) {
      $_REQUEST['COUNT'] = count($arResult['SECTIONS']);
    }
    if (count($arResult['SECTIONS']) < 40) {
      $countSections = count($arResult['SECTIONS']);
    } else {
      $countSections = 40;
    }
?>


<div class="content collections-page">
  <div class="collections-loader" style="display: none;">
    <img width="70" height="70" src="/upload/loader.svg" alt="">
  </div>
	<div class="container container-collection">
		<div class="collection-items__wrap js-ax-ajax-pagination-content-container">
    
    <!--ax-ajax-pagination-separator-->
    <?if($request->isAjaxRequest() == 1) { $APPLICATION->RestartBuffer(); }?>
<?


      $rs = new CDBResult;
      $rs->InitFromArray($arResult['ITEMS']);
      $rs->NavStart(!empty($_REQUEST['COUNT']) ? +$_REQUEST['COUNT'] : $countSections);
      // if($rs->IsNavPrint()) {
    while ($arSection = $rs->Fetch()):
        
        //print_r($arSection["NAME"]);
        $elements = CIBlockElement::GetList (
           Array("SORT" => "ASC"),
           Array("SECTION_ID" => $arSection["ID"], "ACTIVE"=>"Y", array("LOGIC" => "OR", ">PROPERTY_POD_ZAKAZ" => 0, ">PROPERTY_QTY" => 0))
        );
        $countElement = $elements->SelectedRowsCount();
        
        if ($countElement > 0):
        
        $db_list = CIBlockSection::GetList(Array($by=>$order),
        $arFilter = Array("IBLOCK_ID"=>$arSection["IBLOCK_ID"], "ID"=>$arSection["ID"]), true, $arSelect=Array("UF_STRANA"));
        while($ar_result = $db_list->GetNext()) {
          $sectCountry = $ar_result['UF_STRANA'];
        }
    
      ?>

        

    
      <div class="collection-item page-ajax load_more_item" data-id="<?=$arSection['ID']?>">
        <div class="collection-item__imgs">
          <div class="collection-item__slider">
            <? if (!empty($arSection['PICTURE'])) {?>
              <a href="<?=$arSection['SECTION_PAGE_URL']?>" class="collection-item__slide"> 
                <?$renderImage = CFile::ResizeImageGet($arSection['PICTURE'], Array("width" => 270, "height" => 270));
                  echo CFile::ShowImage($renderImage['src'], $newWidth, $newHeight, 'alt="'. $arSection['NAME'] .'"', "", true);?>
              </a>
              <?
              $i = 0;
              $arSelect = Array("ID", "IBLOCK_ID", "CODE", "NAME", "PROPERTY_MORE_PHOTO");
              $arFilter = Array("SECTION_ID" => $arSection['ID'], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
              $res = CIblockElement::GetList(Array("DATE_CREATE" => "DESC"), $arFilter, false, Array("nPageSize"=>3), $arSelect);
              while ($ob = $res->Fetch()) {
                if ($i < 3) {
                  $i++;?>
                  <a href="<?=$arSection['SECTION_PAGE_URL']?>" class="collection-item__slide"> 
                  <?$renderImage = CFile::ResizeImageGet($ob['PROPERTY_MORE_PHOTO_VALUE'], Array("width" => 270, "height" => 270));
                    echo CFile::ShowImage($renderImage['src'], $newWidth, $newHeight, 'alt="'. $arSection['NAME'] .'"', "", true);?>
                  </a>
                <?} else {
                  break;
                }}?>
            <?} else {
              $i = 0;
              $arSelect = Array("ID", "IBLOCK_ID", "CODE", "NAME", "PROPERTY_MORE_PHOTO");
              $arFilter = Array("SECTION_ID" => $arSection['ID'], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
              $res = CIblockElement::GetList(Array("DATE_CREATE" => "DESC"), $arFilter, false, Array("nPageSize"=>4), $arSelect);
              while ($ob = $res->Fetch()) {
                if ($i < 4) {
                  $i++;?>
                <a href="<?=$arSection['SECTION_PAGE_URL']?>" class="collection-item__slide"> 
                <?$renderImage = CFile::ResizeImageGet($ob['PROPERTY_MORE_PHOTO_VALUE'], Array("width" => 270, "height" => 270));
                  echo CFile::ShowImage($renderImage['src'], $newWidth, $newHeight, 'alt="'. $arSection['NAME'] .'"', "", true);?>
                </a>
                <?} else {
                  break;
                }}?>
              <?
              }
              ?>
          </div>
        </div>
        <a href="<?=$arSection['SECTION_PAGE_URL']?>" class="collection-item__title"><?=$arSection['NAME']?></a>
      </div>
<?
    endif;
  endwhile;
  // $rs->NavPrint("", false, false, false);
// }
  $NAV_STRING = $rs->GetPageNavStringEx($navComponentObject, "Товары", "artmix_ajax_pagination", 'N');echo $NAV_STRING;
?>

      <div id='more_load'></div>
      <script>
        $('button.js-ax-show-more-pagination').click(function(){
          let url = $(this).attr('data-href');
          $('.ax-grey').remove();
          $.ajax({
            url: url,
            type:'GET',
            success: function(data){
              $('#more_load').before(function() {
                return data;
              });
            }
          });
        });

      </script>

      <?if($request->isAjaxRequest() == 1) { die(); }?>
    <!--ax-ajax-pagination-separator-->
    
    </div>

  </div>
<div class="container searchResult" style="display: flex">
</div>
</div>
<!-- MORE_PHOTO -->
<script>
  $(document).ready(function(e) {
    //  setTimeout(function() {
      //  $('.ax-pagination-container a').each(function() {
        // let link = $(this).attr('href');
        // link += '&clear_cache=Y#nav_start';
        // $(this).attr('href', link);
      // });
    // }, 100);
    // if ($('.ax-show-more-pagination span').text() != 'Показаны  все товары') {
      // $('.ax-show-more-pagination').append('<a style="position: absolute; left:0; top: 0; width: 100%; height: 100%; opacity: 0; z-index: 1;" href="<?=$_SERVER['REDIRECT_URL']?>?COUNT=<?echo !empty($_REQUEST['COUNT']) ? $_REQUEST['COUNT'] + 20 : 60?>"></a>');
    // }
  });
  if (typeof(jQuery) != 'undefined' && jQuery().axpajax) {
      $(document).ready(function () {
          var paginat = $('.js-ax-ajax-pagination-content-container').axpajax({
              lazyDynamic: false,
              lazyDynamicTimeout: 0,
              lazyDynamicOffset: -300,
              lazyDynamicDelayedStart: false,
              pagination: '.js-ax-ajax-pagination-container a.js-ax-pager-link',
              lazyLoad: '.js-ax-ajax-pagination-container .js-ax-show-more-pagination',
              lazyContainer: '.js-ax-ajax-pagination-container',
              specialParams: {
                  ajax_page: true
              },
              callbacks: {
                  beforeLoad: function (obj) { },
                  afterLoad: function (obj) { },
                  onError: function (err) { }
              }
          });
          console.log(paginat);
      });
  }
</script>
<style>.ax-show-more-pagination{position: relative}</style>


