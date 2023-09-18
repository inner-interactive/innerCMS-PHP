<?php
ini_set("memory_limit" , -1);
$visit_type_array = array(
		"list" => "접속자",
		"domain" => "도메인",
		"browser" => "브라우저",
		"os" => "운영체제",
		"device" => "접속기기",
		"hour" => "시간",
		"week" => "요일",
		"date" => "일",
		"month" => "월",
		"year" => "년"
);
$siteKey = isset($_GET['site']) ? trim($_GET['site']) : 'main';
$type = isset($system['data']['menu']['route']) && trim($system['data']['menu']['route']) != "" ? trim($system['data']['menu']['route']) : "visitor";
$view = isset($_GET['view']) && trim($_GET['view']) != "" ? trim($_GET['view']) : "graph";

$fr_date = isset($_GET['fr_date']) ? $_GET['fr_date'] : isset($_SESSION['fr_date']) ? $_SESSION['fr_date'] : date("Y-m-d", strtotime("-1 month"));
$to_date = isset($_GET['to_date']) ? $_GET['to_date'] : isset($_SESSION['to_date']) ? $_SESSION['to_date'] : "";
if (empty($fr_date) || ! preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $fr_date) ) $fr_date = TIME_YMD; 
if (empty($to_date) || ! preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $to_date) ) $to_date = TIME_YMD;



/** 접속 기간 통계 텍스트  */
$fr_year = substr($fr_date,0,4);
$fr_month = substr($fr_date, 5, 2);
$fr_day = substr($fr_date, 8, 2);
$to_year = substr($to_date,0,4);
$to_month = substr($to_date, 5, 2);
$to_day = substr($to_date, 8, 2);

$fr_year_txt = $fr_year."년 ";
$fr_month_txt = (int)$fr_month."월 ";
$fr_day_txt = (int)$fr_day."일";
$to_year_txt = $to_year."년 ";
$to_month_txt = (int)$to_month."월 ";
$to_day_txt = (int)$to_day."일";


if($fr_year == $to_year) $to_year_txt = "";
if($fr_year == $to_year && $fr_month == $to_month) $to_month_txt = "";

$searchTermText = $fr_year_txt.$fr_month_txt.$fr_day_txt."부터 ".$to_year_txt.$to_month_txt.$to_day_txt."까지의 접속통계입니다.";
if($fr_date == $to_date) $searchTermText = $fr_year_txt.$fr_month_txt.$fr_day_txt."의 접속통계입니다.";

$where = " WHERE site = '{$siteKey}' AND vi_date BETWEEN '{$fr_date}' AND '{$to_date}'";
$where2 = " WHERE site = '{$siteKey}' AND vs_date BETWEEN '{$fr_date}' AND '{$to_date}'";
$orderby = " ORDER BY vi_id DESC";

$searchDayList = array(
		array(
			'title' => '1일전',
			'fr_date' =>  date("Y-m-d", strtotime("-1 day")),
			'to_date' => TIME_YMD
		),
		array(
			'title' => '7일전',
			'fr_date' =>  date("Y-m-d", strtotime("-7 day")),
			'to_date' => TIME_YMD
		),
		array(
			'title' => '15일전',
			'fr_date' =>  date("Y-m-d", strtotime("-15 day")),
			'to_date' => TIME_YMD
		),
		array(
			'title' => '1개월전',
			'fr_date' =>  date("Y-m-d", strtotime("-1 month")),
			'to_date' => TIME_YMD
		),
		array(
			'title' => '3개월전',
			'fr_date' =>  date("Y-m-d", strtotime("-3 month")),
			'to_date' => TIME_YMD
		),
		array(
			'title' => '6개월전',
			'fr_date' =>  date("Y-m-d", strtotime("-6 month")),
			'to_date' => TIME_YMD
		),
		array(
			'title' => '1년전',
			'fr_date' =>  date("Y-m-d", strtotime("-1 year")),
			'to_date' => TIME_YMD
		),
);



