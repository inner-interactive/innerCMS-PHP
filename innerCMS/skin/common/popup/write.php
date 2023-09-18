<?php	
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
$blankList = array("subject|팝업 제목을", "memo|팝업 내용을", "start_date|팝업 시작 날짜를", "end_date|팝업 종료 날짜를" );
blankCheck($blankList);
 

$DB = new DB();
$column = $DB->getColumns(POPUP_TABLE, array('pop_id'));
$column['writetime']['type'] = "now";


//기본 값 설정
$_POST['uid'] = $userID;
$_POST['uname'] = $userName;
$_POST['width'] = isset($_POST['width']) ? intval($_POST['width']) : 150;
$_POST['height'] = isset($_POST['height']) ? intval($_POST['height']) : 150;
$_POST['left'] = isset($_POST['left']) ? intval($_POST['left']) : 0;
$_POST['top'] = isset($_POST['top']) ? intval($_POST['top']) : 0;
$_POST['not_today'] = isset($_POST['not_today']) ? intval($_POST['not_today']) : 0;
$_POST['scrolling'] = isset($_POST['scrolling']) ? intval($_POST['scrolling']) : 0;
$_POST['isstop'] = isset($_POST['isstop']) ? intval($_POST['isstop']) : 0;
$_POST['ip'] = $_SERVER['REMOTE_ADDR'];

if($_POST['link_target'] == "")  $_POST['link_target'] = "S";

//에디터에 삽입된 링크의 대상창 설정
if($_POST['link_target'] == "B"){
	$_POST['memo'] = str_replace("target=\\\"_self\\\"", "target=\\\"_blank\\\"", $_POST['memo']);
}else if($_POST['link_target'] == "S"){
	$_POST['memo'] = str_replace("target=\\\"_blank\\\"", "target=\\\"_self\\\"", $_POST['memo']);
}

$query = $DB->insertSql($column, $_POST, POPUP_TABLE);
$DB->runQuery($query);
$backUrl = html_entity_decode($_POST['backUrl']);
if($DB->affected_rows){

	$query = "SELECT max(pop_id) FROM ".POPUP_TABLE;
	$dbData = $DB->getDBData($query);
	$newIndexcode = intval($dbData[0][0]);
	$backUrl .= "&no=".$newIndexcode;

}else{
	alert('팝업이 등록되지 않았습니다.');
}


header('location:'.$backUrl);
exit;


?>