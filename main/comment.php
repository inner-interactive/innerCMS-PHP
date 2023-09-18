<?php
include "../common.php";
include "define.php";
include_once COMMON_PATH . "lib/common.lib.php";
include_once COMMON_PATH . "lib/db.class.php";
include_once COMMON_PATH . "lib/menu.class.php";
include_once COMMON_PATH . "lib/skin.class.php";
include_once COMMON_PATH . "lib/grant.class.php";
include_once COMMON_PATH . "plugin/kcaptcha/captcha.lib.php";

if (count($_POST) == 0)
    alert('잘못된 접근입니다.');

$menuID = isset($_POST['menu']) ? intval($_POST['menu']) : 0;
if ($menuID == 0)
    alert('잘못된 접근입니다.');

// 코멘트 달린 게시물의 indexcode
$no = isset($_POST['no']) ? intval($_POST['no']) : 0;
if ($no == 0)
    alert('잘못된 접근입니다.');

// 코멘트 게시물의 부모 indexcode
$cno = isset($_POST['cno']) ? intval($_POST['cno']) : 0;

$action = isset($_POST['action']) ? trim($_POST['action']) : "";
if ($action == "")
    alert('잘못된 접근입니다.');
if (! in_array($action, array(
    'write',
    'update',
    'reply',
    'delete'
)))
    alert('잘못된 접근입니다.');

$blankList = array(
    "memo|코멘트 내용을"
);
if (! isset($_SESSION['user_id'])) {
    array_push($blankList, "uname|이름을");
    array_push($blankList, "upw|비밀번호를");
}
blankCheck($blankList);

$DB = new DB();
$MENU = new Menu($DB);
$menuInfo = $MENU->getMenuInfo($menuID);
$SKIN = new skin($menuInfo);

$GRANT = new Grant($cno);

if ($userID == "" && ! chk_captcha()) {
    alert('자동등록방지 숫자가 틀렸습니다.');
}

if ($action == "write" || $action == "reply") {

    if ($action == "write")
        $GRANT->commentWriteGrantCheck();
    else if ($action == "reply")
        $GRANT->commentReplyGrantCheck();

    $column = $DB->getColumns($SKIN->tableName, array(
        'indexcode',
        'subject'
    ));
    $column['writetime']['type'] = "now";

    if ($userID != "") {
        $_POST['uid'] = trim($userID);
        $_POST['uname'] = trim($userName);
        $_POST['realname'] = trim($_SESSION['user_realname']);
    } else {
        $_POST['uname'] = trim($_POST['uname']);
        $column['upw']['type'] = "password";
    }

    $_POST['ip'] = $_SERVER['REMOTE_ADDR'];

    $_POST['iscomment'] = 1;
    $_POST['memo'] = trim($_POST['memo']);
    $_POST['parentcode'] = $no;

    if ($action == "write") {

        $_POST['commentrank'] = 0;
        $_POST['commentfrom'] = 0;

        $query = "SELECT max(commentgroup) FROM " . $SKIN->tableName . " WHERE iscomment = 1 AND parentcode = " . $no;
        $dbData = $DB->getDBData($query);
        $_POST['commentgroup'] = intval($dbData[0][0]) + 1;

        $query = "SELECT max(commentorder) FROM " . $SKIN->tableName . " WHERE iscomment = 1 AND commentrank = 0 AND parentcode = " . $no;
        $dbData = $DB->getDBData($query);
        $_POST['commentorder'] = intval($dbData[0][0]) + 1;
    } else if ($action == "reply") {

        // 코멘트 랭크 구하기
        $query = "SELECT commentrank, commentgroup FROM " . $SKIN->tableName . " WHERE iscomment = 1 AND indexcode = " . $cno;
        $dbData = $DB->getDBData($query);
        $_POST['commentrank'] = intval($dbData[0]['commentrank']) + 1;
        $_POST['commentgroup'] = intval($dbData[0]['commentgroup']);

        $_POST['commentfrom'] = $cno;

        $query = "SELECT max(commentorder) FROM " . $SKIN->tableName . " WHERE iscomment = 1 AND commentrank = " . $_POST['commentrank'] . " AND parentcode = " . $cno;
        $dbData = $DB->getDBData($query);
        $_POST['commentorder'] = intval($dbData[0][0]) + 1;
    }

    $query = $DB->insertSql($column, $_POST, $SKIN->tableName);
    $DB->runQuery($query);
} else if ($action == "update") {

    $GRANT->commentUpdateGrantCheck($_POST['upw']);
    $column = $DB->getColumns($SKIN->tableName, array(
        'indexcode',
        'delflag',
        'uid',
        'uname',
        'upw',
        'subject',
        'view',
        'isimportant',
        'writetime',
        'replyfrom',
        'replyrank',
        'replytime',
        'replyorder',
        'iscomment',
        'parentcode',
        'commentgroup',
        'commentrank',
        'commentfrom',
        'commentorder'
    ));
    $column['updatetime']['type'] = "now";
    $_POST['memo'] = trim($_POST['memo']);
    $_POST['indexcode'] = intval($_POST['cno']);
    $query = $DB->updateSql($column, $_POST, $SKIN->tableName);
    $DB->runQuery($query);
} else if ($action == "delete") {

    $opt = isset($_POST['opt']) ? intval($_POST['opt']) : 0;
    if ($userName == "")
        $GRANT->commenDeleteGrantCheck($_POST['upw']);
    $SKIN->delete($cno, $opt);
}

$backUrl = html_entity_decode($_POST['backUrl']);

header('location:' . $backUrl);
exit();

?>