<?php 

function getTotalWeek( $date ){
	$total_week = 0;
	$tmp_date = explode("-",$date);
	$year = $tmp_date[0];
	$month = $tmp_date[1]; 
	
	$start_day = $year."-".$month."-01";
	$nod = date("t", strtotime($start_day)); // 총일수 구하기
	$end_day = $year."-".$month."-".$nod;
	
	$start_day_weeknum = date("w", strtotime($start_day));
	$end_day_weeknum = date("w", strtotime($end_day));
	$start_date = date("Y-m-d", strtotime($start_day)-(60 * 60 * 24 * $start_day_weeknum));
	$end_date = date("Y-m-d", strtotime($end_day)+(60 * 60 * 24 * (6 - $end_day_weeknum)));
	
	$total_week = ceil(($nod + $start_day_weeknum) / 7) -1;
	return $total_week;
}

function digits($num)
{
    if(intval($num) < 10)
        return "0".str_replace("0","",$num);
        else
            return $num;
}


?>