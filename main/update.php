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

$no = isset($_POST['no']) ? intval($_POST['no']) : 0;
if ($no == 0)
    alert('잘못된 접근입니다.');


if ($userID == "" && ! chk_captcha()) {
    alert('자동등록방지 숫자가 틀렸습니다.');
}

$DB = new DB();
$MENU = new Menu($DB);

$menuInfo = $MENU->getMenuInfo($menuID);
$SKIN = new skin($menuInfo);

$GRANT = new Grant();
$GRANT->updateGrantCheck();

// 스킨폴더내에 config.php 파일이 있으면 include한다.
$_config_file = $SKIN->skin_path . "config.php";
if (file_exists($_config_file))
    include $_config_file;

// 스킨 폴더내에 update.php 파일이 있으면 include 한다.
$_skin_file = $SKIN->skin_path . basename(__FILE__);
if (file_exists($_skin_file))
    include $_skin_file;

$column = $DB->getColumns($SKIN->tableName, array(
    'indexcode',
    'delflag',
    'uid',
    'rid',
    'upw',
    'uname',
    'realname',
    'view',
    'ip',
    'writetime',
    'replyfrom',
    'replyrank',
    'replytime',
    'replyorder'
    
));
$column['updatetime']['type'] = "now";

$_POST['ip'] = $_SERVER['REMOTE_ADDR'];
$_POST['indexcode'] = intval($_POST['no']);
$_POST['hmode'] = $SKIN->getHmode($menuInfo['html_use'], $GRANT->grant['auth_alltag']);

if (! isset($_POST['date1']) || trim($_POST['date1']) == "")
    $_POST['date1'] = "0000-00-00";
if (! isset($_POST['date2']) || trim($_POST['date2']) == "")
    $_POST['date2'] = "0000-00-00";
if (! isset($_POST['datetime1']) || trim($_POST['datetime1']) == "")
    $_POST['datetime1'] = "0000-00-00 00:00:00";
if (! isset($_POST['datetime2']) || trim($_POST['datetime2']) == "")
    $_POST['datetime2'] = "0000-00-00 00:00:00";

$query = $DB->updateSql($column, $_POST, $SKIN->tableName);
$DB->runQuery($query);

$backUrl = html_entity_decode($_POST['backUrl']);
if ($DB->affected_rows) {
    $SKIN->picUpload($_FILES['pfile'], $no);
    $SKIN->fileUpload($_FILES['sfile'], $no);
} else {
    alert('글이 수정되지 않았습니다.');
}

header('location:' . $backUrl);
exit();

?>