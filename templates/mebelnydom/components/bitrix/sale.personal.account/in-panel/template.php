<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<? if(strlen($arResult["ERROR_MESSAGE"])<=0):?>
	<?
	foreach($arResult["ACCOUNT_LIST"] as $val)
	{
		?>		
		   <h3><small>На счёте</small> <?=site::ConvertPrice($val["ACCOUNT_LIST"]["CURRENT_BUDGET"])?> <small><?=  site::GetCurrency()?></small></h3>
           <h5 style="margin-top:-10px;"><small>в базовой валюте - <b><?=CurrencyFormat($val["ACCOUNT_LIST"]["CURRENT_BUDGET"], USD)?></b></small></h5>
		<?
	}
	?>
	<?
else: ?>
<h3><small>На счёте:</small> <b>0.00</b></h3>
<? endif;?>
<? //if($USER->IsAdmin()) {echo '<pre>'; print_r($arResult); echo '</pre>';} ?>