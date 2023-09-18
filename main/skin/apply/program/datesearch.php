<?php
include "../../../../common.php";
include "../../../define.php";
include_once COMMON_PATH."lib/common.lib.php";

if(count($_POST) == 0) alert('잘못된 접근입니다.');

$start_date = isset($_POST['start_date']) ? trim($_POST['start_date']) : "";
$end_date = isset($_POST['end_date']) ? trim($_POST['end_date']) : "";
$backUrl = isset($_POST['backUrl']) ? urldecode(base64_decode($_POST['backUrl'])) : "";

if($start_date != "" && $end_date != "")
{
// 	if($start_date > $end_date) alert('날짜 선택이 잘못되었습니다.', $backUrl);
}

if($start_date != "") $backUrl .= "&start_date=".$start_date;
if($end_date != "") $backUrl .= "&end_date=".$end_date;

header('Location: '.$backUrl);
?>