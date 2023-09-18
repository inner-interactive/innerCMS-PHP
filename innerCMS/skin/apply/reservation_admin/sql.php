<?php
include_once COMMON_PATH."lib/editor.lib.php";
include_once COMMON_PATH."lib/FcReservation.class.php";


$pno = isset($_GET['pno']) && intval($_GET['pno']) > 0 ? intval($_GET['pno']) : 1;
$category = isset($_GET['category']) && $_GET['category'] != "" ? trim($_GET['category']) : "";
$fmode = isset($_GET['fmode']) && $_GET['fmode'] != "" ? trim($_GET['fmode']) : "facility";     //fmode 값에 따라 폼 입력양식 설정 (facility : 시설 정보 입력 폼, reservation : 예약설정 입력 폼)

$RESERVATION = new FcReservation();

if($mode == "list") {

    $system['data']['dbData'] = $RESERVATION->getFacilityList('list', $pno);
    $system['data']['dbDataTotal'] = $RESERVATION->getFacilityList('total');
    
	$paging = $SKIN->getPaging($pno, $system['data']['dbDataTotal'], $SKIN->listLimitNum);
	extract($paging);


}else if($mode == "view" || $mode == "update"){
	
	$no = isset($_GET['no']) && trim($_GET['no']) != "" ? intval($_GET['no']) : 0;
	if($no == 0) alert("잘못된 접근입니다.");
	
	$dbData = $RESERVATION->getFacilityDataOne($no);
	
	
	$system['data']['dbData'] = $dbData[0];
	$system['data']['thumbData'] = $SKIN->getFileData(0, $no, 'reserv_thumb');	//리스트 섬네일
	$system['data']['picData'] = $SKIN->getFileData(0, $no, 'reserv_pic');		//사진 파일
	$system['data']['files1Data'] = $SKIN->getFileData(0, $no, 'reserv_files1');		//사진 파일
	$system['data']['files2Data'] = $SKIN->getFileData(0, $no, 'reserv_files2');		//사진 파일
	
	
	
}else if($mode == "reservation_list"){
    
    $no = isset($_GET['no']) && trim($_GET['no']) != "" ? intval($_GET['no']) : 0;
    if($no == 0) alert("잘못된 접근입니다.");
    
    $dbData = $RESERVATION->getFacilityDataOne($no);
    $system['data']['dbData'] = $dbData[0];
    
    
    $system['data']['reservationData'] = $RESERVATION->getReservationList($no, 'list', $pno);
    $system['data']['reservationDataTotal'] = $RESERVATION->getReservationList($no, 'total');
    
    $paging = $SKIN->getPaging($pno, $system['data']['reservationDataTotal'], $SKIN->listLimitNum);
    extract($paging);
    
    
}else if($mode == 'reservation_view'){
    $no = isset($_GET['no']) && trim($_GET['no']) != "" ? intval($_GET['no']) : 0;
    $sno = isset($_GET['sno']) && trim($_GET['sno']) != "" ? intval($_GET['sno']) : 0;
    if($no == 0 || $sno == 0) alert("잘못된 접근입니다.");
    
    //예약시설 정보
    $dbData = $RESERVATION->getFacilityDataOne($no);
    $system['data']['dbData'] = $dbData[0];
    
    //예약자 정보
    $dbData = $RESERVATION->getReservationDataOne($sno);
    $system['data']['reservationData'] = $dbData[0];
}



if($mode == "write"){
    $system['data']['dbData'] = 
    $system['data']['thumbData'] =  
    $system['data']['picData'] = 
    $system['data']['files1Data'] = 
    $system['data']['files2Data']= null;
}


