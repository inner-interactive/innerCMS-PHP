<?php 
include "../common.php";		
include "define.php";	
include_once COMMON_PATH."lib/common.lib.php";
include_once COMMON_PATH."lib/db.class.php";

if(count($_REQUEST) == 0) alert('잘못된 접근입니다.');

$action = trim($_GET['action']);
$backUrl = isset($_GET['backUrl']) ? html_entity_decode($_GET['backUrl']) : "";


if($action == "logout"){
    session_destroy();
    setcookie(md5('cs_userid'), '', 0,"/");
    setcookie(md5('cs_auto'), '', 0,"/");
    
    if($backUrl != "")
    	$backUrl = urldecode($backUrl);
	else
    	$backUrl = "./";
	
    header('location:'.$backUrl);
    
}else{
    
    $DB = new DB();
    $query = "SELECT menu_id FROM ".MENU_TABLE." WHERE site = '".SITE_NAME."' AND route = '{$action}'";
    $dbData = $DB->getDBData($query);
    $menu_id = intval($dbData[0]['menu_id']);
    

	if($backUrl != "")
		$backUrl = "&backUrl=".urlencode($backUrl);
	else 
		$backUrl = "";
    
    if($menu_id > 0){
        header('location:./?menu='.$menu_id.$backUrl);
    }else{
        header('location:./');
    }
    
}


