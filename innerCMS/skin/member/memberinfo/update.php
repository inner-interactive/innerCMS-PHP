<?php	
include "../../../../common.php";		// root define
include "../../../define.php";		// sub define
include_once COMMON_PATH."lib/common.lib.php";
include_once COMMON_PATH."lib/db.class.php";
include_once COMMON_PATH."lib/menu.class.php";

if(count($_POST) == 0) alert('잘못된 접근입니다.');

if(!$isAdmin) alert('접근 권한이 없습니다.');
//필수 입력 체크

$menuID = isset($_POST['menu']) ? intval($_POST['menu']) : 0;
if($menuID == 0) alert('잘못된 접근입니다.');

//필수 입력 체크
$blankList = array("realname|실명을", "nickname|닉네임을", "!authlevel|회원권한을");
blankCheck($blankList);

//기본 값 설정
$_POST['pop_id'] = intval($_POST['no']);
$_POST['left'] = isset($_POST['left']) ? intval($_POST['left']) : 0;
$_POST['top'] = isset($_POST['top']) ? intval($_POST['top']) : 0;
$_POST['not_today'] = isset($_POST['not_today']) ? intval($_POST['not_today']) : 0;
$_POST['scrolling'] = isset($_POST['scrolling']) ? intval($_POST['scrolling']) : 0;
$_POST['isstop'] = isset($_POST['isstop']) ? intval($_POST['isstop']) : 0;





$DB = new DB();
$tableName = MEMBER_TABLE;
$column = $DB->getColumns($tableName, array('userpw', 'realname', 'nickname', 'authlevel', 'sex', 'mobile', 'birth', 'phone', 'email', 'url', 'zipcode', 'address', 'address2', 'address3', 'address_type', 'ismailing', 'memo'), true);

//기본 값 설정
if($_POST['userpw'] != ""){
	$column['userpw']['type'] = "password";
}else{
	unset($column['userpw']);
}
$_POST['indexcode'] = intval($_POST['no']);


$query = $DB->updateSql($column, $_POST, $tableName, "indexcode");
$DB->runQuery($query);
$backUrl = html_entity_decode($_POST['backUrl']);
header('location:'.$backUrl);
exit;


?>