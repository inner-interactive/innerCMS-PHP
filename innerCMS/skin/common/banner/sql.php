<?php
include_once COMMON_PATH."lib/editor.lib.php";

$no = isset($_GET['no']) && trim($_GET['no']) != "" ? intval($_GET['no']) : 0;
$category = isset($_GET['category']) && $_GET['category'] != "" ? trim($_GET['category']) : "";
$type = isset($_GET['type']) && $_GET['type'] != '' ? $_GET['type'] : '';
if($type == ''){
	foreach($bannerConfig as $key => $value){
		$type = $key;
		break;
	}
}


$_GET['banner_type'] = $type;
$where = $DB->whereSql("banner_type");
$orderby = " ORDER BY sort DESC, banner_id DESC";
$limit_num = intval($SKIN->listLimitNum);
if($limit_num <= 0) $limit_num = 10; // 기본 페이지의 게시물 수 10
$pno = isset($_GET['pno']) && intval($_GET['pno']) > 0 ? intval($_GET['pno']) : 1;
$limit_from = ($pno - 1) * $limit_num;
if($limit_from < 0) $limit_from = 0;

$limit = " limit ".$limit_from.", ".$limit_num;

$system['data']['dbData'] = null;
$system['data']['imageData'] = null;

if($mode == "list") {

	$query = "SELECT * FROM ".$tableName.$where.$orderby.$limit;
	$dbData = $DB->getDBData($query);
	$system['data']['dbData'] = $dbData;

	$query = "SELECT count(*) FROM ".$tableName.$where;
	$dbData = $DB->getDBData($query);
	$system['data']['dbDataTotal'] = $dbData[0][0];


	$paging = $SKIN->getPaging($pno, $system['data']['dbDataTotal'], $SKIN->listLimitNum);
	extract($paging);


}else if($mode == "arrange"){
	
	$query = "SELECT * FROM ".$tableName.$where.$orderby;
	$dbData = $DB->getDBData($query);
	$system['data']['dbData'] = $dbData;
	
}else if($mode == "view" || $mode == "update"){
	
	$no = isset($_GET['no']) ? intval($_GET['no']) : 0;
	if($no == 0) alert("잘못된 접근입니다.");
	
	$query = "SELECT * FROM ".$tableName." WHERE banner_id = ".$no;
	$dbData = $DB->getDBData($query);
	
	$type = $dbData[0]['banner_type'];
	
	$system['data']['dbData'] = $dbData[0];
	$system['data']['imageData'] = $SKIN->getFileData($menuID, $no, $type);
	
}


$bannerInfo = $bannerConfig[$type];


