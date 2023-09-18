<?php	
include "../../../../common.php";		// root define
include "../../../define.php";		// sub define
include_once COMMON_PATH."lib/common.lib.php";
include_once COMMON_PATH."lib/db.class.php";
include_once COMMON_PATH."lib/menu.class.php";
include_once COMMON_PATH."lib/skin.class.php";

if(count($_POST) == 0) alert('잘못된 접근입니다.');

if(!$isAdmin) alert('접근 권한이 없습니다.');
//필수 입력 체크


$menuID = isset($_POST['menu']) ? intval($_POST['menu']) : 0;
if($menuID == 0) alert('잘못된 접근입니다.');

$DB = new DB();
$MENU = new Menu($DB);
$menuInfo = $MENU->getMenuInfo($menuID);
$SKIN = new skin($menuInfo);


//스킨폴더내에 config.php 파일이 있으면 include한다.
$_config_file = $SKIN->skin_path."config.php";
if(file_exists($_config_file)) include $_config_file;

$spam = trim($_POST['spam']);
$saveTxt = str_replace("{spam}", $spam, $saveTxt);


$saveFile = COMMON_PATH."conf/spam.php";


$fp = fopen($saveFile, 'w');
fwrite($fp, $saveTxt);
fclose($fp);



$backUrl = html_entity_decode($_POST['backUrl']);
header('location:'.$backUrl);
exit;


?>