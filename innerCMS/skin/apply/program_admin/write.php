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

$menuID = isset($_POST['menu']) ? intval($_POST['menu']) : 0;
if($menuID == 0) alert('잘못된 접근입니다.');


//필수 입력 체크
$blankList = array("subject|프로그램명을");
blankCheck($blankList);
 

$DB = new DB();
$MENU = new Menu($DB);

$PROGRAM = new Program();
$tableName = $PROGRAM->list_table;

$menuInfo = $MENU->getMenuInfo($menuID);
$SKIN = new skin($menuInfo);

$_config_file = $SKIN->skin_path."config.php";
if(file_exists($_config_file)) include $_config_file;


$column = $DB->getColumns($tableName, array('indexcode', 'updatetime'));
$column['writetime']['type'] = "now";


//기본 값 설정
$_POST['uid'] = $userID;
$_POST['uname'] = $userName;
$_POST['ip'] = $_SERVER['REMOTE_ADDR'];

$_POST['st_hour'] = $_POST['st_hour'] < 10 ? "0".$_POST['st_hour'] : $_POST['st_hour'];
$_POST['st_minute'] = $_POST['st_minute'] < 10 ? "0".$_POST['st_minute'] : $_POST['st_minute'];
$_POST['ed_hour'] = $_POST['ed_hour'] < 10 ? "0".$_POST['ed_hour'] : $_POST['ed_hour'];
$_POST['ed_minute'] = $_POST['ed_minute'] < 10 ? "0".$_POST['ed_minute'] : $_POST['ed_minute'];



$_POST['site_menuid'] = $_POST['sno'];


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


$menuID = intval($_POST['sno']);

$query = $DB->insertSql($column, $_POST, $tableName);

$DB->runQuery($query);
$backUrl = html_entity_decode($_POST['backUrl']);
if($DB->affected_rows){
	
    $query = "SELECT max(indexcode) FROM ".$tableName;
	$dbData = $DB->getDBData($query);
	$newIndexcode = intval($dbData[0][0]);
	$SKIN->picUpload($_FILES['tfile'], $newIndexcode, 'thumb', $thumbWidth, $thumbHeight);
	$SKIN->fileUpload($_FILES['pfile'], $newIndexcode, 'pic');
	$SKIN->fileUpload($_FILES['sfile'], $newIndexcode, 'files1');
	$SKIN->fileUpload($_FILES['sfile2'], $newIndexcode, 'files2');
	
	$backUrl .= "&no=".$newIndexcode;

}else{
	alert('등록되지 않았습니다.');
}


header('location:'.$backUrl);
exit;


?>