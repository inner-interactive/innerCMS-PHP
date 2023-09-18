<?php
include_once COMMON_PATH."lib/FcReservation.class.php";

$pno = isset($_GET['pno']) && intval($_GET['pno']) > 0 ? intval($_GET['pno']) : 1;
$category = isset($_GET['category']) && $_GET['category'] != "" ? trim($_GET['category']) : "";

$RESERVATION = new FcReservation();


if($mode == "list") {
    
    $list_type = isset($_GET['list_type']) && $_GET['list_type'] != "" ? trim($_GET['list_type']) : 'thum';
    
    $system['data']['dbData'] = $RESERVATION->getFacilityList('list', $pno);
    $system['data']['dbDataTotal'] = $RESERVATION->getFacilityList('total');
    
    $paging = $SKIN->getPaging($pno, $system['data']['dbDataTotal'], $SKIN->listLimitNum);
    extract($paging);
    
}else if($mode == "view"){
    
    $no = isset($_GET['no']) && intval($_GET['no']) > 0 ? intval($_GET['no']) : 0;
    $dbData = $RESERVATION->getFacilityDataOne($no);
    
    $system['data']['dbData'] = $dbData;
    $system['data']['picData'] = $SKIN->getFileData($menuID, $no, 'reserv_pic');
    $system['data']['files1Data'] = $SKIN->getFileData($menuID, $no, 'reserv_files1');
    $system['data']['files2Data'] = $SKIN->getFileData($menuID, $no, 'reserv_files2');
    
    
}else if($mode == "calendar"){
    
    $no = isset($_GET['no']) && intval($_GET['no']) > 0 ? intval($_GET['no']) : 0;
    $dbData = $RESERVATION->getFacilityDataOne($no);
    
    //예약 사용여부 체크
    $reservation_use = $RESERVATION->reservationUseCheck($no);
    if(!$reservation_use) alert('예약 신청 사용중인 시설이 아닙니다.');
    
}else if($mode == "write"){
    
    $no = isset($_GET['no']) && intval($_GET['no']) > 0 ? intval($_GET['no']) : 0;
    $dbData = $RESERVATION->getFacilityDataOne($no);
    $system['data']['dbData'] = $dbData;
    
    $date = isset($_GET['date']) && trim($_GET['date']) != "" ? trim($_GET['date']) : "";
    $time = isset($_GET['time']) && trim($_GET['time']) != "" ? trim($_GET['time']) : "";
    $time2 = isset($_GET['time2']) && trim($_GET['time2']) != "" ? trim($_GET['time2']) : "";
    $time3 = isset($_GET['time3']) && trim($_GET['time3']) != "" ? trim($_GET['time3']) : "";
    
    $timeDiv = explode("|", $time);
    
    //예약 사용여부 체크
    $useCheck = $RESERVATION->reservationUseCheck($no);
    if(!$useCheck) alert('예약 신청 사용중인 시설이 아닙니다.');

    //예약 시간값 체크
    if($date == '') alert('예약 신청 날짜가 없습니다.');
    
    // 예약 가능한 날짜인지 체크
    $dateCheck = $RESERVATION->reservationDateCheck($no, $date);
    if(!$dateCheck) alert('예약 신청 가능한 날짜가 아닙니다.');
    
    // 예약 가능한 시간인지 체크
    //예약시간이 1시간 단위일경우 이후 시간값도 넣어서 체크.
    if($dbData[0]['reservation_type'] == 0){
        
        if($time == "") alert('예약 신청할 시간이 선택되지 않았습니다.');
        $timeList = explode("|", $time);
        if($dbData[0]['reservation_type1_time_unit'] == "1H"){
            foreach($timeList as $value){
                array_push($timeList, $value + 1);
            }
            $timeCountTxt = count($timeDiv)."시간";
        }else if($dbData[0]['reservation_type1_time_unit'] == "30M"){
            $h = floor(count($timeDiv) / 2)."시간";
            if($h < 1) $h = "";
            $m = count($timeDiv) % 2 == 1 ? "30분" : "";
            $timeCountTxt = $h.$m;
        }
        
        
    }else if($dbData[0]['reservation_type'] == 1){
        if($time == "" && $time2 == "" && $time3 == "") alert('예약 신청할 시간이 선택되지 않았습니다.');
        
        $divisionCheck = $RESERVATION->reservationDivisionCheck($no, $time, $time2, $time3);
        if(!$divisionCheck) alert('잘못된 접근입니다.');
        $timeList = array();
        
        $timeDiv = $time != "" ? explode("|", $time) : array();
        $time2Div = $time2 != "" ? explode("|", $time2) : array();
        $time3Div = $time3 != "" ? explode("|", $time3) : array();
        
        $timeList = array_merge($timeDiv, $time2Div, $time3Div);
        
        $timeCountCheckArray = array();
        if($time != "") array_push($timeCountCheckArray, "오전");
        if($time2 != "") array_push($timeCountCheckArray, "오후");
        if($time3 != "") array_push($timeCountCheckArray, "야간");
        $timeCountTxt = implode("/",$timeCountCheckArray);
        
    }
    
    foreach($timeList as $seq){
        $timeCheck =  $RESERVATION->reservationTimeCheck($no, $date, $seq);
        if(!$timeCheck) alert('예약 신청 가능한 시간이 아니거나 예약 불가능한 시간이 포함되어 있습니다.');
    }
    
   
    $reservationTimeText = $RESERVATION->getDisplayTime($no, $date, $time, $time2, $time3);
    $reservationFee = $RESERVATION->getReservationFee($no, $time, $time2, $time3);
    
}else if($mode == 'myreservation'){
    
    $reservationData = array();
    $where = "WHERE a.indexcode = b.facode";
    $auth = false;
    if($userID){    //로그인되어 있다면 로그인 사용자의 예약목록을 가져온다.
        $where .= " AND b.uid = '".$userID."'";
        $auth = true;
        
    }else{  //로그인되어 있지 않다면 세션에 이름과 비밀번호가 저장되어 있는지 체크한다.
        
        if(
            isset($_SESSION['reservation_uname']) && $_SESSION['reservation_uname'] != "" &&
            isset($_SESSION['reservation_upw']) && $_SESSION['reservation_upw'] != ""
        ){
            $where .= " AND b.uname = '".$_SESSION['reservation_uname']."' AND b.upw = password('".$_SESSION['reservation_upw']."')";
            $auth = true;
        }
    }
    
    if($auth){
        $query = "SELECT a.subject, a.location, b.indexcode, b.reservation_time_info, b.reservation_state FROM ".$RESERVATION->facilityTable." AS a, ".$RESERVATION->reservationTable." AS b ".$where."";
        $reservationData = $DB->getDBData($query);
    }
    
    $system['data']['reservationData'] = $reservationData;
}

