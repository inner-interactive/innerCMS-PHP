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

$DB = new DB();
$MENU = new Menu($DB);
$menuInfo = $MENU->getMenuInfo($menuID);
$SKIN = new skin($menuInfo);

$_config_file = $SKIN->skin_path."config.php";
if(file_exists($_config_file)) include $_config_file;



$indexno = isset($_POST['indexno']) ? $_POST['indexno'] : null;
if(count($indexno) == 0) alert('정렬할 배너가 없습니다');

foreach($indexno as $key => $value){
	
	$query = "UPDATE ".$tableName." SET sort = ".(count($indexno) - $key)." WHERE banner_id = ".$value;
	$DB->runQuery($query);
}


//기본 값 설정


$backUrl = html_entity_decode($_POST['backUrl']);



header('location:'.$backUrl);
exit;


?>