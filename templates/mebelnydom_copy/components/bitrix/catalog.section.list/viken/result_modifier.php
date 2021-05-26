<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

if (isset($arResult['SECTION']) && $arResult['SECTION']['DESCRIPTION'] != '') {
	$arSection = $arResult['SECTION'];
	$mxPicture = false;
	$arSection['PICTURE'] = intval($arSection['PICTURE']);
	if (0 < $arSection['PICTURE'])
		$mxPicture = CFile::GetFileArray($arSection['PICTURE']);
	$arSection['PICTURE'] = $mxPicture;
	if ($arSection['PICTURE'])
	{
		$arSection['PICTURE']['ALT'] = $arSection['IPROPERTY_VALUES']['SECTION_PICTURE_FILE_ALT'];
		if ($arSection['PICTURE']['ALT'] == '')
			$arSection['PICTURE']['ALT'] = $arSection['NAME'];
		$arSection['PICTURE']['TITLE'] = $arSection['IPROPERTY_VALUES']['SECTION_PICTURE_FILE_TITLE'];
		if ($arSection['PICTURE']['TITLE'] == '')
			$arSection['PICTURE']['TITLE'] = $arSection['NAME'];
	}
	$arResult['SECTION'] = $arSection;
	$arResult['LEFT_NAV'] = ''; 
}

/* $rsResult = CIBlockSection::GetList(array(), array("IBLOCK_ID" => $arParams["IBLOCK_ID"]), true, array("UF_SECT_TYPES"));
	//dump($rsResult);
	
	
	
	
	foreach($rsResult->arUserFields as $usFields) {
		//dump($usFields);
		$arResult['SECTION']["SECTION_USER_FIELDS"]["UF_RAZDEL_ID"] = $usFields['ID'];
		$arResult['SECTION']["SECTION_USER_FIELDS"]["FIELD_NAME"] = $usFields['FIELD_NAME'];
	}
	while($arSection1 = $rsResult->GetNext()){
		//dump($arSection1);
		
		$arResult['SECTION']["SECTION_USER_FIELDS"]["UF_RAZDEL_DESC"] = $arSection1['UF_SECT_TYPES'];
		
		$UserField = CUserFieldEnum::GetList(array(), array("ID" => $arSection1['UF_SECT_TYPES']));
		//dump($UserField->arResult);
		foreach($UserField->arResult as $usFields) {
			//dump($usFields);
			$rsUsFields = CUserFieldEnum::GetList(array(), array(
				"ID" => $usFields['ID'],
			));
			//dump($rsUsFields);
			
			if($arResult["SECTION_USER_FIELDS"]["UF_RAZDEL_DESC"] && $usFields['ID'] == $arResult["SECTION_USER_FIELDS"]["UF_RAZDEL_DESC"]){
				//dump($usFields);
			}
			
		}
	} */
	
	
	
	
	
	
	
global $USER;
if(is_object($USER)){
    $rsUser = CUser::GetList($by, $order,
        array(
            "ID" => $USER->GetID(),
        ),
        array(
            "SELECT" => array(
                "UF_SECT_TYPES",
            ),
        )
    );
    if($arUser = $rsUser->Fetch()){
        $rsGender = CUserFieldEnum::GetList(array(), array(
            "ID" => $arUser["UF_SECT_TYPES"],
        ));
        if($arGender = $rsGender->GetNext())
            echo $arGender["VALUE"];
		$arResult['SECTIONS']['UF_SECT_TYPES'] = $arGender;
		//dump($arResult['SECTION']);
    }
}
//dump($arResult["MY_SECTION"]);