<?php	
if(count($_POST) == 0) die('not permited to access this page directly');

include "../../../../common.php";		// root define
include "../../../define.php";		// sub define
include_once COMMON_PATH."lib/common.lib.php";
include_once COMMON_PATH."lib/db.class.php";
include_once COMMON_PATH."lib/menu.class.php";
include_once COMMON_PATH."lib/skin.class.php";
include_once COMMON_PATH."lib/grant.class.php";

if(count($_POST) == 0) alert('잘못된 접근입니다.');

if(!$isAdmin) alert('접근 권한이 없습니다.');

$menuID = isset($_POST['menu']) ? intval($_POST['menu']) : 0;
if($menuID == 0) alert('잘못된 접근입니다.');


//필수 입력 체크


$DB = new DB();
$MENU = new Menu($DB);
$menuInfo = $MENU->getMenuInfo($menuID);
$SKIN = new skin($menuInfo);

$_config_file = $SKIN->skin_path."config.php";
if(file_exists($_config_file)) include $_config_file;

$type = $_POST['banner_type'];
$writeColumn = isset($bannerConfig[$type]['writeColumn']) && $bannerConfig[$type]['writeColumn'] != '' ? explode("|", $bannerConfig[$type]['writeColumn']) : null;


$blankList = array();

if(in_array('title', $writeColumn)){
	array_push($blankList, "title|배너 제목을");
}

if(in_array('term', $writeColumn)){
	array_push($blankList, "start_date|배너 시작 날짜를");
	array_push($blankList, "end_date|배너 종료 날짜를");
}


blankCheck($blankList);


$column = $DB->getColumns($tableName, array('banner_id'));
$column['writetime']['type'] = "now";

//기본 값 설정
$_POST['uid'] = $userID;
$_POST['uname'] = $userName;
$_POST['isstop'] = isset($_POST['isstop']) ? intval($_POST['isstop']) : 0;
$_POST['link_target'] = isset($_POST['link_target']) && $_POST['link_target'] != '' ? trim($_POST['link_target']) : "S";
$_POST['ip'] = $_SERVER['REMOTE_ADDR'];
if(!isset($_POST['start_date']) || trim($_POST['start_date']) == "") $_POST['start_date'] = "0000-00-00";
if(!isset($_POST['end_date']) || trim($_POST['end_date']) == "") $_POST['end_date'] = "0000-00-00";


//정렬순서 구하기
$query = "SELECT max(sort) FROM ".$tableName." WHERE banner_type = '".$type."'";
$dbData = $DB->getDBData($query);
$_POST['sort'] = intval($dbData[0][0]) + 1;

$query = $DB->insertSql($column, $_POST, $tableName);
$DB->runQuery($query);
$backUrl = html_entity_decode($_POST['backUrl']);
if($DB->affected_rows){
	
	$query = "SELECT max(banner_id) FROM ".$tableName;
	$dbData = $DB->getDBData($query);
	$newIndexcode = intval($dbData[0][0]);
	$SKIN->fileUpload($_FILES['bfile'], $newIndexcode, $type);
	$backUrl .= "&no=".$newIndexcode;

}else{
	alert('등록되지 않았습니다.');
}


header('location:'.$backUrl);
exit;


?>