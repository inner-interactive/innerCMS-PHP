<?php 
include "../../../../common.php";
include "../../../define.php";
include_once COMMON_PATH."lib/common.lib.php";
include_once COMMON_PATH."lib/db.class.php";

$DB = new DB();

$type = isset($_REQUEST['type']) ? urldecode($_REQUEST['type']) : "";
$query = "SELECT menu_id FROM ".MENU_TABLE." WHERE site = '".SITE_NAME."' AND route = '{$type}'";
$dbData = $DB->getDBData($query);
$menu_id = intval($dbData[0]['menu_id']);
$backUrl = "../../.././?menu=".$menu_id;

$backUrl .= isset($_REQUEST['site']) ? "&site=".trim($_REQUEST['site']) : "";
$backUrl .= isset($_REQUEST['fr_date']) ? "&fr_date=".trim($_REQUEST['fr_date']) : "";
$backUrl .= isset($_REQUEST['to_date']) ? "&to_date=".trim($_REQUEST['to_date']) : "";
$backUrl .= isset($_REQUEST['domain']) ? "&domain=".trim($_REQUEST['domain']) : "";
$_SESSION['fr_date'] = $_REQUEST['fr_date'];
$_SESSION['to_date'] = $_REQUEST['to_date'];
header("location:".$backUrl);
?>