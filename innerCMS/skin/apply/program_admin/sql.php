<?php
include_once COMMON_PATH."lib/editor.lib.php";
include_once COMMON_PATH."lib/program.class.php";

$_GET['delflag'] = 0;
$where = $DB->whereSql("!delflag|%subject|%memo");
$orderby = " ORDER BY writetime DESC, indexcode DESC";
$limit_num = intval($SKIN->listLimitNum);
if($limit_num <= 0) $limit_num = 10; // 기본 페이지의 게시물 수 10

$pno = isset($_GET['pno']) && intval($_GET['pno']) > 0 ? intval($_GET['pno']) : 1;
$limit_from = ($pno - 1) * $limit_num;
if($limit_from < 0) $limit_from = 0;

$limit = " limit ".$limit_from.", ".$limit_num;

$no = isset($_GET['no']) && trim($_GET['no']) != "" ? intval($_GET['no']) : 0;
$category = isset($_GET['category']) && $_GET['category'] != "" ? trim($_GET['category']) : "";

$PROGRAM = new Program();

$query = "SELECT * FROM ".$PROGRAM->config_table;
$dbData  = $DB->getDBData($query);
$menuData = $dbData;

$sno = isset($_GET['sno']) && trim($_GET['sno']) != "" ? intval($_GET['sno']) : 0;
if($sno == 0 && count($menuData) > 0) $sno = $menuData[0]['site_menuid'];

$system['data']['config'] = $PROGRAM->getConfig($sno);
$reservUseCheck = $PROGRAM->reservUseCheck($system['data']['config']);	//신청접수 사용여부

$menuInfo = $MENU->getMenuInfo($sno);
$_SKIN = new skin($menuInfo);	//현재 sno 값에 해당되는 스킨 정보

$system['data']['menu_title'] = $MENU->makePositionHtml($MENU->getPositionArray(intval($sno)), true);

if($_SKIN->categoryUse){
	$categoryData = $_SKIN->categoryList;
}else{
    $categoryData = null;
}

if($mode == "setting") {
	
	
	
} else if($mode == "list") {

    $where .= " AND site_menuid = ".$sno;
    $query = "SELECT * FROM ".$PROGRAM->list_table.$where.$orderby.$limit;
	$dbData = $DB->getDBData($query);
	$system['data']['dbData'] = $dbData;

	$query = "SELECT count(*) FROM ".$PROGRAM->list_table.$where;
	$dbData = $DB->getDBData($query);
	$system['data']['dbDataTotal'] = $dbData[0][0];


	$paging = $SKIN->getPaging($pno, $system['data']['dbDataTotal'], $SKIN->listLimitNum);
	extract($paging);


}else if($mode == "view" || $mode == "update"){
	
	$no = isset($_GET['no']) ? intval($_GET['no']) : 0;
	if($no == 0) alert("잘못된 접근입니다.");
	
	
	
	$query = "SELECT * FROM ".$PROGRAM->list_table." WHERE indexcode = ".$no;
	$dbData = $DB->getDBData($query);
	
	$system['data']['config'] = $PROGRAM->getConfig($sno);
	
	
	$system['data']['dbData'] = $dbData[0];
	$system['data']['thumbData'] = $SKIN->getFileData($sno, $no, 'thumb');	//리스트 섬네일
	$system['data']['picData'] = $SKIN->getFileData($sno, $no, 'pic');		//사진 파일
	$system['data']['files1Data'] = $SKIN->getFileData($sno, $no, 'files1');		//사진 파일
	$system['data']['files2Data'] = $SKIN->getFileData($sno, $no, 'files2');		//사진 파일
	
	
	$view = isset($_GET['view']) && trim($_GET['view']) != "" ? trim($_GET['view']) : 'edu';
	if($mode == "view" && $view == 'enroll'){
		$query = "SELECT * FROM ".$PROGRAM->apply_table." WHERE programcode = ".$no	;
		$applyData = $DB->getDBData($query);
		$system['data']['applyData'] = $applyData;
	}
	
}



if($mode == "write"){
    $system['data']['dbData'] = 
    $system['data']['thumbData'] =  
    $system['data']['picData'] = 
    $system['data']['files1Data'] = 
    $system['data']['files2Data']= null;
}


