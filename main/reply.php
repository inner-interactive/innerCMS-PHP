<?php
include "../common.php";
include "define.php";
include_once COMMON_PATH . "lib/common.lib.php";
include_once COMMON_PATH . "lib/db.class.php";
include_once COMMON_PATH . "lib/menu.class.php";
include_once COMMON_PATH . "lib/skin.class.php";
include_once COMMON_PATH . "lib/grant.class.php";

if (count($_POST) == 0)
    alert('잘못된 접근입니다.');

$menuID = isset($_POST['menu']) ? intval($_POST['menu']) : 0;
if ($menuID == 0)
    alert('잘못된 접근입니다.');

$no = isset($_POST['no']) ? intval($_POST['no']) : 0;
if ($no == 0)
    alert('잘못된 접근입니다.');

$blankList = array(
    "subject|제목을",
    "memo|내용을"
);
blankCheck($blankList);

$DB = new DB();
$MENU = new Menu($DB);

$menuInfo = $MENU->getMenuInfo($menuID);
$SKIN = new skin($menuInfo);
$GRANT = new Grant();
$GRANT->replyGrantCheck();

// 스킨 폴더내에 reply.php 파일이 있으면 include 한다.
$_skin_file = $SKIN->skin_path . basename(__FILE__);

$column = $DB->getColumns($SKIN->tableName, array(
    'indexcode',
    'updatetime'
));
$column['replytime']['type'] = "now";

if (isset($_SESSION['user_id']) && $_SESSION['user_id'] != "") {
    $_POST['uid'] = trim($_SESSION['user_id']);
    $_POST['uname'] = trim($_SESSION['user_uname']);
} else {
    $_POST['uname'] = trim($_POST['uname']);
    $column['upw']['type'] = "password";
}

$_POST['ip'] = $_SERVER['REMOTE_ADDR'];
$_POST['hmode'] = $SKIN->getHmode($menuInfo['html_use'], $GRANT->grant['auth_alltag']);

$dbData = $SKIN->getBoardData($no);

$_POST['writetime'] = $dbData[0]['writetime'];
$_POST['replyfrom'] = $no;
$_POST['replyrank'] = intval($dbData[0]['replyrank']) + 1;

if (! isset($_POST['date1']) || trim($_POST['date1']) == "")
    $_POST['date1'] = "0000-00-00";
if (! isset($_POST['date2']) || trim($_POST['date2']) == "")
    $_POST['date2'] = "0000-00-00";
if (! isset($_POST['datetime1']) || trim($_POST['datetime1']) == "")
    $_POST['datetime1'] = "0000-00-00 00:00:00";
if (! isset($_POST['datetime2']) || trim($_POST['datetime2']) == "")
    $_POST['datetime2'] = "0000-00-00 00:00:00";

$query = "SELECT max(replyorder) FROM " . $SKIN->tableName . " WHERE replyfrom = " . $no;
$dbData = $DB->getDBData($query);
$_POST['replyorder'] = intval($dbData[0][0]) + 1;

$query = $DB->insertSql($column, $_POST, $SKIN->tableName);
$DB->runQuery($query);

$backUrl = html_entity_decode($_POST['backUrl']);
if ($DB->affected_rows) {

    $query = "SELECT max(indexcode) FROM " . $SKIN->tableName;
    $dbData = $DB->getDBData($query);
    $newIndexcode = intval($dbData[0][0]);
    $SKIN->fileUpload($_FILES['sfile'], $newIndexcode);
    $backUrl .= "&no=" . $newIndexcode;
} else {
    alert('글이 등록되지 않았습니다.');
}

header('location:' . $backUrl);
exit();

?>