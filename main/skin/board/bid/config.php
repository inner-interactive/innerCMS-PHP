<?php
$statusList = array(
    "예정",
    "진행",
    "마감"
);

function getStatusIcon($date1 = '', $date2 = '', $end = false)
{
    global $statusList;
    $html = "";

    if ($end) {
        $class = "st_end";
        $status = $statusList[2];
    } else {

        if ($date1 < TIME_YMD && $date2 < TIME_YMD) { // 마감
            $class = "st_end";
            $status = $statusList[2];
        } else if ($date1 <= TIME_YMD && $date2 >= TIME_YMD) { // 진행
            $class = "st_ing";
            $status = $statusList[1];
        } else if ($date1 > TIME_YMD && $date2 > TIME_YMD) { // 예정
            $class = "st_acc";
            $status = $statusList[0];
        }
    }

    if ($class != "")
        $html = "<span class=\"{$class}\">{$status}</span>";

    return $html;
}

?>