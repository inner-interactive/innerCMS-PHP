<?php
include "complain.class.php";
$defaultSiteKey = "main";

$siteKey = isset($_GET['site']) ? trim($_GET['site']) : $defaultSiteKey;
$CP = new Complain();

$orderby = " ORDER BY writetime DESC, indexcode DESC";
$limit_num = intval($SKIN->listLimitNum);
if($limit_num <= 0) $limit_num = 10; // 기본 페이지의 게시물 수 10

$pno = isset($_GET['pno']) && intval($_GET['pno']) > 0 ? intval($_GET['pno']) : 1;

if($mode == "list") {
	$order = isset($_GET['order']) && $_GET['order'] != "" ? trim($_GET['order']) : "menu";
	$orderList = array('menu' => "메뉴", "total" => "전체 의견", "today" => "오늘 의견");
}else if($mode == "complain_list") {
    
    $system['data']['dbDataTotal'] = $CP->getComplainTotal(0);
    $system['html']['complainData'] = $CP->getComplainList($pno);
    
    $paging = $SKIN->getPaging($pno, $system['data']['dbDataTotal'], $SKIN->listLimitNum);
    extract($paging);
    
}else if($mode == "view") {
	$no = (isset($_GET['no']) && $_GET['no'] != "") ? trim($_GET['no']) : "";
	if($no == "") alert('메뉴값이 없습니다.');
	
	
	$system['data']['dbDataTotal'] = $CP->getComplainTotal($no);
	$system['html']['complainData'] = $CP->getComplainInfo($no, $pno);
	
	$paging = $SKIN->getPaging($pno, $system['data']['dbDataTotal'], $SKIN->listLimitNum);
	extract($paging);
	
}
?>