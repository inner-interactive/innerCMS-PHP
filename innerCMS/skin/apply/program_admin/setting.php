<?php	
include "../../../../common.php";		// root define
include "../../../define.php";		// sub define
include_once COMMON_PATH."lib/common.lib.php";
include_once COMMON_PATH."lib/db.class.php";
include_once COMMON_PATH."lib/menu.class.php";
include_once COMMON_PATH."lib/skin.class.php";
include_once COMMON_PATH."lib/grant.class.php";
include_once COMMON_PATH."lib/program.class.php";

if(count($_POST) == 0) alert('잘못된 접근입니다.');

if(!$isAdmin) alert('접근 권한이 없습니다.');

$menuID = isset($_POST['menu']) ? intval($_POST['menu']) : 0;
if($menuID == 0) alert('잘못된 접근입니다.');


$DB = new DB();
$MENU = new Menu($DB);


$PROGRAM = new Program();
$tableName = $PROGRAM->config_table;

$site_menuid = intval($_POST['site_menuid']);

$query = "SELECT indexcode FROM ".$tableName." WHERE site_menuid = ".$site_menuid;
$dbData = $DB->getDBData($query);
$indexcode = count($dbData) > 0 ? intval($dbData[0]['indexcode']) : 0;

//기본 값 설정
$_POST['uid'] = $userID;
$_POST['uname'] = $userName;
$_POST['ip'] = $_SERVER['REMOTE_ADDR'];

if(!isset($_POST['reserv_check'])) $_POST['reserv_check'] = 0;
if(!isset($_POST['finish_check_type'])) $_POST['finish_check_type'] = 0;

   
//항목명 사용여부가 체크되지 않을경우 항목명이 있으면 사용, 항목명이 없으면 미사용으로 처리함.
$program_field_use = $apply_field_use = array();
for($i = 0; $i < 10; $i++){
    $program_field_use[$i] = 0;
    if(!isset($_POST['program_field_use'][$i])){
        $program_field_use[$i] = $_POST['program_field_name'][$i] == "" ? 0 : 1;
    }else{
        $program_field_use[$i] = $_POST['program_field_use'][$i];
    }
    
    $apply_field_use[$i] = 0;
    if(!isset($_POST['apply_field_use'][$i])){
        $apply_field_use[$i] = $_POST['apply_field_name'][$i] == "" ? 0 : 1;
    }else{
        $apply_field_use[$i] = $_POST['apply_field_use'][$i];
    }
    
	
}

$_POST['program_field_name'] = implode("|", $_POST['program_field_name']);
$_POST['apply_field_name'] = implode("|", $_POST['apply_field_name']);
$_POST['program_field_use'] = implode("|", $program_field_use);
$_POST['apply_field_use'] = implode("|", $apply_field_use);



if($indexcode > 0){	//update
	$column = $DB->getColumns($tableName, array('indexcode', 'admin_menuid', 'writetime'));
	$column['updatetime']['type'] = "now";
	$_POST['indexcode'] = $indexcode;
	$query = $DB->updateSql($column, $_POST, $tableName);
	
	
}else{	//insert
	$column = $DB->getColumns($tableName, array('indexcode', 'updatetime'));
	$column['writetime']['type'] = "now";
	$query = $DB->insertSql($column, $_POST, $tableName);
}



$DB->runQuery($query);
$backUrl = urldecode($_POST['backUrl']);

header('location:'.$backUrl);
exit;


?>