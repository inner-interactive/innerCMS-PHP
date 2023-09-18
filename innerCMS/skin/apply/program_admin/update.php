<?php	
include "../../../../common.php";		// root define
include "../../../define.php";		// sub define
include_once COMMON_PATH."lib/common.lib.php";
include_once COMMON_PATH."lib/db.class.php";
include_once COMMON_PATH."lib/menu.class.php";
include_once COMMON_PATH."lib/skin.class.php";
include_once COMMON_PATH."lib/grant.class.php";
include_once COMMON_PATH."lib/program.class.php";

if(count($_POST) == 0) alert('잘못된 접근입니다.');


if(!$isAdmin) alert('접근 권한이 없습니다.');
//필수 입력 체크

$menuID = isset($_POST['menu']) ? intval($_POST['menu']) : 0;
if($menuID == 0) alert('잘못된 접근입니다.');

//필수 입력 체크
$blankList = array("subject|프로그램명을");
blankCheck($blankList);

//기본 값 설정
$_POST['indexcode'] = intval($_POST['no']);

if($_POST['st_date'] != "" && $_POST['st_hour'] != "" &&  $_POST['st_minute'] != ""){
	$_POST['datetime1'] = $_POST['st_date']." ".$_POST['st_hour'].":".$_POST['st_minute'].":00";	
}else{
	$_POST['datetime1'] = "0000-00-00 00:00:00";
}

if($_POST['ed_date'] != "" && $_POST['ed_hour'] != "" &&  $_POST['ed_minute'] != ""){
	$_POST['datetime2'] = $_POST['ed_date']." ".$_POST['ed_hour'].":".$_POST['ed_minute'].":00";
}else{
	$_POST['datetime2'] = "0000-00-00 00:00:00";
}

	
if(!isset($_POST['date1']) || trim($_POST['date1']) == "") $_POST['date1'] = "0000-00-00";
if(!isset($_POST['date2']) || trim($_POST['date2']) == "") $_POST['date2'] = "0000-00-00";
if(!isset($_POST['datetime1']) || trim($_POST['datetime1']) == "") $_POST['datetime1'] = "0000-00-00 00:00:00";
if(!isset($_POST['datetime2']) || trim($_POST['datetime2']) == "") $_POST['datetime2'] = "0000-00-00 00:00:00";


if(!isset($_POST['ptype'])) $_POST['ptype'] = 0;
if($_POST['ptype'] == 0){
	$_POST['ptext'] = '';
}else if($_POST['ptype'] == 1){
	$_POST['date1'] = $_POST['date2'] = "0000-00-00";
}


$DB = new DB();
$MENU = new Menu($DB);

$PROGRAM = new Program();
$tableName = $PROGRAM->list_table;

$menuInfo = $MENU->getMenuInfo($menuID);
$SKIN = new skin($menuInfo);

$_config_file = $SKIN->skin_path."config.php";
if(file_exists($_config_file)) include $_config_file;


$column = $DB->getColumns($tableName, array('indexcode', 'uid', 'uname', 'site_menuid', 'writetime', 'ip'));
$column['updatetime']['type'] = "now";

$query = "SELECT site_menuid FROM ".$tableName." WHERE indexcode = ".$_POST['indexcode'];
$dbData = $DB->getDBData($query);
$menuID = $dbData[0]['site_menuid'];

$query = $DB->updateSql($column, $_POST, $tableName, "indexcode");
$DB->runQuery($query);
$backUrl = html_entity_decode($_POST['backUrl']);

$SKIN->picUpload($_FILES['tfile'], $_POST['indexcode'], 'thumb', $thumbWidth, $thumbHeight);
$SKIN->fileUpload($_FILES['pfile'], $_POST['indexcode'], 'pic');
$SKIN->fileUpload($_FILES['sfile'], $_POST['indexcode'], 'files1');
$SKIN->fileUpload($_FILES['sfile2'], $_POST['indexcode'], 'files2');

header('location:'.$backUrl);
exit;


?>