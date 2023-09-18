<?php
include "../../../../common.php";
include "../../../define.php";
include_once COMMON_PATH . "lib/common.lib.php";
include_once COMMON_PATH . "lib/db.class.php";
include_once COMMON_PATH . "lib/menu.class.php";
include_once COMMON_PATH . "lib/skin.class.php";
include_once COMMON_PATH . "lib/grant.class.php";

if (count($_POST) == 0)
    echo errorPage('에러 페이지', '잘못된 접근입니다.');

$menuID = isset($_POST['menu']) ? intval($_POST['menu']) : 0;
if ($menuID == 0)
    alert('잘못된 접근입니다.');

$no = isset($_POST['no']) ? intval($_POST['no']) : 0;
if ($no == 0)
    alert('잘못된 접근입니다.');

$DB = new DB();
$MENU = new Menu($DB);
$menuInfo = $MENU->getMenuInfo($menuID);
$SKIN = new skin($menuInfo);

$GRANT = new Grant();
if (! $isAdmin)
    alert('권한이 없습니다.');

$_config_file = $SKIN->skin_path . "config.php";
if (file_exists($_config_file))
    include $_config_file;

$column = $DB->getColumns($SKIN->tableName, array(
    'f1'
), true);

$_POST['f1'] = isset($_POST['status']) && trim($_POST['status']) != "" ? trim($_POST['status']) : "";
if (! in_array($_POST['f1'], $statusList))
    $_POST['f1'] = $statusList[0];

$_POST['indexcode'] = $no;

$query = $DB->updateSql($column, $_POST, $SKIN->tableName);
$DB->runQuery($query);

$backUrl = html_entity_decode($_POST['backUrl']);

header('location:' . $backUrl);
exit();

?>