<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
if($arResult['ITEMS'])
{   
	$last = array_pop($arResult['ITEMS']);
	foreach($arResult['ITEMS'] as $Item)
	{
		?>
			<?
			if($Item['TITLE'] && $Item['URL'])
			{
				?>
					<a href="<?=$Item['URL'] ?>" title="<?=$Item['TITLE'] ?>" class="tags-link"><?=$Item['TITLE'] ?></a>,
				<?
			}
			?>
		<?
	} ?>
	<a href="<?=$last['URL'] ?>" title="<?=$Item['TITLE'] ?>" class="tags-link"><?=$last['TITLE'] ?></a>
<? }

?>