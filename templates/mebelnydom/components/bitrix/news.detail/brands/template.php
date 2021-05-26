<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

$this->setFrameMode(true);
?>
<? /*?>/filter/fabr-is-".$fabr."/apply/<? */?>
            <div class="content-flex p-company">
                <aside class="contside p-company">
                    <div class="contside-container">
                        <? 
						 	if( isset($arResult['DETAIL_PICTURE']) )
							{
								?><div class="contside__logo-container"><?
									?><img class="contside__logo-img" src="<?=$arResult['DETAIL_PICTURE']['SRC']?>" alt="<?=$arResult['DETAIL_PICTURE']['ALT']?>" title="<?=$arResult['DETAIL_PICTURE']['TITLE']?>"/><?
								?></div><?
							}
						?>			
                        <ul class="contside__list">
							<? 
							  array_unshift($arResult["PROPERTIES"]["LINKS"]["DESCRIPTION"],"empty");
							  array_unshift($arResult["PROPERTIES"]["LINKS"]["VALUE"],"empty");
							  $arFilter = Array('IBLOCK_ID'=>"2", 'ACTIVE'=>'Y', "ACTIVE_DATE"=>"Y", "DEPTH_LEVEL" => "1", "CNT_ACTIVE" => "Y", 'PROPERTY'=>Array('Fabr'=>$arResult["ID"]));
                              $db_list = CIBlockSection::GetList(Array($by=>$order), $arFilter, true);
                              ?>
                    
                              <? while($ar_result = $db_list->GetNext())
                                  {

	                                $key = array_search($ar_result['NAME'], $arResult["PROPERTIES"]["LINKS"]["DESCRIPTION"]);

                                    // ищем внутри корневого раздела раздел, в котором встречается название фабрики
                                      $arFilterChild = Array(
                                          'IBLOCK_ID'=>"2",
                                          'ACTIVE'=>'Y',
                                          "ACTIVE_DATE"=>"Y",
                                          "!DEPTH_LEVEL" => "1",
                                          'SECTION_ID'=>$ar_result["ID"],
                                          '%NAME' => $arResult["NAME"],
                                          "CNT_ACTIVE" => "Y"
                                      );
                                      $db_list_child = CIBlockSection::GetList(Array($by=>$order), $arFilterChild, true);
                                      $arChildSection = array();
                                      $link = '';
                                      $count = '';
                                      while($arChildSection = $db_list_child->GetNext()){
                                          $link = $arChildSection["SECTION_PAGE_URL"];
                                          $count = $arChildSection["ELEMENT_CNT"];
                                      }
                                      if(!$link) {
                                          if ($key > 0) {
                                              $link = $arResult["PROPERTIES"]["LINKS"]["VALUE"][$key];
                                          } else {
                                              $link = '/' . $ar_result['CODE'] . '/filter/fabr-' . $arResult["PROPERTIES"]["PROPERTY_CODE"]["VALUE"] . '/';
                                          }
                                      }
                                      if(!$count){
                                          $count =  $ar_result['ELEMENT_CNT'];
                                      }

                                      $fabr = ToLower(str_replace(" ", "+", $arResult['NAME']));

	                                echo "<li class='contside__item'><a class='contside__link' href=".$link.">".$ar_result['NAME']." <span class='contside__link-mark'>«".$arResult['NAME']."»</span> (".$count.')</a></li>';
	                                //echo "<pre>"; print_r($ar_result); echo "</pre>";
                                  }
                            ?>
							
                        </ul>
                        <div class="contside__share-wrap">
                            <div class="contside__share">
                                <h3>Поделиться с друзьями</h3>


<script type="text/javascript">(function(w,doc) {
if (!w.__utlWdgt ) {
    w.__utlWdgt = true;
    var d = doc, s = d.createElement('script'), g = 'getElementsByTagName';
    s.type = 'text/javascript'; s.charset='UTF-8'; s.async = true;
    s.src = ('https:' == w.location.protocol ? 'https' : 'http')  + '://w.uptolike.com/widgets/v1/uptolike.js';
    var h=d[g]('body')[0];
    h.appendChild(s);
}})(window,document);
</script>
<div data-mobile-view="false" data-share-size="20" data-like-text-enable="false" data-background-alpha="0.0" data-pid="1700711" data-mode="share" data-background-color="#ffffff" data-share-shape="round-rectangle" data-share-counter-size="12" data-icon-color="#ffffff" data-mobile-sn-ids="fb.vk.tw.ok.wh.vb.tm." data-text-color="#000000" data-buttons-color="#FFFFFF" data-counter-background-color="#ffffff" data-share-counter-type="disable" data-orientation="horizontal" data-following-enable="false" data-sn-ids="fb.vk.tw.ok.gp.mr.lj.em." data-preview-mobile="false" data-selection-enable="false" data-exclude-show-more="true" data-share-style="1" data-counter-background-alpha="1.0" data-top-button="false" class="uptolike-buttons" ></div>

                            </div>
                        </div>
                    </div>
                </aside>
                <div class="contmain p-company">
                    <article class="article">
                        <h1><?=$arResult['PROPERTIES']["TITLE"]["VALUE"]?></h1>
                        <div class="article-cols">
                            <div class="article-col-left">
                                <?=$arResult['DETAIL_TEXT']?>
                            </div>
                            <div class="article-col-right">
                              <? foreach($arResult['DISPLAY_PROPERTIES']["MORE_PHOTO"]["FILE_VALUE"] as $PHOTO) { ?>
                                <div class="article__img-container">
                                    <? $file_wm = CFile::ResizeImageGet($PHOTO["ID"], array( "width" => 221, "height" => 150 ), BX_RESIZE_IMAGE_EXACT, false, false)?>
                                    <a href="<?=$PHOTO["SRC"]?>" data-lightbox="fabr-photo"><img src="<?=$file_wm["src"]?>" alt="<?=$PHOTO["DESCRIPTION"]?>"></a>
                                </div>
                              <? } ?>
                            </div>
                        </div><br>
                        <div class="video-container">
                            <iframe width="100%" height="460" src="https://www.youtube.com/embed/<?=$arResult['PROPERTIES']["VIDEO"]["VALUE"]?>" frameborder="0" allowfullscreen></iframe>
                        </div>
                    </article>
    
                    <? //if($USER->IsAdmin()) {echo '<pre>'; print_r($arResult); echo '</pre>'; }?>