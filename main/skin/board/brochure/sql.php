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

    // 게시물 상단 고정 날짜가 지난 게시물은 상단 고정 값을 해제함.
    $SKIN->isImportantDateCheck();

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
    $system['data']['thumbData'] = null;
} else if ($mode == "update") {

    $system['data']['dbData'] = $SKIN->getBoardData($no);
    $system['data']['fileData'] = $SKIN->getFileData($menuID, $no);
    $system['data']['thumbData'] = $SKIN->getFileData($menuID, $no, 'thumb');
} else if ($mode == "reply") {

    $query = "SELECT subject, memo FROM " . $SKIN->tableName . " WHERE indexcode=" . $no;
    $dbData = $DB->getDBData($query);

    $dbData[0]['subject'] = "[답변]\n" . $dbData[0]['subject'];
    $dbData[0]['memo'] = "[원문]\n" . $dbData[0]['memo'] . "\n";
    $system['data']['dbData'] = $dbData;
    $system['data']['thumbData'] = null;
    $system['data']['fileData'] = null;
} else if ($mode == "delete") {

    $system['data']['dbData'] = $SKIN->getBoardData($no);
    $opt = isset($_GET['opt']) ? intval($_GET['opt']) : 0;

    $buttonText = $SKIN->getDeleteButtonText($opt);
}

