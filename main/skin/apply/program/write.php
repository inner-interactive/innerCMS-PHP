<?php	
include "../../../../common.php";		
include "../../../define.php";	
include_once COMMON_PATH."lib/common.lib.php";
include_once COMMON_PATH."lib/db.class.php";
include_once COMMON_PATH."lib/menu.class.php";
include_once COMMON_PATH."lib/skin.class.php";
include_once COMMON_PATH."lib/grant.class.php";
include_once COMMON_PATH."lib/program.class.php";
if(count($_POST) == 0) alert('잘못된 접근입니다.');

$menuID = isset($_POST['menu']) ? intval($_POST['menu']) : 0;
if($menuID == 0) alert('잘못된 접근입니다.');


// if($userID == "" && !chk_captcha()){
// 	alert('자동등록방지 숫자가 틀렸습니다.');
// }
$no = intval($_POST['no']);
if($no == 0) alert('잘못된 접근입니다.');


$DB = new DB();
$MENU = new Menu($DB);
$menuInfo = $MENU->getMenuInfo($menuID);
$SKIN = new skin($menuInfo);

$PROGRAM = new Program();
$tableName = $PROGRAM->apply_table;

$GRANT = new Grant();
$GRANT->writeGrantCheck();

$config = $PROGRAM->getConfig($menuID);

if(!$PROGRAM->reservUseCheck($config)){
	alert('예약 사용이 중지되었습니다.');
}

//필수 입력 체크
$blankList = array("name|신청자 성명을", "mo2|핸드폰 번호를", "mo3|핸드폰 번호를");
if($userID == "")
{
	array_push($blankList, "upw|비밀번호를");
}
blankCheck($blankList);


if(!isset($_POST['agree'])){
	alert('개인정보 수집 항목 및 이용동의에 체크해주세요.');
}

//인원 산정 방식이 참여인원 포함 방식이면 참여인원수 입력 체크 함.
if(isset($config['finish_check_type']) && $config['finish_check_type'] == 1){
	if(intval($_POST['num1']) == 0){
		alert('참여인원수를 입력해 주세요');
	}
}


//신청 기간 체크
$query = "SELECT datetime1, datetime2 FROM ".$PROGRAM->list_table." WHERE indexcode = ".$no;
$programData = $DB->getDBData($query);

$starttime = strtotime($programData[0]['datetime1']);
$endtime = strtotime($programData[0]['datetime2']);

if($starttime <= SERVER_TIME && $endtime >= SERVER_TIME){
	
}else{
	alert('신청기간이 아닙니다.');
}


$phone = $_POST['mo1']."-".$_POST['mo2']."-".$_POST['mo3'];
//중복 신청 체크
if($userID){
	//로그인 사용자는 아이디로 체크
	$query = "SELECT count(*) FROM ".$PROGRAM->apply_table." WHERE programcode = ".$no." AND uid = '".$userID."'";
	$dbData = $DB->getDBData($query);
	
	
}else{
	//비로그인 사용자는 휴대폰 번호로 체크
	$query = "SELECT count(*) FROM ".$PROGRAM->apply_table." WHERE programcode = ".$no." AND phone = '".$phone."'";
	$dbData = $DB->getDBData($query);
	
}

if($dbData[0][0] > 0 ) alert('이미 신청하였습니다.');
// $query = "SELECT count(*) FROM"


//인원 마감 체크
$total = $PROGRAM->getTotalNum($no);					//정원
$current = $PROGRAM->getCurrentNum($config, $no);		//현재 신청수

$applynum = isset($config['finish_check_type']) && $config['finish_check_type'] == 1 ? intval($_POST['num1']) : 1;

if($applynum + $current > $total){
	alert('정원이 초과되었습니다.');
}



$column = $DB->getColumns($tableName, array('indexcode', 'updatetime', 'date1', 'date2'));
$column['writetime']['type'] = "now";

if(isset($_SESSION['user_id']) && $_SESSION['user_id'] != ""){
	$_POST['uid'] = trim($_SESSION['user_id']);
	$_POST['uname'] = trim($_SESSION['user_uname']);
	$_POST['realname'] = trim($_SESSION['user_realname']);
}else{
	$_POST['uname'] = trim($_POST['uname']);
	$column['upw']['type'] = "password";
}

$_POST['ip'] = $_SERVER['REMOTE_ADDR'];
$_POST['hmode'] = $SKIN->getHmode($menuInfo['html_use'], $GRANT->grant['auth_alltag']);

$_POST['phone'] = $phone;
$_POST['email'] = $_POST['e_id']."@".$_POST['e_domain'];
$_POST['programcode'] = $no;
$_POST['menucode'] = $menuID;




$query = $DB->insertSql($column, $_POST, $tableName);
$DB->runQuery($query);

$backUrl = html_entity_decode($_POST['backUrl']);
if($DB->affected_rows){
	
	$query = "SELECT max(indexcode) FROM ".$tableName;
	$dbData = $DB->getDBData($query);
	$newIndexcode = intval($dbData[0][0]);
	$SKIN->fileUpload($_FILES['sfile'], $newIndexcode, 'attach');
	$backUrl .= "&no=".$newIndexcode;
	
}else{
	alert('글이 등록되지 않았습니다.');
}


header('location:'.$backUrl);
exit;


?>