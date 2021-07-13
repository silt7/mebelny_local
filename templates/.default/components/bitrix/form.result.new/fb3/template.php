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

    <div>Спасибо!</div>

    <div>Ваша заявка принята!</div>

    <span data-dismiss="modal" onClick="$('.popup').fadeOut(300); $('.popup-wrapper').fadeOut(300);">OK</span>



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
			    <div class="popup-title"><?= $arResult['arForm']['NAME'];?></div>
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
            <label for="form_text_<?=$arQuestion['STRUCTURE'][0]['ID']?>"><?=$arQuestion["CAPTION"]?></label>
            <input type="text" class="input-def" name="form_text_<?=$arQuestion['STRUCTURE'][0]['ID']?>">

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


        <?if($arResult['arForm']['SID'] == 'CLICK_1'):?>
            <label>Товар</label>
    		<div class="one_click-prod-item">
    			<img src="" alt="prod" width="70px">
    			<span class="one_click-prod-name"></span>
    			<div class="quantity-popup">
    			  <input type="number" min="1" max="9" step="1" value="1">
    			  <div class="quantity-nav"><div class="quantity-button quantity-up">+</div><div class="quantity-button quantity-down">–</div></div>
    			</div>
    		</div>
    		<span class="call-cancel" onClick="$('.popup').fadeOut(300); $('.popup-wrapper').fadeOut(300);">Отмена</span>
    	    <input onclick="return send();" <?=(intval($arResult["F_RIGHT"]) < 10 ? "disabled=\"disabled\"" : "");?> type="submit" name="web_form_submit" value="<?=htmlspecialcharsbx(strlen(trim($arResult["arForm"]["BUTTON"])) <= 0 ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"]);?>" class="submit-def formbuyconsult" /> 
    	<?else:?>
    	    <span class="call-cancel" onClick="$('.popup').fadeOut(300); $('.popup-wrapper').fadeOut(300);">Отмена</span>
    	    <input <?=(intval($arResult["F_RIGHT"]) < 10 ? "disabled=\"disabled\"" : "");?> type="submit" name="web_form_submit" value="<?=htmlspecialcharsbx(strlen(trim($arResult["arForm"]["BUTTON"])) <= 0 ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"]);?>" class="submit-def formbuyconsult" /> 
    	<?endif?>



<?

} //endif (isFormNote)

?>
</form>

<?if($arResult['arForm']['SID'] == 'CLICK_1'):?>
<script>
    $('.quantity-popup').each(function() {
      console.log('dd');
      var spinner = $(this),
        input = spinner.find('input[type="number"]'),
        btnUp = spinner.find('.quantity-up'),
        btnDown = spinner.find('.quantity-down'),
        min = input.attr('min'),
        max = input.attr('max');

      btnUp.click(function() {
        var oldValue = parseFloat(input.val());
        if (oldValue >= max) {
          var newVal = oldValue;
        } else {
          var newVal = oldValue + 1;
        }
        spinner.find("input").val(newVal);
        spinner.find("input").trigger("change");
      });

      btnDown.click(function() {
        var oldValue = parseFloat(input.val());
        if (oldValue <= min) {
          var newVal = oldValue;
        } else {
          var newVal = oldValue - 1;
        }
        spinner.find("input").val(newVal);
        spinner.find("input").trigger("change");
      });

    });
    
    $('form[name="CLICK_1"]').ready(function() {
        $('.one_click-prod-name').text(window.title1click);
        $('.one_click-prod-item img').attr('src', window.img1click)
    });
    function send(){
        let title = window.title1clickFull;
        let count = $('.one_click-popup .quantity-popup input').val();
        let result = `${title} (Количество: ${count})`;
        $('form[name="CLICK_1"] input[name="form_hidden_35"]'). val(result)

        return true;
    }
</script>
<?endif?>