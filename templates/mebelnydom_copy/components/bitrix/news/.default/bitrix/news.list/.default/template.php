<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<? if(count($arResult["ITEMS"]) > 0)  { ?>
<? foreach($arResult["ITEMS"] as $arItem):?>
        <ul class="news__list">
            <li class="news__item">
				<?
					$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
					$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
                <div class="news__item-left">
                    <div class="news__item-img-container">
                        <a href="<? echo $arItem["DETAIL_PAGE_URL"]?>">
						    <? if($arItem["PREVIEW_PICTURE"]["WIDTH"] > 473 && $arItem["PREVIEW_PICTURE"]["HEIGHT"] > 221) { ?>
							<? $file_wm = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], array( "width" => 474, "height" => 222 ), BX_RESIZE_IMAGE_EXACT, false, false)?>
                               <img src="<?=$file_wm["src"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>" class="news__item-img">
                            <? } else { ?>   
                               <img src="<?=SITE_TEMPLATE_PATH?>/src/img/new_no_img.png" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>" class="news__item-img border-img">
                            <? } ?>   
                        </a>
                        <? //if($USER->IsAdmin()) {echo '<pre>'; print_r($file_wm); echo '</pre>'; } ?>

                    </div>
                </div>
                <div class="news__item-right">
                    <div class="news__item-title"><a href="<? echo $arItem["DETAIL_PAGE_URL"]?>" class="news__item-title"><?=$arItem["NAME"]?></a></div>
                    <? if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"]):?>
                        <div class="news__item-desc">Опубликовано <? echo $arItem["DISPLAY_ACTIVE_FROM"]?> г.</div>
                    <? endif?>
                    <div class="news__item-text">
                     <?		$end_pos = 160; $detail_text = $arItem["PREVIEW_TEXT"];
							while(substr($detail_text,$end_pos,1)!=" " && $end_pos<strlen($detail_text))
								$end_pos++;
							if($end_pos<strlen($detail_text))
								$detail_text = substr($detail_text, 0, $end_pos)."...";
						   $dtstrlen = strlen($detail_text);
						   if ($dtstrlen > $end_pos): ?>
							<?=$detail_text;?></p>
							<? else:?>
								<?=$arItem["PREVIEW_TEXT"];?>
							<? endif;?>
                    </div>
                    <a href="<? echo $arItem["DETAIL_PAGE_URL"]?>" class="news__item-btn">Подробнее</a>
                </div>
            </li>
        </ul>
<? endforeach;?>     

<? if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<? endif;?>
<? } else { ?>
 <div class="article"><p>В этом разделе еще нет записей.</div>
<? } ?>