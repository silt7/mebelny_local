<?

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

CModule::IncludeModule('iblock');
CModule::IncludeModule('catalog');
CModule::IncludeModule('sale');

$IBLOCK_ID = 2;

if (!empty($_REQUEST['del']) && !empty($_REQUEST['id'])) {
	CSaleBasket::Delete($_REQUEST['id']);
} else {
	if (!empty($_POST['ids'])) {
	    $ids = explode(':', trim($_POST['ids'], ':'));
	    $counts = explode(':', trim($_POST['counts'], ':'));
	} else {
	    $ids = array();
	    $counts = array();

	    $dbNabor = CIBlockElement::GetProperty($IBLOCK_ID, $_POST['id'], array(), array('CODE' => 'TOVARS_IN_NABOR'));
	    $dbCount = CIBlockElement::GetProperty($IBLOCK_ID, $_POST['id'], array(), array('CODE' => 'KOL_TOVARS_IN_NABOR'));
	    while ($nabor = $dbNabor->Fetch()) {
	        $count = $dbCount->Fetch();
	        if (empty($nabor['VALUE'])) continue;
	        
	        $ids[] = $nabor['VALUE'];
	        $counts[] = $count['VALUE'];
	    }

	    if (empty($ids)) {
	        $ids = array($_POST['id']);
	        $counts = array(1);
	    }
	}

	foreach ($ids as $k => $id) {
	    $prop = array();

	    $count = (!empty($counts[$k])) ? $counts[$k] : 1;
	    $res = Add2BasketByProductID($id, $count, array(), array($prop));
	}
}

ob_start();

$APPLICATION->IncludeComponent(
    "bitrix:sale.basket.basket.small",
    "template1",
    array(
        "PATH_TO_BASKET" => "/personal/cart/",
        "PATH_TO_ORDER" => "/personal/order/make/"
    )
);

$basket = ob_get_contents();
ob_end_clean();

echo json_encode(array('basket' => $basket, 'ids' => $ids));