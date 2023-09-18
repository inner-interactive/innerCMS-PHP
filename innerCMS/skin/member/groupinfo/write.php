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
$blankList = array("name|권한명을", "authlevel|권한레벨을");
blankCheck($blankList);
 

$DB = new DB();
$tableName = GROUP_TABLE;
$column = $DB->getColumns($tableName, array('indexcode'));


//기본 값 설정
$_POST['authlevel'] = intval($_POST['authlevel']);
if($_POST['authlevel'] < 0) $_POST['authlevel'] = 0;
if($_POST['authlevel'] > 99) $_POST['authlevel'] = 99;

$query = "SELECT count(*) FROM ".$tableName." WHERE authlevel = ".$_POST['authlevel'];
$dbData = $DB->getDBData($query);
if($dbData[0][0] > 0 ) alert("이미 등록된 권한레벨입니다.");

$query = $DB->insertSql($column, $_POST, $tableName);
$DB->runQuery($query);
$backUrl = html_entity_decode($_POST['backUrl']);
if($DB->affected_rows){

}else{
	alert('등록되지 않았습니다.');
}


header('location:'.$backUrl);
exit;


?>