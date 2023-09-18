<?php
include "../common.php";
include "define.php";
include_once COMMON_PATH . "lib/common.lib.php";
include_once COMMON_PATH . "lib/db.class.php";
include_once COMMON_PATH . "lib/menu.class.php";
include_once COMMON_PATH . "lib/download.lib.php";

if (count($_REQUEST) == 0)
    alert('잘못된 접근입니다.');

$menuID = isset($_GET['menu']) ? intval($_GET['menu']) : 0;
$no = isset($_GET['no']) ? intval($_GET['no']) : 0;

if ($menuID == 0 || $no == 0)
    alert('잘못된 접근입니다.');

$DB = new DB();
$MENU = new Menu();
$menuData = $MENU->getMenuInfo($menuID);
$auth_filedown = intval($menuData['auth_filedown']);

// 다운로드 권한 체크
$user_level = isset($_SESSION['user_level']) ? intval($_SESSION['user_level']) : 0;
if ($auth_filedown > $user_level)
    alert("파일 다운로드 권한이 없습니다.");

$query = "SELECT attach_file_name, down_file_name, attach_type FROM " . FILE_TABLE . " WHERE file_id = " . $no;
$fileData = $DB->getDBData($query);
$attach_type = trim($fileData[0]['attach_type']);
$attach_file_name = trim($fileData[0]['attach_file_name']);
$down_file_name = trim($fileData[0]['down_file_name']);

if (count($fileData) == 0)
    alert("파일이 존재하지 않습니다.");
$fullPath = DATA_PATH . "upload/" . $fileData[0]['attach_file_name'];

if (file_exists($fullPath)) {
    $query = "UPDATE " . FILE_TABLE . " SET file_down_count = file_down_count + 1 WHERE file_id = " . $no;
    $DB->runQuery($query);
    downloadFile($fullPath, $down_file_name);
} else {
    alert("파일이 존재하지 않습니다.");
}

?>