<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();
?>
<!-- Reviews -->
<section class="section__front-page section__reviews">
	<div class="container">
		<h2 class="section__title h2">Отзывы</h2>
		<p class="section__description">
			Мы&nbsp;предоставляем только достоверные отзывы из&nbsp;яндекс и&nbsp;гугл
		</p>
	</div>
	<div class="swiper-section-review">
		<!-- Swiper -->
		<div class="swiper-container-review">
			<div class="swiper-wrapper">
				<?foreach($arResult['REVIEWS'] as $item):?>
					<div class="swiper-slide" style="width: 392px;">
						<div class="review__item">
							<div class="review__author">
								<img width="24" alt="<?= $item['NAME']?>" src="<?= $this->GetFolder().$item['GENDER']?>" height="24" decoding="async" loading="lazy" class="review__author--ava" />
								<span class="review__author--name"><?= $item['NAME']?></span>
							</div>
							<div class="review__source">
								<img alt="<?= $item['SOURCE_ALT']?>" src="<?= $this->GetFolder().$item['SOURCE']?>" decoding="async" loading="lazy" class="review__source--img" />
								<div class="review__stars">
									<?for($i = 0; $i < (int)$item['RATING']; $i++):?>
										<span class="review__star fill" style="background-image: url(<?= $this->GetFolder()?>/imgs/star-fill.svg)"></span>
									<?endfor;?>
									<?for($i = 0; $i < 5 - (int)$item['RATING']; $i++):?>
										<span class="review__star" style="background-image: url(<?= $this->GetFolder()?>/imgs/star.svg)"></span>
									<?endfor;?>
								</div>
							</div>
							<p class="review__description">
								<?= $item['PREVIEW_TEXT']?>
							</p>
						</div>
					</div>
				<?endforeach;?>
			</div>
		</div>
		<!-- Add Arrows -->
		<div class="swiper-button-review-next"></div>
		<div class="swiper-button-review-prev"></div>
		<!-- Add Pagination -->
		<div class="swiper-pagination-review"></div>
	</div>
</section>