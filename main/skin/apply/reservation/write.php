<?php	
include "../../../../common.php";		
include "../../../define.php";	
include_once COMMON_PATH."lib/common.lib.php";
include_once COMMON_PATH."lib/db.class.php";
include_once COMMON_PATH."lib/menu.class.php";
include_once COMMON_PATH."lib/skin.class.php";
include_once COMMON_PATH."lib/grant.class.php";
include_once COMMON_PATH."lib/FcReservation.class.php";
if(count($_POST) == 0) alert('잘못된 접근입니다.');

$menuID = isset($_POST['menu']) ? intval($_POST['menu']) : 0;
if($menuID == 0) alert('잘못된 접근입니다.');


$no = intval($_POST['no']); if($no == 0) alert('잘못된 접근입니다.');
$backUrl = html_entity_decode($_POST['backUrl']);




//필수 입력 체크
$blankList = array("uname|신청자 성명을");
if($userID == ""){
    array_push($blankList, "upw|비밀번호를");
}

array_push($blankList, "mobile1|휴대폰 번호를", "mobile2|휴대폰 번호를", "mobile3|휴대폰 번호를");
// array_push($blankList, "email|이메일을");
array_push($blankList, "use_purpose|사용목적을", "use_people|사용인원을");

blankCheck($blankList);

if(!isset($_POST['agreeok'])){
    alert('개인정보 수집 항목 및 이용동의에 체크해주세요.');
}



$DB = new DB();
$MENU = new Menu($DB);
$menuInfo = $MENU->getMenuInfo($menuID);
$SKIN = new skin($menuInfo);
$GRANT = new Grant();
$GRANT->writeGrantCheck();
$RESERVATION = new FcReservation();


$date = isset($_POST['date']) && trim($_POST['date']) != ""? trim($_POST['date']) : "" ;
if($date == '') alert('신청 날짜가 전달되지 않았습니다.');

$time = isset($_POST['time']) && trim($_POST['time']) != ""? trim($_POST['time']) : "" ;
$time2 = isset($_POST['time2']) && trim($_POST['time2']) != ""? trim($_POST['time2']) : "" ;
$time3 = isset($_POST['time3']) && trim($_POST['time3']) != ""? trim($_POST['time3']) : "" ;

$fcData = $RESERVATION->getFacilityDataOne($no);



//예약 사용여부 체크
$useCheck = $RESERVATION->reservationUseCheck($no);
if(!$useCheck) alert('예약 신청 사용중인 시설이 아닙니다.');

//예약 가능 날짜인지 체크
$dateCheck = $RESERVATION->reservationDateCheck($no, $date);
if(!$dateCheck) alert('예약 신청 가능한 날짜가 아닙니다.');


if($fcData[0]['reservation_type'] == 0){
    
    $timeList = explode("|", $time);
    if(count($timeList) == 0) alert('신청 시간이 전달되지 않았습니다.');
    
    //예약 시간 단위가 1시간이라면 이후 30분의 예약 순번값도 포함시킨다.(1시간을 사용한걸로 예약하기 위함)
    if($fcData[0]['reservation_type1_time_unit'] == "1H"){
       
        foreach($timeList as $value){
            array_push($timeList, $value + 1);
        }
        
    }
}else if($fcData[0]['reservation_type'] == 1){
    
    $divisionCheck = $RESERVATION->reservationDivisionCheck($no, $time, $time2, $time3);
    if(!$divisionCheck) alert('잘못된 접근입니다.');
    
    $timeList = array();
    $timeDiv = $time != "" ? explode("|", $time) : array();
    $time2Div = $time2 != "" ? explode("|", $time2) : array();
    $time3Div = $time3 != "" ? explode("|", $time3) : array();
    
    $timeList = array_merge($timeDiv, $time2Div, $time3Div);
    if(count($timeList) == 0) alert('신청 시간이 전달되지 않았습니다.');
    
   
}
$timeList = array_unique($timeList);
sort($timeList);


$reservation_time_seq_list = "/";
foreach($timeList as $seq){
    $timeCheck =  $RESERVATION->reservationTimeCheck($no, $date, $seq);
    if(!$timeCheck) alert('예약 신청 가능한 시간이 아니거나 예약 불가능한 시간이 포함되어 있습니다.');
    $reservation_time_seq_list .= $seq."/";
}


$tableName = $RESERVATION->reservationTable;

//예약 스케줄 체크

//값 설정
$_POST['facode'] = $no;
$_POST['mobile'] = $_POST['mobile1'] && $_POST['mobile2'] && $_POST['mobile3'] ? $_POST['mobile1']."-".$_POST['mobile2']."-".$_POST['mobile3'] : "";
$_POST['phone'] =  $_POST['phone1'] && $_POST['phone2'] && $_POST['phone3'] ? $_POST['phone1']."-".$_POST['phone2']."-".$_POST['phone3'] : "";
$_POST['uid'] = $userID;
$_POST['ip'] = $_SERVER['REMOTE_ADDR'];
$_POST['menucode'] = $menuID;
$_POST['reservation_date'] = $date; 
$_POST['reservation_time_seq_list'] = $reservation_time_seq_list;
$_POST['reservation_time_info'] = $RESERVATION->getDisplayTime($no, $date, $time, $time2, $time3);
$_POST['reservation_fee'] = $RESERVATION->getReservationFee($no, $time, $time2, $time3);

if(isset($_POST['apply_route']) && count($_POST['apply_route']) > 0){
    $_POST['apply_route'] = implode(",", $_POST['apply_route']);
}

$column = $DB->getColumns($tableName, array('indexcode', 'updatetime'));
$column['writetime']['type'] = "now";
$column['upw']['type'] = "password";



$query = $DB->insertSql($column, $_POST, $tableName);
$DB->runQuery($query);


if($DB->affected_rows){
    alert('신청되었습니다.', $backUrl);
}else{
	alert('신청되지 않았습니다.');
}

?>