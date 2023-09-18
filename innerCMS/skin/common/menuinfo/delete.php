<?php	
include "../../../../common.php";		// root define
include "../../../define.php";		// sub define
include_once COMMON_PATH."lib/common.lib.php";
include_once COMMON_PATH."lib/db.class.php";
include_once COMMON_PATH."lib/program.class.php";

if(count($_REQUEST) == 0) alert('잘못된 접근입니다.');

if(!$isAdmin) alert('접근 권한이 없습니다.');

$DB = new DB();
$no = intval($_GET['no']);
if($no == 0) alert('잘못된 접근입니다.');


//메뉴 삭제시 삭제할 메뉴에 링크가 연결된 상위메뉴가 있는지 체크
$query = "SELECT menu_id FROM ".MENU_TABLE." WHERE second_id = ".$no;
$dbData = $DB->getDBData($query);

$query = "SELECT parent_id FROM ".MENU_TABLE." WHERE menu_id = ".$no;
$dbData2 = $DB->getDBData($query);

if(count($dbData2) > 0)
{
	
	$target_id = intval($dbData2[0]['parent_id']);
	
	for($i = 0; $i < count($dbData); $i++){
		$query = "UPDATE ".MENU_TABLE." SET second_id = ".$target_id." WHERE menu_id = ".$dbData[$i]['menu_id'];
		$DB->runQuery($query);
	}
}

$query = "DELETE FROM ".MENU_TABLE." WHERE menu_id = ".$no;
$DB->runQuery($query);

$query = "DELETE FROM ".CONTENTS_TABLE." WHERE menu_id = ".$no;
$DB->runQuery($query);

//program class 연동
$PROGRAM = new Program();
$PROGRAM->deleteConfig($no);



$backUrl = urldecode($_GET['backUrl']);
header('location:'.$backUrl);
exit; 


?>