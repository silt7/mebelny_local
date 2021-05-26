<?
//runuser -l bitrix -c 'php -f /home/m/mebelny/mebelny-dom.com/public_html/local/php_interface/create_all_cached.php'

$_SERVER["DOCUMENT_ROOT"] = "/home/bitrix/www";
$DOCUMENT_ROOT = $_SERVER["DOCUMENT_ROOT"];

define('NO_KEEP_STATISTIC', true);
define('NOT_CHECK_PERMISSIONS',true);
define('BX_NO_ACCELERATOR_RESET', true);
define('CHK_EVENT', true);

require($_SERVER["DOCUMENT_ROOT"].'/bitrix/modules/main/include/prolog_before.php');

@set_time_limit(100000);
ini_set('max_execution_time', 100000);
@ignore_user_abort(true);

error_reporting(E_ERROR | E_WARNING | E_PARSE | E_USER_ERROR);
ini_set('display_errors', 1);

$arRes["start_date"] = date("d.m.Y H:i:s");
$arRes["file_name"] = $_SERVER["SCRIPT_FILENAME"];

$GLOBALS["ALL_PRICES"] = mebel::make_chache_main("mebel::all_prices", "ALL_PRICES", "", array("ID"), 1, "Y");

$GLOBALS["ALL_PRICES"] = mebel::make_chache_main("mebel::all_prices", "ALL_PRICES", "", array("ID"), 86400000);

$GLOBALS["ALL_SECTIONS"] = mebel::make_chache_main("mebel::all_sections", "ALL_SECTIONS", "", array("ID"), 1, "Y");

$GLOBALS["ALL_SECTIONS"] = mebel::make_chache_main("mebel::all_sections", "ALL_SECTIONS", "", array("ID"), 864000);

$GLOBALS["ALL_SECTIONS_BY_CODE"] = mebel::make_chache_main("mebel::all_sections_by_code", "ALL_SECTIONS_BY_CODE", "", array("ID"), 1, "Y");

$GLOBALS["ALL_SECTIONS_BY_CODE"] = mebel::make_chache_main("mebel::all_sections_by_code", "ALL_SECTIONS_BY_CODE", "", array("ID"), 864000);

restore_error_handler();
?>