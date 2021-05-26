<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); ?>       
  <!-- Top Products -->
  <section class="section__front-page section__top-product">
	<div class="container">
	  <h2 class="section__title h2">Популярные товары</h2>
	  <div class="top-product__list">
		<? foreach($arResult["ITEMS"] as $cell=>$arElement):?>	
			<div class="top-product__item">
				<a href="<?=$arElement["DETAIL_PAGE_URL"];?>" class="top-product__link--img">
				<? $file_wm = CFile::ResizeImageGet($arElement["PREVIEW_PICTURE"], array( "width" => 328, "height" => 200 ), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, false, false)?>
				<img
				  decoding="async"
				  loading="lazy"
				  src="<?=$file_wm["src"];?>"
				  alt="<?=$arElement["NAME"]?>"
				  class="top-product__img"
				  width="328"
				  height="200"
				/>
			  </a>
			  <div class="top-product__text">
				  <a href="<?=$arElement["DETAIL_PAGE_URL"];?>" class="top-product__title top-product__link h4"><?=$arElement["NAME"]?></a>
				<?if($arElement["PRICE_DISCOUNT"] > 0):?>
				  	<span class="top-product__price"><?= str_replace('руб.', '₽', CurrencyFormat($arElement["PRICE_DISCOUNT"], "RUB"))?></span>
				<?else:?>
				  	<span class="top-product__price"><?= str_replace('руб.', '₽', CurrencyFormat($arElement["PRICE"], "RUB"))?></span>
				<?endif?>
				<!-- U+20BD -->
			  </div>
			</div>
		<? endforeach?>
	  </div>
	</div>
  </section>