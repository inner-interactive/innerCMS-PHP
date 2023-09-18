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

$action = isset($_POST['action']) ? trim($_POST['action']) : "";
$indexno = isset($_POST['indexno']) ? $_POST['indexno'] : null;
$blankList = array(
    "!action|처리할 작업을",
    "!indexno|게시물을"
);
if ($action == "move" || $action == "copy")
    array_push($blankList, "!target_menu|메뉴를");
$target_menu = isset($_POST['target_menu']) ? intval($_POST['target_menu']) : 0;
blankCheck($blankList);

$DB = new DB();
$MENU = new Menu($DB);
$menuInfo = $MENU->getMenuInfo($menuID);
$SKIN = new skin($menuInfo);

$GRANT = new Grant();
if (! $GRANT->grant['auth_admin'])
    alert('권한이 없습니다.');

switch ($action) {

    case "delhide":
        foreach ($indexno as $no) {
            $SKIN->delete($no, 0);
        }
        break;

    case "recover":
        foreach ($indexno as $no) {
            $SKIN->delete($no, 1);
        }
        break;

    case "delreal":
        foreach ($indexno as $no) {
            $SKIN->delete($no, 2);
        }
        break;

    case "move":

        foreach ($indexno as $no) {
            $SKIN->move($no, $target_menu);
        }

        break;

    case "copy":
        foreach ($indexno as $no) {
            $SKIN->copy($no, $target_menu);
        }
        break;
}

$backUrl = html_entity_decode($_POST['backUrl']);
header('location:' . $backUrl);
exit();

?>