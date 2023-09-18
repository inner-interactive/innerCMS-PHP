<?php 
include "../../../../common.php";		// root define
include "../../../define.php";		// sub define
include_once COMMON_PATH."lib/common.lib.php";
include_once COMMON_PATH."lib/db.class.php";
include_once COMMON_PATH."lib/program.class.php";

if(count($_REQUEST) == 0) alert('잘못된 접근입니다.');


if(!$isAdmin) alert('접근 권한이 없습니다.');


$DB = new DB();

$PROGRAM = new Program();
$tableName = $PROGRAM->apply_table;
$no = intval($_GET['no']);
if($no == "" || $no == 0) alert('변경할 데이터값이 없습니다.');
$status = intval($_GET['status']);

$query = "UPDATE ".$tableName." SET status = $status WHERE indexcode = {$no}";
$DB->runQuery($query);

$backUrl = urldecode(base64_decode($_GET['backUrl']));


header('location:'.$backUrl);
exit;


?>