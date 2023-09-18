<?php
include "../common.php";
include "define.php";
include_once COMMON_PATH . "lib/common.lib.php";
include_once COMMON_PATH . "lib/db.class.php";
include_once COMMON_PATH . "lib/menu.class.php";
include_once COMMON_PATH . "lib/skin.class.php";
include_once COMMON_PATH . "lib/grant.class.php";

if (count($_REQUEST) == 0)
    alert('잘못된 접근입니다.');

if ($menuID == 0 || $no == 0)
    alert('잘못된 접근입니다.');
if ($no == 0)
    alert('잘못된 접근입니다.');

$opt = isset($_REQUEST['opt']) ? intval($_REQUEST['opt']) : 0;
if (! $isAdmin && $opt > 0)
    $opt = 0; // 관리자 외에는 게시물 완전삭제 및 복구가 안되도록

$table = isset($_REQUEST['table']) ? intval($_REQUEST['table']) : 1; // 테이블 값이 1이면 스킨에 설정된 db_table 값을 2이면 db_table2 값을 사용

$DB = new DB();
$MENU = new Menu($DB);
$menuInfo = $MENU->getMenuInfo($menuID);
$SKIN = new skin($menuInfo);

$GRANT = new Grant();
$GRANT->deleteGrantCheck();

$SKIN->delete($no, $opt, $table);

$backUrl = html_entity_decode($_REQUEST['backUrl']);

header('location:' . $backUrl);
exit();

?>