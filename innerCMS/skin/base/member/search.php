<?php
include "../../../../common.php";
include "../../../define.php";
include_once COMMON_PATH."lib/common.lib.php";
include_once COMMON_PATH."lib/db.class.php";
include_once COMMON_PATH."lib/menu.class.php";
include_once COMMON_PATH."lib/skin.class.php";
include_once COMMON_PATH."lib/grant.class.php";

if(count($_POST) == 0) alert('잘못된 접근입니다.');

$sv = isset($_POST['sv']) && $_POST['sv'] != "" ? trim($_POST['sv']) : "";
$backUrl = isset($_POST['backUrl']) && $_POST['backUrl'] != "" ? trim($_POST['backUrl']) : "";

$backUrl .= $sv != "" ? "&sv=".$sv : "";

header('location:'.$backUrl);
exit;


?>