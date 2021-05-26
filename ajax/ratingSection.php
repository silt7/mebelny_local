<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule('highloadblock');
use Bitrix\Highloadblock\HighloadBlockTable as HLBT;

$hlblock = HLBT::getById(35)->fetch();
$entity = HLBT::compileEntity($hlblock);

if($_GET['session']){
    $rsData = $entity->getDataClass()::getList(array(
       'select' => array('UF_SECTION', 'UF_RATING', 'UF_SESSID'),
       'order' => array('UF_SECTION' => 'ASC'),
       'filter' => array('UF_SESSID' => $_GET['session'])
    ))->fetchAll();

	if (count($rsData) > 0){
		echo json_encode(['repeat', array_shift($rsData)['UF_RATING']]);
		die();
	}
} else {
	echo json_encode('sessionEmpty');
	die();
}

if(($_GET['rating'])&&($_GET['section'])){
	$entity->getDataClass()::add(array(
		  'UF_SECTION'      => $_GET['section'],
		  'UF_RATING'       => $_GET['rating'],
		  'UF_SESSID'       => $_GET['session'],
	   ));
}
echo json_encode(['success']);
die();
?>