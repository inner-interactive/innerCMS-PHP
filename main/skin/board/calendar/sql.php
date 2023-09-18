<?php
include_once COMMON_PATH . "lib/editor.lib.php";
if (! $isAdmin)
    $_GET['delflag'] = 0;
$_GET['iscomment'] = 0;
$where = $DB->whereSql("!delflag|!iscomment|category|%subject|%memo|%uname");
$orderby = " ORDER BY isimportant DESC, writetime DESC, replyrank ASC, replyorder ASC, indexcode DESC";
$limit_num = intval($SKIN->listLimitNum);
if ($limit_num <= 0)
    $limit_num = 10; // 기본 페이지의 게시물 수 10

$pno = isset($_GET['pno']) && intval($_GET['pno']) > 0 ? intval($_GET['pno']) : 1;
$limit_from = ($pno - 1) * $limit_num;
if ($limit_from < 0)
    $limit_from = 0;

$limit = " limit " . $limit_from . ", " . $limit_num;

$no = isset($_GET['no']) && trim($_GET['no']) != "" ? intval($_GET['no']) : 0;
$category = isset($_GET['category']) && $_GET['category'] != "" ? trim($_GET['category']) : "";

if ($mode == "list") {

    $query = "SELECT * FROM " . $SKIN->tableName . $where . $orderby . $limit;
    $dbData = $DB->getDBData($query);
    $system['data']['dbData'] = $dbData;

    $query = "SELECT count(*) FROM " . $SKIN->tableName . $where;
    $dbData = $DB->getDBData($query);
    $system['data']['dbDataTotal'] = $dbData[0][0];

    $paging = $SKIN->getPaging($pno, $system['data']['dbDataTotal'], $SKIN->listLimitNum);
    extract($paging);

    for ($i = 0; $i < count($system['data']['dbData']); $i ++) {

        $query = "SELECT count(*) FROM " . $SKIN->tableName . " WHERE iscomment = 1 AND parentcode = " . $system['data']['dbData'][$i]['indexcode'];
        $_data = $DB->getDBData($query);
        $system['data']['dbData'][$i]['cmtNum'] = intval($_data[0][0]);
    }

    if ($GRANT->grant['auth_admin']) {
        $query = "SELECT menu_id, menu_title FROM " . MENU_TABLE . " WHERE site = '" . SITE_NAME . "' AND menu_type = 'skin' AND db_table != '' ";
        $menuData = $DB->getDBData($query);
        $system['data']['dbTableList'] = $menuData;
    }
} else if ($mode == "calendar") {

    $date = isset($_GET['date']) && $_GET['date'] != "" ? trim($_GET['date']) : date("Y-m-d");
    $date_arr = explode("-", $date);

    $year = $date_arr[0];
    $month = $date_arr[1];
    $day = $date_arr[2];

    // 날짜 설정하기
    $m_start_date = $year . "-" . $month . "-01"; // 월 시작일(매월 1일)
    $days = date("t", strtotime($m_start_date)); // 총일수 구하기
    $m_end_date = $year . "-" . $month . "-" . $days; // 월 마지막 일

    $m_start_date_weeknum = date("w", strtotime($m_start_date)); // 월 시작일 요일 값 구하기
    $m_end_date_weeknum = date("w", strtotime($m_end_date)); // 월 마지막 날 요일 값 구하기
    $start_date = date("Y-m-d", strtotime($m_start_date) - (60 * 60 * 24 * $m_start_date_weeknum)); // 달력 표시상의 첫날
    $end_date = date("Y-m-d", strtotime($m_end_date) + (60 * 60 * 24 * (6 - $m_end_date_weeknum))); // 달력 표시상의 마지막 날
    $total_week = ceil(($days + $m_start_date_weeknum) / 7);

    $pre_date = $month <= 1 ? ($year - 1) . "-12-01" : $year . "-" . str_pad(intval($month - 1), 2, "0", STR_PAD_LEFT) . "-01";
    $next_date = $month >= 12 ? ($year + 1) . "-01-01" : $year . "-" . str_pad(intval($month + 1), 2, "0", STR_PAD_LEFT) . "-01";

    /**
     * ******************************************
     */

    // 날짜를 배열로 집어넣기

    for ($i = 0; $i < $total_week * 7; $i ++) {

        $tmp_day = date("Y-m-d", (strtotime($start_date) + 60 * 60 * 24 * $i));
        $day_info[$tmp_day]['data'] = array();

        $tmp_weeknum = date("w", strtotime($tmp_day));
        if (strtotime($m_end_date) >= strtotime($tmp_day) && strtotime($m_start_date) <= strtotime($tmp_day)) {

            if ($tmp_weeknum == 0) { // 일요일
                $day_info[$tmp_day]["class"] = "sun";
            } else if ($tmp_weeknum == 6) { // 토요일
                $day_info[$tmp_day]["class"] = "sat";
            } else { // 평일
                $day_info[$tmp_day]["class"] = "";
            }
        } else {
            $day_info[$tmp_day]["class"] = "gray";
        }

        if (TIME_YMD == $tmp_day) {
            $day_info[$tmp_day]["isToday"] = "yes";
        } else {
            $day_info[$tmp_day]["isToday"] = "";
        }
    }

    // 일정이 있는 날짜 표시하기
    $query = "SELECT * FROM " . $SKIN->tableName . " $where AND left(date1, 7) <= '" . substr($m_start_date, 0, 7) . "' AND left(date2, 7) >= '" . substr($m_end_date, 0, 7) . "' ORDER BY writetime desc, indexcode desc"; // data
    $dbData = $DB->getDBData($query);

    for ($i = 0; $i < count($dbData); $i ++) {

        $_data = $dbData[$i];

        if ($_data['date1'] != "" && $_data['date2'] != "") {
            $_start_time = strtotime($_data['date1']);
            $_end_time = strtotime($_data['date2']);

            for ($k = $_start_time; $k <= $_end_time; $k = $k + (60 * 60 * 24)) {

                $k_date = date("Y-m-d", $k);
                $k_weekday = date("w", $k);
                $push = true;

                // 반복요일 설정
                if ($_data['f1'] != "") {

                    $repeat_weekday = explode("|", $_data['f1']);

                    if (! in_array($k_weekday, $repeat_weekday)) {
                        $push = false;
                    }
                }

                // 제외날짜 설정
                if ($_data['f2'] != "") {

                    $except_days = explode("|", $_data['f2']);

                    if (in_array($k_date, $except_days)) {
                        $push = false;
                    }
                }

                if ($push) {
                    $_data['thumb'] = $SKIN->getFileData($menuID, $_data['indexcode'], "thumb");
                    if (isset($day_info[$k_date]['data']))
                        array_push($day_info[$k_date]['data'], serialize($_data));
                }
            }
        } else {}
    }
    // print_r($day_info);
} else if ($mode == "view") {

    $query = "UPDATE " . $SKIN->tableName . " SET view = view + 1 WHERE indexcode = " . intval($_GET['no']);
    $DB->runQuery($query);

    $dbData = $SKIN->getBoardData($no);
    $dbData[0]['memo'] = $SKIN->setHmode($dbData[0]['memo'], $dbData[0]['hmode']);
    $system['data']['dbData'] = $dbData;

    $system['data']['fileData'] = $SKIN->getFileData($menuID, $no);

    $query_prenext = "SELECT * FROM " . $SKIN->tableName . $where . $orderby . $limit; // data
    $dbData_prenext = $DB->getDBData($query_prenext);
    $dbData_pre = $dbData_next = null;
    for ($i = 0; $i < count($dbData_prenext); $i ++) {
        if ($dbData_prenext[$i]['indexcode'] == $no) { // 현재 게시물을 기준으로 앞과 뒤의 게시물을 가져오는 로직.. 한 페이지 리스트 분량의 데이터에서 데이터를 가져와서
            $dbData_pre[0] = isset($dbData_prenext[$i - 1]) ? $dbData_prenext[$i - 1] : null; // 그 중에 현재 게시물에 해당하는 리스트를 기준으로 앞과 뒤의 게시물을 찾아냄
            $dbData_next[0] = isset($dbData_prenext[$i + 1]) ? $dbData_prenext[$i + 1] : null;
        }
    }

    $system['data']['preData'] = $dbData_pre[0];
    $system['data']['nextData'] = $dbData_next[0];

    $query = "SELECT * FROM " . $SKIN->tableName . " WHERE iscomment = 1 AND parentcode = " . $no . " ORDER BY commentgroup DESC, commentrank ASC, commentorder DESC";
    $cdbData = $DB->getDBData($query);
    $system['data']['commentdata'] = $cdbData;
} else if ($mode == "write") {

    $system['data']['dbData'] = null;
    $system['data']['fileData'] = null;
} else if ($mode == "update") {

    $system['data']['dbData'] = $SKIN->getBoardData($no);
    $system['data']['fileData'] = $SKIN->getFileData($menuID, $no);
} else if ($mode == "reply") {

    $query = "SELECT subject, memo FROM " . $SKIN->tableName . " WHERE indexcode=" . $no;
    $dbData = $DB->getDBData($query);

    $dbData[0]['subject'] = "[답변]\n" . $dbData[0]['subject'];
    $dbData[0]['memo'] = "[원문]\n" . $dbData[0]['memo'] . "\n";
    $system['data']['dbData'] = $dbData;

    $system['data']['fileData'] = null;
} else if ($mode == "delete") {

    $system['data']['dbData'] = $SKIN->getBoardData($no);
    $opt = isset($_GET['opt']) ? intval($_GET['opt']) : 0;

    $buttonText = $SKIN->getDeleteButtonText($opt);
}

