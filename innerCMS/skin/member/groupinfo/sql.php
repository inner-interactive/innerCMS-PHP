<?php
if($mode == "list") {

	$query = "SELECT * FROM ".GROUP_TABLE." ORDER BY authlevel DESC";
	$dbData = $DB->getDBData($query);
	$system['data']['dbData'] = $dbData;
	
}else if($mode == "update"){
	
	$no = isset($_GET['no']) ? intval($_GET['no']) : 0;
	if($no == 0) alert("잘못된 접근입니다.");
	
	$query = "SELECT * FROM ".GROUP_TABLE." WHERE indexcode = ".$no;
	$dbData = $DB->getDBData($query);
	$system['data']['dbData'] = $dbData[0];
	
}else if($mode == "write"){
	
    $system['data']['dbData'] = null;
    
}

