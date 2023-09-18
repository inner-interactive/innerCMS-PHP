<?php
include "../common.php";
include "define.php";
include_once COMMON_PATH . "lib/common.lib.php";

if (count($_POST) == 0)
    alert('잘못된 접근입니다.');

$upw = base64_encode(trim($_POST['upw']));
$backUrl = html_entity_decode($_POST['backUrl']);
if ($backUrl != "") {
    $url = $backUrl . "&upw=" . $upw;
} else {
    $url = "./?";
}
header("location:" . $url);

