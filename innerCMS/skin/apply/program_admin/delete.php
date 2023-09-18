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

if(!$isAdmin) alert('접근 권한이 없습니다.');

$menuID = isset($_GET['menu']) ? intval($_GET['menu']) : 0;
if($menuID == 0) alert('잘못된 접근입니다.');


$no = intval($_GET['no']);
if($no == 0) alert('잘못된 접근입니다.');


$DB = new DB();
$MENU = new Menu($DB);
$menuInfo = $MENU->getMenuInfo($menuID);
$SKIN = new skin($menuInfo);
$PROGRAM = new Program();

$query = "SELECT * FROM ".$PROGRAM->list_table." WHERE indexcode = ".$no;
$programData = $DB->getDBData($query);

$menuID = $programData[0]['site_menuid'];

$query = "SELECT * FROM ".$PROGRAM->apply_table." WHERE programcode = ".$no;
$applyData = $DB->getDBData($query);


//첨부파일 삭제
foreach($applyData as $value){

	$_no = $value['indexcode'];
	$fileData = $SKIN->getFileData($menuID, $_no, 'attach');
	foreach($fileData as $value2){
		
		$SKIN->fileDelete($value2['file_id']);
	}
}

//신청 기록 삭제
$query = "DELETE FROM ".$PROGRAM->apply_table." WHERE programcode = ".$no;
$DB->runQuery($query);

//프로그램 정보 삭제
$query = "DELETE FROM ".$PROGRAM->list_table." WHERE indexcode = ".$no;
$DB->runQuery($query);

$backUrl = urldecode(base64_decode($_GET['backUrl']));

header('location:'.$backUrl);
exit; 


?>