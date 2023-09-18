<?php 
include "../../../../common.php";		// root define
include "../../../define.php";		// sub define
include_once COMMON_PATH."lib/common.lib.php";
include_once COMMON_PATH."lib/db.class.php";
include_once COMMON_PATH."lib/FcReservation.class.php";

if(count($_REQUEST) == 0) alert('잘못된 접근입니다.');


if(!$isAdmin) alert('접근 권한이 없습니다.');


$DB = new DB();
$RESERVATION = new FcReservation();
$no = intval($_GET['no']);
$state = intval($_GET['state']);

$query = "UPDATE ".$RESERVATION->reservationTable." SET reservation_state = $state WHERE indexcode = {$no}";
$DB->runQuery($query);

$backUrl = urldecode(base64_decode($_GET['backUrl']));

header('location:'.$backUrl);
exit;


?>