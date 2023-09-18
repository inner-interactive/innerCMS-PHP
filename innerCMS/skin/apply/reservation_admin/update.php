<?php	
include "../../../../common.php";		// root define
include "../../../define.php";		// sub define
include_once COMMON_PATH."lib/common.lib.php";
include_once COMMON_PATH."lib/db.class.php";
include_once COMMON_PATH."lib/menu.class.php";
include_once COMMON_PATH."lib/skin.class.php";
include_once COMMON_PATH."lib/grant.class.php";
include_once COMMON_PATH."lib/FcReservation.class.php";
include 'config.php';

if(count($_POST) == 0) alert('잘못된 접근입니다.');


if(!$isAdmin) alert('접근 권한이 없습니다.');
//필수 입력 체크

$menuID = isset($_POST['menu']) ? intval($_POST['menu']) : 0;
if($menuID == 0) alert('잘못된 접근입니다.');

$fmode = isset($_POST['fmode']) && $_POST['fmode'] != "" ? trim($_POST['fmode']) : "facility";     //fmode 값에 따라 폼 입력양식 설정 (facility : 시설 정보 입력 폼, reservation : 예약설정 입력 폼)
if($fmode == 'facility'){
    //필수 입력 체크
    $blankList = array("subject|예약 시설명을");
    blankCheck($blankList);
}

//기본 값 설정
$_POST['indexcode'] = intval($_POST['no']);


/* 예약정보관련 */
//모든기간사용
if(isset($_POST['all_day_reservation']) && intval($_POST['all_day_reservation']) == 1){
    $_POST['reservation_start_date'] = $_POST['reservation_end_date'] = "0000-00-00";
}

//특정요일제외
if(isset($_POST['weekday_out']) && count($_POST['weekday_out']) > 0){
    $_POST['weekday_out'] = implode("|", $_POST['weekday_out']);
}else{
    $_POST['weekday_out'] = "";
}


//예약시간 설정(시간대별 예약)
if($_POST['reservation_type1_time_unit'] == '30M'){
    $_POST['reservation_type1_reservation_time'] = isset($_POST['reservation_type1_reservation_time_m']) && count($_POST['reservation_type1_reservation_time_m']) > 0 ? implode("|", $_POST['reservation_type1_reservation_time_m']) : "";
}else if($_POST['reservation_type1_time_unit'] == '1H'){
    $_POST['reservation_type1_reservation_time'] = isset($_POST['reservation_type1_reservation_time_h']) && count($_POST['reservation_type1_reservation_time_h']) > 0 ? implode("|", $_POST['reservation_type1_reservation_time_h']) : "";
}


//예약시간 설정(오전)
if($_POST['reservation_type2_morning_start'] && $_POST['reservation_type2_morning_end'] && $_POST['reservation_type2_morning_start'] != $_POST['reservation_type2_morning_end']){
    $arr = array();
    $start = $_POST['reservation_type2_morning_start'];
    $end = $_POST['reservation_type2_morning_end'];
    for($i = $start; $i <= $end; $i++){
        array_push($arr, $i);
    }
    if(count($arr)){
        $_POST['reservation_type2_morning_time'] = implode("|", $arr);
    }
}else{
    $_POST['reservation_type2_morning_time'] = "";
}


//예약시간 설정(오후)
if($_POST['reservation_type2_afternoon_start'] && $_POST['reservation_type2_afternoon_end'] && $_POST['reservation_type2_afternoon_start'] != $_POST['reservation_type2_afternoon_end']){
    $arr = array();
    $start = $_POST['reservation_type2_afternoon_start'];
    $end = $_POST['reservation_type2_afternoon_end'];
    for($i = $start; $i <= $end; $i++){
        array_push($arr, $i);
    }
    if(count($arr)){
        $_POST['reservation_type2_afternoon_time'] = implode("|", $arr);
    }
}else{
    $_POST['reservation_type2_afternoon_time'] = "";
}

//예약시간 설정(야간)
if($_POST['reservation_type2_night_start'] && $_POST['reservation_type2_night_end'] && $_POST['reservation_type2_night_start'] != $_POST['reservation_type2_night_end']){
    $arr = array();
    $start = $_POST['reservation_type2_night_start'];
    $end = $_POST['reservation_type2_night_end'];
    for($i = $start; $i <= $end; $i++){
        array_push($arr, $i);
    }
    if(count($arr)){
        $_POST['reservation_type2_night_time'] = implode("|", $arr);
    }
}else{
    $_POST['reservation_type2_night_time'] = "";
}


$DB = new DB();
$MENU = new Menu($DB);

$RESERVATION = new FcReservation();
$tableName = $RESERVATION->facilityTable;

$menuInfo = $MENU->getMenuInfo($menuID);
$SKIN = new skin($menuInfo);

$_config_file = $SKIN->skin_path."config.php";
if(file_exists($_config_file)) include $_config_file;


//글쓰기모드 관련 컬럼
$writeColumn = array('indexcode', 'uid', 'upw', 'uname', 'writetime', 'ip');

if($fmode == 'facility'){   //시설정보 업데이트시에는 예약관련 컬럼과 write mode에 관련된 컬럼들을 제외시킨다. 관련없는 컬럼들 초기화 방지
    //$reservationColumn config.php에 선언
    $column = $DB->getColumns($tableName, array_merge($writeColumn, $reservationColumn));
    
}else if($fmode == 'reservation'){  //예약정보 업데이트시에는 예약관련 컬럼만 포함.
    $column = $DB->getColumns($tableName, $reservationColumn, true);
}
$column['updatetime']['type'] = "now";


$query = $DB->updateSql($column, $_POST, $tableName, "indexcode");
$DB->runQuery($query);
$backUrl = html_entity_decode($_POST['backUrl']);

$SKIN->picUpload($_FILES['tfile'], $_POST['indexcode'], 'reserv_thumb', $thumbWidth, $thumbHeight);
$SKIN->fileUpload($_FILES['pfile'], $_POST['indexcode'], 'reserv_pic');
$SKIN->fileUpload($_FILES['sfile'], $_POST['indexcode'], 'reserv_files1');
$SKIN->fileUpload($_FILES['sfile2'], $_POST['indexcode'], 'reserv_files2');

header('location:'.$backUrl);
exit;


?>