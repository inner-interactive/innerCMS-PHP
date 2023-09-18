<?php	
if(count($_GET) == 0) die('not permited to access this page directly');

include "../../../../common.php";		// root define
include "../../../define.php";		// sub define
include_once COMMON_PATH."lib/common.lib.php";
include_once COMMON_PATH."lib/db.class.php";
include_once COMMON_PATH."lib/menu.class.php";
include_once COMMON_PATH."lib/skin.class.php";
include_once COMMON_PATH."lib/grant.class.php";

if(count($_REQUEST) == 0) alert('잘못된 접근입니다.');

if(!$isAdmin) alert('접근 권한이 없습니다.');

$menuID = isset($_GET['menu']) ? intval($_GET['menu']) : 0;
if($menuID == 0) alert('잘못된 접근입니다.');


$DB = new DB();
$MENU = new Menu($DB);
$menuInfo = $MENU->getMenuInfo($menuID);
$SKIN = new skin($menuInfo);

$_config_file = $SKIN->skin_path."config.php";
if(file_exists($_config_file)) include $_config_file;


$no = intval($_GET['no']);
if($no == 0) alert('잘못된 접근입니다.');


$query = "SELECT banner_type FROM ".$tableName." WHERE banner_id = ".$no;
$dbData = $DB->getDBData($query);
$type = $dbData[0]['banner_type'];

$imageData = $SKIN->getFileData($menuID, $no, $type);

if(count($imageData) > 0){
	
	for($i = 0; $i < count($imageData); $i++){
		$fullPath = DATA_PATH."upload/".$imageData[$i]['attach_file_name'];
		@unlink($fullPath);
		$query = "DELETE FROM ".FILE_TABLE." WHERE file_id = ".$imageData[$i]['file_id'];
		$DB->runQuery($query);
	}
	
}


$query = "DELETE FROM ".$tableName." WHERE banner_id = ".$no;
$DB->runQuery($query);

$backUrl = html_entity_decode($_GET['backUrl']);

header('location:'.$backUrl);
exit; 


?>