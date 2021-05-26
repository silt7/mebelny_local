<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Localization\Loc;

$this->setFrameMode(true);
?>
              <?php foreach ($arResult["ITEMS"] as $arItem): ?>
                    <div class="shares-article news">
                        <span class="akcii-home-name" onclick="return location.href = '<?=$arItem["DETAIL_PAGE_URL"];?>'"><?=$arItem["NAME"];?></span>
                        <p><?
						$end_pos = 160; $detail_text = $arItem["PREVIEW_TEXT"];
						while(substr($detail_text,$end_pos,1)!=" " && $end_pos<strlen($detail_text))
							$end_pos++;
						if($end_pos<strlen($detail_text))
							$detail_text = substr($detail_text, 0, $end_pos)."...";
					   $dtstrlen = strlen($detail_text);
					   if ($dtstrlen > $end_pos): ?>
						<?=$detail_text;?>
						<? else:?>
							<?=$arItem["PREVIEW_TEXT"];?>
						<? endif;?></p>
                    </div>
              <? endforeach;?>
              <span onclick="return location.href = '/akcii/'" class="akcii-home-link">Все акции</span>