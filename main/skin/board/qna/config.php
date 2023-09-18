<?php
$statusList = array(
    "접수",
    "처리중",
    "처리완료"
);

function getStatusIcon($status = '')
{
    global $statusList;
    $html = "";

    if ($status == $statusList[0]) {
        $class = "st_acc";
    } else if ($status == $statusList[1]) {
        $class = "st_ing";
    } else if ($status == $statusList[2]) {
        $class = "st_end";
    } else {
        $class = "";
    }

    if ($class != "")
        $html = "<span class=\"{$class} wmin43\">{$status}</span>";

    return $html;
}

?>