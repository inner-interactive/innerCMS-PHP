<?php	
include "../../../../common.php";		// root define
include "../../../define.php";		// sub define
include_once COMMON_PATH."lib/common.lib.php";
include_once COMMON_PATH."lib/db.class.php";
include_once COMMON_PATH."lib/menu.class.php";
include_once "complain.class.php";
if(count($_REQUEST) == 0) alert('잘못된 접근입니다.');

if(!$isAdmin) alert('접근 권한이 없습니다.');

$no = isset($_REQUEST['no']) ? intval($_REQUEST['no']) : 0;
if($no == 0) alert('잘못된 접근입니다.');

$CP = new Complain();
$CP->delete($no);

$backUrl = urldecode($_REQUEST['backUrl']);
header('location:'.$backUrl);


?>