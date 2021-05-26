<?  $iblock_id = 42;
	$elements = GetIBlockElementList($iblock_id, 1233, ['SORT'=>'ASC'], 0, ['ACTIVE' => 'Y']);?>
	<div class="swiper-section">
	<!-- Swiper -->
	<div class="swiper-container">
	  <div class="swiper-wrapper">
		<?while($row = $elements->fetch()):?>
		<?$db_props = CIBlockElement::GetProperty($iblock_id, $row['ID'], "sort", "asc", array());
		$PROPS = array();
		while($ar_props = $db_props->GetNext())
			$PROPS[$ar_props['CODE']] = $ar_props['VALUE'];?>

		<div class="swiper-slide main-slide">
		  <a href="<?= $PROPS['LINK']?>" class="swiper-link">
			<? $file_wm = CFile::ResizeImageGet($row["DETAIL_PICTURE"], array( "width" => 360, "height" => 360 ), BX_RESIZE_IMAGE_EXACT, false, false)?>
			<? $file = CFile::ResizeImageGet($row["DETAIL_PICTURE"], array( "width" => 1224, "height" => 560 ), BX_RESIZE_IMAGE_EXACT, false, false)?>
			<picture>
			  <source
				srcset="<?= $file_wm["src"]?>"
				media="(max-width: 500px)"
			  />
			  <source
				srcset="<?= $file["src"]?>"
				media="(min-width: 500px)"
			  />
			  <img
				decoding="async"
				loading="lazy"
				class="swiper-img main-slide__img"
				src="<?= $file["src"]?>"
				alt="<?= $row['NAME']?>"
			  />
			</picture>
			<div class="swiper-text">
			  <span class="swiper-text-brand h4">
				<?= CIBlockElement::GetByID($PROPS['BREND'])->fetch()['NAME'];?>
			  </span>
			  <span class="swiper-text-title h1"><?= $row['NAME']?></span
			  >
			  <span class="swiper-text-price h4"><?= $PROPS['TITLE2']?></span
			  >
			</div>
		  </a>
		</div>
		<?endwhile?>
	  </div>
	</div>
	<!-- Add Arrows -->
	<div
	  class="swiper-button-next"
	  tabindex="0"
	  role="button"
	  aria-label="Следующий слайд"
	></div>
	<div
	  class="swiper-button-prev"
	  tabindex="0"
	  role="button"
	  aria-label="Предыдущий слайд"
	></div>
	<!-- Add Pagination -->
	<div class="swiper-pagination"></div>
  </div>