<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();
?>
<!-- Brands -->
<section class="section__front-page section__brands">
<div class="container">
  <h2 class="section__title h2">Бренды</h2>
  <div class="brands__list">
	<?foreach($arResult['BRENDS'] as $item): ?>
		<a href="<?= $item['URL']?>"
		  ><img
			decoding="async"
			loading="lazy"
			src="<?= $item['PREVIEW_PICTURE']?>"
			alt="<?= $item['NAME']?>"
			class="brands__item"
		/></a>
	<?endforeach?>
  </div>
  <a href="/brands/" class="btn__link--all">Смотреть все</a>
</div>
</section>