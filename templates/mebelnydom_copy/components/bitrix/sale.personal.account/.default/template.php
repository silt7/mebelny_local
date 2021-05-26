<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(strlen($arResult["ERROR_MESSAGE"])<=0):
	echo $arResult["DATE"];
	?><br />
	<ul>
	<?
	foreach($arResult["ACCOUNT_LIST"] as $val)
	{
		?>
		<li><?=$val["INFO"]?></li>
		<?
	}
	?>
	</ul>
	<?
else: ?>
	<div class="alert alert-warning">У Вас пока нет пользовательского счета. Счет будет создан при первой транзакции (пополнение, перевод, начисление вознагржадения за проданные товары).</div>
<? endif;?>