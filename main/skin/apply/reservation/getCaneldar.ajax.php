<?php
include "../../../../common.php";
include "../../../define.php";
include_once COMMON_PATH."lib/common.lib.php";
include_once COMMON_PATH."lib/db.class.php";
include_once COMMON_PATH."lib/FcReservation.class.php";

			
if($_GET['no'] != "" && $_GET['date'] != ""){
    $DB = new DB();
    $no = isset($_GET['no']) ? intval($_GET['no']) : 0;
    $date = isset($_GET['date']) ? trim($_GET['date']) : "";
    $RESERVATION = new FcReservation();
    $RESERVATION->getCalendar($no, $date);
}else{
    echo "<div class=\"no_reserv\">잘못된 접근입니다.</div>";
}