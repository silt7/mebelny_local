<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

	$iblock_id = 55;
	
	$elements = GetIBlockElementList($iblock_id, false, ['SORT'=>'ASC'], 0, ['ACTIVE' => 'Y']);
	
	$brends = [];
	while($row = $elements->fetch()){
		$brends[$row['ID']]['NAME'] = $row['NAME'];
		$brends[$row['ID']]['PREVIEW_PICTURE'] = CFile::GetPath($row['PREVIEW_PICTURE']);
		
		$db_props = CIBlockElement::GetProperty($iblock_id, $row['ID'], "sort", "asc", array());
		$PROPS = array();
		while($ar_props = $db_props->GetNext())
			$PROPS[$ar_props['CODE']] = $ar_props['VALUE'];
		$brends[$row['ID']]['URL'] = $PROPS['URL'];
		
	}

	$arResult['BRENDS'] = $brends;

	$this->IncludeComponentTemplate();
?>