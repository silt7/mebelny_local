<?php
if (!defined('B_PROLOG_INCLUDED')||B_PROLOG_INCLUDED !== true)
    die();

$this->setFrameMode(true);
?>



<ul class="footer-list">
	<?foreach($arResult['SECTIONS'] as $key => $arSection):?>
		<?if($arSection['DEPTH_LEVEL']==1):?>
			<?if($arSection['UF_TO_FOOTER']==1):?>
				<li><a href="<?=$arSection['SECTION_PAGE_URL']?>"><?=$arSection['NAME']?></a></li>
			<?endif?>
		<?endif?>		
	<?endforeach?>
</ul>