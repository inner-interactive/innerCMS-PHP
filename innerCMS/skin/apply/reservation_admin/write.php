<?php	
include "../../../../common.php";		// root define
include "../../../define.php";		// sub define
include_once COMMON_PATH."lib/common.lib.php";
include_once COMMON_PATH."lib/db.class.php";
include_once COMMON_PATH."lib/menu.class.php";
include_once COMMON_PATH."lib/skin.class.php";
include_once COMMON_PATH."lib/grant.class.php";
include_once COMMON_PATH."lib/FcReservation.class.php";
include 'config.php';

if(count($_POST) == 0) alert('잘못된 접근입니다.');


if(!$isAdmin) alert('접근 권한이 없습니다.');

$menuID = isset($_POST['menu']) ? intval($_POST['menu']) : 0;
if($menuID == 0) alert('잘못된 접근입니다.');


//필수 입력 체크
$blankList = array("subject|예약 시설명을");
blankCheck($blankList);
 

$DB = new DB();
$MENU = new Menu($DB);

$RESERVATION = new FcReservation();
$tableName = $RESERVATION->facilityTable;

$menuInfo = $MENU->getMenuInfo($menuID);
$SKIN = new skin($menuInfo);

$_config_file = $SKIN->skin_path."config.php";
if(file_exists($_config_file)) include $_config_file;

//$reservationColumn config.php에 선언
//write 모드에서는 시설정보에 관련된 컬럼만 저장. 예약관련 컬럼은 update에서만
$column = $DB->getColumns($tableName, array_merge(array('indexcode', 'updatetime'), $reservationColumn));   //예약관련 컬럼은 제외
$column['writetime']['type'] = "now";


//기본 값 설정
$_POST['uid'] = $userID;
$_POST['uname'] = $userName;
$_POST['ip'] = $_SERVER['REMOTE_ADDR'];



$query = $DB->insertSql($column, $_POST, $tableName);
$DB->runQuery($query);

$backUrl = html_entity_decode($_POST['backUrl']);
if($DB->affected_rows){
	
    $query = "SELECT max(indexcode) FROM ".$tableName;
	$dbData = $DB->getDBData($query);
	$newIndexcode = intval($dbData[0][0]);
	$SKIN->picUpload($_FILES['tfile'], $newIndexcode, 'reserv_thumb', $thumbWidth, $thumbHeight);
	$SKIN->fileUpload($_FILES['pfile'], $newIndexcode, 'reserv_pic');
	$SKIN->fileUpload($_FILES['sfile'], $newIndexcode, 'reserv_files1');
	$SKIN->fileUpload($_FILES['sfile2'], $newIndexcode, 'reserv_files2');
	
	$backUrl .= "&no=".$newIndexcode;

}else{
	alert('등록되지 않았습니다.');
}


header('location:'.$backUrl);
exit;


?>