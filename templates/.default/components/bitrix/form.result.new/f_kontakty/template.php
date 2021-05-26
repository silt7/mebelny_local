<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<? if($arResult["FORM_NOTE"] || (isset($_REQUEST['formresult']) && $_REQUEST['formresult'] == 'addok')):?>
    <div class="contact-popup popup-thanks">
      <img class="thanks-img" src="img/contact/thanks.png" alt="thanks">
      <div class="popup-title">Ваше обращение зафиксировано, спасибо за обратную связь</div>
      <input type="submit" onClick="$('.popup-window-overlay').hide(); $('.popup-window').hide()" value="Ок"/>
    </div>
<? return true; endif;?>

<? if ($arResult["isFormErrors"] == "Y"):?><div class="form-def__title" style="color:#ed5979 !important;">Заполните, пожалуйста, все поля.</div><? endif;?>

<?=$arResult["FORM_HEADER"]?>
    <?foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion):?>
        <input type="text" placeholder="<?=$arQuestion["CAPTION"]?>" name="form_text_<?=$arQuestion['STRUCTURE'][0]['ID']?>">
        <!--<textarea class="large-textbox" type="text" placeholder="Жалоба" name="your_issue"></textarea>-->
    <?endforeach;?>
    <div class="popup-notice">Нажимая кнопку "Отправить", я даю согласие на обработку своих персональных данных в соответствии с <a href="/personal_data/">Условиями</a></div>

    <input <?=(intval($arResult["F_RIGHT"]) < 10 ? "disabled=\"disabled\"" : "");?> type="submit" name="web_form_submit" value="<?=htmlspecialcharsbx(strlen(trim($arResult["arForm"]["BUTTON"])) <= 0 ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"]);?>" class="submit-def formbuyconsult" /> 
</form>


