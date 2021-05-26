<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

$this->setFrameMode(true);
?>
<div class="bx_catalog_list js-ax-ajax-pagination-content-container"> 
   <!--ax-ajax-pagination-separator-->
<? if(count($arResult["ITEMS"]) > 0)  { ?> 
 <? foreach($arResult["ITEMS"] as $arItem):?>

            <div class="brands-item page-ajax">
				<?
					$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
					$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
 
                <a href="<? echo $arItem["DETAIL_PAGE_URL"]?>" class="brands-item__img-wrap">
				    <? if($arItem["PREVIEW_PICTURE"]["WIDTH"] > 1 && $arItem["PREVIEW_PICTURE"]["HEIGHT"] > 1) { ?>
					<? $file_wm = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], array( "width" => 250, "height" => 117 ), BX_RESIZE_IMAGE_EXACT, false, false)?>
                       <img loading="lazy" decoding="async" src="<?=$file_wm["src"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>" class="brands-item__img">
                    <? } else { ?>   
                       <img loading="lazy" decoding="async" src="<?=SITE_TEMPLATE_PATH?>/src/img/new_no_img.png" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>" class="brands-item__img">
                    <? } ?>   
                </a>
                <div class="brands-item__text">
                    <a href="<? echo $arItem["DETAIL_PAGE_URL"]?>" class="brands-item__title"><?=$arItem["NAME"]?></a>
                    <? if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"]):?>
                        <div class="news__item-desc">Опубликовано <? echo $arItem["DISPLAY_ACTIVE_FROM"]?> г.</div>
                    <? endif?>
                    <p class="brands-item__desc">
                        <?	$end_pos = 160; $detail_text = $arItem["DETAIL_TEXT"];
							while(substr($detail_text,$end_pos,1)!=" " && $end_pos<strlen($detail_text))
								$end_pos++;
							if($end_pos<strlen($detail_text))
								$detail_text = substr($detail_text, 0, $end_pos)."...";
						   $dtstrlen = strlen($detail_text);
						   if ($dtstrlen > $end_pos): ?>
							<?=$detail_text;?>
							<? else:?>
								<?=$arItem["PREVIEW_TEXT"];?>
							<? endif;?>
                    </p>
                    <a href="<? echo $arItem["DETAIL_PAGE_URL"]?>" class="brands-item__more">Подробнее</a>
                </div>
            </div>
       
<? endforeach;?> 
<? }?>
   <?= $arResult["NAV_STRING"];?> 
   <!--ax-ajax-pagination-separator--> 
</div> 
<? //if($USER->IsAdmin()) {echo '<pre>'; print_r($arResult); echo '</pre>';} ?>
<script>

        $(document).ready(function () {
            $('.js-ax-ajax-pagination-content-container').axpajax({
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
        });
</script>