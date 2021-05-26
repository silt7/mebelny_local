<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
function link_info($id){
	$link = CIBlockSection::getList([], ['ID' => $id], false, ['ID', 'IBLOCK_SECTION_ID', 'NAME', 'CODE'])->fetch();
	$section = CIBlockSection::getList([], ['ID' => $link['IBLOCK_SECTION_ID']], false, ['CODE'])->fetch();
	return ['NAME' => $link['NAME'], 'URL' => $section['CODE'].'/'.$link['CODE'].'/'];
};
?>

<!-- Category List -->
<section class="section__front-page section__categories">
	<div class="container">
		<h1 class="section__title h2">Основные разделы</h1>
		<div class="category__list">
			<? while($row = $arParams['SECTIONS']->fetch()):?>
				<div class="category__item">
					<div class="subcategory__list">
						<?foreach($row['UF_LINK_MAIN'] as $id):?>
						<a href="/<?= link_info($id)['URL']; ?>" class="subcategory__item subcategory__link">
								<?= link_info($id)['NAME']; ?>
							</a>
						<? endforeach; ?>
					</div>
					<div class="category__text">
						<a href="/<?= $row['CODE']?>/" class="category__title"><?= $row['NAME']?></a>
						<a href="/<?= $row['CODE']?>/" class="category__link">Смотреть</a>
					</div>
					<img
						decoding="async"
						loading="lazy"
						data-href="/<?= $row['CODE']?>/"
						src="<?= CFile::GetPath($row['UF_IMG_MAIN'])?>"
						alt="<?= $row['NAME']?>"
						class="category__img" />					
				</div>
			<? endwhile; ?>
		</div>
		<a href="#" class="btn__link--all btn-hidden">Смотреть все</a>
	</div>
</section>
<script>
	$('.btn__link--all').click(function(){
		$('.category__item').css('display', 'flex');
	})
</script>