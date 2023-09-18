<?php 
include "../../../../common.php";		// root define
include "../../../define.php";		// sub define
include_once COMMON_PATH."lib/common.lib.php";
include_once COMMON_PATH."lib/db.class.php";
include_once COMMON_PATH."lib/menu.class.php";
include_once COMMON_PATH."lib/skin.class.php";
include_once COMMON_PATH."lib/grant.class.php";
include_once COMMON_PATH."lib/program.class.php";

if(count($_GET) == 0) alert('잘못된 접근입니다.');

$menuID = isset($_GET['menu']) ? intval($_GET['menu']) : 0;
if($menuID == 0) alert('잘못된 접근입니다.');

$no = intval($_GET['no']);
if($no == "" || $no == 0) alert('변경할 데이터값이 없습니다.');

$DB = new DB();
$MENU = new Menu($DB);

$PROGRAM = new Program();
$tableName = $PROGRAM->list_table;

$menuInfo = $MENU->getMenuInfo($menuID);
$SKIN = new skin($menuInfo);

$query = "SELECT menucode FROM ".$PROGRAM->apply_table." WHERE indexcode = ".$no;
$dbData = $DB->getDBData($query);
$menuID = intval($dbData[0]['menucode']);
$fileData = $SKIN->getFileData($menuID, $no, 'attach');

foreach($fileData as $value){
	$SKIN->fileDelete($value['file_id']);
}


$query = "DELETE FROM ".$PROGRAM->apply_table." WHERE indexcode = {$no}";
$DB->runQuery($query);

$backUrl = urldecode(base64_decode($_GET['backUrl']));
header('location:'.$backUrl);
exit;

	

?>