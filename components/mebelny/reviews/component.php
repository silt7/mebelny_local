<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

	$iblock_id = 56;
	
	$elements = GetIBlockElementList($iblock_id, false, ['SORT'=>'ASC'], 0, ['ACTIVE' => 'Y']);
	
	$reviews = [];
	while($row = $elements->fetch()){
		$reviews[$row['ID']]['NAME'] = $row['NAME'];
		$reviews[$row['ID']]['PREVIEW_TEXT'] = $row['PREVIEW_TEXT'];
		
		$db_props = CIBlockElement::GetProperty($iblock_id, $row['ID'], "sort", "asc", array());
		$PROPS = array();
		while($ar_props = $db_props->GetNext())
			$PROPS[$ar_props['CODE']] = $ar_props['VALUE_XML_ID'];
		
		$reviews[$row['ID']]['GENDER'] = $PROPS['GENDER'];
		$reviews[$row['ID']]['RATING'] = $PROPS['RATING'];
		$reviews[$row['ID']]['SOURCE'] = $PROPS['SOURCE'];
		
		if ($reviews[$row['ID']]['GENDER'] == 'M'){
			$reviews[$row['ID']]['GENDER'] = '/imgs/author-ava-m.svg';
		} elseif ($reviews[$row['ID']]['GENDER'] == 'F') {
			$reviews[$row['ID']]['GENDER'] = '/imgs/author-ava-f.svg';
		}
		
		if ($reviews[$row['ID']]['SOURCE'] == 'Y'){
			$reviews[$row['ID']]['SOURCE'] = '/imgs/logo-yandex.svg';
			$reviews[$row['ID']]['SOURCE_ALT'] = 'Yandex';
		} elseif ($reviews[$row['ID']]['SOURCE'] == 'G') {
			$reviews[$row['ID']]['SOURCE'] = '/imgs/logo-google.svg';
			$reviews[$row['ID']]['SOURCE_ALT'] = 'Google';
		}
			
	}

	$arResult['REVIEWS'] = $reviews;

	$this->IncludeComponentTemplate();
?>