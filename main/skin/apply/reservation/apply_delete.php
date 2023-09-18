<?php 
include "../../../../common.php";		// root define
include "../../../define.php";		// sub define
include_once COMMON_PATH."lib/common.lib.php";
include_once COMMON_PATH."lib/db.class.php";
include_once COMMON_PATH."lib/menu.class.php";
include_once COMMON_PATH."lib/FcReservation.class.php";

if(count($_GET) == 0) alert('잘못된 접근입니다.');


$no = intval($_GET['no']);
if($no == "" || $no == 0) alert('변경할 데이터값이 없습니다.');

$DB = new DB();

$RESERVATION = new FcReservation();


$check = $RESERVATION->myReservationCheck($no);

if($check){
    $query = "DELETE FROM ".$RESERVATION->reservationTable." WHERE indexcode = {$no}";
    $DB->runQuery($query);
}

$backUrl = urldecode($_GET['backUrl']);
header('location:'.$backUrl);
exit;

	

?>