<?php	
if(count($_GET) == 0) die('not permited to access this page directly');

include "../../../../common.php";		// root define
include "../../../define.php";		// sub define
include_once COMMON_PATH."lib/common.lib.php";
include_once COMMON_PATH."lib/db.class.php";
include_once "orginfo.class.php";

if(count($_REQUEST) == 0) alert('잘못된 접근입니다.');

if(!$isAdmin) alert('접근 권한이 없습니다.');

$DB = new DB();
$no = intval($_GET['no']);
if($no == 0) alert('잘못된 접근입니다.');

$orgInfo = new OrgInfo($DB);
$orgInfo->delete($no);


$backUrl = urldecode($_GET['backUrl']);
header('location:'.$backUrl);
exit; 


?>