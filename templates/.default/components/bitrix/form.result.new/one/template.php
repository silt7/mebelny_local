<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>

<? if ($arResult["isFormTitle"])
{
?>
<?
} //endif ;  ?>

<? if ($arResult["isFormErrors"] == "Y"):?><div class="form-def__title" style="color:#ed5979 !important;">Заполните, пожалуйста, все поля.</div><? endif;?>

<? if($arResult["FORM_NOTE"] || (isset($_REQUEST['formresult']) && $_REQUEST['formresult'] == 'addok')):?>
    <div class="modal-thanks__img-container">
        <img src="<?=SITE_TEMPLATE_PATH?>/static/img/modal-thanks.png" alt="img" class="modal-thanks__img">
    </div>
    <div class="modal-thanks__title">Спасибо!</div>
    <div class="modal-thanks__desc">Ваша заказ отправлен! Мы перезвоним в ближайшее время.</div>

    <div class="form__submit-wrap">
        <div class="submit-def-arr">
            <a href="#" data-dismiss="modal" class="modal-thanks__ok-btn">OK</a>
        </div>
    </div>
<? return true; endif;?>

<? if ($arResult["isFormNote"] != "Y")
{
	//$arResult["FORM_HEADER"] = preg_replace('#action="[^"]+"#i', 'action="/"', $arResult["FORM_HEADER"]);
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
	<a href="<?=$arResult["FORM_IMAGE"]["URL"]?>" target="_blank" alt="<?=GetMessage("FORM_ENLARGE")?>"><img src="<?=$arResult["FORM_IMAGE"]["URL"]?>" <?if($arResult["FORM_IMAGE"]["WIDTH"] > 300):?>width="300"<? elseif($arResult["FORM_IMAGE"]["HEIGHT"] > 200):?>height="200"<?else:?><?=$arResult["FORM_IMAGE"]["ATTR"]?><?endif;?> hspace="3" vscape="3" border="0" /></a>
	<?//=$arResult["FORM_IMAGE"]["HTML_CODE"]?>
	<?
	} //endif
	?>

		<div class="form-def__title">Вы покупаете <?=$arParams["PRODUCT_NAME"]?></div>
	<?
} // endif
	?>
<?
/***********************************************************************************
						form questions
***********************************************************************************/
?>
<script>
   $('form').addClass('call-form'); // добавить класс
</script>             

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
        <? if ($FIELD_SID == "SIMPLE_QUESTION_921" || $FIELD_SID == 'SIMPLE_QUESTION_528'): ?>
            
            <input type="text" class="input-def" placeholder="<?=$arQuestion["CAPTION"]?>" name="form_text_<?=$arQuestion['STRUCTURE'][0]['ID']?>">
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

        <div class="form__submit-wrap">
            <div class="submit-def-arr">
                <input <?=(intval($arResult["F_RIGHT"]) < 10 ? "disabled=\"disabled\"" : "");?> type="submit" name="web_form_submit" value="<?=htmlspecialcharsbx(strlen(trim($arResult["arForm"]["BUTTON"])) <= 0 ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"]);?>" class="submit-def"/> 
            </div>
        </div>
                                                 

<?
} //endif (isFormNote)
?>
<? //if($USER->IsAdmin()) {echo '<pre>'; print_r($arResult); echo '</pre>';} ?>