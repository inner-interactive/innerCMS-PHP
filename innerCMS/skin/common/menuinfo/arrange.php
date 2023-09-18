<?php	
include "../../../../common.php";		// root define
include "../../../define.php";		// sub define
include_once COMMON_PATH."lib/common.lib.php";
include_once COMMON_PATH."lib/db.class.php";
include_once COMMON_PATH."lib/menu.class.php";
include_once "menuinfo.class.php";

if(count($_POST) == 0) alert('잘못된 접근입니다.');

if(!$isAdmin) alert('접근 권한이 없습니다.');


$MENUINFO = new MenuInfo();
$MENUINFO->menuArrange($_POST);

$backUrl = html_entity_decode($_POST['backUrl']);

header('location:'.$backUrl);
exit; 


?>