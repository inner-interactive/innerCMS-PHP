<?php

function jobDateDisplay($date1 = '', $date2 = '', $num1 = 0)
{
    $txt = '';
    if ($date1 != '' && $date1 != "0000-00-00") {
        $txt = $date1;
    }

    if ($num1 == 1) {
        $txt .= " ~ 채용시 마감";
    } else {

        if ($date2 != '' && $date2 != "0000-00-00") {
            $txt .= " ~ " . $date2;
        }
    }

    return $txt;
}
?>