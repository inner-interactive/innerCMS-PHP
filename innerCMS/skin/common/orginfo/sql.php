<?php
include_once "orginfo.class.php";
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

$orgInfo = new OrgInfo($DB);



if($mode == "write"){
	if($no == 0) alert('잘못된 접근입니다.');
}