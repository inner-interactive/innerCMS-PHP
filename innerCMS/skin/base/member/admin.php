<?php	
include "../../../../common.php";		
include "../../../define.php";	
include_once COMMON_PATH."lib/common.lib.php";
include_once COMMON_PATH."lib/db.class.php";
include_once COMMON_PATH."lib/menu.class.php";
include_once COMMON_PATH."lib/skin.class.php";
include_once COMMON_PATH."lib/grant.class.php";

if(count($_POST) == 0) alert('잘못된 접근입니다.');

$menuID = isset($_POST['menu']) ? intval($_POST['menu']) : 0;
if($menuID == 0) alert('잘못된 접근입니다.');


$action = isset($_POST['action']) ? trim($_POST['action']) : "";
$indexno = isset($_POST['indexno']) ?  $_POST['indexno'] : null;
$blankList = array("!action|처리할 작업을", "!indexno|회원을");
if($action == "authlevel") array_push($blankList, "!authlevel|회원권한을");
$authlevel = isset($_POST['authlevel']) ?intval($_POST['authlevel']) : 0;
blankCheck($blankList);


$DB = new DB();
$MENU = new Menu($DB);
$menuInfo = $MENU->getMenuInfo($menuID);
$SKIN = new skin($menuInfo);


$GRANT = new Grant();
if(!$GRANT->grant['auth_admin']) alert('권한이 없습니다.');




switch ($action){
	
	//블랙리스트 등록
	case "blacklist" :
		foreach($indexno as $no)
		{
			$query = "UPDATE ".MEMBER_TABLE." SET isblocked = 1 WHERE indexcode = ".$no;
			$DB->runQuery($query);
		}
		break;
		
		
	//블랙리스트 해제
	case "noblacklist" :
		foreach($indexno as $no)
		{
			$query = "UPDATE ".MEMBER_TABLE." SET isblocked = 0 WHERE indexcode = ".$no;
			$DB->runQuery($query);
		}
		break;
		
	//회원탈퇴처리
	case "retire" :
		foreach($indexno as $no)
		{
			$query = "SELECT * FROM ".MEMBER_TABLE." WHERE indexcode = ".$no;
			$memberData = $DB->getDBData($query);
			
			$retireData = $memberData[0];
			
			if($retireData['userid'] == 'inner' || $retireData['userid'] == 'admin'){
				continue;
			}
			
			$column = $DB->getColumns(RETIRE_TABLE, array('indexcode'));
			$column['retiretime']['type'] = "now";
			
			//탈퇴회원정보 테이블에 기록
			$query = $DB->insertSql($column, $retireData, RETIRE_TABLE);
			$DB->runQuery($query);

			//회원테이블에서 삭제
			$query = "DELETE FROM ".MEMBER_TABLE." WHERE indexcode = ".$no;
			$DB->runQuery($query);
			
		}
		break;
	
	//회원권한변경
	case "authlevel" :
		foreach($indexno as $no)
		{
			$query = "UPDATE ".MEMBER_TABLE." SET authlevel = ".$authlevel." WHERE indexcode = ".$no;
			$DB->runQuery($query);
		}
		break;
	
		
	//회원 완전삭제
	case 'delete' :
		foreach($indexno as $no)
		{
			$query = "DELETE FROM ".MEMBER_TABLE." WHERE indexcode = ".$no;
			$DB->runQuery($query);
		}
		break;
		
}


$backUrl = html_entity_decode($_POST['backUrl']);
header('location:'.$backUrl);
exit;


?>