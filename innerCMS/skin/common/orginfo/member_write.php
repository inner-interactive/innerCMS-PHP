<?php	
include "../../../../common.php";		// root define
include "../../../define.php";		// sub define
include_once COMMON_PATH."lib/common.lib.php";
include_once COMMON_PATH."lib/db.class.php";
include_once COMMON_PATH."lib/menu.class.php";
include_once COMMON_PATH."lib/skin.class.php";
include_once COMMON_PATH."lib/grant.class.php";
include_once "orginfo.class.php";

if(count($_POST) == 0) alert('잘못된 접근입니다.');

if(!$isAdmin) alert('접근 권한이 없습니다.');

$menuID = isset($_POST['menu']) ? intval($_POST['menu']) : 0;
if($menuID == 0) alert('잘못된 접근입니다.');


//필수 입력 체크
$blankList = array("org_parent|부서를", "name|성명을" );
blankCheck($blankList);
 
$DB = new DB();
$orgInfo = new OrgInfo($DB);
$orgInfo->memberWrite($_POST);

$backUrl = html_entity_decode($_POST['backUrl']);
if(!$DB->affected_rows){
	alert('등록되지 않았습니다.');
}



header('location:'.$backUrl);
exit;


?>