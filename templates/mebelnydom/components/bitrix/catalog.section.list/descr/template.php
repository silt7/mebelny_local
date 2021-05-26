<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

$this->setFrameMode(true);
?>
<style>
   .seo .left-block { margin-top:-110px;}
</style>
<div class="article__floatet-wrap">  
	<?php if (isset($arResult['SECTION']['PICTURE']['SRC'])): ?>
       <div class="article__img-container">
          <img src="<?=$arResult['SECTION']['PICTURE']['SRC']?>" alt="<?=$arResult['SECTION']['PICTURE']['ALT']?>" title="<?=$arResult['SECTION']['PICTURE']['TITLE']?>" />
       </div>
    <?php endif; ?>
    <?=$arResult['SECTION']['DESCRIPTION']?>
</div>