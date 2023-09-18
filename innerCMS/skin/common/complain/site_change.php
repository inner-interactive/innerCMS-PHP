<?php 
include "../../../../common.php";		// root define
include "../../../define.php";		// sub define
include_once COMMON_PATH."lib/common.lib.php";

$backUrl = html_entity_decode($_POST['backUrl']);
$site = $_POST['site'];
if($site == "") alert('사이트 정보가 없습니다.');

$backUrl .= "&site=".$site;

header('location:'.$backUrl);

?>