$sum_count = 0;
$data = $arr = array();
switch ($type)
{
	
	//접속자
	case "visitor" :
		$domain = isset($_GET['domain']) ? trim($_GET['domain']) : "";
		if($domain){
			$where .= " AND vi_referer LIKE '%{$domain}%'";
		}
		
		$limit_num = intval($SKIN->listLimitNum);
		if($limit_num <= 0) $limit_num = 10; // 기본 페이지의 게시물 수 10
		
		$pno = isset($_GET['pno']) && intval($_GET['pno']) > 0 ? intval($_GET['pno']) : 1;
		$limit_from = ($pno - 1) * $limit_num;
		if($limit_from < 0) $limit_from = 0;
		
		$limit = " limit ".$limit_from.", ".$limit_num;
		
		$no = isset($_GET['no']) && trim($_GET['no']) != "" ? intval($_GET['no']) : 0;
		$category = isset($_GET['category']) && $_GET['category'] != "" ? trim($_GET['category']) : "";
		
		
		$query = "SELECT * FROM ".VISIT_TABLE.$where.$orderby.$limit;
		$dbData = $DB->getDBData($query);
		$system['data']['dbData'] = $dbData;
		
		$query = "SELECT count(*) FROM ".VISIT_TABLE.$where;
		$dbData = $DB->getDBData($query);
		$system['data']['dbDataTotal'] = $sum_count = $dbData[0][0];
		
		
		$paging = $SKIN->getPaging($pno, $system['data']['dbDataTotal'], $SKIN->listLimitNum);
		extract($paging);
		break;
		
		
	//도메인
	case "domain" :
		
		$query = "SELECT * FROM ".VISIT_TABLE.$where.$orderby;
		$dbData = $DB->getDBData($query);
		
		for($i = 0; $i < count($dbData); $i++){
			$str = $dbData[$i]['vi_referer'];
			preg_match("/^http[s]*:\/\/([\.\-\_0-9a-zA-Z]*)\//", $str, $match);
			$s = isset($match[1]) ? $match[1] : '';
			$s = $s != null ? preg_replace("/^(www\.|search\.|dirsearch\.|dir\.search\.|dir\.|kr\.search\.|myhome\.)(.*)/", "\\2", $s) : null;
			
			if(!isset($arr[$s])) $arr[$s] = 0;
			$arr[$s]++;
			
		}
		$sum_count = count($dbData);
		
		if(count($arr)){
			arsort($arr);
			$data = array();
			$labels = $datas = $rates = "";
			$save_count = -1;
			$i = 0;
			foreach($arr as $key => $value){
				$_arr = array();
				$_arr['name'] = $key == '' ? '직접' : $key;
				$_arr['count'] = $value;
				$rate = number_format(($value / $sum_count * 100), 1);
				$_arr['rate'] = $rate;
				
			
				$labels .= "'".$_arr['name']."'".",";
				$datas .= $value.",";
				$rates .= $rate.",";
				
				if ($save_count != $value) {
					$i++;
					$no = $i;
					$save_count = $value;
				} else {
					$no = '';
				}
				$_arr['no'] = $no;
				$data[] = $_arr;
			}
			
			
		}
		
		$vh = count($data) < 10 ? 30 : count($data) * 3;
		break;
	
	
	//브라우저
	case "browser" :
		
		$query = "SELECT * FROM ".VISIT_TABLE.$where.$orderby;
		$dbData = $DB->getDBData($query);
		for($i = 0; $i < count($dbData); $i++){
			$s = $dbData[$i]['vi_browser'];
			if(!$s)
				$s = get_brow($dbData[$i]['vi_agent']);
			
			if(!isset($arr[$s])) $arr[$s] = 0;
			$arr[$s]++;
	
	
		}
		
		$sum_count = count($dbData);
		
		if(count($arr)){
			arsort($arr);
			$data = array();
			$labels = $datas = $rates = "";
			$save_count = -1;
			$i = 0;
			foreach($arr as $key => $value){
				$_arr = array();
				$_arr['name'] = $key == '' ? '' : $key;
				$_arr['count'] = $value;
				$rate = number_format(($value / $sum_count * 100), 1);
				$_arr['rate'] = $rate;
		
					
				$labels .= "'".$_arr['name']."'".",";
				$datas .= $value.",";
				$rates .= $rate.",";
		
				if ($save_count != $value) {
					$i++;
					$no = $i;
					$save_count = $value;
				} else {
					$no = '';
				}
				$_arr['no'] = $no;
				$data[] = $_arr;
			}
				
				
		}
		$vh = count($data) < 10 ? 30 : count($data) * 3;
		break;
	
	
	//운영체제
	case "os" :
		$query = "SELECT * FROM ".VISIT_TABLE.$where.$orderby;
		$dbData = $DB->getDBData($query);
		for($i = 0; $i < count($dbData); $i++){
			$s = $dbData[$i]['vi_os'];
			if(!$s)
				$s = get_os($dbData[$i]['vi_agent']);
			
			if(!isset($arr[$s])) $arr[$s] = 0;
			$arr[$s]++;
	
	
		}
		
		$sum_count = count($dbData);
		
		if(count($arr)){
			arsort($arr);
			$data = array();
			$labels = $datas = $rates = "";
			$save_count = -1;
			$i = 0;
			foreach($arr as $key => $value){
				$_arr = array();
				$_arr['name'] = $key == '' ? 'Unknown' : $key;
				$_arr['count'] = $value;
				$rate = number_format(($value / $sum_count * 100), 1);
				$_arr['rate'] = $rate;
		
					
				$labels .= "'".$_arr['name']."'".",";
				$datas .= $value.",";
				$rates .= $rate.",";
		
				if ($save_count != $value) {
					$i++;
					$no = $i;
					$save_count = $value;
				} else {
					$no = '';
				}
				$_arr['no'] = $no;
				$data[] = $_arr;
			}
		
		
		}
		$vh = 50;
		break;
	
	
	//접속기기
	case "device" :
		
		$query = "SELECT * FROM ".VISIT_TABLE.$where.$orderby;
		$dbData = $DB->getDBData($query);
		for($i = 0; $i < count($dbData); $i++){
			$s = $dbData[$i]['vi_device'];
			if(!$s)
				$s = '기타';
			
			if(!isset($arr[$s])) $arr[$s] = 0;
			$arr[$s]++;
	
	
		}
		
		$sum_count = count($dbData);
		
		if(count($arr)){
			arsort($arr);
			$data = array();
			$labels = $datas = $rates = "";
			$save_count = -1;
			$i = 0;
			foreach($arr as $key => $value){
				$_arr = array();
				$_arr['name'] = $key == '' ? 'Unknown' : $key;
				$_arr['count'] = $value;
				$rate = number_format(($value / $sum_count * 100), 1);
				$_arr['rate'] = $rate;
		
					
				$labels .= "'".$_arr['name']."'".",";
				$datas .= $value.",";
				$rates .= $rate.",";
		
				if ($save_count != $value) {
					$i++;
					$no = $i;
					$save_count = $value;
				} else {
					$no = '';
				}
				$_arr['no'] = $no;
				$data[] = $_arr;
			}
		
		
		}
		$vh = 50;
		
		break;
	
	//시간
	case "hour" :
		
		$query = " SELECT SUBSTRING(vi_time,1,2) AS vi_hour, count(vi_id) AS cnt FROM ".VISIT_TABLE.$where."GROUP BY vi_hour ORDER BY vi_hour"; 
		$dbData = $DB->getDBData($query);
		
		for($i = 0; $i < count($dbData); $i++){
			
			$arr[$dbData[$i]['vi_hour']] = $dbData[$i]['cnt'];
			$sum_count += $dbData[$i]['cnt'];
			
		}
		
		if(count($arr)){
			$data = array();
			$labels = $datas = $rates = "";
			foreach($arr as $key => $value){
				$_arr = array();
				$_arr['name'] = $key == '' ? '' : sprintf("%02d", $key);
				$_arr['count'] = $value;
				$rate = number_format(($value / $sum_count * 100), 1);
				$_arr['rate'] = $rate;
		
				$labels .= "'".$_arr['name']."'".",";
				$datas .= $value.",";
				$rates .= $rate.",";
		
				$data[] = $_arr;
			}
		
		
		}
		$vh = 50;
		break;
	
	
	//요일
	case "week" :
		
		$weekday = array ('월', '화', '수', '목', '금', '토', '일');
		$query = " SELECT WEEKDAY(vs_date) AS weekday_date, SUM(vs_count) AS cnt FROM ".VISIT_SUM_TABLE.$where2."GROUP BY weekday_date ORDER BY weekday_date"; 
		$dbData = $DB->getDBData($query);
		
		for($i = 0; $i < count($dbData); $i++){
				
			$arr[$dbData[$i]['weekday_date']] = $dbData[$i]['cnt'];
			$sum_count += $dbData[$i]['cnt'];
				
		}
		
		if(count($arr)){
			$data = array();
			$labels = $datas = $rates = "";
			foreach($arr as $key => $value){
				$_arr = array();
				$_arr['name'] = $weekday[$key];
				$_arr['count'] = $value;
				$rate = number_format(($value / $sum_count * 100), 1);
				$_arr['rate'] = $rate;
		
				$labels .= "'".$_arr['name']."'".",";
				$datas .= $value.",";
				$rates .= $rate.",";
		
				$data[] = $_arr;
			}
		
		
		}
		$vh = 50;
	
		
		break;
	
	
	//일
	case "date" :
	    $query = " SELECT vs_date, vs_count AS cnt FROM ".VISIT_SUM_TABLE.$where2."GROUP BY vs_date ORDER BY vs_date";
		$dbData = $DB->getDBData($query);
		
		for($i = 0; $i < count($dbData); $i++){
		
			$arr[$dbData[$i]['vs_date']] = $dbData[$i]['cnt'];
			$sum_count += $dbData[$i]['cnt'];
		}
		
		if(count($arr)){
			$data = array();
			$labels = $datas = $rates = "";
			foreach($arr as $key => $value){
				$_arr = array();
				$_arr['name'] = $key;
				$_arr['count'] = $value;
				$rate = number_format(($value / $sum_count * 100), 1);
				$_arr['rate'] = $rate;
		
				$labels .= "'".$_arr['name']."'".",";
				$datas .= $value.",";
				$rates .= $rate.",";
		
				$data[] = $_arr;
			}
		
		
		}
		$vh = count($data) < 10 ? 30 : count($data) * 3;
		break;
	
	
	//월
	case "month" :
		
	    $query = " SELECT SUBSTRING(vs_date,1,7) AS vs_month, SUM(vs_count) AS cnt FROM ".VISIT_SUM_TABLE.$where2."GROUP BY vs_month ORDER BY vs_month DESC";
		$dbData = $DB->getDBData($query);
		
		for($i = 0; $i < count($dbData); $i++){
		
			$arr[$dbData[$i]['vs_month']] = $dbData[$i]['cnt'];
			$sum_count += $dbData[$i]['cnt'];
			
		}
		
		if(count($arr)){
			$data = array();
			$labels = $datas = $rates = "";
			foreach($arr as $key => $value){
				$_arr = array();
				$_arr['name'] = $key;
				$_arr['count'] = $value;
				$rate = number_format(($value / $sum_count * 100), 1);
				$_arr['rate'] = $rate;
		
				$labels .= "'".$_arr['name']."'".",";
				$datas .= $value.",";
				$rates .= $rate.",";
		
				$data[] = $_arr;
			}
		
		
		}
		$vh = count($data) < 10 ? 30 : count($data) * 3;
		break;
	
	
	//년
	case "year" :
		
	    $query = " SELECT SUBSTRING(vs_date,1,4) AS vs_year, SUM(vs_count) AS cnt FROM ".VISIT_SUM_TABLE.$where2."GROUP BY vs_year ORDER BY vs_year DESC";
		$dbData = $DB->getDBData($query);
		
		for($i = 0; $i < count($dbData); $i++){
			
			$arr[$dbData[$i]['vs_year']] = $dbData[$i]['cnt'];
			$sum_count += $dbData[$i]['cnt'];
			
		}
		
		if(count($arr)){
			$data = array();
			$labels = $datas = $rates = "";
			foreach($arr as $key => $value){
				$_arr = array();
				$_arr['name'] = $key;
				$_arr['count'] = $value;
				$rate = number_format(($value / $sum_count * 100), 1);
				$_arr['rate'] = $rate;
		
				$labels .= "'".$_arr['name']."'".",";
				$datas .= $value.",";
				$rates .= $rate.",";
		
				$data[] = $_arr;
			}
		
		
		}
		$vh = count($data) < 10 ? 30 : count($data) * 3;
		
		break;
	
}



