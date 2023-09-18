<?php 
include "../../../../common.php";		// root define
include "../../../define.php";		// sub define
include_once COMMON_PATH."lib/common.lib.php";
include_once COMMON_PATH."lib/db.class.php";
include_once COMMON_PATH."lib/FcReservation.class.php";

if(count($_GET) == 0) alert('잘못된 접근입니다.');

$menuID = isset($_GET['menu']) ? intval($_GET['menu']) : 0;
if($menuID == 0) alert('잘못된 접근입니다.');

$no = intval($_GET['no']);
if($no == "" || $no == 0) alert('변경할 데이터값이 없습니다.');

$DB = new DB();

$RESERVATION = new FcReservation();

$query = "UPDATE ".$RESERVATION->reservationTable." SET delflag = 1 WHERE indexcode = ".$no;
$DB->runQuery($query);

$backUrl = urldecode(base64_decode($_GET['backUrl']));
header('location:'.$backUrl);
exit;

	

?>