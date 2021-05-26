<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>

<? if ($arResult["isFormTitle"])
{
?>
<?
} //endif ;  ?>

<? if ($arResult["isFormErrors"] == "Y"):?><span style="color:#DC0003;">Заполните, пожалуйста, все поля.</span><? endif;?>

<? if($arResult["FORM_NOTE"]):?>
  <? echo "<span style='color:#01A200;'>Благодарим за обращение! Мы перезвоним Вам в ближайшее время!</span>";?>
<? endif;?>

<? if ($arResult["isFormNote"] != "Y")
{
?>
<?=$arResult["FORM_HEADER"]?>
<?
if ($arResult["isFormDescription"] == "Y" || $arResult["isFormTitle"] == "Y" || $arResult["isFormImage"] == "Y")
{
?>
	<?
/***********************************************************************************
					form header
***********************************************************************************/

	if ($arResult["isFormImage"] == "Y")
	{
	?>
	<a href="<?=$arResult["FORM_IMAGE"]["URL"]?>" target="_blank" alt="<?=GetMessage("FORM_ENLARGE")?>"><img src="<?=$arResult["FORM_IMAGE"]["URL"]?>" <?if($arResult["FORM_IMAGE"]["WIDTH"] > 300):?>width="300"<?elseif($arResult["FORM_IMAGE"]["HEIGHT"] > 200):?>height="200"<?else:?><?=$arResult["FORM_IMAGE"]["ATTR"]?><?endif;?> hspace="3" vscape="3" border="0" /></a>
	<?//=$arResult["FORM_IMAGE"]["HTML_CODE"]?>
	<?
	} //endif
	?>

			<p><?=$arResult["FORM_DESCRIPTION"]?></p>
	<?
} // endif
	?>
<?
/***********************************************************************************
						form questions
***********************************************************************************/
?>
<script>
   $('form').addClass('form-request js-ajax-form'); // добавить класс
</script>

<div class="row-fields row">            
	<?
	foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion)
	{
		if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'hidden')
		{
			echo "<div>".$arQuestion["HTML_CODE"]."</div>";
		}
		else
		{
	?>     
				<? if (is_array($arResult["FORM_ERRORS"]) && array_key_exists($FIELD_SID, $arResult['FORM_ERRORS'])):?>
				<span class="error-fld" title="<?=$arResult["FORM_ERRORS"][$FIELD_SID]?>"></span>
				<? endif;?>
                <? if ($FIELD_SID == "SIMPLE_QUESTION_166" || $FIELD_SID == 'SIMPLE_QUESTION_578'): ?>
                    <div class="form-group col-field col-sm-6">
                        <input class="form-control form-control-white" name="form_text_<?=$arQuestion['STRUCTURE'][0]['ID']?>" value="" type="text" placeholder="<?=$arQuestion["CAPTION"]?>">
                    </div>
                <? elseif ($FIELD_SID == "SIMPLE_QUESTION_628"): ?>
                    <div class="form-group col-field col-sm-12">
                        <input class="form-control form-control-white" name="form_text_<?=$arQuestion['STRUCTURE'][0]['ID']?>" value="" type="text" placeholder="<?=$arQuestion["CAPTION"]?>">
                    </div>
                <? else:?>   
                    <div class="form-group col-field col-sm-12"> 
                        <textarea class="form-control form-control-white" name="form_textarea_<?=$arQuestion['STRUCTURE'][0]['ID']?>" placeholder="<?=$arQuestion["CAPTION"]?>"></textarea>
                    </div>    
                <? endif;?>
	<?
		}
	} //endwhile
	?>
<?
if($arResult["isUseCaptcha"] == "Y")
{
?>
		<b><?=GetMessage("FORM_CAPTCHA_TABLE_TITLE")?></b>
        <input type="hidden" name="captcha_sid" value="<?=htmlspecialcharsbx($arResult["CAPTCHACode"]);?>" /><img src="/bitrix/tools/captcha.php?captcha_sid=<?=htmlspecialcharsbx($arResult["CAPTCHACode"]);?>" width="180" height="40" />

			<?=GetMessage("FORM_CAPTCHA_FIELD_TITLE")?><?=$arResult["REQUIRED_SIGN"];?>
			<input type="text" name="captcha_word" size="30" maxlength="50" value="" class="inputtext" />
<?
} // isUseCaptcha
?>
</div>

				<input <?=(intval($arResult["F_RIGHT"]) < 10 ? "disabled=\"disabled\"" : "");?> type="submit" name="web_form_submit" value="<?=htmlspecialcharsbx(strlen(trim($arResult["arForm"]["BUTTON"])) <= 0 ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"]);?>" class="btn btn-hvr-white hvr-pulse-grow"/>         

<?
} //endif (isFormNote)
?>
<? //if($USER->IsAdmin()) {echo '<pre>'; print_r($arResult); echo '</pre>';} ?>