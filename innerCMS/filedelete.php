<?php
include "../common.php";		
include "define.php";	
include_once COMMON_PATH."lib/common.lib.php";
include_once COMMON_PATH."lib/db.class.php";
include_once COMMON_PATH."lib/menu.class.php";

if(count($_REQUEST) == 0) alert('잘못된 접근입니다.');
//파일삭제는 menu_id값과 file_id값을 필수로 받아야함.

$menuID = isset($_GET['menu']) ? intval($_GET['menu']) : 0;
$no = isset($_GET['no']) ? intval($_GET['no']) : 0;
$backUrl = isset($_GET['backUrl']) ? html_entity_decode(trim($_GET['backUrl'])) : "./";	

if($menuID == 0 || $no == 0) alert('잘못된 접근입니다.');

$DB = new DB();
$MENU = new Menu();
$menuData = $MENU->getMenuInfo($menuID);


//파일 삭제 권한  체크 (메뉴정보에 파일 삭제 권한은 없으므로 파일 업로드 권한값과 비교함)
$auth_fileup = intval($menuData['auth_fileup']);
$user_level = isset($_SESSION['user_level']) ? intval($_SESSION['user_level']) : 0;
if($auth_fileup > $user_level) alert("파일 삭제 권한이 없습니다.");


$query = "SELECT attach_file_name, down_file_name, attach_type FROM ".FILE_TABLE." WHERE file_id = ".$no;
$fileData = $DB->getDBData($query);
$attach_type = trim($fileData[0]['attach_type']);
$attach_file_name = trim($fileData[0]['attach_file_name']);
$down_file_name = trim($fileData[0]['down_file_name']);

if(count($fileData) == 0) alert("파일이 존재하지 않습니다.");

$fullPath = DATA_PATH."upload/".$fileData[0]['attach_file_name'];
@unlink($fullPath);
$query = "DELETE FROM ".FILE_TABLE." WHERE file_id = ".$no;
$DB->runQuery($query);

header("location:".$backUrl);


?>