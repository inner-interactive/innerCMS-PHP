<?php	
include "../../../../common.php";		
include "../../../define.php";	
include_once COMMON_PATH."lib/common.lib.php";
if(count($_POST) == 0) alert('잘못된 접근입니다.');

$menuID = isset($_POST['menu']) ? intval($_POST['menu']) : 0;
if($menuID == 0) alert('잘못된 접근입니다.');


$backUrl = html_entity_decode($_POST['backUrl']);




//필수 입력 체크
$blankList = array("uname|담당자(신청자) 성명을");
array_push($blankList, "upw|비밀번호를");

blankCheck($blankList);



$uname = trim($_POST['uname']);
$upw = trim($_POST['upw']);

$_SESSION['reservation_uname'] = $uname;
$_SESSION['reservation_upw'] = $upw;

$backUrl = html_entity_decode($_POST['backUrl']);

header('location:'.$backUrl);
exit;



?>