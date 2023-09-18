<?php
include "../../../../common.php";
include "../../../define.php";
include_once COMMON_PATH . "lib/common.lib.php";

if (count($_POST) == 0)
    alert('잘못된 접근입니다.');

$category = urlencode(trim($_POST['status']));

if ($category != "")
    $backUrl = $_POST['backUrl'] . "&status=" . $category;
else
    $backUrl = $_POST['backUrl'];

header('Location: ' . $backUrl);
?>