<?php
include "../../../../common.php";		// root define
include "../../../define.php";		// sub define
include_once COMMON_PATH."lib/common.lib.php";
include_once COMMON_PATH."lib/db.class.php";

$no = isset($_POST['no']) ? intval($_POST['no']) : 0;
$action = isset($_POST['action']) ? trim($_POST['action']) : "";
$value = isset($_POST['value']) ? trim($_POST['value']) : "";
$num = isset($_POST['num']) ? trim($_POST['num']) : "";

if(!$no || $action == "" || $value == "") exit;

$DB = new DB();


switch ($action){
    
    case 'menu_title' :
    $query = "UPDATE ".MENU_TABLE." SET menu_title = '".$value."' WHERE menu_id = ".$no;
    $DB->runQuery($query);
    break;
    
    case 'skin_change' :
    $_skin = explode("/", $value);
    $group = $_skin[0];
    $name = $_skin[1];
    $query = "UPDATE ".MENU_TABLE." SET skin_group = '".$group."', skin = '".$name."' WHERE menu_id = ".$no;
    $DB->runQuery($query);
    break;
    
    case 'body_change' :
    $query = "UPDATE ".MENU_TABLE." SET bodyfile = '".$value."' WHERE menu_id = ".$no;
    $DB->runQuery($query);
    break;
    
    case 'target_change' :
    $query = "UPDATE ".MENU_TABLE." SET target = '".$value."' WHERE menu_id = ".$no;
    $DB->runQuery($query);
    break;
    
    case 'menu_hide' :
    $query = "UPDATE ".MENU_TABLE." SET menu_hide{$num} = ".$value." WHERE menu_id = ".$no;
    $DB->runQuery($query);
    break;
    
    default :
    break;
}



?>
