<?php
include_once COMMON_PATH."lib/editor.lib.php";

$_GET['isblocked'] = 0;
$where = $DB->whereSql("%subject|%memo|!isblocked");
$orderby = " ORDER BY lastlogintime DESC, indexcode DESC";
$limit_num = intval($SKIN->listLimitNum);
if($limit_num <= 0) $limit_num = 10; // 기본 페이지의 게시물 수 10

$pno = isset($_GET['pno']) && intval($_GET['pno']) > 0 ? intval($_GET['pno']) : 1;
$limit_from = ($pno - 1) * $limit_num;
if($limit_from < 0) $limit_from = 0;

$limit = " limit ".$limit_from.", ".$limit_num;

$no = isset($_GET['no']) && trim($_GET['no']) != "" ? intval($_GET['no']) : 0;
$category = isset($_GET['category']) && $_GET['category'] != "" ? trim($_GET['category']) : "";

$query = "SELECT * FROM ".GROUP_TABLE." WHERE authlevel > 0 ORDER BY authlevel DESC";
$groupList = $DB->getDBData($query);

if($mode == "list") {

	$query = "SELECT * FROM ".MEMBER_TABLE.$where.$orderby.$limit;
	$dbData = $DB->getDBData($query);
	$system['data']['dbData'] = $dbData;

	$query = "SELECT count(*) FROM ".MEMBER_TABLE.$where;
	$dbData = $DB->getDBData($query);
	$system['data']['dbDataTotal'] = $dbData[0][0];


	$query = "SELECT menu_id FROM ".MENU_TABLE." WHERE site = '".SITE_NAME."' AND route = 'memberinfo'";
	$dbData = $DB->getDBData($query);
	
	$system['data']['memberinfo_menuid'] = $dbData[0]['menu_id'];
	
	
	$paging = $SKIN->getPaging($pno, $system['data']['dbDataTotal'], $SKIN->listLimitNum);
	extract($paging);


}



if($mode == "write"){
    $system['data']['dbData'] = null;
}


