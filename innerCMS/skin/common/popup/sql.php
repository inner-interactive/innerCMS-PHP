<?php
include_once COMMON_PATH."lib/editor.lib.php";

$where = $DB->whereSql("%subject|%memo");
$orderby = " ORDER BY writetime DESC, pop_id DESC";
$limit_num = intval($SKIN->listLimitNum);
if($limit_num <= 0) $limit_num = 10; // 기본 페이지의 게시물 수 10

$pno = isset($_GET['pno']) && intval($_GET['pno']) > 0 ? intval($_GET['pno']) : 1;
$limit_from = ($pno - 1) * $limit_num;
if($limit_from < 0) $limit_from = 0;

$limit = " limit ".$limit_from.", ".$limit_num;

$no = isset($_GET['no']) && trim($_GET['no']) != "" ? intval($_GET['no']) : 0;
$category = isset($_GET['category']) && $_GET['category'] != "" ? trim($_GET['category']) : "";


if($mode == "list") {

	$query = "SELECT * FROM ".POPUP_TABLE.$where.$orderby.$limit;
	$dbData = $DB->getDBData($query);
	$system['data']['dbData'] = $dbData;

	$query = "SELECT count(*) FROM ".POPUP_TABLE.$where;
	$dbData = $DB->getDBData($query);
	$system['data']['dbDataTotal'] = $dbData[0][0];


	$paging = $SKIN->getPaging($pno, $system['data']['dbDataTotal'], $SKIN->listLimitNum);
	extract($paging);


}else if($mode == "view" || $mode == "update"){
	$no = isset($_GET['no']) ? intval($_GET['no']) : 0;
	if($no == 0) alert("잘못된 접근입니다.");
	
	$query = "SELECT * FROM ".POPUP_TABLE." WHERE pop_id = ".$no;
	$dbData = $DB->getDBData($query);
	$system['data']['dbData'] = $dbData[0];
	
}



if($mode == "write"){
    $system['data']['dbData'] = $SKIN->initColumn(POPUP_TABLE);
}


