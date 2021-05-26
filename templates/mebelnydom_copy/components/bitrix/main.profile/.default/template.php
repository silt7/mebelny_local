<?
/**
 * @global CMain $APPLICATION
 * @param array $arParams
 * @param array $arResult
 */
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();
?>     
<style>
  .form-def { width:100% !important; border:none !important; padding:0px !important;}
.input-def::-webkit-input-placeholder,
.textarea-def::-webkit-input-placeholder {
	color: #333;
	text-align: left;
	font-size: 12px;
}
.btn-def { margin:15px 0;}
.alert { margin:15px 0;}
</style>
<div class="row">
<div class="col-md-7">           
<?  ShowError($arResult["strProfileError"]);?>
<?
if ($arResult['DATA_SAVED'] == 'Y'): ?>
  <div class="alert">
    <? ShowNote(GetMessage('PROFILE_DATA_SAVED'));
?></div>
<? endif;?>

<form method="post" name="form1" action="<?=$arResult["FORM_TARGET"]?>" enctype="multipart/form-data" class="form-def">
<?=$arResult["BX_SESSION_CHECK"]?>
<input type="hidden" name="lang" value="<?=LANG?>" />
<input type="hidden" name="ID" value=<?=$arResult["ID"]?> />

                           <input type="text" name="NAME" class="input-def" value="<?=$arResult["arUser"]["NAME"]?>" placeholder="<?=GetMessage('NAME')?>"/>
                           <input type="text" name="LAST_NAME" class="input-def" value="<?=$arResult["arUser"]["LAST_NAME"]?>" placeholder="<?=GetMessage('LAST_NAME')?>"/>

                           <input type="text" name="SECOND_NAME" class="input-def" value="<?=$arResult["arUser"]["SECOND_NAME"]?>" placeholder="<?=GetMessage('SECOND_NAME')?>"/>
                           <input type="text" name="EMAIL" class="input-def" value="<? echo $arResult["arUser"]["EMAIL"]?>" placeholder="<?=GetMessage('EMAIL')?>">

                           <input type="text" name="LOGIN" class="input-def" value="<? echo $arResult["arUser"]["LOGIN"]?>" placeholder="<?=GetMessage('LOGIN')?>"/>
               
                                    <? if($arResult["arUser"]["EXTERNAL_AUTH_ID"] == ''):?>
                                    <input type="password" name="NEW_PASSWORD" class="input-def" value="" autocomplete="off" placeholder="<?=GetMessage('NEW_PASSWORD_REQ')?> <? echo $arResult["GROUP_POLICY"]["PASSWORD_REQUIREMENTS"];?>"/>
                                    <? if($arResult["SECURE_AUTH"]):?>
                                    <span class="bx-auth-secure" id="bx_auth_secure" title="<?echo GetMessage("AUTH_SECURE_NOTE")?>" style="display:none">
                                        <div class="bx-auth-secure-icon"></div>
                                    </span>
                                    <noscript>
                                    <span class="bx-auth-secure" title="<? echo GetMessage("AUTH_NONSECURE_NOTE")?>">
                                        <div class="bx-auth-secure-icon bx-auth-secure-unlock"></div>
                                    </span>
                                    </noscript>
                                    <script type="text/javascript">
                                    document.getElementById('bx_auth_secure').style.display = 'inline-block';
                                    </script>
                                    <? endif?>
                                      <input type="password" name="NEW_PASSWORD_CONFIRM" class="input-def" value="" autocomplete="off" placeholder="<?=GetMessage('NEW_PASSWORD_CONFIRM')?>"/>
                                    <? endif?>

            
            <div class="row mt20">
              <div class="col-md-12">
                    <input type="submit" class="btn-def" name="save" value="<?=(($arResult["ID"]>0) ? GetMessage("MAIN_SAVE") : GetMessage("MAIN_ADD"))?>">
               </div>  
            </div>       

        </form>
</div>
<div class="col-md-5">
        <div class="panel panel-default mt25">
			<? 
            if($arResult["SOCSERV_ENABLED"])
            {
                $APPLICATION->IncludeComponent("bitrix:socserv.auth.split", ".default", array(
                        "SHOW_PROFILES" => "Y",
                        "ALLOW_DELETE" => "Y"
                    ),
                    false
                );
            }  ?>
        </div>
</div>
</div>        
<? //echo '<pre>'; print_r($arResult); echo '</pre>'; ?>