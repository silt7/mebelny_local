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

        <!--<img src="<?=SITE_TEMPLATE_PATH?>/static/img/modal-thanks.png" alt="img" class="modal-thanks__img">-->

    </div>

    <div class="modal-thanks__title">Спасибо!</div>

    <div class="modal-thanks__desc">Ваша заявка принята!</div>



    <div class="form__submit-wrap">

        <div class="submit-def-arr">

            <span data-dismiss="modal" class="modal-thanks__ok-btn" onClick="popupHide()">OK</span>

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



		<div class="form-def__title title-html">

			<?php if (!empty($arResult['arrVALUES']) && !empty($arResult['arrVALUES']['form_hidden_13'])) { ?>

			Вы заказываете "<?=$arResult['arrVALUES']['form_hidden_13']?>"

			<?php } else { ?>
            <?if($arResult['arForm']['SID'] == 'WEB_FORM_DETAIL'):?>
                Сообщить о поступлении товара
                (<? print_r($GLOBALS['PRODUCT_NAME']);?>)
			<?else:?>   
			    Получить консультацию
            <?endif?>
			<?php } ?>

		</div>

	<?

} // endif

	?>

<?

/***********************************************************************************

						form questions

***********************************************************************************/

?>

	<?



	foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion)

	{

		if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'hidden')

		{ ?>

			<? echo "<div>".$arQuestion["HTML_CODE"]."</div>"; ?>

		<? }

		else

		{

	?>     

		<? if (is_array($arResult["FORM_ERRORS"]) && array_key_exists($FIELD_SID, $arResult['FORM_ERRORS'])):?>

        <span class="error-fld" title="<?=$arResult["FORM_ERRORS"][$FIELD_SID]?>"></span>

        <? endif;?>

        <? if ($FIELD_SID == "SIMPLE_QUESTION_921" || $FIELD_SID == 'SIMPLE_QUESTION_528'): ?>

            <input type="text" class="input-def" placeholder="<?=$arQuestion["CAPTION"]?>" name="form_text_<?=$arQuestion['STRUCTURE'][0]['ID']?>">

        <? endif;?>
        
        <?if($arResult['arForm']['SID'] == 'WEB_FORM_DETAIL' && $FIELD_SID == 'SIMPLE_QUESTION_EMAIL'): ?>
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

                <input <?=(intval($arResult["F_RIGHT"]) < 10 ? "disabled=\"disabled\"" : "");?> type="submit" name="web_form_submit" value="<?=htmlspecialcharsbx(strlen(trim($arResult["arForm"]["BUTTON"])) <= 0 ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"]);?>" class="submit-def formbuyconsult" /> 

            </div>

        </div>

<?

} //endif (isFormNote)

?>
</form>
<script>

jQuery(document).ready(function ($) {
    $('.formbuyconsult').closest('form').submit(function(){

        ga('send', 'event', '1click', 'submit_form');

        yaCounter26789943.reachGoal('1click');

        console.log('Event: 1click');

        return true;

    });

});
jQuery(document).ready(function ($) {
	$('.detailProductOneClick').click(function() {
		$('.formbuyconsult').parents('form').attr({"onsubmit": "ym(26789943,'reachGoal','1click', {URL: document.location.href})"});
	});
	$('.footer-callback-btn').click(function() {
		$('.formbuyconsult').parents('form').attr({"onsubmit": "ym(26789943,'reachGoal','callback-or-freeconsultation', {URL: document.location.href})"});
	});
	$('.call-me').click(function() {
		$('.formbuyconsult').parents('form').attr({"onsubmit": "ym(26789943,'reachGoal','callback-or-freeconsultation', {URL: document.location.href})"});
	});
});
</script>