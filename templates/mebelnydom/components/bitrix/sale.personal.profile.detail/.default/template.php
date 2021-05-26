<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
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
.sect-name { background:#e7eff1; padding:10px 15px;}
textarea { min-height:100px;}
.p-name { padding:20px 0; font-weight:bold;}
.pp {padding:10px 0; }
</style>

<a name="tb"></a>
<a class="link" href="<?=$arParams["PATH_TO_LIST"]?>"><?=GetMessage("SPPD_RECORDS_LIST")?></a>

<? if(strlen($arResult["ID"])>0):?>
	<? ShowError($arResult["ERROR_MESSAGE"]); ?>
	<form method="post" action="<?=POST_FORM_ACTION_URI?>" class="form-def">
	<?=bitrix_sessid_post()?>
	<input type="hidden" name="ID" value="<?=$arResult["ID"]?>">
    <div class="table-responsive mt20">
	<table class="table table-bordered">
		<tr>
			<th colspan="2" align="left" class="p-name">
				<b><?= str_replace("#ID#", $arResult["ID"], GetMessage("SPPD_PROFILE_NO")) ?></b>
			</th>
		</tr>
		<tr>
			<td width="40%" align="left" class="pp"><? echo GetMessage("SALE_PERS_TYPE")?>:</td>
			<td width="60%"><?=$arResult["PERSON_TYPE"]["NAME"]?></td>
		</tr>
		<tr>
			<td width="40%" align="left" class="pp"><?echo GetMessage("SALE_PNAME")?>:<span class="req">*</span></td>
			<td width="60%"><input type="text" name="NAME" class="input-def" value="<? echo $arResult["NAME"];?>"></td>
		</tr>
		<tr>
			<td colspan="2"><img src="/bitrix/images/1.gif" width="1" height="8"></td>
		</tr>
		<?
		foreach($arResult["ORDER_PROPS"] as $val)
		{
			if(!empty($val["PROPS"]))
			{
				?>
				<tr>
					<th colspan="2" align="left" class="sect-name"><?=$val["NAME"];?></b></th>
				</tr>
				<?
				foreach($val["PROPS"] as $vval)
				{
					$currentValue = $arResult["ORDER_PROPS_VALUES"]["ORDER_PROP_".$vval["ID"]];
					$name = "ORDER_PROP_".$vval["ID"];
					?>
					<tr>
						<td width="50%" align="left"><?=$vval["NAME"] ?>:
							<? if ($vval["REQUIED"]=="Y")
							{
								?><span class="req">*</span><?
							}
							?></td>
						<td width="50%">

							<? if ($vval["TYPE"]=="CHECKBOX"):?>
								<input type="hidden" name="<?=$name?>" value="">
								<input type="checkbox" name="<?=$name?>" value="Y"<?if ($currentValue=="Y" || !isset($currentValue) && $vval["DEFAULT_VALUE"]=="Y") echo " checked";?>>
							<?elseif ($vval["TYPE"]=="TEXT"):?>
								<input type="text" class="input-def" size="<? echo (IntVal($vval["SIZE1"])>0)?$vval["SIZE1"]:30; ?>" maxlength="250" value="<?echo (isset($currentValue)) ? $currentValue : $vval["DEFAULT_VALUE"];?>" name="<?=$name?>">
							<?elseif ($vval["TYPE"]=="SELECT"):?>
								<select class="le-input" name="<?=$name?>" size="<?echo (IntVal($vval["SIZE1"])>0)?$vval["SIZE1"]:1; ?>">
									<?foreach($vval["VALUES"] as $vvval):?>
										<option value="<?echo $vvval["VALUE"]?>"<?if ($vvval["VALUE"]==$currentValue || !isset($currentValue) && $vvval["VALUE"]==$vval["DEFAULT_VALUE"]) echo " selected"?>><?echo $vvval["NAME"]?></option>
									<?endforeach;?>
								</select>
							<?elseif ($vval["TYPE"]=="MULTISELECT"):?>
								<select class="le-input" multiple name="<?=$name?>[]" size="<?echo (IntVal($vval["SIZE1"])>0)?$vval["SIZE1"]:5; ?>">
									<?
									$arCurVal = array();
									$arCurVal = explode(",", $currentValue);
									for ($i = 0, $cnt = count($arCurVal); $i < $cnt; $i++)
										$arCurVal[$i] = trim($arCurVal[$i]);
									$arDefVal = explode(",", $vval["DEFAULT_VALUE"]);
									for ($i = 0, $cnt = count($arDefVal); $i < $cnt; $i++)
										$arDefVal[$i] = trim($arDefVal[$i]);
									foreach($vval["VALUES"] as $vvval):?>
										<option value="<?echo $vvval["VALUE"]?>"<?if (in_array($vvval["VALUE"], $arCurVal) || !isset($currentValue) && in_array($vvval["VALUE"], $arDefVal)) echo" selected"?>><?echo $vvval["NAME"]?></option>
									<?endforeach;?>
								</select>
							<?elseif ($vval["TYPE"]=="TEXTAREA"):?>
								<textarea class="input-def" rows="<?echo (IntVal($vval["SIZE2"])>0)?$vval["SIZE2"]:4; ?>" cols="<?echo (IntVal($vval["SIZE1"])>0)?$vval["SIZE1"]:40; ?>" name="<?=$name?>"><?echo (isset($currentValue)) ? $currentValue : $vval["DEFAULT_VALUE"];?></textarea>
							<?elseif ($vval["TYPE"]=="LOCATION"):?>
								<? if ($arParams['USE_AJAX_LOCATIONS'] == 'Y'):?>

								<? $locationValue = intval($currentValue) ? $currentValue : $vval["DEFAULT_VALUE"];?>
								<? CSaleLocation::proxySaleAjaxLocationsComponent(
									array(
										"AJAX_CALL" => "N",
										'CITY_OUT_LOCATION' => 'Y',
										'COUNTRY_INPUT_NAME' => $name.'_COUNTRY',
										'CITY_INPUT_NAME' => $name,
										'LOCATION_VALUE' => $locationValue,
									),
									array(
									),
									$locationTemplate,
									true,
									'location-block-wrapper'
								)?>

								<?
								else:
								?>
								<select class="le-input" name="<?=$name?>" size="<?echo (IntVal($vval["SIZE1"])>0)?$vval["SIZE1"]:1; ?>">
									<?foreach($vval["VALUES"] as $vvval):?>
										<option value="<?echo $vvval["ID"]?>"<?if (IntVal($vvval["ID"])==IntVal($currentValue) || !isset($currentValue) && IntVal($vvval["ID"])==IntVal($vval["DEFAULT_VALUE"])) echo " selected"?>><?echo $vvval["COUNTRY_NAME"]." - ".$vvval["CITY_NAME"]?></option>
									<?endforeach;?>
								</select>
								<?
								endif;
								?>
							<?elseif ($vval["TYPE"]=="RADIO"):?>
								<?foreach($vval["VALUES"] as $vvval):?>
									<input type="radio" name="<?=$name?>" value="<?echo $vvval["VALUE"]?>"<?if ($vvval["VALUE"]==$currentValue || !isset($currentValue) && $vvval["VALUE"]==$vval["DEFAULT_VALUE"]) echo " checked"?>><?echo $vvval["NAME"]?><br />
								<?endforeach;?>
							<?endif?>

							<?if (strlen($vval["DESCRIPTION"])>0):?>
								<br /><small><?echo $vval["DESCRIPTION"] ?></small>
							<?endif?>
						</td>
					</tr>
					<?
				}
			}
		}
		?>

	</table>
    </div>
	<br />
	<div>
		<input type="submit" class="btn-def" name="save" value="<? echo GetMessage("SALE_SAVE") ?>">
		&nbsp;
		<input type="submit" class="btn-def" name="reset" value="<? echo GetMessage("SALE_RESET")?>">
	</div>
	</form>
<?else:?>
	<? ShowError($arResult["ERROR_MESSAGE"]);?>
<?endif;?>
