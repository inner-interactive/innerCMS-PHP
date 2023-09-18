<?php	
include "../../../../common.php";		// root define
include "../../../define.php";		// sub define
include_once COMMON_PATH."lib/common.lib.php";
include_once COMMON_PATH."lib/db.class.php";
include_once COMMON_PATH."lib/menu.class.php";
include_once COMMON_PATH."lib/skin.class.php";
include_once COMMON_PATH."lib/FcReservation.class.php";


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
$RESERVATION = new FcReservation();


//신청기록 삭제
$query = "UPDATE ".$RESERVATION->reservationTable." SET delflag = 1 WHERE facode = ".$no;
$DB->runQuery($query);


//첨부파일 삭제
$query = "SELECT * FROM ".FILE_TABLE." WHERE indexcode = ".$no;
$fileData = $DB->getDBData($query);

foreach($fileData as $value){
    
    $_file_id = $value['file_id'];
    $SKIN->fileDelete($_file_id);
    
}

//예약시설 삭제
$query = "UPDATE ".$RESERVATION->facilityTable." SET delflag = 1 WHERE indexcode = ".$no;
$DB->runQuery($query);


$backUrl = urldecode(base64_decode($_GET['backUrl']));

header('location:'.$backUrl);
exit; 


?>