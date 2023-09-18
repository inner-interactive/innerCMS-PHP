<?php
include "../../../../common.php";
include_once COMMON_PATH . "lib/common.lib.php";

if (count($_POST) == 0)
    alert('잘못된 접근입니다.');

$backUrl = isset($_POST['backUrl']) ? $_POST['backUrl'] : "";
$agree_bit1 = isset($_POST['agree_bit1']) ? $_POST['agree_bit1'] : "";
$agree_bit2 = isset($_POST['agree_bit2']) ? $_POST['agree_bit2'] : "";

if ($agree_bit1 != "" && $agree_bit2 != "") {
    $goUrl = $backUrl . "&mode=write";
} else {

    alert('약관에 모두 동의 하셔야 합니다.');
}

header('location: ' . $goUrl);

?>