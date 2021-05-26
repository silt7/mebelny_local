<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>

<script>
   $('form').addClass('p-company__form'); // добавить класс
</script>             
               
<? if ($arResult["isFormNote"] != "Y")
{
	$arResult["FORM_HEADER"] = preg_replace('#action="[^"]+"#i', 'action="'.$APPLICATION->GetCurPage(false).'"', $arResult["FORM_HEADER"]);

?>
<?=$arResult["FORM_HEADER"]?>
<?
/***********************************************************************************
						form questions
***********************************************************************************/
?>
<div class="p-company__form-wrap">
    <? if ($arResult["isFormErrors"] == "Y"):?><div style="color:#fff !important;">Заполните, пожалуйста, все поля.</div><? endif;?>
    <? if($arResult["FORM_NOTE"]):?>Спасибо! Ваши данные получены!<? endif;?>
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
        <? if ($FIELD_SID == "SIMPLE_QUESTION_921" || $FIELD_SID == 'SIMPLE_QUESTION_528'): ?>
            
            <input type="text" class="p-company__form-input" placeholder="<?=$arQuestion["CAPTION"]?>" name="form_text_<?=$arQuestion['STRUCTURE'][0]['ID']?>">
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

                <input <?=(intval($arResult["F_RIGHT"]) < 10 ? "disabled=\"disabled\"" : "");?> type="submit" name="web_form_submit" value="<?=htmlspecialcharsbx(strlen(trim($arResult["arForm"]["BUTTON"])) <= 0 ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"]);?>" class="p-company__form-sbm"/> 

</div>        
<div class="p-company__form-bot">
    <span class="p-company__form-bot-title">менее 5 минут</span> 
    <span class="p-company__form-bot-desc">нам необходимо чтобы ответить клиенту</span>
</div>
                                                 

<?
} //endif (isFormNote)
?>
<? //if($USER->IsAdmin()) {echo '<pre>'; print_r($arResult); echo '</pre>';} ?>