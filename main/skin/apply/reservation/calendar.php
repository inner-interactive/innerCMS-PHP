<?php 
include "../../../../common.php";
include "../../../define.php";
include_once COMMON_PATH."lib/common.lib.php";


$reservation_type = isset($_POST['reservation_type']) && trim($_POST['reservation_type']) != "" ? intval($_POST['reservation_type']) : 0;

//시간대별 예약
if($reservation_type == 0){
    $date = isset($_POST['date']) && trim($_POST['date']) != "" ? trim($_POST['date']) : "";
    $time = isset($_POST['time']) && trim($_POST['time']) != "" ? trim($_POST['time']) : "";
    
    if($date == "" || $time == ""){
        alert('예약 하고자 하는 날짜와 시간을 선택해 주세요.');
    }
    
    $backUrl = $_POST['backUrl']."&mode=write&date=".urlencode($date)."&time=".urlencode($time);
    
//오전/오후/야간 예약
}else if($reservation_type == 1){
    $date = isset($_POST['date']) && trim($_POST['date']) != "" ? trim($_POST['date']) : "";
    $time1 = isset($_POST['time1']) && trim($_POST['time1']) != "" ? trim($_POST['time1']) : "";
    $time2 = isset($_POST['time2']) && trim($_POST['time2']) != "" ? trim($_POST['time2']) : "";
    $time3 = isset($_POST['time3']) && trim($_POST['time3']) != "" ? trim($_POST['time3']) : "";
    
    if($date == "" || ($time1 == "" && $time2 == "" && $time3 == "") ){
        alert('예약 하고자 하는 날짜와 시간대를 선택해 주세요.');
    }
    
    $backUrl = $_POST['backUrl']."&mode=write&date=".$date;
    if($time1 != ""){
        $backUrl .= "&time=".urlencode($time1);
    }
    if($time2 != ""){
        $backUrl .= "&time2=".urlencode($time2);
    }
    
    if($time3 != ""){
        $backUrl .= "&time3=".urlencode($time3);
    }
    
}else{
    alert('잘못된 접근입니다.');
}



header('location:'.$backUrl);

?>