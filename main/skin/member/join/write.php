<?php
include "../../../../common.php";
include "../../../define.php";
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

// 필수 입력 체크
$blankList = array(
    "userid|아이디를",
    "userpw|패스워드를",
    "realname|실명을",
    "nickname|닉네임을"
);
blankCheck($blankList);

$DB = new DB();

$tableName = MEMBER_TABLE;

// 아이디 중복체크
$query = "SELECT count(*) FROM " . $tableName . " WHERE userid = '" . trim($_POST['userid']) . "'";
$dbData = $DB->getDBData($query);
if (intval($dbData[0][0]) > 0)
    alert('이미 등록된 아이디입니다.');

$column = $DB->getColumns($tableName, array(
    'indexcode'
));
$column['jointime']['type'] = "now";
$column['userpw']['type'] = "password";

$_POST['authlevel'] = 10;

$query = $DB->insertSql($column, $_POST, $tableName);
$DB->runQuery($query);
$backUrl = html_entity_decode($_POST['backUrl']);
if ($DB->affected_rows) {

    header('location:' . $backUrl);
} else {
    alert('회원이 등록되지 않았습니다.');
}

header('location:' . $backUrl);
exit();

?>