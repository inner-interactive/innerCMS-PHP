<?php	
include "../../../../common.php";		// root define
include "../../../define.php";		// sub define
include_once COMMON_PATH."lib/common.lib.php";
include_once COMMON_PATH."lib/db.class.php";

if(count($_REQUEST) == 0) alert('잘못된 접근입니다.');

if(!$isAdmin) alert('접근 권한이 없습니다.');

$DB = new DB();
$tableName = GROUP_TABLE;
$no = intval($_GET['no']);
if($no == 0) alert('잘못된 접근입니다.');

$query = "DELETE FROM ".$tableName." WHERE indexcode = ".$no;
$DB->runQuery($query);

$backUrl = html_entity_decode($_GET['backUrl']);

header('location:'.$backUrl);
exit; 


?>