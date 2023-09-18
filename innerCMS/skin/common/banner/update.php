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
//필수 입력 체크

$menuID = isset($_POST['menu']) ? intval($_POST['menu']) : 0;
if($menuID == 0) alert('잘못된 접근입니다.');


$DB = new DB();
$MENU = new Menu($DB);
$menuInfo = $MENU->getMenuInfo($menuID);
$SKIN = new skin($menuInfo);

$_config_file = $SKIN->skin_path."config.php";
if(file_exists($_config_file)) include $_config_file;


$query = "SELECT banner_type FROM ".$tableName." WHERE banner_id = ".$no;
$dbData = $DB->getDBData($query);
$type = $dbData[0]['banner_type'];

$writeColumn = isset($bannerConfig[$type]['writeColumn']) && $bannerConfig[$type]['writeColumn'] != '' ? explode("|", $bannerConfig[$type]['writeColumn']) : null;


//필수 입력 체크
$blankList = array();

if(in_array('title', $writeColumn)){
	array_push($blankList, "title|배너 제목을");
}

if(in_array('term', $writeColumn)){
	array_push($blankList, "start_date|배너 시작 날짜를");
	array_push($blankList, "end_date|배너 종료 날짜를");
}

blankCheck($blankList);

//기본 값 설정
$_POST['banner_id'] = intval($_POST['no']);
$_POST['isstop'] = isset($_POST['isstop']) ? intval($_POST['isstop']) : 0;
$_POST['link_target'] = isset($_POST['link_target']) && $_POST['link_target'] != '' ? trim($_POST['link_target']) : "S";
if(!isset($_POST['start_date']) || trim($_POST['start_date']) == "") $_POST['start_date'] = "0000-00-00";
if(!isset($_POST['end_date']) || trim($_POST['end_date']) == "") $_POST['end_date'] = "0000-00-00";

$column = $DB->getColumns($tableName, array('banner_id', 'banner_type', 'uid', 'uname', 'writetime', 'ip', 'sort'));
//기본 값 설정


$query = $DB->updateSql($column, $_POST, $tableName, "banner_id");
$DB->runQuery($query);
$backUrl = html_entity_decode($_POST['backUrl']);


$imageData = $SKIN->getFileData($menuID, $_POST['banner_id'], $type);
$isUpload = $SKIN->fileUpload($_FILES['bfile'], $_POST['banner_id'], $type);

if($isUpload){	//기존 등록이미지 삭제
	
	for($i = 0; $i < count($imageData); $i++){
		$fullPath = DATA_PATH."upload/".$imageData[$i]['attach_file_name'];
		@unlink($fullPath);
		$query = "DELETE FROM ".FILE_TABLE." WHERE file_id = ".$imageData[$i]['file_id'];
		$DB->runQuery($query);
		$SKIN->Log($query, $menuID);
	}
	
}

header('location:'.$backUrl);
exit;


?>