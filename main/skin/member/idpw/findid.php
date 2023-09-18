<?php
include "../../../../common.php";
include "../../../define.php";
include_once COMMON_PATH . "lib/common.lib.php";
include_once COMMON_PATH . "lib/db.class.php";
include_once COMMON_PATH . "lib/menu.class.php";
include_once COMMON_PATH . "lib/skin.class.php";
include_once COMMON_PATH . "lib/grant.class.php";


if (count($_POST) == 0)
    alert('잘못된 접근입니다.');


// 필수 입력 체크
$blankList = array(
    "name|이름을",
    "email|이메일 주소를"
);
blankCheck($blankList);


$DB = new DB();

$tableName = MEMBER_TABLE;
$name = isset($_POST['name']) ? trim($_POST['name']) : "";
$email = isset($_POST['email']) ? trim($_POST['email']) : "";


$where = " WHERE realname = '".$name."' AND email = '".$email."'";
$query = "SELECT * FROM ".$tableName.$where." limit 1";
$dbData = $DB->getDBData($query);


if(count($dbData) == 0){
    $resultlMsg = "조건과 일치하는 아이디가 없습니다.";
    
}else{
    $resultlMsg = "검색된 아이디는 ".$dbData[0]['userid']." 입니다.";
    
}
$backUrl = urldecode($_POST['backUrl']);
alert($resultlMsg, $backUrl);
exit;


?>