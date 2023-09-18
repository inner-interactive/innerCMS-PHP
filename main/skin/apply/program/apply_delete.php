<?php 
include "../../../../common.php";
include "../../../define.php";
include_once COMMON_PATH."lib/common.lib.php";
include_once COMMON_PATH."lib/db.class.php";
include_once COMMON_PATH."lib/menu.class.php";
include_once COMMON_PATH."lib/skin.class.php";
include_once COMMON_PATH."lib/grant.class.php";
include_once COMMON_PATH."lib/program.class.php";

if(count($_GET) == 0) alert('잘못된 접근입니다.');

$backUrl =  urldecode(base64_decode($_GET['backUrl']));

$no = intval($_GET['no']);
if($no == 0) alert('취소할 자료가 없습니다.');

$DB = new DB();
$MENU = new Menu($DB);
$PROGRAM = new Program();

$query = "SELECT * FROM ".$PROGRAM->apply_table." WHERE indexcode = ".$no;
$dbData = $DB->getDBData($query);

$menuID = $dbData[0]['menucode'];

$menuInfo = $MENU->getMenuInfo($menuID);
$SKIN = new skin($menuInfo);


$dbuid = $dbData[0]['uid'];

if($dbuid != "")	//로그인 사용자가 신청했을 경우
{
	if($userID != "" && $dbuid == $userID)
	{
		
		$query = "SELECT menucode FROM ".$PROGRAM->apply_table." WHERE indexcode = ".$no;
		$dbData = $DB->getDBData($query);
		$menuID = intval($dbData[0]['menucode']);
		$fileData = $SKIN->getFileData($menuID, $no, 'attach');
		
		foreach($fileData as $value){
			$SKIN->fileDelete($value['file_id']);
		}
		
		$query = "DELETE FROM ".$PROGRAM->apply_table." WHERE indexcode = ".$no;
		$DB->runQuery($query);
		
		
	}
}else //비로그인 사용자가 신청했을 경우
{
	
	
	$upw = base64_decode($_GET['upw']);

	$query = "SELECT password('".trim($upw)."')";
	$dbData = $DB->getDBData($query);
	$upw = $dbData[0][0];

	$query = "SELECT upw FROM ".$PROGRAM->apply_table." WHERE indexcode = ".$no;
	$dbData = $DB->getDBData($query);
	$db_upw = $dbData[0][0];
 
	if($db_upw == $upw)
	{
		$query = "DELETE FROM ".$PROGRAM->apply_table." WHERE indexcode = ".$no;
		$DB->runQuery($query);
	}

}





header("location:".$backUrl);
exit;


?>